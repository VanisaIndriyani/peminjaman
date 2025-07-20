<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - Peminjaman Mobil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
        }
        
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            background: #f8fafc;
            color: #1a237e;
            overflow-x: hidden;
        }
        
        header {
            background: linear-gradient(90deg, #1a237e 0%, #1976d2 100%);
            box-shadow: 0 4px 20px rgba(26,35,126,0.15);
            margin-bottom: 0;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 999;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        
        nav {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px;
            padding: 24px 0 0 0;
            position: relative;
        }
        
        nav a {
            color: #fff;
            text-decoration: none;
            font-size: 20px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: 12px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        nav a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }
        
        nav a:hover::before {
            left: 100%;
        }
        
        nav a:hover, nav a.active {
            background: rgba(255,255,255,0.15);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .cart-icon {
            font-size: 24px;
        }
        
        .nav-group {
            display: flex;
            align-items: center;
            gap: 40px;
        }
        
        .nav-toggle {
            display: none;
            background: none;
            border: none;
            color: #fff;
            font-size: 2rem;
            cursor: pointer;
            margin-right: 12px;
            transition: all 0.3s ease;
        }
        
        .nav-toggle:hover {
            transform: scale(1.1);
        }
        
        .nav-mobile {
            display: none;
            flex-direction: column;
            gap: 0;
            background: rgba(26,35,126,0.95);
            backdrop-filter: blur(10px);
            position: absolute;
            top: 100%;
            left: 0;
            width: 100vw;
            z-index: 100;
            box-shadow: 0 8px 32px rgba(26,35,126,0.2);
            animation: slideDown 0.3s ease;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .nav-mobile a {
            padding: 16px 24px;
            font-size: 1.1rem;
            border-radius: 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            transition: all 0.3s ease;
        }
        
        .nav-mobile a:hover {
            background: rgba(255,255,255,0.1);
            padding-left: 32px;
        }
        
        main {
            padding: 100px 0 32px 0;
            min-height: 60vh;
        }
        
        footer {
            text-align: center;
            padding: 18px 0;
            background: #1a237e;
            color: #fff;
            letter-spacing: 1px;
        }
        
        .nav-logo {
            margin-right: 10px;
            transition: all 0.3s ease;
        }
        
        .nav-logo:hover {
            transform: scale(1.05);
        }
        
        .nav-logo-text {
            display: inline;
        }
        
        /* Enhanced Profile Dropdown Styling */
        .profile-dropdown-user {
            position: relative;
        }
        
        #profileBtnUser {
            background: none;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 12px 20px;
            color: #fff;
            font-size: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            border-radius: 12px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        #profileBtnUser::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }
        
        #profileBtnUser:hover::before {
            left: 100%;
        }
        
        #profileBtnUser:hover {
            background: rgba(255,255,255,0.15);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        #profileBtnUser i {
            transition: all 0.3s ease;
        }
        
        #profileBtnUser:hover i {
            transform: scale(1.1);
        }
        
        #profileDropdownUser {
            display: none;
            position: absolute;
            right: 0;
            top: 60px;
            background: #fff;
            min-width: 220px;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(26,35,126,0.15);
            padding: 8px 0;
            z-index: 999;
            animation: dropdownFadeIn 0.3s ease;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            overflow: hidden;
        }
        
        @keyframes dropdownFadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        /* Dropdown Header */
        .dropdown-header {
            padding: 16px 20px 12px 20px;
            border-bottom: 1px solid #f1f5f9;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }
        
        .dropdown-header .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .dropdown-header .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1976d2 0%, #1a237e 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px rgba(25,118,210,0.3);
        }
        
        .dropdown-header .user-details {
            flex: 1;
        }
        
        .dropdown-header .user-name {
            font-weight: 700;
            color: #1a237e;
            font-size: 1rem;
            margin-bottom: 2px;
        }
        
        .dropdown-header .user-role {
            color: #64748b;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        /* Dropdown Menu Items */
        #profileDropdownUser a,
        #profileDropdownUser button {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            color: #1a237e;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        
        #profileDropdownUser a::before,
        #profileDropdownUser button::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(90deg, rgba(25,118,210,0.1) 0%, rgba(26,35,126,0.05) 100%);
            transition: width 0.3s ease;
        }
        
        #profileDropdownUser a:hover::before,
        #profileDropdownUser button:hover::before {
            width: 100%;
        }
        
        #profileDropdownUser a:hover,
        #profileDropdownUser button:hover {
            background: rgba(25,118,210,0.05);
            padding-left: 24px;
            transform: translateX(4px);
        }
        
        #profileDropdownUser a i,
        #profileDropdownUser button i {
            font-size: 1.1rem;
            transition: all 0.3s ease;
            width: 20px;
            text-align: center;
        }
        
        #profileDropdownUser a:hover i,
        #profileDropdownUser button:hover i {
            transform: scale(1.1);
        }
        
        /* Logout Button Special Styling */
        #profileDropdownUser button[type="submit"] {
            color: #dc2626;
            border-top: 1px solid #f1f5f9;
            margin-top: 4px;
        }
        
        #profileDropdownUser button[type="submit"]:hover {
            background: rgba(220,38,38,0.1);
            color: #b91c1c;
        }
        
        #profileDropdownUser button[type="submit"] i {
            color: #dc2626;
        }
        
        /* Dropdown Arrow */
        #profileDropdownUser::before {
            content: '';
            position: absolute;
            top: -8px;
            right: 20px;
            width: 0;
            height: 0;
            border-left: 8px solid transparent;
            border-right: 8px solid transparent;
            border-bottom: 8px solid #fff;
        }
        
        /* Responsive Design */
        @media (max-width: 900px) {
            nav, .nav-group {
                gap: 18px;
            }
            nav a {
                font-size: 17px;
                padding: 10px 12px;
            }
            main {
                padding: 80px 0 18px 0;
            }
        }
        
        @media (max-width: 700px) {
            nav {
                justify-content: flex-start;
                padding: 14px 0 14px 0;
            }
            .nav-group {
                display: none;
            }
            .nav-toggle {
                display: block;
            }
            .nav-mobile {
                display: flex;
            }
            main {
                padding: 64px 0 8px 0;
            }
            .nav-logo-text {
                display: none;
            }
            
            /* Mobile-specific animations */
            .nav-mobile a {
                transform: translateX(-20px);
                opacity: 0;
                animation: slideInLeft 0.3s ease forwards;
            }
            
            .nav-mobile a:nth-child(1) { animation-delay: 0.1s; }
            .nav-mobile a:nth-child(2) { animation-delay: 0.2s; }
            .nav-mobile a:nth-child(3) { animation-delay: 0.3s; }
            .nav-mobile a:nth-child(4) { animation-delay: 0.4s; }
            .nav-mobile a:nth-child(5) { animation-delay: 0.5s; }
            
            @keyframes slideInLeft {
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            
            /* Mobile dropdown adjustments */
            #profileDropdownUser {
                right: -10px;
                min-width: 200px;
            }
        }
        
        @media (max-width: 700px) {
            footer > div[style*='display:flex'] {
                flex-direction: column !important;
                gap: 18px 0 !important;
                align-items: flex-start !important;
            }
        }
        
        /* Enhanced footer styles */
        footer {
            background: linear-gradient(135deg, #1a237e 0%, #0d47a1 100%);
            position: relative;
            overflow: hidden;
        }
        
        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.03)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.03)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            pointer-events: none;
        }
        
        footer a {
            transition: all 0.3s ease;
        }
        
        footer a:hover {
            transform: translateY(-2px);
            text-shadow: 0 2px 8px rgba(255,255,255,0.3);
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="{{ url('/beranda') }}" class="nav-logo" style="display:flex;align-items:center;gap:8px;text-decoration:none;margin-right:10px;">
                <i class="fa fa-car" style="font-size:2rem;color:#3b82f6;"></i>
                <span class="nav-logo-text" style="font-size:1.15rem;font-weight:700;letter-spacing:0.5px;">MD Rent Car</span>
            </a>
            <button class="nav-toggle" id="navToggle" aria-label="Menu"><i class="fa fa-bars"></i></button>
            <div class="nav-group" id="navGroup">
                <a href="{{ url('/beranda') }}" data-aos="fade-down" data-aos-delay="100"><i class="fa fa-home"></i> Beranda</a>
                <a href="{{ url('/tentang') }}" data-aos="fade-down" data-aos-delay="200"><i class="fa fa-info-circle"></i> Tentang</a>
                <a href="{{ url('/katalog') }}" data-aos="fade-down" data-aos-delay="300"><i class="fa fa-list"></i> Katalog</a>
                <a href="{{ url('/kontak') }}" data-aos="fade-down" data-aos-delay="400"><i class="fa fa-phone"></i> Kontak</a>
                @guest
                    <a href="{{ url('/login') }}" data-aos="fade-down" data-aos-delay="500"><i class="fa fa-user"></i> Masuk</a>
                @else
                    <div class="profile-dropdown-user">
                        <button id="profileBtnUser">
                            <i class="fa fa-user-circle"></i>
                        </button>
                        <div id="profileDropdownUser">
                            <!-- Dropdown Header -->
                            <div class="dropdown-header">
                                <div class="user-info">
                                    <div class="user-avatar">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="user-details">
                                        <div class="user-name">{{ Auth::user()->name ?? 'User' }}</div>
                                        <div class="user-role">Customer</div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Menu Items -->
                            <a href="{{ url('/riwayat') }}">
                                <i class="fa fa-history"></i>
                                <span>Riwayat Peminjaman</span>
                            </a>
                            <form method="POST" action="{{ url('/logout') }}" style="margin:0;">
                                @csrf
                                <button type="submit">
                                    <i class="fa fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
            <div class="nav-mobile" id="navMobile" style="display:none;">
                <a href="{{ url('/beranda') }}"><i class="fa fa-home"></i> Beranda</a>
                <a href="{{ url('/tentang') }}"><i class="fa fa-info-circle"></i> Tentang</a>
                <a href="{{ url('/katalog') }}"><i class="fa fa-list"></i> Katalog</a>
                <a href="{{ url('/kontak') }}"><i class="fa fa-phone"></i> Kontak</a>
                @guest
                    <a href="{{ url('/login') }}"><i class="fa fa-user"></i> Masuk</a>
                @else
                    <a href="{{ url('/riwayat') }}"><i class='fa fa-history'></i> Riwayat Peminjaman</a>
                    <form method="POST" action="{{ url('/logout') }}" style="margin:0;">
                        @csrf
                        <button type="submit" style="background:none;border:none;padding:10px 24px;width:100%;text-align:left;color:#d32f2f;font-weight:600;cursor:pointer;display:flex;align-items:center;gap:8px;"><i class="fa fa-sign-out-alt"></i> Logout</button>
                    </form>
                @endguest
            </div>
        </nav>
    </header>
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });
        
        // Hamburger menu toggle with animation
        const navToggle = document.getElementById('navToggle');
        const navGroup = document.getElementById('navGroup');
        const navMobile = document.getElementById('navMobile');
        
        navToggle && navToggle.addEventListener('click', function() {
            if(navMobile.style.display === 'flex') {
                navMobile.style.display = 'none';
                navToggle.innerHTML = '<i class="fa fa-bars"></i>';
            } else {
                navMobile.style.display = 'flex';
                navToggle.innerHTML = '<i class="fa fa-times"></i>';
            }
        });
        
        // Close mobile nav on link click
        if(navMobile) {
            navMobile.querySelectorAll('a,button').forEach(function(el) {
                el.addEventListener('click', function() {
                    navMobile.style.display = 'none';
                    navToggle.innerHTML = '<i class="fa fa-bars"></i>';
                });
            });
        }
        
        // Enhanced Profile dropdown with smooth animations
        const profileBtnUser = document.getElementById('profileBtnUser');
        const profileDropdownUser = document.getElementById('profileDropdownUser');
        
        if(profileBtnUser && profileDropdownUser) {
            profileBtnUser.addEventListener('click', function(e) {
                e.stopPropagation();
                const isVisible = profileDropdownUser.style.display === 'block';
                
                if(isVisible) {
                    profileDropdownUser.style.animation = 'dropdownFadeOut 0.2s ease forwards';
                    setTimeout(() => {
                        profileDropdownUser.style.display = 'none';
                        profileDropdownUser.style.animation = '';
                    }, 200);
                } else {
                    profileDropdownUser.style.display = 'block';
                    profileDropdownUser.style.animation = 'dropdownFadeIn 0.3s ease';
                }
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if(profileDropdownUser.style.display === 'block' && 
                   !profileDropdownUser.contains(e.target) && 
                   e.target !== profileBtnUser) {
                    profileDropdownUser.style.animation = 'dropdownFadeOut 0.2s ease forwards';
                    setTimeout(() => {
                        profileDropdownUser.style.display = 'none';
                        profileDropdownUser.style.animation = '';
                    }, 200);
                }
            });
            
            // Add fade out animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes dropdownFadeOut {
                    from {
                        opacity: 1;
                        transform: translateY(0) scale(1);
                    }
                    to {
                        opacity: 0;
                        transform: translateY(-10px) scale(0.95);
                    }
                }
            `;
            document.head.appendChild(style);
        }
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.style.background = 'rgba(26,35,126,0.95)';
                header.style.backdropFilter = 'blur(15px)';
            } else {
                header.style.background = 'linear-gradient(90deg, #1a237e 0%, #1976d2 100%)';
                header.style.backdropFilter = 'blur(10px)';
            }
        });
    </script>
    
    <main>
        @yield('content')
    </main>
    
    <footer style="background:#232b37;color:#fff;padding:48px 0 0 0;margin-top:48px;">
        <div style="max-width:1200px;margin:0 auto;display:flex;flex-wrap:wrap;gap:32px 24px;justify-content:space-between;align-items:flex-start;padding:0 24px 32px 24px;">
            <!-- Logo & Deskripsi -->
            <div style="flex:1 1 220px;min-width:220px;max-width:320px;" data-aos="fade-up" data-aos-delay="100">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
                    <i class="fa fa-car" style="font-size:2rem;color:#3b82f6;"></i>
                    <span style="font-size:1.35rem;font-weight:700;letter-spacing:0.5px;">MD Rent Car</span>
                </div>
                <div style="color:#e0e7ef;font-size:1rem;line-height:1.6;">Mitra terpercaya Anda untuk sewa mobil. Kendaraan berkualitas dengan harga kompetitif.</div>
            </div>
            <!-- Tautan Cepat -->
            <div style="flex:1 1 160px;min-width:160px;max-width:200px;" data-aos="fade-up" data-aos-delay="200">
                <div style="font-weight:600;font-size:1.08rem;margin-bottom:12px;">Tautan Cepat</div>
                <div style="display:flex;flex-direction:column;gap:8px;">
                    <a href="{{ url('/beranda') }}" style="color:#fff;text-decoration:none;">Beranda</a>
                    <a href="{{ url('/tentang') }}" style="color:#fff;text-decoration:none;">Tentang</a>
                    <a href="{{ url('/katalog') }}" style="color:#fff;text-decoration:none;">Katalog</a>
                    <a href="{{ url('/kontak') }}" style="color:#fff;text-decoration:none;">Kontak</a>
                </div>
            </div>
            <!-- Informasi Kontak -->
            <div style="flex:1 1 220px;min-width:220px;max-width:320px;" data-aos="fade-up" data-aos-delay="300">
                <div style="font-weight:600;font-size:1.08rem;margin-bottom:12px;display:flex;align-items:center;gap:10px;">
                    <i class="fa fa-car" style="font-size:1.5rem;color:#3b82f6;"></i> Informasi Kontak
                </div>
                <div style="color:#e0e7ef;font-size:1rem;line-height:1.6;">
                    Jl. Keranji GG. H. MOH NO.60 RT 04/RW 06 Ciganjur<br>
                    Jagakarsa, Jakarta Selatan. 12630<br>
                    Telepon: <a href="https://wa.me/6289636937394" style="color:#43d854;text-decoration:none;">+62 896-3693-7394 <i class='fab fa-whatsapp'></i></a><br>
                    Email: <a href="mailto:mdrentcar22@gmail.com" style="color:#fff;text-decoration:none;">mdrentcar22@gmail.com</a>
                </div>
            </div>
            <!-- Ikuti Kami -->
            <div style="flex:1 1 120px;min-width:120px;max-width:160px;" data-aos="fade-up" data-aos-delay="400">
                <div style="font-weight:600;font-size:1.08rem;margin-bottom:12px;">Ikuti Kami</div>
                <div style="display:flex;gap:18px;align-items:center;">
                    <a href="#" style="color:#fff;font-size:1.5rem;transition: all 0.3s ease;"><i class="fab fa-tiktok"></i></a>
                    <a href="#" style="color:#fff;font-size:1.5rem;transition: all 0.3s ease;"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div style="max-width:1200px;margin:0 auto;padding:0 24px;">
            <hr style="border:0;border-top:1px solid #374151;margin:18px 0 0 0;">
        </div>
        <div style="text-align:center;padding:18px 0 0 0;color:#e0e7ef;font-size:1rem;">
            &copy; 2025 MD Rent Car. Semua hak dilindungi.
        </div>
    </footer>
</body>
</html> 