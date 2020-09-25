<table class="table table-bordered">
    <thead>
    <tr>
        <td width="80">Action</td>
        <td width="300">Title</td>
        <td width="300">Description</td>
        <td>Status </td>
    </tr>
    </thead>
    <tbody>
    @foreach($events as $event)
        <tr>
            <td>
                {!!Form::model($event, [
                'style'=>'display:inline-block',
                'method'=>'PUT',
                'route' =>['event.restore',$event->id],

                ])!!}

                <button title="Restore" type="submit" class="btn btn-xs btn-default"><i class="fas fa-trash-restore"></i></button>
                {!!Form::close()!!}
                {!!Form::model($event, [
                'style'=>'display:inline-block',
                  'method'=>'DELETE',
                  'route' =>['event.force-destroy',$event->id],

                ])!!}
                <button title="Destroy Permanantly" class="btn btn-xs btn-danger" onclick="return confirm('you are about to delete the post premanantly. Are you sure?')"><i class="fa fa-trash"></i></button>

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

