@extends('layouts.template')

@section('content')
<div class="table-container">
    <div class="container mt-5">
        <p class="fs-2 fw-semibold">Tambah Klasifikasi Surat!</p>
        <form action="{{ route('data.klasifikasi.store') }}" method="post" class="row g-3 needs-validation" novalidate>
            @csrf
            @if(Session::get('success'))
            <div class="alert alert-success"> {{ Session::get('success') }} </div>
            @endif
            @if($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="mb-3">
              <label for="letter_code" class="form-label">Kode Surat :</label>
              <div class="input-group has-validation">
                <input type="text" class="form-control" id="letter_code" name="letter_code" aria-describedby="inputGroupPrepend" required>
                <div class="invalid-feedback">
                  Kode surat harus diisi.
                </div>
              </div>
            </div>

            <div class="mb-3">
                <label for="nama_type" class="form-label">Klasifikasi Surat :</label>
                <div class="input-group has-validation">
                  <input type="text" class="form-control" id="nama_type" name="nama_type" aria-describedby="inputGroupPrepend" required>
                  <div class="invalid-feedback">
                    Klasifikasi surat harus diisi.
                  </div>
                </div>
            </div>

            <div class="col-12">
              <button class="btn btn-primary" type="submit">Submit form</button>
            </div>

          <script>
                        (() => {
              'use strict'

              // Fetch all the forms we want to apply custom Bootstrap validation styles to
              const forms = document.querySelectorAll('.needs-validation')

              // Loop over them and prevent submission
              Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                  if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                  }

                  form.classList.add('was-validated')
                }, false)
              })
            })()
          </script>
        </form>
    </div>
</div>
@endsection
