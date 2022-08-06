<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {

            $this->middleware(['role:admin']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|min:3|max:50',
            'display_name' => 'nullable|min:3|max:50',
            'description' => 'nullable|min:3',
        ]);

        Role::create($attributes);

        return redirect()->route('admin.role.index')->with([
            'type' => 'success',
            'message' => 'Role insert successfuly'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('admin.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $attributes = $request->validate([
            'name' => 'required|min:3|max:50',
            'display_name' => 'nullable|min:3|max:50',
            'description' => 'nullable|min:3',
        ]);


        $role->update($attributes);

        return redirect()->route('admin.role.index')->with([
            'type' => 'success',
            'message' => 'Role updated successfuly'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * NOTES: BUG found in the main vendor library follow @param \App\Models\Role $role
     * @return \Illuminate\Http\Response
     * @see portion
     * @see https://stackoverflow.com/questions/37917518/issue-in-deleting-role-in-zizaco-entrust
     */
    public function destroy(Role $role)
    {

        $role->delete();

        return redirect()->route('admin.role.index')->with([
            'type' => 'error',
            'message' => 'Role deleted successfuly'
        ]);
    }

    public function permission($id)
    {
        $role = Role::find($id);
        $permissions = permission::get();

        // customers
        $customers = $permissions->filter(function ($value, $key) {
            return strstr($value, 'customer');
        });

        // menu
        $menus = $permissions->filter(function ($value, $key) {
            return strstr($value, 'menu');
        });
        // offers
        $offers = $permissions->filter(function ($value, $key) {
            return strstr($value, 'offer');
        });

        // brnaches
        $brnaches = $permissions->filter(function ($value, $key) {
            return strstr($value, 'branch');
        });

        // users
        $users = $permissions->filter(function ($value, $key) {
            return strstr($value, 'user');
        });

        // roles
        $roles = $permissions->filter(function ($value, $key) {
            return strstr($value, 'role');
        });

        // orders
        $orders = $permissions->filter(function ($value, $key) {
            return strstr($value, 'order');
        });

        return view('admin.role.permission', compact('permissions', 'role', 'orders', 'roles', 'users', 'brnaches', 'offers', 'menus', 'customers'));
    }

    public function asignPermission($id, Request $request)
    {
        $role = Role::find($id);
        $permissions = Permission::whereIn('id', $request->permission)->get();
        $role->permissions()->sync($permissions);
        return redirect()->route('admin.role.index')->with([
            'type' => 'success',
            'message' => 'Permission asign successfuly'
        ]);
    }
}
