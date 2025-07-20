@extends('admin.layouts.app')

@section('content')
<div class="pesan-container">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">Pesan Masuk</h1>
            <p class="page-subtitle">Kelola semua pesan dan pertanyaan dari pengunjung</p>
        </div>
        <div class="header-stats">
            <div class="stat-item">
                <i class="fa fa-envelope"></i>
                <span>{{ $pesans->count() }} Total</span>
            </div>
            <div class="stat-item">
                <i class="fa fa-envelope-open"></i>
                <span>{{ $pesans->where('created_at', '>=', now()->subDays(7))->count() }} Minggu Ini</span>
            </div>
        </div>
    </div>

@if($pesans->isEmpty())
    <!-- Empty State -->
    <div class="empty-state">
        <div class="empty-icon">
            <i class="fa fa-inbox"></i>
        </div>
        <h3 class="empty-title">Belum ada pesan masuk</h3>
        <p class="empty-description">Pesan dari pengunjung akan muncul di sini</p>
    </div>
@else
    <!-- Messages Section -->
    <div class="messages-section">
        <!-- Filter Section -->
        <div class="filter-section">
            <div class="filter-actions">
                <div class="search-box">
                    <i class="fa fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari pesan..." class="search-input">
                </div>
                <div class="filter-buttons">
                    <button class="btn-filter active" data-filter="all">
                        <i class="fa fa-list"></i>
                        Semua
                    </button>
                    <button class="btn-filter" data-filter="recent">
                        <i class="fa fa-clock"></i>
                        Terbaru
                    </button>
                    <button class="btn-filter" data-filter="unread">
                        <i class="fa fa-envelope"></i>
                        Belum Dibaca
                    </button>
                </div>
            </div>
        </div>

        <!-- Messages Table -->
        <div class="table-container">
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th class="col-no">No</th>
                            <th class="col-sender">Pengirim</th>
                            <th class="col-subject">Subjek</th>
                            <th class="col-contact">Kontak</th>
                            <th class="col-time">Waktu</th>
                            <th class="col-status">Status</th>
                            <th class="col-aksi">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pesans as $pesan)
                        <tr class="table-row message-row" data-id="{{ $pesan->id }}">
                            <td class="col-no">{{ $loop->iteration }}</td>
                            <td class="col-sender">
                                <div class="sender-info">
                                    <div class="sender-avatar">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="sender-details">
                                        <span class="sender-name">{{ $pesan->nama_depan }} {{ $pesan->nama_belakang }}</span>
                                        <small class="sender-email">{{ $pesan->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="col-subject">
                                <div class="subject-info">
                                    <span class="subject-text">{{ $pesan->subjek }}</span>
                                    <small class="subject-preview">{{ Str::limit($pesan->pesan, 50) }}</small>
                                </div>
                            </td>
                            <td class="col-contact">
                                <div class="contact-info">
                                    @if($pesan->telepon)
                                        <div class="contact-item">
                                            <i class="fa fa-phone"></i>
                                            <span>{{ $pesan->telepon }}</span>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="col-time">
                                <div class="time-info">
                                    <span class="time-value">{{ $pesan->created_at->format('d M Y') }}</span>
                                    <small class="time-hour">{{ $pesan->created_at->format('H:i') }}</small>
                                </div>
                            </td>
                            <td class="col-status">
                                @php
                                    $isRecent = $pesan->created_at->diffInHours(now()) <= 24;
                                    $statusClass = $isRecent ? 'status-new' : 'status-read';
                                    $statusText = $isRecent ? 'Baru' : 'Dibaca';
                                    $statusIcon = $isRecent ? 'fa-envelope' : 'fa-envelope-open';
                                @endphp
                                <span class="status-badge {{ $statusClass }}">
                                    <i class="fa {{ $statusIcon }}"></i>
                                    {{ $statusText }}
                                </span>
                            </td>
                            <td class="col-aksi">
                                <div class="action-buttons">
                                    <button class="btn-view" title="Lihat Detail" onclick="showMessageDetail('{{ $pesan->id }}', '{{ $pesan->nama_depan }} {{ $pesan->nama_belakang }}', '{{ $pesan->email }}', '{{ $pesan->telepon ?? '-' }}', '{{ $pesan->subjek }}', '{{ $pesan->pesan }}', '{{ $pesan->created_at->format('d M Y H:i') }}')">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button class="btn-reply" title="Balas Pesan" onclick="replyMessage('{{ $pesan->email }}', '{{ $pesan->subjek }}')">
                                        <i class="fa fa-reply"></i>
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
@endif
</div>

<!-- Message Detail Modal -->
<div id="messageModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Detail Pesan</h3>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <div class="modal-body">
            <div class="message-detail-info">
                <div class="sender-section">
                    <div class="sender-avatar-large">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <div class="sender-info-large">
                        <h4 id="modalSenderName"></h4>
                        <p id="modalSenderEmail"></p>
                        <p id="modalSenderPhone"></p>
                    </div>
                </div>
                <div class="message-section">
                    <div class="message-header">
                        <h5 id="modalSubject"></h5>
                        <span id="modalTime"></span>
                    </div>
                    <div class="message-content">
                        <p id="modalMessage"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn-reply-modal" onclick="replyFromModal()">
                <i class="fa fa-reply"></i>
                Balas Pesan
            </button>
            <button class="btn-close-modal" onclick="closeModal()">
                <i class="fa fa-times"></i>
                Tutup
            </button>
        </div>
    </div>
</div>

<style>
.pesan-container {
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

/* Empty State */
.empty-state {
    background: #fff;
    border-radius: 12px;
    padding: 64px 32px;
    text-align: center;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
}

.empty-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 24px;
}

.empty-icon i {
    color: #9ca3af;
    font-size: 2.5rem;
}

.empty-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #374151;
    margin: 0 0 8px 0;
}

.empty-description {
    color: #6b7280;
    font-size: 1rem;
    margin: 0;
}

/* Filter Section */
.filter-section {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 24px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
}

.filter-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
}

