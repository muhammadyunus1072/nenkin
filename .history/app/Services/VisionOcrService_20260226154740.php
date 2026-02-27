<?php

namespace App\Services;

use App\Repositories\Nenkin\NenkinRepository;
use Carbon\Carbon;
use Google\Cloud\Vision\V1\AnnotateImageRequest;
use Google\Cloud\Vision\V1\BatchAnnotateImagesRequest;
use Google\Cloud\Vision\V1\Client\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Feature;
use Google\Cloud\Vision\V1\Image;
use Illuminate\Log\Logger;
use setasign\Fpdi\Fpdi;


class VisionOcrService
{
    public function cropImage($path, $coords, $des, $name)
    {
        $srcPath = storage_path('app/public/' . $path);

        $src = imagecreatefromjpeg($srcPath); // supports PNG, JPEG: use imagecreatefromjpeg()
        $dst = imagecreatetruecolor($coords['width'], $coords['height']);

        // Copy and crop
        imagecopy($dst, $src, 0, 0, $coords['x'], $coords['y'], $coords['width'], $coords['height']);

        $destFolder = storage_path('app/public/' . $des);
        $destPath = $destFolder . "/$name.png";

        // Make sure folder exists
        if (!file_exists($destFolder)) {
            mkdir($destFolder, 0755, true);
        }
        // Save
        imagepng($dst, $destPath);
    }

    public function handleDocument($id, $path)
    {
        $epath = explode('/', $path);
        $folder = $epath[0] . '/' . $epath[1];
        // Crop Date
        $coord = ['x' => 30, 'y' => 250, 'width' => 250, 'height' => 45];
        $this->cropImage($path, $coord, $folder, 'date');

        // Crop Payment Top
        $coord = ['x' => 610, 'y' => 50, 'width' => 150, 'height' => 50];
        $this->cropImage($path, $coord, $folder, 'payment_top');


        // Crop Payment
        $coord = ['x' => 610, 'y' => 370, 'width' => 180, 'height' => 50];
        $this->cropImage($path, $coord, $folder, 'payment');


        // Crop Income
        $coord = ['x' => 610, 'y' => 440, 'width' => 180, 'height' => 50];
        $this->cropImage($path, $coord, $folder, 'income');


        // Crop Net
        $coord = ['x' => 610, 'y' => 530, 'width' => 180, 'height' => 50];
        $this->cropImage($path, $coord, $folder, 'net');


        // Crop Number
        $coord = ['x' => 660, 'y' => 950, 'width' => 170, 'height' => 50];
        $this->cropImage($path, $coord, $folder, 'number');


        // Crop Name
        $coord = ['x' => 420, 'y' => 1000, 'width' => 700, 'height' => 50];
        $this->cropImage($path, $coord, $folder, 'name');


        // Crop Address
        $coord = ['x' => 400, 'y' => 1050, 'width' => 700, 'height' => 100];
        $this->cropImage($path, $coord, $folder, 'address');


        NenkinRepository::update($id, [
            'date' => $this->detectDocumentText(storage_path('app/public/' . $folder . '/date.png'), 'date')['text'] ?? null,
            'payment_top' => $this->detectDocumentText(storage_path('app/public/' . $folder . '/payment_top.png'), 'payment_top')['text'] ?? null,
            'payment' => $this->detectDocumentText(storage_path('app/public/' . $folder . '/payment.png'), 'payment')['text'] ?? null,
            'income' => $this->detectDocumentText(storage_path('app/public/' . $folder . '/income.png'), 'income')['text'] ?? null,
            'net' => $this->detectDocumentText(storage_path('app/public/' . $folder . '/net.png'), 'net')['text'] ?? null,
            'number' => $this->detectDocumentText(storage_path('app/public/' . $folder . '/number.png'), 'number')['text'] ?? null,
            'name' => $this->detectDocumentText(storage_path('app/public/' . $folder . '/name.png'), 'name')['text'] ?? null,
            'address' => $this->detectDocumentText(storage_path('app/public/' . $folder . '/address.png'), 'address')['text'] ?? null,
        ]);
    }
    public function detectDocumentText(string $path, string $name)
    {
        log($path . "Detect");
        $client = new ImageAnnotatorClient([
            'credentials' => base_path(env('GOOGLE_CLOUD_CREDENTIALS')),
            'transport' => 'rest',
        ]);

        // Read image content
        $imageContent = file_get_contents($path);
        $image = (new Image())->setContent($imageContent);

        // Prepare the feature for DOCUMENT_TEXT_DETECTION
        $feature = (new Feature())->setType(Feature\Type::DOCUMENT_TEXT_DETECTION);

        // Annotate image
        $request = (new AnnotateImageRequest())
            ->setImage($image)
            ->setFeatures([$feature]);
        $batchRequest = (new BatchAnnotateImagesRequest())
            ->setRequests([$request]);

        $response = $client->batchAnnotateImages($batchRequest);
        $annotations = $response->getResponses()[0];

        $result = [];

        // If text found
        if ($annotations->hasFullTextAnnotation()) {
            $fullText = $annotations->getFullTextAnnotation();
            $result['text'] = $fullText->getText();
            if ($name == 'date') {
                if (!$result['text']) return null;

                $text = preg_replace('/\s+/', '', $result['text']);

                if (preg_match('/(\d{4})年(\d{1,2})月(\d{1,2})日/u', $text, $m)) {
                    try {
                        $result['text'] = Carbon::createFromDate($m[1], $m[2], $m[3])->format('Y-m-d');
                    } catch (\Exception $e) {
                        return null;
                    }
                }
            } elseif (in_array($name, ['payment_top', 'payment', 'income', 'net'])) {
                if (!$result['text']) return null;

                $text = preg_replace('/\s+/', '', $result['text']);
                $text = preg_replace('/[^0-9]/', '', $text);

                $result['text'] = $text ?: null;
            }
            // // For simplicity, we just save the full text. You can also save structured info like blocks, paragraphs, etc.
            // foreach ($fullText->getPages() as $pageIndex => $page) {
            //     foreach ($page->getBlocks() as $blockIndex => $block) {
            //         $block_text = '';
            //         foreach ($block->getParagraphs() as $paragraph) {
            //             foreach ($paragraph->getWords() as $word) {
            //                 foreach ($word->getSymbols() as $symbol) {
            //                     $block_text .= $symbol->getText();
            //                 }
            //                 $block_text .= ' ';
            //             }
            //             $block_text .= "\n";
            //         }

            //         // Get bounding box
            //         $vertices = $block->getBoundingBox()->getVertices();
            //         $bounds = [];
            //         foreach ($vertices as $vertex) {
            //             $bounds[] = [
            //                 'x' => $vertex->getX(),
            //                 'y' => $vertex->getY(),
            //             ];
            //         }

            //         // Save structured block info
            //         $result['pages'][$pageIndex]['blocks'][$blockIndex] = [
            //             'text' => trim($block_text),
            //             'confidence' => $block->getConfidence(),
            //             'bounds' => $bounds,
            //         ];
            //     }
            // }
        } else {
            $result['text'] = null;
        }

        $client->close();
        // $json = file_get_contents(storage_path('app/nenkin.json')); // or your JSON string
        // $result = json_decode($json, true);
        // $this->drawBlocksOnPdf($path, $result['pages'][0]['blocks'], public_path('output.pdf'));
        // $this->drawBlocksOnPdf($path, $result['text'], public_path('output.pdf'));


        Logger($name . " : " . $result['text']);
        return $result;
        // return $result['pages'][0]['blocks'];
    }

