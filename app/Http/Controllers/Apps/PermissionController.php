<?php

namespace App\Http\Controllers\Apps;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //get permissions
        $permissions = Permission::when(request()->q, function ($permissions) {
            $permissions =  $permissions->where('name', 'like', '%' . request()->q . '%');
        })->latest()->paginate(10);

        return view('pages.app.permissions.index', compact('permissions'));
    }
}
