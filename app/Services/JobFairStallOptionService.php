<?php

namespace App\Services;

use App\Models\JobFairStallOption;
use Illuminate\Support\Facades\DB;

class JobFairStallOptionService
{
    public function getInstituteStallOptions($instituteId)
    {
        return JobFairStallOption::where('institute_id', $instituteId)->get();
    }

    public function createStallOption($data)
    {
        try {
            DB::beginTransaction();

            $stallOption = JobFairStallOption::create([
                'institute_id' => $data['institute_id'],
                'stall_size' => $data['stall_size'],
                'maximum_representative' => $data['maximum_representative'],
                'description' => $data['description'] ?? null,
                'status' => $data['status'] ?? true
            ]);

            DB::commit();
            return $stallOption;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateStallOption($stallOption, $data)
    {
        try {
            DB::beginTransaction();

            $stallOption->update([
                'stall_size' => $data['stall_size'],
                'maximum_representative' => $data['maximum_representative'],
                'description' => $data['description'] ?? null,
                'status' => $data['status']
            ]);

            DB::commit();
            return $stallOption;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function toggleStatus($stallOption)
    {
        try {
            DB::beginTransaction();

            $stallOption->update([
                'status' => !$stallOption->status
            ]);

            DB::commit();
            return $stallOption;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete($stallOption)
    {
        try {
            DB::beginTransaction();

            $stallOption->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
