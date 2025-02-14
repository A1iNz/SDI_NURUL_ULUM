@extends('layout.layout')

@section('content')
<div class="container">
    <h2 class="mb-4">Pembayaran SPP</h2>
    
    <!-- Pencarian -->
    <div class="mb-3">
        <form action="{{ route('payments.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari berdasarkan NIS atau Nama" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
    </div>

    <!-- Informasi Siswa -->
    <div class="card mb-3">
        <div class="card-body">
            <h5>Data Siswa</h5>
            <div class="row">
                <div class="col-md-4">
                    <p><strong>NIS:</strong> {{ $siswa->NIS }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Nama:</strong> {{ $siswa->Nama }}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Kelas:</strong> {{ $siswa->Kelas }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Form Pembayaran -->
    <form action="{{ route('payments.process') }}" method="POST" id="formPembayaran">
        @csrf
        <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
        
        <!-- Alert untuk pesan sukses atau error -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Tabel Pembayaran -->
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Jenis Tagihan</th>
                            <th>Tagihan</th>
                            <th>Bulan</th>
                            <th>Periode</th>
                            <th>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkAll">
                                    <label class="form-check-label" for="checkAll">Pilih Semua</label>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pembayarans as $pembayaran)
                        <tr>
                            <td>{{ $pembayaran->id }}</td>
                            <td>{{ $pembayaran->{'Jenis Tagihan'} }}</td>
                            <td>Rp {{ number_format($pembayaran->Tagihan, 2, ',', '.') }}</td>
                            <td>{{ $pembayaran->Bulan }}</td>
                            <td>{{ $pembayaran->Periode }}</td>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input payment-checkbox" 
                                           name="bayar[]" 
                                           value="{{ $pembayaran->id }}"
                                           data-amount="{{ $pembayaran->Tagihan }}">
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada tagihan yang tersedia</td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"><strong>Total yang harus dibayar:</strong></td>
                            <td colspan="4">
                                <strong>Rp <span id="totalAmount">0</span></strong>
                                <input type="hidden" name="total_pembayaran" id="totalPembayaran" value="0">
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Metode Pembayaran -->
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Metode Pembayaran</h5>
                <div class="mb-3">
                    <select name="metode_pembayaran" class="form-select" required>
                        <option value="">Pilih metode pembayaran</option>
                        <option value="tunai">Tunai</option>
                        <option value="transfer">Transfer Bank</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan (opsional)</label>
                    <textarea name="keterangan" id="keterangan" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary" id="btnBayar" disabled>
                    Proses Pembayaran
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkAll = document.getElementById('checkAll');
    const paymentCheckboxes = document.querySelectorAll('.payment-checkbox');
    const totalAmountSpan = document.getElementById('totalAmount');
    const totalPembayaranInput = document.getElementById('totalPembayaran');
    const btnBayar = document.getElementById('btnBayar');

    // Function to format number to currency
    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }).format(number);
    }

    // Function to calculate total
    function calculateTotal() {
        let total = 0;
        paymentCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                total += parseFloat(checkbox.dataset.amount);
            }
        });
        
        totalAmountSpan.textContent = formatRupiah(total);
        totalPembayaranInput.value = total;
        btnBayar.disabled = total === 0;
    }

    // Event listener for "Check All"
    checkAll.addEventListener('change', function() {
        paymentCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        calculateTotal();
    });

    // Event listeners for individual checkboxes
    paymentCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            checkAll.checked = [...paymentCheckboxes].every(cb => cb.checked);
            calculateTotal();
        });
    });

    // Form submission handler
    document.getElementById('formPembayaran').addEventListener('submit', function(e) {
        if (!confirm('Apakah Anda yakin ingin memproses pembayaran ini?')) {
            e.preventDefault();
        }
    });
});
</script>
@endpush
@endsection