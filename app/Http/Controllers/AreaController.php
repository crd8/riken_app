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
        $currentPage = $areas->currentPage();
        $perPage = $areas->perPage();
        $startNumber = ($currentPage - 1) * $perPage + 1;

        return view('area.index', compact('areas', 'sort', 'order', 'startNumber'));
    }

    /**
     * show form create area
    */
    public function create()
    {
        return view('area.create');
    }

    /**
     * store data to DB
    */
    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:areas'],
            'name' => ['required', 'string', 'max:90', 'unique:areas'],
            'address' => ['required', 'string']
        ]);

        Area::create([
            'code' => $request->code,
            'name' => $request->name,
            'address' => $request->address
        ]);

        return redirect()->route('area.index')->with('message', "Area {$request->name} created successfully");
    }

    /**
     * show specific area information
    */
    public function show(Area $area)
    {
        return view('area.show', compact('area'));
    }

    /**
     * show edit form
    */
    public function edit(Area $area)
    {
        return view('area.edit', compact('area'));
    }

    /**
     * update data area
    */
    public function update(Request $request, Area $area)
    {
        $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:areas'],
            'name' => ['required', 'string', 'max:90', 'unique:areas'],
            'address' => ['required', 'string']
        ]);

        $oldAreaName = $area->name;

        $area->update([
            'code' => $request->code,
            'name' => $request->name,
            'address' => $request->address
        ]);

        return redirect()->route('area.index')->with('message', "Area {$oldAreaName} successfully updated to {$request->name}");
    }
}
