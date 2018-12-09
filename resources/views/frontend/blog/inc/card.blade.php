{{-- START Article --}}
<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 col-xl-3 m-b-20">
  {{-- Start Article Cover --}}
  <div class="card article-cover-wrapper hvr-grow-shadow2" style="margin-bottom: 5px;">
    <a class="link" href="{{ $article->url_slug }}">
      {{-- Generated game cover with platform on top --}}
      <div class="owl-lazy" style="background-image: url(&quot;{{$article->image_large}}&quot;); opacity: 1;"></div>
      <div class="overlay">
        <div class="caption">
          <div class="caption-labels">
            <span class="label platform-label" style="background-color:#003791; margin-right:6px;">PlayStation 4</span>
          </div>
          <div class="post-title m-b-5">{{$article->title}}</div><p>{{$article->description}}</p></div>
        </div>
      </div>
    </a>
  </div>
</div>
{{-- End Article --}}
