@extends('layouts.master')

@section('main_content')
	<section class="content">
		<div class="container">
			<h5>Cart</h5>
			<br />
			@if(!empty($cart))
			<table class="table table-bordered">
		  	<thead>
		  	 <tr> 
		  	 		<th style="width:50px;text-align:center;    vertical-align: middle;">#</th> 
		  	 		<th style="width:200px;text-align:center;    vertical-align: middle;">Product</th> 
		  	 		<th style="vertical-align: middle;">Name</th> 
		  	 		<th style="vertical-align: middle;">Price</th>
		  	 		<th style="width:100px;    vertical-align: middle;"></th> 
		  	 </tr>
		  	 <tbody>
		  	 	<?php $i = 1; $price = 0; ?>
		  	 	@foreach($cart as $k=>$v)
		  	 		<tr>
		  	 			<th style="width:50px;text-align:center;vertical-align: middle">{{$i}}</th>
		  	 			<th style="vertical-align: middle;"><img style="width:180px;" src="{{URL::to('/').str_replace('..', '',$v->image)}}"></th>
		  	 			<th style="vertical-align: middle;"><a target="_blank" href="{{url('catalog', $parameters = [$v->id, str_slug($v->title, '-').'.html'], $secure = null)}}">{{$v->title}}</a></th>
		  	 			<th style="vertical-align: middle;">$ {{$v->price}}</th>
		  	 			<th style="vertical-align: middle;"></th>
		  	 		</tr>	
		  	 	<?php $i++; $price = $price + $v->price; ?>	
		  	 	@endforeach
		  	 	<tr>
		  	 		<th colspan="3"></th>
		  	 		<th class="text-right" style="vertical-align: middle;"> Total </th>
		  	 		<th class="text-left" style="vertical-align: middle;">$ {{$price}} </th>
		  	 	</tr>
		  	 	<tr>
		  	 		<th colspan="3"></th>
		  	 		<th colspan="2" class="text-right" style="vertical-align: middle;">
		  	 			<a href="{{url('catalog/empty_cart', $parameters = [], $secure = null)}}" class="btn-empty">Empty Cart</a>
		  	 			<a href="#" class="btn-checkout">Checkout</a>
		  	 		</th>
		  	 	</tr>
		  	 </tbody> 
		  	</thead>
			</table>
			@else
			<h6>Empty cart !</h6>
			<br />
			<a href="{{url('/', $parameters = [], $secure = null)}}" class="btn-checkout">Continue</a>
			@endif
		</div>
	</section>
@endsection