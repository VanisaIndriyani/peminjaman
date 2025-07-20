@extends('admin.layouts.app')

@section('content')
<div class="mobil-container">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">Data Mobil</h1>
            <p class="page-subtitle">Kelola data mobil yang tersedia untuk disewa</p>
        </div>
        <a href="{{ route('mobil.create') }}" class="btn-primary">
            <i class="fa fa-plus"></i>
            Tambah Mobil
        </a>
    </div>

    <!-- Search Section -->
    <div class="search-section">
        <div class="search-container">
            <i class="fa fa-search search-icon"></i>
            <input id="searchMobil" type="text" placeholder="Cari mobil, merk, plat nomor..." class="search-input">
        </div>
</div>

    <!-- Table Section -->
    <div class="table-container">
        <div class="table-wrapper">
            <table id="tabelMobil" class="data-table">
                <thead>
                    <tr>
                        <th class="col-no">No</th>
                        <th class="col-nama">Nama Mobil</th>
                        <th class="col-merk">Merk</th>
                        <th class="col-tahun">Tahun</th>
                        <th class="col-plat">Plat Nomor</th>
                        <th class="col-harga">Harga Sewa</th>
                        <th class="col-status">Status</th>
                        <th class="col-foto">Foto</th>
                        <th class="col-aksi">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($mobils as $mobil)
                    <tr class="table-row">
                        <td class="col-no">{{ $loop->iteration }}</td>
                        <td class="col-nama">
                            <div class="mobil-info">
                                <span class="mobil-name">{{ $mobil->nama }}</span>
                            </div>
                        </td>
                        <td class="col-merk">{{ $mobil->merk }}</td>
                        <td class="col-tahun">{{ $mobil->tahun }}</td>
                        <td class="col-plat">
                            <span class="plat-number">{{ $mobil->plat_nomor }}</span>
                        </td>
                        <td class="col-harga">
                            <span class="price">Rp {{ number_format($mobil->harga_sewa,0,',','.') }}</span>
                        </td>
                        <td class="col-status">
                @php
                    $status = strtolower($mobil->status);
                                $statusClass = '';
                    if ($status === 'dipinjam') {
                                    $statusClass = 'status-rented';
                    } elseif ($status === 'tersedia') {
                                    $statusClass = 'status-available';
                    } else {
                                    $statusClass = 'status-other';
                    }
                @endphp
                            <span class="status-badge {{ $statusClass }}">
                                {{ ucfirst($mobil->status) }}
                            </span>
            </td>
                        <td class="col-foto">
                @if($mobil->foto)
                                <div class="image-container">
                                    <img src="{{ asset('storage/mobil/'.$mobil->foto) }}" alt="Foto {{ $mobil->nama }}" class="mobil-image">
                                </div>
                @else
                                <div class="no-image">
                                    <i class="fa fa-image"></i>
                                </div>
                @endif
            </td>
                        <td class="col-aksi">
                            <div class="action-buttons">
                                <a href="{{ route('mobil.edit', $mobil->id) }}" class="btn-edit" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('mobil.destroy', $mobil->id) }}" method="POST" class="delete-form">
                    @csrf
                    @method('DELETE')
                                    <button type="submit" class="btn-delete" title="Hapus" onclick="return confirm('Yakin ingin menghapus mobil ini?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                </form>
                            </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
    </div>
</div>

<style>
.mobil-container {
    max-width: 100%;
}

/* Header Styles */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 32px;
    padding: 24px 0;
    border-bottom: 1px solid #e5e7eb;
}

.header-content {
    flex: 1;
}

.page-title {
    font-size: 2rem;
    font-weight: 700;
    color: #1a237e;
    margin: 0 0 8px 0;
}

.page-subtitle {
    font-size: 1rem;
    color: #6b7280;
    margin: 0;
}

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #1a237e 0%, #1976d2 100%);
    color: #fff;
    padding: 12px 24px;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(26, 35, 126, 0.2);
}

