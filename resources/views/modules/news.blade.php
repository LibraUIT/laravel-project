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
</div>	