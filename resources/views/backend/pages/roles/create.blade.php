@extends('backend.layouts.master')

@section('title')
	Create Role Page ~ Admin Panel
@endsection


@section('style')
	<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>
@endsection

@section('admin-content')
{{-- <div>Dashboard</div> --}}
<!-- page title area start -->
	<div class="page-title-area">
	    <div class="row align-items-center">
	        <div class="col-sm-6">
	            <div class="breadcrumbs-area clearfix">
	                <h4 class="page-title pull-left">Role Create</h4>
	                <ul class="breadcrumbs pull-left">
	                   <li><a href="{{ route('admin.index') }}">Dashboard</a></li>
	                    <li><a href="{{ route('admin.roles.index') }}">All Roles</a></li>
	                    <li><span> Create Roles</span></li>
	                </ul>
	            </div>
	        </div>
	        <div class="col-sm-6 clearfix">
	           @include('backend.layouts.partials.logout')
	        </div>
	    </div>
	</div>
	<!-- page title area end -->
	<!-- main content area start -->
	<div class="main-content-inner">
	    <div class="row">
	        <!-- data table start -->
	        <div class="col-12 mt-5">
	            <div class="card">
	                <div class="card-body">
	           		@include('backend.layouts.partials.message')

	                   <h4 class="header-title">Create New Role</h4>
	                   <form action="{{ route('admin.roles.store') }}" method="POST">
	                   		@csrf
	                       <div class="form-group">
	                           <label for="name">Role Name</label>
	                           <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" placeholder="Enter a Role name">
	                       </div>

	                       
	                       	<div class="form-group">
	                       		<div class="form-check">
									<input type="checkbox" class="form-check-input" id="CheckPermissionAll" value="1">
									<label class="form-check-label" for="CheckPermissionAll">Select All Permission</label>
		                       	</div>
	                       		<hr>
	                       	    <label for="name">All Permission</label>

	                       	    @php $i = 1; @endphp
                            @foreach ($permission_group as $group)
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="{{ $i }}Management" value="{{ $group->name }}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)">
                                            <label class="form-check-label" for="checkPermission">{{ $group->name }}</label>
                                        </div>
                                    </div>

                                    <div class="col-9 role-{{ $i }}-management-checkbox">
                                        @php
                                            $permissions = App\User::getpermissionsByGroupName($group->name);
                                            $j = 1;
                                        @endphp
                                        @foreach ($permissions as $permission)
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}">
                                                <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>
                                            @php  $j++; @endphp
                                        @endforeach
                                        <br>
                                    </div>

                                </div>
                                @php  $i++; @endphp
                            @endforeach
	                       	   
	                       	</div>
	                      
	                       <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Role</button>
	                   </form>
	                </div>
	            </div>
	        </div>
	        <!-- data table end -->
	    </div>
	</div>
	<!-- main content area end -->
@endsection

@section('scripts')
	@include('backend.pages.roles.partials.scripts')
@endsection