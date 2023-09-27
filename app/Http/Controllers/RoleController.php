<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role as OriginalRole;
use Spatie\Permission\Models\Permission as OriginalPermission;

class RoleController extends Controller
{
    /**
     * Construct Role
    */
    function __construct()
    {
        $this->middleware('can:role list', ['only' => ['index', 'show']]);
        $this->middleware('can:role create', ['only' => ['create', 'store']]);
        $this->middleware('can:role edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:role delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = (new Role)->newQuery();
        if (request()->has('search')) {
            $roles->where('name', 'Like', '%' . request()->input('search') . '%');
        }

        $sort = request()->query('sort', 'name');

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $roles->orderBy($attribute, $sort_order);
        }

        $order = request()->query('order', 'latest');

        if ($order === 'oldest') {
            $roles->oldest('created_at');
        } else {
            $roles->latest('created_at');
        }

        $roles = $roles->paginate(2);
        return view('role.index', compact('roles', 'sort', 'order'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::orderBy('name')->get();
        return view('role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:'.config('permission.table_name.roles', 'roles').',name'
        ]);
        
        $role = Role::create($request->all());

        // jika ada permission yang dipilih dalam $request
        if (!empty($request->permissions)) {
            // berikan permission yang dipilih kepada role yang dibuat menggunakan 'givePermissionTo'
            $role->givePermissionTo($request->permissions);
        }

        return redirect()->route('role.index')->with('message', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     * 
    */
    public function show(Role $role)
    {
        // get data permission orderby by name
        $permissions = Permission::orderBy('name')->get();
        // $role->permission merupakan objek role yang ada di db, permission merupkan attribute yang barisi permission yg dimilikki oleh role dalam format JSON
        // json_decode untuk mengurai JSON menjadi array asosiatif yg dapat diakses
        // array column untuk mengambil value dari 'id' di setiap array, sehingga hanya menghasilkan array yang berisi 'ID' dari permission yang dimilikki oleh role
        $roleHasPermissions = array_column(json_decode($role->permissions, true), 'id');
        return view('role.show', compact('role', 'permissions', 'roleHasPermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        // get data permission orderby by name
        $permissions = Permission::orderBy('name')->get();
        // $role->permission merupakan objek role yang ada di db, permission merupkan attribute yang barisi permission yg dimilikki oleh role dalam format JSON
        // json_decode untuk mengurai JSON menjadi array asosiatif yg dapat diakses
        // array column untuk mengambil value dari 'id' di setiap array, sehingga hanya menghasilkan array yang berisi 'ID' dari permission yang dimilikki oleh role
        $roleHasPermissions = array_column(json_decode($role->permissions, true), 'id');
        return view('role.edit', compact('role', 'permissions', 'roleHasPermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:'.config('permission.table_names.roles', 'roles').',name,'.$role->id,
        ]);

        $role->update([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);
        // mengambil input permission yang dipilih, jika tidak ada, maka $permission akan diisi array kosong
        $permissions = $request->permissions ?? [];
        // sync permission yang dicheck dan di uncheck
        $role->syncPermissions($permissions);
        return redirect()->route('role.index')->with('message', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('role.index')->with('message', 'Role deleted successfully');
    }
}
