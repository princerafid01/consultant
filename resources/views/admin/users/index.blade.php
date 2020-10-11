@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    @if (session('msg'))
      <div class="alert alert-success" id="goAway">
          {{ session('msg') }}
      </div>
    @endif
    <section class="content-header">
      <h1>
      Users List
      <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User List</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
         <div class="col-xs-12">
            <div class="box">
              <div class="box-body table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Created At</th>
                      <th>Logged in By</th>
                      <th>Action</th>
                  </tr>
                </thead>
              </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
      </div>
    </section>
  </div>

@endsection

@section('js')
<script>

$(function() {
    $('.table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
			url : '{!! route('get.users') !!}'
		},
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' },
            { data: 'provider', name: 'provider' },
            { data: 'actions', name: 'actions' },

        ]
	});




});
</script>
@endsection