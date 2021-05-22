<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Model\FeatureCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class FeatureCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $this->checkPermission(['admin','feature-category.all','feature-category.add','feature-category.view','feature-category.edit','feature-category.delete']);
        $data['featureCategories']= FeatureCategory::all();
        return view('admin.featureCategory.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $this->checkPermission(['admin','feature-category.all','feature-category.add']);
      $data['categories'] = Category::where('status',1)->get();
        return view('admin.featureCategory.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->checkPermission(['admin','feature-category.all','feature-category.add']);
        $request->validate([
            'name'           => 'required|max:255',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg|max:512',
            'category_id'    => 'nullable',
            'status'         => 'required',
        ]);
        // dd($request->all());
        $fileUrl = null;

        if ($request->hasFile('image')) {
            $filename = Rand() . '.' . $request->image->getClientOriginalExtension();
            $fileUrl  = $request->image->storeAs('images/feature_category', $filename, 'public');
        }

        $feature = FeatureCategory::create([
            'name'        => $request->input('name'),
            'category_id' => $request->category_id,
            'image'       => $fileUrl,
            'status'      => $request->input('status'),
        ]);



        $message = 'Feature Category Created Successfully';
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
    public function edit($id)
    {
      $this->checkPermission(['admin','feature-category.all','feature-category.edit']);
      $data['categories'] = Category::where('status',1)->get();
      $data['featureCategory'] = FeatureCategory::find($id);
      return view('admin.featureCategory.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->checkPermission(['admin','feature-category.all','feature-category.edit']);
      $request->validate([
        'name'           => 'required|max:255',
        'image'          => 'nullable|image|mimes:jpeg,png,jpg|max:512',
        'category_id'    => 'nullable',
        'status'         => 'required',
    ]);
    $featureCategory = FeatureCategory::find($id);
    $fileUrl = $featureCategory->image;

    if ($request->hasFile('image')) {
        $filePath = 'storage/' . $featureCategory->image;
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $filename = Rand() . '.' . $request->image->getClientOriginalExtension();
        $fileUrl  = $request->image->storeAs('images/feature_category', $filename, 'public');
      }
      $featureCategory->update([
        'name'     => $request->input('name'),
        'image'    => $fileUrl,
        'category_id'   => $request->category_id,
        'status'   => $request->input('status'),
    ]);
    $message = 'Feature Category Updated Successfully';
        return back()->with('Smsg', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $this->checkPermission(['admin','feature-category.all','feature-category.delete']);
      $featureCategory = FeatureCategory::find($id);
      $filePath = 'storage/' . $featureCategory->image;
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
        $featureCategory->delete();
        return redirect()->back()->with('Smsg', 'Delete Successful.!');

    }
}
