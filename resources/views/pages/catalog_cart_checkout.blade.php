@extends('layouts.master')

@section('main_content')
	<section class="content">
		<div class="container">
			<h5>Checkout</h5>
			<br />
			@if(!empty($cart))
			<div class="row">
				<div class="col-sm-4">
					<b>Cart information :</b>
					<table class="table table-bordered">
				  	<thead>
				  	 <tr> 
				  	 		<th style="width:50px;text-align:center;    vertical-align: middle;">Total item</th> 
				  	 		<th style="width:100px;text-align:center;    vertical-align: middle;">Total price</th> 
				  	 </tr>
				  	 <tbody>
				  	 <?php 
				  	 $price = 0;
				  	 foreach($cart as $k => $v)
				  	 {
				  	 		$price = $price + $v->price;
				  	 }
				  	 ?>
				  	 	<tr>
				  	 		<th style="text-align:center;">{{count($cart)}}</th>
				  	 		<th style="text-align:center;">$ {{$price}}</th>
				  	 	</tr>	
				  	 </tbody> 
				  	</thead>
					</table>
				</div>	
			</div>
			<div class="row">
				<div class="col-sm-12">
					<b>My information : </b>
				</div>
				<form method="post" action="{{ $form_action }}">
				{!!Form::token()!!}
				<span class="col-sm-2 marin-top-10px">Full name : </span>
				<div class="col-sm-4 marin-top-10px">
					<input value="{{$fullname}}" type="text" name="fullname" class="form-control" placeholder="Your Fullname" required>
				</div>
				<span class="col-sm-2 marin-top-10px">Email : </span>
				<div class="col-sm-4 marin-top-10px">
					<input value="{{$email}}" type="email" name="email" class="form-control" placeholder="Your Email" required>
				</div>
				<span class="col-sm-2 marin-top-10px">Tel/Mobile : </span>
				<div class="col-sm-4 marin-top-10px">
					<input type="text" name="phone" class="form-control" placeholder="Your Tel/Mobile" required>
				</div>
				<div class="col-sm-12 no-padding">
					<span class="col-sm-2 marin-top-10px">Address : </span>
					<div class="col-sm-10 marin-top-10px">
						<textarea rows="5" name="address" class="form-control" placeholder="Your Address" required></textarea> 
					</div>
				</div>
				<div class="col-sm-12 marin-top-10px text-right">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
				</form>	
			</div>
			@else
			<h6>Empty cart !</h6>
			<br />
			<a href="{{url('/', $parameters = [], $secure = null)}}" class="btn-continue">Continue Shopping</a>
			@endif
		</div>
	</section>	
@endsection