    public function drawBlocksOnPdf($imagePath, $blocks, $outputPath)
    {
        $pdf = new Fpdi();
        $pageWidth = 1130;
        $pageHeight = 1680;
        $pdf->AddPage('P', [$pageWidth, $pageHeight]);

        // Draw the base image
        $pdf->Image($imagePath, 0, 0, $pageWidth, $pageHeight);

        // === Draw coordinate ruler ===
        $pdf->SetDrawColor(0, 0, 200); // Blue lines for grid
        $pdf->SetFont('Arial', '', 30);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->SetLineWidth(2);

        $step = 50; // 50 units per line

        // Vertical lines + labels (X-axis)
        for ($x = 0; $x <= $pageWidth; $x += $step) {
            $pdf->Line($x, 0, $x, $pageHeight);        // Draw vertical line
            $pdf->Text($x + 1, 8, (string)$x);        // Label at top
        }

        // Horizontal lines + labels (Y-axis)
        for ($y = 0; $y <= $pageHeight; $y += $step) {
            $pdf->Line(0, $y, $pageWidth, $y);        // Draw horizontal line
            $pdf->Text(2, $y + 3, (string)$y);       // Label at left
        }

        // === Draw blocks ===
        $pdf->SetDrawColor(255, 0, 0); // Red border for blocks
        foreach ($blocks as $index => $block) {
            $bounds = $block['bounds'];
            $x1 = $bounds[0]['x'];
            $y1 = $bounds[0]['y'] + ($index * 0.57);
            $x2 = $bounds[2]['x'];
            $y2 = $bounds[2]['y'] + ($index * 0.57);

            $width = $x2 - $x1;
            $height = $y2 - $y1;

            $pdf->Rect($x1, $y1, $width, $height);
        }

        // Save the PDF
        $pdf->Output('F', $outputPath);
    }

    public function detectDocumentText1($path)
    {
        log($path . "NEW");
        $client = new ImageAnnotatorClient([
            'credentials' => base_path(env('GOOGLE_CLOUD_CREDENTIALS')),
            'transport' => 'rest',
        ]);

        $imageContent = file_get_contents($path);

        $image = (new Image())
            ->setContent($imageContent);

        $feature = (new Feature())
            ->setType(Feature\Type::DOCUMENT_TEXT_DETECTION);

        $annotateRequest = (new AnnotateImageRequest())
            ->setImage($image)
            ->setFeatures([$feature]);

        $batchRequest = (new BatchAnnotateImagesRequest())
            ->setRequests([$annotateRequest]);

        $response = $client->batchAnnotateImages($batchRequest);

        $annotations = $response->getResponses()[0];

        $text = $annotations->getFullTextAnnotation();

        $text = $text?->getText();
        preg_match('/(\d{4})\s*年\s*(\d{1,2})\s*月\s*(\d{1,2})\s*日/u', $text, $matches);

        if ($matches) {
            $year  = $matches[1];
            $month = $matches[2];
            $day   = $matches[3];
        }

        return [
            'year' => $year ?? null,
            'month' => $month ?? null,
            'day' => $day ?? null,
            'text' => $text,
        ];
    }
}
