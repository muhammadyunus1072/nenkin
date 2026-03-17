<?php

namespace App\Repositories\MasterData\Regency;

use App\Models\MasterData\Regency;
use App\Repositories\MasterDataRepository;
use Illuminate\Support\Facades\Crypt;

class RegencyRepository extends MasterDataRepository
{
    protected static function className(): string
    {
        return Regency::class;
    }

    public static function datatable()
    {
        return Regency::query();
    }

    public static function search($request)
    {
        $data = Regency::select('id', 'name as text')
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', "%$request->search%");
            })
            ->orderBy('name', 'asc')
            ->limit(10)
            ->get()
            ->toArray();

        foreach ($data as $index => $item) {
            $data[$index]['id'] = Crypt::encrypt($item['id']);
        }

        return json_encode($data);
    }
}
