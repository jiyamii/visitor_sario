@extends('layouts.app')

@section('title', 'Visitors')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Visitors</h1>
        <a href="{{ route('visitors.create') }}" class="btn btn-primary">+ Add Visitor</a>
    </div>

    <form method="GET" action="{{ route('visitors.index') }}" class="input-group mb-3">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
               placeholder="Search by name, address or position">
        <button class="btn btn-outline-secondary" type="submit">Search</button>
        @if (request('search'))
            <a href="{{ route('visitors.index') }}" class="btn btn-outline-danger">Clear</a>
        @endif
    </form>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Position</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($visitors as $visitor)
                        <tr>
                            <td>{{ $visitor->id }}</td>
                            <td>{{ $visitor->name }}</td>
                            <td>{{ $visitor->address }}</td>
                            <td>{{ $visitor->position }}</td>
                            <td class="text-end text-nowrap">
                                <a href="{{ route('visitors.show', $visitor) }}" class="btn btn-sm btn-outline-info">View</a>
                                <a href="{{ route('visitors.edit', $visitor) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('visitors.destroy', $visitor) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete this visitor?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No visitors found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $visitors->links('pagination::bootstrap-5') }}
    </div>
@endsection