<div class="content-news">
	@if(count($posts->data) > 2)
	<div class="row">
		@for($i = 0; $i < 2 ; $i++ )
			<div class="col-sm-6 no-padding">
				<div class="top-two-news">
					<div style='background: url("{{URL::to('/').str_replace('..', '',$posts->data[$i]->cover)}}");background-size: 100% 100%; background-repeat: no-repeat;height:200px;z-index:999'>
						<div class="top-news-title">
							<div class="top-news-title-href">
							<a href="#">
							{{$posts->data[$i]->title}}
							</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endfor
		@if(count($posts->data) > 4)
			@for($i = 2; $i < 5 ; $i++ )
				<div class="col-sm-4 no-padding">
					<div class="top-two-news">
						<div style='background: url("{{URL::to('/').str_replace('..', '',$posts->data[$i]->cover)}}");background-size: 100% 100%; background-repeat: no-repeat;height:200px;z-index:999'>
							<div class="top-news-title">
								<div class="top-news-title-href">
								<a href="#">
								{{$posts->data[$i]->title}}
								</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			@endfor
		@endif		
	</div>
	@endif
	<div class="row">
		<div class="col-sm-8 no-padding">
			@if(count($posts->data) > 0)
			@foreach($posts->data as $post)
				<div class="newsBlock">
					<div class="newsBlock-Title">
						<a href="">{{$post->title}}</a>
					</div>
					<div class="newsBlock-Detail">
						<div class="newsBlock-Detail-top">
							<span>By <a href=""><b>{{$post->name}}</b></a> at <a href="#">{{\Carbon\Carbon::createFromTimeStamp(strtotime($post->updated_at))->diffForHumans()}}</a>  </span>
						</div>
						<div class="newsBlock-Detail-content">
							<a href="">
							<img class="newsBlock-image" src="{{URL::to('/').str_replace('..', '',$post->cover)}}">
							</a>
						</div>
						<div class="newsBlock-text">
							<div align="left">
								{{$post->content}}
							</div>
						</div>
					</div>
				</div>
			@endforeach		
			@endif
		</div>
		<div class="col-sm-4 no-padding-right">
			<div class="adBlock">
					<h3>advertisement</h3>
			</div>
			<div class="categoryBlock">
				<div class="newsBlock-Title">
						<h5>Categories</h5>
				</div class="newsBlock-Detail">
					<ul class="news-categories-list">
						@foreach($categories as $k => $v)
						<li class="news-categories-item"><a href="#" id="news-categorie-{{$v->id}}"><i class="fa fa-folder-o"></i> {{$v->name}}</a></li>
						@endforeach
					</ul>
				<div>
					
				</div>
			</div>
		</div>
	</div>

</div>	