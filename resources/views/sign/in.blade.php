@extends('layouts.master')

@section('main_content')

        {{-- Include modules --}}
        {{--@foreach ($modules as $module)
		   {!! $module !!}
		@endforeach--}}
		{{-- End include modules --}}
		<section class="form-customer">
			<div class="container div-customer-form">
				{!! $module_button_login_facebook !!}
		        <div class="hr">
		            <div class="inner">{{ trans('form.text_or')}}</div>
		        </div>
		        <div class="row">
			        {!! $module_customer_login_form !!}
		        </div>
			</div>
		</section>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="{{ asset('public/css/customer-form.css') }}" />
@endsection