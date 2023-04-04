@extends("binshopsblog_admin::layouts.admin_layout")
@section("content")

<form action="{{ route('binshopsblog.admin.partnerslogos.update', ['partnerslogos_id' => $partnerslogo->id]) }}" enctype="multipart/form-data" method="post">
    @csrf
    <div class="form-group">
        <label for="title">Partner Title</label>
        <input   type="text" class="form-control" id="title" name="title" value="{{ $partnerslogo->title }}">

        @error('title')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="image">Partner - Image Logo</label>
        <div class="mb-2">
            <img src="{{ asset('storage/'.$partnerslogo->image) }}" class="img-thumbnail" width="150px" height="auto">
        </div>
        <input  class="form-control" type="file" name="image" id="image" aria-describedby="image_help">
        @error('image')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>

    <br>
    <input type="submit" name="submit_btn" class="btn btn-primary" value="Edit">

</form>

@endsection
