@extends('layouts.master')

@section('main_content')
	<section class="form-customer-light">
		<div class="container">
			<div class="section-inner" >
				<h1 class="contactUs-title">{{$heading_contact_title}}</h1>
			</div>
			<div class="col-sm-8 no-padding-left">
				{!! $module_customer_contact_form !!}
			</div>
			<div class="col-sm-4 border-left contactInfo">
				{!! $module_address !!}
				{!! $module_social_media !!}
			</div>
		</div>
	</section>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ asset('public/css/customer-form.css') }}" />
@endsection