/* Search Styles */
.search-section {
    margin-bottom: 24px;
}

.search-container {
    position: relative;
    max-width: 400px;
}

.search-icon {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    font-size: 1rem;
}

.search-input {
    width: 100%;
    padding: 12px 16px 12px 48px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    font-size: 1rem;
    outline: none;
    transition: border-color 0.2s ease;
}

.search-input:focus {
    border-color: #1976d2;
    box-shadow: 0 0 0 3px rgba(25, 118, 210, 0.1);
}

/* Table Styles */
.table-container {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.table-wrapper {
    overflow-x: auto;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 900px;
}

.data-table thead {
    background: #f8fafc;
    border-bottom: 2px solid #e5e7eb;
}

.data-table th {
    padding: 16px 12px;
    text-align: left;
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.data-table tbody tr {
    border-bottom: 1px solid #f3f4f6;
    transition: background-color 0.2s ease;
}

.data-table tbody tr:hover {
    background-color: #f9fafb;
}

.data-table td {
    padding: 16px 12px;
    vertical-align: middle;
}

/* Column Styles */
.col-no {
    width: 60px;
    text-align: center;
    font-weight: 600;
    color: #1976d2;
}

.col-nama {
    min-width: 200px;
}

.col-merk {
    min-width: 120px;
}

.col-tahun {
    width: 80px;
    text-align: center;
}

.col-plat {
    min-width: 120px;
}

.col-harga {
    min-width: 140px;
}

.col-status {
    width: 100px;
    text-align: center;
}

.col-foto {
    width: 100px;
    text-align: center;
}

.col-aksi {
    width: 120px;
    text-align: center;
}

/* Content Styles */
.mobil-info {
    display: flex;
    flex-direction: column;
}

.mobil-name {
    font-weight: 600;
    color: #1a237e;
}

.plat-number {
    font-family: 'Courier New', monospace;
    font-weight: 600;
    color: #374151;
    background: #f3f4f6;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.875rem;
}

.price {
    font-weight: 600;
    color: #059669;
}

/* Status Badge */
.status-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.status-available {
    background: #d1fae5;
    color: #065f46;
}

.status-rented {
    background: #fee2e2;
    color: #991b1b;
}

.status-other {
    background: #e0e7ff;
    color: #3730a3;
}

/* Image Styles */
.image-container {
    display: inline-block;
}

.mobil-image {
    width: 60px;
    height: 45px;
    object-fit: cover;
    border-radius: 6px;
    border: 1px solid #e5e7eb;
}

.no-image {
    width: 60px;
    height: 45px;
    background: #f3f4f6;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #9ca3af;
    font-size: 1.2rem;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 8px;
    justify-content: center;
}

.btn-edit, .btn-delete {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    font-size: 0.875rem;
    transition: all 0.2s ease;
}

.btn-edit {
    background: #dbeafe;
    color: #1976d2;
}

.btn-edit:hover {
    background: #1976d2;
    color: #fff;
}

.btn-delete {
    background: #fee2e2;
    color: #dc2626;
}

.btn-delete:hover {
    background: #dc2626;
    color: #fff;
}

.delete-form {
    display: inline;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        gap: 16px;
        align-items: stretch;
    }
    
    .btn-primary {
        align-self: flex-start;
    }
    
    .search-container {
        max-width: 100%;
    }
    
    .data-table {
        min-width: 800px;
    }
}

@media (max-width: 480px) {
    .page-title {
        font-size: 1.5rem;
    }
    
    .data-table {
        min-width: 700px;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 4px;
    }
    
    .btn-edit, .btn-delete {
        width: 32px;
        height: 32px;
        font-size: 0.75rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('searchMobil');
    var table = document.getElementById('tabelMobil');
    
    if (searchInput && table) {
        searchInput.addEventListener('input', function() {
            const val = this.value.toLowerCase();
            const rows = table.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(val) ? '' : 'none';
            });
        });
    }
});
</script>
@endsection 