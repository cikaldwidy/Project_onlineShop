@extends('layouts.base')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Order Form') }}</div>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="{{ route('order.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="full_name">{{ __('Full Name') }}</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="email">{{ __('Email') }}</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="address">{{ __('Address') }}</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="phone">{{ __('Phone Number') }}</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="total">{{ __('Total') }}</label>
                                <input type="text" class="form-control" id="total" name="total" readonly
                                    value="{{ Cart::instance('cart')->total() }}">
                            </div>

                            <div class="form-group mt-3 text-bold">
                                <h3>{{ __('Pesanan mu') }} </h3>
                                <br>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Nama Produk') }}</th>
                                            <th>{{ __('Jumlah Pesanan') }}</th>
                                            <th>{{ __('Harga per produk') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Cart::instance('cart')->content() as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>${{ $item->price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-group"> <!-- Menggunakan class text-end untuk mengatur ke kanan -->
                                <button type="submit" class="btn btn-primary">{{ 'Pesan Sekarang' }}</button>
                                <a href="{{ route('orders.index') }}"
                                    class="btn btn-warning ms-2">{{ __('Cek Pesanan') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
