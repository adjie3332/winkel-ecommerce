@extends('home.layouts.master')

@section('title', 'Wikel')

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
        <li class="nav-item cta cta-colored"><a href="{{ route('cart.index') }}" class="nav-link"><span class="icon-shopping_cart"></span></a></li>
        </ul>
    </div>
    </div>
</nav>
<div class="container mt-4 mb-4">
    <div class="row d-flex cart align-items-center justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="d-flex justify-content-center border-bottom">
                    <div class="p-3">
                        <div class="">
                            <div> <span class="font-weight-bold">Order Information</span> </div>
                        </div>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-md-6 border-right p-5">
                        <div class="text-center order-details">
                            <div class="d-flex justify-content-center mb-5 flex-column align-items-center"> <span class="check1"><i class="fa fa-check"></i></span> <span class="font-weight-bold">Order Confirmed</span> <small class="mt-2">Your illustration will go to you soon</small>
                            </div>
                            <a href="{{ route('transaction') }}" class="btn btn-danger btn-block order-button">Go to Transaction</a>
                        </div>
                    </div>
                    <div class="col-md-6 background-muted">
                        <!-- Menampilkan informasi Product -->
                        <div class="row g-0 border-bottom">
                            <div class="col-md-5">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span class="font-weight-bold">Product</span> </div>
                            </div>
                            <div class="col-md-5">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span>{{ $product->name }}</span> </div>
                            </div>
                        </div>

                        <!-- Menampilkan informasi Alamat -->
                        <div class="row g-0 border-bottom">
                            <div class="col-md-5">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span class="font-weight-bold">Address</span> </div>
                            </div>
                            <div class="col-md-5">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span>{{ $checkout->detail_alamat .', '. $kecamatan->name.', '. $kota_kabupaten->name.', '. $provinsi->name.', '. $checkout->kode_pos }}</span> </div>
                            </div>
                        </div>

                        <!-- Menampilkan informasi Nama Penerima -->
                        <div class="row g-0 border-bottom">
                            <div class="col-md-5">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span class="font-weight-bold">Nama Penerima</span> </div>
                            </div>
                            <div class="col-md-5">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span>{{ $checkout->nama_depan .' '. $checkout->nama_belakang }}</span> </div>
                            </div>
                        </div>
                        <div class="row g-0 border-bottom">
                            <div class="col-md-5 border-right">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span>Status</span> </div>
                            </div>
                            <div class="col-md-5">
                                <div class="p-3 d-flex justify-content-center align-items-center">
                                    @if ($checkout->status == "pending")
                                    <span class="badge badge-warning">Pending</span>
                                    @elseif ($checkout->status == "shipped")
                                    <span class="badge badge-success">Shipped</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Additional section for Order ID and Date -->
                        <div class="row g-0 border-bottom">
                            <div class="col-md-5 border-right">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span class="font-weight-bold">Order ID</span> </div>
                            </div>
                            <div class="col-md-5">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span>{{ $checkout->id }}</span> </div>
                            </div>
                        </div>
                        <div class="row g-0 border-bottom">
                            <div class="col-md-5 border-right">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span class="font-weight-bold">Date</span> </div>
                            </div>
                            <div class="col-md-5">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span>{{ $checkout->created_at->format('F j, Y') }}</span> </div>
                            </div>
                        </div>
                        <div class="row g-0">
                            <div class="col-md-5 border-right">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span class="font-weight-bold">Total</span> </div>
                            </div>
                            <div class="col-md-5">
                                <div class="p-3 d-flex justify-content-center align-items-center"> <span class="font-weight-bold">Rp. {{ $checkout->total }} </span> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $('#successModal').modal('show');
    });
</script>

@endpush
