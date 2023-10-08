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
        })->with('roles')->latest()->paginate(10);

        $roles = Role::all();

        return view('pages.app.users.index', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'username' => 'required|max:20|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ], [
            'name.required' => 'Data Wajib Diisi',
            'name.max' => 'Data Terlalu Panjang',
            'username.required' => 'Data Wajib Diisi',
            'username.max' => 'Data Terlalu Panjang',
            'username.unique' => 'Data Sudah Terdaftar',
            'email.required' => 'Data Wajib Diisi',
            'email.email' => 'Format Email Salah',
            'email.unique' => 'Email Sudah Terdaftar',
            'password.required' => 'Data Wajib Diisi',
            'password.confirmed' => 'Konfirmasi Password Salah',
            'password.min' => 'Password Terlalu Pendek',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        //assign role to user
        $user->assignRole($request->roles);

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

        return view('pages.app.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'username' => 'required|max:200|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable',
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
