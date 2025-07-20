@extends('user.layouts.app')

@section('content')
@if(session('success'))
    <div id="notif-success" style="max-width:900px;margin:0 auto 18px auto;background:#1976d2;color:#fff;padding:16px 24px;border-radius:12px;box-shadow:0 2px 8px rgba(26,35,126,0.10);font-size:1.08rem;display:flex;align-items:center;justify-content:space-between;gap:16px;">
        <span>{{ session('success') }}</span>
        <button onclick="document.getElementById('notif-success').style.display='none'" style="background:none;border:none;color:#fff;font-size:1.3rem;cursor:pointer;">&times;</button>
    </div>
@endif
@if(isset($notif) && $notif)
    @php
        $msg = $notif === 'disetujui' ? 'Peminjaman Anda telah disetujui! Silakan cek detail peminjaman.' : 'Peminjaman Anda ditolak. Silakan hubungi admin untuk info lebih lanjut.';
        $color = $notif === 'disetujui' ? '#2e7d32' : '#d32f2f';
    @endphp
    <div id="notif-alert" style="max-width:900px;margin:0 auto 18px auto;background:{{ $color }};color:#fff;padding:16px 24px;border-radius:12px;box-shadow:0 2px 8px rgba(26,35,126,0.10);font-size:1.08rem;display:flex;align-items:center;justify-content:space-between;gap:16px;">
        <span>{{ $msg }}</span>
        <button onclick="document.getElementById('notif-alert').style.display='none'" style="background:none;border:none;color:#fff;font-size:1.3rem;cursor:pointer;">&times;</button>
    </div>
@endif
<h1 style="font-size:2rem;color:#1a237e;font-weight:700;margin-bottom:24px;text-align:center;">Riwayat Peminjaman</h1>
<div style="max-width:900px;margin:0 auto;background:#fff;padding:32px 24px;border-radius:16px;box-shadow:0 2px 12px rgba(26,35,126,0.08);">
    @if($peminjamans->isEmpty())
        <div style="text-align:center;color:#888;font-size:1.1rem;">Belum ada riwayat peminjaman.</div>
    @else
    <div style="overflow-x:auto;">
    <table style="width:100%;border-collapse:collapse;min-width:600px;">
        <thead style="background:#1976d2;color:#fff;">
            <tr>
                <th style="padding:12px;text-align:left;">Mobil</th>
                <th style="padding:12px;text-align:center;">Tanggal Pinjam</th>
                <th style="padding:12px;text-align:center;">Tanggal Kembali</th>
                <th style="padding:12px;text-align:center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjamans as $peminjaman)
            <tr style="border-bottom:1px solid #eee;">
                <td style="padding:10px;text-align:left;">{{ $peminjaman->mobil->nama ?? '-' }}</td>
                <td style="padding:10px;text-align:center;">{{ $peminjaman->tanggal_pinjam }}</td>
                <td style="padding:10px;text-align:center;">{{ $peminjaman->tanggal_kembali }}</td>
                <td style="padding:10px;text-align:center;">
                    @php
                        $status = strtolower($peminjaman->status);
                        $color = '#2563eb';
                        $label = '';
                        if ($status === 'menunggu_pembayaran') {
                            $color = '#2563eb';
                            $label = '⏳ Menunggu';
                        } elseif ($status === 'disetujui') {
                            $color = '#2e7d32';
                            $label = '✔️ Disetujui';
                        } elseif ($status === 'ditolak') {
                            $color = '#d32f2f';
                            $label = '❌ Ditolak';
                        } elseif ($status === 'kembali') {
                            $color = '#1976d2';
                            $label = '🔄 Kembali';
                        } else {
                            $label = ucfirst($peminjaman->status);
                        }
                    @endphp
                    <span style="display:inline-block;padding:3px 10px;border-radius:14px;font-weight:600;color:#fff;background:{{ $color }};min-width:70px;text-align:center;font-size:0.97em;">
                        {{ $label }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    @endif
</div>
@endsection 