<?php

namespace App\Http\Controllers\Admin\UserRolePermission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laratrust\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.permission.index', ['permissions' => Permission::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'display_name' => 'nullable',
            'description' => 'nullable',
        ]);
        $permission=Permission::create([
            'name' => $data['name'],
            'display_name' => $data['display_name'],
            'description' => $data['description'],
        ]);

        return redirect()->route('permissions.index')->with('success','Permission created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
