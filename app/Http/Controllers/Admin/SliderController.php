<?php

namespace App\Http\Controllers\Admin;

use App\Model\Banner;
use App\Model\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\View\View
   */
  public function index()
  {
    $this->checkPermission(['superadmin', 'slider.all', 'slider.add', 'slider.view', 'slider.edit', 'slider.delete']);
    $sliders = Slider::all();
    return view('admin.slider.index', compact('sliders'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $this->checkPermission(['superadmin', 'slider.all', 'slider.add']);
    return response()->view('admin.slider.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(Request $request)
  {
//    dd($request->all());
    $this->checkPermission(['superadmin', 'slider.all', 'slider.add']);
    $request->validate([
      'image'       => 'required|image|mimes:jpeg,png,jpg|max:600',
      'title'       => 'nullable|string|max:255',
      'title_mini'  => 'nullable|string|max:255',
      'button_name' => 'nullable|string|max:255',
      'button_link' => 'nullable|string|max:255',
      'status'      => 'required',
    ]);

    $fileUrl = null;
    if ($request->hasFile('image')) {
      $fileUrl = Rand() . '.' . $request->image->getClientOriginalExtension();
      $fileUrl  = $request->image->storeAs('images/slider_image', $fileUrl, 'public');
    }

    Slider::create([
      'image'       => $fileUrl,
      'title'       => $request->input('title'),
      'title_mini'  => $request->input('title_mini'),
      'button_name' => $request->input('button_name'),
      'button_link' => $request->input('button_link'),
      'status'      => $request->input('status'),
    ]);

    $message = 'Slider Created Successfully';
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
   * @param Slider $slider
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
   */
  public function edit(Slider $slider)
  {
    $this->checkPermission(['superadmin', 'slider.all', 'slider.edit']);
    return view('admin.slider.edit', compact('slider'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param Slider $slider
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(Request $request, Slider $slider)
  {
    $this->checkPermission(['superadmin', 'slider.all', 'slider.edit']);
    $request->validate([
      'image'       => 'required|image|mimes:jpeg,png,jpg|max:600',
      'title'       => 'nullable|string|max:255',
      'title_mini'  => 'nullable|string|max:255',
      'button_name' => 'nullable|string|max:255',
      'button_link' => 'nullable|string|max:255',
      'status'      => 'required',
    ]);

    $fileUrl = $slider->image;

    if ($request->hasFile('image')) {
      $filePath = 'storage/' . $slider->image;
      if (File::exists($filePath)) {
        File::delete($filePath);
      }

      $filename = Rand() . '.' . $request->image->getClientOriginalExtension();
      $fileUrl  = $request->image->storeAs('images/slider_image', $filename, 'public');
    }

    $slider->update([
      'image'       => $fileUrl,
      'title'       => $request->input('title'),
      'title_mini'  => $request->input('title_mini'),
      'button_name' => $request->input('button_name'),
      'button_link' => $request->input('button_link'),
      'status'      => $request->input('status'),
    ]);

    $message = 'Slider Updated Successfully';
    return back()->with('Smsg', $message);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param Slider $slider
   * @return \Illuminate\Http\RedirectResponse
   * @throws \Exception
   */
  public function destroy(Slider $slider)
  {
    $this->checkPermission(['superadmin', 'slider.all', 'slider.delete']);
    $filePath = 'storage/' . $slider->image;
    if (File::exists($filePath)) {
      File::delete($filePath);
    }

    $slider->delete();

    return redirect()->back()->with('Smsg', 'Delete Successfully.!');
  }
  public function bannerIndex()
  {

      $this->checkPermission(['superadmin','slider-all', 'slider.add', 'slider.view', 'slider.edit', 'slider.delete']);
      $data['banner'] = Banner::first();
      return view('admin.banner.ads',$data);
  }
  public function createBanner(Request $request)
  {
    $this->checkPermission(['superadmin','slider-all', 'slider.add', 'slider.view', 'slider.edit', 'slider.delete']);
      $banner = Banner::first();
      $fileUrl1 = isset($banner->banner1) ? $banner->banner1 : null;
      $fileUrl2 = isset($banner->banner2) ? $banner->banner2 : null;
      $fileUrl3 = isset($banner->banner3) ? $banner->banner3 : null;
      $fileUrl4 = isset($banner->banner4) ? $banner->banner4 : null;
      $fileUrl5 = isset($banner->banner5) ? $banner->banner5 : null;
      $fileUrl6 = isset($banner->banner6) ? $banner->banner6 : null;

      if($request->banner1_url){
        $bannerUrl1 = $request->banner1_url;
      }else{
        $bannerUrl1 = isset($banner->banner1_url) ? $banner->banner1_url : null;
      }
      if($request->banner2_url){
        $bannerUrl2 = $request->banner2_url;
      }else{
        $bannerUrl2 = isset($banner->banner2_url) ? $banner->banner2_url : null;
      }
      if($request->banner3_url){
        $bannerUrl3 = $request->banner3_url;
      }else{
        $bannerUrl3 = isset($banner->banner3_url) ? $banner->banner3_url : null;
      }
      if($request->banner4_url){
        $bannerUrl4 = $request->banner4_url;
      }else{
        $bannerUrl4 = isset($banner->banner4_url) ? $banner->banner4_url : null;
      }
      if($request->banner5_url){
        $bannerUrl5 = $request->banner5_url;
      }else{
        $bannerUrl5 = isset($banner->banner5_url) ? $banner->banner5_url : null;
      }
      if($request->banner6_url){
        $bannerUrl6 = $request->banner6_url;
      }else{
        $bannerUrl6 = isset($banner->banner6_url) ? $banner->banner6_url : null;
      }


      if ($request->hasFile('banner1')) {
        $filename = Rand() . '.' . $request->banner1->getClientOriginalExtension();
        $fileUrl1  = $request->banner1->storeAs('images/slider_image', $filename, 'public');
      }
      if ($request->hasFile('banner2')) {
        $filename = Rand() . '.' . $request->banner2->getClientOriginalExtension();
        $fileUrl2  = $request->banner2->storeAs('images/slider_image', $filename, 'public');
      }
      if ($request->hasFile('banner3')) {
        $filename = Rand() . '.' . $request->banner3->getClientOriginalExtension();
        $fileUrl3  = $request->banner3->storeAs('images/slider_image', $filename, 'public');
      }
      if ($request->hasFile('banner4')) {
        $filename = Rand() . '.' . $request->banner4->getClientOriginalExtension();
        $fileUrl4  = $request->banner4->storeAs('images/slider_image', $filename, 'public');
      }
      if ($request->hasFile('banner5')) {
        $filename = Rand() . '.' . $request->banner5->getClientOriginalExtension();
        $fileUrl5  = $request->banner5->storeAs('images/slider_image', $filename, 'public');
      }
      if ($request->hasFile('banner6')) {
        $filename = Rand() . '.' . $request->banner6->getClientOriginalExtension();
        $fileUrl6  = $request->banner6->storeAs('images/slider_image', $filename, 'public');
      }
      $banner = Banner::first();
      if($banner){
        $banner->update([
          'banner1'=> $fileUrl1,
          'banner2'=> $fileUrl2,
          'banner3'=> $fileUrl3,
          'banner4'=> $fileUrl4,
          'banner5'=> $fileUrl5,
          'banner6'=> $fileUrl6,
          'banner1_url'=> $bannerUrl1,
          'banner2_url'=> $bannerUrl2,
          'banner3_url'=> $bannerUrl3,
          'banner4_url'=> $bannerUrl4,
          'banner5_url'=> $bannerUrl5,
          'banner6_url'=> $bannerUrl6,
        ]);
      }else{
        Banner::create([
          'banner1'=> $fileUrl1,
          'banner2'=> $fileUrl2,
          'banner3'=> $fileUrl3,
          'banner4'=> $fileUrl4,
          'banner5'=> $fileUrl5,
          'banner6'=> $fileUrl6,
          'banner1_url'=> $bannerUrl1,
          'banner2_url'=> $bannerUrl2,
          'banner3_url'=> $bannerUrl3,
          'banner4_url'=> $bannerUrl4,
          'banner5_url'=> $bannerUrl5,
          'banner6_url'=> $bannerUrl6,
        ]);

      }
      return redirect()->back();

  }
}
