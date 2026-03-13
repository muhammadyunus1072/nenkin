<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class ExcelImportExataPreview implements ToCollection
{
    public $rows;

    public function collection(Collection $rows)
    {
        $this->rows = $rows->skip(1)->values(); // skip header + reset index
    }
}
