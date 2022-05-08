@extends('backend.layouts.master')

@section('title')
	Role Page ~ Admin Panel
@endsection


@section('style')
	<!-- Start datatable css -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
	<!-- End datatable css -->
@endsection

@section('admin-content')
{{-- <div>Dashboard</div> --}}
<!-- page title area start -->
	<div class="page-title-area">
	    <div class="row align-items-center">
	        <div class="col-sm-6">
	            <div class="breadcrumbs-area clearfix">
	                <h4 class="page-title pull-left">Roles</h4>
	                <ul class="breadcrumbs pull-left">
	                    <li><a href="{{ route('admin.index') }}">Dashboard</a></li>
	                    <li><span>All Roles</span></li>
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
	                	<p>
	                		<a href="{{ route('admin.roles.create') }} " class="btn btn-primary float-right">
	                			Create New Role
	                		</a>
	                	</p>
	                    <h4 class="header-title">Role List</h4>
	                    <div class="data-tables">
	                        <table id="dataTable" class="text-center">
	                            <thead class="bg-light text-capitalize">
	                                <tr>
	                                    <th>SL No</th>
	                                    <th>Role Name</th>
	                                    <th style="width: 200px;">Permissions</th>
	                                    <th>Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                @foreach($roles as $role)
	                                	<tr>
	                                	    <td>{{ $loop->index+1 }}</td>
	                                	    <td>{{ $role->name }}</td>
	                                	    <td>
	                                	    	@foreach($role->permissions as $perm)
	                                	    		<span class="badge badge-info mr-1">
	                                	    			{{ $perm->name }}
	                                	    		</span>
	                                	    	@endforeach
	                                	    	
	                                	    </td>
	                                	    <td>
	                                	    	@if(Auth::guard('admin')->user()->can('admin.edit'))
	                                	    	<a href="{{ route('admin.roles.edit',$role->id) }}" class="btn btn-success">Edit</a>
	                                	    	@endif

	                                	    	@if(Auth::guard('admin')->user()->can('admin.delete'))
	                                	    	<a class="btn btn-danger" href="{{ route('admin.roles.destroy', $role->id) }}"
	                                	    	   onclick="event.preventDefault();
	                                	    	                 document.getElementById('delete-form-{{ $role->id }}').submit();">
	                                	    	    {{ __('Delete') }}
	                                	    	</a>
	                                	    	@endif

	                                	    	<form id="delete-form-{{ $role->id }}" action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="">
	                                	    		@method('DELETE')
	                                	    	    @csrf
	                                	    	</form>
	                                	    </td>
	                                	</tr>
	                                @endforeach
	                            </tbody>
	                        </table>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <!-- data table end -->
	    </div>
	</div>
	<!-- main content area end -->
@endsection

@section('scripts')
	<!-- Start datatable js -->
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
	<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
	{{-- End datatable js --}}
	<script>
		/*================================
		datatable active
		==================================*/
		if ($('#dataTable').length) {
		    $('#dataTable').DataTable({
		        responsive: true
		    });
		}
		
	</script>
@endsection