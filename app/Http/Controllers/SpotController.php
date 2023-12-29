<?php

namespace App\Http\Controllers;

use App\Models\Spot;
use App\Models\Area;
use App\Models\Location;
use Illuminate\Http\Request;

class SpotController extends Controller
{
    /**
     * construct permission
    */
    function __construct()
    {
        $this->middleware('can:spot list', ['only' => ['index', 'show']]);
        $this->middleware('can:spot create', ['only' => ['create', 'store']]);
        $this->middleware('can:spot edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:spot delete', ['only' => ['destroy']]);
    }

    public function getLocations($id)
    {
        $locations = Location::where('area_id', $id)->select('id', 'name', 'code')->get();
        return response()->json($locations);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spots = (new Spot)->newQuery();

        if (request()->has('search')) {
            $searchTerm = request()->input('search');
            $spots->where(function ($query) use ($searchTerm) {
                $query->where('name', 'Like', '%' . $searchTerm . '%') ->orWhere('location_id', 'Like', '%' . $searchTerm . '%');
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
            $spots->orderBy($attribute, $sort_order);
        }

        $order = request()->query('order', 'latest');
        if ($order === 'oldest') {
            $spots->oldest('created_at');
        } else {
            $spots->latest('created_at');
        }

        $spots = $spots->with('area', 'location')->paginate(10);
        $currentPage = $spots->currentPage();
        $perPage = $spots->perPage();
        $startNumber = ($currentPage - 1) * $perPage + 1;

        return view('spot.index', compact('spots', 'sort', 'order', 'startNumber'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areas = Area::all();
        $locations = Location::all();
        return view('spot.create', compact('areas', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'max:30', 'unique:areas,code', 'unique:locations,code', 'unique:spots,code'],
            'name' => ['required', 'string', 'max:25', 'unique:spots,name'],
            'description' => ['required'],
            'area_id' => ['required'],
            'location_id' => ['required']
        ]);

        $spot = Spot::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'area_id' => $request->area_id,
            'location_id' => $request->location_id
        ]);

        return redirect()->route('spot.index')->with('message', "<span class='uppercase text-sky-600 font-semibold'>Information</span>: New data has been successfully created.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Spot $spot)
    {
        $area = Area::all();
        $location = Location::all();
        return view('spot.show', compact('spot', 'area', 'location'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spot $spot)
    {
        $areas = Area::all();
        $locations = Location::all();
        return view('spot.edit', compact('spot', 'areas', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spot $spot)
    {
        $request->validate([
            'code' => ['required', 'string', 'max:30', 'unique:areas,code', 'unique:locations,code', 'unique:spots,code'],
            'name' => ['required', 'string', 'max:25', 'unique:spots,name'],
            'description' => ['required'],
            'area_id' => ['required'],
            'location_id' => ['required']
        ]);

        $spot->update([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'area_id' => $request->area_id,
            'location_id' => $request->location_id
        ]);

        return redirect()->route('spot.index')->with('message', "<span class='uppercase text-sky-600 font-semibold'>Information</span>: data has been successfully updated.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spot $spot)
    {
        $nameSpot = $spot->name;
        $spot->delete();

        return redirect()->route('spot.index')->with('message', "<span class='uppercase text-sky-600 font-semibold'>Information</span>: The data with the name <span class='uppercase text-gray-700 dark:text-gray-200 font-semibold'>{$nameSpot}</span> has been archived: Open the archive to view or restore it.");
    }

    public function trash()
    {
        $spots = (new Spot)->newQuery();
        if (request()->has('search')) {
            $searchTerm = request()->input('search');
            $spots->where(function ($query) use ($searchTerm) {
                $query->where('name', 'Like', '%' . $searchTerm . '%')->orWhere('location_id', 'Like', '%' . $searchTerm . '%');
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
            $spots->orderBy($attribute, $sort_order);
        }

        $order = request()->query('order', 'latest');
        if ($order === 'oldest') {
            $spots->oldest('created_at');
        } else {
            $spots->latest('created_at');
        }

        $spots = $spots->onlyTrashed()->paginate(10);
        $currentPage = $spots->currentPage();
        $perPage = $spots->PerPage();
        $startNumber = ($currentPage - 1) * $perPage + 1;

        return view('spot.trash', compact('spots', 'sort', 'order', 'startNumber'));
    }

    public function restore($id)
    {
        $spot = Spot::withTrashed()->find($id);
        $nameSpot = $spot->name;

        if ($spot) {
            $spot->restore();
            return redirect()->route('spot.index')->with('message', "<span class='uppercase text-sky-600 font-semibold'>Information</span>: The data with the name <span class='uppercase text-gray-700 dark:text-gray-200 font-semibold'>{$nameSpot}</span> has been restored, data is now active again in the system.");
        }
    }

    public function destroyPermanently($id)
    {
        $spot = Spot::withTrashed()->find($id);
        $nameSpot = $spot->name;

        if ($spot) {
            $spot->forceDelete();
            return redirect()->route('spot.trash')->with('message', "<span class='uppercase text-sky-600 font-semibold'>Information</span>: The data with the name <span class='uppercase text-gray-700 dark:text-gray-200 font-semibold'>{$nameSpot}</span> has been restored, data is now active again in the system.");
        }
    }
}
