<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * construct permissions
    */
    function __construct()
    {
        $this->middleware('can:department list', ['only' => ['index', 'show']]);
        $this->middleware('can:department create', ['only' => ['create', 'store']]);
        $this->middleware('can:department edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:department delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $departments = (new Department)->newQuery();
        if (request()->has('search')) {
            $searchTerm = request()->input('search');
            $departments->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('code', 'like', '%' . $searchTerm . '%');
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
            $departments->orderBy($attribute, $sort_order);
        }

        $order = request()->query('order', 'latest');
        if ($order === 'oldest') {
            $departments->oldest('created_at');
        } else {
            $departments->latest('created_at');
        }

        $departments = $departments->paginate(10);
        $currentPage = $departments->currentPage();
        $perPage = $departments->perPage();
        $startNumber = ($currentPage - 1) * $perPage + 1;

        return view('department.index', compact('departments', 'sort', 'order', 'startNumber'));   
    }

    /**
     * show form create department
    */
    public function create()
    {
        return view('department.create');
    }

    /**
     * Store data to DB
    */
    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:departments'],
            'name' => ['required', 'string', 'max:90', 'unique:departments'],
            'description' => ['required', 'string'],
        ]);

        Department::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('department.index')->with('message', "<span class='uppercase text-sky-600 font-semibold'>Information</span>: New data has been successfully created.");
    }

    /**
     * show department
    */
    public function show(Department $department)
    {
        return view('department.show', compact('department'));
    }

    /**
     * Show edit form department
    */
    public function edit(Department $department)
    {
        return view('department.edit', compact('department'));
    }

    /**
     * update data department
    */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'code' => ['required', 'string', 'max:50'],
            'name' => ['required', 'string', 'max:90'],
            'description' => ['required', 'string']
        ]);

        $oldDepartmentName = $department->name;

        $department->update([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('department.index')->with('message', "<span class='uppercase text-sky-600 font-semibold'>Information</span>: data has been successfully updated.");
    }

    /**
     * remove department
    */
    public function destroy(Department $department)
    {
        $nameDepartment = $department->name;
        $department->delete();
        return redirect()->route('department.index')->with('message', "<span class='uppercase text-sky-600 font-semibold'>Information</span>: The data with the name <span class='uppercase text-gray-700 dark:text-gray-200 font-semibold'>{$nameDepartment}</span> has been archived: Open the archive to view or restore it.");
    }

    /**
     * list data trashed
    */
    public function trash()
    {
        $departments = (new Department)->newQuery();
        if (request()->has('search')) {
            $departments->where('name', 'Like', '%' . request()->input('search') . '%');
        }
        
        $order = request()->query('order', 'latest');

        if ($order === 'oldest') {
            $departments->oldest('deleted_at');
        } else {
            $departments->latest('deleted_at');
        }

        $departments = $departments->onlyTrashed()->paginate(10);
        
        $currentPage = $departments->currentPage();
        $perPage = $departments->perPage();
        $startNumber = ($currentPage - 1) * $perPage + 1;

        return view('department.trash', compact('departments', 'order', 'startNumber'));
    }

    public function restore($id)
    {
        $department = Department::withTrashed()->find($id);
        $nameDepartment = $department->name;

        if ($department) {
            $department->restore();
            return redirect()->route('department.index')->with('message', "<span class='uppercase text-sky-600 font-semibold'>Information</span>: The data with the name <span class='uppercase text-gray-700 dark:text-gray-200 font-semibold'>{$nameDepartment}</span> has been restored, data is now active again in the system.");
        }
    }

    public function destroyPermanently($id)
    {
        $department = Department::withTrashed()->find($id);
        $nameDepartment = $department->name;

        if ($department) {
            $department->forceDelete();
            return redirect()->route('department.trash')->with('message', "<span class='uppercase text-sky-600 font-semibold'>Information</span>: The data with the name <span class='uppercase text-gray-700 dark:text-gray-200 font-semibold'>{$nameDepartment}</span> has been permanently deleted.");
        }

    }
}
