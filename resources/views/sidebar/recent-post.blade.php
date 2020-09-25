<div class="popular_posts" style="display:flex;flex-direction: column">
    <h2 class="sub_head">Recent Movies</h2>
    @foreach($blogs as $blog)
    <div class="posts_box">
        @if($blog->image)
        <a href="{{route('single-doctor',$blog->slug)}}"><img style="width:90px;height:90px" src="{{asset('uploads/'.$blog->image)}}" class="img-fluid" alt="popular_post" /></a>
        @else
            <a href="{{route('single-doctor',$blog->slug)}}"><img style="width:90px;height:90px" src="{{asset('uploads/1024px-No_image_available.svg.png')}}" class="img-fluid" alt="popular_post" /></a>
        @endif
            <div class="post_content">
            <p> {{$blog->created_at->diffForHumans()}}</p>
            <h2><a href="{{route('single-doctor',$blog->slug)}}">{{substr($blog->name,10)}}</a></h2>
        </div>
    </div>
    @endforeach
</div>
