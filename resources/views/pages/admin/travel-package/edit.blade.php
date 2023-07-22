@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Paket Travel : {{ $item->title }}</h1>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('travel-package.update', $item->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" placeholder="Title..." class="form-control"
                            value="{{ $item->title }}">
                    </div>
                    {{-- location --}}
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" name="location" id="location" placeholder="Location..." class="form-control"
                            value="{{ $item->location }}">
                    </div>
                    {{-- about with textarea --}}
                    <div class="form-group">
                        <label for="about">About</label>
                        <textarea name="about" id="about" rows="10" class="d-block w-100 form-control">{{ $item->about }}</textarea>
                    </div>
                    {{-- featured_event, language, foods --}}
                    <div class="form-group">
                        <label for="featured_event">Featured Event</label>
                        <input type="text" name="featured_event" id="featured_event" placeholder="Featured Event..."
                            class="form-control" value="{{ $item->featured_event }}">
                    </div>
                    <div class="form-group">
                        <label for="language">Language</label>
                        <input type="text" name="language" id="language" placeholder="Language..." class="form-control"
                            value="{{ $item->language }}">
                    </div>
                    <div class="form-group">
                        <label for="foods">Foods</label>
                        <input type="text" name="foods" id="foods" placeholder="Foods..." class="form-control"
                            value="{{ $item->foods }}">
                    </div>
                    {{-- departure_date, duration, type, price --}}
                    <div class="form-group">
                        <label for="departure_date">Departure Date</label>
                        <input type="date" name="departure_date" id="departure_date" placeholder="Departure Date..."
                            class="form-control" value="{{ $item->departure_date }}">
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration</label>
                        <input type="text" name="duration" id="duration" placeholder="Duration..." class="form-control"
                            value="{{ $item->duration }}">
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <input type="text" name="type" id="type" placeholder="Type..." class="form-control"
                            value="{{ $item->type }}">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" placeholder="Price..." class="form-control"
                            value="{{ $item->price }}">
                    </div>

                    <button class="btn btn-submit btn-block" style="background-color: black" type="submit">
                        Ubah
                    </button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
