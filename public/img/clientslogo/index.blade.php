@extends("binshopsblog_admin::layouts.admin_layout")
@section("content")

<form action="{{ route('binshopsblog.admin.clients.add') }}" enctype="multipart/form-data" method="post">
    @csrf
    <div class="form-group">
        <label for="name">Cleint Name</label>
        <input   type="text" class="form-control" id="name"  aria-describedby="name_help" name="name" value="{{ old('name') }}">
        <small id="category_category_name_help" class="form-text text-muted">Use only &lt;br&gt;</small>

        @error('name')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="position">Cleint position</label>
        <input   type="text" class="form-control" id="position"  aria-describedby="position_help" name="position" value="{{ old('position') }}">
        <small id="category_category_name_help" class="form-text text-muted">Use only &lt;br&gt;</small>

        @error('position')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="comment">Cleint comment</label>
        <input   type="text" class="form-control" id="comment"  aria-describedby="comment_help" name="comment" value="{{ old('comment') }}">
        <small id="category_category_name_help" class="form-text text-muted">Use only &lt;br&gt;</small>

        @error('comment')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="image">Client - Image</label>
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
