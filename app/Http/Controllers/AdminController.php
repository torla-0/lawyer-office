<?php

namespace App\Http\Controllers;

use App\Models\LegalCase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    public function index()
    {
        return view('admin.login');
    }
    public function show()
    {
        $roles = Role::all();
        return view('admin.panel', ['roles' => $roles]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'pass_phrase' => 'required',
        ]);

        if (Auth::guard('admin')->attempt(['password' => $request->password, 'pass_phrase' => $request->pass_phrase])) {
            $request->session()->regenerate();
            return redirect()->route('admin.panel');
        }

        return redirect()->route('admin.login')->withErrors(['error' => 'Invalid credentials']);
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Cache::flush();
        return redirect('/');
    }
}
