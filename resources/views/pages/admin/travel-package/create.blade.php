@extends('layouts.admin')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Paket Travel</h1>
            <a href="{{ route('travel-package.create') }}" class="btn-sm btn btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Paket Travel
            </a>
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
                <form action="{{ route('travel-package.store') }}" method="POST">
                    @csrf
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
