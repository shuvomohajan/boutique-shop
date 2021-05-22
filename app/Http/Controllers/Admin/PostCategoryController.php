<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\PostCategory;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $this->checkPermission(['admin', 'blog-category.all','blog-category.view','blog-category.delete']);
    $categories = PostCategory::all();
    return view('admin.post.postCategories', compact('categories'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy($id)
  {
    $this->checkPermission(['admin', 'blog-category.all','blog-category.delete']);
    if(PostCategory::findOrFail($id)->delete()){
      return back()->with('Smsg', 'Category Deleted Successfully.');
    }
    return back()->with('Fmsg', 'Category Con\'t Delete.');
  }
}
