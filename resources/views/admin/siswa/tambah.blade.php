@extends('layouts.base')

@section('content')
<div class="container card shadow mt-3 mb-3 p-3">
  <div class="row justify-content-center mb-3">
    <h4 class="text-uppercase text-center">Tambah Siswa Baru</h4>
  </div>
  <div class="row justify-content-center">
    <div class="col-lg-9">


      <!-- Tabs Navigation -->
      <ul class="nav nav-tabs nav-fill mb-3" id="formTabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-bs-toggle="tab" href="#dataSiswa">Data Siswa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" href="#dataAyah">Data Ayah</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" href="#dataIbu">Data Ibu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="tab" href="#dataWali">Data Wali</a>
        </li>
      </ul>

      <!-- Tabs Content -->
      <div class="tab-content" id="formTabsContent">

        <!-- Tab 1: Data Siswa -->
        <div class="tab-pane fade show active" id="dataSiswa">
          <form action="/admin/siswa" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="nama_panggilan" class="form-label">Nama Panggilan Siswa</label>
              <input type="text" class="form-control @error('nama_panggilan') is-invalid @enderror" name="nama_panggilan">
              @error('nama_panggilan')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="nama_lengkap" class="form-label">Nama Lengkap Siswa</label>
              <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap">
              @error('nama_lengkap')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="nisn" class="form-label">Nomor Induk Siswa Nasional</label>
              <input type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn">
              @error('nisn')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="nis" class="form-label">Nomor Induk Siswa</label>
              <input type="text" class="form-control @error('nis') is-invalid @enderror" name="nis">
              @error('nis')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="foto" class="form-label">Pas Foto Siswa</label>
              <input class="form-control @error('foto') is-invalid @enderror" type="file" name="foto">
              @error('foto')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="group_id" class="form-label">Kelompok Siswa</label>
              <input class="form-control @error('group_id') is-invalid @enderror" list="listKelas" name="group_id" placeholder="Ketik nama kelompok. Contoh: A/B/C">
              <datalist id="listKelas">
                @foreach ($kelas as $item)
                <option value="{{$item->nama}}">{{$item->nama}}</option>
                @endforeach
              </datalist>
              @error('group_id')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="year_id" class="form-label">Tahun Ajaran siswa Didaftarkan</label>
              <input class="form-control @error('year_id') is-invalid @enderror" list="listTahun" name="year_id" placeholder="Ketik tahun ajaran...">
              <datalist id="listTahun">
                @foreach ($tahun as $item)
                <option value="{{$item->tahun_ajaran}}">{{$item->tahun_ajaran}}</option>
                @endforeach
              </datalist>
              @error('year_id')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
            <div class="mb-3">
              <p>Jenis Kelamin</p>
              <div class="form-check form-check-inline">
                <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror" type="radio" name="jenis_kelamin" value="L">
                <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror" type="radio" name="jenis_kelamin" value="P">
                <label class="form-check-label" for="inlineRadio2">Perempuan</label>
              </div>
              @error('jenis_kelamin')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
          </form>
        </div>

        <!-- Tab 2: Ayah -->
        <div class="tab-pane fade" id="dataAyah">
        </div>


        <!-- Tab 3: Ibu -->
        <div class="tab-pane fade" id="dataIbu">
        </div>
        <!-- Tab 4: Wali -->
        <div class="tab-pane fade" id="dataWali">
        </div>
        <!-- Submit Button -->
        <div class="d-grip gap-2 mb-3 w-100">
          <p class="fw-light"><span class="text-danger fw-bold">*</span> Pastikan data yang kamu masukkan benar</p>
          <button type="submit" class="btn btn-primary w-100"><i class="bi bi-cloud-check me-2"></i> Simpan</button>
        </div>
      </div>

    </div>
  </div>
  @endsection