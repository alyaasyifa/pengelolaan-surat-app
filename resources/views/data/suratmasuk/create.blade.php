@extends('layouts.template')

@section('content')
    <div class="container">
        <form action="{{ route('data.suratmasuk.store') }}" method="POST">
            @csrf
                <div class="h6">Peserta Yang Hadir</div>
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Nama</th>
                        <th>Kehadiran</th>
                    </tr>
                    @foreach ($user as $item) 
                    <tr>
                        <td>{{ $item->name }}</td>
                        
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $item->id }}" id="flexCheckChecked" name="presence_recipients[]">
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>

                <div class="h6">Ringkasan Rapat:</div>
                <div class="mb-3">
                    <textarea class="form-control" id="des" name="notes"></textarea>
                </div>
                <button type="submit" class="btn btn-primary text-white">Buat</button>
            </div>
    <script>
        ClassicEditor
        .create(document.querySelector('#des'))
        .catch(error => {
            console.error(error)
        });
    </script>
</form>
@endsection