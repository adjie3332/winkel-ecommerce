@extends('home.layouts.master')

@section('title', 'Wikel')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
    <a class="navbar-brand" href="index.html">Winkel</a>
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
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 ftco-animate">
                <form action="{{ route('checkout-ceklist.store') }}" method="POST" class="billing-form">
                    @csrf
                    <h3 class="mb-4 billing-heading">Billing Details</h3>
                    <div class="row align-items-end">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">Nama Depan</label>
                                <input type="text" name="nama_depan" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Nama Belakang</label>
                                <input type="text" name="nama_belakang" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Nomor Telepon</label>
                                <input type="text" name="no_tlpn" class="form-control" required placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="emailaddress">Alamat Email</label>
                                <input type="text" name="email" class="form-control" required placeholder="">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="country">Provinsi</label>
                                <div class="select-wrap">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select name="province" id="province" class="form-control">
                                        <option value="" disabled selected>Pilih Provinsi</option>
                                        @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Kabupaten</label>
                                <div class="select-wrap">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select name="regency" id="regency" class="form-control">
                                        <option value="" disabled selected>Pilih Kabupaten</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Kecamatan</label>
                                <div class="select-wrap">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select name="district" id="district" class="form-control">
                                        <option value="" disabled selected>Pilih Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="streetaddress">Alamat Detail</label>
                                <input type="text" name="detail_alamat" class="form-control" placeholder="Nomor Rumah, Gang, dan Nama Jalan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="postcodezip">Kode Pos / ZIP *</label>
                                <input type="text" name="kode_pos" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="towncity">Town / City</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                        </div> -->

                        <div class="w-100"></div>

                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group mt-4">
                                <!-- <div class="radio">
                                    <label class="mr-3"><input type="radio" name="optradio"> Create an Account? </label>
                                    <label><input type="radio" name="optradio"> Ship to different address</label>
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5 pt-3 d-flex">
                        <div class="col-md-6 d-flex">
                            <div class="cart-detail cart-total bg-light p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Cart Total</h3>
                                <p class="d-flex">
                                    <span>Subtotal</span>
                                    <span> Rp {{ $subtotal }}</span>
                                </p>
                                <p class="d-flex">
                                    <span>Delivery</span>
                                    <span>Rp {{ $deliveryCost }}</span>
                                </p>
                                <!-- <p class="d-flex">
                                <span>Discount</span>
                                <span></span>
                            </p> -->
                                <hr>
                                <p class="d-flex total-price">
                                    <span>Total</span>
                                    <span name="total">Rp {{ $subtotal + $deliveryCost}} </span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="cart-detail bg-light p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Metode Pembayaran</h3>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="metode_pembayaran" value="Direct Bank Tranfer" class="mr-2"> Direct Bank Tranfer</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="metode_pembayaran" value="DANA Payment" class="mr-2"> DANA Payment</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="metode_pembayaran" value="Paypal" class="mr-2"> Paypal</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" class="mr-2"> I have read and accept the terms and conditions</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary py-3 px-4">Place an order</button>

                            </div>
                        </div>
                    </div>
                </form><!-- END -->




            </div> <!-- .col-md-8 -->
        </div>
    </div>
</section>
<!-- End Checkout Ui -->
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
    // var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function() {
        $('#province').change(function() {
            var provinceId = $(this).val();

            $.ajax({
                type: "POST",
                url: "{{ route('checkout.getRegencies') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    province_id: provinceId
                },
                success: function(response) {
                    console.log(response);
                    var options = "<option value='' disabled selected>Pilih Kabupaten</option>";
                    response.forEach(function(regency) {
                        options += "<option value='" + regency.id + "'>" + regency.name + "</option>";
                    });
                    $('#regency').html(options);
                }
            });
        });

        $('#regency').change(function() {
            var regencyId = $(this).val();

            $.ajax({
                type: "POST",
                url: "{{ route('checkout.getDistricts') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    regency_id: regencyId
                },
                success: function(response) {
                    var options = "<option value='' disabled selected>Pilih Kecamatan</option>";
                    response.forEach(function(district) {
                        options += "<option value='" + district.id + "'>" + district.name + "</option>";
                    });
                    $('#district').html(options);
                }
            });
        });


    });
</script>

@endpush