.search-box {
    position: relative;
    flex: 1;
    max-width: 400px;
}

.search-box i {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
}

.search-input {
    width: 100%;
    padding: 12px 16px 12px 40px;
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

.filter-buttons {
    display: flex;
    gap: 8px;
}

.btn-filter {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border: 2px solid #e5e7eb;
    border-radius: 6px;
    background: #fff;
    color: #374151;
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-filter:hover, .btn-filter.active {
    background: #1976d2;
    color: #fff;
    border-color: #1976d2;
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

.col-sender {
    width: 200px;
}

.col-subject {
    width: 250px;
}

.col-contact {
    width: 150px;
}

.col-time {
    width: 120px;
    text-align: center;
}

.col-status {
    width: 120px;
    text-align: center;
}

.col-aksi {
    width: 100px;
    text-align: center;
}

/* Sender Info Styles */
.sender-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.sender-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: center;
}

.sender-avatar i {
    color: #9ca3af;
    font-size: 1.2rem;
}

.sender-details {
    display: flex;
    flex-direction: column;
}

.sender-name {
    font-weight: 600;
    color: #1a237e;
    font-size: 0.875rem;
}

.sender-email {
    color: #6b7280;
    font-size: 0.75rem;
}

/* Subject Info Styles */
.subject-info {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.subject-text {
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
}

.subject-preview {
    color: #6b7280;
    font-size: 0.75rem;
}

/* Contact Info Styles */
.contact-info {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.875rem;
    color: #374151;
}

.contact-item i {
    color: #1976d2;
    font-size: 0.75rem;
}

/* Time Info Styles */
.time-info {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 2px;
}

.time-value {
    font-weight: 500;
    color: #374151;
    font-size: 0.875rem;
}

.time-hour {
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

.status-new {
    background: #dbeafe;
    color: #1976d2;
}

.status-read {
    background: #f3f4f6;
    color: #6b7280;
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

.btn-view, .btn-reply {
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

.btn-reply {
    background: #d1fae5;
    color: #059669;
}

.btn-reply:hover {
    background: #059669;
    color: #fff;
    transform: scale(1.05);
    box-shadow: 0 2px 6px rgba(5, 150, 105, 0.2);
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
    max-width: 600px;
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

.message-detail-info {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.sender-section {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 16px;
    background: #f8fafc;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
}

.sender-avatar-large {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: center;
}

.sender-avatar-large i {
    color: #9ca3af;
    font-size: 2rem;
}

.sender-info-large h4 {
    margin: 0 0 4px 0;
    color: #1a237e;
    font-size: 1.1rem;
}

.sender-info-large p {
    margin: 0 0 2px 0;
    color: #6b7280;
    font-size: 0.9rem;
}

.message-section {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.message-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 12px;
    border-bottom: 1px solid #e5e7eb;
}

.message-header h5 {
    margin: 0;
    color: #1a237e;
    font-size: 1.1rem;
    font-weight: 600;
}

.message-header span {
    color: #6b7280;
    font-size: 0.875rem;
}

.message-content {
    padding: 16px;
    background: #f8fafc;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
}

.message-content p {
    margin: 0;
    color: #374151;
    line-height: 1.6;
    font-size: 0.95rem;
}

.modal-footer {
    display: flex;
    gap: 12px;
    padding: 20px 24px;
    border-top: 1px solid #e5e7eb;
    background: #f8fafc;
    border-radius: 0 0 12px 12px;
}

.btn-reply-modal, .btn-close-modal {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-reply-modal {
    background: linear-gradient(135deg, #059669 0%, #10b981 100%);
    color: #fff;
}

.btn-reply-modal:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.2);
}

.btn-close-modal {
    background: #fff;
    color: #374151;
    border: 2px solid #d1d5db;
}

.btn-close-modal:hover {
    background: #f3f4f6;
    color: #1f2937;
    border-color: #9ca3af;
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
    
    .filter-actions {
        flex-direction: column;
        gap: 16px;
    }
    
    .search-box {
        max-width: 100%;
    }
    
    .filter-buttons {
        justify-content: center;
    }
    
    .data-table {
        min-width: 800px;
    }
    
    .action-buttons {
        flex-direction: row;
        gap: 4px;
        justify-content: center;
    }
    
    .btn-view, .btn-reply {
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
    
    .sender-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
    
    .sender-avatar {
        width: 32px;
        height: 32px;
    }
    
    .action-buttons {
        gap: 3px;
    }
    
    .btn-view, .btn-reply {
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
    
    .modal-footer {
        padding: 16px 20px;
        flex-direction: column;
    }
}
</style>

<script>
let currentMessageData = {};

function showMessageDetail(id, name, email, phone, subject, message, time) {
    currentMessageData = { id, name, email, phone, subject, message, time };
    
    document.getElementById('modalSenderName').textContent = name;
    document.getElementById('modalSenderEmail').textContent = email;
    document.getElementById('modalSenderPhone').textContent = phone;
    document.getElementById('modalSubject').textContent = subject;
    document.getElementById('modalMessage').textContent = message;
    document.getElementById('modalTime').textContent = time;
    
    document.getElementById('messageModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('messageModal').style.display = 'none';
}

function replyMessage(email, subject) {
    // Implementasi reply email
    const mailtoLink = `mailto:${email}?subject=Re: ${subject}`;
    window.open(mailtoLink);
}

function replyFromModal() {
    if (currentMessageData.email && currentMessageData.subject) {
        replyMessage(currentMessageData.email, currentMessageData.subject);
    }
}

// Search functionality
document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('.message-row');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
    
    // Update active filter to show all when searching
    document.querySelectorAll('.btn-filter').forEach(btn => btn.classList.remove('active'));
    document.querySelector('[data-filter="all"]').classList.add('active');
});

// Filter functionality
document.querySelectorAll('.btn-filter').forEach(btn => {
    btn.addEventListener('click', function() {
        // Remove active class from all buttons
        document.querySelectorAll('.btn-filter').forEach(b => b.classList.remove('active'));
        // Add active class to clicked button
        this.classList.add('active');
        
        const filter = this.dataset.filter;
        const rows = document.querySelectorAll('.message-row');
        const now = new Date();
        
        rows.forEach(row => {
            const statusBadge = row.querySelector('.status-badge');
            const isNew = statusBadge && statusBadge.classList.contains('status-new');
            
            if (filter === 'all') {
                row.style.display = '';
            } else if (filter === 'recent') {
                // Show only recent messages (last 24 hours)
                if (isNew) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            } else if (filter === 'unread') {
                // Show only unread messages (status-new)
                if (isNew) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
        
        // Clear search when filtering
        document.getElementById('searchInput').value = '';
    });
});

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('messageModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    // Set default active filter
    const allFilter = document.querySelector('[data-filter="all"]');
    if (allFilter) {
        allFilter.classList.add('active');
    }
    
    // Add click sound effect for buttons (optional)
    const buttons = document.querySelectorAll('.btn-view, .btn-reply, .btn-filter');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            // Add a subtle visual feedback
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
});
</script>
@endsection 