<?php

namespace App\Services;

use App\Models\InstituteSession;
use Illuminate\Support\Facades\DB;

class SessionService
{
    public function getInstituteSessions($instituteId)
    {
        return InstituteSession::where('institute_id', $instituteId)->get();
    }

    public function createSession($data)
    {
        try {
            DB::beginTransaction();

            $session = InstituteSession::create([
                'name' => $data['name'],
                'status' => $data['status'] ?? true,
                'institute_id' => $data['institute_id']
            ]);

            DB::commit();
            return $session;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateSession($session, $data)
    {
        try {
            DB::beginTransaction();

            $session->update([
                'name' => $data['name'],
                'status' => $data['status']
            ]);

            DB::commit();
            return $session;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function toggleStatus($session)
    {
        try {
            DB::beginTransaction();

            $session->update([
                'status' => !$session->status
            ]);

            DB::commit();
            return $session;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete($session)
    {
        try {
            DB::beginTransaction();
            $session->delete();
            DB::commit();
            return $session;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
