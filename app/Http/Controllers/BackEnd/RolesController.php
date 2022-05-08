<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Auth;


use App\User;


class RolesController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function($request, $next){
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('role.view')) {
           abort(403, 'Sorry!! You are unauthorize to access view this role!');
        }

        $roles = Role::all();
        return view('backend.pages.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('role.create')) {
           abort(403, 'Sorry!! You are unauthorize to access create this role!');
        }

        $all_permissions = Permission::all();
        $permission_group = User::getpermissionGroup();
        return view('backend.pages.roles.create', compact('all_permissions', 'permission_group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('role.create')) {
           abort(403, 'Sorry!! You are unauthorize to access create this role!');
        }

        //validatio data
         $request->validate([
            'name' => 'required|max:100|unique:roles'
        ],
        
        [
            'name.required' => 'Please give a vaild and unique role name'
         ]);

        //process data
        $role = Role::create(['name' => $request->name, 'guard_name'=> 'admin']);
        $permissions = $request->input('permissions');
        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }
        session()->flash('success', 'Role has been store successfully!!');
        return back();
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
        if (is_null($this->user) || !$this->user->can('role.edit')) {
           abort(403, 'Sorry!! You are unauthorize to access edit this role!');
        }

        $role = Role::findById($id, 'admin');
        $all_permissions = Permission::all();
        $permission_group = User::getpermissionGroup();
        return view('backend.pages.roles.edit', compact('role','all_permissions', 'permission_group'));
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
        if (is_null($this->user) || !$this->user->can('role.edit')) {
           abort(403, 'Sorry!! You are unauthorize to access edit this role!');
        }

        //validatio data
         $request->validate([
            'name' => 'required|max:100|unique:roles,name,' .$id
        ],
        
        [
            'name.required' => 'Please give a vaild and unique role name'
         ]);

        //process data
         $role = Role::findById($id, 'admin');
        $permissions = $request->input('permissions');
        if (!empty($permissions)) {
            $role->name = $request->name;
            $role->save();
            $role->syncPermissions($permissions);
        }
        session()->flash('success', 'Role has been updated successfully!!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('role.delete')) {
           abort(403, 'Sorry!! You are unauthorize to access delete this role!');
        }
  
        $role = Role::findById($id, 'admin');
        if (!is_null($role)) {
            $role->delete();
        }
        session()->flash('success', 'Role has been deleted successfully!!');
        return back();
    }
}
