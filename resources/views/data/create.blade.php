@extends('layout.layout')
@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Siswa</h2>

    <form action="{{ route('datasiswas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="NIS" class="form-label">NIS</label>
            <input type="text" class="form-control" id="NIS" name="NIS" required>
        </div>

        <div class="mb-3">
            <label for="Nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="Nama" name="Nama" required>
        </div>

        <div class="mb-3">
            <label for="Kelas" class="form-label">Kelas</label>
            <input type="text" class="form-control" id="Kelas" name="Kelas" required>
        </div>

        <div class="mb-3">
            <label for="Alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="Alamat" name="Alamat" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('datasiswas.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
