

<ul id="account-panel" class="nav nav-pills flex-column" >
    <li class="nav-item">
        <a href="{{ route("front.account") }}"  class="nav-link font-weight-bold" role="tab" aria-controls="tab-login" aria-expanded="false"><i class="fas fa-user-alt"></i> My Profile</a>
    </li>

    <li class="nav-item">
        <a href="{{ route("front.Password") }}"  class="nav-link font-weight-bold" role="tab" aria-controls="tab-register" aria-expanded="false"><i class="fas fa-lock"></i> Change Password</a>
    </li>

    <li class="nav-item">
        <a href="{{ route('front.order') }}"  class="nav-link font-weight-bold" role="tab" aria-controls="tab-register" aria-expanded="false"><i class="fas fa-shopping-bag"></i>My Orders</a>
    </li>
    <li class="nav-item">
        <a href="{{ route("wishlist.index") }}"  class="nav-link font-weight-bold" role="tab" aria-controls="tab-register" aria-expanded="false"><i class="fas fa-heart"></i> Wishlist</a>
    </li>
    <li class="nav-item">

        <form action="{{ route('account.logout') }}" method="POST" style="display: inline;">
            @csrf
            <li class="nav-item">
                <button type="submit" class=""  role="tab" aria-controls="tab-register" aria-expanded="false">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </li>

        </form>
    </li>


</ul>

