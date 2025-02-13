<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'CIN' => ['required', 'string', 'max:255', 'unique:users'], // Ensure CIN is unique
            'phone' => ['nullable', 'string', 'max:20'], // Phone is optional
            'adresse' => ['nullable', 'string', 'max:255'], // Address is optional
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Allow only images up to 2MB
            'role' => ['required', 'string', 'in:prof,student'], // Role must be 'prof' or 'student'
            'group_id' => ['nullable', 'exists:groups,id'], // Ensure group_id exists in the groups table
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile_images', 'public');
        }
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'CIN' => $request->CIN,
            'phone' => $request->phone,
            'adresse' => $request->adresse,
            'image' => $imagePath, // Save the image path
            'role' => $request->role,
            'group_id' => $request->group_id,
        ]);
        
        event(new Registered($user));

        Auth::login($user);

        // Redirect based on role
        if ($user->role === 'prof') {
            return redirect()->route('prof.dashboard');
        } 
        elseif ($user->role === 'student') {
            return redirect()->route('student.dashboard');
        }
    

        return redirect(RouteServiceProvider::HOME);
    }
}
