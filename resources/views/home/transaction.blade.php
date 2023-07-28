@extends('home.layouts.master')

@section('title', 'Winkel')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap");body{background-color: #eee;font-family: "Poppins", sans-serif;font-weight: 300}.cart{height: 100vh}.progresses{display: flex;align-items: center}.line{width: 76px;height: 6px;background: #63d19e}.steps{display: flex;background-color: #63d19e;color: #fff;font-size: 12px;width: 30px;height: 30px;align-items: center;justify-content: center;border-radius: 50%}.check1{display: flex;background-color: #63d19e;color: #fff;font-size: 17px;width: 60px;height: 60px;align-items: center;justify-content: center;border-radius: 50%;margin-bottom: 10px}.invoice-link{font-size: 15px}.order-button{height: 50px}.background-muted{background-color:#fafafc}
    </style>
@endpush

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">Winkel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
    </button>

    <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Shop</a></li>
        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">About</a></li>
        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Contact</a></li>
        <li class="nav-item cta cta-colored"><a href="/cart" class="nav-link"><span class="icon-shopping_cart"></span></a></li>
        </ul>
    </div>
    </div>
</nav>

<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                                <th>Transaction ID</th>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Address</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($checkouts as $checkout)
                                    <tr class="text-center">
                                        <td>{{ $checkout->id }}</td>
                                        <td class="image-prod">
                                            <div class="img" style="background-image:url({{ asset('storage/images/'.$checkout->product->image) }});"></div>
                                        </td>
                                        <td>
                                            <h3>{{ $checkout->product->name }}</h3>
                                            <p>{{ $checkout->product->description }}</p>
                                        </td>
                                        <td>{{ $checkout->detail_alamat .', '. $kecamatan->name.', '. $kota_kabupaten->name.', '. $provinsi->name.', '. $checkout->kode_pos }}</td>
                                        <td>Rp. {{ $checkout->product->price }}</td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate text-center">
                <h3>Status</h3>
                <div class="cart-total d-flex" style="align-items: center; justify-content: center;">
                    <div class="progresses">
                        @if ($checkout->status == "pending")
                        <div class="steps"> <span><i class="fa fa-refresh"></i></span> </div>
                        @elseif ($checkout->status == "shipped")
                        <div class="steps"> <span><i class="fa fa-refresh"></i></span> </div>
                        <span class="line"></span>
                        <div class="steps"> <span><i class="fa fa-truck"></i></span> </div>
                        @endif
                    </div>
                </div>
                <div class="ml-4">
                    <span class="btn btn-primary" style="background-color: {{ $checkout->status == 'pending' ? '#ff9800' : '#63d19e' }}; border-color: white; hover: none;">
                        {{ $checkout->status == 'pending' ? 'Pending' : 'Shipped' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
