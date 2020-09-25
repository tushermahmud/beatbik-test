@extends('layouts.admin.main')
@section('title','Event | All Events')
@section('content')
<div style="padding-left:10px" class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Event
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard |</a></li>
        <li><a href="{{route('events.index')}}">Event |</a></li>
        <li class="active">Create New Event</li>
      </ol>
	</section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body ">
                        {!!Form::model($event, [
                            'method'=>'POST',
                            'route' =>'events.store',
                        'files' =>true
                        ])!!}
                        <div class="form-group {{$errors->has('title')?'has-error':''}}">
                            {!!Form::label('title');!!}
                            {!!Form::text('title',null,['class'=>"form-control","placeholder"=>"Title"]);!!}
                            @if($errors->has('title'))
                                <span class="help-block">{{$errors->first('title')}}</span>
                            @endif
                        </div>
                        <div class="form-group {{$errors->has('description')?'has-error':''}}">
                            {!!Form::label('description');!!}
                            {!!Form::textarea('description',null,['class'=>"form-control","placeholder"=>"Description"]);!!}
                            @if($errors->has('description'))
                                <span class="help-block">{{$errors->first('description')}}</span>
                            @endif
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="input-group mb-3 " style="margin-bottom:40px !important;">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Upload</span>
                    </div>
                    <div class="custom-file {{$errors->has('image')?'has-error':''}}">
                        <input type="file" class="custom-file-input" name="image" id="inputGroupFile01">
                        <label class="custom-file-label" for="inputGroupFile01">Event Image</label>
                        @if($errors->has('image'))
                            <span class="help-block" style="position:absolute;top:44px;left:-74px">{{$errors->first('image')}}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="box">
                    <div class="box-header">
                    </div>

                    <div class="box-footer clearfix">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                {!!Form::submit('Submit',["class"=>"btn btn-md btn-primary form-control",'name' => 'submitbutton']);!!}
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                {!!Form::submit('Draft',["class"=>"btn btn-md btn-warning form-control",'name' => 'submitdraftbutton']);!!}
                            </div>
                        </div>

                    </div>
                </div>

                {!!Form::close()!!}
            </div>

        </div>
        <!-- ./row -->
    </section>
    </div>
@endsection
