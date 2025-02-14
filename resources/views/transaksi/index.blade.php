@extends('layout.layout')
@section('content')
<div class="container">
    <h2 class="mb-4">Pembayaran SPP</h2>
    
    <!-- Pencarian -->
    <div class="mb-3">
        <form action="{{ route('payments.index') }}" method="GET">
            <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan NIS atau Nama" value="{{ request('search') }}">
        </form>
    </div>

    <!-- Informasi Siswa -->
    <div class="card mb-3">
        <div class="card-body">
            <h5>Data Siswa</h5>
            <p><strong>NIS:</strong> {{ $siswa->NIS }}</p>
            <p><strong>Nama:</strong> {{ $siswa->Nama }}</p>
            <p><strong>Kelas:</strong> {{ $siswa->Kelas }}</p>
        </div>
    </div>
    
    <!-- Tabel Pembayaran -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Jenis Tagihan</th>
                <th>Tagihan</th>
                <th>Bulan</th>
                <th>Periode</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembayarans as $pembayaran)
            <tr>
                <td>{{ $pembayaran->id }}</td>
                <td>{{ $pembayaran->{'Jenis Tagihan'} }}</td>
                <td>Rp {{ number_format($pembayaran->Tagihan, 2, ',', '.') }}</td>
                <td>{{ $pembayaran->Bulan }}</td>
                <td>{{ $pembayaran->Periode }}</td>
                <td>
                    <input type="checkbox" name="bayar[]" value="{{ $pembayaran->id }}">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
