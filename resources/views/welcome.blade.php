<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eSICA - Gestion des congés et absences</title>
    <meta name="description" content="Portail de gestion des congés et absences">
    <meta name="author" content="Lovable">
    <meta property="og:image" content="/og-image.png">
    <link rel="shortcut icon" href="{{ asset('assets/images/ibam.png') }}" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary: #0ea5e9;
            --primary-dark: #0284c7;
            --primary-light: #e0f2fe;
            --secondary: #f97316;
            --secondary-dark: #ea580c;
            --secondary-light: #ffedd5;
            --dark: #0f172a;
            --light: #f8fafc;
            --bs-primary: #0ea5e9;
            --bs-secondary: #f97316;
            --bs-primary-rgb: 14, 165, 233;
            --bs-secondary-rgb: 249, 115, 22;
            --gradient: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        }

        body {
            font-family: "Poppins", sans-serif;
            color: var(--dark);
            overflow-x: hidden;
            position: relative;
            background-color: #fafafa;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Poppins", sans-serif;
            font-weight: 700;
        }

        .text-primary {
            color: var(--primary) !important;
        }

        .text-secondary {
            color: var(--secondary) !important;
        }

        .bg-primary-light {
            background-color: var(--primary-light);
        }

        .bg-secondary-light {
            background-color: var(--secondary-light);
        }

        .bg-gradient {
            background: var(--gradient);
        }

        .text-gradient {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Scroll Bar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }

        /* Cursor */
        .cursor {
            position: fixed;
            width: 40px;
            height: 40px;
            border: 2px solid var(--primary);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
            transition: width 0.3s, height 0.3s, border-color 0.3s;
            z-index: 9999;
        }

        .cursor-dot {
            position: fixed;
            width: 8px;
            height: 8px;
            background-color: var(--primary);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
            z-index: 9999;
        }

        /* Navbar Styles */
        .navbar {
            transition: all 0.4s ease;
            padding: 1.5rem 0;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .navbar.scrolled {
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1);
            padding: 0.7rem 0;
            background: rgba(255, 255, 255, 0.95);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            letter-spacing: -0.5px;
        }

        .logo {
            height: 60px;
            border-radius: 15px;
            transition: all 0.4s ease;
            filter: drop-shadow(0 4px 8px rgba(14, 165, 233, 0.3));
        }

        .logo:hover {
            transform: scale(1.1) rotate(5deg);
        }

        .btn-login {
            border-radius: 50px;
            padding: 0.7rem 2rem;
            font-weight: 600;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
            z-index: 1;
            border: none;
            color: white;
            background: var(--gradient);
            box-shadow: 0 4px 15px rgba(14, 165, 233, 0.3);
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
            transition: all 0.4s ease;
            z-index: -1;
        }

        .btn-login:hover::before {
            width: 100%;
        }

        .btn-login:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(14, 165, 233, 0.4);
        }

        /* Hero Section */
        .hero {
            padding: 12rem 0 6rem;
            position: relative;
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.05) 0%, rgba(249, 115, 22, 0.05) 100%);
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(var(--primary-light), transparent 70%);
            top: -300px;
            left: -300px;
            z-index: -1;
        }

        .hero::after {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(var(--secondary-light), transparent 70%);
            bottom: -200px;
            right: -200px;
            z-index: -1;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            letter-spacing: -1px;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            color: #475569;
            max-width: 700px;
            margin: 0 auto 3rem;
            line-height: 1.6;
        }

        .hero-btn {
            border-radius: 50px;
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
            z-index: 1;
            border: none;
            color: white;
            background: var(--gradient);
            box-shadow: 0 8px 20px rgba(14, 165, 233, 0.3);
            letter-spacing: 0.5px;
        }

        .hero-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
            transition: all 0.4s ease;
            z-index: -1;
        }

        .hero-btn:hover::before {
            width: 100%;
        }

        .hero-btn:hover {
            transform: translateY(-7px);
            box-shadow: 0 15px 30px rgba(14, 165, 233, 0.4);
        }

        /* Floating Elements */
        .floating-element {
            position: absolute;
            opacity: 0.6;
            z-index: -1;
        }

        .float-1 {
            width: 60px;
            height: 60px;
            background-color: var(--primary);
            top: 20%;
            left: 10%;
            border-radius: 12px;
            animation: float1 15s infinite ease-in-out;
        }

        .float-2 {
            width: 40px;
            height: 40px;
            background-color: var(--secondary);
            top: 60%;
            right: 10%;
            border-radius: 50%;
            animation: float2 10s infinite ease-in-out;
        }

        .float-3 {
            width: 80px;
            height: 80px;
            border: 5px solid var(--primary);
            top: 40%;
            left: 50%;
            border-radius: 50%;
            animation: float3 20s infinite ease-in-out;
        }

        @keyframes float1 {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg);
            }

            33% {
                transform: translate(100px, 50px) rotate(180deg);
            }

            66% {
                transform: translate(-50px, 100px) rotate(360deg);
            }
        }

        @keyframes float2 {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            50% {
                transform: translate(-70px, -50px) scale(1.5);
            }
        }

        @keyframes float3 {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            50% {
                transform: translate(100px, 70px) scale(0.7);
            }
        }

        /* Features Section */
        .features {
            padding: 8rem 0;
            position: relative;
            background-color: var(--light);
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            letter-spacing: -0.5px;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: #64748b;
            max-width: 700px;
            margin: 0 auto 4rem;
        }

        .feature-card {
            border-radius: 24px;
            border: none;
            background: white;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.05);
            transition: all 0.5s ease;
            height: 100%;
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 0;
            background: var(--gradient);
            opacity: 0.03;
            transition: all 0.5s ease;
            z-index: -1;
        }

        .feature-card:hover::before {
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-20px) scale(1.03);
            box-shadow: 0 30px 70px rgba(14, 165, 233, 0.2);
        }

        .feature-icon-wrapper {
            width: 90px;
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.1) 0%, rgba(249, 115, 22, 0.1) 100%);
            position: relative;
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon-wrapper {
            transform: scale(1.1) rotate(10deg);
        }

        .feature-icon {
            font-size: 2.5rem;
            transition: all 0.3s ease;
        }

        .feature-icon-primary {
            color: var(--primary);
        }

        .feature-icon-secondary {
            color: var(--secondary);
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.2);
        }

        .feature-title {
            font-weight: 700;
            margin-bottom: 1rem;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-title {
            transform: translateY(-5px);
        }

        .feature-description {
            color: #64748b;
            line-height: 1.8;
            transition: all 0.3s ease;
        }

        .feature-btn {
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
        }

        .feature-card:hover .feature-btn {
            opacity: 1;
            transform: translateY(0);
        }

        /* CTA Section */
        .cta-section {
            padding: 7rem 0;
            position: relative;
            overflow: hidden;
            background: var(--primary-light);
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill-rule='evenodd'%3E%3Cg fill='%230ea5e9' fill-opacity='0.05'%3E%3Cpath opacity='.5' d='M96 95h4v1h-4v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9zm-1 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .cta-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .cta-description {
            font-size: 1.2rem;
            color: #475569;
            max-width: 600px;
            margin: 0 auto 2.5rem;
        }

        .cta-btn {
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            background: var(--gradient);
            color: white;
            border: none;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
            z-index: 1;
            box-shadow: 0 8px 20px rgba(14, 165, 233, 0.3);
        }

        .cta-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
            transition: all 0.4s ease;
            z-index: -1;
        }

        .cta-btn:hover::before {
            width: 100%;
        }

        .cta-btn:hover {
            transform: translateY(-7px);
            box-shadow: 0 15px 30px rgba(14, 165, 233, 0.4);
        }

        /* Footer */
        footer {
            background-color: white;
            padding: 4rem 0 2rem;
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--gradient);
        }

        .footer-logo {
            height: 50px;
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        .footer-logo:hover {
            transform: scale(1.1);
        }

        .footer-copyright {
            font-size: 0.9rem;
            color: #64748b;
        }

        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-light);
            color: var(--primary);
            font-size: 1.2rem;
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            transform: translateY(-5px);
            background: var(--primary);
            color: white;
        }

        /* Waves */
        .wave-container {
            position: relative;
            height: 150px;
            width: 100%;
            overflow: hidden;
        }

        .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background-size: 1000px 100px;
        }

        .wave1 {
            animation: animate1 30s linear infinite;
            z-index: 3;
            opacity: 0.7;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath fill='%230EA5E9' d='M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z' opacity='0.2'%3E%3C/path%3E%3C/svg%3E");
        }

        .wave2 {
            animation: animate2 15s linear infinite;
            z-index: 2;
            opacity: 0.5;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath fill='%23F97316' d='M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z' opacity='0.2'%3E%3C/path%3E%3C/svg%3E");
        }

        @keyframes animate1 {
            0% {
                background-position-x: 0;
            }

            100% {
                background-position-x: 1000px;
            }
        }

        @keyframes animate2 {
            0% {
                background-position-x: 0;
            }

            100% {
                background-position-x: -1000px;
            }
        }

        /* Stats Counter */
        .stats-section {
            padding: 5rem 0;
            background: white;
        }

        .stats-card {
            text-align: center;
            padding: 2rem;
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-10px);
        }

        .stats-number {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stats-label {
            font-size: 1.1rem;
            color: #64748b;
            font-weight: 500;
        }

        /* Glass card effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.05);
            padding: 3rem;
            max-width: 900px;
            margin: 0 auto;
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .hero {
                padding: 8rem 0 4rem;
            }

            .hero-title {
                font-size: 3rem;
            }

            .section-title {
                font-size: 2.2rem;
            }

            .cta-title {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 767.98px) {
            .hero {
                padding: 7rem 0 3rem;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .cta-title {
                font-size: 2.2rem;
            }

            .feature-card {
                margin-bottom: 2rem;
            }

            .glass-card {
                padding: 2rem;
            }
        }

        @media (max-width: 575.98px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .logo {
                height: 50px;
            }

            .navbar-brand {
                font-size: 1.5rem;
            }

            .hero-btn {
                width: 100%;
            }

            .stats-number {
                font-size: 2.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Cursor Effect (for desktop only) -->
    <div class="cursor d-none d-lg-block"></div>
    <div class="cursor-dot d-none d-lg-block"></div>

    <!-- Floating Elements -->
    <div class="floating-element float-1"></div>
    <div class="floating-element float-2"></div>
    <div class="floating-element float-3"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="https://th.bing.com/th/id/OIP.rjtJOj8U-MFQAn4V0Wgk1wHaEO?w=295&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7"
                    class="logo me-2" alt="Logo">
                <span class="ms-2"><span class="text-secondary">e</span><span class="text-primary">-SICA</span></span>
            </a>
            @auth
                <!-- Liens pour les utilisateurs connectés -->
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <button class="btn-login" type="button">
                        <i class="bi bi-person-fill me-2"></i>
                        Tableau de bord
                    </button>
                @else
                    <!-- Liens pour les utilisateurs non connectés -->
                    <a class="nav-link" href="{{ route('login') }}">
                        <button class="btn-login" type="button">
                            <i class="bi bi-person-fill me-2"></i>
                            Connexion
                        </button>
                    </a>

                @endauth

        </div>
    </nav>

    <!-- Hero Section (suite) -->
    <section class="hero">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-10" data-aos="fade-up" data-aos-duration="1000">
                    <h1 class="hero-title text-gradient">Gérez vos demandes en toute simplicité</h1>
                    <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="200">Une interface intuitive pour
                        planifier et suivre vos demandes de congés et d'absences. Gagnez du temps et simplifiez vos
                        démarches administratives.</p>
                    <a href="{{ route('dashboard') }}" class="btn hero-btn" data-aos="fade-up" data-aos-delay="400">
                        <i class="bi bi-calendar-check me-2"></i>
                        Démarrer maintenant
                    </a>
                </div>
            </div>
        </div>
    </section>


    <div class="col-12">
        <div class="border-top pt-4">
            <p class="footer-copyright text-center mb-0">© 2025 eSICA. Tous droits réservés.</p>
        </div>
    </div>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Custom JS -->
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Cursor effect
        document.addEventListener('mousemove', function(e) {
            const cursor = document.querySelector('.cursor');
            const cursorDot = document.querySelector('.cursor-dot');

            if (cursor && cursorDot) {
                cursor.style.left = e.clientX + 'px';
                cursor.style.top = e.clientY + 'px';
                cursorDot.style.left = e.clientX + 'px';
                cursorDot.style.top = e.clientY + 'px';
            }
        });

        // Stats counter animation
        const statsNumbers = document.querySelectorAll('.stats-number');

        statsNumbers.forEach(number => {
            const target = parseInt(number.getAttribute('data-counter'));
            const increment = target / 100;
            let current = 0;

            const updateCounter = () => {
                if (current < target) {
                    current += increment;
                    number.textContent = Math.ceil(current) + (number.textContent.includes('%') ? '%' : '+');
                    setTimeout(updateCounter, 10);
                } else {
                    number.textContent = target + (number.textContent.includes('%') ? '%' : '+');
                }
            };

            // Start the counter when the element is in view
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    updateCounter();
                    observer.disconnect();
                }
            }, {
                threshold: 0.5
            });

            observer.observe(number);
        });
    </script>
</body>

</html>
