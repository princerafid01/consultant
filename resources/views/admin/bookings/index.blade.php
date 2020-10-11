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
      Booking List
      <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Booking List</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
         <div class="col-xs-12">
            <div class="box">
              <!-- /.box-header -->
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <thead>
                    <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Booking Name</th>
                    <th>Geek Email</th>
                    <th>Geek Phone</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Total Charge</th>
                    <th>Appointment Status</th>
                  </tr>
                  </thead>
                </table>
              </div>
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
			  url : '{!! route('get.bookings') !!}'
		},
        columns: [
            { data: 'id', name: 'id' },
            { data: 'geek_id', name: 'User Name' },
            { data: 'user_id', name: 'Booking Name' },
            { data: 'geek_email', name: 'Geek Email' },
            { data: 'phone', name: 'Geek phone' },
            { data: 'date', name: 'Appointment Date' },
            { data: 'time', name: 'Appointment Time' },
            { data: 'charge', name: 'Total Charge' },
            { data: 'status', name: 'Appointment Status' },
        ]
	});




});
</script>
@endsection