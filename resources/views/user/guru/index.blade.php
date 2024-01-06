@extends('layouts.template')

@section('content')
    @if(Session::get('success'))
    <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif

    @if(Session::get('deleted'))
    <div class="alert alert-warning"> {{ Session::get('deleted') }} </div>
    @endif
    <h1>Data Guru</h1>
    <a href="{{route('user.create')}}" class="btn btn-primary">Tambah</a>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        @php
            $no = 1;
        @endphp
        @foreach ($guru as $item)
            <tbody>
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->role}}</td>
                    <td>
                        <a href="{{ route('user.edit',  $item['id']) }}" class="btn btn-warning">Edit</a>
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
                                <form action="{{ route('user.delete', $item['id']) }}" method="POST">
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
