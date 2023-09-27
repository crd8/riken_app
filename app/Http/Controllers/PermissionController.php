<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * construct permission
    */
    // __construct() merupakan method khusus yang dijalankan secara otomatis saat object controller dibuat
    function __construct()
    {
        // middleware memeriksa permission user, saat user mencoba mengakses method pada controller
        // user yang memilikki permission permission list hanya bisa mengakses method index dan show pada controller, dst.
        $this->middleware('can:permission list', ['only' => ['index', 'show']]);
        $this->middleware('can:permission create', ['only' => ['create', 'store']]);
        $this->middleware('can:permission edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:permission delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = (new Permission)->newQuery();

        
        if (request()->has('search')) {
            $permissions->where('name', 'Like', '%' . request()->input('search') . '%');
        }

        $sort = request()->query('sort', 'name');
        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $permissions->orderBy($attribute, $sort_order);
        }

        $order = request()->query('order', 'latest');

        if ($order === 'oldest') {
            $permissions->oldest('created_at');
        } else {
            $permissions->latest('created_at');
        }

        $permissions = $permissions->paginate(10);
        return view('permission.index', compact('permissions', 'sort', 'order'))->with('i', (request()->input('page', 1) - 1) * 5);
        
        // get permissions
        // $permissions = Permission::latest()->paginate(10);

        // render view with permissions
        // return view('permission.index', compact('permissions'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // muat tampilan yang diambil dari 'resources/views'
        return view('permission.create');
    }

    /**
     * Store a newly created resource in storage.
     * mengambil data yang dikirimkan melalui form -> validasi -> simpan ke db -> redirect user ke index
    */
    // $request merupakan instance dari class Request
    public function store(Request $request)
    {
        // buat validasi pada inputan
        $request->validate([
            // cek data agar tidak diduplicate, .config adalah folder config pada strukture laravel dalam config permission.php
            'name' => 'required|string|max:255|unique:'.config('permission.table_names.permissions', 'permissions').',name,',
        ]);

        // panggil method create dari model permission, method create sudah disediakan secara default.
        Permission::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);
        // redirect ke page index dan memberika notifikasi sukses
        return redirect()->route('permission.index')->with('message', 'Permission created successfully');
    }

    /**
     * Display the specified resource.
     */
    // menerima $permission yang sebenernya instance dari model 'Permission'
    public function show(Permission $permission)
    {
        return view('permission.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
    */
    // $request sebagai object yang mewakili permintaan hhtpp
    // $permission param yang digunakan untuk mengambil data permission yang akan di update
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:'.config('permission.table_names.permissions', 'permissions').',name,'.$permission->id,
        ]);

        $permission->update([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);

        return redirect()->route('permission.index')->with('message', 'Permission update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permission.index')->with('message', 'Permission deleted successfully');
    }
}
