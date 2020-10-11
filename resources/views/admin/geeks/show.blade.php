@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    @if (session('msg'))
      <div class="alert alert-success" id="goAway">
          {{ session('msg') }}
      </div>
    @endif

    <section class="content-header">
        <a href="{{ route('experts.index') }}" class="btn btn-info"> <i class="fa fa-arrow-left"></i> Back To Geeks </a>
    </section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                {{-- <div class="col-md-2">

                </div> --}}
                <div class="col-md-12">
                    <div class="panel panel-info">

                        <div class="row">
                            <div class="col-md-2">
                                @if(!$user->avatar)
                                <img src="/public/frontend/img/interface/avatar.png" alt="Man" style="width: 100%">
                                @else
                                <img src="{{ (strpos($user->avatar,'http') !== false) ? $user->avatar : '/storage/app/public/' . $user->avatar }}" alt="" style="width: 100%">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="panel-body">
                                    <h1 style="margin:0">{{ $user->name }}</h1>
                                    <div class="clearfix"></div>
                                    <h5> <i class="fa fa-user"></i> {{ $user->username }} </h5>
                                    <h5><i class="fa fa-phone"></i> {{ $user->phone }}</h5>
                                    <h5><i class="fa fa-envelope"></i> {{ $user->email }}</h5>
                                    <h5><i class="fa fa-check"></i> Joined {{ $user->created_at }}</h5>

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div  style="display:block">
                                    @if($user->hourly_rate)
                                        <a href="{{ route('expert.status' , $user->id ) }}" class=" btn btn-{{ ($user->is_approved) ? 'danger':'success'}}" style="margin: 30px 30px 0px 0;"> {{ ($user->is_approved) ? 'Unapprove' : 'Approve' }}</a>
                                    @else
                                        <h3 class="alert alert-warning">You can not approve this Profile</h3>
                                    @endif
                                </div>
                            </div>
                        </div>
                                <!-- List group -->
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <strong>Registerd by:</strong><br>
                                        {{ $user->provider ? ucwords($user->provider): 'Manually'  }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Title:</strong><br>
                                        {{ $user->tile }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Address:</strong><br>
                                        {{ $user->address }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Hourly Rate:</strong><br>
                                        {{ $user->hourly_rate }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Main Service:</strong><br>
                                        {{ $user->main_service }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Sub Category Service:</strong><br>
                                        {{ $user->sub_cat }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Bio:</strong><br>
                                        {{ $user->bio }}
                                    </li>
                                </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

</div>
@endsection