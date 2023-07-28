@extends('admin.layouts.master')

@section('title', 'Cart')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
@endpush

@section('sidebar')
    @include('admin.layouts.sidebar')
@endsection

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

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

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Cart</h3>
                    @if($cartItems->isNotEmpty())
                        <p class="text-subtitle text-muted">User's Cart - Owner: {{ $cartItems->first()->user->name }}</p>
                    @endif
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" id="cartTable">
                        <thead>
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">User</th>
                                <th rowspan="2">Product Name</th>
                                <th rowspan="2">Quantity</th>
                                <th rowspan="2">Price</th>
                                <th rowspan="2">Total</th>
                                <th rowspan="2" width="135px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $index => $cartItem)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $cartItem->user->name }}</td>
                                    <td>{{ $cartItem->product->name }}</td>
                                    <td>{{ $cartItem->quantity }}</td>
                                    <td>{{ $cartItem->product->price }}</td>
                                    <td>{{ $cartItem->subtotal }}</td>
                                    <td>
                                        <a href="{{ route('carts.edit', $cartItem->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i></a>
                                        <form action="{{ route('carts.remove', $cartItem->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection

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
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        // Inisialisasi DataTable
        let cartTable = document.querySelector('#cartTable');
        let dataTable = new simpleDatatables.DataTable(cartTable);
    </script>
@endpush
