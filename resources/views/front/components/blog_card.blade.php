<a href="/" class="flat-blog-item hover-img">
    <div class="img-style">
        <img class="lazyload" data-src="{{ asset('frontAssets/images/blog/blog-10.jpg') }}" src="{{ asset('frontAssets/images/blog/blog-10.jpg') }}"
             alt="img-blog">
        <span class="date-post">{{ $blog->created_at->format('M d Y') }}</span>
    </div>
    <div class="content-box">

        <h5 class="title link">{{ $blog->title }}</h5>
        <p class="description">{{ \Illuminate\Support\Str::limit($blog->content , 30 , '...?') }}</p>
    </div>

</a>
