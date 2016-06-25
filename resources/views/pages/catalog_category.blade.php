@extends('layouts.master')

@section('main_content')
  <section class="content">
    <div class="container">
      <div class="col-sm-12" style="margin-bottom:20px">
        <h3>{{$category->name}}</h3>
      </div>
      <div class="rows top-content-product">
        @foreach($products->data as $k=>$v)
        <div class="col-sm-2 product-item">
          <a href="{{url('catalog', $parameters = [$v->id, str_slug($v->title, '-').'.html'], $secure = null)}}">
          <img class="product-item-image" src="{{URL::to('/').str_replace('..', '',$v->image)}}">
          <h5>{{$v->title}}</h5>
          <b>$ {{$v->price}}</b>
          <a href="{{url('catalog/cart', $parameters = [$v->id], $secure = null)}}" class="btn btn-primary" class="btn btn-primary">Add to cart</a>
          </a>
        </div>
        @endforeach
    </div>
    </div>
  </section>
@endsection