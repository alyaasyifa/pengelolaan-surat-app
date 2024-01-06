@extends('layouts.template')

@section('content')
    @if(Session::get('success'))
    <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif

    @if(Session::get('deleted'))
    <div class="alert alert-warning"> {{ Session::get('deleted') }} </div>
    @endif
    <h1>Data Klasifikasi Surat</h1>
    <a href="{{route('data.klasifikasi.create')}}" class="btn btn-primary">Tambah</a>
    <a href="{{route('data.klasifikasi.export')}}" class="btn btn-info">Export Klasifikasi Surat</a>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Surat</th>
                <th>Klasifikasi Surat</th>
                <th>Surat Tertaut</th>
                <th></th>
            </tr>
        </thead>
        @php
            $no = 1;
        @endphp
        @foreach ($letterTypes as $item)
            <tbody>
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$item->letter_code}}</td>
                    <td>{{$item->nama_type}}</td>
                    <td>{{ App\Models\Letter::where('letter_type_id', $item->id)->count() }}</td>
                    <td>
                        <a href="{{ route('data.klasifikasi.show', $item['id']) }}">Lihat</a>
                        <a href="{{ route('data.klasifikasi.edit',  $item['id']) }}" class="btn btn-warning">Edit</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal-{{ $item['id']}}">Hapus</button>
                    </td>
                </tr>
                <div class="modal fade" id="confirmDeleteModal-{{ $item['id']}}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="confirmDeleteModalLabel">Konfirmasi hapus</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Yakin ingin menghapus data ini?
                                <br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <form action="{{ route('data.klasifikasi.delete', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </tbody>
        @endforeach
    </table>
@endsection
