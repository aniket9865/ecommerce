@extends('admin.layout.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Page</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('page.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('page.update', $page->id) }}" method="post" id="pageForm" name="pageForm">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Name Field -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ old('name', $page->name) }}">
                                    <p id="nameError" class="error text-danger"></p>
                                </div>
                            </div>

                            <!-- Slug Field -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug" value="{{ old('slug', $page->slug) }}" readonly>
                                    <p id="slugError" class="error text-danger"></p>
                                </div>
                            </div>

                            <!-- Content Field (Summernote) -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="content">Content</label>
                                    <textarea name="content" id="content" class="summernote" cols="30" rows="10">{{ old('content', $page->content) }}</textarea>
                                    <p id="contentError" class="error text-danger"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit & Cancel Button -->
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('page.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('customjs')
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Initialize summernote for content textarea
            $('#content').summernote({
                height: 150,  // Set height of summernote editor
                minHeight: null,
                maxHeight: null,
                focus: true
            });

            // Function to generate slug from name
            function generateSlug(text) {
                return text
                    .toString()                     // Convert to string
                    .normalize('NFD')              // Normalize Unicode
                    .replace(/[\u0300-\u036f]/g, '') // Remove accents
                    .toLowerCase()                 // Convert to lowercase
                    .replace(/\s+/g, '-')          // Replace spaces with -
                    .replace(/[^\w\-]+/g, '')      // Remove all non-word characters
                    .replace(/\-\-+/g, '-')        // Replace multiple - with single -
                    .replace(/^-+/, '')            // Remove leading -
                    .replace(/-+$/, '');           // Remove trailing -
            }

            // Event listener for name field input
            $('#name').on('input', function() {
                let name = $(this).val();
                $('#slug').val(generateSlug(name));  // Update the slug field with generated slug
            });

            // Validate form on submission
            $("#pageForm").submit(function(event) {
                event.preventDefault();

                // Clear previous errors
                $('.form-control').removeClass('is-invalid');
                $('.error').text('');

                let isValid = true;

                // Validate name
                const name = $("#name").val().trim();
                if (!name) {
                    $("#name").addClass('is-invalid');
                    $("#nameError").text('Name is required.');
                    isValid = false;
                }

                // Validate slug
                const slug = $("#slug").val().trim();
                if (!slug) {
                    $("#slug").addClass('is-invalid');
                    $("#slugError").text('Slug is required.');
                    isValid = false;
                }

                // Validate content
                const content = $("#content").val().trim();
                if (!content) {
                    $("#content").addClass('is-invalid');
                    $("#contentError").text('Content is required.');
                    isValid = false;
                }

                // If form is valid, submit it via AJAX
                if (isValid) {
                    $.ajax({
                        url: '{{ route("page.update", $page->id) }}',
                        type: 'post',
                        data: new FormData(this), // Use FormData to include file uploads
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response) {
                            if (response.status) {
                                alert('Page updated successfully!');
                                window.location.href = '{{ route("page.index") }}';
                            } else {
                                // Handle server-side validation errors
                                const errors = response.errors;
                                if (errors.name) {
                                    $('#name').addClass('is-invalid')
                                        .siblings('.error').text(errors.name[0]);
                                }
                                if (errors.slug) {
                                    $('#slug').addClass('is-invalid')
                                        .siblings('.error').text(errors.slug[0]);
                                }
                                if (errors.content) {
                                    $('#content').addClass('is-invalid')
                                        .siblings('.error').text(errors.content[0]);
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log("Something went wrong: ", textStatus, errorThrown);
                        }
                    });
                }
            });
        });
    </script>
@endsection
