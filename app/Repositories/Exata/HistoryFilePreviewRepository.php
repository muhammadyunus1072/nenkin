<?php

namespace App\Repositories\Exata;

use App\Models\Exata\HistoryFilePreview;
use App\Repositories\MasterDataRepository;

class HistoryFilePreviewRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return HistoryFilePreview::class;
    }

    public static function datatable()
    {
        return HistoryFilePreview::query();
    }
}
