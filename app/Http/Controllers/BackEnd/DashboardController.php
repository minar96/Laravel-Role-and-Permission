<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;


use App\Models\Admin;

class DashboardController extends Controller
{
	 public $user;

    public function __construct()
    {
        $this->middleware(function($request, $next){
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index()
    {
    	if (is_null($this->user) || !$this->user->can('dashboard.view')) {
           abort(403, 'Sorry!! You are unauthorize to access view this dashboard!');
        }
        $totla_roles = count(Role::select('id')->get());
        $totla_admins = count(Admin::select('id')->get());
        $totla_permission = count(Permission::select('id')->get());
    	// return view('backend.layouts.master');
    	return view('backend.pages.dashboard.index', compact('totla_roles', 'totla_admins', 'totla_permission'));
    }
}
