@extends('layouts.admin')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  {{-- <div class="top-user-area">
      <div class="col-lg-6 col-xs-12" style="display:inline-flex">
        <img class="profile-user-img img-responsive img-circle" src="/public/dist/img/user8-128x128.jpg" alt="User profile picture">
          <div class="text-area">
             <h3 class="profile-username text-left">Nina Mcintire</h3>
             <p class="text-muted text-left">Software Engineer</p>
          </div>
      </div>
      <div class="col-lg-6 col-xs-0">
      </div>
      <div class="col-lg-6 col-xs-12">
         <h3 class="profile-username text-right">New-York, USA</h3>
         <p class="text-muted text-right">12:00 PM, 26-MAY-2020</p>
      </div>
  </div> --}}
  <section class="content-header">
    <h1>
    Dashboard
    <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $bookings->count() }}</h3>

              <p>Total Calls</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('bookings.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $bookings->filter(function ($value, $key) {
                return $value->status == 'approved';
            })->count() }}</h3>

              <p>Upcoming Calls</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('bookings.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $bookings->filter(function ($value, $key) {
                return $value->status == 'finished';
            })->count() }}</h3>

              <p>Completed Calls</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('bookings.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $bookings->filter(function ($value, $key) {
                return $value->status == 'unapproved';
            })->count() }}</h3>

              <p>Canceled Calls</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('bookings.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-red bg-r-danger">
            <div class="inner">
              <h3>{{ $geeks->filter(function ($value, $key) {
                return $value->role == 'expert' &&  $value->is_approved != 1;
            })->count() }}</h3>

              <p>Un Approved Geeks</p>
            </div>
            <div class="icon">
              <i class="ion ion-happy-outline"></i>
            </div>
            <a href="{{ route('experts.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $geeks->filter(function ($value, $key) {
                return $value->is_approved == 1;
            })->count() }}</h3>

              <p>Approved Geeks</p>
            </div>
            <div class="icon">
              <i class="ion ion-happy-outline"></i>
            </div>
            <a href="{{ route('experts.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $users->count() }}</h3>

              <p>Customers</p>
            </div>
            <div class="icon">
              <i class="ion ion-happy-outline"></i>
            </div>
            <a href="{{ route('users.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
        {{-- <div class="col-md-6">
          <div class="box box-primary" style="padding:0 30px 30px">
            <h3 class="box-title" style="padding-bottom:20px; font-size:23px; font-weight:900">Recent Activities</h3>
            <div class="tab-content">
                <!-- /.tab-pane -->
                <div class="tab-pane active" id="timeline">
                  <!-- The timeline -->
                  <ul class="timeline timeline-inverse">
                    <!-- timeline time label -->
                    <li class="time-label">
                          <span class="bg-red">
                            10 Feb. 2014
                          </span>
                    </li>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <li>
                      <i class="fa fa-envelope bg-blue"></i>

                      <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                        <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                        <div class="timeline-body">
                          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                          weebly ning heekya handango imeem plugg dopplr jibjab, movity
                          jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                          quora plaxo ideeli hulu weebly balihoo...
                        </div>
                        <div class="timeline-footer">
                          <a class="btn btn-primary btn-xs">Read more</a>
                          <a class="btn btn-danger btn-xs">Delete</a>
                        </div>
                      </div>
                    </li>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <li>
                      <i class="fa fa-user bg-aqua"></i>

                      <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                        <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                        </h3>
                      </div>
                    </li>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <li>
                      <i class="fa fa-comments bg-yellow"></i>

                      <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                        <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                        <div class="timeline-body">
                          Take me to your leader!
                          Switzerland is small and neutral!
                          We are more like Germany, ambitious and misunderstood!
                        </div>
                        <div class="timeline-footer">
                          <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                        </div>
                      </div>
                    </li>
                    <!-- END timeline item -->
                    <!-- timeline time label -->
                    <li class="time-label">
                          <span class="bg-green">
                            3 Jan. 2014
                          </span>
                    </li>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <li>
                      <i class="fa fa-camera bg-purple"></i>

                      <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                        <div class="timeline-body">
                          <img src="http://placehold.it/150x100" alt="..." class="margin">
                          <img src="http://placehold.it/150x100" alt="..." class="margin">
                          <img src="http://placehold.it/150x100" alt="..." class="margin">
                          <img src="http://placehold.it/150x100" alt="..." class="margin">
                        </div>
                      </div>
                    </li>
                    <!-- END timeline item -->
                    <li>
                      <i class="fa fa-clock-o bg-gray"></i>
                    </li>
                  </ul>
                </div>
                <!-- /.tab-pane -->
              </div>
          </div>
        </div> --}}
        <div class="col-md-12">
          <!-- USERS LIST -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">User Profiles</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <ul class="users-list clearfix">
                @foreach ($users as $user)
                  <li>
                    @if($user->avatar)
                      @if(strpos($user->avatar , 'http') !== false)
                          <img src="{{ $user->avatar }}" alt="User Image">
                      @else
                          <img src="/public/storage/{{ $user->avatar }}" alt="User Image">
                      @endif
                    @else
                        <img src="/public/frontend/img/interface/avatar.png" alt="User Image">
                    @endif

                    <h5 class="users-list-name">{{ $user->name }}</h5>
                    <span class="users-list-date">{{ $user->created_at }}</span>
                  </li>
                @endforeach


              </ul>
              <!-- /.users-list -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="{{ route('users.index') }}" class="uppercase">View All Profiles</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!--/.box -->
        </div>
      </div>
  </section>
</div>
@endsection
@section('css')
<style>
  .users-list img {
    width: 150px!important;
    height: 150px!important;
    margin: 0 auto!important;
    display: block!important;
  }
  .bg-r-danger{
    background: red!important;
  }
</style>
@endsection