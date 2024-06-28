<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function index(Request $request, $f = null, $i = null)
    {
        $f = $request->query('f');
        $i = $request->query('i');

        // Filter check, sql injection protection
        $validColumns = ['firstname', 'lastname', 'email', 'phone_number', 'address', 'city', 'role', 'all'];
        if (!in_array($f, $validColumns)) {
            // Filter not in array -> bye bye
            return redirect()->back()->withErrors(['error' => 'Invalid filter selected']);
        }

        $roleClient = Role::where('name', 'Client')->first();
        foreach ($validColumns as $key => $value) {
            switch ($f) {
                case 'all':
                    $displayData = Auth::user()->isAdmin()
                        ? User::paginate(10)
                        : User::where('role_id', $roleClient->id)->paginate(10);
                    break;
                case 'role': // Shouldnt be possible to preform this (by role) search unless admin
                    $displayData = Auth::user()->isAdmin()
                        ? User::where('role_id', $i)->paginate(10)
                        : User::where('role_id', $roleClient->id)->paginate(10);
                    break;
                case $value:
                    $displayData = Auth::user()->isAdmin()
                        ? User::where($f, 'like', "%$i%")->paginate(10)
                        : User::where($f, 'like', "%$i%")->where('role_id', $roleClient->id)->paginate(10);
                    break;
            }
        }
        if ($displayData->isEmpty()) {
            return redirect()->back()->with('message', 'No search results found');
        }
        return view('user.show', ['users' => $displayData, 'filter' => $f, 'input' => $i]);
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $user->update($request->all());
        return redirect()->back()->with('message', 'User updated successfully');
    }
    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('message', 'User deleted successfully');
    }
}
