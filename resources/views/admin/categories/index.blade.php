@extends('layouts.admin')

@section('content')
<div class="content-wrapper">

    <section class="content-header">
      <h1>
      Category List
      <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Categories</li>
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
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Add New Category</label>
                    <input type="text" name="name" class="form-control"  placeholder="Enter category">
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
                    <th>Sub Categories</th>
                    <th>Actions</th>
                  </tr>
                  @forelse ($categories as $category)
                    <tr>
                      <td>{{ $category->id }}</td>
                      <td>{{ $category->name }}</td>
                      <td>
                        @if($category->sub_categories)
                          <ol>
                            @foreach ($category->sub_categories as $sub_cat)
                                <li>{{ $sub_cat }} </li>
                            @endforeach
                          </ol>
                        @endif
                          <br></td>
                      <td>
                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#subCat{{ $category->id }}">Add Sub Categories</a>
                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#editCat{{ $category->id }}">Edit Category</a>

                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#editSubCat{{ $category->id }}">Edit Sub Category</a>

                        <a href="{{ route('categories.destroy',$category->id) }}" class="btn bg-maroon" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    @include('admin.categories.modal')
                    @empty
                   <p>No Categories Yet</p>
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
