@extends("binshopsblog_admin::layouts.admin_layout")
@section("content")

<form action="{{ route('binshopsblog.admin.partnerslogos.add') }}" enctype="multipart/form-data" method="post">
    @csrf
    <div class="form-group">
        <label for="title">Partner Title</label>
        <input   type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">

        @error('title')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="image">Partner - Image Logo</label>
        <input   class="form-control" type="file" name="image" id="image" aria-describedby="image_help">
        @error('image')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>
    <br>
    <input type="submit" name="submit_btn" class="btn btn-primary" value="Add">

</form>

@endsection
