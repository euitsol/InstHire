<?php

namespace App\Http\Controllers\Institute\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\Institute\SessionRequest;
use App\Models\InstituteSession;
use App\Services\SessionService;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    protected $sessionService;

    public function __construct(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    public function index()
    {
        $sessions = $this->sessionService->getInstituteSessions(institute()->id);
        return view('institute.setup.session.index', compact('sessions'));
    }

    public function store(SessionRequest $request)
    {
        $data = $request->validated();
        $data['institute_id'] = institute()->id;

        try {
            $this->sessionService->createSession($data);
            return response()->json(['message' => 'Session created successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create session'], 500);
        }
    }

    public function show(InstituteSession $session)
    {
        return response()->json($session);
    }

    public function update(SessionRequest $request, InstituteSession $session)
    {
        $data = $request->validated();

        try {
            $this->sessionService->updateSession($session, $data);
            return response()->json(['message' => 'Session updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update session'], 500);
        }
    }

    public function toggleStatus(InstituteSession $session)
    {
        try {
            $this->sessionService->toggleStatus($session);
            session()->flash('success', 'Status updated successfully');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update status');
        }
        return redirect()->back();
    }

    public function delete(InstituteSession $session)
    {
        try {
            $this->sessionService->delete($session);
            session()->flash('success', 'Session deleted successfully');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete session');
        }
        return redirect()->back();
    }
}
