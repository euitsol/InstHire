<?php

namespace App\Http\Controllers\Institute\Setup;

use App\Http\Controllers\Controller;
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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'boolean'
        ]);

        $data = $request->all();
        $data['institute_id'] = institute()->id;

        try {
            $this->sessionService->createSession($data);
            return response()->json(['message' => 'Session created successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create session'], 500);
        }
    }

    public function show(InstituteSession $session)
    {
        return response()->json($session);
    }

    public function update(Request $request, InstituteSession $session)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean'
        ]);

        try {
            $this->sessionService->updateSession($session, $request->all());
            return response()->json(['message' => 'Session updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update session'], 500);
        }
    }

    public function toggleStatus(InstituteSession $session)
    {
        try {
            $this->sessionService->toggleStatus($session);
            return response()->json(['message' => 'Status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update status'], 500);
        }
    }
}
