<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Area;

class LocationController extends Controller
{
    /**
     * construct permission
    */
    function __construct()
    {
        $this->middleware('can:location list', ['only' => ['index', 'show']]);
        $this->middleware('can:location create', ['only' => ['create', 'store']]);
        $this->middleware('can:location edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:location delete', ['only' => ['destroy']]);
    }

    /**
     * list of location
    */
    public function index()
    {
        $locations = (new Location)->newQuery();
        
        if (request()->has('search')) {
            $searchTerm = request()->input('search');
            $locations->where(function ($query) use ($searchTerm) {
                $query->where('name', 'Like', '%' . $searchTerm . '%')->orWhere('area_id', 'Like', '%' . $searchTerm . '%');
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
            $locations->orderBy($attribute, $sort_order);
        }

        $order = request()->query('order', 'latest');
        if ($order === 'oldest') {
            $locations->oldest('created_at');
        } else {
            $locations->latest('created_at');
        }

        $locations = $locations->with('area')->paginate(10);
        $currentPage = $locations->currentPage();
        $perPage = $locations->perPage();
        $startNumber = ($currentPage - 1) * $perPage + 1;

        return view('location.index', compact('locations', 'sort', 'order', 'startNumber'));
    }

    /**
     * show form create location
    */
    public function create()
    {
        $areas = Area::all();
        return view('location.create', compact('areas'));
    }

    /**
     * store data location to db
    */
    public function store(Request $request)
    {
        // dd($request->all());
        // Pengecekan nilai area_id
    // if (!$request->has('area_id')) {
    //     dd('area_id is not present in the request');
    // }
        $request->validate([
            'code' => ['required', 'string', 'max:15', 'unique:areas,code', 'unique:locations,code'],
            'name' => ['required', 'string', 'max:35', 'unique:locations,name'],
            'description' => ['required', 'string'],
            'area_id' => ['required'],
        ]);

        $location = Location::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'area_id' => $request->area_id
        ]);

        return redirect()->route('location.index')->with('message', "<span class='uppercase text-sky-600 font-semibold'>Information</span>: New data has been successfully created.");
    }
}
