@extends('layouts.template')

@section('content')
    <form action="{{ route('data.klasifikasi.update', $letterTypes['id']) }}" method="POST" class="card p-5">
        @csrf
        @method('PATCH')

        @if($errors->any())
            <ul class="alert alert-danger p-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="mb-3 row">
            <label for="letter_code" class="col-sm-2 col-form-label">Kode Surat :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="letter_code" name="letter_code" value="{{ $letterTypes['letter_code'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama_type" class="col-sm-2 col-form-label">Klasifikasi Surat :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_type" name="nama_type"  value="{{ $letterTypes['nama_type'] }}">
            </div>
        </div>  
        <button type="submit" class="btn btn-primary mt-3">Ubah data</button>
    </form>
@endsection