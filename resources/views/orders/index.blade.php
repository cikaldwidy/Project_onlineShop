@extends('layouts.base')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('My Orders') }}</div>




                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('No.Resi') }}</th>
                                    <th>{{ __('Total') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Alamat Lengkap') }}</th>
                                    <th>{{ __('No.Telp') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>${{ $order->total }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $order->phone }}</td>

                                        <td>
                                            <a href="{{ route('orders.invoice', $order->id) }}"
                                                class="btn btn-primary">{{ __('View Invoice') }}</a>
                                        </td>
                                    </tr>
                                @endforeach

                                </li>
                            </tbody>
                        </table>
                        <li><a href="{{ route('cart.index') }}" class="btn btn-warning mt-5">Keranjang Belanja</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
