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
@foreach($clients as $client)
<div class="card m-4">
    <div class="card-body">
        <div class="row align-items-center mb-2">
            <div class="col-md-1">
                <img src="{{ asset('storage/'.$client->image) }}" class="img-fluid" width="70px" height="auto">
            </div>
            <div class="col-md-11">
                <h5 class="card-title">{!! $client->name !!}</h5>
            </div>
        </div>
        <p>Position: {!! $client->position !!}</p>
        <p>Comment: {{ $client->comment }}</p>
        <a href="{{ route('binshopsblog.admin.clients.edit', ['clients_id' => $client->id]) }}" class="card-link btn btn-primary">Edit client</a>
        <form onsubmit="return confirm('Are you sure you want to delete this client?\n You cannot undo this action!');" method="post" action="{{ route('binshopsblog.admin.clients.delete', ['clients_id' => $client->id]) }}" class="float-right">
            @csrf                                   
            <input type="submit" class="btn btn-danger btn-sm" value="Delete">
        </form>
    </div>
</div>
@endforeach

@endsection
