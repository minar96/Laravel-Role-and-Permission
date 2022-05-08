@extends('errors.errors_layout')

@section('title')
	404-Page Not Found
@endsection

@section('error-content')
	<h2>404</h2>
	<p>Access to this resource on the server is denied</p>
	<hr>
	<p class="mt-2">
		{{ $exception->getMessage() }}
	</p>
	<a href="{{ route('admin.index') }}">Back to Dashboard</a>
	<a href="{{ route('admin.login') }}">Again Login</a>
@endsection