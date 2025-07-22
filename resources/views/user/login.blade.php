@extends('user.layouts.app')

@section('content')
<div style="max-width: 400px; margin: 40px auto; background: #fff; border-radius: 16px; box-shadow: 0 4px 24px rgba(26,35,126,0.08); padding: 36px 28px;">
    <h1 style="font-size: 2rem; color: #1a237e; font-weight: 700; margin-bottom: 24px; text-align: center;">Login User</h1>
    @if($errors->has('email'))
        <div style="background: #fdecea; color: #b71c1c; padding: 12px 18px; border-radius: 8px; margin-bottom: 18px; text-align: center; font-weight: 600;">
            <i class="fa fa-exclamation-circle" style="margin-right:8px;"></i>
            {{ $errors->first('email') }}
        </div>
    @elseif($errors->has('password'))
        <div style="background: #fdecea; color: #b71c1c; padding: 12px 18px; border-radius: 8px; margin-bottom: 18px; text-align: center; font-weight: 600;">
            <i class="fa fa-exclamation-circle" style="margin-right:8px;"></i>
            {{ $errors->first('password') }}
        </div>
    @endif
    <form method="POST" action="{{ url('/login') }}" style="display: flex; flex-direction: column; gap: 18px;">
        @csrf
        <input type="email" name="email" placeholder="Email" style="padding: 12px; border-radius: 8px; border: 1.5px solid #1976d2; font-size: 1rem;">
        <div style="position: relative;">
            <input type="password" name="password" id="password" placeholder="Password" style="width: 100%; padding: 12px; padding-right: 45px; border-radius: 8px; border: 1.5px solid #1976d2; font-size: 1rem; box-sizing: border-box;">
            <button type="button" id="togglePassword" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #1976d2; font-size: 1.1rem;">
                <i class="fa fa-eye" id="passwordIcon"></i>
            </button>
        </div>
        <button type="submit" style="background: linear-gradient(90deg, #1a237e 0%, #1976d2 100%); color: #fff; padding: 12px 0; border-radius: 8px; font-size: 1.1rem; font-weight: 600; border: none; cursor: pointer;">Login</button>
    </form>
    <div style="text-align: center; margin-top: 8px;">
        <a href="{{ url('/register') }}" style="color: #1976d2; text-decoration: underline; font-size: 1rem;">Belum punya akun? Daftar</a>
    </div>
    <div style="margin-top: 0.75rem; font-weight: 500; color: #2563eb; text-align:center;transition:all 0.3s ease;" 
     onmouseover="this.style.color='#1a237e';this.style.transform='scale(1.05)'" 
     onmouseout="this.style.color='#2563eb';this.style.transform='scale(1)'">
 
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    const passwordIcon = document.getElementById('passwordIcon');
    
    togglePassword.addEventListener('click', function() {
        // Toggle password visibility
        if (password.type === 'password') {
            password.type = 'text';
            passwordIcon.className = 'fa fa-eye-slash';
            passwordIcon.style.color = '#dc2626';
        } else {
            password.type = 'password';
            passwordIcon.className = 'fa fa-eye';
            passwordIcon.style.color = '#1976d2';
        }
    });
    
    // Add hover effects
    togglePassword.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-50%) scale(1.1)';
    });
    
    togglePassword.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(-50%) scale(1)';
    });
});
</script>
@endsection 