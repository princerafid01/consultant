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
      Home Page Contents
      <small>Control panel</small>
      </h1>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('homepage.content.store') }}" class="homeForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="area-wrapper">
                        <label for="">Top Area Header</label>
                        <input type="text" name="top_area_title" class="form-control" value="{{ $content->top_area_title }}">
                        <label for="">Top Area Paragraph</label>
                        <textarea class="form-control" name="top_area_paragraph">{{ $content->top_area_paragraph }}</textarea>
                        <label for="">Top Area Image</label>
                        <input type="file" class="form-control" name="top_area_image">
                    </div>

                    <div class="area-wrapper">
                        <label for="">Middle Area Header</label>
                        <input type="text" name="middle_area_title" class="form-control" value="{{ $content->middle_area_title }}">
                        <label for="">Middle Area Paragraph</label>
                        <textarea class="form-control" name="middle_area_paragraph">{{ $content->middle_area_paragraph }}</textarea>
                        <label for="">Middle Area Image</label>
                        <input type="file" class="form-control" name="middle_area_image">
                    </div>

                    <div class="area-wrapper">
                        <label for="">Last Area Header</label>
                        <input type="text" name="last_area_title" class="form-control" value="{{ $content->last_area_title }}">
                        <label for="">Last Area Paragraph</label>
                        <textarea class="form-control" name="last_area_paragraph">{{ $content->last_area_paragraph }}</textarea>
                        <label for="">Last Area Image</label>
                        <input type="file" class="form-control" name="last_area_image">
                    </div>

                    <h1>Featured Categories </h1>
                    <div class="area-wrapper">
                        <label for="">Box One Title</label>
                        <input type="text" name="box_one_title" class="form-control" value="{{ $content->box_one_title }}">
                        <label for="">Box One Sub Heading</label>
                        <textarea class="form-control" name="box_one_sub">{{ $content->box_one_sub }}</textarea>
                        <label for="">Box One Image</label>
                        <input type="file" class="form-control" name="box_one_image">
                    </div>

                    <div class="area-wrapper">
                        <label for="">Box Two Title</label>
                        <input type="text" name="box_two_title" class="form-control" value="{{ $content->box_two_title }}">
                        <label for="">Box Two Sub Heading</label>
                        <textarea class="form-control" name="box_two_sub">{{ $content->box_two_sub }}</textarea>
                        <label for="">Box Two Image</label>
                        <input type="file" class="form-control" name="box_two_image">
                    </div>

                    <div class="area-wrapper">
                        <label for="">Box Three Title</label>
                        <input type="text" name="box_three_title" class="form-control" value="{{ $content->box_three_title }}">
                        <label for="">Box Three Sub Heading</label>
                        <textarea class="form-control" name="box_three_sub">{{ $content->box_three_sub }}</textarea>
                        <label for="">Box Three Image</label>
                        <input type="file" class="form-control" name="box_three_image">
                    </div>

                    <button class="btn btn-info" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection