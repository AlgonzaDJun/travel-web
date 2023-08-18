@extends('layouts.success')

@section('title', 'Success')

@section('content')
    <main>
        <div class="section-success d-flex align-items-center">
            <div class="col text-center">
                <img src="{{ url('frontend/images/ic_mail.png') }}" alt="Email">
                <h1>Oops!</h1>
                <p>
                    Your Transactions is unfinished
                </p>

                <a href="{{ url('/') }}" class="btn btn-home-page mt-3 px-5">Home Page</a>
            </div>
        </div>
    </main>
@endsection

@push('addon-script')
    <script>
        // sweetalert
        // Swal.fire({
        //     title: 'Success!',
        //     text: 'Your order has been placed',
        //     icon: 'success',
        // })
    </script>
@endpush
