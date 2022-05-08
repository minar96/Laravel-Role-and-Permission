@extends('errors.errors_layout')

@section('title')
	500-Internal Server Error
@endsection

@section('error-content')
	<h2>500</h2>
	<p>Internal Server Error!! Just Wait</p>
	<a href="{{ route('admin.index') }}">Back to Dashboard</a>
	<a href="{{ route('admin.login') }}">Again Login</a>
@endsection