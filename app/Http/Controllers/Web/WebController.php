<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Banner;
use App\Model\BlogTag;
use App\Model\Category;
use App\Model\CategorySection;
use App\Model\CustomerSupport;
use App\Model\Division;
use App\Model\Feature;
use App\Model\FeatureCategory;
use App\Model\Post;
use App\Model\PostCategory;
use App\Model\Product;
use App\Model\Slider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WebController extends Controller
{
  public function otpVerification()
  {
    return view('auth.otp_verification');
  }

  public function otpVerificationStore(Request $request)
  {
    if ($request->input('otp_number')) {
      if (auth()->user()->otp_number == $request->input('otp_number')) {
        $user = Auth::user();
        $user->otp_status = 1;
        $user->save();
        return redirect()->route('dashboard');
      }
      return back()->with('error', 'Code not matched.');
    }
  }

  public function index()
  {
    $data['products'] = Product::where('status', 1)->get();
    $data['cat_section1'] = CategorySection::where('status', 1)->where('section_position', 1)->first();
    $data['cat_section2'] = CategorySection::where('status', 1)->where('section_position', 2)->first();
    $data['cat_section3'] = CategorySection::where('status', 1)->where('section_position', 3)->first();
    $data['cat_section4'] = CategorySection::where('status', 1)->where('section_position', 4)->first();
    $data['cat_section5'] = CategorySection::where('status', 1)->where('section_position', 5)->first();
    $data['cat_section6'] = CategorySection::where('status', 1)->where('section_position', 6)->first();
    $data['cat_section7'] = CategorySection::where('status', 1)->where('section_position', 7)->first();
    $data['random'] = Product::where('status', 1)->inRandomOrder()->get();
    $data['features'] = Feature::where('status', 1)->orderBy('priority', 'asc')->get();
    $data['featureCategories'] = FeatureCategory::where('status', 1)->take(3)->get();
    $data['sliders'] = Slider::where('status', 1)->get();
    $data['banner'] = Banner::first();
    $data['topsales'] = Product::with('Reviews')
      ->leftJoin('order_products', 'products.id', '=', 'order_products.product_id')
      ->selectRaw('products.*, COALESCE(sum(order_products.qty),0) total')
      ->groupBy('products.id')
      ->orderBy('total', 'desc')
      ->take(5)
      ->get();
    return view('website.home', $data);
  }

  public function aboutus()
  {
    return view('website.about_us');
  }

  public function faq()
  {
    return view('website.faq');
  }

  public function privacy_policy()
  {
    return view('website.privacy_policy');
  }

  public function terms()
  {
    return view('website.terms');
  }

  public function refund()
  {
    return view('website.refund');
  }

  public function return()
  {
    return view('website.return');
  }

  public function wish_list()
  {
    return view('website.wish_list');
  }

  public function single_product()
  {
    return view('website.single_product');
  }

  public function shop_left_sidebar()
  {
    return view('website.shop_left_sidebar');
  }

  public function product_details()
  {
    return view('website.product_details');
  }

  public function my_account()
  {
    return view('website.my_account');
  }

  public function login_register()
  {
    return view('website.login_register');
  }

  public function compare()
  {
    return view('website.compare');
  }

  public function Checkout()
  {
    if (Session::has('cart') && isset(Session::get('cart')->items)) {
      $divisions = Division::all();
      return view('website.checkout', compact('divisions'));
    }
    return redirect()->to('/')->with('message', 'No Cart Items Found.');
  }

  public function Cart()
  {
    return view('website.cart');
  }

  public function customer_support()
  {
    return view('website.customer_support');
  }

  public function customer_support_store(Request $request)
  {
    $request->validate([
      'name'    => 'required|max:255',
      'email'   => 'required|email',
      'service' => 'required|integer',
      'address' => 'nullable|string',
      'message' => 'required|max:255',
    ]);

    CustomerSupport::create([
      'name'    => $request->input('name'),
      'email'   => $request->input('email'),
      'service' => $request->input('service'),
      'address' => $request->input('address'),
      'message' => $request->input('message'),
    ]);

    return back()->with('message', 'Message Send Successfully.');
  }

  public function all_posts_with_tag($id)
  {
    $items = BlogTag::findOrFail($id);
    $items = $items->Posts()->paginate(10);
    $posts = Post::whereStatus(1)->latest()->take(5)->get();
    $categories = PostCategory::take(6)->get();
    $tags = BlogTag::take(6)->get();
    return view('website.blog.all_posts_with', compact('posts', 'categories', 'tags', 'items'));
  }

  public function all_posts_with_category($id)
  {
    $items = Post::where('category_id', $id)->paginate(10);
    $posts = Post::whereStatus(1)->latest()->take(5)->get();
    $categories = PostCategory::take(6)->get();
    $tags = BlogTag::take(6)->get();
    return view('website.blog.all_posts_with', compact('posts', 'categories', 'tags', 'items'));
  }

  public function all_posts()
  {
    $posts = Post::whereStatus(1)->paginate(10);
    $categories = PostCategory::take(6)->get();
    $tags = BlogTag::take(6)->get();
    return view('website.blog.all_posts', compact('posts', 'categories', 'tags'));
  }

  public function post_details($id)
  {
    $posts = Post::whereStatus(1)->latest()->take(5)->get();
    $post = Post::findOrFail($id);
    return view('website.blog.post_details', compact('post', 'posts'));
  }

  // items means subject publisher author all view
  public function allCategories()
  {
    $data['items'] = Category::where('status', 1)->get();
    $data['type'] = 'category';
    return view('website.allcategories', $data);
  }

  public function allAuthor()
  {
    $data['items'] = User::where('type', 'author')->get();
    $data['type'] = 'author';
    return view('website.allsubjects', $data);
    // items means subject publisher author all view
  }

  public function search(Request $request)
  {
    if ($request->hidden) {
      //this is for search by click
      $data['item'] = (object)['name' => 'You search for : ' . $request->search];
      $cat_id = $request->category_id;
      $data['products'] = Product::query()
        ->when($cat_id != '', function ($query) use ($cat_id) {
          $query->where('category_id', $cat_id);
        })
        ->where('name', 'LIKE', "%{$request->search}%")
        ->paginate(12);
      return view('website.shop_noleft_sidebar', $data);
    } else {
      //this is for search by ajax
      $cat_id = $request->category_id;
      $data['products'] = Product::query()
        ->when($cat_id != '', function ($query) use ($cat_id) {
          $query->where('category_id', $cat_id);
        })
        ->where('name', 'LIKE', "%{$request->search}%")
        ->get();
      return view('website.ajax.search', $data);
    }
  }
}
