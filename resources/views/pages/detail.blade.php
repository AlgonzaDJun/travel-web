@extends('layouts.app')

@section('title', 'Detail Travel')

@section('content')
    <main>
        <section class="section-details-header"></section>
        <section class="section-details-content">
            <div class="container">
                <div class="row">
                    <div class="col p-0">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Paket Travel</li>
                                <li class="breadcrumb-item active">Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 p-lg-0">
                        <div class="card card-details">
                            <h1>{{ $item->title }}</h1>
                            <p>{{ $item->location }}</p>
                            @if ($item->galleries->count())
                                <div class="gallery">
                                    <div class="xzoom-container">
                                        <img src="{{ Storage::url($item->galleries->first()->image) }}" alt="Details Image"
                                            class="xzoom" id="xzoom-default"
                                            xoriginal="{{ Storage::url($item->galleries->first()->image) }}" />
                                    </div>
                                    <div class="xzoom-thumbs">
                                        @foreach ($item->galleries as $gallery)
                                            <a href="{{ Storage::url($gallery->image) }}">
                                                <img src="{{ Storage::url($gallery->image) }}" alt=""
                                                    class="xzoom-gallery" width="128"
                                                    xpreview="{{ Storage::url($gallery->image) }}" />
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <h2>Tentang Wisata</h2>
                            <p>
                                {!! $item->about !!}
                            </p>
                            <div class="features row">
                                <div class="col-md-4 border-right">
                                    <img src="{{ url('frontend/images/ic_event.png') }}" alt=""
                                        class="features-image" />
                                    <div class="description">
                                        <h3>Featured Event</h3>
                                        <p>{{ $item->featured_event }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4 border-right">
                                    <img src="{{ url('frontend/images/ic_language.png') }}" alt=""
                                        class="features-image" />
                                    <div class="description">
                                        <h3>Language</h3>
                                        <p>{{ $item->language }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <img src="{{ url('frontend/images/ic_foods.png') }}" alt=""
                                        class="features-image" />
                                    <div class="description">
                                        <h3>Foods</h3>
                                        <p>{{ $item->foods }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-details card-right">
                            <h2>Members Are Going</h2>
                            {{-- <p>
                                {{ Auth::user()->id }}
                            </p> --}}
                            <div class="members my-2">

                                @forelse ($members_going as $member_going)
                                    <img src="{{ $member_going->image ? Storage::url($member_going->image) : 'https://ui-avatars.com/api/?name=' . $member_going->username }}"
                                        alt="Member-image" class="member-image mr-1"
                                        style="border-radius: 50%; object-fit: cover;">
                                @empty
                                    <p>No one is going yet</p>
                                @endforelse
                                {{-- <img src="{{ url('frontend/images/member-1.png') }}" alt="Member-image"
                                    class="member-image mr-1" style="border-radius: 50%; object-fit: cover;">
                                <img src="{{ url('frontend/images/member-2.png') }}" alt="Member-image"
                                    class="member-image mr-1" style="border-radius: 50%; object-fit: cover;">
                                <img src="{{ url('frontend/images/member-3.png') }}" alt="Member-image"
                                    class="member-image mr-1" style="border-radius: 50%; object-fit: cover;">
                                <img src="{{ url('frontend/images/member-4.png') }}" alt="Member-image"
                                    class="member-image mr-1" style="border-radius: 50%; object-fit: cover;">
                                <img src="{{ url('frontend/images/member-5.png') }}" alt="Member-image"
                                    class="member-image mr-1" style="border-radius: 50%; object-fit: cover;"> --}}
                            </div>
                            <hr />
                            <h2>Trip Information</h2>
                            <table class="trip-information">
                                <tr>
                                    <th width="50%">Date Of Departure</th>
                                    <td width="50%" class="text-right">
                                        {{ \Carbon\Carbon::create($item->departure_date)->format('F n, Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th width="50%">Duration</th>
                                    <td width="50%" class="text-right">{{ $item->duration }}</td>
                                </tr>
                                <tr>
                                    <th width="50%">Type</th>
                                    <td width="50%" class="text-right">{{ $item->type }}</td>
                                </tr>
                                <tr>
                                    <th width="50%">Price</th>
                                    <td width="50%" class="text-right">${{ $item->price }} / person</td>
                                </tr>
                            </table>
                        </div>
                        <div class="join-container">
                            @auth
                                @if (isset($status) && $detail > 0)
                                    <form action="{{ route('checkout', $status->id) }}" method="GET">
                                        @csrf
                                        <button class="btn btn-block btn-join-now mt-3 py-2" type="submit">
                                            Go To Cart
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('checkout-process', $item->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-block btn-join-now mt-3 py-2" type="submit">
                                            Join Now
                                        </button>
                                    </form>
                                @endif
                            @endauth
                            @guest
                                <a href="{{ route('login') }}" class="btn btn-block btn-join-now mt-3 py-2">Login or Register
                                    To Join Trip</a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('prepend-style')
    <link rel="stylesheet" href="{{ url('frontend/libraries/xzoom/xzoom.css') }}" />
@endpush

@push('addon-script')
    <script src="{{ url('frontend/libraries/xzoom/xzoom.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".xzoom, .xzoom-gallery").xzoom({
                zoomWidth: 500,
                title: false,
                tint: "#333",
                xoffset: 15,
            });
        });
    </script>
@endpush
