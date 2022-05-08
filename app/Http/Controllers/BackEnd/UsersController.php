<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Hash;

use App\User;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('backend.pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('backend.pages.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validatio data
         $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:users',
            'password' => 'required|min:6',
        ]);

       //user create
         $user =  new User();
         $user->name = $request->name;
         $user->email = $request->email;
         $user->password = Hash::make($request->password);
         $user->save();

         if ($request->roles) {
             $user->assignRole($request->roles);
         }

        session()->flash('success', 'User has been store successfully!!');
        return redirect()->route('admin.users.index');
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
        $user = User::find($id);
        $roles = Role::all();
        return view('backend.pages.users.edit', compact('user','roles'));
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
        $user =  User::find($id);
        //validatio data
         $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:users,email,' .$id,
            'password' => 'nullable|min:6',
        ]);

       //user create
         
         $user->name = $request->name;
         $user->email = $request->email;
         if ($request->password) {
           $user->password = Hash::make($request->password);
         }
         
         $user->save();

         $user->roles()->detach();
         if ($request->roles) {
             $user->assignRole($request->roles);
         }

        session()->flash('success', 'User has been updated successfully!!');
        // return redirect()->route('admin.users.index');
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
  
        $user = User::find($id);
        if (!is_null($user)) {
            $user->delete();
        }
        session()->flash('success', 'User has been deleted successfully!!');
        return back();
    }
}
