@extends('layouts.app')

@section('content')
    <main>
        <section class="section-details-header"></section>
        <section class="section-details-content">
            <div class="container">
                <div class="row">
                    <div class="col p-0">
                        <nav class="ml-2">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Halaman Profile</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 p-lg-0">
                        <div class="card card-details">
                            <h1>Edit Profile</h1>

                            <form action="{{ route('profile-update') }}" method="POST" enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="image" accept=".png, .jpg, .jpeg" name="image"
                                                value="{{ old('image', $user->image) }}" />
                                            <label for="image">
                                                <i class="fas fa-pencil-alt"></i>
                                            </label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview"
                                                style="background-image: url('{{ !$user->image ? __('https://ui-avatars.com/api/?name=') . $user->username : Storage::url($user->image) }}');">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="email" class="form-control" id="email"
                                            value="{{ old('email', $user->email) }}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="current_password" class="col-sm-2 col-form-label">Current Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="current_password" placeholder="*****"
                                            class="form-control" id="current_password">
                                    </div>
                                </div>


                                <div class="mb-3 row">
                                    <label for="new_password" class="col-sm-2 col-form-label">New Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="new_password" placeholder="*****" class="form-control"
                                            id="new_password">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-2 col-form-label">New Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $user->name) }}" id="name">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center align-items-center">
                                    <button type="submit" class="mt-4 btn btn-primary btn-lg">Update Profile</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('prepend-style')
    <link rel="stylesheet" href="{{ url('frontend/styles/profile.css') }}">
@endpush

@push('addon-script')
    <script src="{{ url('frontend/script/profile.js') }}"></script>
@endpush
