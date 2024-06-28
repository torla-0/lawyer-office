<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Lawyer;
use App\Models\LegalCase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Initialize variables
        $legalCases = [];
        $lawyers = [];
        $clients = [];
        $meetings = [];
        // Check if the user is authenticated
        if ($user) {
            // Get role to display right content
            $userRole = Role::where('id', $user->role_id)->first();

            // TODO: Use methods for case instead of hard-coded values
            switch (strtolower($userRole->name)) {
                case 'client':
                    $legalCases = LegalCase::where('user_id', $user->id)->paginate(10);
                    $lawyers = Lawyer::all();
                    $meetings = Appointment::where('user_id', $user->id)->get();
                    break;
                case 'lawyer':
                    $lawyer = Lawyer::where('user_id', $user->id)->first();
                    $legalCases = LegalCase::where('lawyer_id', $lawyer->id)->where('status', 'open')->paginate(10);
                    $role = Role::where('name', 'client')->first();
                    $clients = User::where('role_id', $role->id)->get();
                    $meetings = Appointment::where('lawyer_id', $lawyer->id)->get();
                    break;
            }
        }

        // Data for view
        return view(
            'dashboard',
            [
                'legalCases' => $legalCases,
                'filter' => 'Open',
                'user' => $user,
                // TODO: no need for userrole, u can access it thru user 
                'userRole' => $userRole,
                'lawyers' => $lawyers,
                'meetings' => $meetings,
                'clients' => $clients
            ]
        );
    }
}
