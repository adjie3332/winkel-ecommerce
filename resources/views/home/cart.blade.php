@extends('home.layouts.master')

@section('title', 'Winkel')

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
        <li class="nav-item cta cta-colored"><a href="/cart" class="nav-link"><span class="icon-shopping_cart"></span></a></li>
        </ul>
    </div>
    </div>
</nav>
<!-- Tampilan keranjang belanja -->
<!-- ... -->

<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($cartItems->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">Your cart is empty.</td>
                            </tr>
                            @else
                            <?php $subtotal = 0; ?>
                            @foreach ($cartItems as $item)
                            @if ($item->user_id == auth()->user()->id)
                            <tr class="text-center">
                                <td class="product-remove">
                                    <a href="{{ route('cart.remove', ['id' => $item->id]) }}"><span class="ion-ios-close"></span></a>
                                </td>

                                <td class="image-prod">
                                    <div class="img" style="background-image:url({{ asset('storage/images/'.$item->product->image) }});"></div>
                                </td>

                                <td class="product-name">
                                    <h3>{{ $item->product->name }}</h3>
                                    <p>{{ $item->product->description }}</p>
                                </td>

                                <td class="price">Rp. {{ $item->product->price }}</td>

                                <td class="quantity">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-primary btn-sm quantity-btn" type="button" data-action="decrement" onclick="decrementQuantity({{ $item->id }})">-</button>
                                        </div>
                                        <input type="number" id="quantity_{{ $item->id }}" name="quantity" class="form-control input-number" value="{{ $item->quantity }}" min="1">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary btn-sm quantity-btn" type="button" data-action="increment" onclick="incrementQuantity({{ $item->id }})">+</button>
                                        </div>
                                    </div>
                                </td>
                                <td class="total" id="subtotal_{{ $item->id }}">Rp. {{ $item->subtotal }}</td>
                                <?php $subtotal += $item->subtotal; ?>
                            </tr>
                            @endif
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
                    <h3>Cart Totals</h3>
                    <!-- <p class="d-flex">
                        <span>Subtotal</span>
                        <span id="subtotal">Rp. {{ $subtotal }}</span>
                    </p> -->
                    <!-- <p class="d-flex">
                        <span>Delivery</span>
                        <span>Rp. {{ $deliveryCost }}</span>
                    </p> -->
                    <hr>
                    <p class="d-flex">
                        <span>Total</span>
                        <span id="subtotal">Rp. {{ $subtotal }}</span>
                    </p>
                </div>
                <p class="text-center"><a href="{{ route('checkout.index') }}" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Fungsi untuk menambahkan jumlah
    function incrementQuantity(itemId) {
        var input = document.getElementById('quantity_' + itemId);
        input.value = parseInt(input.value) + 1;
        updateQuantity(input);
    }

    // Fungsi untuk mengurangi jumlah
    function decrementQuantity(itemId) {
        var input = document.getElementById('quantity_' + itemId);
        var currentValue = parseInt(input.value);
        if (currentValue > 1) {
            input.value = currentValue - 1;
            updateQuantity(input);
        }
    }

    // Fungsi untuk memperbarui jumlah dan subtotal
    function updateQuantity(input) {
        var quantity = parseInt(input.value);
        var itemId = input.id.split('_')[1];

        if (!isNaN(quantity) && quantity >= 1) {
            fetch('/cart/update/' + itemId, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        quantity: quantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Perbarui subtotal dan total di bagian tampilan yang relevan
                    var subtotalElement = document.getElementById('subtotal_' + itemId);
                    subtotalElement.innerHTML = 'Rp. ' + data.subtotal;

                    // Hitung ulang subtotal dan total dari semua produk
                    var subtotal = 0;
                    var totalElements = document.getElementsByClassName('total');
                    for (var i = 0; i < totalElements.length; i++) {
                        var subtotalValue = totalElements[i].innerHTML.split(' ')[1];
                        subtotal += parseFloat(subtotalValue);
                    }

                    var subtotalElement = document.getElementById('subtotal');
                    subtotalElement.innerHTML = 'Rp. ' + subtotal;

                    var totalElement = document.getElementById('total');
                    totalElement.innerHTML = 'Rp. ' + (subtotal);
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
</script>
@endpush
