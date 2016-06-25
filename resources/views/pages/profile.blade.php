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
					<div class="col-sm-10 no-padding">
					<table class="table table-bordered">
				  	<thead>
				  	 <tr> 
				  	 		<th style="width:50px;text-align:center;    vertical-align: middle;">#</th> 
				  	 		<th style="width:200px;text-align:center;    vertical-align: middle;">Order price</th>
				  	 		<th style="vertical-align: middle;text-align:center;">Date created</th>
				  	 		<th style="width:200px;text-align:center;    vertical-align: middle;">Status</th>
				  	 		<th style="width:200px;text-align:center;    vertical-align: middle;">Details</th>  
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
				  	 			Pendding
				  	 			@else
				  	 			Processing
				  	 			@endif
				  	 		</td>
				  	 		<td style="vertical-align: middle;text-align:center;">
				  	 			<a onclick="$('#modal-{{$i}}').modal('show');" href="javascript:void(0)">View</a>
				  	 			<div id="modal-{{$i}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        <h4 class="modal-title" id="gridSystemModalLabel">Order No. {{$i}}</h4>
								      </div>
								      <div class="modal-body">
								        <table class="table table-bordered">
								        	<tr>
								        		<td width="30%">Name</td>
								        		<td>{{$v->user_name}}</td>
								        	</tr>
								        	<tr>
								        		<td width="30%">Email</td>
								        		<td>{{$v->user_email}}</td>
								        	</tr>
								        	<tr>
								        		<td width="30%">Phone</td>
								        		<td>{{$v->user_phone}}</td>
								        	</tr>
								        	<tr>
								        		<td width="30%">Address</td>
								        		<td>{{$v->user_address}}</td>
								        	</tr>
								        	<tr>
								        		<td width="30%">Status</td>
								        		<td>
								        			@if($v->status == 1)
									  	 			Pendding
									  	 			@else
									  	 			Processing
									  	 			@endif
								        		</td>
								        	</tr>
								        	<tr>
								        		<td width="30%">Products</td>
								        		<td>
								        			<?php 
											  			$cart_info = unserialize($v->cart);
											  			foreach($cart_info as $key => $item)
											  			{
															echo "<h6>".$item->title."-".$item->price."VND</h6>";
											  			}
											  		?>
								        		</td>
								        	</tr>
								        	<tr class="alert alert-success">
								        		<td width="30%">Total</td>
								        		<td>
								        			{{$price}} VND
								        		</td>
								        	</tr>
								        </table>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								      </div>
								    </div><!-- /.modal-content -->
								  </div><!-- /.modal-dialog -->
								</div><!-- /.modal -->
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