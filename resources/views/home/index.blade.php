@extends('home.layouts.master')

@section('title', 'Wikel')

@section('content')
    <div class="py-1 bg-black">
        <div class="container">
            <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
                <div class="col-lg-12 d-block">
                    <div class="row d-flex">
                        @auth
                            <!-- Tampilkan nama user yang login -->
                            <span class="text-white ml-3">Welcome, {{ auth()->user()->name }}</span>
                            <a href="{{ route('logout') }}" class="text-white ml-3" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="icon-sign-out"></i>Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @else
                            <!-- Tampilkan link Login dan Register jika belum login -->
                            <a href="{{ route('login') }}" class="text-white ml-3"><i class="icon-user"></i> Login</a>
                            <a href="{{ route('register') }}" class="text-white ml-3"><i class="icon-user-plus"></i> Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif (session('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Warning!</strong> {{ session('warning') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif (session('info'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Info!</strong> {{ session('info') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Winkel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="#home-section" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="#product" class="nav-link">Shop</a></li>
            <li class="nav-item"><a href="#about" class="nav-link">About</a></li>
            <li class="nav-item"><a href="#contact" class="nav-link">Contact</a></li>
                @auth
                    <li class="nav-item">
                        <a href="{{ route('transaction') }}" class="nav-link">Transaction</a>
                    </li>
                @endauth
            <li class="nav-item cta cta-colored">
                @if (auth()->user())
                    <a href="{{ route('cart.index') }}" class="nav-link"><span class="icon-shopping_cart"></span>[{{ $cartTotalQuantity }}]</a>
                @else
                    <a href="{{ route('cart.index') }}" class="nav-link"><span class="icon-shopping_cart"></span>[0]</a>
                @endif
            </li>
            </ul>
        </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <!-- Home -->

    <section id="home-section" class="hero">
		  <div class="home-slider js-fullheight owl-carousel">
	      <div class="slider-item js-fullheight">
	      	<div class="overlay"></div>
	        <div class="container-fluid p-0">
	          <div class="row d-md-flex no-gutters slider-text js-fullheight align-items-center justify-content-end" data-scrollax-parent="true">
	          	<div class="one-third order-md-last img js-fullheight" style="background-image:url({{ asset('/templates/images/bg_1.jpg') }});">
	          	</div>
		          <div class="one-forth d-flex js-fullheight align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
		          	<div class="text">
		          		<span class="subheading">Winkel eCommerce Shop</span>
		          		<div class="horizontal">
		          			<h3 class="vr" style="background-image: url(images/divider.jpg);">Stablished Since 2000</h3>
				            <h1 class="mb-4 mt-3">Catch Your Own <br><span>Stylish &amp; Look</span></h1>
				            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country.</p>

				            <p><a href="#product" class="btn bg-secondary px-5 py-3 mt-3">Discover Now</a></p>
				          </div>
		            </div>
		          </div>
	        	</div>
	        </div>
	      </div>

	      <div class="slider-item js-fullheight">
	      	<div class="overlay"></div>
	        <div class="container-fluid p-0">
	          <div class="row d-flex no-gutters slider-text js-fullheight align-items-center justify-content-end" data-scrollax-parent="true">
	          	<div class="one-third order-md-last img js-fullheight" style="background-image:url({{ asset('/templates/images/bg_2.jpg') }});">
	          	</div>
		          <div class="one-forth d-flex js-fullheight align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
		          	<div class="text">
		          		<span class="subheading">Winkel eCommerce Shop</span>
		          		<div class="horizontal">
		          			<h3 class="vr" style="background-image: url({{ asset('/templates/images/divider.jpg') }});">Best eCommerce Online Shop</h3>
				            <h1 class="mb-4 mt-3">A Thouroughly <span>Modern</span> Woman</h1>
				            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country.</p>

				            <p><a href="#product" class="btn btn-primary px-5 py-3 mt-3">Shop Now</a></p>
				          </div>
		            </div>
		          </div>
	        	</div>
	        </div>
	      </div>
	    </div>
    </section>

    <!-- END Home -->

    <!-- Product -->

    <section id="product" class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h2 class="mb-4">Products</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
                    <div class="btn-group" role="group" aria-label="Category">
                        <button class="btn filter-btn" data-filter="all" style="background-color: #ffa45c; color: white;">All</button>
                        @foreach ($categories as $category)
                            <button class="btn filter-btn" style="background-color: #ffa45c; color: white;" data-filter="{{ $category->id }}">{{ $category->name }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="col-md-12">
            <div class="carousel-testimony owl-carousel owl-carousel2">
                @foreach ($products as $product)
                        <div class="item">
                            <div class="product" data-category="{{ $product->category_id }}">
                                <a href="#" class="img-prod">
                                    <img class="img-fluid" src="{{ asset('storage/images/'.$product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                </a>
                                <div class="overlay"></div>
                                <div class="text py-3 px-3">
                                    <h3><a href="#">{{ $product->name }}</a></h3>
                                    <div class="d-flex">
                                        <div class="pricing">
                                            <p class="price">
                                                <span class="price-sale">Rp. {{ $product->price }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <p class="bottom-area d-flex px-3">
                                        <form action="{{ route('cart.add') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="btn btn-primary" style="background-color: #ffa45c; color: white;"> Add to cart <i class="ion-ios-cart ml-1"></i></button>
                                        </form>
                                    </p>
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- End Product -->

    <!-- Gender Product -->

    <section class="ftco-section ftco-choose ftco-no-pb ftco-no-pt">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-8 d-flex align-items-stretch">
    				<div class="img" style="background-image: url({{ asset('/templates/images/about-1.jpg') }});"></div>
    			</div>
    			<div class="col-md-4 py-md-5 ftco-animate">
    				<div class="text py-3 py-md-5">
	            <h2 class="mb-4">New Women's Clothing Summer Collection</h2>
	            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
	            <p><a href="#" class="btn btn-white px-4 py-3">Shop now</a></p>
    				</div>
    			</div>
    		</div>

    		<div class="row">
    			<div class="col-md-5 order-md-last d-flex align-items-stretch">
    				<div class="img img-2" style="background-image: url({{ asset('/templates/images/about-2.jpg') }});"></div>
    			</div>
    			<div class="col-md-7 py-3 py-md-5 ftco-animate">
    				<div class="text text-2 py-md-5">
	            <h2 class="mb-4">New Men's Clothing Summer Collection</h2>
	            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
	            <p><a href="#" class="btn btn-white px-4 py-3">Shop now</a></p>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>

    <!-- End Gender Product -->

    <!-- Delivery -->

    <section id="about" class="ftco-section ftco-no-pb ftco-no-pt bg-light">
			<div class="container">
				<div class="row">
					<div class="col-md-5 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url({{ asset('/templates/images/about.jpg') }});">
						<a href="https://vimeo.com/45830194" class="icon popup-vimeo d-flex justify-content-center align-items-center">
							<span class="icon-play"></span>
						</a>
					</div>
					<div class="col-md-7 py-5 wrap-about pb-md-5 ftco-animate">
	          <div class="heading-section-bold mb-4 mt-md-5">
	          	<div class="ml-md-0">
		            <h2 class="mb-4">Better Way to Ship Your Products</h2>
	            </div>
	          </div>
	          <div class="pb-md-5">
							<p>But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their.</p>
							<div class="row ftco-services">
			          <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
			            <div class="media block-6 services">
			              <div class="icon d-flex justify-content-center align-items-center mb-4">
			            		<span class="flaticon-002-recommended"></span>
			              </div>
			              <div class="media-body">
			                <h3 class="heading">Refund Policy</h3>
			                <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
			              </div>
			            </div>
			          </div>
			          <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
			            <div class="media block-6 services">
			              <div class="icon d-flex justify-content-center align-items-center mb-4">
			            		<span class="flaticon-001-box"></span>
			              </div>
			              <div class="media-body">
			                <h3 class="heading">Premium Packaging</h3>
			                <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
			              </div>
			            </div>
			          </div>
			          <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
			            <div class="media block-6 services">
			              <div class="icon d-flex justify-content-center align-items-center mb-4">
			            		<span class="flaticon-003-medal"></span>
			              </div>
			              <div class="media-body">
			                <h3 class="heading">Superior Quality</h3>
			                <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
			              </div>
			            </div>
			          </div>
			        </div>
						</div>
					</div>
				</div>
			</div>
		</section>

    <!-- End Delivery -->

    <section class="ftco-section testimony-section">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate">
            <h2 class="mb-4">Our satisfied customer says</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in</p>
          </div>
        </div>
        <div class="row ftco-animate">
            <div class="col-md-4">
                <div class="testimony-wrap p-4 pb-5">
                <div class="user-img mb-5" style="background-image: url(images/person_1.jpg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                    <i class="icon-quote-left"></i>
                    </span>
                </div>
                <div class="text">
                    <p class="mb-5 pl-4 line">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Aji Santoso</p>
                    <span class="position">Software Engineering</span>
                </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimony-wrap p-4 pb-5">
                <div class="user-img mb-5" style="background-image: url(images/person_2.jpg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                    <i class="icon-quote-left"></i>
                    </span>
                </div>
                <div class="text">
                    <p class="mb-5 pl-4 line">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Farhan Mirza</p>
                    <span class="position">Interface Designer</span>
                </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimony-wrap p-4 pb-5">
                <div class="user-img mb-5" style="background-image: url(images/person_3.jpg)">
                    <span class="quote d-flex align-items-center justify-content-center">
                    <i class="icon-quote-left"></i>
                    </span>
                </div>
                <div class="text">
                    <p class="mb-5 pl-4 line">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Siswadi Perdana</p>
                    <span class="position">UI Designer</span>
                </div>
                </div>
            </div>
        </div>
      </div>
    </section>
		<hr>

    <!-- Contact -->
	<section id="contact" class="ftco-section-parallax">
      <div class="parallax-img d-flex align-items-center">
        <div class="container">
          <div class="row d-flex justify-content-center py-5">
            <div class="col-md-7 text-center heading-section ftco-animate">
              <h2>Subcribe to our Newsletter</h2>
              <div class="row d-flex justify-content-center mt-5">
                <div class="col-md-8">
                  <form action="#" class="subscribe-form">
                    <div class="form-group d-flex">
                      <input type="text" class="form-control" placeholder="Enter email address">
                      <input type="submit" value="Subscribe" class="submit px-3">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- End Contact -->
@endsection

    <!-- Footer -->
@section('footer')
    @include('home.layouts.footer')
@endsection
    <!-- End Footer -->
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Menghilangkan alert secara otomatis setelah 3 detik
            setTimeout(function() {
                $(".alert").alert('close');
            }, 3000);
        });
    </script>
    <script>
        $(document).ready(function() {
            // Tambahkan class 'active' pada tombol filter saat diklik
            $('.filter-btn').click(function() {
                $('.filter-btn').removeClass('active');
                $(this).addClass('active');

                // Mendapatkan nilai data-filter dari tombol yang diklik
                const filterValue = $(this).data('filter');

                // Perbarui URL dengan parameter 'category' berdasarkan kategori yang dipilih
                const currentURL = new URL(window.location.href);
                currentURL.searchParams.set('category', filterValue);
                window.history.replaceState({}, '', currentURL);

                // Sembunyikan semua item produk
                $('.product').hide();

                // Tampilkan item produk sesuai dengan kategori yang dipilih
                if (filterValue === 'all') {
                    $('.product').show();
                } else {
                    $(`.product[data-category="${filterValue}"]`).show();
                }
            });
        });
    </script>
@endpush

