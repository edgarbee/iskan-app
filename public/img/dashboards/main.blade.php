@extends("binshopsblog_admin::layouts.admin_layout")
@section("content")

<style>
    .card-body br {
        display: none !important;
    }
</style>
@if(session()->has('success'))
<div class="alert alert-success m-4" role="alert">
    {{ session()->get('success') }}
</div>
@endif
@foreach($partnerslogos as $partnerlogo)
<div class="card m-4">
    <div class="card-body">
        <div class="row align-items-center mb-2">
            <div class="col-md-2">
                <img src="{{ asset('storage/'.$partnerlogo->image) }}" class="img-fluid" width="150px" height="auto">
            </div>
            <div class="col-md-10">
                <h5 class="card-title">{{ $partnerlogo->title }}</h5>
            </div>
        </div>
        <p></p>
        <a href="{{ route('binshopsblog.admin.partnerslogos.edit', ['partnerslogos_id' => $partnerlogo->id]) }}" class="card-link btn btn-primary">Edit partner logo</a>
        <form onsubmit="return confirm('Are you sure you want to delete this partner logo?\n You cannot undo this action!');" method="post" action="{{ route('binshopsblog.admin.partnerslogos.delete', ['partnerslogos_id' => $partnerlogo->id]) }}" class="float-right">
            @csrf                                   
            <input type="submit" class="btn btn-danger btn-sm" value="Delete">
        </form>
    </div>
</div>
@endforeach

@endsection
