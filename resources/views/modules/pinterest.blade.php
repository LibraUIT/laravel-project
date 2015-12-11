<div class="container">
	<div class="section_title nice_title content-center">
        <h3>Gallery</h3>
    </div>

	<div class="my-gallery" itemscope itemtype="http://schema.org/ImageGallery">
		<div class="row">
	    @foreach($gallerys as $gallery)
	    <div class="col-sm-4">
		    <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
		      <a href="{{URL::to('/').str_replace( '..', '',$gallery->image)}}" itemprop="contentUrl" data-size="1024x768">
		          <img src="{{URL::to('/').str_replace( '..', '',$gallery->image)}}" itemprop="thumbnail" alt="Image description" />
		      </a>
		      <figcaption itemprop="caption description">{{$gallery->title}}</figcaption>                                     
		    </figure>
	    </div>
	    @endforeach
	    </div>
  	</div>

</div>
{!! $pswp !!}