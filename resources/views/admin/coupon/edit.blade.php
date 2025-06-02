@extends('admin.layout.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Coupon Code</h1>
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
            <form action="{{ route('coupons.update', $coupon->id) }}" method="post" id="discountForm">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @foreach(['code' => 'Coupon Code', 'name' => 'Name', 'max_users' => 'Max Users', 'max_uses_users' => 'Max Uses Per User', 'discount_amount' => 'Discount Amount', 'min_amount' => 'Min Amount'] as $field => $label)
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="{{ $field }}">{{ $label }}</label>
                                        <input type="text" name="{{ $field }}" id="{{ $field }}" class="form-control" value="{{ old($field, $coupon->$field) }}" placeholder="{{ $label }}">
                                        <p id="{{ $field }}Error" class="error text-danger"></p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type">Type</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="percentage" {{ old('type', $coupon->type) == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                        <option value="fixed" {{ old('type', $coupon->type) == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                    </select>
                                    <p id="typeError" class="error text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" {{ old('status', $coupon->status) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $coupon->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <p id="statusError" class="error text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="starts_at">Start At</label>
                                    <input type="text" name="starts_at" id="starts_at" class="form-control" value="{{ old('starts_at', \Carbon\Carbon::parse($coupon->starts_at)->format('Y-m-d\TH:i')) }}">
                                    <p id="startError" class="error text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="expires_at">Expires At</label>
                                    <input type="text" name="expires_at" id="expires_at" class="form-control" value="{{ old('expires_at', \Carbon\Carbon::parse($coupon->expires_at)->format('Y-m-d\TH:i')) }}">
                                    <p id="expireError" class="error text-danger"></p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" rows="5">{{ old('description', $coupon->description) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('coupons.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('customjs')
    <script>
        $(document).ready(function(){
            $('#starts_at, #expires_at').datetimepicker({
                format: 'Y-m-d H:i:s',
            });

            $("#discountForm").submit(function (event) {
                event.preventDefault();

                $(".form-control").removeClass("is-invalid");
                $(".error").text("");

                let isValid = true;
                const requiredFields = ['code', 'name', 'max_users', 'max_uses_users', 'discount_amount', 'min_amount', 'type', 'status', 'starts_at', 'expires_at'];

                requiredFields.forEach(function(field) {
                    const fieldValue = $("#" + field).val().trim();
                    if (!fieldValue) {
                        $("#" + field).addClass("is-invalid");
                        $("#" + field + "Error").text(`${capitalize(field)} is required.`);
                        isValid = false;
                    }
                });

                if (isValid) {
                    $.ajax({
                        url: '{{ route("coupons.update", $coupon->id) }}',
                        type: 'post',
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function (response) {
                            if (response.status) {
                                alert("Coupon updated successfully!");
                                window.location.href = '{{ route("coupons.index") }}';
                            } else {
                                alert("There was an error updating the coupon.");
                            }
                        }
                    });
                }
            });

            function capitalize(string) {
                return string.charAt(0).toUpperCase() + string.slice(1).replace('_', ' ');
            }
        });
    </script>
@endsection
