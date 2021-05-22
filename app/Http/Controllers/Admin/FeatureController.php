<?php

namespace App\Http\Controllers\Admin;

use App\Model\Feature;
use App\Model\Product;
use Illuminate\Http\Request;
use App\Model\FeatureProducts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $this->checkPermission(['admin','feature.all','feature.add','feature.view','feature.edit','feature.delete']);
        $features = Feature::all();
        return view('admin.feature.index', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $this->checkPermission(['admin','feature.all','feature.add']);
        $products = Product::where('status', 1)->get();
        return view('admin.feature.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->checkPermission(['admin','feature.all','feature.add']);
        $request->validate([
            'name'           => 'required|max:255',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg|max:512',
            'products_id'    => 'nullable|array',
            'products_id.*'  => 'nullable|string|distinct|exists:products,id',
            'priority'       => 'nullable|integer',
            'status'         => 'required',
        ]);

        $fileUrl = null;

        if ($request->hasFile('image')) {
            $filename = Rand() . '.' . $request->image->getClientOriginalExtension();
            $fileUrl  = $request->image->storeAs('images/feature_image', $filename, 'public');
        }

        $feature = Feature::create([
            'name'        => $request->input('name'),
            'image'       => $fileUrl,
            'priority'    => $request->input('priority'),
            'status'      => $request->input('status'),
        ]);

        if ($request->input('products_id')) {
            foreach ($request->input('products_id') as $product) {
                FeatureProducts::create([
                    'feature_id' => $feature->id,
                    'product_id' => $product,
                ]);
            }
        }

        $message = 'Feature Created Successfully';
        return back()->with('Smsg', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Feature $feature)
    {
      $this->checkPermission(['admin','feature.all','feature.edit']);
        $products       = Product::where('status', 1)->get();
        $oldProducts    = FeatureProducts::where('feature_id', $feature->id)->pluck('product_id');
        return view('admin.feature.edit', compact('feature', 'products', 'oldProducts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feature $feature)
    {
      $this->checkPermission(['admin','feature.all','feature.edit']);
        $request->validate([
            'name'          => 'required|max:255',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg',
            'products_id'   => 'nullable|array',
            'products_id.*' => 'nullable|string|distinct|exists:products,id',
            'priority'      => 'nullable|integer',
            'status'        => 'required',
        ]);

        $fileUrl = $feature->image;

        if ($request->hasFile('image')) {
            $filePath = 'storage/' . $feature->image;
            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            $filename = Rand() . '.' . $request->image->getClientOriginalExtension();
            $fileUrl  = $request->image->storeAs('images/feature_image', $filename, 'public');
        }

        // dynamic product in feature
        $oldProducts    = FeatureProducts::where('feature_id', $feature->id)->pluck('product_id')->toArray();
        $newProducts    = $request->input('products_id') ?? [];

        if ($oldProducts) {
            $inputProducts  = $newProducts;
            $newProducts    = array_diff($inputProducts, $oldProducts);
            $oldDeletes     = array_diff($oldProducts, $inputProducts);
            FeatureProducts::whereIn('product_id', $oldDeletes)->delete();
        }

        if ($newProducts) {
            foreach ($newProducts as $product) {
                FeatureProducts::create([
                    'feature_id' => $feature->id,
                    'product_id' => $product,
                ]);
            }
        }

        $feature->update([
            'name'     => $request->input('name'),
            'image'    => $fileUrl,
            'priority' => $request->input('priority'),
            'status'   => $request->input('status'),
        ]);

        $message = 'Feature Updated Successfully';
        return back()->with('Smsg', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feature $feature)
    {
      $this->checkPermission(['admin','feature.all','feature.delete']);
        $filePath = 'storage/' . $feature->image;
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $feature->delete();

        return redirect()->back()->with('Smsg', 'Delete Successful.!');
    }
}
