@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Gallery</h1>
            <a href="{{ route('gallery.create') }}" class="btn-sm btn btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah  
            </a>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing=0>
                        <thead>
                            <tr>
                                {{-- id, title, location, type, departure date, type, action --}}
                                <th>ID</th>
                                <th>Travel</th>
                                <th>Gambar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    {{-- title location type departure_date type --}}
                                    <td>{{ $item->travel_package->title }}</td>
                                    <td>
                                        <img src="{{ Storage::url($item->image) }}" alt="image" style="width: 120px;" class="img-thumbnail">
                                    </td>
                                    <td>
                                        <a href="{{ route('gallery.edit', $item->id) }}" class="btn btn-info">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>

                                        <form action="{{ route('gallery.destroy', $item->id) }}" method="POST"
                                            class="d-inline delete_form">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger delete">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">DATA KOSONg</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Content Row -->

    </div>
    <!-- /.container-fluid -->
@endsection
