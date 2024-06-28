<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // TODO: Change phone number data type everywhere
        $request->validate([
            'firstname' => ['required', 'string', 'max:16'],
            'lastname' => ['required', 'string', 'max:16'],
            'phone_number' => ['required', 'string', 'max:16'],
            'email' => ['required', 'string', 'email', 'max:48', 'unique:users'],
            'address' => ['required', 'string', 'max:32'],
            'city' => ['required', 'string', 'max:16'],
            'password' => ['required', 'string', 'min:8', Rules\Password::defaults()],
        ]);
        // Assign the role - use ternary operator
        if ($request->input('role_id')) {
            $clientRole = $request->input('role_id');
        } else {
            $clientRole = Role::where('name', 'Client')->first();
        }
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'password' => Hash::make($request->password),
            'role_id' => $clientRole->id,
        ]);

        $user->save();

        event(new Registered($user));

        return redirect(route('login', absolute: false));
    }
}
