<div class="search_bar">
    <h2 class="sub_head">Search</h2>
    <form action="{{route('doctors.search')}}" method="POST">
        <div class="srch_input">
            @csrf
            <input type="text" name="search" id="search" placeholder="Enter Keyword..."  />
            <button type="submit" class="search"><span class="flaticon-search"></span></button>
        </div>
    </form>
</div>
