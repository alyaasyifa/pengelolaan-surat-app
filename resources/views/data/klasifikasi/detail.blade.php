@extends('layouts.template')

@section('content')
    <div class="jumbotron py-4 px-5">
        <h2>{{ $letterType['letter_code'] }} <p class="lead" style="display: inline;"> | {{ $letterType['nama_type'] }}</p></h2>
        <br>
        <div class="row">
            <div class="col-md-3 mb-2">
                <div class="card">
                    <h5 class="card-header d-flex justify-content-between">{{ $letterType['nama_type'] }}
                        <a href="{{ route('data.klasifikasi.download', $letterType['id'])}}"><i class="bi bi-download"></i></a>
                    </h5>
                    @php
                    $no = 1;
                    @endphp 
                    <div class="card-body">
                        <p class="card-text">{{ $letterType->created_at->format('j F Y') }}</p>
                        @foreach($guru as $gurs)
                        <p class="card-text">{{$no++}}. {{ $gurs->name }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
