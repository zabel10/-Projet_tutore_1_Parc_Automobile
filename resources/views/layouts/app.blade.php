<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AutoPark - Gestion de Parc Automobile')</title>
    <meta name="description" content="Gérez efficacement votre parc automobile depuis une plateforme unique. Suivez vos véhicules, chauffeurs, entretiens et consommations en temps réel.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- CSS / Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AOS (Animate On Scroll) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary: #2563EB;
            --primary-dark: #0F172A;
            --primary-light: #3B82F6;
            --accent: #F97316;
            --bg-dark: #0F172A;
            --bg-card: #141414;
            --text-light: #FAFAFA;
            --text-gray: #A3A3A3;
            --border-color: #262626;
            --background-light: #F8FAFC;
            --background-dark: #101622;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Lexend', sans-serif;
            background-color: var(--background-light);
            color: #1F2937;
            line-height: 1.6;
            padding-top: 80px;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Lexend', sans-serif;
            font-weight: 700;
        }

        .navbar-custom {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            background: transparent;
            padding: 1rem 0;
        }

        .navbar-custom.scrolled {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(20px);
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-brand-custom {
            font-family: 'Lexend', sans-serif;
            font-weight: 900;
            font-size: 1.8rem;
            color: white !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-brand-custom span {
            color: var(--primary-light);
        }

        .nav-link-custom {
            position: relative;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 500;
            text-decoration: none;
            font-size: 0.95rem;
        }

        .nav-link-custom:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white !important;
            transform: translateY(-1px);
        }

        .nav-link-custom.active {
            background-color: rgba(37, 99, 235, 0.3);
            color: var(--primary-light) !important;
            font-weight: 600;
            border-bottom: 2px solid var(--primary-light);
        }

        .nav-link-custom::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background-color: var(--primary-light);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link-custom:hover::after {
            width: 80%;
        }

        .nav-link-custom.active::after {
            width: 0;
        }

        .btn-primary-custom {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
            padding: 0.75rem 1.75rem;
            font-weight: 600;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-primary-custom:hover {
            background-color: var(--primary-light);
            border-color: var(--primary-light);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3);
        }

        .btn-orange-custom {
            background-color: var(--accent);
            border-color: var(--accent);
            color: white;
            padding: 0.75rem 1.75rem;
            font-weight: 600;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-orange-custom:hover {
            background-color: #EA580C;
            border-color: #EA580C;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(249, 115, 22, 0.3);
        }

        .btn-outline-custom {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 0.75rem 1.75rem;
            font-weight: 600;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-outline-custom:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
            color: white;
        }

        .section-padding {
            padding: 100px 0;
        }

        .card-custom {
            background: white;
            border: 1px solid #E5E7EB;
            border-radius: 1rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card-custom:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-color: var(--primary);
        }

        .text-blue-primary {
            color: var(--primary) !important;
        }

        .text-blue-dark {
            color: var(--primary-dark) !important;
        }

        .text-orange {
            color: var(--accent) !important;
        }

        .bg-orange {
            background-color: var(--accent) !important;
        }

        .border-blue-primary {
            border-color: var(--primary) !important;
        }

        .hero-section {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            overflow: hidden;
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        }

        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            opacity: 0.15;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.9) 0%, rgba(30, 58, 138, 0.8) 100%);
        }

        .stats-counter {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .form-input-custom {
            width: 100%;
            border: 2px solid #E5E7EB;
            border-radius: 0.75rem;
            background: white;
            padding: 1rem;
            color: #1F2937;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .form-input-custom:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            transform: translateY(-2px);
        }

        .form-input-custom::placeholder {
            color: #9CA3AF;
        }

        .info-card {
            background: white;
            border-radius: 1.25rem;
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid #E5E7EB;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(37, 99, 235, 0.1);
            border-color: var(--primary);
        }

        .info-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            color: white;
            font-size: 1.5rem;
        }

        .contact-form {
            background: white;
            border-radius: 1.25rem;
            padding: 2.5rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
            border: 1px solid #E5E7EB;
        }

        .footer-bg {
            background-color: var(--primary-dark);
            color: var(--text-light);
            padding: 60px 0 30px;
        }

        .footer-border {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .mobile-menu {
            display: none;
            position: fixed;
            top: 70px;
            left: 0;
            right: 0;
            background: rgba(15, 23, 42, 0.98);
            backdrop-filter: blur(20px);
            padding: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 999;
        }

        .mobile-menu.show {
            display: block;
        }

        .mobile-menu a {
            display: block;
            padding: 1rem;
            color: white;
            text-decoration: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .mobile-menu a:hover {
            color: var(--primary-light);
            background: rgba(37, 99, 235, 0.1);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease forwards;
            opacity: 0;
        }

        .animate-slide-up {
            animation: slideUp 1s ease forwards;
            opacity: 0;
        }

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }
        .delay-5 { animation-delay: 0.5s; }

        @media (max-width: 991px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .stats-counter {
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
                text-align: center;
            }
            
            .hero-subtitle {
                text-align: center;
            }
            
            .section-padding {
                padding: 60px 0;
            }
            
            .contact-form {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body class="antialiased">
    <!-- Navigation -->
    <nav class="navbar-custom" id="navbar" style="background: rgba(15, 23, 42, 0.98);">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between w-100">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="navbar-brand-custom me-5">
                    <i class="bi bi-car-front-fill text-blue-primary"></i>
                    Auto<span>Park</span>
                </a>

                <!-- Desktop Nav -->
                <div class="d-none d-lg-flex align-items-center gap-1 justify-content-center flex-grow-1">
                    <a href="{{ route('home') }}" class="nav-link-custom {{ request()->is('/') ? 'active' : '' }}">Accueil</a>
                    <a href="{{ route('home') }}#features" class="nav-link-custom">Fonctionnalités</a>
                    <a href="{{ route('home') }}#modules" class="nav-link-custom">Modules</a>
                    <a href="{{ route('presentation') }}" class="nav-link-custom {{ request()->is('presentation') ? 'active' : '' }}">À propos</a>
                    <a href="{{ route('contact.index') }}" class="nav-link-custom {{ request()->is('contact') ? 'active' : '' }}">Contact</a>
                </div>

                <!-- Auth Links -->
                <div class="d-none d-lg-flex align-items-center gap-3 mx-3">
                    @guest
                        <a href="{{ route('login') }}" class="nav-link-custom {{ request()->is('login') ? 'active' : '' }}">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary-custom">
                            Inscription
                        </a>
                    @else
                        <div class="dropdown">
                            <a href="#" class="nav-link-custom dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i> {{ Auth::user()->prenom }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end border-0 shadow" aria-labelledby="userDropdown" style="background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(10px); border-radius: 12px;">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 px-3" style="border-radius: 8px;">
                                            <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>

                <!-- Mobile menu button -->
                <div class="d-lg-none">
                    <button type="button" class="btn btn-outline-light" id="mobile-menu-btn">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu" id="mobile-menu">
            <a href="{{ route('home') }}">Accueil</a>
            <a href="{{ route('home') }}#features">Fonctionnalités</a>
            <a href="{{ route('home') }}#modules">Modules</a>
            <a href="{{ route('presentation') }}">À propos</a>
            <a href="{{ route('contact.index') }}">Contact</a>
            
            @guest
                <a href="{{ route('login') }}" class="text-blue-primary">Connexion</a>
                <a href="{{ route('register') }}" class="text-blue-primary">Inscription</a>
            @else
                <a href="#" class="text-blue-primary">{{ Auth::user()->prenom }}</a>
                <form action="{{ route('logout') }}" method="POST" class="px-3 py-2">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger w-100">Déconnexion</button>
                </form>
            @endguest
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @if(!request()->is('login') && !request()->is('register'))
    <footer class="footer-bg" style="padding: 60px 0 30px;">
        <div class="container">
            <div class="row g-5">
                <!-- Brand & Description -->
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('home') }}" class="navbar-brand-custom mb-3 d-inline-block">
                        <i class="bi bi-car-front-fill text-blue-primary"></i>
                        Auto<span>Park</span>
                    </a>
                    <p class="text-secondary mb-4" style="max-width: 300px; line-height: 1.8; color: var(--text-gray) !important;">
                        Solution intelligente de gestion de parc automobile pour optimiser vos coûts et améliorer votre productivité.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#" class="social-link">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="bi bi-twitter-x"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-5">
                    <h5 class="text-white mb-4" style="font-weight: 600;">Navigation</h5>
                    <div class="row">
                        <div class="col-3">
                            <ul class="list-unstyled">
                                <li><a href="{{ route('home') }}" class="text-secondary text-decoration-none hover-text-gold">Accueil</a></li>
                                <li><a href="{{ route('home') }}#features" class="text-secondary text-decoration-none hover-text-gold">Fonctionnalités</a></li>
                                <li><a href="{{ route('home') }}#modules" class="text-secondary text-decoration-none hover-text-gold">Modules</a></li>
                                <li><a href="{{ route('presentation') }}" class="text-secondary text-decoration-none hover-text-gold">À propos</a></li>
                            </ul>
                        </div>

                        <div class="col-3">
                            <ul class="list-unstyled">
                                <li><a href="{{ route('contact.index') }}" class="text-secondary text-decoration-none hover-text-gold">Contact</a></li>
                                <li><a href="{{ route('home') }}#dashboard" class="text-secondary text-decoration-none hover-text-gold">Tableau de bord</a></li>
                                <li><a href="{{ route('home') }}#advantages" class="text-secondary text-decoration-none hover-text-gold">Avantages</a></li>
                                <li><a href="{{ route('home') }}#testimonials" class="text-secondary text-decoration-none hover-text-gold">Témoignages</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Contact -->
                <div class="col-lg-3 col-md-2">
                    <h5 class="text-white mb-4" style="font-weight: 600;">Contact</h5>
                    <ul class="list-unstyled text-secondary">
                        <li class="mb-3">
                            <i class="bi bi-geo-alt-fill me-2" style="color: var(--primary);"></i>
                            Ouagadougou, Burkina Faso
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-telephone-fill me-2" style="color: var(--primary);"></i>
                            +226 70 00 00 00
                        </li>
                        <li class="mb-0">
                            <i class="bi bi-envelope-fill me-2" style="color: var(--primary);"></i>
                            contact@autopark.bf
                        </li>
                    </ul>
                </div>
            </div>

            <hr class="bg-secondary" style="margin: 40px 0 30px;">

            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="text-secondary mb-0">&copy; {{ date('Y') }} AutoPark. Tous droits réservés.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-secondary text-decoration-none me-3 hover-text-gold">Mentions légales</a>
                    <a href="#" class="text-secondary text-decoration-none hover-text-gold">Politique de confidentialité</a>
                </div>
            </div>
        </div>
    </footer>
    @endif

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100,
            easing: 'ease-out-cubic'
        });

        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('show');
            });
        }

        // Counter animation
        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-count'));
            const duration = 2000;
            const increment = target / (duration / 16);
            let current = 0;

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current);
                }
            }, 16);
        }

        // Intersection Observer for counter animation
        const counters = document.querySelectorAll('.stats-counter');
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                    animateCounter(entry.target);
                    entry.target.classList.add('animated');
                }
            });
        }, observerOptions);

        counters.forEach(counter => {
            observer.observe(counter);
        });

        // FAQ toggle
        const faqQuestions = document.querySelectorAll('.faq-question');
        faqQuestions.forEach(question => {
            question.addEventListener('click', function() {
                const faqItem = this.closest('.faq-item');
                
                document.querySelectorAll('.faq-item').forEach(item => {
                    if (item !== faqItem) {
                        item.classList.remove('active');
                    }
                });
                
                faqItem.classList.toggle('active');
            });
        });

        // Active nav link on scroll (only for single-page sections)
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link-custom');

        // Only apply scroll-based active state if we have sections on the page
        if (sections.length > 0) {
            window.addEventListener('scroll', () => {
                let current = '';
                
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;
                    if (window.scrollY >= (sectionTop - 150)) {
                        current = section.getAttribute('id');
                    }
                });

                navLinks.forEach(link => {
                    link.classList.remove('active');
                    // Only add active if href matches current section (for # links)
                    const href = link.getAttribute('href');
                    if (href && href.startsWith('#') && href === '#' + current) {
                        link.classList.add('active');
                    }
                    // Restore page-based active state for non-hash links
                    if (href && !href.startsWith('#')) {
                        const urlPath = href.replace(/^\//, '').split('?')[0];
                        const currentPath = window.location.pathname.replace(/^\//, '').split('?')[0];
                        if (urlPath === currentPath || (urlPath === '' && currentPath === '')) {
                            link.classList.add('active');
                        }
                    }
                });
            });
        }
    </script>
</body>
</html>