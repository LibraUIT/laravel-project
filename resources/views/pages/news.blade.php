@extends('layouts.master')

@section('main_content')
	<section class="content">
		<div class="container">
			<!--<div class="section-inner" >
				<h1 class="page404-title">News</h1>
			</div>-->
			@foreach ($modules as $module)
		   	{!! $module !!}
			@endforeach
		</div>
	</section>
@endsection