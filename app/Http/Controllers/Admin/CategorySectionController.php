<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Model\CategorySection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategorySectionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data['category_section'] = CategorySection::all();
    return view('admin.category_section.index', $data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $data['categories'] = Category::where('status', 1)->get();
    return view('admin.category_section.create', $data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // dd($request->all());
    $this->checkPermission(['admin']);
    $request->validate([
      'name'           => 'required|max:255',
      'image'          => 'nullable|image|mimes:jpeg,png,jpg|max:512',
      'position'       => 'required|unique:category_sections,section_position',
      'category_id'  => 'required',
      'status'         => 'required',
    ]);

    $fileUrl = null;

    if ($request->hasFile('image')) {
      $filename = Rand() . '.' . $request->image->getClientOriginalExtension();
      $fileUrl  = $request->image->storeAs('images/category_section', $filename, 'public');
    }

    $CategorySection = CategorySection::create([
      'name'        => $request->input('name'),
      'image'       => $fileUrl,
      'section_position'    => $request->input('position'),
      'category_id' => $request->input('category_id'),
      'status'      => $request->input('status'),
    ]);
    $message = 'CategorySection Created Successfully';
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
    $data['categories'] = Category::where('status', 1)->get();
    $data['cat_section'] = CategorySection::find($id);
    return view('admin.category_section.edit', $data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request,$id)
  {

    $request->validate([
      'name'           => 'required|max:255',
      'image'          => 'nullable|image|mimes:jpeg,png,jpg|max:512',
      'position'       => 'required',
      'category_id'  => 'required',
      'status'         => 'required',
    ]);

    $categorySection = CategorySection::find($id);
    $fileUrl = $categorySection->image;

    if ($request->hasFile('image')) {
      $filePath = 'storage/' . $categorySection->image;
      if (File::exists($filePath)) {
        File::delete($filePath);
      }

      $filename = Rand() . '.' . $request->image->getClientOriginalExtension();
      $fileUrl  = $request->image->storeAs('images/category_section', $filename, 'public');
    }

    $categorySection->update([
      'name'              => $request->input('name'),
      'image'             => $fileUrl,
      'section_position'  => $request->input('position'),
      'category_id'       => $request->input('category_id'),
      'status'            => $request->input('status'),
    ]);
    $message = 'CategorySection Updated Successfully';
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

    $categorySection = CategorySection::find($id);
    $filePath = 'storage/' . $categorySection->image;
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $categorySection->delete();

        return redirect()->back()->with('Smsg', 'Delete Successful.!');
  }
}
