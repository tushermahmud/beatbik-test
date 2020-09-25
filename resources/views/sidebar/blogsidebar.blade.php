<div class="categories">
    <h2 class="sub_head">Categories</h2>
    <ul>
        @foreach($categories as $category)
            <li><a href="{{route('searchByCategory',$category->slug)}}">{{$category->title}}<span>({{$category->blogs->count()}})</span></a></li>
        @endforeach
    </ul>
</div>
