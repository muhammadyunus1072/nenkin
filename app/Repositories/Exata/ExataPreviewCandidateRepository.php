<?php

namespace App\Repositories\Exata;

use App\Models\Exata\Exata;
use App\Models\Exata\ExataPreviewCandidate;
use App\Repositories\MasterDataRepository;
use Illuminate\Support\Facades\DB;

class ExataPreviewCandidateRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return ExataPreviewCandidate::class;
    }

    public static function datatable()
    {
        return Exata::join('exata_preview_candidates', function ($q) {
            $q->on('exatas.id', 'exata_preview_candidates.exata_id')
                ->whereNull('exata_preview_candidates.deleted_at');
        })
            ->select('exatas.*', 'exata_preview_candidates.exata_id', 'exata_preview_candidates.poin_rekomendasi')
        ;
    }
}
