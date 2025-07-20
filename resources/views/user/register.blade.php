@extends('user.layouts.app')

@section('content')
<div style="max-width: 400px; margin: 40px auto; background: #fff; border-radius: 16px; box-shadow: 0 4px 24px rgba(26,35,126,0.08); padding: 36px 28px;">
    <h1 style="font-size: 2rem; color: #1a237e; font-weight: 700; margin-bottom: 24px; text-align: center;">Register User</h1>
    <form method="POST" action="{{ url('/register') }}" style="display: flex; flex-direction: column; gap: 18px;">
        @csrf
        <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" style="padding: 12px; border-radius: 8px; border: 1.5px solid #1976d2; font-size: 1rem;">
        @error('name')<div style="color:#d32f2f;font-size:0.95rem;">{{ $message }}</div>@enderror
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" style="padding: 12px; border-radius: 8px; border: 1.5px solid #1976d2; font-size: 1rem;">
        @error('email')<div style="color:#d32f2f;font-size:0.95rem;">{{ $message }}</div>@enderror
        
        <!-- Password Field -->
        <div style="position: relative;">
            <input type="password" name="password" id="password" placeholder="Password" style="width: 100%; padding: 12px; padding-right: 45px; border-radius: 8px; border: 1.5px solid #1976d2; font-size: 1rem; box-sizing: border-box;">
            <button type="button" id="togglePassword" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #1976d2; font-size: 1.1rem;">
                <i class="fa fa-eye" id="passwordIcon"></i>
            </button>
        </div>
        @error('password')<div style="color:#d32f2f;font-size:0.95rem;">{{ $message }}</div>@enderror
        
        <!-- Confirm Password Field -->
        <div style="position: relative;">
            <input type="password" name="password_confirmation" id="passwordConfirmation" placeholder="Konfirmasi Password" style="width: 100%; padding: 12px; padding-right: 45px; border-radius: 8px; border: 1.5px solid #1976d2; font-size: 1rem; box-sizing: border-box;">
            <button type="button" id="togglePasswordConfirmation" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #1976d2; font-size: 1.1rem;">
                <i class="fa fa-eye" id="passwordConfirmationIcon"></i>
            </button>
        </div>
        
        <button type="submit" style="background: linear-gradient(90deg, #1a237e 0%, #1976d2 100%); color: #fff; padding: 12px 0; border-radius: 8px; font-size: 1.1rem; font-weight: 600; border: none; cursor: pointer;">Daftar</button>
    </form>
    <div style="text-align: center; margin-top: 18px;">
        <a href="{{ url('/login') }}" style="color: #1976d2; text-decoration: underline; font-size: 1rem;">Sudah punya akun? Login</a>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password toggle functionality
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    const passwordIcon = document.getElementById('passwordIcon');
    
    togglePassword.addEventListener('click', function() {
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
    
    // Password confirmation toggle functionality
    const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');
    const passwordConfirmation = document.getElementById('passwordConfirmation');
    const passwordConfirmationIcon = document.getElementById('passwordConfirmationIcon');
    
    togglePasswordConfirmation.addEventListener('click', function() {
        if (passwordConfirmation.type === 'password') {
            passwordConfirmation.type = 'text';
            passwordConfirmationIcon.className = 'fa fa-eye-slash';
            passwordConfirmationIcon.style.color = '#dc2626';
        } else {
            passwordConfirmation.type = 'password';
            passwordConfirmationIcon.className = 'fa fa-eye';
            passwordConfirmationIcon.style.color = '#1976d2';
        }
    });
    
    // Add hover effects for both buttons
    [togglePassword, togglePasswordConfirmation].forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-50%) scale(1.1)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(-50%) scale(1)';
        });
    });
    
    // Password strength indicator (optional)
    password.addEventListener('input', function() {
        const value = this.value;
        const strength = calculatePasswordStrength(value);
        updatePasswordStrengthIndicator(strength);
    });
    
    function calculatePasswordStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength++;
        if (/[a-z]/.test(password)) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;
        return strength;
    }
    
    function updatePasswordStrengthIndicator(strength) {
        // You can add a visual strength indicator here if needed
        const colors = ['#dc2626', '#f59e0b', '#eab308', '#22c55e', '#16a34a'];
        const messages = ['Sangat Lemah', 'Lemah', 'Sedang', 'Kuat', 'Sangat Kuat'];
        
        // Optional: Add strength indicator below password field
        let strengthIndicator = document.getElementById('passwordStrength');
        if (!strengthIndicator) {
            strengthIndicator = document.createElement('div');
            strengthIndicator.id = 'passwordStrength';
            strengthIndicator.style.fontSize = '0.8rem';
            strengthIndicator.style.marginTop = '4px';
            password.parentNode.appendChild(strengthIndicator);
        }
        
        if (password.value.length > 0) {
            strengthIndicator.style.color = colors[strength - 1] || '#6b7280';
            strengthIndicator.textContent = `Kekuatan: ${messages[strength - 1] || 'Sangat Lemah'}`;
        } else {
            strengthIndicator.textContent = '';
        }
    }
});
</script>
@endsection 