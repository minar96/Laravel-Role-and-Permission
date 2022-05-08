@extends('backend.layouts.master')

@section('title')
	Create Admin ~ Admin Panel
@endsection


@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
	                <h4 class="page-title pull-left">Admin Create</h4>
	                <ul class="breadcrumbs pull-left">
	                   <li><a href="{{ route('admin.index') }}">Dashboard</a></li>
	                    <li><a href="{{ route('admin.admins.index') }}">All Admin</a></li>
	                    <li><span> Create Admins</span></li>
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

	                   <h4 class="header-title">Create New Admin</h4>
	                   <form action="{{ route('admin.admins.store') }}" method="POST">
	                   		@csrf
	                   		<div class="form-row">
		                       <div class="form-group col-md-6 col-sm-12">
		                           <label for="name">Admin Name</label>
		                           <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" placeholder="Enter your  name">
		                       </div>

		                       <div class="form-group col-md-6 col-sm-12">
		                           <label for="email">Admin Email</label>
		                           <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter your  email">
		                       </div>

		                       <div class="form-group col-md-6 col-sm-12">
		                           <label for="password">Password</label>
		                           <input type="password" class="form-control" name="password" id="password" aria-describedby="passwordHelp" placeholder="Enter your  password">
		                       </div>

		                       {{-- <div class="form-group col-md-6 col-sm-12">
		                           <label for="password_conformation">Conform Password</label>
		                           <input type="password" class="form-control" name="password_conformation" id="password_conformation" aria-describedby="passwordHelp" placeholder="Enter your conform password">
		                       </div> --}}
	                       </div>

	                       <div class="form-row">
	                       		<div class="form-group col-md-6 col-sm-6">
		                           <label for="password_conformation">Assign Role</label>
		                          <select name="roles[]" id="roles" class="form-control select2" multiple>
			                          	@foreach($roles as $role)
			                          		<option value="{{ $role->name }}">{{ $role->name }}</option>
			                          	@endforeach
		                          </select>
		                       </div>
		                       <div class="form-group col-md-6 col-sm-6">
		                           <label for="username">Admin Username</label>
		                           <input type="username" class="form-control" name="username" id="username" aria-describedby="emailHelp" placeholder="Enter your  Username" required="required">
		                       </div>
	                       </div>
	                       <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Admin</button>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
	$(document).ready(function() {
    	$('.select2').select2();
	});
</script>
	{{-- @include('backend.pages.roles.partials.scripts') --}}
@endsection