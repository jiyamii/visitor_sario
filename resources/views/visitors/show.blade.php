@extends('layouts.app')

@section('title', 'Visitor Details')

@section('content')
    <div class="card shadow-sm mx-auto" style="max-width: 600px;">
        <div class="card-header"><h1 class="h5 mb-0">Visitor Details</h1></div>
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9">{{ $visitor->id }}</dd>

                <dt class="col-sm-3">Name</dt>
                <dd class="col-sm-9">{{ $visitor->name }}</dd>

                <dt class="col-sm-3">Address</dt>
                <dd class="col-sm-9">{{ $visitor->address }}</dd>

                <dt class="col-sm-3">Position</dt>
                <dd class="col-sm-9">{{ $visitor->position }}</dd>

                <dt class="col-sm-3">Added</dt>
                <dd class="col-sm-9">{{ $visitor->created_at?->format('M d, Y h:i A') }}</dd>
            </dl>
        </div>
        <div class="card-footer">
            <a href="{{ route('visitors.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('visitors.edit', $visitor) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
@endsection