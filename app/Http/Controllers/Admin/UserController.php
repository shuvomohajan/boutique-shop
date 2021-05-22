<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $this->checkPermission(['admin', 'user.all', 'user.view', 'user.edit', 'user.delete', 'publisher.all', 'publisher.edit', 'publisher.view', 'publisher.delete', 'author.all', 'author.edit', 'author.view', 'author.delete']);
    $users = User::all();
    return response()->view('admin.userManagement.index', compact('users'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $this->checkPermission(['admin', 'user.all', 'user.add', 'author.all', 'publisher.all', 'publisher.add', 'author.add']);
    $type = request()->input('type') ?? 'user';
    if ($type === 'tailor' || $type === 'user') {
      return response()->view('admin.userManagement.create', compact('type'));
    }
    abort(404);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(Request $request)
  {
    $this->checkPermission(['admin', 'user.all', 'user.add', 'author.all', 'publisher.all', 'publisher.add', 'author.add']);
    $request->validate([
      'name'        => 'required|max:255',
      'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:512',
      'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:512',
      'email'       => 'required|unique:users,email|email',
      'password'    => 'required|string|min:8|confirmed',
      'mobile'      => 'nullable',
      'phone'       => 'nullable',
      'about'       => 'nullable',
      'status'      => 'required',
      'type'        => 'required',
    ]);

    $fileUrl = null;
    $fileUrlCoverImage = null;

    if ($request->hasFile('image')) {
      $fileUrl = Rand() . '.' . $request->image->getClientOriginalExtension();
      $fileUrl = $request->image->storeAs('images/users', $fileUrl, 'public');
    }
    if ($request->hasFile('cover_image')) {
      $fileUrlCoverImage = Rand() . '.' . $request->cover_image->getClientOriginalExtension();
      $fileUrlCoverImage = $request->cover_image->storeAs('images/users', $fileUrlCoverImage, 'public');
    }

    User::create([
      'name'        => $request->input('name'),
      'email'       => $request->input('email'),
      'password'    => Hash::make($request->input('password')),
      'image'       => $fileUrl,
      'cover_image' => $fileUrlCoverImage,
      'mobile'      => $request->input('mobile'),
      'phone'       => $request->input('phone'),
      'about'       => $request->input('about'),
      'type'        => $request->input('type'),
      'status'      => $request->input('status'),
    ]);

    $message = 'User Created Successfully';
    return back()->with('Smsg', $message);
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
   * @param User $user
   * @return \Illuminate\Http\Response
   */
  public function edit(User $user)
  {
    $this->checkPermission(['admin', 'user.all', 'user.edit', 'author.all', 'publisher.all', 'publisher.edit', 'author.edit']);
    return response()->view('admin.userManagement.edit', compact('user'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param User $user
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(Request $request, User $user)
  {
    $this->checkPermission(['admin', 'user.all', 'user.edit', 'author.all', 'publisher.all', 'publisher.edit', 'author.edit']);
    $request->validate([
      'name'        => 'required|max:255',
      'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:512',
      'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:512',
      'email'       => 'required|email|unique:users,email,' . $user->id,
      'password'    => 'nullable|string|min:8|confirmed',
      'mobile'      => 'nullable',
      'phone'       => 'nullable',
      'about'       => 'nullable',
      'status'      => 'required',
      'type'        => 'required',
    ]);

    $fileUrl = $user->image;
    $fileUrlCoverImage = $user->cover_image;

    if ($request->hasFile('image')) {
      if (File::exists('storage/' . $user->image)) {
        File::delete('storage/' . $user->image);
      }
      $fileUrl = Rand() . '.' . $request->image->getClientOriginalExtension();
      $fileUrl = $request->image->storeAs('images/users', $fileUrl, 'public');
    }

    if ($request->hasFile('cover_image')) {
      if (File::exists('storage/' . $user->cover_image)) {
        File::delete('storage/' . $user->cover_image);
      }
      $fileUrlCoverImage = Rand() . '.' . $request->cover_image->getClientOriginalExtension();
      $fileUrlCoverImage = $request->cover_image->storeAs('images/users', $fileUrlCoverImage, 'public');
    }

    $password = $user->password;
    if($request->input('password')){
      $password = Hash::make($request->input('password'));
    }

    $user->update([
      'name'        => $request->input('name'),
      'email'       => $request->input('email'),
      'password'    => $password,
      'image'       => $fileUrl,
      'cover_image' => $fileUrlCoverImage,
      'mobile'      => $request->input('mobile'),
      'phone'       => $request->input('phone'),
      'about'       => $request->input('about'),
      'type'        => $request->input('type'),
      'status'      => $request->input('status'),
    ]);

    $message = 'User Updated Successfully';
    return back()->with('Smsg', $message);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param User $user
   * @return \Illuminate\Http\RedirectResponse
   * @throws \Exception
   */
  public function destroy(User $user)
  {
    $this->checkPermission(['admin', 'user.all', 'user.delete', 'author.delete', 'publisher.all', 'publisher.delete', 'author.delete']);
    $filePath = 'storage/' . $user->image;
    if (File::exists($filePath)) {
      File::delete($filePath);
    }

    $user->delete();

    return redirect()->back()->with('Smsg', 'Delete Successful.!');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param $id
   * @return \Illuminate\Http\Response
   */
  public function editPassword()
  {
    $user = Auth::user();
    return response()->view('admin.userManagement.updatePassword', compact('user'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function updatePassword(Request $request)
  {
    $request->validate([
      'new_password' => 'required|string|min:8|',
      'password'     => 'required|string|min:8|confirmed',
    ]);

    $user = Auth::user();

    if (Hash::check($request->input('password'), $user->password)) {
      $user->update([
        'password' => Hash::make($request->input('new_password')),
      ]);
      return back()->with('Smsg', 'Password Changed Successfully.');
    }
    return back()->with('Fmsg', 'Old Password Dosn\'t Matched.');
  }
}
