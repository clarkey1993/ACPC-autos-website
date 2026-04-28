@extends('layouts.admin')

@section('title', 'Enquiries')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Enquiries</h1>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Car</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message Preview</th>
                        <th>Status</th>
                        <th>Received</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($enquiries as $enquiry)
                        <tr class="{{ $enquiry->is_read ? '' : 'table-warning' }}">
                            <td>{{ $enquiry->car?->title ?? 'General enquiry' }}</td>
                            <td>{{ $enquiry->name }}</td>
                            <td>{{ $enquiry->email }}</td>
                            <td>{{ $enquiry->phone ?: 'N/A' }}</td>
                            <td style="min-width: 260px;">{{ \Illuminate\Support\Str::limit($enquiry->message, 90) }}</td>
                            <td>
                                @if ($enquiry->is_read)
                                    <span class="badge text-bg-secondary">Read</span>
                                @else
                                    <span class="badge text-bg-warning">New</span>
                                @endif
                            </td>
                            <td>{{ $enquiry->created_at->format('Y-m-d H:i') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.enquiries.show', $enquiry) }}" class="btn btn-sm btn-outline-primary">View</a>
                                @unless ($enquiry->is_read)
                                    <form method="POST" action="{{ route('admin.enquiries.read', $enquiry) }}" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-outline-success">Mark as Read</button>
                                    </form>
                                @endunless
                                <form method="POST" action="{{ route('admin.enquiries.destroy', $enquiry) }}" class="d-inline" onsubmit="return confirm('Delete this enquiry? This cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">No enquiries yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $enquiries->links('pagination::bootstrap-5') }}
    </div>
@endsection
