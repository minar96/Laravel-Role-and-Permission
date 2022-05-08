<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


use App\Models\Admin;


class AdminsController extends Controller
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
        if (is_null($this->user) || !$this->user->can('admin.view')) {
           abort(403, 'Sorry!! You are unauthorize to access view this admin!');
        }

        $admins = Admin::all();
        return view('backend.pages.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('admin.create')) {
           abort(403, 'Sorry!! You are unauthorize to access create this admin!');
        }

        $roles = Role::all();
        return view('backend.pages.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('admin.create')) {
           abort(403, 'Sorry!! You are unauthorize to access create this admin!');
        }

        //validatio data
         $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admins',
            'username' => 'required|max:100|unique:admins',
            'password' => 'required|min:6',
        ]);

       //admin create
         $admin =  new Admin();
         $admin->name = $request->name;
         $admin->username = $request->username;
         $admin->email = $request->email;
         $admin->password = Hash::make($request->password);
         $admin->save();

         if ($request->roles) {
             $admin->assignRole($request->roles);
         }

        session()->flash('success', 'Admin has been store successfully!!');
        return redirect()->route('admin.admins.index');
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
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
           abort(403, 'Sorry!! You are unauthorize to access edit this admin!');
        }

        $admin = Admin::find($id);
        $roles = Role::all();
        return view('backend.pages.admins.edit', compact('admin','roles'));
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
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
           abort(403, 'Sorry!! You are unauthorize to access edit this admin!');
        }

        $admin =  Admin::find($id);
        //validatio data
         $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admins,email,' .$id,
            'password' => 'nullable|min:6',
        ]);

       //admin create
         
         $admin->name = $request->name;
         $admin->email = $request->email;
         $admin->username = $request->username;
         if ($request->password) {
           $admin->password = Hash::make($request->password);
         }
         
         $admin->save();

         $admin->roles()->detach();
         if ($request->roles) {
             $admin->assignRole($request->roles);
         }

        session()->flash('success', 'Admin has been updated successfully!!');
        // return redirect()->route('admin.admins.index');
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
        if (is_null($this->user) || !$this->user->can('admin.delete')) {
           abort(403, 'Sorry!! You are unauthorize to access delete this admin!');
        }
  
        $admin = Admin::find($id);
        if (!is_null($admin)) {
            $admin->delete();
        }
        session()->flash('success', 'Admin has been deleted successfully!!');
        return back();
    }
}
