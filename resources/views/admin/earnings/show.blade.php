@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    @if (session('msg'))
      <div class="alert alert-success" id="goAway">
          {{ session('msg') }}
      </div>
    @endif

    <section class="content-header">
        <a href="{{ route('earnings.index') }}" class="btn btn-info"> <i class="fa fa-arrow-left"></i> Back To Withdrawler List </a>
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
                            <div class="col-md-10">
                                <div class="panel-body">
                                    <h2> <i class="fa fa-institution"></i>Paypal Email account: {{ $withdraw->paypal_email }} </h2>
                                    <div class="clearfix"></div>


                                </div>
                            </div>
                            @if ($withdraw->status == 'pending')
                                <div class="col-md-2">
                                    <div  style="display:block">
                                        <a href="{{ route('reject.earnings' , $withdraw->id ) }}" onclick="return confirm('Are you sure? You can not undo this')" class="btn btn-danger" style="margin: 30px 30px 0px 0;"> Reject</a>
                                    </div>
                                </div>
                            @endif
                        </div>

                                    <ul class="list-group" >
                                        <li class="list-group-item">
                                            <strong>Amount: ${{ $withdraw->amount }}</strong>
                                            <br>
                                            <strong>Payment Details: </strong> <br>
                                            {{ $withdraw->details }}
                                        </li>
                                        @if ($withdraw->status == 'pending')
                                            <li class="list-group-item">
                                                <strong>Upload attachment: </strong> <br>
                                                <form action="{{ route('confirm.attachment.earnings') }}" method="POST" style="margin-top: 20px" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="withdraw_id" value="{{ $withdraw->id }}">
                                                <input type="file" class="form-control" name="attachment" required>
                                                <button type="submit" class="btn btn-success"  style="margin-top: 20px">Upload and confirm Payment</button>
                                                </form>
                                            </li>
                                            <li class="list-group-item">
                                                <a href="{{ route('confirm.earnings' , $withdraw->id) }}" class="btn btn-success">Only Confirm Payment</a>
                                            </li>
                                        @endif

                                    </ul>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

</div>
@endsection