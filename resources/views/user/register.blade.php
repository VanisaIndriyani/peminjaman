@extends('user.layouts.app')

@section('content')
<div style="max-width: 400px; margin: 40px auto; background: #fff; border-radius: 16px; box-shadow: 0 4px 24px rgba(26,35,126,0.08); padding: 36px 28px;">
    <h1 style="font-size: 2rem; color: #1a237e; font-weight: 700; margin-bottom: 24px; text-align: center;">Register User</h1>
    <form method="POST" action="/register" style="display: flex; flex-direction: column; gap: 18px;">
        @csrf
        <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" style="padding: 12px; border-radius: 8px; border: 1.5px solid #1976d2; font-size: 1rem;">
        @error('name')<div style="color:#d32f2f;font-size:0.95rem;">{{ $message }}</div>@enderror
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" style="padding: 12px; border-radius: 8px; border: 1.5px solid #1976d2; font-size: 1rem;">
        @error('email')<div style="color:#d32f2f;font-size:0.95rem;">{{ $message }}</div>@enderror
        <input type="password" name="password" placeholder="Password" style="padding: 12px; border-radius: 8px; border: 1.5px solid #1976d2; font-size: 1rem;">
        @error('password')<div style="color:#d32f2f;font-size:0.95rem;">{{ $message }}</div>@enderror
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" style="padding: 12px; border-radius: 8px; border: 1.5px solid #1976d2; font-size: 1rem;">
        <button type="submit" style="background: linear-gradient(90deg, #1a237e 0%, #1976d2 100%); color: #fff; padding: 12px 0; border-radius: 8px; font-size: 1.1rem; font-weight: 600; border: none; cursor: pointer;">Daftar</button>
    </form>
    <div style="text-align: center; margin-top: 18px;">
        <a href="/login" style="color: #1976d2; text-decoration: underline; font-size: 1rem;">Sudah punya akun? Login</a>
    </div>
</div>
@endsection 