@extends('front.layout.app')
@section('content')

    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route("front.account") }}">My Account</a></li>
                    <li class="breadcrumb-item">Settings</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-11">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-3">
                    @include('front.accountsidebar')
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">Personal Information</h2>
                        </div>
                        <div class="card-body p-4">
                            <form id="updateProfileForm">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" placeholder="Enter Your Name" class="form-control" value="{{ auth()->user()->name }}">
                                    <p class="text-danger error-name"></p> <!-- Error message here -->
                                </div>

                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" placeholder="Enter Your Email" class="form-control" value="{{ auth()->user()->email }}">
                                    <p class="text-danger error-email"></p> <!-- Error message here -->
                                </div>

{{--                                <div class="mb-3">--}}
{{--                                    <label for="phone">Phone</label>--}}
{{--                                    <input type="text" name="phone" id="phone" placeholder="Enter Your Phone" class="form-control" value="{{ auth()->user()->phone }}">--}}
{{--                                    <p class="text-danger error-phone"></p> <!-- Error message here -->--}}
{{--                                </div>--}}

                                <div class="d-flex">
                                    <button type="submit" class="btn btn-dark">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('customjs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#updateProfileForm').on('submit', function(e) {
                e.preventDefault();
                $('.error-name, .error-email, .error-phone').text(''); // Clear previous errors

                $.ajax({
                    url: "{{ route('front.UpdateAccount') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}", // Add CSRF token
                        name: $('#name').val(),
                        email: $('#email').val(),
                        phone: $('#phone').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;

                        if (errors) {
                            if (errors.name) $('.error-name').html('<p class="text-danger">' + errors.name[0] + '</p>');
                            if (errors.email) $('.error-email').html('<p class="text-danger">' + errors.email[0] + '</p>');
                            if (errors.phone) $('.error-phone').html('<p class="text-danger">' + errors.phone[0] + '</p>');
                        }
                    }
                });
            });
        });


    </script>
@endsection
