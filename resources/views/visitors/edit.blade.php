@extends('layouts.app')

@section('title', 'Edit Visitor')

@section('content')
    <div class="card shadow-sm mx-auto" style="max-width: 600px;">
        <div class="card-header"><h1 class="h5 mb-0">Edit Visitor</h1></div>
        <div class="card-body">
            <form action="{{ route('visitors.update', $visitor) }}" method="POST">
                @csrf
                @method('PUT')
                @include('visitors._form', ['visitor' => $visitor])
                <a href="{{ route('visitors.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection