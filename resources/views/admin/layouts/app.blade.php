<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Peminjaman Mobil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }
        
        body {
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f8fafc;
            color: #1a237e;
            overflow-x: hidden;
        }
        
        .admin-layout {
            display: flex;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }
        
        /* Enhanced Sidebar Styling */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            overflow-y: auto;
            z-index: 1000;
            background: linear-gradient(180deg, #1a237e 0%, #2563eb 100%);
            color: #fff;
            display: flex;
            flex-direction: column;
            padding: 0;
            box-shadow: 4px 0 20px rgba(26,35,126,0.15);
            border-top-right-radius: 24px;
            border-bottom-right-radius: 24px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.03)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.03)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            pointer-events: none;
        }
        
        .sidebar .sidebar-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            font-size: 1.6rem;
            font-weight: 800;
            padding: 32px 24px;
            margin-bottom: 24px;
            letter-spacing: 1px;
            color: #fff;
            position: relative;
            z-index: 1;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            flex-shrink: 0;
        }
        
        .sidebar .sidebar-logo i {
            font-size: 2.1rem;
            color: #3b82f6;
            transition: all 0.3s ease;
        }
        
        .sidebar .sidebar-logo:hover i {
            transform: scale(1.1) rotate(5deg);
        }
        
        .sidebar nav {
            display: flex;
            flex-direction: column;
            gap: 8px;
            padding: 0 16px;
            flex: 1;
            position: relative;
            z-index: 1;
            overflow-y: auto;
            margin-bottom: 16px;
        }
        
        .sidebar a {
            color: #e0e7ef;
            text-decoration: none;
            font-size: 1.1rem;
            font-weight: 500;
            padding: 16px 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .sidebar a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.5s ease;
        }
        
        .sidebar a:hover::before {
            left: 100%;
        }
        
        .sidebar a i {
            font-size: 1.3rem;
            transition: all 0.3s ease;
            width: 24px;
            text-align: center;
        }
        
        .sidebar a:hover, .sidebar a.active {
            background: rgba(255,255,255,0.15);
            color: #fff;
            transform: translateX(8px);
            box-shadow: 0 4px 15px rgba(255,255,255,0.1);
        }
        
        .sidebar a:hover i, .sidebar a.active i {
            transform: scale(1.1);
        }
        
        .sidebar form {
            margin: 16px;
            position: relative;
            z-index: 1;
            flex-shrink: 0;
            padding-bottom: 16px;
        }
        
        .sidebar button {
            color: #fff;
            font-size: 1.1rem;
            font-weight: 500;
            padding: 16px 20px;
            border-radius: 12px;
            background: none;
            border: none;
            display: flex;
            align-items: center;
            gap: 16px;
            width: 100%;
            text-align: left;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        
        .sidebar button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(220,38,38,0.1), transparent);
            transition: left 0.5s ease;
        }
        
        .sidebar button:hover::before {
            left: 100%;
        }
        
        .sidebar button:hover {
            background: rgba(220,38,38,0.15);
            color: #fecaca;
            transform: translateX(8px);
        }
        
        .sidebar button i {
            font-size: 1.3rem;
            transition: all 0.3s ease;
            width: 24px;
            text-align: center;
        }
        
        .sidebar button:hover i {
            transform: scale(1.1);
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            margin-left: 280px;
            transition: all 0.3s ease;
            padding: 0 32px;
            min-height: 100vh;
            overflow-x: auto;
        }
        
        /* Enhanced Header */
        .admin-header {
            background: #fff;
            padding: 24px 32px;
            box-shadow: 0 2px 12px rgba(26,35,126,0.08);
            font-size: 1.2rem;
            font-weight: 600;
            color: #1a237e;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
            margin: 16px 0 24px 0;
            border-radius: 16px;
            flex-wrap: wrap;
            gap: 16px;
        }
        
        .admin-header span {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .admin-header span::before {
            content: '👋';
            font-size: 1.4rem;
        }
        
        /* Enhanced Profile Dropdown */
        .profile-dropdown {
            position: relative;
            display: inline-block;
        }
        
        .profile-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: #1a237e;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .profile-btn:hover {
            background: rgba(25,118,210,0.1);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(25,118,210,0.15);
        }
        
        .profile-btn img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        
        .profile-btn:hover img {
            border-color: #1976d2;
            transform: scale(1.05);
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            top: 60px;
            background: #fff;
            min-width: 220px;
            box-shadow: 0 20px 60px rgba(26,35,126,0.15);
            border-radius: 16px;
            z-index: 1000;
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
        
        .profile-dropdown.open .dropdown-content {
            display: block;
        }
        
        .dropdown-content::before {
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
        
        .dropdown-content .profile-name {
            padding: 20px 20px 12px 20px;
            font-weight: 700;
            color: #1a237e;
            border-bottom: 1px solid #f1f5f9;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }
        
        .dropdown-content .dropdown-item {
            width: 100%;
            background: none;
            border: none;
            color: #374151;
            font-size: 1rem;
            font-weight: 500;
            padding: 16px 20px;
            text-align: left;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-decoration: none;
        }
        
        .dropdown-content .dropdown-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(90deg, rgba(25,118,210,0.1) 0%, rgba(25,118,210,0.05) 100%);
            transition: width 0.3s ease;
        }
        
        .dropdown-content .dropdown-item:hover::before {
            width: 100%;
        }
        
        .dropdown-content .dropdown-item:hover {
            background: rgba(25,118,210,0.1);
            padding-left: 24px;
            transform: translateX(4px);
            color: #1976d2;
        }
        
        .dropdown-content .dropdown-item i {
            font-size: 1.1rem;
            transition: all 0.3s ease;
            width: 20px;
            text-align: center;
        }
        
        .dropdown-content .dropdown-item:hover i {
            transform: scale(1.1);
        }
        
        .dropdown-content .logout-btn {
            color: #dc2626;
            border-top: 1px solid #f1f5f9;
        }
        
        .dropdown-content .logout-btn::before {
            background: linear-gradient(90deg, rgba(220,38,38,0.1) 0%, rgba(220,38,38,0.05) 100%);
        }
        
        .dropdown-content .logout-btn:hover {
            background: rgba(220,38,38,0.1);
            color: #dc2626;
        }
        
        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            color: #1a237e;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .mobile-menu-toggle:hover {
            background: rgba(25,118,210,0.1);
            transform: scale(1.1);
        }
        
        /* Responsive Design */
        @media (max-width: 1024px) {
            .sidebar {
                width: 260px;
            }
            
            .main-content {
                margin-left: 260px;
                padding: 0 24px;
        }
        }
        
        @media (max-width: 900px) {
            .mobile-menu-toggle {
                display: block;
            }
            
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
                position: fixed;
                z-index: 1000;
            }
            
            .sidebar.open {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                padding: 0 20px;
                width: 100%;
            }
            
            .admin-header {
                padding: 20px 24px;
                margin: 12px 0 20px 0;
            }
        }
        
        @media (max-width: 768px) {
            .admin-header {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
                padding: 18px 20px;
                margin: 8px 0 16px 0;
            }
            
            .profile-btn {
                align-self: flex-end;
            }
            
            .dropdown-content {
                right: -10px;
                min-width: 200px;
            }
            
            .main-content {
                padding: 0 16px;
                margin-left: 0;
            }
            
            /* Table responsive */
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            
            .table-responsive table {
                min-width: 600px;
            }
        }
        
        @media (max-width: 600px) {
            .main-content {
                padding: 0 12px;
                margin-left: 0;
            }
            
            .admin-header {
                padding: 16px 18px;
                margin: 6px 0 12px 0;
            }
            
            .sidebar {
                width: 100%;
                border-radius: 0;
            }
            
            .sidebar .sidebar-logo {
                padding: 20px 16px;
            }
            
            .sidebar nav {
                padding: 0 12px;
            }
            
            .sidebar a, .sidebar button {
                padding: 14px 16px;
                font-size: 1rem;
            }
            
            .sidebar form {
                margin: 12px;
            }
            
            /* Mobile table adjustments */
            .table-responsive table {
                min-width: 500px;
                font-size: 0.9rem;
            }
            
            .table-responsive th,
            .table-responsive td {
                padding: 8px 6px;
            }
        }
        
        @media (max-width: 480px) {
            .main-content {
                padding: 0 8px;
            }
            
            .admin-header {
                padding: 12px 16px;
                margin: 4px 0 8px 0;
            }
            
            /* Extra small table adjustments */
            .table-responsive table {
                min-width: 400px;
                font-size: 0.8rem;
            }
            
            .table-responsive th,
            .table-responsive td {
                padding: 6px 4px;
            }
        }
        
        /* Overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            backdrop-filter: blur(4px);
        }
        
        .sidebar-overlay.open {
            display: block;
        }
        
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
        
        /* Loading animation */
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }
        
        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #1976d2;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            transform: translate(-50%, -50%);
        }
        
        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }
        
        /* Content flexibility */
        .content-wrapper {
            width: 100%;
            max-width: 100%;
            overflow-x: auto;
            padding: 0;
        }
        
        .content-container {
            min-width: 100%;
            padding: 0;
        }
        
        /* Table responsive improvements */
        .table-container {
            overflow-x: auto;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .table-container table {
            width: 100%;
            min-width: 800px;
            border-collapse: collapse;
        }
        
        /* Card responsive */
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            margin-bottom: 24px;
        }
        
        .card {
            background: #fff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.15);
        }
        
        /* Form responsive */
        .form-container {
            max-width: 100%;
            overflow-x: auto;
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            }
        
        /* Responsive text */
        .responsive-text {
            font-size: clamp(0.875rem, 2vw, 1rem);
        }
        
        .responsive-title {
            font-size: clamp(1.5rem, 4vw, 2rem);
        }
        
        /* Smooth transitions */
        * {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="admin-layout">
        <!-- Mobile Menu Toggle -->
        <button class="mobile-menu-toggle" id="mobileMenuToggle" style="position: fixed; top: 20px; left: 20px; z-index: 1001;">
            <i class="fa fa-bars"></i>
        </button>
        
        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
        
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-logo">
                <i class="fa fa-car" style="color:#3b82f6;"></i> 
                <span>MD Admin</span>
            </div>
            <nav>
                <a href="{{ url('/admin/dashboard') }}" class="nav-link" data-aos="fade-right" data-aos-delay="100">
                    <i class="fa fa-dashboard"></i> 
                    <span>Dashboard</span>
                </a>
                <a href="{{ url('/admin/mobil') }}" class="nav-link" data-aos="fade-right" data-aos-delay="150">
                    <i class="fa fa-car"></i> 
                    <span>Data Mobil</span>
                </a>
                <a href="{{ url('/admin/peminjaman') }}" class="nav-link" data-aos="fade-right" data-aos-delay="200">
                    <i class="fa fa-calendar-check"></i> 
                    <span>Peminjaman</span>
                </a>
                <a href="{{ url('/admin/pengembalian') }}" class="nav-link" data-aos="fade-right" data-aos-delay="250">
                    <i class="fa fa-undo"></i> 
                    <span>Pengembalian</span>
                </a>
                <a href="{{ url('/admin/pengguna') }}" class="nav-link" data-aos="fade-right" data-aos-delay="300">
                    <i class="fa fa-users"></i> 
                    <span>Pengguna</span>
                </a>
                <a href="{{ url('/admin/laporan') }}" class="nav-link" data-aos="fade-right" data-aos-delay="350">
                    <i class="fa fa-file-alt"></i> 
                    <span>Laporan</span>
                </a>
                <a href="{{ url('/admin/pesan') }}" class="nav-link" data-aos="fade-right" data-aos-delay="400">
                    <i class="fa fa-envelope"></i> 
                    <span>Pesan Masuk</span>
                </a>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <div class="main-content">
            <header class="admin-header">
                <span>Selamat datang, Admin</span>
                <div class="profile-dropdown" id="profileDropdown">
                    <button class="profile-btn" onclick="toggleDropdown(event)">
                        @if(Auth::user() && Auth::user()->foto)
                            <img src="{{ asset('storage/profile/' . Auth::user()->foto) }}" alt="Foto Profil">
                        @else
                            <i class="fa fa-user-circle" style="font-size: 2rem; color: #1976d2;"></i>
                        @endif
                        <span style="font-size:1rem; font-weight:500;">{{ Auth::user()->name ?? 'Admin' }}</span>
                        <i class="fa fa-chevron-down" style="font-size: 0.8rem; margin-left: 8px;"></i>
                    </button>
                    <div class="dropdown-content">
                        <div class="profile-name">{{ Auth::user()->name ?? 'Admin' }}</div>
                        <a href="{{ route('admin.profile.show') }}" class="dropdown-item">
                            <i class="fa fa-user"></i>
                            <span>Profil Saya</span>
                        </a>
                        <form method="POST" action="{{ url('/logout') }}" style="margin: 0;">
                            @csrf
                            <button type="submit" class="dropdown-item logout-btn">
                                <i class="fa fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </header>
            <main>
                <div class="content-wrapper" style="padding: 0 0 32px 0;">
                    <div class="content-container">
                @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });
        
        // Mobile menu toggle
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        
        function toggleSidebar() {
            sidebar.classList.toggle('open');
            sidebarOverlay.classList.toggle('open');
            
            // Change icon
            const icon = mobileMenuToggle.querySelector('i');
            if (sidebar.classList.contains('open')) {
                icon.className = 'fa fa-times';
            } else {
                icon.className = 'fa fa-bars';
            }
        }
        
        mobileMenuToggle.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);
        
        // Close sidebar on link click (mobile)
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 900) {
                    toggleSidebar();
                }
            });
        });
        
        // Profile dropdown toggle
