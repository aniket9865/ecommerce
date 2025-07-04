{{--@extends('front.layout.app')--}}
{{--@section('content')--}}

{{--        <section class="section-5 pt-3 pb-3 mb-3 bg-white">--}}
{{--            <div class="container">--}}
{{--                <div class="light-font">--}}
{{--                    <ol class="breadcrumb primary-color mb-0">--}}
{{--                        <li class="breadcrumb-item"><a class="white-text" href="{{route('front.home')}}">Home</a></li>--}}
{{--                        <li class="breadcrumb-item"><a class="white-text" href="{{route('front.shop')}}">Shop</a></li>--}}
{{--                        <li class="breadcrumb-item">Cart</li>--}}
{{--                    </ol>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}

{{--        <section class="section-9 pt-4">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}

{{--                    @if (Session::has('success'))--}}
{{--                        <div class="col-md-12">--}}
{{--                            <div class="alert alert-warning alert-dismissible fade show" role="alert">--}}
{{--                                {{ Session::get('success') }}--}}
{{--                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                        @if (Session::has('error'))--}}
{{--                            <div class="col-md-12">--}}
{{--                                <div class="alert alert-danger alert-dismissible fade show" role="alert">--}}
{{--                                    {{ Session::get('error') }}--}}
{{--                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endif--}}


{{--                    <div class="col-md-8">--}}
{{--                        <div class="table-responsive">--}}
{{--                            <table class="table" id="cart">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>Item</th>--}}
{{--                                    <th>Price</th>--}}
{{--                                    <th>Quantity</th>--}}
{{--                                    <th>Total</th>--}}
{{--                                    <th>Remove</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @if(!empty($cartContent))--}}
{{--                                    @foreach($cartContent as $item)--}}
{{--                                        <tr data-rowid="{{ $item->rowId }}">--}}
{{--                                            <td>--}}
{{--                                                <div class="d-flex align-items-center justify-content-center">--}}

{{--                                                    @if($item->options->image)--}}
{{--                                                        <img class="card-img-top" width="100" height="100" src="{{ asset('uploads/temp/' . $item->options->image) }}">--}}
{{--                                                    @else--}}
{{--                                                        <img class="card-img-top" src="{{ asset('admin/img/default-150x150.png') }}" width="100" height="100"width="50" >--}}
{{--                                                    @endif--}}


{{--                                                    <h2>{{ $item->name }}</h2>--}}
{{--                                                </div>--}}
{{--                                            </td>--}}
{{--                                            <td>{{ $item->price }}</td>--}}
{{--                                            <td>--}}
{{--                                                <div class="input-group quantity mx-auto" style="width: 100px;">--}}
{{--                                                    <div class="input-group-btn">--}}
{{--                                                        <button class="btn btn-sm btn-dark btn-minus p-2 pt-1 pb-1 sub" data-id="{{ $item->rowId }}">--}}
{{--                                                            <i class="fa fa-minus"></i>--}}
{{--                                                        </button>--}}
{{--                                                    </div>--}}
{{--                                                    <input type="text" class="form-control form-control-sm border-0 text-center qty" value="{{ $item->qty }}">--}}
{{--                                                    <div class="input-group-btn">--}}
{{--                                                        <button class="btn btn-sm btn-dark btn-plus p-2 pt-1 pb-1 add" data-id="{{ $item->rowId }}">--}}
{{--                                                            <i class="fa fa-plus"></i>--}}
{{--                                                        </button>--}}

{{--                                                    </div>--}}
{{--                                                </div>--}}

{{--                                            </td>--}}
{{--                                            <td>{{ $item->price * $item->qty }}</td>--}}
{{--                                            <td>--}}
{{--                                                <form action="{{route('cart.index')}}" method="get">--}}
{{--                                                <button class="btn btn-sm btn-danger btn-remove">--}}
{{--                                                    <i class="fa fa-times"></i>--}}
{{--                                                </button>--}}
{{--                                                </form>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}


{{--                    <div class="col-md-4">--}}
{{--                        <div class="card cart-summery">--}}
{{--                            <div class="sub-title">--}}
{{--                                <h2 class="bg-white">Cart Summery</h2>--}}
{{--                            </div>--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="d-flex justify-content-between pb-2">--}}
{{--                                    <div>Subtotal</div>--}}
{{--                                    <div>${{ Cart::subtotal() }}</div>--}}
{{--                                 </div>--}}
{{--                                <div class="d-flex justify-content-between pb-2">--}}
{{--                                    <div>Shipping</div>--}}
{{--                                    <div>0</div>--}}
{{--                                </div>--}}
{{--                                <div class="d-flex justify-content-between summery-end">--}}
{{--                                    <div>Total</div>--}}
{{--                                    <div>${{ Cart::subtotal() }}</div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="pt-2">--}}
{{--                                <a href="{{route('front.checkout')}}" class="btn-dark btn btn-block w-100">Proceed to Checkout</a>--}}
{{--                            </div>--}}
{{--                            <div class="input-group apply-coupan mt-4">--}}
{{--                            <input type="text" placeholder="Coupon Code" class="form-control" name="discount_code" id="discount_code">--}}
{{--                            <button class="btn btn-dark" type="button" id="apply-discount">Apply Coupon</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}

{{--@endsection--}}
{{--@section('customjs')--}}
{{--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
{{--    <script>--}}
{{--        // Update quantity--}}
{{--        $('.add').click(function () {--}}
{{--            // Find the quantity input field inside the same .input-group--}}
{{--            var qtyElement = $(this).closest('.input-group').find('.qty');--}}
{{--            var qtyValue = parseInt(qtyElement.val());--}}
{{--            if (qtyValue < 10) {  // Limit the maximum quantity to 10--}}
{{--                qtyElement.val(qtyValue + 1);--}}

{{--                var rowId = $(this).data('id');--}}
{{--                var newQty = qtyElement.val();--}}
{{--                updateCart(rowId, newQty);--}}
{{--            }--}}
{{--        });--}}

{{--        $('.sub').click(function () {--}}
{{--            // Find the quantity input field inside the same .input-group--}}
{{--            var qtyElement = $(this).closest('.input-group').find('.qty');--}}
{{--            var qtyValue = parseInt(qtyElement.val());--}}
{{--            if (qtyValue > 1) {  // Limit the minimum quantity to 1--}}
{{--                qtyElement.val(qtyValue - 1);--}}
{{--                var rowId = $(this).data('id');--}}
{{--                var newQty = qtyElement.val();--}}
{{--                updateCart(rowId, newQty);--}}
{{--            }--}}
{{--        });--}}

{{--        function updateCart(rowId, qty) {--}}
{{--            $.ajax({--}}
{{--                url: '{{ route("cart.update") }}',--}}
{{--                type: 'post',--}}
{{--                data: { rowId: rowId, qty: qty, _token: '{{ csrf_token() }}' },--}}
{{--                dataType: 'json',--}}
{{--                success: function (response) {--}}
{{--                    window.location.href = "{{ route("cart.index") }}"--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}

{{--    </script>--}}
{{--@endsection--}}

@extends('front.layout.app')
@section('content')

    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('front.home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('front.shop')}}">Shop</a></li>
                    <li class="breadcrumb-item">Cart</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-9 pt-4">
        <div class="container">
            @if (Session::has('success'))
                <div class="col-md-12">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if (Session::has('error'))
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table" id="cart">
                            <thead>
                            <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($cartContent))
                                @foreach($cartContent as $item)
                                    <tr data-rowid="{{ $item->rowId }}">
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">

                                                @if($item->options->image)
                                                    <img class="card-img-top" width="100" height="100" src="{{ asset('uploads/temp/' . $item->options->image) }}">
                                                @else
                                                    <img class="card-img-top" src="{{ asset('admin/img/default-150x150.png') }}" width="100" height="100"width="50" >
                                                @endif


                                                <h2>{{ $item->name }}</h2>
                                            </div>
                                        </td>
                                        <td>{{ $item->price }}</td>
                                        <td>
                                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                                <form action="{{route('cart.index')}}" method="get">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-sm btn-dark btn-minus p-2 pt-1 pb-1 sub" data-id="{{ $item->rowId }}">
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                                <input type="text" class="form-control form-control-sm border-0 text-center qty" value="{{ $item->qty }}">
                                                <div class="input-group-btn">
                                                    <form action="{{route('cart.index')}}" method="get">
                                                        <button class="btn btn-sm btn-dark btn-plus p-2 pt-1 pb-1 add" data-id="{{ $item->rowId }}">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->price * $item->qty }}</td>
                                        <td>
                                            <form action="{{route('cart.index')}}" method="get">
                                                <button class="btn btn-sm btn-danger btn-remove">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card cart-summery">
                        <div class="sub-title">
                            <h2 class="bg-white">Cart Summery</h2>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between pb-2">
                                <div>Subtotal</div>
                                <div>Rs{{ Cart::subtotal() }}</div>
                            </div>
                            {{--                                <div class="d-flex justify-content-between pb-2">--}}
                            {{--                                    <div>Shipping</div>--}}
                            {{--                                    <div>0</div>--}}
                            {{--                                </div>--}}
                            <div class="d-flex justify-content-between summery-end">
                                <div>Total</div>
                                <div>Rs{{ Cart::subtotal() }}</div>
                            </div>
                        </div>
                        <div class="pt-2">
                            <a href="{{route('front.checkout')}}" class="btn-dark btn btn-block w-100">Proceed to Checkout</a>
                        </div>
                        {{--                        <div class="input-group apply-coupan mt-4">--}}
                        {{--                            <input type="text" placeholder="Coupon Code" class="form-control">--}}
                        {{--                            <button class="btn btn-dark" type="button" id="button-addon2">Apply Coupon</button>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
    </section>

@endsection
@section('customjs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Update quantity
            $('#cart').on('click', '.btn-plus, .btn-minus', function() {
                var row = $(this).closest('tr');
                var rowId = row.data('rowid');
                var qtyInput = row.find('.qty');
                var currentQty = parseInt(qtyInput.val());
                var newQty = $(this).hasClass('btn-plus') ? currentQty + 1 : Math.max(currentQty - 1, 1);

                qtyInput.val(newQty);

                $.ajax({
                    url: '{{ route('cart.update') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        rowId: rowId,
                        qty: newQty
                    },
                    success: function(response) {
                        if (response.status) {
                            // Reload the page after updating the cart
                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    }
                });
            });

            // Remove item
            $('#cart').on('click', '.btn-remove', function() {
                var row = $(this).closest('tr');
                var rowId = row.data('rowid');

                $.ajax({
                    url: '{{ route('cart.remove') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        rowId: rowId
                    },
                    success: function(response) {
                        if (response.status) {
                            // Reload the page after removing the item
                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    }
                });
            });
        });
    </script>
@endsection
