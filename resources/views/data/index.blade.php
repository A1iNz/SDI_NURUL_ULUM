@extends('layout.layout')
@section('content')
<div class="container">
    <h2 class="mb-4">Data Siswa</h2>
    
    <div class="mb-3">
        <form action="{{ route('index.blade') }}" method="GET">
            <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan NIS atau Nama" value="{{ request('search') }}">
        </form>
    </div>
    
    <a href="{{ route('create.blade') }}" class="btn btn-primary mb-3">Tambah Siswa</a>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datasiswas as $siswa)
            <tr>
                <td>{{ $siswa->id }}</td>
                <td>{{ $siswa->NIS }}</td>
                <td>{{ $siswa->Nama }}</td>
                <td>{{ $siswa->Kelas }}</td>
                <td>{{ $siswa->Alamat }}</td>
                <td>
                    <a href="{{ route('edit.blade', $siswa->id) }}" class="btn btn-warning btn-sm">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
