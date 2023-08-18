@extends('layouts.app')

@section('title', 'Orders ')

@section('content')
    <main>
        <section class="section-details-header"></section>
        <section class="section-details-content">
            <div class="container">
                <div class="row">
                    <div class="col p-0">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Profil</li>
                                <li class="breadcrumb-item active">Order Anda</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 p-lg-0">
                        <div class="card card-details">
                            <h1>Riwayat Tiket Anda</h1>
                            <hr class="mb-5">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing=0>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Paket Travel</th>
                                            <th>Visa</th>
                                            <th>Nationality</th>
                                            <th>Total Harga</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            // Get the current page number from the URL query parameter
                                            $currentPage = request()->query('page', 1);
                                            
                                            // Calculate the initial value of $no for the current page
                                            $no = ($currentPage - 1) * $order_history->perPage();
                                        @endphp
                                        @forelse ($order_history as $item_order)
                                            <tr>
                                                <td>{{ ++$no }}</td>
                                                <td>{{ $item_order->travel_package->title }}</td>
                                                <td>
                                                    {{ $item_order->additional_visa > 0 ? $item_order->additional_visa . ' Visa' : 'N/A' }}
                                                </td>
                                                <td>
                                                    {{ $item_order->details->first()->nationality }}
                                                </td>
                                                <td>$ {{ $item_order->transaction_total }}</td>
                                                <td>{{ $item_order->transaction_status }}</td>
                                            </tr>

                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center"
                                                    style="font-size: large; font-weight: bold">Anda Belum melakukan order
                                                    paket
                                                    travel</td>
                                            </tr>
                                        @endforelse

                                        {{ $order_history->links() }}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection

@push('prepend-style')
@endpush

@push('addon-script')
@endpush
