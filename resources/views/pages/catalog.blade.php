@extends('layouts.master')

@section('main_content')
	<section class="content">
		<div class="container">
			<div class="row">
				<div class="col-sm-2 no-padding">
						<div class="navigation">
						  <ul>
						  	@foreach($categories as $k => $v)
						  	<li> <a href="{{url('catalog/category', $parameters = [$v->id], $secure = null)}}">{{$v->name}}</a>
						  	</li>
						  	@endforeach
						    <!--<li class="has-sub"> <a href="#">Menu 1</a>
						      <ul>
						        <li class="has-sub"> <a href="#">Submenu 1.1</a>
						          <ul>
						            <li><a href="#">Submenu 1.1.1</a></li>
						            <li class="has-sub"><a href="#">Submenu 1.1.2</a>
						              <ul>
						                <li><a href="#">Submenu 1.1.2.1</a></li>
						                <li><a href="#">Submenu 1.1.2.2</a></li>
						              </ul>
						            </li>
						          </ul>
						        </li>
						        <li><a href="#">Submenu 1.2</a></li>
						      </ul>
						    </li>
						    <li class="has-sub"> <a href="#">Menu 2</a>
						      <ul>
						        <li><a href="#">Submenu 2.1</a></li>
						        <li><a href="#">Submenu 2.2</a></li>
						      </ul>
						    </li>
						    <li class="has-sub"> <a href="#">Menu 3</a>
						      <ul>
						        <li><a href="#">Submenu 3.1</a></li>
						        <li><a href="#">Submenu 3.2</a></li>
						      </ul>
						    </li>-->
						  </ul>
						</div>
				</div>
				<div class="col-sm-7 no-padding" style="padding-left:13px!important">
					@if($slider)
					{!! $slider !!}
					@endif
				</div>
				<div class="col-sm-3 no-padding">
					<img style="height:283px;" src="{{asset('storage/app/default/images/250-fpt-shop.jpg')}}">
				</div>
			</div>
			@foreach ($modules as $module)
		   	{!! $module !!}
			@endforeach
		</div>
	</section>
@endsection