<table class="table table-bordered">
    <thead>
    <tr>
        <td width="80">Action</td>
        <td width="300">Title</td>
        <td>Description</td>
        <td>Status </td>
    </tr>
    </thead>
    <tbody>
    @foreach($events as $event)
        <tr>
            <td>
                {!!Form::model($event, [
                  'method'=>'DELETE',
                  'route' =>['events.destroy',$event->id],

                ])!!}
                    <a href="{{route('events.edit',$event->id)}}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i></a>
                    <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
                {!!Form::close()!!}
            </td>
            <td>{{$event->title}}</td>
            <td>{{$event->description}}</td>
            @if($event->published_at==0)
                <td><span class="badge badge-warning">Draft</span></td>
            @endif
            @if($event->published_at==1)
                <td><span class="badge badge-success">Published</span></td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
