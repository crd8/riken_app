<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    function __construct()
    {
        $this->middleware('can:area list', ['only' => ['index', 'show']]);
        $this->middleware('can:area create', ['only' => ['create', 'store']]);
        $this->middleware('can:area edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:area delete', ['only' => ['destroy']]);
    }

    /**
     * show data areas
     * search using column name
     * sort by name and latest or oldest
    */
    public function index()
    {
        $areas = (new Area)->newQuery();
        if (request()->has('search')) {
            $areas->where('name', 'Like', '%' . request()->input('search') . '%');
        }

        $sort = request()->query('sore', 'name');
        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sortOrder = 'ASC' ;
            if (strncmp($attribute, '-', 1) === 0) {
                $sortOrder = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $areas->orderBy($attribute, $sortOrder);
        }

        $order = request()->query('order', 'latest');
        if ($order === 'oldest') {
            $areas->oldest('created_at');
        } else {
            $areas->latest('created_at');
        }

        $areas = $areas->paginate(10);
        
    }
}
