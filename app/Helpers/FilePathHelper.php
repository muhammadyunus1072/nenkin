<?php

namespace App\Helpers;

class FilePathHelper
{
    const FILE_VEHICLE_IMAGE = "vehicle-image";
    const FILE_CANDIDATE_JAPANESE_LANGUAGE_CERTIFICATE = "candidate_japanese_language_certificate";
    const FILE_CANDIDATE_CURRICULUM_VITAE = "candidate_curriculum_vitae";
}
// $path = $file->store('gensen');

// GensenFormAttachment::create([
//     'type' => $type,
//     'disk' => 'local',
//     'path' => $path,

//     'original_name' => $file->getClientOriginalName(),
//     'stored_name' => basename($path),

//     'extension' => $file->extension(),
//     'mime_type' => $file->getMimeType(),
//     'file_size' => $file->getSize(),

//     'checksum' => hash_file('sha256', $file->getRealPath()),
// ]);