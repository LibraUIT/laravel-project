@extends('layouts.master')

@section('main_content')
	<section class="content">
		<div class="container">
			@if (session('message_success'))
			<span class="help-inline"><label for="success_meassage" class="success"><i class="fa fa-exclamation-circle"></i>&nbsp;{{ session('message_success') }}</label></span>
			@endif
			<h5>Your Information</h5>
			<br />
			<b>Fullname : </b> {{$profile->name}}<br />
			<b>Email : </b> {{$profile->email}}<br />
			<br />
			<h5>Your Orders</h5>
			<br />
			@if(!empty($orders))
					<div class="col-sm-8 no-padding">
					<table class="table table-bordered">
				  	<thead>
				  	 <tr> 
				  	 		<th style="width:50px;text-align:center;    vertical-align: middle;">#</th> 
				  	 		<th style="width:200px;text-align:center;    vertical-align: middle;">Order price</th>
				  	 		<th style="vertical-align: middle;text-align:center;">Date created</th>
				  	 		<th style="width:200px;text-align:center;    vertical-align: middle;">Status</th>  
				  	 </tr>
				  	 <tbody>
				  	 	<?php $i = 1; ?>
				  		@foreach($orders as $k => $v)
				  		<?php 
				  			$cart_info = unserialize($v->cart);
				  			$price = 0;
				  			foreach($cart_info as $key => $item)
				  			{
				  				$price = $price + $item->price;
				  			}
				  		?>
				  		<tr> 
				  	 		<td style="width:50px;text-align:center;    vertical-align: middle;">{{$i}}</td> 
				  	 		<td style="width:200px;text-align:center;    vertical-align: middle;">$ {{$price}}</td>
				  	 		<td style="vertical-align: middle;text-align:center;">{{$v->created_at}}</td>
				  	 		<td style="width:200px;text-align:center;    vertical-align: middle;">
				  	 			@if($v->status == 1)
				  	 			Pedding
				  	 			@else
				  	 			Processing
				  	 			@endif
				  	 		</td>  
				  	 	</tr>
				  	 	<?php $i++; ?>
				  		@endforeach
				  	 </tbody> 
				  	</thead>
					</table>
					</div>
			@else
			<h6>Empty order !</h6>
			<br />
			<a href="{{url('/', $parameters = [], $secure = null)}}" class="btn-continue">Continue Shopping</a>
			@endif
		</div>
	</section>	

@endsection