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
            session()->flash('success', 'Session created successfully');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create session');
        }
        return redirect()->back();
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
            session()->flash('success', 'Session updated successfully');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update session');
        }
        return redirect()->back();
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
