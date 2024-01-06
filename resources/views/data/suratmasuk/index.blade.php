@extends('layouts.template')

@section('content')
    @if(Session::get('success'))
    <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif

    @if(Session::get('deleted'))
    <div class="alert alert-warning"> {{ Session::get('deleted') }} </div>
    @endif
    <h1>Data Klasifikasi Surat</h1>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Perihal</th>
                <th>Tanggal Keluar</th>
                <th>Penerima Surat</th>
                <th>Notulis</th>
                <th>Hasil Rapat</th>
                <th></th>
            </tr>
        </thead>
        @php
            $no = 1;
        @endphp
        @foreach ($letter as $item)
            <tbody>
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$item->letterType->letter_code}}/000{{$item->id}}/SMK Wikrama/XII/{{ date('Y') }}</td>
                    <td>{{$item->letter_perihal}}</td>
                    <td>{{$item->created_at->format('j F Y')}}</td>
                    <td>{{implode(', ', array_column($item->recipients, 'name'))}}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>
                        @if (App\Models\Result::where('letter_id', $item->id)->exists())
                            <p class="text-success">Sudah Dibuat</p>
                        @else
                            <a href="{{ route('data.suratmasuk.create', $item->id) }}" class="btn btn-outline-warning">Buat Hasil Rapat</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('data.suratmasuk.show', $item->id)}}">Lihat</a>

                    </td>
                </tr>
            </tbody>
        @endforeach
    </table>
@endsection
