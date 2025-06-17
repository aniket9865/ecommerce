@extends('front.layout.app')
@section('content')
    <main>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="{{route('front.home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a class="white-text" href="{{route('front.shop')}}">Shop</a></li>
                        <li class="breadcrumb-item">{{ $product->title }}</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class="section-7 pt-3 mb-3">
            <div class="container">
                <div class="row ">
                    <div class="col-md-5">
                        <div id="product-carousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner bg-light">


                                @if($product->image)
                                    <div class="carousel-item active">
                                        <img class="w-100 h-100" src="{{ asset('uploads/temp/' . $product->image) }}" alt="Image">
                                    </div>
                                @endif

                            </div>
                            <a class="carousel-control-prev" href="#product-carousel" data-bs-slide="prev">
                                <i class="fa fa-2x fa-angle-left text-dark"></i>
                            </a>
                            <a class="carousel-control-next" href="#product-carousel" data-bs-slide="next">
                                <i class="fa fa-2x fa-angle-right text-dark"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="bg-light right">
                            <h1>{{ $product->title }}</h1>

                            <!-- Rating Summary -->
                            <div id="rating-summary-top" class="mt-5"></div>

                            @if($product->compare_price > 0)
                                <h2 class="price text-secondary"><del>{{$product->compare_price}}</del></h2>
                            @endif

                            <h2 class="price ">{{$product->price}}</h2>

                            <p>{!!$product->short_description!!}</p>
                            @if(trim(strtolower($product->track_qty)) == 'yes')
                                @if ($product->qty > 0)
                                    <a class="btn btn-dark" href="javascript:void(0);" onclick="addToCart({{ $product->id }})" data-product-id="{{ $product->id }}">
                                        <i class="fa fa-shopping-cart"></i> Add To Cart
                                    </a>
                                @else
                                    <a class="btn btn-dark" href="javascript:void(0);">
                                        Out Of Stock
                                    </a>
                                @endif
                            @else
                                <a class="btn btn-dark" href="javascript:void(0);" onclick="addToCart({{ $product->id }})" data-product-id="{{ $product->id }}">
                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12 mt-5">
                        <div class="bg-light">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button" role="tab" aria-controls="shipping" aria-selected="false">Shipping & Returns</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                    <p>{!!$product->description!!}</p>
                                </div>
                                <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                                    <p>{!! $product->shipping_returns !!}</p>
                                </div>


                                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                    <div class="col-md-8">
                                        <div class="row">
{{--                                            <form action="" name="productRatingForm" id="productRatingForm" method="post">--}}
{{--                                                <h3 class="h4 pb-3">Write a Review</h3>--}}

