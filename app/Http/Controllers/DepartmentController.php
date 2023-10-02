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
        if ($request()->has('search')) {
            $departments->where('name', 'Like', '%' . request()->input('search') . '%');
        }

        if ($request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $departments->orderBy($attribute, $sort_order);
        }
    }
}
