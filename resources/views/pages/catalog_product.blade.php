@extends('layouts.master')

@section('main_content')
	<section class="content">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<img src="{{URL::to('/').str_replace('..', '',$product->image)}}">
				</div>
				<div class="col-sm-6">
					<h1 class="product-title">{{$product->title}}</h1>
					<br />
					<h4 class="product-price">$ {{$product->price}}</h4>
					<br />
					<a href="{{url('catalog/cart', $parameters = [$product->id], $secure = null)}}" class="btn btn-primary">Add to cart</a>
					<br />
					<br />
					<h6>Description</h6>
					<p class="product-content"><?php print_r($product->content); ?></p>
				</div>
			</div>
			<div class="top-content">
			<div class="top-content-title">
				<h2>Related product</h2>
			</div>
			<div class="rows top-content-product">
					@foreach($products->data as $k=>$v)
					<div class="col-sm-2 product-item">
						<a href="{{url('catalog', $parameters = [$v->id, str_slug($v->title, '-').'.html'], $secure = null)}}">
						<img class="product-item-image" src="{{URL::to('/').str_replace('..', '',$v->image)}}">
						<h5>{{$v->title}}</h5>
						<b>$ {{$v->price}}</b>
						<a href="{{url('catalog/cart', $parameters = [$v->id], $secure = null)}}" class="btn btn-primary">Add to cart</a>
						</a>
					</div>
					@endforeach
			</div>
		</div>
		</div>
	</section>
@endsection