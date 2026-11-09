@extends('layouts.app')

@section('title', 'Add Visitor')

@section('content')
    <div class="card shadow-sm mx-auto" style="max-width: 600px;">
        <div class="card-header"><h1 class="h5 mb-0">Add Visitor</h1></div>
        <div class="card-body">
            <form action="{{ route('visitors.store') }}" method="POST">
                @csrf
                @include('visitors._form')
                <a href="{{ route('visitors.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection