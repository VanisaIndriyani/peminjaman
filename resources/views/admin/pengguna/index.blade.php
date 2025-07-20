@extends('admin.layouts.app')

@section('content')
<div class="pengguna-container">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">Data Pengguna / Customer</h1>
            <p class="page-subtitle">Kelola semua data pengguna yang terdaftar</p>
        </div>
        <div class="header-stats">
            <div class="stat-item">
                <i class="fa fa-users"></i>
                <span>{{ $users->count() }} Total</span>
            </div>
            <div class="stat-item">
                <i class="fa fa-user-plus"></i>
                <span>{{ $users->where('created_at', '>=', now()->subDays(30))->count() }} Bulan Ini</span>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="table-container">
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th class="col-no">No</th>
                        <th class="col-user">Pengguna</th>
                        <th class="col-email">Email</th>
                        <th class="col-date">Tanggal Daftar</th>
                        <th class="col-status">Status</th>
                        <th class="col-aksi">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="table-row">
                        <td class="col-no">{{ $loop->iteration }}</td>
                        <td class="col-user">
                            <div class="user-info">
                                <div class="user-avatar">
                                    @if($user->foto)
                                        <img src="{{ asset('storage/profile/'.$user->foto) }}" alt="Foto {{ $user->name }}">
                                    @else
                                        <i class="fa fa-user"></i>
                                    @endif
                                </div>
                                <div class="user-details">
                                    <span class="user-name">{{ $user->name }}</span>
                                    <small class="user-role">{{ ucfirst($user->role ?? 'user') }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="col-email">
                            <div class="email-info">
                                <span class="email-value">{{ $user->email }}</span>
                                @if($user->email_verified_at)
                                    <span class="verified-badge">
                                        <i class="fa fa-check-circle"></i>
                                        Terverifikasi
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td class="col-date">
                            <div class="date-info">
                                <span class="date-value">{{ $user->created_at->format('d M Y') }}</span>
                                <small class="date-time">{{ $user->created_at->format('H:i') }}</small>
                            </div>
                        </td>
                        <td class="col-status">
                            @php
                                $isActive = $user->created_at->diffInDays(now()) <= 30;
                                $statusClass = $isActive ? 'status-active' : 'status-inactive';
                                $statusText = $isActive ? 'Aktif' : 'Tidak Aktif';
                                $statusIcon = $isActive ? 'fa-user-check' : 'fa-user-clock';
                            @endphp
                            <span class="status-badge {{ $statusClass }}">
                                <i class="fa {{ $statusIcon }}"></i>
                                {{ $statusText }}
                            </span>
                        </td>
                        <td class="col-aksi">
                            <div class="action-buttons">
                                <button class="btn-view" title="Lihat Detail" onclick="showUserDetail('{{ $user->id }}', '{{ $user->name }}', '{{ $user->email }}', '{{ $user->created_at->format('d M Y H:i') }}', '{{ $user->role ?? 'user' }}')">
                                    <i class="fa fa-eye"></i>
                                </button>
                              
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- User Detail Modal -->
<div id="userModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Detail Pengguna</h3>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <div class="modal-body">
            <div class="user-detail-info">
                <div class="detail-item">
                    <span class="label">Nama:</span>
                    <span class="value" id="modalUserName"></span>
                </div>
                <div class="detail-item">
                    <span class="label">Email:</span>
                    <span class="value" id="modalUserEmail"></span>
                </div>
                <div class="detail-item">
                    <span class="label">Role:</span>
                    <span class="value" id="modalUserRole"></span>
                </div>
                <div class="detail-item">
                    <span class="label">Tanggal Daftar:</span>
                    <span class="value" id="modalUserDate"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.pengguna-container {
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

.header-stats {
    display: flex;
    gap: 16px;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 16px;
    background: #f8fafc;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
}

.stat-item i {
    color: #1976d2;
    font-size: 1.2rem;
}

.stat-item span {
    font-weight: 600;
    color: #374151;
}

/* Table Styles */
.table-container {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    border: 1px solid #e5e7eb;
}

.table-wrapper {
    overflow-x: auto;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 900px;
    table-layout: fixed;
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
    vertical-align: middle;
    border-right: 1px solid #e5e7eb;
}

.data-table th:last-child {
    border-right: none;
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
    word-wrap: break-word;
    border-right: 1px solid #f3f4f6;
}

.data-table td:last-child {
    border-right: none;
}

/* Column Styles */
.col-no {
    width: 60px;
    text-align: center;
    font-weight: 600;
    color: #1976d2;
}

.col-user {
    width: 250px;
}

.col-email {
    width: 220px;
}

.col-date {
    width: 140px;
    text-align: center;
}

.col-status {
    width: 140px;
    text-align: center;
}

.col-aksi {
    width: 100px;
    text-align: center;
}

/* User Info Styles */
.user-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.user-avatar i {
    color: #9ca3af;
    font-size: 1.2rem;
}

.user-details {
    display: flex;
    flex-direction: column;
}

.user-name {
    font-weight: 600;
    color: #1a237e;
    font-size: 0.875rem;
}

.user-role {
    color: #6b7280;
    font-size: 0.75rem;
    text-transform: uppercase;
    font-weight: 500;
}

/* Email Info Styles */
.email-info {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.email-value {
    font-weight: 500;
    color: #374151;
    font-size: 0.875rem;
}

.verified-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 2px 6px;
    background: #d1fae5;
    color: #065f46;
    border-radius: 12px;
    font-size: 0.7rem;
    font-weight: 600;
    width: fit-content;
}

.verified-badge i {
    font-size: 0.6rem;
}

/* Date Info Styles */
.date-info {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 2px;
}

.date-value {
    font-weight: 500;
    color: #374151;
    font-size: 0.875rem;
}

.date-time {
    color: #6b7280;
    font-size: 0.75rem;
}

/* Status Badge Styles */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    white-space: nowrap;
}

.status-active {
    background: #d1fae5;
    color: #065f46;
}

.status-inactive {
    background: #fef3c7;
    color: #92400e;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 8px;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    min-height: 32px;
}

.btn-view, .btn-edit {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    font-size: 0.85rem;
    transition: all 0.2s ease;
    flex-shrink: 0;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.btn-view {
    background: #dbeafe;
    color: #1976d2;
}

.btn-view:hover {
    background: #1976d2;
    color: #fff;
    transform: scale(1.05);
    box-shadow: 0 2px 6px rgba(25, 118, 210, 0.2);
}

.btn-edit {
    background: #fef3c7;
    color: #d97706;
}

.btn-edit:hover {
    background: #d97706;
    color: #fff;
    transform: scale(1.05);
    box-shadow: 0 2px 6px rgba(217, 119, 6, 0.2);
}

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
}

.modal-content {
    background-color: #fff;
    margin: 5% auto;
    padding: 0;
    border-radius: 12px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    animation: modalSlideIn 0.3s ease-out;
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 24px;
    border-bottom: 1px solid #e5e7eb;
    background: #f8fafc;
    border-radius: 12px 12px 0 0;
}

.modal-header h3 {
    margin: 0;
    color: #1a237e;
    font-size: 1.25rem;
    font-weight: 600;
}

.close {
    color: #6b7280;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    transition: color 0.2s ease;
}

.close:hover {
    color: #374151;
}

.modal-body {
    padding: 24px;
}

.user-detail-info {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #f3f4f6;
}

.detail-item:last-child {
    border-bottom: none;
}

.detail-item .label {
    font-weight: 600;
    color: #374151;
    font-size: 0.9rem;
}

.detail-item .value {
    color: #1a237e;
    font-weight: 500;
    font-size: 0.9rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        gap: 16px;
        align-items: stretch;
    }
    
    .header-stats {
        justify-content: flex-start;
    }
    
    .data-table {
        min-width: 800px;
    }
    
    .action-buttons {
        flex-direction: row;
        gap: 4px;
        justify-content: center;
    }
    
    .btn-view, .btn-edit {
        width: 28px;
        height: 28px;
        font-size: 0.75rem;
    }
    
    .modal-content {
        margin: 10% auto;
        width: 95%;
    }
}

@media (max-width: 480px) {
    .page-title {
        font-size: 1.5rem;
    }
    
    .data-table {
        min-width: 700px;
    }
    
    .user-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
    
    .user-avatar {
        width: 32px;
        height: 32px;
    }
    
    .action-buttons {
        gap: 3px;
    }
    
    .btn-view, .btn-edit {
        width: 26px;
        height: 26px;
        font-size: 0.7rem;
    }
    
    .modal-header {
        padding: 16px 20px;
    }
    
    .modal-body {
        padding: 20px;
    }
}
</style>

<script>
function showUserDetail(id, name, email, date, role) {
    document.getElementById('modalUserName').textContent = name;
    document.getElementById('modalUserEmail').textContent = email;
    document.getElementById('modalUserDate').textContent = date;
    document.getElementById('modalUserRole').textContent = role.charAt(0).toUpperCase() + role.slice(1);
    document.getElementById('userModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('userModal').style.display = 'none';
}

function editUser(id) {
    // Implementasi edit user (bisa redirect ke halaman edit atau show modal edit)
    alert('Fitur edit pengguna akan diimplementasikan');
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('userModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>
@endsection 