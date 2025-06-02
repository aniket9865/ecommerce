@extends('admin.layout.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Coupon Code</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('coupons.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="" method="post" id="discountForm" name="discountForm">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="code">Code</label>
                                    <input type="text" name="code" id="code" class="form-control" placeholder="Coupon Code">
                                    <p id="codeError" class="error text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                    <p id="nameError" class="error text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="max_uses">Max Uses</label>
                                    <input type="number" name="max_users" id="max_uses" class="form-control" placeholder="Max Uses">
                                    <p id="maxError" class="error text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="max_uses_user">Max Uses Per User</label>
                                    <input type="number" name="max_uses_users" id="max_uses_user" class="form-control" placeholder="Max Uses Per User">
                                    <p id="maxUsesUserError" class="error text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type">Type</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="">Select Type</option>
                                        <option value="percentage">Percentage</option>
                                        <option value="fixed">Fixed</option>
                                    </select>
                                    <p id="typeError" class="error text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="discount_amount">Discount Amount</label>
                                    <input type="number" name="discount_amount" id="discount_amount" class="form-control" placeholder="Discount Amount">
                                    <p id="discountError" class="error text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="min_amount">Min Amount</label>
                                    <input type="number" name="min_amount" id="min_amount" class="form-control" placeholder="Min Amount">
                                    <p id="minError" class="error text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    <p id="statusError" class="error text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="starts_at">Start At</label>
                                    <input type="text" name="starts_at" id="starts_at" class="form-control" placeholder="Start At">
                                    <p id="startError" class="error text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="expires_at">Expires At</label>
                                    <input type="text" name="expires_at" id="expires_at" class="form-control" placeholder="Expires At">
                                    <p id="expireError" class="error text-danger"></p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="5" placeholder="Description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('customjs')
    <script>
        $(document).ready(function(){
            $('#starts_at').datetimepicker({
                // options here
                format:'Y-m-d H:i:s',
            });
        });

        $(document).ready(function(){
            $('#expires_at').datetimepicker({
                // options here
                format:'Y-m-d H:i:s',
            });
        });

        $(document).ready(function () {
            $("#discountForm").submit(function (event) {
                event.preventDefault();

                // Clear previous errors
                $(".form-control").removeClass("is-invalid");
                $(".error").text("");

                let isValid = true;

                // Validate code
                const code = $("#code").val().trim();
                if (!code) {
                    $("#code").addClass("is-invalid");
                    $("#codeError").text("Code is required.");
                    isValid = false;
                }

                // Validate name
                const name = $("#name").val().trim();
                if (!name) {
                    $("#name").addClass("is-invalid");
                    $("#nameError").text("Name is required.");
                    isValid = false;
                }

                // Validate max_uses
                const max_uses = $("#max_uses").val().trim();
                if (!max_uses) {
                    $("#max_uses").addClass("is-invalid");
                    $("#maxError").text("Max uses is required.");
                    isValid = false;
                }

                // Validate max_uses_user
                const max_uses_user = $("#max_uses_user").val().trim();
                if (!max_uses_user) {
                    $("#max_uses_user").addClass("is-invalid");
                    $("#maxUsesUserError").text("Max uses per user is required.");
                    isValid = false;
                }

                // Validate discount_amount
                const discount_amount = $("#discount_amount").val().trim();
                if (!discount_amount) {
                    $("#discount_amount").addClass("is-invalid");
                    $("#discountError").text("Discount amount is required.");
                    isValid = false;
                }

                // Validate min_amount
                const min_amount = $("#min_amount").val().trim();
                if (!min_amount) {
                    $("#min_amount").addClass("is-invalid");
                    $("#minError").text("Minimum amount is required.");
                    isValid = false;
                }

                // Validate type
                const type = $("#type").val();
                if (!type) {
                    $("#type").addClass("is-invalid");
                    $("#typeError").text("Type is required.");
                    isValid = false;
                }

                // Validate status
                const status = $("#status").val();
                if (!status) {
                    $("#status").addClass("is-invalid");
                    $("#statusError").text("Status is required.");
                    isValid = false;
                }

                // Validate starts_at
                const starts_at = $("#starts_at").val();
                if (!starts_at) {
                    $("#starts_at").addClass("is-invalid");
                    $("#startError").text("Start date is required.");
                    isValid = false;
                }

                // Validate expires_at
                const expires_at = $("#expires_at").val();
                if (!expires_at) {
                    $("#expires_at").addClass("is-invalid");
                    $("#expireError").text("Expiry date is required.");
                    isValid = false;
                }

                // If valid, submit form via AJAX
                if (isValid) {
                    $.ajax({
                        url: '{{ route("coupons.store") }}', // Replace with your store route
                        type: 'post',
                        data: new FormData(this), // Use FormData for file uploads and form data
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function (response) {
                            if (response.status) {
                                alert("Discount created successfully!");
                                {{--window.location.href = '{{ route("coupons.index") }}'; // Redirect to the index page--}}
                                    window.location.href = '{{ route("coupons.index") }}';
                            } else {
                                // Handle validation errors from the server
                                const errors = response.errors;
                                if (errors.code) {
                                    $("#code").addClass("is-invalid")
                                        .siblings(".error").text(errors.code[0]);
                                }
                                if (errors.name) {
                                    $("#name").addClass("is-invalid")
                                        .siblings(".error").text(errors.name[0]);
                                }
                                if (errors.max_uses) {
                                    $("#max_uses").addClass("is-invalid")
                                        .siblings(".error").text(errors.max_uses[0]);
                                }
                                if (errors.max_uses_user) {
                                    $("#max_uses_user").addClass("is-invalid")
                                        .siblings(".error").text(errors.max_uses_user[0]);
                                }
                                if (errors.discount_amount) {
                                    $("#discount_amount").addClass("is-invalid")
                                        .siblings(".error").text(errors.discount_amount[0]);
                                }
                                if (errors.min_amount) {
                                    $("#min_amount").addClass("is-invalid")
                                        .siblings(".error").text(errors.min_amount[0]);
                                }
                                if (errors.type) {
                                    $("#type").addClass("is-invalid")
                                        .siblings(".error").text(errors.type[0]);
                                }
                                if (errors.status) {
                                    $("#status").addClass("is-invalid")
                                        .siblings(".error").text(errors.status[0]);
                                }
                                if (errors.starts_at) {
                                    $("#starts_at").addClass("is-invalid")
                                        .siblings(".error").text(errors.starts_at[0]);
                                }
                                if (errors.expires_at) {
                                    $("#expires_at").addClass("is-invalid")
                                        .siblings(".error").text(errors.expires_at[0]);
                                }
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error("Something went wrong:", textStatus, errorThrown);
                        },
                    });
                }
            });
        });


    </script>
@endsection
