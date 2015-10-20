@extends('layouts.master')

@section('main_content')
	<section class="form-customer">
			<div class="container div-customer-form">
		        <div class="row">
			      {!! $module_customer_forgot_form !!}  
		        </div>
			</div>
	</section>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ asset('public/css/customer-form.css') }}" />
@endsection