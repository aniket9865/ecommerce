
@extends('front.layout.app')

@section('content')

    <!-- Logout Link and Form -->
{{--    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>--}}
{{--    <form id="logout-form" action="{{ route('account.logout') }}" method="POST" style="display: none;">--}}
{{--        @csrf--}}
{{--    </form>--}}

    <!-- Breadcrumb Navigation -->
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div>
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.shop') }}">Shop</a></li>
                        <li class="breadcrumb-item">Checkout</li>
                    </ol>
                </div>

                <!-- Add your checkout form fields here -->

            </div> <!-- Closing form tag added -->
        </div> <!-- Closing container div -->

    </section>

    <!-- Checkout Form and Order Summary -->
    <section class="section-9 pt-4">
        <div class="container">
            <form class="row" id="orderForm" name="orderForm" action="{{ route('front.processCheckout') }}" method="post">

                @csrf

                <!-- Shipping Address Form -->
                <div class="col-md-8">
                    <div class="sub-title">
                        <h2>Shipping Address</h2>
                    </div>
                    <div class="card shadow-lg border-0">
                        <div class="card-body checkout-form">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" value="{{ !empty($customerAddress) ? $customerAddress->first_name : '' }}"
                                        >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="{{ !empty($customerAddress) ? $customerAddress->last_name : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="{{ !empty($customerAddress) ? $customerAddress->email : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-md-12 mb-3">
                                        <select name="country" id="country" class="form-control">
                                            <option value="">Select a Country</option>
                                            @foreach($countries as $country)
                                                <option {{(!empty($customerAddress) && $customerAddress->country_id == $country->id)? 'selected' : ''}} value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <textarea name="address" id="address" cols="30" rows="3" placeholder="Address" class="form-control">{{ !empty($customerAddress) ? $customerAddress->address : '' }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" name="apartment" id="apartment" class="form-control" placeholder="Apartment, suite, unit, etc. (optional)" value="{{ !empty($customerAddress) ? $customerAddress->apartment : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="text" name="city" id="city" class="form-control" placeholder="City" value="{{ !empty($customerAddress) ? $customerAddress->city : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="text" name="state" id="state" class="form-control" placeholder="State" value="{{ !empty($customerAddress) ? $customerAddress->state : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="text" name="zip" id="zip" class="form-control" placeholder="Zip" value="{{ !empty($customerAddress) ? $customerAddress->zip : '' }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile No." value="{{ !empty($customerAddress) ? $customerAddress->mobile : '' }}">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <textarea name="order_notes" id="order_notes" cols="30" rows="2" placeholder="Order Notes (optional)" class="form-control" ></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary and Payment Form -->
                <div class="col-md-4">
                    <div class="sub-title">
                        <h2>Order Summary</h2>
                    </div>
                    <div class="card cart-summary">
                        <div class="card-body">
                            @foreach(Cart::content() as $item)
                                <div class="d-flex justify-content-between pb-2">
                                    <div class="h6">{{ $item->name }} X {{ $item->qty }}</div>
                                    <div class="h6">{{ $item->price * $item->qty }}</div>
                                </div>
                            @endforeach

                            <div class="d-flex justify-content-between summery-end">
                                <div class="h6"><strong>Subtotal</strong></div>
                                <div class="h6"><strong>{{ Cart::subtotal() }}</strong></div>
                            </div>

                                <div class="d-flex justify-content-between summery-end">
                                    <div class="h6"><strong>Discount</strong></div>
                                    <div class="h6"><strong id="discount_value">{{ $discount }}</strong></div>
                                </div>

                                <div class="d-flex justify-content-between mt-2">
                                    <div class="h6"><strong>Shipping</strong></div>
                                    <div class="h6"><strong id="shippingAmount">Rs{{ number_format($totalShippingCharge, 2) }}</strong></div>
                                </div>

                                <div class="d-flex justify-content-between mt-2 summery-end">
                                    <div class="h5"><strong>Total</strong></div>
                                    <div class="h5"><strong id="grandTotal">Rs{{ number_format($grandTotal, 2) }}</strong></div>
                                </div>

                        </div>
                    </div>

{{--                    Apply Discount Here--}}
                    <div class="input-group apply-coupan mt-4">
                        <input type="text" placeholder="Coupon Code" class="form-control" name="discount_code" id="discount_code">
                        <button class="btn btn-dark" type="button" id="apply-discount">Apply Coupon</button>
                    </div>
                    <div id="discount-message" class="text-danger mt-2" style="display: none;"></div>

                    <div id="discount-response-wrapper">
                        @if(Session::has('code'))
                            <div class="mt-4" id="discount-response">
                                <strong>{{ Session::get('code')->code }}</strong>
                                <a class="btn btn-sm btn-danger" id="remove-discount"><i class="fa fa-times"></i></a>
                            </div>
                        @endif
                    </div>



                    <!-- Payment Method Selection -->
                    <div class="card payment-form">
                        <h3 class="card-title h5 mb-3">Payment Method</h3>

                        <div>
                            <input checked type="radio" name="payment_method" value="cod" id="payment_method_one">
                            <label for="payment_method_one" class="for-check-label">COD</label>
                        </div>

                        <div>
                            <input type="radio" name="payment_method" value="stripe" id="payment_method_two">
                            <label for="payment_method_two" class="for-check-label">Stripe</label>
                        </div>

                        <!-- Card Payment Form -->
                        <div class="card-body p-0 d-none mt-3" id="card-payment-form">
                            <div class="mb-3">
                                <label for="card_number" class="mb-2">Card Number</label>
                                <input type="text" name="card_number" id="card_number" placeholder="Valid Card Number" class="form-control">
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="expiry_date" class="mb-2">Expiry Date</label>
                                    <input type="text" name="expiry_date" id="expiry_date" placeholder="MM/YYYY" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cvv_code" class="mb-2">CVV Code</label>
                                    <input type="text" name="cvv_code" id="cvv_code" placeholder="123" class="form-control">
                                </div>
                            </div>
                        </div>

                        <!-- Pay Now Button -->
                        <div class="pt-4">
                            <button type="submit" class="btn-dark btn btn-block w-100">Pay Now</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection



<!-- Include jQuery in your Blade template -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section('customjs')
    <script>
        $(document).ready(function() {
            // Payment method toggle
            $('input[name="payment_method"]').on('change', function() {
                if ($(this).val() === 'stripe') {
                    $('#card-payment-form').removeClass('d-none');
                } else {
                    $('#card-payment-form').addClass('d-none');
                }
            });

            // Handle form submission with AJAX
            $('#orderForm').on('submit', function(e) {
                e.preventDefault();

                // Clear previous error messages
                $('.text-danger').remove();

                // Basic validation
                let isValid = true;

                // Required fields
                const requiredFields = ['first_name', 'last_name', 'email', 'address', 'country', 'city', 'state', 'zip', 'mobile'];

                requiredFields.forEach(function(field) {
                    const $field = $('#' + field);
                    if ($field.val().trim() === '') {
                        isValid = false;
                        $field.after('<div class="text-danger">This field is required.</div>');
                    }
                });

                // Specific validation for the country field
                if ($('#country').val() === '') {
                    isValid = false;
                    $('#country').after('<div class="text-danger">Please select a country.</div>');
                }

                // Validate email format
                const email = $('#email').val().trim();
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (email !== '' && !emailPattern.test(email)) {
                    isValid = false;
                    $('#email').after('<div class="text-danger">Please enter a valid email address.</div>');
                }

                // Validate mobile number (example: check if it's a valid format)
                const mobile = $('#mobile').val().trim();
                if (mobile !== '' && !/^\d{10}$/.test(mobile)) {
                    isValid = false;
                    $('#mobile').after('<div class="text-danger">Invalid mobile number. Please enter a 10-digit number.</div>');
                }

                // Stripe payment method validation
                if ($('input[name="payment_method"]:checked').val() === 'stripe') {
                    const stripeFields = ['card_number', 'expiry_date', 'cvv_code'];
                    stripeFields.forEach(function(field) {
                        const $field = $('#' + field);
                        if ($field.val().trim() === '') {
                            isValid = false;
                            $field.after('<div class="text-danger">This field is required.</div>');
                        }
                    });
                }

                if (!isValid) {
                    return;
                }

                // Proceed with AJAX submission
                var formData = $(this).serialize();

                // Disable the submit button to prevent multiple clicks
                $('button[type="submit"]').prop('disabled', true);

                $.ajax({
                    url: '{{ route('front.processCheckout') }}',
                    method: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        $('button[type="submit"]').prop('disabled', false);

                        if (response.status) {
                            // Redirect to thank you page with order ID
                            window.location.href = '{{ route('front.thankyou', ['id' => '__ORDER_ID__']) }}'.replace('__ORDER_ID__', response.orderId);
                        } else {
                            // Display error message
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        $('button[type="submit"]').prop('disabled', false);

                        if (xhr.status === 422) {
                            // Validation error
                            var errors = xhr.responseJSON.errors;

                            // Loop through the errors and display them
                            $.each(errors, function(key, messages) {
                                var field = $('#' + key);
                                if (field.length) {
                                    field.after('<div class="text-danger">' + messages[0] + '</div>');
                                }
                            });
                        } else {
                            // Other errors
                            alert('An error occurred. Please try again.');
                        }
                    }
                });
            });
        });

        $("#country").change(function() {
            $.ajax({
                url: '{{ route("front.getOrderSummery") }}', // Ensure the correct route
                type: 'post',
                data: { country_id: $(this).val() }, // Corrected the data structure
                dataType: 'json',
                success: function(response) {
                    if (response.status == true) {
                        $("#shippingAmount").html('$' + response.shippingCharge); // Display shipping charge
                        $("#grandTotal").html('$' + response.grandTotal); // Correctly concatenate dollar sign
                    }
                    // else {
                    //     // Optional: Handle error case when status is false
                    //     alert(response.message); // Show error message if applicable
                    // }
                },
                // error: function(xhr, status, error) {
                //     // Optional: Handle AJAX errors
                //     console.error(xhr.responseText);
                //     alert('An error occurred while processing your request.'); // Alert user of error
                // }
            });
        });


        $("#apply-discount").click(function () {
            let discountCode = $("#discount_code").val();
            let countryId = $("#country").val();

            if (!discountCode) {
                $("#discount-message").html("Please enter a coupon code").show();
                return;
            }

            $.ajax({
                url: '{{ route("front.applyDiscount") }}',
                type: 'POST',
                data: {
                    code: discountCode,
                    country_id: countryId,
                    _token: '{{ csrf_token() }}' // Include CSRF token
                },
                dataType: 'json',
                success: function (response) {
                    if (response.status === true) {
                        $("#shippingAmount").html('$' + response.shippingCharge);
                        $("#grandTotal").html('$' + response.grandTotal);
                        $("#discount_value").html('$' + response.discount);
                        $("#discount-message").html("Coupon applied successfully!").removeClass('text-danger').addClass('text-success').show();
                        $("#discount-response-wrapper").html(response.discountString)
                    } else {
                        $("#discount-message").html(response.message || "Invalid coupon code").removeClass('text-success').addClass('text-danger').show();
                    }
                },
                error: function (xhr) {
                    $("#discount-message").html("An error occurred. Please try again.").removeClass('text-success').addClass('text-danger').show();
                }
            });
        });

        $('body').on('click', "#remove-discount", function () {
            $.ajax({
                url: '{{ route("front.removeDiscount") }}',
                type: 'POST',
                data: {
                    country_id: $("#country").val(),
                    _token: '{{ csrf_token() }}' // Include CSRF token
                },
                dataType: 'json',
                success: function (response) {
                    if (response.status === true) {
                        $("#shippingAmount").html('$' + response.shippingCharge);
                        $("#grandTotal").html('$' + response.grandTotal);
                        $("#discount_value").html('$0'); // Reset discount value
                        $("#discount-response-wrapper").html(''); // Remove the discount message
                        $("#discount_code").val(''); // Clear input field
                    } else {
                        alert(response.message || "Failed to remove discount.");
                    }
                },
                error: function () {
                    alert("An error occurred. Please try again.");
                }
            });
        });



    </script>
@endsection

