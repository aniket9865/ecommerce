@extends('admin.layout.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pages</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('page.create') }}" class="btn btn-primary">New Page</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <form id="search-form" method="GET" action="{{ route('page.index') }}">
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <input type="text" name="search" class="form-control float-right" placeholder="Search" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button type="button" class="btn btn-secondary" id="reset-button">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Content</th>
                            <th width="100">Action</th>
                        </tr>
                        </thead>
                        <tbody id="pages-table-body">
                        @forelse ($pages as $page)
                            <tr id="page-row-{{ $page->id }}">
                                <td>{{ $page->id }}</td>
                                <td>{{ $page->name }}</td>
                                <td>{{ $page->slug }}</td>
                                <td>{{ Str::limit($page->content, 50) }}</td>
                                <td>
                                    <a href="{{ route('page.edit', $page->id) }}" class="text-primary edit-page" data-id="{{ $page->id }}">
                                        <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </a>
                                    <a href="#" class="text-danger delete-page" data-id="{{ $page->id }}">
                                        <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                    <form id="delete-form-{{ $page->id }}" action="{{ route('page.destroy', $page->id) }}" method="POST" style="display: none;">w
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Record Not Found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{ $pages->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customjs')
    <script>
        $(document).ready(function() {
            // Handle AJAX Delete
            $('.delete-page').on('click', function(e) {
                e.preventDefault();
                let pageId = $(this).data('id');
                if (confirm('Are you sure you want to delete this page?')) {
                    $.ajax({
                        url: `/admin/pages/${pageId}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status) {
                                $(`#page-row-${pageId}`).remove();
                                alert(response.message);
                            } else {
                                alert('Error deleting page');
                            }
                        },
                        error: function() {
                            alert('Error deleting page');
                        }
                    });
                }
            });

            // Handle AJAX Edit (Optional: if you want to handle in-line editing)
            $('.edit-page').on('click', function(e) {
                e.preventDefault();
                let pageId = $(this).data('id');
                window.location.href = `/admin/pages/${pageId}/edit`;
            });

            // Handle Reset Button Click
            $('#reset-button').on('click', function() {
                $('#search-form')[0].reset(); // Reset the form
                window.location.href = "{{ route('page.index') }}"; // Redirect to the same page without query
            });
        });
    </script>
@endsection
