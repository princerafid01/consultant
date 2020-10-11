@extends('layouts.admin')

@section('content')
<div class="content-wrapper">

    <section class="content-header">
      <h1>
      Skill List
      <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Skills</li>
      </ol>
    </section>

    @if (session('msg'))
    <div class="alert alert-success" id="goAway">
        {{ session('msg') }}
    </div>
  @endif

    <section class="content">

        <div class="row rmt-5">
            <div class="col-xs-12">
                <form action="{{ route('tags.store') }}" method="POST">
                    @csrf
                    <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Add New Skill</label>
                    <input type="text" name="name" class="form-control"  placeholder="Enter skill">
                    <button type="submit" class="text-center rmt-2">Create</button>
                    </div>
                </form>
            </div>
         </div>


      <div class="row">
         <div class="col-xs-12">
            <div class="box">
              <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                  </tr>
                  @forelse ($skills as $skill)
                    <tr>
                      <td>{{ $skill->id }}</td>
                      <td>{{ $skill->name }}</td>
                      <td>
                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#skill{{ $skill->id }}">Edit</a>
                    </tr>
                    @include('admin.tags.modal')
                    @empty
                   <p>No skills Yet</p>
                  @endforelse
                </tbody>
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


@section('css')
<style>
.rmt-5{
    margin-top: 20px;
}
.rmt-2{
    margin-top: 10px;
}
</style>

@endsection
