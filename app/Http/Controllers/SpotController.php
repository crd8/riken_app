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
        $locations = Location::where('area_id', $id)->pluck('name', 'id');
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

        $spots = $spots->with('areas', 'locations')->paginate(10);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Spot $spot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spot $spot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spot $spot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spot $spot)
    {
        //
    }
}
