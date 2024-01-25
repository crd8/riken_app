<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetCategorie;
use App\Models\Spot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{
    /**
     * construct permission
    */
    function __construct()
    {
        $this->middleware('can:asset list', ['only' => ['index', 'show']]);
        $this->middleware('can:asset create', ['only' => ['create', 'store']]);
        $this->middleware('can:asset edit', ['only' => ['edit', ['update']]]);
        $this->middleware('can:asset delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assets = (new Asset)->newQuery();

        if (request()->has('search')) {
            $searchTerm = '%' . request()->input('search') . '%';
            $assets->where(function($query) use ($searchTerm) {
                $query->where('name', 'LIKE', $searchTerm)
                ->orWhere('number', 'LIKE', $searchTerm)
                ->orWhere('owner', 'LIKE', $searchTerm)
                ->orWhereHas('assetcategorie', function ($query) use ($searchTerm) {
                    $query->where('name', 'LIKE', $searchTerm);
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
            $assets->orderBy($attribute, $sort_order);
        }

        $order = request()->query('order', 'latest');
        if ($order === 'oldest') {
            $assets->oldest('created_at');
        } else {
            $assets->latest('created_at');
        }

        $assets = $assets->with('assetcategorie')->paginate(10);
        $currentPage = $assets->currentPage();
        $perPage = $assets->perPage();
        $startNumber = ($currentPage - 1) * $perPage + 1;

        return view('asset.index', compact('assets', 'sort', 'order', 'startNumber'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $assetcategories = AssetCategorie::all();
        $spots = Spot::all();
        return view('asset.create', compact('assetcategories', 'spots'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'number' => ['required', 'string', 'max:30', 'unique:assets'],
            'name' => ['required', 'string'],
            'price' => ['numeric'],
            'status' => ['required', 'string'],
            'owner' => ['required', 'string'],
            'information' => ['nullable', 'string'],
            'photo' => ['required', 'mimes:jpg,jpeg,png', 'max:1024'],
            'assetcategorie_id' => ['required'],
            'spot_id' => ['required']
        ]);

        $photo_path = $request->file('photo')->store('photo_assets', 'public');

        Asset::create([
            'number' => $request->number,
            'name' => $request->name,
            'price' => $request->price,
            'purchase_date' => $request->purchase_date,
            'status' => $request->status,
            'owner' => $request->owner,
            'information' => $request->information,
            'photo' => $photo_path,
            'assetcategorie_id' => $request->assetcategorie_id,
            'spot_id' => $request->spot_id
        ]);

        return redirect()->route('asset.index')->with('message', "<span class='uppercase text-sky-600 font-semibold'>Information</span>: New data has been successfully created.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asset $asset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        //
    }
}
