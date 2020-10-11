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
      Payment withdrawer List
      <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Withdrawer List</li>
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
                      <th>Request ID</th>
                      <th>Name</th>
                      <th>Amount</th>
                      <th>Paypal Email</th>
                      <th>Status</th>
                      <th>Created At</th>
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
        order: [ [0, 'desc'] ],
        ajax: {
          url : '{!! route('get.earnings') !!}'
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'geek_id', name: 'name' },
            { data: 'amount', name: 'amount' },
            { data: 'paypal_email', name: 'paypal_email' },
            { data: 'status', name: 'status' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' },
        ]
	});

});
</script>
@endsection