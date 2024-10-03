<header class="py-2">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">

            <div class="logo">
                <a href="#">Tendora</a>
            </div>

            <nav class="d-flex flex-grow-1 justify-content-start">
                <ul class="nav">
                    <li class="nav-item_2">
                        <a class="nav-link" href="#">Shop <i class="arrow-down"></i></a>
                    </li>
                    <div class="custom_menu_2 mega_menu">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-3 text-left">
                                    <div class="mage_title">
                                        <h2>Category Details</h2>
                                        <ul>
                                            @foreach($data as $index => $category)
                                                @if($index >= 0 && $index < 7)
                                                    <li><a href="#">{{ $category->title }}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-3 text-left">
                                    <br>
                                    <ul class="meta_title">
                                        @foreach($data as $index => $category)
                                            @if($index >= 7 && $index < 14)
                                                <li><a href="#">{{ $category->title }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-3 text-left">
                                    <br>
                                    <ul class="meta_title">
                                        @foreach($data as $index => $category)
                                            @if($index >= 14 && $index < 21)
                                                <li><a href="#">{{ $category->title }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-3 text-left">
                                    <div class="img_fashion">
                                        <img src="{{ asset('front_assets/img/shop-mega-menu-img-600x637.jpg') }}" alt="image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <li class="nav-item_3">
                        <a class="nav-link" href="#">Product <i class="arrow-down"></i></a>
                    </li>
                    <div class="custom_menu_3 mega_menu">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-3 text-left">
                                    <div class="mage_title">
                                        <h2>Product Details</h2>
                                        <ul>
                                            @foreach($products as $index => $prod)
                                                @if($index >= 0 && $index < 7)
                                                    <li><a href="#">{{ $prod->title }}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-3 text-left">
                                    <br>
                                    <ul class="meta_title">
                                        @foreach($products as $index => $prod)
                                            @if($index >= 7 && $index < 14)
                                                <li><a href="#">{{ $prod->title }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-3 text-left">
                                    <br>
                                    <ul class="meta_title">
                                        @foreach($products as $index => $prod)
                                            @if($index >= 14 && $index < 21)
                                                <li><a href="#">{{ $prod->title }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-3 text-left">
                                    <div class="img_fashion">
                                        <img src="{{ asset('front_assets/img/product-mega-menu-img.jpg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <li class="nav-item_4">
                        <a class="nav-link" href="#">Pages<i class="arrow-down"></i></a>
                    </li>
                    <div class="custom_menu_4 mega_menu" style="top: 60px; width: 1600px; position: fixed; left: 50%; transform: translateX(-50%)">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-3 text-left">
                                    <div class="mage_title">
                                        <h2>Demo Pages</h2>
                                        <ul>
                                            <li><a href="#">Big Shopping</a></li>
                                            <li><a href="#">Women Fashion</a></li>
                                            <li><a href="#">Fashion Jewellery</a></li>
                                            <li><a href="#">Wrist Watch</a></li>
                                            <li><a href="#">Lingerie Store</a></li>
                                            <li><a href="#">Fashion Store</a></li>
                                            <li><a href="#">Footer Sneakers</a></li>
                                            <li><a href="#">Home Decoration</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-3 text-left">
                                    <br>
                                    <br>
                                    <ul class="meta_title">
                                        <li><a href="#">Winter Fashion</a></li>
                                        <li><a href="#">Yoga Accessories</a></li>
                                        <li><a href="#">Kids Fashion</a></li>
                                        <li><a href="#">Footwear Boots</a></li>
                                        <li><a href="#">Bridal Fashion</a></li>
                                        <li><a href="#">Cosmetics</a></li>
                                        <li><a href="#">Season Sale</a></li>
                                    </ul>
                                </div>
                                <div class="col-3 text-left">
                                    <br>
                                    <br>
                                    <ul class="meta_title">
                                        <li><a href="#">Winter Fashion</a></li>
                                        <li><a href="#">Yoga Accessories</a></li>
                                        <li><a href="#">Kids Fashion</a></li>
                                        <li><a href="#">Footwear Boots</a></li>
                                        <li><a href="#">Bridal Fashion</a></li>
                                        <li><a href="#">Cosmetics</a></li>
                                        <li><a href="#">Season Sale</a></li>
                                    </ul>
                                </div>
                                <div class="col-3 text-left">
                                    <div class="img_fashion">
                                        <img src="{{ asset('front_assets/img/shop-mega-menu-img-600x637.jpg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </ul>
            </nav>

            <div class="right_search_bar">
                <form action="" class="search-tebdora-btn">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                    <i class="fa-regular fa-user"></i>
                    <i class="fa-regular fa-heart"></i>
                    <i class="fa-solid fa-cart-shopping"></i>
                </form>
            </div>

            <div class="menu-container-mobile">
                <div class="menu-btn" id="menuBtn">
                    <div class="menu-icon"></div>
                    <div class="menu-icon"></div>
                    <div class="menu-icon"></div>
                </div>
                <nav class="side-menu" id="sideMenu">
                    <div class="logo">
                        <a href="#">Tendora</a>
                    </div>
                    <ul>
                        <li>
                            <a href="#">Company <i class="fa fa-angle-down" style="font-size:24px"></i></a>
                            <ul class="sub_menu">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Life at Technomarch</a></li>
                                <li><a href="#">Technology Partners</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Services <i class="fa fa-angle-down" style="font-size:24px"></i></a>
                            <ul class="sub_menu">
                                <li><a href="#">Manage IT Services</a></li>
                                <li><a href="#">NOC Services</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Hire <i class="fa fa-angle-down" style="font-size:24px"></i></a>
                            <ul class="sub_menu">
                                <li><a href="#">Home</a></li>
                                <li><a href="#">About</a></li>
                                <li><a href="#">Services</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Resources <i class="fa fa-angle-down" style="font-size:24px"></i></a>
                            <ul class="sub_menu">
                                <li><a href="#">Home</a></li>
                                <li><a href="#">About</a></li>
                                <li><a href="#">Services</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Contact</a></li>

                        <form action="">
                            <input type="text" placeholder="Search.." name="search">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                        <div class="main_icoooo">
                            <i class="fa-regular fa-user"></i>
                            <i class="fa-regular fa-heart"></i>
                            <i class="fa-solid fa-cart-shopping"></i>
                        </div>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
</header>
