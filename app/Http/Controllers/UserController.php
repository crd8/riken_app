<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role as OriginalRole;
use Spatie\Permission\Models\Permission as OriginalPermission;

class UserController extends Controller
{
    /**
     * construc user
    */
    function __construct()
    {
        $this->middleware('can:user list', ['only' => ['index', 'show']]);
        $this->middleware('can:user create', ['only' => ['create', 'store']]);
        $this->middleware('can:user edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:user delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $users = (new User)->newQuery();

        if (request()->has('search')) {
            $searchTerm = '%' . request()->input('search') . '%';
            $users->where(function($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                      ->orWhere('email', 'like', $searchTerm)
                      ->orWhereHas('department', function ($query) use ($searchTerm) {
                          $query->where('name', 'like', $searchTerm);
                      });
            });
        }

        $sort = request()->query('sort', 'name');
        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $users->orderBy($attribute, $sort_order);
        }

        $order = request()->query('order', 'latest');
        if ($order === 'oldest') {
            $users->oldest('created_at');
        } else {
            $users->latest('created_at');
        }

        $users = $users->with('department')->paginate(10);
        $currentPage = $users->currentPage();
        $perPage = $users->perPage();
        $startNumber = ($currentPage - 1) * $perPage + 1;

        return view('user.index', compact('users', 'sort', 'order', 'startNumber'));
        
        // $users = (new User)->newQuery();
        // if (request()->has('search')) {
        //     $searchTerm = '%' . request()->input('search') . '%';
        //     $users->where(function($query) use ($searchTerm) {
        //         $query->where('name', 'like', $searchTerm)
        //               ->orWhere('email', 'like', $searchTerm)
        //               ->orWhere('department_id', 'like', $searchTerm);
        //     });
        // }
        // // if (request()->has('search')) {
        // //     $users->where('name', 'Like', '%' . request()->input('search') . '%')->orWhere('email', 'Like', '%' . request()->input('search') . '%' );
        // // }

        // $sort = request()->query('sort', 'name');
        // if (request()->query('sort')) {
        //     $attribute = request()->query('sort');
        //     $sort_order = 'ASC';
        //     if (strncmp($attribute, '-', 1) === 0) {
        //         $sort_order = 'DESC';
        //         $attribute = substr($attribute, 1);
        //     }
        //     $users->orderBy($attribute, $sort_order);
        // }

        // $order = request()->query('order', 'latest');
        // if ($order === 'oldest') {
        //     $users->oldest('created_at');
        // } else {
        //     $users->latest('created_at');
        // }

        // $users = $users->paginate(10);
        // return view('user.index', compact('users', 'sort', 'order'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $departments = Department::all();
        return view('user.create', compact('roles', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department_id' => $request->department
        ]);

        if (!empty($request->roles)) {
            $user->assignRole($request->roles);
        }

        return redirect()->route('user.index')->with('message', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $roles = Role::all();
        $departments = Department::all();
        $userHasRoles = array_column(json_decode($user->roles, true), 'id');
        return view('user.show', compact('user', 'roles', 'userHasRoles','departments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $departments = Department::all();
        $userHasRoles = array_column(json_decode($user->roles, true), 'id');
        return view('user.edit', compact('user', 'roles', 'userHasRoles', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'department' => ['required']
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'department_id' => $request->department
        ]);
        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $roles = $request->roles ?? [];
        $user->syncRoles($roles);
        return redirect()->route('user.index')->with('message', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('message', 'User deleted successfully');
    }
}
