<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['permissions'] = Permission::all();
        $data['roles'] = Role::all();
        $this->permissions = $data['permissions'];
        return view('admin.role.createRole',$data);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create([
            'name'=>$request->name
        ]);
        $role->syncPermissions($request->permissions);
        return redirect()->back();
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
        $data['oldrole']  = Role::find($id);
        $data['roles'] = Role::all();
        $data['permissions'] = Permission::all();

        return view('admin.role.createRole',$data);

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
        // $role = Role::create([
        //     'name'=>$request->name
        // ]);
        // dd($id,$request->all());
        $role = Role::find($id);
        // dd($role->getPermissionNames());
        $role->revokePermissionTo($role->getAllPermissions());
        $role->update(['name'=> $request->name]);
        $role->syncPermissions($request->permissions);
        Toastr::success('success','Role successfully Updated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        Role::find($id)->delete();
        Toastr::success('success','Role successfully deleted');
        return redirect()->back();
    }
    public function roleAssign()
    {

        $data['users'] = User::all();
        $data['roles'] = Role::all();
        return view('admin.role.roleassign',$data);
    }
    public function storeAssign(Request $request)
    {
        // dd($request->all());
        $user = User::find($request->user);
        $user->syncRoles($request->roles);;
        return redirect()->back();
    }
}
