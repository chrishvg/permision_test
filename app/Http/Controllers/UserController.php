<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->is_admin > 0) {
            return view('user.index');
        } else {
            $user = Auth::user();
            $permissionsFromUser = $user->permissions->pluck('name');
            if ($permissionsFromUser->contains('new-user'))
                return view('user.index');
        }

        return redirect()->route('noallowed');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'last_name' => $validatedData['last_name'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'is_admin' => isset($request->is_admin),
            'is_enabled' => true,
        ]);

        return redirect()->route('dashboard')->with('status', 'user-added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = User::findOrFail($request->id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email'
        ]);

        if (isset($validatedData['password'])) {
            $user->password = Hash::make($request->password);
        }

        $validatedData['is_admin'] = isset($request->is_admin);

        $user->update($validatedData);

        return redirect()->route('dashboard')->with('status', 'user-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->is_enabled = false;
        $user->save();

        return redirect()->route('dashboard')->with('status', 'user-deleted');
    }

    public function enabled(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->is_enabled = true;
        $user->save();

        return redirect()->route('dashboard')->with('status', 'user-enabled');
    }

    public function edit(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        return view('user.update', compact('user'));
    }
}
