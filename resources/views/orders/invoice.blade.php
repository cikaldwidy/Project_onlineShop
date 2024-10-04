@extends('layouts.base')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>{{ __('Invoice') }}</h4>
                    </div>

                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <h5 class="mb-3">Detail Pesanan:</h5>
                                <div>
                                    <strong>Nomor Order:</strong> {{ $order->id }}<br>
                                    <strong>Tanggal Pesanan:</strong> {{ $order->created_at->format('d/m/Y H:i:s') }}<br>
                                    <strong>Status:</strong> {{ $order->status }}<br>
                                    <strong>Total Pembayaran:</strong> ${{ $order->total }}<br>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <h5 class="mb-3">Informasi Pengiriman:</h5>
                                <div>
                                    <strong>Nama Penerima:</strong> {{ $order->full_name }}<br>
                                    <strong>Alamat Pengiriman:</strong> {{ $order->address }}<br>
                                    <strong>Nomor Telepon:</strong> {{ $order->phone }}<br>
                                    <strong>Email:</strong> {{ $order->email }}<br>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive-sm">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="bg-dark text-white">
                                        <th class="text-center">#</th>
                                        <th>Nama Produk</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->product->name }}</td>
                                            <td class="text-center">${{ $item->price }}</td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-center">${{ $item->price * $item->quantity }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-lg-8 col-sm-7">
                            </div>

                            <div class="col-lg-4 col-sm-5">
                                <table class="table table-clear">
                                    <tbody>
                                        <tr>
                                            <td class="left"><strong>Subtotal</strong></td>
                                            <td class="text-right">${{ $order->total }}</td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Pajak (10%)</strong></td>
                                            <td class="text-right">${{ $order->total * 0.1 }}</td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Total</strong></td>
                                            <td class="text-right">
                                                <strong>${{ $order->total + $order->total * 0.1 }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row justify-content-center mt-4">
                            <div class="col-md-4">
                                <a href="{{ route('cart.index') }}" class="btn btn-secondary btn-block">
                                    <i class="fas fa-arrow-left"></i> Kembali ke Keranjang Belanja
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
