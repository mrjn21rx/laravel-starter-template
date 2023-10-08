<?php

namespace App\Http\Controllers\Apps;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Show list of users and search functionality
     *
     * @return void
     */
    public function index()
    {
        $users = User::when(request()->q, function ($users) {
            $users = $users->where('name', 'like', '%' . request()->q . '%');
        });

        return view('app.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'username' => 'required|max:20|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|password|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        //assign role to user
        $user->assignRole($request->role);

        //redirect back to roles page
        if ($user) {
            //redirect dengan pesan sukses
            return redirect()->route('app.users.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('app.users.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('app.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'username' => 'required|max:200|unique:users,username' . $user->id,
            'email' => 'required|email|unique:users,email' . $user->id,
            'password' => 'nullable|confirmed',
        ]);

        //check if password is empty
        if ($request->password == '') {
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
        }

        //assign roles to user
        $user->syncRoles($request->roles);

        //redirect back to roles page
        if ($user) {
            //redirect dengan pesan sukses
            return redirect()->route('app.users.index')->with(['success' => 'Data Berhasil Diperbarui!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('app.users.index')->with(['error' => 'Data Gagal Diperbarui!']);
        }
    }

    public function destroy($id)
    {
        //find user
        $user = User::findOrFail($id);

        //delete user
        $user->delete();

        //check for status destroy
        if ($user) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
