<?php

namespace App\Services;

use App\Models\Institute;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class InstituteService
{
    public function getInstitutes(): Collection
    {
        return Institute::latest()->get();
    }
    public function store($data)
    {
        $data['valid_to'] = Carbon::now()->addMonths(1);
        return Institute::create($data);
    }

    public function update($institute, $data)
    {
        $institute->update($data);
        return $institute;
    }
}
