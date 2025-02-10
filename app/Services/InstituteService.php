<?php

namespace App\Services;

use App\Models\Institute;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class InstituteService
{
    public function store($data)
    {
        return Institute::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'valid_to' => Carbon::now()->addMonths(1), // Default 1 month validity
            'responsible_person_name' => $data['responsible_person_name'],
            'responsible_person_phone' => $data['responsible_person_phone'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function update($institute, $data)
    {
        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'valid_to' => $data['valid_to'],
            'responsible_person_name' => $data['responsible_person_name'],
            'responsible_person_phone' => $data['responsible_person_phone'],
        ];

        if (isset($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        $institute->update($updateData);
        return $institute;
    }
}
