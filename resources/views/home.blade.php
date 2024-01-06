@extends('layouts.template')

@section('content')
    @if (Session::get('message'))
    <div class="alert alert-danger">{{ Session::get('message') }}</div>
    @endif
    <h1>
        Selamat Datang {{ Auth::user()->name }}!
    </h1>
    <div class="jumbotron py-4 px-5">
        <h2><i class="bi bi-house-fill"></i>Dashboard</h2>
        <br>
        <div class="row">
            @if (Auth::check())
            @if (Auth::user()->role == "staff")
            <div class="col-md-3 mb-2">
                <div class="card">
                    <h5 class="card-header">Surat Keluar</h5>
                    <div class="card-body">
                        <p class="card-text"><i class="bi bi-envelope-paper"></i></i>  
                        {{ App\Models\Letter::count() }}</p>
                    </div>
                </div>
            </div>  
            <div class="col-md-3 mb-2">
                <div class="card">
                    <h5 class="card-header">Klasifikasi Surat</h5>
                    <div class="card-body">
                        <p class="card-text"><i class="bi bi-envelope-paper"></i>
                        {{ App\Models\LetterType::count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-2">
                <div class="card">
                    <h5 class="card-header">Staff Tata Usaha</h5>
                    <div class="card-body">
                        <p class="card-text"><i class="bi bi-person-circle"></i>
                        {{ App\Models\User::where('role', 'staff')->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <h5 class="card-header">Guru</h5>
                    <div class="card-body">
                        <p class="card-text"><i class="bi bi-person-circle"></i>
                        {{ App\Models\User::where('role', 'guru')->count() }}</p>
                    </div>
                </div>
            </div>
            @else
            <div class="col-md-3">
                <div class="card">
                    <h5 class="card-header">Data Surat Masuk</h5>
                    <div class="card-body">
                        <p class="card-text"><i class="bi bi-person-circle"></i>
                            {{ App\Models\Letter::count() }}</p>
                    </div>
                </div>
            </div>
            @endif
            @endif
        </div>
    </div>
@endsection
