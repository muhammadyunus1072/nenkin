<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class NumberGenerator
{
    const COMPANY_CODE = "BOOK";
    const RESET_TYPE_YEARLY = 1;
    const RESET_TYPE_MONTHLY = 2;
    const RESET_TYPE_DAILY = 3;
    const SEPARATOR = "/";

    public static function generate(
        $className,
        $model,
    ) {

        $lastModel = $className::withTrashed()->select($className::PERMISSION_KodeUnik)
            ->orderBy('id', 'DESC')
            ->lockForUpdate()
            ->first();

        if (!empty($lastModel)) {
            $lastNumber = substr($lastModel->number, 6, -6);
            $lastNumber = $lastNumber ? $lastNumber : 0;
        } else {
            $lastNumber = 0;
        }

        // Get Current Number
        $currentNumber = strval($lastNumber + 1);

        $nama = strtoupper(preg_replace('/\s+/', '', $model->NamaLengkap));
        $domisili = strtoupper(preg_replace('/\s+/', '', $model->Domisili));

        $namaPart = str_pad(substr($nama, 0, 3), 3, 'X');
        $domisiliPart = str_pad(substr($domisili, 0, 3), 3, 'X');

        $tgl = $model->TanggalLahir ? \Carbon\Carbon::parse($model->TanggalLahir)->format('dmy') : null;

        return $namaPart . $domisiliPart . $currentNumber . $tgl;
    }


    public static function simpleYearCode(
        $className,
        $code,
        $date,
        $zeroPad = 6,
    ) {
        $dateTime = Carbon::parse($date);
        $year = substr($dateTime->year, 2);

        $lastModel = $className::withTrashed()->select('number')
            ->orderBy('id', 'DESC')
            ->first();

        if (!empty($lastModel)) {
            $lastNumber = intval(substr($lastModel->number, 4));
        } else {
            $lastNumber = 0;
        }

        // Get Current Number
        $currentNumber = strval($lastNumber + 1);
        $currentNumber = str_pad($currentNumber, $zeroPad, "0", STR_PAD_LEFT);

        return "{$code}{$year}{$currentNumber}";
    }
}
