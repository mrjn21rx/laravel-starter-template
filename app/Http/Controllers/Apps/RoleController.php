<?php

namespace App\Http\Controllers\Apps;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        //get roles
        $roles = Role::when(request()->q, function ($roles) {
            $roles = $roles->where('name', 'like', '%' . request()->q . '%');
        })->with('permissions')->latest()->paginate(10);

        return view('pages.app.roles.index', compact('roles'));
    }

    public function store(Request $request)
    {
        //validate request Role Form
        $this->validate($request, [
            'name' => 'required',
            'permissions' => 'required'
        ]);

        //create new role
        $role = Role::create([
            'name' => $request->name
        ]);

        //assign permissions to role
        $role->givePermissionTo($request->permissions);

        //redirect back to roles page
        return redirect()->route('pages.app.roles.index');
    }

    public function edit(Role $role)
    {
        //get role
        $role = Role::with('permissions', $role->permissions);
        //get all permissions
        $permissions = Permission::all();
        //redirect back to roles page
        return view('pages.app.roles.edit', compact('role', 'permissions'));
    }


    public function update(Request $request, Role $role)
    {
        //validate request updated form
        $this->validate($request, [
            'name' => 'required',
            'permissions' => 'required'
        ]);

        //update role
        $role->update([
            'name' => $request->name
        ]);

        //sync permissions to role
        $role->syncPermissions($request->permissions);

        //redirect back to roles page
        return redirect()->route('pages.app.roles.index');
    }


    public function delete(Role $role)
    {
        //find role by id
        $role = Role::findOrFail($role);
        //delete role
        $role->delete();
        //redirect back to roles page
        return redirect()->route('pages.app.roles.index');
    }
}