{{--                                                <div class="form-group col-md-6 mb-3">--}}
{{--                                                    <label for="name">Name</label>--}}
{{--                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name">--}}
{{--                                                    <p class="text-danger mb-0"></p>--}}
{{--                                                </div>--}}

{{--                                                <div class="form-group col-md-6 mb-3">--}}
{{--                                                    <label for="email">Email</label>--}}
{{--                                                    <input type="text" class="form-control" name="email" id="email" placeholder="Email">--}}
{{--                                                    <p class="text-danger mb-0"></p>--}}
{{--                                                </div>--}}

{{--                                                <div class="form-group mb-3">--}}
{{--                                                    <label for="rating">Rating</label>--}}
{{--                                                    <br>--}}
{{--                                                    <div class="rating" style="width: 10rem">--}}
{{--                                                        @for ($i = 5; $i >= 1; $i--)--}}
{{--                                                            <input id="rating-{{ $i }}" type="radio" name="rating" value="{{ $i }}" />--}}
{{--                                                            <label for="rating-{{ $i }}"><i class="fas fa-3x fa-star"></i></label>--}}
{{--                                                        @endfor--}}
{{--                                                    </div>--}}
{{--                                                    <p class="product-rating-error text-danger mb-0"></p>--}}
{{--                                                </div>--}}

{{--                                                <div class="form-group mb-3">--}}
{{--                                                    <label for="comment">How was your overall experience?</label>--}}
{{--                                                    <textarea name="comment" id="comment" class="form-control" cols="30" rows="5" placeholder="Write your feedback..."></textarea>--}}
{{--                                                    <p class="text-danger mb-0"></p>--}}
{{--                                                </div>--}}

{{--                                                <div>--}}
{{--                                                    <button type="submit" class="btn btn-dark">Submit</button>--}}
{{--                                                </div>--}}
{{--                                            </form>--}}
                                            @auth
                                                <form action="" name="productRatingForm" id="productRatingForm" method="post">
                                                    @csrf
                                                    <h3 class="h4 pb-3">Write a Review</h3>

                                                    <div class="form-group col-md-6 mb-3">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" name="name" id="name"
                                                               placeholder="Name"
                                                               value="{{ auth()->user()->name }}" readonly>
                                                        <p class="text-danger mb-0"></p>
                                                    </div>

                                                    <div class="form-group col-md-6 mb-3">
                                                        <label for="email">Email</label>
                                                        <input type="text" class="form-control" name="email" id="email"
                                                               placeholder="Email"
                                                               value="{{ auth()->user()->email }}" readonly>
                                                        <p class="text-danger mb-0"></p>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="rating">Rating</label>
                                                        <br>
                                                        <div class="rating" style="width: 10rem">
                                                            @for ($i = 5; $i >= 1; $i--)
                                                                <input id="rating-{{ $i }}" type="radio" name="rating" value="{{ $i }}" />
                                                                <label for="rating-{{ $i }}"><i class="fas fa-3x fa-star"></i></label>
                                                            @endfor
                                                        </div>
                                                        <p class="product-rating-error text-danger mb-0"></p>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="comment">How was your overall experience?</label>
                                                        <textarea name="comment" id="comment" class="form-control" cols="30" rows="5" placeholder="Write your feedback..."></textarea>
                                                        <p class="text-danger mb-0"></p>
                                                    </div>

                                                    <div>
                                                        <button type="submit" class="btn btn-dark">Submit</button>
                                                    </div>
                                                </form>
                                            @else
                                                <div class="alert alert-warning mt-4">
                                                    Please <a href="{{ route('account.login') }}">login</a> to submit a rating.
                                                </div>
                                            @endauth

                                        </div>
                                    </div>

                                    <!-- Rating Summary -->
                                    <div id="rating-summary" class="mt-5"></div>

                                    <!-- Rating List -->
                                    <div id="ratings-list"></div>

                                    <!-- Load More Button -->
                                    <div class="text-center mt-3">
                                        <button id="load-more" class="btn btn-outline-dark">Load More</button>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pt-5 section-8">
            <div class="container">
                <div class="section-title">
                    <h2>Related Products</h2>
                </div>
                <div class="row">
                    @if($products->isNotEmpty())
                        @foreach($products as $product)
                            <div class="col-md-4 mb-4"> <!-- Adjust spacing with mb-4 for better spacing -->
                                <div class="card product-card">
                                    <div class="product-image position-relative">
                                        <a href="{{ route('front.product', $product->slug) }}" class="product-img">
                                            @if(!empty($product->image))
                                                <img class="card-img-top" src="{{ asset('uploads/temp/' . $product->image) }}" alt="{{ $product->title }}">
                                            @else
                                                <img class="card-img-top" src="{{ asset('admin/img/default-150x150.png') }}">
                                            @endif
                                        </a>
                                        <a class="wishlist" href="#" data-product-id="{{ $product->id }}">
                                            <i class="far fa-heart"></i>
                                        </a>
                                        <div class="product-action">
                                            @if(trim(strtolower($product->track_qty)) == 'yes')
                                                @if ($product->qty > 0)
                                                    <a class="btn btn-dark" href="javascript:void(0);" onclick="addToCart({{ $product->id }})" data-product-id="{{ $product->id }}">
                                                        <i class="fa fa-shopping-cart"></i> Add To Cart
                                                    </a>
                                                @else
                                                    <a class="btn btn-dark" href="javascript:void(0);">Out Of Stock</a>
                                                @endif
                                            @else
                                                <a class="btn btn-dark" href="javascript:void(0);" onclick="addToCart({{ $product->id }})" data-product-id="{{ $product->id }}">
                                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-body text-center mt-3">
                                        <a class="h6 link" href="#" data-product-id="{{ $product->id }}">{{ $product->title }}</a>
                                        <div class="price mt-2">
                                            <span class="h5"><strong>{{ number_format($product->price, 2) }}</strong></span>
                                            @if($product->compare_price > 0)
                                                <span class="h6 text-underline"><del>{{ number_format($product->compare_price, 2) }}</del></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center">
                            <p>No related products available.</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>

    </main>



@endsection

@section('customjs')
<script>
    let page = 1;
    const productId = {{ $product->id }};

    function renderStars(rating) {
        let stars = '';
        for (let i = 1; i <= 5; i++) {
            stars += `<i class="fas fa-star${i <= rating ? '' : '-o'} text-warning"></i>`;
        }
        return stars;
    }

    function loadRatings(initial = false) {
        $.ajax({
            url: `/product/${productId}/ratings?page=${page}`,
            type: "GET",
            success: function (res) {
                res.ratings.data.forEach(rating => {
                    $('#ratings-list').append(`
                        <div class="border p-3 mb-3">
                            <div class="d-flex justify-content-between">
                                <strong>${rating.username}</strong>
                                <span>${renderStars(rating.rating)}</span>
                            </div>
                            <p class="mb-0">${rating.comment}</p>
                        </div>
                    `);
                });

                if (initial) {
                    // Summary for main section
                    let summaryHtml = `
                        <h4>${res.average} out of 5</h4>
                        <div>${renderStars(Math.round(res.average))}</div>
                        <p class="text-muted">${res.total} ratings</p>
                    `;

                    // ✅ Rating distribution chart (keep this)
                    for (let i = 5; i >= 1; i--) {
                        let count = res.distribution[i] ?? 0;
                        if (count === 0) continue;
                        let percent = res.total ? (count / res.total * 100).toFixed(1) : 0;
                        summaryHtml += `
                            <div class="d-flex align-items-center mb-1">
                                <span class="me-2">${i}★</span>
                                <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: ${percent}%"></div>
                                </div>
                                <span>${count}</span>
                            </div>
                        `;
                    }

                    // ⬇️ Set main summary
                    $('#rating-summary').html(summaryHtml);

                    // Top summary (without distribution)
                    let topSummaryHtml = `
                        <h4>${res.average} out of 5</h4>
                        <div>${renderStars(Math.round(res.average))}</div>
                        <p class="text-muted">${res.total} ratings</p>
                    `;
                    $('#rating-summary-top').html(topSummaryHtml);
                }

                $('#load-more').toggle(!!res.ratings.next_page_url);
            }
        });
    }

    $(document).ready(function () {
        loadRatings(true);

        $('#load-more').click(function () {
            page++;
            loadRatings();
        });

        $('#productRatingForm').submit(function (e) {
            e.preventDefault();
            $('#productRatingForm .text-danger').text('');

            $.ajax({
                url: '{{ route("front.saveRating", $product->id) }}',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (res) {
                    if (res.status) {
                        $('#productRatingForm')[0].reset();
                        alert(res.message);
                        $('#ratings-list').empty();
                        $('#rating-summary').empty();
                        $('#rating-summary-top').empty();
                        page = 1;
                        loadRatings(true);
                    } else if (res.errors) {
                        if (res.errors.name) {
                            $('#name').siblings('.text-danger').text(res.errors.name[0]);
                        }
                        if (res.errors.email) {
                            $('#email').siblings('.text-danger').text(res.errors.email[0]);
                        }
                        if (res.errors.rating) {
                            $('.product-rating-error').text(res.errors.rating[0]);
                        }
                        if (res.errors.comment) {
                            $('#comment').siblings('.text-danger').text(res.errors.comment[0]);
                        }
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422 && xhr.responseJSON?.errors) {
                        const errors = xhr.responseJSON.errors;
                        if (errors.name) {
                            $('#name').siblings('.text-danger').text(errors.name[0]);
                        }
                        if (errors.email) {
                            $('#email').siblings('.text-danger').text(errors.email[0]);
                        }
                        if (errors.rating) {
                            $('.product-rating-error').text(errors.rating[0]);
                        }
                        if (errors.comment) {
                            $('#comment').siblings('.text-danger').text(errors.comment[0]);
                        }
                    } else {
                        alert('Something went wrong.');
                    }
                }
            });
        });
    });
</script>


@endsection

