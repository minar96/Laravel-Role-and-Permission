@extends('backend.layouts.master')

@section('title')
	Dashboard Page ~ Admin Panel
@endsection

@section('admin-content')
{{-- <div>Dashboard</div> --}}
<!-- page title area start -->
	<div class="page-title-area">
	    <div class="row align-items-center">
	        <div class="col-sm-6">
	            <div class="breadcrumbs-area clearfix">
	                <h4 class="page-title pull-left">Dashboard</h4>
	                <ul class="breadcrumbs pull-left">
	                    <li><a href="index.html">Home</a></li>
	                    <li><span>Dashboard</span></li>
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
	    	<!-- seo fact area start -->
	    	<div class="col-lg-8">
	    	    <div class="row">
	    	        <div class="col-md-6 mt-5 mb-3">
	    	            <div class="card">
	    	                <div class="seo-fact sbg1">
	    	                    <div class="p-4 d-flex justify-content-between align-items-center">
	    	                        <div class="seofct-icon"><i class="fa fa-users"></i>Role</div>
	    	                        <h2>{{ $totla_roles }}</h2>
	    	                    </div>
	    	                    <canvas id="seolinechart1" height="50"></canvas>
	    	                </div>
	    	            </div>
	    	        </div>
	    	        <div class="col-md-6 mt-md-5 mb-3">
	    	            <div class="card">
	    	                <div class="seo-fact sbg2">
	    	                    <div class="p-4 d-flex justify-content-between align-items-center">
	    	                        <div class="seofct-icon"><i class="fa fa-user"></i> Admin</div>
	    	                        <h2>{{ $totla_admins }}</h2>
	    	                    </div>
	    	                    <canvas id="seolinechart2" height="50"></canvas>
	    	                </div>
	    	            </div>
	    	        </div>
	    	        <div class="col-md-6 mb-3 mb-lg-0">
	    	            <div class="card">
	    	                <div class="seo-fact sbg3">
	    	                    <div class="p-4 d-flex justify-content-between align-items-center">
	    	                        <div class="seofct-icon"><i class=""></i> Permission</div>
	    	                        <h2>{{ $totla_permission }}</h2>
	    	                    </div>
	    	                        <canvas id="seolinechart3" height="60"></canvas>
	    	                    </div>
	    	                </div>
	    	            </div>
	    	        </div>
	    	    </div>
	    	</div>
	    	<!-- seo fact area end -->
	    </div>
	</div>
	<!-- main content area end -->
@endsection