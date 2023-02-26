<!-- Preloading -->
<div class="preloading">
    <div class="wrap-preload">
        <div class="cssload-loader"></div>
    </div>
</div>
<!-- .Preloading -->
<!-- Sidebar left -->
<nav id="sidebarleft" class="sidenav">
    <div id="dismiss">
        <i class="fas fa-times"></i>
    </div>
    <div class="sidebar-header">
        <h3>Account</h3>
    </div>
    <div class="sdprofile">
        <div class="sdp-left">
            <img src="{{ asset('public/m/img/profile4.jpg')}}" alt="profile">
        </div>
        <div class="sdp-right">
            <div class="sd-name">Worldcarrental</div>
            <div class="sd-status">+0 850 888 88 07</div>
        </div>
    </div>
    <ul class="list-unstyled components">
        <li>
            <a href="index.html"><i class="fas fa-home"></i>Home</a>
        </li>
        <li>
            <a href="book_a_car.html"><i class="fas fa-car"></i>Book a car</a>
        </li>
        <li>
            <a href="#pagemybooking" data-toggle="collapse" aria-expanded="false"><i class="fas fa-receipt"></i>My Bookings <span><i class="fas fa-caret-down"></i></span></a>
            <ul class="collapse collapsible-body" id="pagemybooking">
                <li>
                    <a href="my_rides.html">My rides</a>
                </li>
                <li>
                    <a href="cart.html">Cart</a>
                </li>
                <li>
                    <a href="checkout.html">Checkout</a>
                </li>
            </ul>
        </li>
        <li>
        <li>
            <a href="#pagemyaccount" data-toggle="collapse" aria-expanded="false"><i class="fas fa-user"></i>My Account <span><i class="fas fa-caret-down"></i></span></a>
            <ul class="collapse collapsible-body" id="pagemyaccount">
                <li>
                    <a href="profile.html">Profile</a>
                </li>
                <li>
                    <a href="setting.html">Settings</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="car_list.html"><i class="fas fa-car"></i>Car list</a>
        </li>
        <li>
            <a href="destinations.html"><i class="fas fa-map"></i>Destinations</a>
        </li>
        <li>
            <a href="news_list.html"><i class="fas fa-newspaper"></i>News & travel guides</a>
        </li>

        <li>
            <a href="#pagesubmenu" data-toggle="collapse" aria-expanded="false"><i class="fas fa-clone"></i>Pages <span><i class="fas fa-caret-down"></i></span></a>
            <ul class="collapse collapsible-body" id="pagesubmenu">
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li>
                    <a href="car_list.html">Car list</a>
                </li>
                <li>
                    <a href="car_single.html">Car single</a>
                </li>
                <li>
                    <a href="feedback.html">Feedback</a>
                </li>
                <li>
                    <a href="setting.html">Setting</a>
                </li>
                <li>
                    <a href="gallery.html">Gallery</a>
                </li>
                <li>
                    <a href="news_list.html">News list</a>
                </li>
                <li>
                    <a href="news.html">News</a>
                </li>
                <li>
                    <a href="register.html">Register</a>
                </li>
                <li>
                    <a href="login.html">Login</a>
                </li>
                <li>
                    <a href="profile.html">Profile</a>
                </li>
                <li>
                    <a href="single_page.html">Single page</a>
                </li>
                <li>
                    <a href="404.html">404 error page</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#"><i class="fas fa-star"></i>Rate</a>
        </li>
        <li>
            <a href="feedback.html"><i class="fas fa-envelope"></i>Feedback</a>
        </li>

        <li>
            <a href="single_page.html"><i class="fas fa-exclamation-circle"></i>About</a>
        </li>
    </ul>
</nav>
<!-- .Sidebar left -->
<!-- Sidebar right -->
<nav id="sidebarright" class="sidenav">
    <div id="dismiss">
        <i class="fas fa-times"></i>
    </div>
    <div class="sidebar-header">
        <h3>Notifications</h3>
    </div>
    <ul class="right-menu">

        <li class="right-menu-item">
            <a href="#">
                <i class="fas fa-envelope"></i>
                <div class="ntitle">Your transaction was successful</div>
                <div class="desc">lorem ipsum dolor sit amet...</div>
            </a>
        </li>
        <li class="right-menu-item">
            <a href="#">
                <i class="fas fa-star"></i>
                <div class="ntitle">You have received an award</div>
                <div class="desc">lorem ipsum dolor sit amet...</div>
            </a>
        </li>
        <li class="right-menu-item">
            <a href="#">
                <i class="fas fa-car-alt"></i>
                <div class="ntitle">Your tour schedule</div>
                <div class="desc">lorem ipsum dolor sit amet...</div>
            </a>
        </li>
        <li class="right-menu-item">
            <a href="#">
                <i class="fas fa-ticket-alt"></i>
                <div class="ntitle">Promo offer for you today</div>
                <div class="desc">lorem ipsum dolor sit amet...</div>
            </a>
        </li>
        <li class="right-menu-item">
            <a href="#">
                <i class="fas fa-envelope"></i>
                <div class="ntitle">You get a point</div>
                <div class="desc">lorem ipsum dolor sit amet...</div>
            </a>
        </li>

    </ul>
</nav>
<!-- .Sidebar right-->
<!-- Header  -->
<nav class="navbar navbar-expand-lg navbar-light bg-header">
    <div class="container-fluid">
        <button type="button" id="sidebarleftbutton" class="btn">
            <i class="fas fa-align-left"></i>
        </button>
        <div class="logo"><img src="./storage/<?=$data['static']['logo']?>" /></div>
        <button type="button" id="sidebarrightbutton" class="btn">
            <div class="notif">
                <i class="fas fa-bell"></i>
                <i class="fas fa-circle "></i>
            </div>
        </button>
    </div>
</nav>
<!-- .Header  -->
