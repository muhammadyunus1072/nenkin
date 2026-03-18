<?php

namespace App\Repositories\Exata;

use App\Models\Exata\ExataJapaneseLanguageCertificate;
use App\Repositories\MasterDataRepository;

class ExataJapaneseLanguageCertificateRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return ExataJapaneseLanguageCertificate::class;
    }
}
