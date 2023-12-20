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

    public function show(Location $location)
    {
        $areas = Area::all();
        return view('location.show', compact('location', 'areas'));
    }

    public function edit(Location $location)
    {
        $areas = Area::all();
        return view('location.edit', compact('location', 'areas'));
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'code' => ['required', 'string', 'max:15', 'unique:areas,code', 'unique:locations,code'],
            'name' => ['required', 'string', 'max:35', 'unique:locations,name'],
            'description' => ['required', 'string'],
            'area_id' => ['required'],
        ]);

        $location->update([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'area_id' => $request->area_id
        ]);

        return redirect()->route('location.index')->with('message', "<span class='uppercase text-sky-600 font-semibold'>Information</span>: data has been successfully updated.");
    }

    public function destroy(Location $location)
    {
        $nameLocation = $location->name;
        $location->delete();
        return redirect()->route('location.index')->with('message', "<span class='uppercase text-sky-600 font-semibold'>Information</span>: The data with the name <span class='uppercase text-gray-700 dark:text-gray-200 font-semibold'>{$nameLocation}</span> has been archived: Open the archive to view or restore it.");
    }

    public function trash()
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

        $locations = $locations->onlyTrashed()->paginate(10);
        $currentPage = $locations->currentPage();
        $perPage = $locations->perPage();
        $startNumber = ($currentPage - 1) * $perPage + 1;

        return view('location.trash', compact('locations', 'sort', 'order', 'startNumber'));
    }

    public function restore($id)
    {
        $location = Location::withTrashed()->Find($id);
        $nameLocation = $location->name;

        if ($location) {
            $location->restore();
            return redirect()->route('location.index')->with('message', "<span class='uppercase text-sky-600 font-semibold'>Information</span>: The data with the name <span class='uppercase text-gray-700 dark:text-gray-200 font-semibold'>{$nameLocation}</span> has been restored, data is now active again in the system.");
        }
    }

    public function destroyPermanently($id)
    {
        $location = Location::withTrashed()->find($id);
        $nameLocation = $location->name;

        if ($location) {
            $location->forceDelete();
            return redirect()->route('location.trash')->with('message', "<span class='uppercase text-sky-600 font-semibold'>Information</span>: The data with the name <span class='uppercase text-gray-700 dark:text-gray-200 font-semibold'>{$nameLocation}</span> has been permanently deleted.");
        }
    }
}