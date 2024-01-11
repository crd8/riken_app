<?php

namespace App\Http\Controllers;

use App\Models\AssetCategorie;
use Illuminate\Http\Request;

class AssetCategorieController extends Controller
{

    /**
     * construct permission
    */
    function __construct()
    {
        $this->middleware('can:asset categorie list', ['only' => ['index', 'show']]);
        $this->middleware('can:asset categorie create', ['only' => ['create', 'store']]);
        $this->middleware('can:asset categorie edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:asset categorie delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asset_categories = (new AssetCategorie)->newQuery();

        if (request()->has('search')) {
            $searchTerm = request()->input('search');
            $asset_categories->where(function ($query) use ($searchTerm) {
                $query->where('name', 'Like', '%' . $searchTerm . '%');
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
            $asset_categories->orderBy($attribute, $sort_order);
        }

        $order = request()->query('order', 'latest');
        if ($order === 'oldest') {
            $asset_categories->oldest('created_at');
        } else {
            $asset_categories->latest('created_at');
        }

        $asset_categories = $asset_categories->paginate(10);
        $currentPage = $asset_categories->currentPage();
        $perPage = $asset_categories->perPage();
        $startNumber = ($currentPage - 1) * $perPage + 1;

        return view('asset_categorie.index', compact('asset_categories', 'sort', 'order', 'startNumber'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('asset_categorie.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50', 'unique:asset_categories'],
            'description' => ['required']
        ]);

        AssetCategorie::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('assetcategorie.index')->with('message', "<span class='uppercase text-sky-600 font-semibold'>Information</span>: New data has been successfully created.");
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(AssetCategory $assetCategory)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssetCategorie $assetcategorie)
    {
        return view('asset_categorie.edit', compact('assetcategorie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssetCategorie $assetcategorie)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'description' => ['required']
        ]);

        $assetcategorie->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('assetcategorie.index')->with('message', "<span class='uppercase text-sky-600 font-semibold'>Information</span>: data has been successfully updated.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssetCategorie $assetcategorie)
    {
        $nameAssetCategorie = $assetcategorie->name;
        $assetcategorie->delete();
        return redirect()->route('assetcategorie.index')->with('message', "<span class='uppercase text-sky-600 font-semibold'>Information</span>: The data with the name <span class='uppercase text-gray-700 dark:text-gray-200 font-semibold'>{$nameAssetCategorie}</span> has been archived: Open the archive to view or restore it.");
    }

    /**
     * list data in trash
    */
    public function trash()
    {
        $asset_categories = (new AssetCategorie)->newQuery();
        if (request()->has('search')) {
            $searchTerm = request()->input('search');
            $asset_categories->where(function ($query) use ($searchTerm) {
                $query->where('name', 'Like', '%' . $searchTerm . '%');
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
            $asset_categories->orderBy($attribute, $sort_order);
        }

        $order = request()->query('order', 'latest');
        if ($order === 'oldest') {
            $asset_categories->oldest('created_at');
        } else {
            $asset_categories->latest('created_at');
        }

        $asset_categories = $asset_categories->onlyTrashed()->paginate(10);
        $currentPage = $asset_categories->currentPage();
        $perPage = $asset_categories->perPage();
        $startNumber = ($currentPage - 1) * $perPage + 1;

        return view('asset_categorie.trash', compact('asset_categories', 'sort', 'order', 'startNumber'));
    }

    public function restore($id)
    {
        $asset_categorie = AssetCategorie::withTrashed()->find($id);
        $nameAssetCategorie = $asset_categorie->name;

        if ($asset_categorie) {
            $asset_categorie->restore();
            return redirect()->route('assetcategorie.index')->with('message', "<span class='uppercase text-sky-600 font-semibold'>Information</span>: The data with the name <span class='uppercase text-gray-700 dark:text-gray-200 font-semibold'>{$nameAssetCategorie}</span> has been restored, data is now active again in the system.");
        }
    }

    public function destroyPermanently($id)
    {
        $asset_categorie = AssetCategorie::withTrashed()->find($id);
        $nameAssetCategorie = $asset_categorie->name;

        if($asset_categorie) {
            $asset_categorie->forceDelete();
        }
        return redirect()->route('assetcategorie.trash')->with('message', "<span class='uppercase text-sky-600 font-semibold'>Information</span>: The data with the name <span class='uppercase text-gray-700 dark:text-gray-200 font-semibold'>{$nameAssetCategorie}</span> has been permanently deleted.");
    }
}
