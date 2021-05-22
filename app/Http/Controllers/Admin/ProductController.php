<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Tag;
use App\Model\Format;
use App\Model\Feature;
use App\Model\Product;
use App\Model\Subject;
use App\Model\Category;
use App\Model\Language;
use App\Model\ProductTag;
use App\Model\Subcategory;
use Illuminate\Http\Request;
use App\Model\FeatureProducts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $this->checkPermission(['admin', 'product.all', 'product.add', 'product.view', 'product.edit', 'product.delete']);
    $products = Product::all();
    return view('admin.product.index', compact('products'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $this->checkPermission(['admin', 'product.all', 'product.add']);
    $categories = Category::where('status', 1)->get();
    $subjects = Subject::where('status', 1)->get();
    $tags = Tag::where('status', 1)->get();
    $formats = Format::where('status', 1)->get();
    $languages = Language::where('status', 1)->get();
    $features = Feature::where('status', 1)->get();
    $sku = '#' . chr(rand(65, 90)) . date('Y') . intval('0' . rand(1, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9));

    return view('admin.product.create', compact('categories', 'subjects', 'tags', 'formats', 'languages', 'features', 'sku'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(Request $request)
  {
    $this->checkPermission(['admin', 'product.all', 'product.add']);
    // dd($request->all());
    $request->validate([
      'image'             => 'nullable|image|mimes:jpeg,png,jpg|max:512',
      'gallery'           => 'nullable|array',
      'gallery.*'         => 'nullable|image|mimes:jpeg,png,jpg|max:512',
      'social_image'      => 'nullable|image|mimes:jpeg,png,jpg|max:512',
      'name'              => 'required|string|max:255',
      'short_description' => 'nullable|string',
      'full_description'  => 'nullable|string',
      'stock'             => 'required|integer',
      'year'              => 'nullable|integer',
      'page'              => 'nullable|integer',
      'regular_price'     => 'required|integer',
      'sell_price'        => 'nullable|integer',
      'discount'          => 'nullable|integer',
      'category_id'       => 'required|array',
      'category_id.*'     => 'required|string',
      'subcategory_id'    => 'nullable|array',
      'subcategory_id.*'  => 'nullable|string',
      'subject_id'        => 'nullable|integer',
      'format_id'         => 'nullable|integer',
      'language_id'       => 'nullable|integer',
      'tag_id'            => 'nullable|array',
      'tag_id.*'          => 'nullable|string|distinct',
      'features'          => 'nullable|array',
      'features.*'        => 'nullable|integer|distinct|exists:features,id',
      'sku'               => 'nullable|string',
      'seo_key_word'      => 'nullable|array',
      'seo_key_word.*'    => 'nullable|string|distinct',
    ]);

    $filePathSocial_image = null;
    if ($request->hasFile('social_image')) {
      $filePathSocial_image = Rand() . '.' . $request->social_image->getClientOriginalExtension();
      $filePathSocial_image = $request->social_image->storeAs('images/product_img', $filePathSocial_image, 'public');
    }

    $filePath = null;
    if ($request->hasFile('image')) {
      $filePath = Rand() . '.' . $request->image->getClientOriginalExtension();
      $filePath = $request->image->storeAs('images/product_img', $filePath, 'public');
    }

    // dynamic subject entry
    if ($request->input('subject_id') && !Subject::find($request->input('subject_id'))) {
      $newSubject = Subject::create([
        'name' => $request->input('subject_id'),
      ]);
      $request->subject_id = $newSubject->id;
    }

    // dynamic format entry
    if ($request->input('format_id') && !Format::find($request->input('format_id'))) {
      $newFormat = Format::create([
        'name' => $request->input('format_id'),
      ]);
      $request->format_id = $newFormat->id;
    }

    // dynamic language entry
    if ($request->input('language_id') && !Language::find($request->input('language_id'))) {
      $newLanguage = Language::create([
        'name' => $request->input('language_id'),
      ]);
      $request->language_id = $newLanguage->id;
    }

    $keyWords = null;
    if ($request->input('seo_key_word')) {
      foreach ($request->input('seo_key_word') as $keyWord) {
        $keyWords .= $keyWord . ',';
      }
      $request->seo_key_word = $keyWords;
    }

    $photoGallery = null;
    if ($request->hasFile('gallery')) {
      foreach ($request->file('gallery') as $galleryImage) {
        $galleryFile = Rand() . '.' . $galleryImage->getClientOriginalExtension();
        $galleryFile = $galleryImage->storeAs('images/product_img', $galleryFile, 'public');

        $photoGallery .= $galleryFile . ',';
      }
    }

    $product = Product::create([
      'image'             => $filePath,
      'gallery'           => rtrim($photoGallery, ','),
      'social_image'      => $filePathSocial_image,
      'name'              => $request->input('name'),
      'page'              => $request->input('page'),
      'year'              => $request->input('year'),
      'stock'             => $request->input('stock'),
      'regular_price'     => $request->input('regular_price'),
      'sell_price'        => $request->input('sell_price'),
      'discount'          => $request->input('discount'),
      'short_description' => $request->input('short_description'),
      'full_description'  => $request->input('full_description'),
      'format_id'         => $request->format_id,
      'language_id'       => $request->language_id,
      'subject_id'        => $request->subject_id,
      'sku'               => $request->input('sku'),
      'seo_key_word'      => rtrim($request->seo_key_word, ','),
    ]);

    // dynamic tag in product
    foreach ($request->input('category_id') as $category) {
      if (Category::find($category)) {
        $product->Categories()->attach($category);
      } else {
        $newCategory = Category::create([
          'name' => $category,
        ]);
        $product->Categories()->attach($newCategory->id);
      }
    }

    // dynamic tag in product
    if($request->subcategory_id){
      foreach ($request->input('subcategory_id') as $subcategory) {
        if (Subcategory::find($subcategory)) {
          $product->Subcategories()->attach($subcategory);
        } else {
          $newSubcategory = Subcategory::create([
            'name' => $subcategory,
          ]);
          $product->Subcategories()->attach($newSubcategory->id);
        }
      }
    }

    // dynamic tag in product
    $tags = [];
    if($request->input('tag_id')){
      foreach ($request->input('tag_id') as $i => $tag) {
        if (Tag::find($tag)) {
          $tags[$i] = $tag;
        } else {
          $newTag = Tag::create([
            'name' => $tag,
          ]);
          $tags[$i] = $newTag->id;
        }
      }
    }

    if ($tags) {
      foreach ($tags as $tag) {
        ProductTag::create([
          'product_id' => $product->id,
          'tag_id'     => $tag,
        ]);
      }
    }

    // featureProduct add
    if ($request->input('features')) {
      foreach ($request->input('features') as $feature) {
        FeatureProducts::create([
          'feature_id' => $feature,
          'product_id' => $product->id,
        ]);
      }
    }

    return back()->with('Smsg', 'Product Saved Successfully.');
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
  public function edit(Product $product)
  {
    $this->checkPermission(['admin', 'product.all', 'product.edit']);
    $categories = Category::where('status', 1)->get();
    $subjects = Subject::where('status', 1)->get();
    $tags = Tag::where('status', 1)->get();
    $formats = Format::where('status', 1)->get();
    $languages = Language::where('status', 1)->get();
    $oldTags = ProductTag::where('product_id', $product->id)->pluck('tag_id');
    $features = Feature::where('status', 1)->get();
    $oldFeatures = FeatureProducts::where('product_id', $product->id)->pluck('feature_id');

    $old_seo_key_word = collect(explode(',', $product->seo_key_word));
    $old_gallery = collect(explode(',', $product->gallery));

    return view('admin.product.edit', compact('product', 'old_seo_key_word', 'old_gallery', 'categories', 'subjects', 'tags', 'oldTags', 'features', 'oldFeatures', 'formats', 'languages'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param Product $product
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(Request $request, Product $product)
  {
    $this->checkPermission(['admin', 'product.all', 'product.edit']);
    $request->validate([
      'image'             => 'nullable|image|mimes:jpeg,png,jpg|max:512',
      'gallery'           => 'nullable|array',
      'gallery.*'         => 'nullable|image|mimes:jpeg,png,jpg|max:512',
      'social_image'      => 'nullable|image|mimes:jpeg,png,jpg|max:512',
      'name'              => 'required|string|max:255',
      'short_description' => 'nullable|string',
      'full_description'  => 'nullable|string',
      'stock'             => 'required|integer',
      'year'              => 'nullable|integer',
      'page'              => 'nullable|integer',
      'regular_price'     => 'required|integer',
      'sell_price'        => 'nullable|integer',
      'discount'          => 'nullable|integer',
      'category_id'       => 'required|array',
      'category_id.*'     => 'required|string',
      'subcategory_id'    => 'nullable|array',
      'subcategory_id.*'  => 'nullable|string',
      'subject_id'        => 'nullable|integer',
      'format_id'         => 'nullable|integer',
      'language_id'       => 'nullable|integer',
      'tag_id'            => 'nullable|array',
      'tag_id.*'          => 'nullable|string|distinct',
      'features'          => 'nullable|array',
      'features.*'        => 'nullable|integer|distinct|exists:features,id',
      'sku'               => 'nullable|string',
      'seo_key_word'      => 'nullable|array',
      'seo_key_word.*'    => 'nullable|string|distinct',
    ]);

    //initial value old image
    $filePath = $product->image;
    $filePathSocial_image = $product->social_image;

    if ($request->hasFile('image')) {
      if (File::exists('storage/' . $filePath)) {
        File::delete('storage/' . $filePath);
      }

      $filePath = Rand() . '.' . $request->image->getClientOriginalExtension();
      $filePath = $request->image->storeAs('images/product_img', $filePath, 'public');
    }

    if ($request->hasFile('social_image')) {
      if (File::exists('storage/' . $filePathSocial_image)) {
        File::delete('storage/' . $filePathSocial_image);
      }

      $filePathSocial_image = Rand() . '.' . $request->social_image->getClientOriginalExtension();
      $filePathSocial_image = $request->social_image->storeAs('images/product_img', $filePathSocial_image, 'public');
    }

    // dynamic tags in productTags table for one to many
    $oldTags = ProductTag::where('product_id', $product->id)->pluck('tag_id')->toArray();
    $newTags = $request->input('tag_id') ?? [];

    if ($oldTags) {
      $inputTags = $newTags;
      $newTags = array_diff($inputTags, $oldTags);
      $oldDeletes = array_diff($oldTags, $inputTags);
      ProductTag::whereIn('tag_id', $oldDeletes)->delete();
    }

    if ($newTags) {
      foreach ($newTags as $tag) {
        if (!Tag::find($tag)) {
          $newTag = Tag::create([
            'name' => $tag,
          ]);
          $tag = $newTag->id;
        }
        ProductTag::create([
          'product_id' => $product->id,
          'tag_id'     => $tag,
        ]);
      }
    }

    // dynamic features in FeatureProducts table for one to many
    $oldFeatures = FeatureProducts::where('product_id', $product->id)->pluck('feature_id')->toArray();
    $newFeatures = $request->input('features') ?? [];

    if ($oldFeatures) {
      $inputFeatures = $newFeatures;
      $newFeatures = array_diff($inputFeatures, $oldFeatures);
      $oldDeletes = array_diff($oldFeatures, $inputFeatures);
      FeatureProducts::whereIn('feature_id', $oldDeletes)->delete();
    }

    if ($newFeatures) {
      foreach ($newFeatures as $feature) {
        FeatureProducts::create([
          'feature_id' => $feature,
          'product_id' => $product->id,
        ]);
      }
    }

    // dynamic subject entry
    $categories = [];
    foreach ($request->input('category_id') as $i => $category) {
      if (Category::find($category)) {
        $categories[$i] = $category;
      } else {
        $newCategory = Category::create([
          'name' => $category,
        ]);
        $categories[$i] = $newCategory->id;
      }
    }
    $product->Categories()->sync($categories);

    // dynamic subject entry
    if($request->input('subcategory_id')){
      $subcategories = [];
      foreach ($request->input('subcategory_id') as $i => $subcategory) {
        if (Subcategory::find($subcategory)) {
          $subcategories[$i] = $subcategory;
        } else {
          $newSubcategory = Subcategory::create([
            'name' => $subcategory,
          ]);
          $subcategories[$i] = $newSubcategory->id;
        }
      }
      $product->Subcategories()->sync($subcategories);
    }

    // dynamic subject entry
    if ($request->input('subject_id') && !Subject::find($request->input('subject_id'))) {
      $newSubject = Subject::create([
        'name' => $request->input('subject_id'),
      ]);
      $request->subject_id = $newSubject->id;
    }

    // dynamic format entry
    if ($request->input('format_id') && !Format::find($request->input('format_id'))) {
      $newFormat = Format::create([
        'name' => $request->input('format_id'),
      ]);
      $request->format_id = $newFormat->id;
    }

    // dynamic language entry
    if ($request->input('language_id') && !Language::find($request->input('language_id'))) {
      $newLanguage = Language::create([
        'name' => $request->input('language_id'),
      ]);
      $request->language_id = $newLanguage->id;
    }

    $keyWords = null;
    if ($request->input('seo_key_word')) {
      foreach ($request->input('seo_key_word') as $keyWord) {
        $keyWords .= $keyWord . ',';
      }
      $request->seo_key_word = $keyWords;
    }

    $photoGallery = $product->gallery;
    if ($request->hasFile('gallery')) {
      $old_gallery_array = explode(',', $product->gallery);

      foreach ($request->file('gallery') as $key => $galleryImage) {
        $galleryFile = Rand() . '.' . $galleryImage->getClientOriginalExtension();
        $galleryFile = $galleryImage->storeAs('images/product_img', $galleryFile, 'public');

        $old_gallery_array[$key] = $galleryFile;

        $photoGallery = implode(',', $old_gallery_array);
      }
    }

    $product->update([
      'image'             => $filePath,
      'gallery'           => $photoGallery,
      'social_image'      => $filePathSocial_image,
      'name'              => $request->input('name'),
      'page'              => $request->input('page'),
      'year'              => $request->input('year'),
      'stock'             => $request->input('stock'),
      'regular_price'     => $request->input('regular_price'),
      'sell_price'        => $request->input('sell_price'),
      'discount'          => $request->input('discount'),
      'short_description' => $request->input('short_description'),
      'full_description'  => $request->input('full_description'),

      'format_id'      => $request->format_id,
      'language_id'    => $request->language_id,
      'subject_id'     => $request->subject_id,
      'sku'            => $request->input('sku'),
      'seo_key_word'   => rtrim($request->seo_key_word, ','),
    ]);

    return back()->with('Smsg', 'Update Successful.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param Product $product
   * @return \Illuminate\Http\RedirectResponse
   * @throws \Exception
   */
  public function destroy(Product $product)
  {
    $this->checkPermission(['admin', 'product.all', 'product.delete']);
    $filePath = 'storage/' . $product->image;
    if (File::exists($filePath)) {
      File::delete($filePath);
    }

    $product->delete();
    return redirect()->back()->with('Smsg', 'Delete Successfully.');
  }

  public function showStock()
  {
    $products = Product::all();
    return view('admin.stock.index', compact('products'));
  }

  public function updateStock(Request $request, $id)
  {
    $product = Product::find($id);
    if ($product) {
      $product->update([
        'stock' => $request->stock,
      ]);
      return back()->with('Smsg', 'Stock Updated');
    } else {
      return back()->with('Fmsg', 'Product Not Found');
    }
  }

  public function categorySubcategory(Request $request)
  {
    $subcats = Subcategory::query()->whereIn('category_id', $request->category_id)->get();
    echo '<option disabled>Select Sub Category</option>';
    foreach ($subcats as $sub) {
      echo "<option value='" . $sub->id . "'>" . $sub->name . '</option>';
    }
  }
}
