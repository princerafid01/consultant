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
      Geeks List
      <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Geeks List</li>
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
                      <th>Username</th>
                      <th>Email</th>
                      <th>Created At</th>
                      <th>Status</th>
                      <th>Actions</th>
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
			url : '{!! route('get.geeks') !!}',
			data: function(d) {
                d.status = $('.select_status').val();
            }
		},
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'username', name: 'username' },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' },
            { data: 'is_approved', name: 'is_approved' },
            { data: 'action', name: 'action' },
        ]
	});





	$('<label style="width: 100%; margin-top:10px">Filter by Status ' +
        '<select class="select_status">'+
            '<option value="">Select</option>'+
            '<option value="unapproved">Unapproved</option>'+
            '<option value="approved">Approved</option>'+
        '</select>' +
		'</label>').appendTo("#DataTables_Table_0_length");


	$('.select_status').change(function(){
		$('.table').DataTable().draw();
	});


});
</script>
@endsection