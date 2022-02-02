@extends('layout.main')

@section('title')
  <title>Edit Data Karyawan</title>
@endsection

@section('content')
<!-- Modal -->
<div class="container">
  <div class="row">
      <div class="col-12">
            <div class="modal-header float-right">
                <h3 class="fw-bold">Edit Data Karyawan</h3>
            </div>
            <div class="modal-body">
              <form action="{{ route('karyawan.update', $data['response']['nip']) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                  <div class="mb-3 row">
                    <label for="exampleFormControlInput1" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama" id="exampleFormControlInput1" value={{ $data['response']['nama'] }}>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="exampleFormControlTextarea1" name="alamat" rows="3">{{ $data['response']['alamat'] }}</textarea>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="L" <?php if($data['response']['gender']=='L') echo 'checked'?> >
                        <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="P" <?php if($data['response']['gender']=='P') echo 'checked'?> >
                        <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="example" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-10">
                      <input placeholder="Select date" type="date" name="tgl_lahir" id="tl" class="form-control" value="<?php echo date('Y-m-d', strtotime($data['response']['tgl_lahir'])); ?>">
                    </div>
                  </div>
                  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
        
