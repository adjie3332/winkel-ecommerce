@extends('admin.layouts.master')

@section('title', 'Orders')

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
                    <h3>Checklist Pesanan</h3>
                    <p class="text-subtitle text-muted">List pesanan yang perlu di-checklist</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Checklist Pesanan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <!-- Tambahkan tombol untuk melakukan checklist -->
                {{-- <a href="" class="btn btn-primary"><i class="bi bi-plus"></i>Add Orders</a> --}}
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Pesanan</th>
                            <th>Nama Penerima</th>
                            <th>Alamat</th>
                            <th>Produk</th>
                            <th>Status</th>
                            <th>Actions Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $checkout)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $checkout->id }}</td>
                                <td>{{ $checkout->nama_depan. ' '. $checkout->nama_belakang }}</td>
                                <td>{{ $checkout->detail_alamat .', '. $kecamatan->name.', '. $kota_kabupaten->name.', '. $provinsi->name.', '. $checkout->kode_pos }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $checkout->status }}</td>
                                <td>
                                    @if($checkout->status === 'pending')
                                    <form action="{{ route('orders.update', $checkout->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-warning btn-sm">Mark as Shipped</button>
                                    </form>
                                    @elseif($checkout->status === 'shipped')
                                        <button type="submit" class="btn btn-success btn-sm">Completed</button>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('orders.destroy', $checkout->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
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
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
@endpush
