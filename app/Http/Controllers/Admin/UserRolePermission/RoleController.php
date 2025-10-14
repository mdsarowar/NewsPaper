<?php

namespace App\Http\Controllers\Admin\UserRolePermission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laratrust\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.role.index', ['roles' => Role::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        return $request;
        $data=request()->validate([
            'name'=>'required',
            'display_name'=>'nullable',
            'description'=>'nullable',

        ]);

        Role::create([
            'name'=>$data['name'],
            'display_name'=>$data['display_name'],
            'description'=>$data['description'],
        ]);

        return redirect()->route('roles.index')->with('message', 'Role created successfully.');
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
