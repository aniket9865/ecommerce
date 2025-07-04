
<footer class="bg-dark mt-5">
    <div class="container pb-5 pt-3">
        <div class="row">
            <div class="col-md-4">
                <div class="footer-card">
                    <h3>Get In Touch</h3>
                    <p>No dolore ipsum accusam no lorem. <br>
                        123 Street, New York, USA <br>
                        exampl@example.com <br>
                        000 000 0000</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="footer-card">
                    <h3>Important Links</h3>
                    <ul>
                        @if (staticPage()->isNotEmpty())
                            @foreach(staticPage() as $page)
                                <li><a href="{{ route("front.page", $page->slug) }}" title="{{ $page->name }}">{{ $page->name }}</a></li>
                            @endforeach
                        @endif

{{--                        <li><a href="{{ route("front.about") }}" title="About">About</a></li>--}}
{{--                        <li><a href="{{ route("contact.show") }}" title="Contact Us">Contact Us</a></li>--}}
{{--                        <li><a href="#" title="Privacy">Privacy</a></li>--}}
{{--                        <li><a href="#" title="Privacy">Terms & Conditions</a></li>--}}
{{--                        <li><a href="#" title="Privacy">Refund Policy</a></li>--}}
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="footer-card">
                    <h3>My Account</h3>
                    <ul>
                        <li><a href="{{ route('front.account') }}" title="Sell">Login</a></li>
                        <li><a href="{{ route('front.account') }}" title="Advertise">Register</a></li>
                        <li><a href="{{ route('front.order') }}" title="Contact Us">My Orders</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="copy-right text-center">
                        <p>© Copyright 2025 Aniket Deula. All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
