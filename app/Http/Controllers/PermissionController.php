<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('permission.index', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $permission = Permission::create([
            'name' => $validatedData['name'],
        ]);

        return redirect()->route('permission')->with('status', 'permission-added');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $permission = Permission::findOrFail($request->id);
        $permission->delete();

        return redirect()->route('permission')->with('status', 'permission-deleted');
    }
}
