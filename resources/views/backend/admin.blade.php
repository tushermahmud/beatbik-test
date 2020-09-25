
@extends('layouts.admin.main')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" style="padding-left:30px">
      <h1>
        Dasbhboard
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box" style="padding-left:30px">
              <!-- /.box-header -->
              <div class="box-body ">
                    <h3>Welcome to Covid Admin!</h3>
                    <p class="lead text-muted">Hello {{auth()->user()->name}}, Welcome to Covid Admin</p>

                    <h4>Get started</h4>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
@endsection