function toggleDropdown(e) {
    e.preventDefault();
            const dropdown = document.getElementById('profileDropdown');
            const isOpen = dropdown.classList.contains('open');
            
            if (isOpen) {
                dropdown.style.animation = 'dropdownFadeOut 0.2s ease forwards';
                setTimeout(() => {
                    dropdown.classList.remove('open');
                    dropdown.style.animation = '';
                }, 200);
            } else {
                dropdown.classList.add('open');
                dropdown.style.animation = 'dropdownFadeIn 0.3s ease';
            }
            
            // Close dropdown when clicking outside
    document.addEventListener('click', function handler(event) {
        if (!dropdown.contains(event.target)) {
            dropdown.classList.remove('open');
            document.removeEventListener('click', handler);
        }
    });
}
        
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
        
        // Active link highlighting
        const currentPath = window.location.pathname;
        document.querySelectorAll('.nav-link').forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });
        
        // Resize handler
        window.addEventListener('resize', () => {
            if (window.innerWidth > 900) {
                sidebar.classList.remove('open');
                sidebarOverlay.classList.remove('open');
                const icon = mobileMenuToggle.querySelector('i');
                icon.className = 'fa fa-bars';
                
                // Reset main content margin
                const mainContent = document.querySelector('.main-content');
                if (mainContent) {
                    mainContent.style.marginLeft = '280px';
                }
            } else {
                // Mobile view - remove margin
                const mainContent = document.querySelector('.main-content');
                if (mainContent) {
                    mainContent.style.marginLeft = '0';
                }
            }
        });
        
        // Content scroll handler
        function handleContentScroll() {
            const contentWrapper = document.querySelector('.content-wrapper');
            if (contentWrapper) {
                // Add smooth scrolling to content
                contentWrapper.style.scrollBehavior = 'smooth';
            }
        }
        
        // Initialize content scroll
        handleContentScroll();
        
        // Handle table responsiveness
        function handleTableResponsiveness() {
            const tables = document.querySelectorAll('table');
            tables.forEach(table => {
                if (!table.closest('.table-container')) {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'table-container';
                    table.parentNode.insertBefore(wrapper, table);
                    wrapper.appendChild(table);
                }
            });
        }
        
        // Initialize table responsiveness
        handleTableResponsiveness();
        
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
</script>
</body>
</html> 