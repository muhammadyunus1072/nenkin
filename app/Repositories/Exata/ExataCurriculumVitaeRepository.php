<?php

namespace App\Repositories\Exata;

use App\Models\Exata\ExataCurriculumVitae;
use App\Repositories\MasterDataRepository;

class ExataCurriculumVitaeRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return ExataCurriculumVitae::class;
    }
}
