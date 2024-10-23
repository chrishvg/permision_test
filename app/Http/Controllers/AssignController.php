<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Permission;

class AssignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        $users = User::all();

        if (Auth::user()->is_admin > 0) {
            return view('assign.index', compact('permissions', 'users'));
        } else {
            $user = Auth::user();
            $permissionsFromUser = $user->permissions->pluck('name');
            if ($permissionsFromUser->contains('assign'))
                return view('assign.index');
        }

        return redirect()->route('noallowed');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $permission = Permission::findOrFail($request->permission_id);
        $user->permissions()->attach($permission->id);

        return redirect()->route('assign')->with('status', 'permission-assigned');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $permission = Permission::findOrFail($request->permission_id);
        $user->permissions()->detach($permission->id);

        return redirect()->route('assign')->with('status', 'permission-removed');
    }
}
