<?php
// ============================================================
// PHP Form Handling for Appointment & Contact
// ============================================================
$formMessage = '';
$formType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['appointment_submit'])) {
        $name = htmlspecialchars($_POST['name'] ?? '');
        $email = htmlspecialchars($_POST['email'] ?? '');
        $phone = htmlspecialchars($_POST['phone'] ?? '');
        $date = htmlspecialchars($_POST['date'] ?? '');
        $department = htmlspecialchars($_POST['department'] ?? '');
        $message = htmlspecialchars($_POST['message'] ?? '');
        
        // Simulate successful booking (in production, use mail() or database)
        $formMessage = "Thank you, $name! Your appointment request for $department on $date has been received. Our orthopedic team will confirm shortly.";
        $formType = 'success';
    }
    
    if (isset($_POST['contact_submit'])) {
        $cname = htmlspecialchars($_POST['cname'] ?? '');
        $cemail = htmlspecialchars($_POST['cemail'] ?? '');
        $cmessage = htmlspecialchars($_POST['cmessage'] ?? '');
        
        $formMessage = "Thank you for your message, $cname! We'll get back to you within 24 hours.";
        $formType = 'success';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ortho Plus - Expert orthopedic specialists helping you move better and live better.">
    <meta name="keywords" content="orthopedics, joint replacement, sports medicine, clinic, doctor, Ortho Plus">
    <meta name="author" content="Ortho Plus">
    <title>Ortho Plus | Move Better. Live Better.</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Using a bold sans-serif font to match the Ortho Plus logo style -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AOS Animation Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

    <style>
        :root {
            /* Ortho Plus Brand Colors */
            --primary: #0B4F8C; /* Deep Royal Blue */
            --primary-light: #1668B3; 
            --primary-dark: #063560;
            
            --secondary: #2AA198; /* Healing Teal */
            --secondary-light: #3ABDB2;
            
            --accent: #7AC943; /* Vibrant Lime Green */
            --accent-hover: #66B035;
            
            --white: #ffffff;
            --off-white: #F7F9FC; /* Soft Off-White Neutral Background */
            --light-gray: #E2E8F0;
            --mid-gray: #CBD5E1;
            
            --text: #1E293B; /* Primary Text - Dark Slate */
            --text-light: #64748B; /* Secondary Text - Slate Gray */
            
            --danger: #ef4444;
            --success: #7AC943;
            
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04);
            --shadow: 0 4px 20px rgba(11, 79, 140, 0.08), 0 1px 3px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 20px 50px rgba(11, 79, 140, 0.12), 0 8px 20px rgba(0, 0, 0, 0.06);
            --shadow-xl: 0 30px 70px rgba(11, 79, 140, 0.15), 0 10px 30px rgba(0, 0, 0, 0.08);
            
            --radius-sm: 10px;
            --radius: 16px;
            --radius-lg: 24px;
            --radius-xl: 32px;
            --transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-smooth: 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            font-size: 16px;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text);
            background: var(--off-white);
            line-height: 1.7;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* ============ PRELOADER ============ */
        #preloader {
            position: fixed;
            inset: 0;
            background: var(--off-white);
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.6s ease, visibility 0.6s ease;
        }
        #preloader.hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }
        .loader-pulse {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: conic-gradient(from 0deg, var(--primary), var(--secondary), var(--accent), var(--primary));
            animation: loaderSpin 1.2s linear infinite;
            position: relative;
        }
        .loader-pulse::after {
            content: '';
            position: absolute;
            inset: 8px;
            background: var(--white);
            border-radius: 50%;
        }
        @keyframes loaderSpin {
            100% { transform: rotate(360deg); }
        }

        /* ============ CUSTOM CURSOR ============ */
        .custom-cursor {
            width: 28px;
            height: 28px;
            border: 2px solid var(--secondary);
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            z-index: 9999;
            transition: transform 0.15s ease, background 0.3s ease, border-color 0.3s ease;
            transform: translate(-50%, -50%);
            mix-blend-mode: difference;
        }
        .custom-cursor.hover {
            transform: translate(-50%, -50%) scale(1.8);
            background: rgba(42, 161, 152, 0.2);
            border-color: var(--accent);
            mix-blend-mode: normal;
        }
        @media (max-width: 768px) {
            .custom-cursor { display: none; }
        }

        /* ============ NAVIGATION ============ */
        /* Transparent Navbar Request */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            padding: 20px 0;
            transition: var(--transition-smooth);
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }
        .navbar.scrolled {
            padding: 15px 0;
        }
        .navbar .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 40px;
        }
        .nav-logo {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            text-decoration: none;
            z-index: 1001;
            background: rgba(255, 255, 255, 0.85); /* Highlight backdrop for logo */
            padding: 8px 16px;
            border-radius: 12px;
            backdrop-filter: blur(8px);
        }
        .nav-logo .logo-text {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            font-size: 1.8rem;
            letter-spacing: -0.5px;
            line-height: 1;
        }
        .nav-logo .logo-subtext {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 1.2px;
            color: var(--primary);
            margin-top: 4px;
        }
        .nav-links {
            display: flex;
            list-style: none;
            gap: 12px;
            align-items: center;
        }
        /* Highlight navigation bar text and links */
        .nav-links a {
            text-decoration: none;
            color: var(--primary);
            font-weight: 600;
            font-size: 0.95rem;
            padding: 10px 20px;
            border-radius: 50px;
            transition: var(--transition);
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.4);
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .nav-links a:hover {
            color: var(--white);
            background: var(--secondary);
            border-color: var(--secondary);
            transform: translateY(-2px);
        }
        .nav-cta {
            background: linear-gradient(135deg, var(--accent), var(--accent-hover)) !important;
            color: #fff !important;
            padding: 11px 26px !important;
            font-weight: 700 !important;
            box-shadow: 0 4px 15px rgba(122, 201, 67, 0.4) !important;
            border: none !important;
        }
        .nav-cta:hover {
            box-shadow: 0 8px 25px rgba(122, 201, 67, 0.6) !important;
            background: var(--primary) !important;
        }
        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            z-index: 1001;
            padding: 10px;
            background: rgba(255,255,255,0.9);
            border-radius: 8px;
        }
        .hamburger span {
            width: 28px;
            height: 2.5px;
            background: var(--primary);
            border-radius: 10px;
            transition: var(--transition);
        }
        .hamburger.active span:nth-child(1) { transform: rotate(45deg) translate(5px, 6px); }
        .hamburger.active span:nth-child(2) { opacity: 0; }
        .hamburger.active span:nth-child(3) { transform: rotate(-45deg) translate(5px, -6px); }

        @media (max-width: 1024px) {
            .nav-links {
                position: fixed;
                top: 0;
                right: -100%;
                width: 320px;
                height: 100vh;
                background: rgba(247, 249, 252, 0.98);
                backdrop-filter: blur(30px);
                flex-direction: column;
                justify-content: center;
                gap: 20px;
                transition: var(--transition-smooth);
                box-shadow: var(--shadow-xl);
                border-radius: 30px 0 0 30px;
            }
            .nav-links.active { right: 0; }
            .nav-links a {
                font-size: 1.15rem;
                padding: 12px 28px;
                background: var(--white);
                width: 80%;
                text-align: center;
            }
            .hamburger { display: flex; }
        }

        /* ============ HERO SECTION ============ */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, var(--off-white) 0%, #E8F0F8 100%);
            padding: 120px 0 80px;
        }
        .hero-bg-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.4;
            pointer-events: none;
        }
        .hero-bg-orb.orb-1 {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, var(--primary), transparent);
            top: -10%;
            right: -5%;
            animation: floatOrb 12s ease-in-out infinite;
        }
        .hero-bg-orb.orb-2 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, var(--secondary), transparent);
            bottom: -15%;
            left: -10%;
            animation: floatOrb 15s ease-in-out infinite reverse;
        }
        .hero-bg-orb.orb-3 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, var(--accent), transparent);
            top: 40%;
            left: 45%;
            animation: floatOrb 10s ease-in-out infinite;
        }
        @keyframes floatOrb {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(30px, -20px) scale(1.05); }
            50% { transform: translate(-15px, 25px) scale(0.95); }
            75% { transform: translate(-25px, -15px) scale(1.02); }
        }
        .hero .container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            position: relative;
            z-index: 2;
        }
        .hero-content { position: relative; }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(11, 79, 140, 0.15);
            padding: 8px 18px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 24px;
            box-shadow: var(--shadow-sm);
            animation: fadeInUp 0.8s ease forwards;
        }
        .hero-badge .badge-dot {
            width: 8px;
            height: 8px;
            background: var(--accent);
            border-radius: 50%;
            animation: pulseDot 2s ease-in-out infinite;
        }
        @keyframes pulseDot {
            0%, 100% { box-shadow: 0 0 0 0 rgba(122, 201, 67, 0.6); }
            50% { box-shadow: 0 0 0 10px rgba(122, 201, 67, 0); }
        }
        .hero h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: clamp(2.6rem, 5vw, 4.2rem);
            font-weight: 800;
            line-height: 1.15;
            color: var(--text);
            margin-bottom: 20px;
            letter-spacing: -1.5px;
            animation: fadeInUp 0.8s 0.1s ease forwards;
            opacity: 0;
        }
        .hero h1 span {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero p {
            font-size: 1.15rem;
            color: var(--text-light);
            margin-bottom: 36px;
            max-width: 500px;
            animation: fadeInUp 0.8s 0.2s ease forwards;
            opacity: 0;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .hero-buttons {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            animation: fadeInUp 0.8s 0.3s ease forwards;
            opacity: 0;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 32px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1rem;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: var(--transition-smooth);
            font-family: 'Inter', sans-serif;
        }
        .btn-primary {
            background: var(--primary);
            color: #fff;
            box-shadow: 0 8px 25px rgba(11, 79, 140, 0.35);
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            background: var(--primary-light);
            box-shadow: 0 12px 30px rgba(11, 79, 140, 0.45);
        }
        .btn-outline {
            background: var(--white);
            color: var(--primary);
            border: 2px solid rgba(11, 79, 140, 0.2);
        }
        .btn-outline:hover {
            background: rgba(11, 79, 140, 0.05);
            border-color: var(--primary);
        }
        .hero-visual {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            animation: fadeInUp 0.8s 0.2s ease forwards;
            opacity: 0;
        }
        #threejs-container {
            width: 100%;
            height: 500px;
            cursor: grab;
        }
        #threejs-container:active { cursor: grabbing; }
        
        .hero-stats-row {
            display: flex;
            gap: 40px;
            margin-top: 50px;
            animation: fadeInUp 0.8s 0.4s ease forwards;
            opacity: 0;
        }
        .hero-stat .stat-number {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--secondary);
            line-height: 1;
        }
        .hero-stat .stat-label {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-light);
            margin-top: 6px;
        }

        @media (max-width: 1024px) {
            .hero .container { grid-template-columns: 1fr; text-align: center; gap: 30px; }
            .hero p { max-width: 100%; }
            .hero-buttons, .hero-stats-row { justify-content: center; }
            #threejs-container { height: 350px; max-width: 400px; margin: 0 auto; }
        }

        /* ============ SECTION COMMONS ============ */
        section { padding: 100px 0; position: relative; }
        .section-container { max-width: 1300px; margin: 0 auto; padding: 0 40px; }
        .section-badge {
            display: inline-block;
            font-size: 0.85rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--secondary);
            margin-bottom: 12px;
        }
        .section-title {
            font-family: 'Montserrat', sans-serif;
            font-size: clamp(2rem, 3.5vw, 2.6rem);
            font-weight: 800;
            color: var(--text);
            margin-bottom: 18px;
            letter-spacing: -1px;
            line-height: 1.2;
        }
        .section-subtitle {
            color: var(--text-light);
            font-size: 1.05rem;
            max-width: 650px;
            margin-bottom: 50px;
        }
        .text-center { text-align: center; }
        .mx-auto { margin-left: auto; margin-right: auto; }

        /* ============ ABOUT SECTION ============ */
        .about-section { background: var(--white); }
        .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center; }
        .about-image-wrapper { position: relative; }
        .about-image {
            width: 100%;
            border-radius: var(--radius-lg);
            object-fit: cover;
            aspect-ratio: 4/5;
            box-shadow: var(--shadow-xl);
        }
        .about-image-float-card {
            position: absolute;
            bottom: -25px;
            right: -25px;
            background: #fff;
            border-radius: var(--radius);
            padding: 20px 28px;
            box-shadow: var(--shadow-lg);
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .about-image-float-card .float-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.3rem;
        }
        .about-features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-top: 30px;
        }
        .about-feature { display: flex; gap: 14px; align-items: flex-start; }
        .about-feature .feature-icon {
            flex-shrink: 0;
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: var(--off-white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: var(--secondary);
        }
        .about-feature h4 { font-weight: 700; font-size: 1rem; margin-bottom: 4px; }
        .about-feature p { font-size: 0.88rem; color: var(--text-light); }
        
        @media (max-width: 1024px) {
            .about-grid { grid-template-columns: 1fr; gap: 40px; }
            .about-image-wrapper { max-width: 450px; margin: 0 auto; }
        }

        /* ============ SERVICES SECTION ============ */
        .services-section { background: var(--off-white); }
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
        }
        .service-card {
            background: #fff;
            border-radius: var(--radius-lg);
            padding: 40px 30px;
            box-shadow: var(--shadow);
            transition: var(--transition-smooth);
            position: relative;
            overflow: hidden;
            border: 1px solid transparent;
            cursor: pointer;
        }
        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
            border-color: rgba(42, 161, 152, 0.2);
        }
        .service-card .service-icon {
            width: 70px;
            height: 70px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 24px;
            background: var(--off-white);
            color: var(--primary);
            transition: var(--transition);
        }
        .service-card:hover .service-icon {
            background: var(--secondary);
            color: #fff;
            transform: scale(1.1) rotate(5deg);
        }
        .service-card h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 12px;
        }
        .service-card p {
            color: var(--text-light);
            font-size: 0.95rem;
            margin-bottom: 20px;
        }
        .service-card .service-link {
            color: var(--secondary);
            font-weight: 700;
            text-decoration: none;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: var(--transition);
        }
        .service-card .service-link:hover { gap: 10px; color: var(--primary); }

        /* ============ DOCTORS SECTION ============ */
        .doctors-section { background: var(--white); }
        .doctors-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }
        .doctor-card {
            background: #fff;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition-smooth);
            text-align: center;
            border: 1px solid var(--off-white);
        }
        .doctor-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-xl); }
        .doctor-card img { width: 100%; height: 320px; object-fit: cover; object-position: top; }
        .doctor-card .doctor-info { padding: 25px 20px; }
        .doctor-card h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 4px;
        }
        .doctor-card .specialty {
            color: var(--secondary);
            font-weight: 700;
            font-size: 0.9rem;
            margin-bottom: 12px;
        }
        .doctor-card p { color: var(--text-light); font-size: 0.9rem; line-height: 1.5; }
        .doctor-socials { display: flex; gap: 10px; justify-content: center; margin-top: 16px; }
        .doctor-socials a {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--off-white);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            transition: var(--transition);
            text-decoration: none;
        }
        .doctor-socials a:hover { background: var(--primary); color: #fff; }

        /* ============ APPOINTMENT SECTION ============ */
        .appointment-section { background: var(--off-white); }
        .appointment-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 50px; align-items: start; }
        .appointment-form-wrapper {
            background: #fff;
            border-radius: var(--radius-xl);
            padding: 40px;
            box-shadow: var(--shadow-lg);
        }
        .appointment-form-wrapper h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.6rem;
            font-weight: 800;
            margin-bottom: 24px;
        }
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.9rem;
            color: var(--text);
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid var(--light-gray);
            border-radius: var(--radius-sm);
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            transition: var(--transition);
            background: var(--white);
        }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            outline: none;
            border-color: var(--secondary);
            box-shadow: 0 0 0 4px rgba(42, 161, 152, 0.15);
        }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .form-message {
            padding: 16px 20px;
            border-radius: var(--radius-sm);
            margin-bottom: 20px;
            font-weight: 600;
        }
        .form-message.success { background: #E7F6DF; color: #3A731F; border: 1px solid #7AC943; }
        
        .appointment-info-cards { display: flex; flex-direction: column; gap: 20px; }
        .info-card {
            display: flex;
            gap: 18px;
            align-items: flex-start;
            background: #fff;
            padding: 24px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            transition: var(--transition);
        }
        .info-card .info-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: var(--off-white);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.4rem;
            flex-shrink: 0;
        }
        .info-card h4 { font-weight: 700; margin-bottom: 6px; }
        .info-card p { color: var(--text-light); font-size: 0.9rem; line-height: 1.5; }

        @media (max-width: 1024px) { .appointment-grid { grid-template-columns: 1fr; } }
        
        /* ============ FOOTER ============ */
        footer {
            background: var(--primary-dark);
            color: #cbd5e1;
            padding: 80px 0 30px;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 40px;
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 40px;
        }
        .footer-logo {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            font-size: 1.8rem;
            color: #fff;
            margin-bottom: 15px;
        }
        .footer-logo span:nth-child(1) { color: #fff; }
        .footer-logo span:nth-child(2) { color: var(--secondary); }
        .footer-logo span:nth-child(3) { color: var(--accent); }
        
        .footer-col h4 {
            color: #fff;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 20px;
        }
        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 12px; }
        .footer-col ul li a {
            color: #94a3b8;
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.95rem;
        }
        .footer-col ul li a:hover { color: var(--secondary); padding-left: 5px; }
        .footer-bottom {
            max-width: 1300px;
            margin: 60px auto 0;
            padding: 24px 40px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            font-size: 0.85rem;
            color: #64748b;
        }
        @media (max-width: 768px) {
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }

        /* Back to top */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--primary);
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 1.2rem;
            z-index: 999;
            box-shadow: var(--shadow-lg);
            transition: var(--transition-smooth);
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .back-to-top.visible { opacity: 1; visibility: visible; transform: translateY(0); }
        .back-to-top:hover { background: var(--secondary); transform: translateY(-5px); }

    </style>
</head>
<body>

    <!-- Preloader -->
    <div id="preloader">
        <div class="loader-pulse"></div>
    </div>

    <!-- Custom Cursor -->
    <div class="custom-cursor" id="customCursor"></div>

    <!-- ============ NAVIGATION ============ -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <a href="#" class="nav-logo">
                <div class="logo-text">
                    <span style="color: var(--primary);">ORTHO</span><span style="color: var(--secondary); margin-left: 4px;">PLUS</span><span style="color: var(--accent);">+</span>
                </div>
                <div class="logo-subtext">MOVE BETTER. LIVE BETTER.</div>
            </a>
            <ul class="nav-links" id="navLinks">
                <li><a href="#home" onclick="closeMenu()">Home</a></li>
                <li><a href="#about" onclick="closeMenu()">About</a></li>
                <li><a href="#services" onclick="closeMenu()">Treatments</a></li>
                <li><a href="#doctors" onclick="closeMenu()">Specialists</a></li>
                <li><a href="#appointment" onclick="closeMenu()">Consultation</a></li>
                <li><a href="#appointment" class="nav-cta" onclick="closeMenu()">Book Now</a></li>
            </ul>
            <div class="hamburger" id="hamburger" onclick="toggleMenu()">
                <span></span><span></span><span></span>
            </div>
        </div>
    </nav>

    <!-- ============ HERO SECTION ============ -->
    <section class="hero" id="home">
        <div class="hero-bg-orb orb-1"></div>
        <div class="hero-bg-orb orb-2"></div>
        <div class="hero-bg-orb orb-3"></div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">
                    <span class="badge-dot"></span> Premier Orthopedic Center
                </div>
                <h1>Restoring <span>Mobility</span> & Improving Lives</h1>
                <p>Expert care in orthopedics, joint replacement, and sports medicine. Trust our specialists to help you move better and live a pain-free life.</p>
                <div class="hero-buttons">
                    <a href="#appointment" class="btn btn-primary"><i class="fa-solid fa-calendar-check"></i> Book Consultation</a>
                    <a href="#services" class="btn btn-outline"><i class="fa-solid fa-bone"></i> View Treatments</a>
                </div>
                <div class="hero-stats-row">
                    <div class="hero-stat">
                        <div class="stat-number">20+</div>
                        <div class="stat-label">Years of Expertise</div>
                    </div>
                    <div class="hero-stat">
                        <div class="stat-number">10K+</div>
                        <div class="stat-label">Successful Surgeries</div>
                    </div>
                    <div class="hero-stat">
                        <div class="stat-number">15+</div>
                        <div class="stat-label">Orthopedic Experts</div>
                    </div>
                </div>
            </div>
            <div class="hero-visual">
                <div id="threejs-container"></div>
            </div>
        </div>
    </section>

    <!-- ============ ABOUT SECTION ============ -->
    <section class="about-section" id="about">
        <div class="section-container">
            <div class="about-grid">
                <div class="about-image-wrapper" data-aos="fade-right" data-aos-duration="800">
                    <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?w=600&h=750&fit=crop" alt="Orthopedic Specialists" class="about-image" loading="lazy">
                    <div class="about-image-float-card">
                        <div class="float-icon"><i class="fa-solid fa-medal"></i></div>
                        <div>
                            <strong style="display:block;font-size:1rem;color:var(--primary);">Board Certified</strong>
                            <span style="font-size:0.85rem;color:var(--text-light);">Orthopedic Surgeons</span>
                        </div>
                    </div>
                </div>
                <div data-aos="fade-left" data-aos-duration="800">
                    <span class="section-badge">About Ortho Plus</span>
                    <h2 class="section-title">A Foundation Built on Trust & Expertise</h2>
                    <p class="section-subtitle">At Ortho Plus, we specialize exclusively in the diagnosis, treatment, and rehabilitation of bone, joint, and muscle conditions. Our mission is to restore your movement and eliminate pain using advanced medical techniques.</p>
                    <div class="about-features">
                        <div class="about-feature">
                            <div class="feature-icon"><i class="fa-solid fa-x-ray"></i></div>
                            <div><h4>Advanced Imaging</h4><p>On-site digital X-rays and MRI for accurate, fast diagnosis.</p></div>
                        </div>
                        <div class="about-feature">
                            <div class="feature-icon"><i class="fa-solid fa-user-nurse"></i></div>
                            <div><h4>Specialized Care</h4><p>Focused exclusively on musculoskeletal health and recovery.</p></div>
                        </div>
                        <div class="about-feature">
                            <div class="feature-icon"><i class="fa-solid fa-person-walking"></i></div>
                            <div><h4>Rehabilitation</h4><p>Comprehensive physical therapy programs for post-op recovery.</p></div>
                        </div>
                        <div class="about-feature">
                            <div class="feature-icon"><i class="fa-solid fa-scalpel-line-dashed"></i></div>
                            <div><h4>Minimally Invasive</h4><p>Modern surgical techniques for faster healing times.</p></div>
                        </div>
                    </div>
                    <a href="#appointment" class="btn btn-primary" style="margin-top:35px;"><i class="fa-solid fa-arrow-right"></i> Meet Our Surgeons</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ SERVICES SECTION ============ -->
    <section class="services-section" id="services">
        <div class="section-container">
            <div class="text-center" data-aos="fade-up">
                <span class="section-badge">Our Treatments</span>
                <h2 class="section-title">Comprehensive Orthopedic Care</h2>
                <p class="section-subtitle mx-auto">From conservative management to complex surgical interventions, we offer specialized treatments to keep you moving.</p>
            </div>
            <div class="services-grid">
                <div class="service-card" data-aos="zoom-in" data-aos-delay="100">
                    <div class="service-icon"><i class="fa-solid fa-bone"></i></div>
                    <h3>Joint Replacement</h3>
                    <p>Advanced hip, knee, and shoulder replacement surgeries utilizing minimally invasive techniques.</p>
                    <a href="#" class="service-link">Learn More <i class="fa-solid fa-arrow-right-long"></i></a>
                </div>
                <div class="service-card" data-aos="zoom-in" data-aos-delay="200">
                    <div class="service-icon"><i class="fa-solid fa-person-running"></i></div>
                    <h3>Sports Medicine</h3>
                    <p>Treatment of athletic injuries including ACL tears, meniscus injuries, and shoulder dislocations.</p>
                    <a href="#" class="service-link">Learn More <i class="fa-solid fa-arrow-right-long"></i></a>
                </div>
                <div class="service-card" data-aos="zoom-in" data-aos-delay="300">
                    <div class="service-icon"><i class="fa-solid fa-person-rays"></i></div>
                    <h3>Spine Care</h3>
                    <p>Comprehensive care for back and neck pain, herniated discs, and spinal deformities.</p>
                    <a href="#" class="service-link">Learn More <i class="fa-solid fa-arrow-right-long"></i></a>
                </div>
                <div class="service-card" data-aos="zoom-in" data-aos-delay="400">
                    <div class="service-icon"><i class="fa-solid fa-hand-dots"></i></div>
                    <h3>Hand & Upper Extremity</h3>
                    <p>Specialized treatment for carpal tunnel, trigger finger, and complex fractures of the arm and hand.</p>
                    <a href="#" class="service-link">Learn More <i class="fa-solid fa-arrow-right-long"></i></a>
                </div>
                <div class="service-card" data-aos="zoom-in" data-aos-delay="500">
                    <div class="service-icon"><i class="fa-solid fa-shoe-prints"></i></div>
                    <h3>Foot & Ankle Care</h3>
                    <p>Expert care for bunions, Achilles tendon injuries, plantar fasciitis, and ankle arthritis.</p>
                    <a href="#" class="service-link">Learn More <i class="fa-solid fa-arrow-right-long"></i></a>
                </div>
                <div class="service-card" data-aos="zoom-in" data-aos-delay="600">
                    <div class="service-icon"><i class="fa-solid fa-truck-medical"></i></div>
                    <h3>Orthopedic Trauma</h3>
                    <p>Urgent care for fractures, dislocations, and severe musculoskeletal injuries.</p>
                    <a href="#" class="service-link">Learn More <i class="fa-solid fa-arrow-right-long"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ DOCTORS SECTION ============ -->
    <section class="doctors-section" id="doctors">
        <div class="section-container">
            <div class="text-center" data-aos="fade-up">
                <span class="section-badge">Our Specialists</span>
                <h2 class="section-title">Meet Your Orthopedic Team</h2>
                <p class="section-subtitle mx-auto">Our highly trained surgeons and physicians are recognized leaders in the field of orthopedics and sports medicine.</p>
            </div>
            <div class="doctors-grid">
                <div class="doctor-card" data-aos="fade-up" data-aos-delay="100">
                    <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400&h=500&fit=crop" alt="Dr. Robert Hayes" loading="lazy">
                    <div class="doctor-info">
                        <h3>Dr. Robert Hayes</h3>
                        <p class="specialty">Joint Replacement Surgeon</p>
                        <p>Over 18 years of experience specializing in robotic-assisted hip and knee arthroplasty.</p>
                        <div class="doctor-socials">
                            <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                            <a href="#"><i class="fa-solid fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
                <div class="doctor-card" data-aos="fade-up" data-aos-delay="200">
                    <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=500&fit=crop" alt="Dr. Sarah Mitchell" loading="lazy">
                    <div class="doctor-info">
                        <h3>Dr. Elena Rostova</h3>
                        <p class="specialty">Sports Medicine Specialist</p>
                        <p>Former team physician for professional athletes. Expert in arthroscopic knee and shoulder repair.</p>
                        <div class="doctor-socials">
                            <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                            <a href="#"><i class="fa-solid fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
                <div class="doctor-card" data-aos="fade-up" data-aos-delay="300">
                    <img src="https://images.unsplash.com/photo-1594824476967-48c8b964273f?w=400&h=500&fit=crop" alt="Dr. Michael Chen" loading="lazy">
                    <div class="doctor-info">
                        <h3>Dr. David Lin</h3>
                        <p class="specialty">Spine Surgeon</p>
                        <p>Specializes in minimally invasive spinal surgery and non-operative management of back pain.</p>
                        <div class="doctor-socials">
                            <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                            <a href="#"><i class="fa-solid fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ APPOINTMENT SECTION ============ -->
    <section class="appointment-section" id="appointment">
        <div class="section-container">
            <div class="text-center" data-aos="fade-up">
                <span class="section-badge">Consultation</span>
                <h2 class="section-title">Schedule Your Visit</h2>
                <p class="section-subtitle mx-auto">Take the first step toward living pain-free. Book an appointment with our orthopedic experts.</p>
            </div>
            <div class="appointment-grid">
                <div class="appointment-form-wrapper" data-aos="fade-right" data-aos-duration="800">
                    <h3 style="color:var(--primary);"><i class="fa-solid fa-calendar-check" style="color:var(--secondary);margin-right:8px;"></i> Request an Appointment</h3>
                    <?php if ($formMessage && isset($_POST['appointment_submit'])): ?>
                        <div class="form-message <?php echo $formType; ?>"><?php echo $formMessage; ?></div>
                    <?php endif; ?>
                    <form method="POST" action="#appointment">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Full Name *</label>
                                <input type="text" id="name" name="name" placeholder="John Doe" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address *</label>
                                <input type="email" id="email" name="email" placeholder="john@example.com" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">Phone Number *</label>
                                <input type="tel" id="phone" name="phone" placeholder="(555) 123-4567" required>
                            </div>
                            <div class="form-group">
                                <label for="date">Preferred Date *</label>
                                <input type="date" id="date" name="date" required min="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="department">Specialty / Concern *</label>
                            <select id="department" name="department" required>
                                <option value="">Select Concern</option>
                                <option value="Joint Replacement">Joint Replacement</option>
                                <option value="Sports Injury">Sports Injury</option>
                                <option value="Back/Spine Pain">Back / Spine Pain</option>
                                <option value="Hand/Wrist Issue">Hand / Wrist Issue</option>
                                <option value="Foot/Ankle Issue">Foot / Ankle Issue</option>
                                <option value="General Orthopedics">General Orthopedic Consultation</option>
                                <option value="Physical Therapy">Physical Therapy</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message">Describe Your Symptoms</label>
                            <textarea id="message" name="message" rows="3" placeholder="Where is the pain? How long have you experienced it?"></textarea>
                        </div>
                        <button type="submit" name="appointment_submit" class="btn btn-primary" style="width:100%;justify-content:center;">
                            Confirm Request
                        </button>
                    </form>
                </div>
                <div class="appointment-info-cards" data-aos="fade-left" data-aos-duration="800">
                    <div class="info-card">
                        <div class="info-icon"><i class="fa-solid fa-clock"></i></div>
                        <div>
                            <h4>Clinic Hours</h4>
                            <p>Mon–Fri: 8:00 AM – 6:00 PM<br>Sat: 9:00 AM – 1:00 PM<br>Sun: Closed (On-call only)</p>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-icon"><i class="fa-solid fa-phone-volume"></i></div>
                        <div>
                            <h4>Direct Contact</h4>
                            <p>Appointments: +1 (555) 222-1000<br>Urgent Care: +1 (555) 222-1011</p>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-icon"><i class="fa-solid fa-file-medical"></i></div>
                        <div>
                            <h4>What to Bring</h4>
                            <p>Please bring your ID, insurance card, and any previous X-rays or MRI reports related to your injury.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ FOOTER ============ -->
    <footer>
        <div class="footer-grid">
            <div class="footer-col">
                <div class="footer-logo">
                    <span>ORTHO</span><span>PLUS</span><span>+</span>
                </div>
                <p style="line-height:1.7;font-size:0.95rem;">Trust. Expertise. Confidence. We are dedicated to providing the highest quality orthopedic care to restore your mobility and get you back to the life you love.</p>
            </div>
            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About Our Clinic</a></li>
                    <li><a href="#services">Treatments</a></li>
                    <li><a href="#doctors">Our Surgeons</a></li>
                    <li><a href="#appointment">Book Consultation</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Specialties</h4>
                <ul>
                    <li><a href="#">Joint Replacement</a></li>
                    <li><a href="#">Sports Medicine</a></li>
                    <li><a href="#">Spine Care</a></li>
                    <li><a href="#">Hand & Wrist</a></li>
                    <li><a href="#">Foot & Ankle</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Contact Us</h4>
                <ul style="color: #94a3b8; font-size: 0.95rem;">
                    <li style="display:flex;gap:10px;"><i class="fa-solid fa-location-dot" style="margin-top:4px;color:var(--secondary);"></i> 100 Ortho Way, Medical District, NY 10001</li>
                    <li style="display:flex;gap:10px;"><i class="fa-solid fa-phone" style="margin-top:4px;color:var(--secondary);"></i> +1 (555) 222-1000</li>
                    <li style="display:flex;gap:10px;"><i class="fa-solid fa-envelope" style="margin-top:4px;color:var(--secondary);"></i> care@orthoplus.com</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Ortho Plus Orthopedic Center. All rights reserved.</p>
        </div>
    </footer>

    <!-- Back to Top -->
    <button class="back-to-top" id="backToTop" aria-label="Back to top"><i class="fa-solid fa-arrow-up"></i></button>

    <!-- ============ SCRIPTS ============ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

    <script>
        // ============ AOS INIT ============
        AOS.init({ once: true, offset: 80, duration: 700, easing: 'ease-out-cubic' });

        // ============ PRELOADER ============
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.getElementById('preloader').classList.add('hidden');
            }, 600);
        });

        // ============ CUSTOM CURSOR ============
        const cursor = document.getElementById('customCursor');
        document.addEventListener('mousemove', (e) => {
            cursor.style.left = e.clientX + 'px';
            cursor.style.top = e.clientY + 'px';
        });
        document.querySelectorAll('a, button, .btn, .service-card, .doctor-card, input, select, textarea').forEach(el => {
            el.addEventListener('mouseenter', () => cursor.classList.add('hover'));
            el.addEventListener('mouseleave', () => cursor.classList.remove('hover'));
        });

        // ============ NAVBAR SCROLL ============
        const navbar = document.getElementById('navbar');
        const backToTop = document.getElementById('backToTop');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 60) {
                navbar.classList.add('scrolled');
                backToTop.classList.add('visible');
            } else {
                navbar.classList.remove('scrolled');
                backToTop.classList.remove('visible');
            }
        });
        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // ============ MOBILE MENU ============
        const hamburger = document.getElementById('hamburger');
        const navLinks = document.getElementById('navLinks');

        function toggleMenu() {
            hamburger.classList.toggle('active');
            navLinks.classList.toggle('active');
        }

        function closeMenu() {
            hamburger.classList.remove('active');
            navLinks.classList.remove('active');
        }

        // ============ THREE.JS 3D ELEMENT ============
        // Updated colors to match Ortho Plus branding: Blue, Teal, Green
        (function() {
            const container = document.getElementById('threejs-container');
            if (!container) return;

            const scene = new THREE.Scene();
            const camera = new THREE.PerspectiveCamera(50, container.clientWidth / container.clientHeight, 0.1, 100);
            camera.position.z = 7;

            const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
            renderer.setSize(container.clientWidth, container.clientHeight);
            renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
            renderer.shadowMap.enabled = true;
            renderer.shadowMap.type = THREE.PCFSoftShadowMap;
            renderer.setClearColor(0x000000, 0);
            container.appendChild(renderer.domElement);

            // Lighting (Adjusted for new brand colors)
            const ambientLight = new THREE.AmbientLight(0xffffff, 0.7);
            scene.add(ambientLight);
            const keyLight = new THREE.DirectionalLight(0xffffff, 1.2);
            keyLight.position.set(5, 8, 5);
            keyLight.castShadow = true;
            scene.add(keyLight);
            
            // Teal Fill Light
            const fillLight = new THREE.DirectionalLight(0x2AA198, 0.6);
            fillLight.position.set(-3, 1, -3);
            scene.add(fillLight);

            const mainGroup = new THREE.Group();
            scene.add(mainGroup);

            // Abstract Medical Cross / Bone Structure
            const crossGroup = new THREE.Group();

            // Vertical bar (Deep Royal Blue)
            const vertBar = new THREE.Mesh(
                new THREE.BoxGeometry(0.4, 2.2, 0.4),
                new THREE.MeshStandardMaterial({ color: 0x0B4F8C, roughness: 0.2, metalness: 0.7 })
            );
            vertBar.castShadow = true;
            crossGroup.add(vertBar);

            // Horizontal bar (Deep Royal Blue)
            const horizBar = new THREE.Mesh(
                new THREE.BoxGeometry(1.6, 0.4, 0.4),
                new THREE.MeshStandardMaterial({ color: 0x0B4F8C, roughness: 0.2, metalness: 0.7 })
            );
            horizBar.position.y = 0.4;
            horizBar.castShadow = true;
            crossGroup.add(horizBar);

            // Joints / Caps (Healing Teal)
            function addSphere(x, y, z, r, color) {
                const sphere = new THREE.Mesh(
                    new THREE.SphereGeometry(r, 32, 32),
                    new THREE.MeshStandardMaterial({ color, roughness: 0.15, metalness: 0.8 })
                );
                sphere.position.set(x, y, z);
                sphere.castShadow = true;
                crossGroup.add(sphere);
            }
            addSphere(0, 1.2, 0, 0.25, 0x2AA198);
            addSphere(0, -1.2, 0, 0.25, 0x2AA198);
            addSphere(0.9, 0.4, 0, 0.25, 0x2AA198);
            addSphere(-0.9, 0.4, 0, 0.25, 0x2AA198);
            
            // Center (Vibrant Lime Green)
            addSphere(0, 0.4, 0, 0.32, 0x7AC943);

            mainGroup.add(crossGroup);

            // Orbiting ring 1 (Teal)
            const ring1Geo = new THREE.TorusGeometry(1.8, 0.04, 16, 100);
            const ring1Mat = new THREE.MeshStandardMaterial({ color: 0x2AA198, roughness: 0.3, metalness: 0.9, emissive: 0x2AA198, emissiveIntensity: 0.5 });
            const ring1 = new THREE.Mesh(ring1Geo, ring1Mat);
            ring1.rotation.x = Math.PI / 2.5;
            mainGroup.add(ring1);

            // Orbiting ring 2 (Green)
            const ring2Geo = new THREE.TorusGeometry(2.1, 0.03, 16, 100);
            const ring2Mat = new THREE.MeshStandardMaterial({ color: 0x7AC943, roughness: 0.3, metalness: 0.9, emissive: 0x7AC943, emissiveIntensity: 0.4 });
            const ring2 = new THREE.Mesh(ring2Geo, ring2Mat);
            ring2.rotation.x = -Math.PI / 3;
            mainGroup.add(ring2);

            // Particles (Blue)
            const particlesGeo = new THREE.BufferGeometry();
            const particlesPositions = new Float32Array(150 * 3);
            for (let i = 0; i < 150; i++) {
                const theta = Math.random() * Math.PI * 2;
                const phi = Math.random() * Math.PI;
                const radius = 2.4 + Math.random() * 1.5;
                particlesPositions[i * 3] = radius * Math.sin(phi) * Math.cos(theta);
                particlesPositions[i * 3 + 1] = radius * Math.sin(phi) * Math.sin(theta);
                particlesPositions[i * 3 + 2] = radius * Math.cos(phi);
            }
            particlesGeo.setAttribute('position', new THREE.BufferAttribute(particlesPositions, 3));
            const particlesMat = new THREE.PointsMaterial({ size: 0.04, color: 0x0B4F8C, transparent: true, opacity: 0.6 });
            const particles = new THREE.Points(particlesGeo, particlesMat);
            mainGroup.add(particles);

            // Animation
            let mouseX = 0, mouseY = 0;
            document.addEventListener('mousemove', (e) => {
                mouseX = (e.clientX / window.innerWidth) * 2 - 1;
                mouseY = -(e.clientY / window.innerHeight) * 2 + 1;
            });

            function animate() {
                requestAnimationFrame(animate);
                mainGroup.rotation.y += 0.003;
                mainGroup.rotation.x += (mouseY * 0.3 - mainGroup.rotation.x) * 0.03;
                mainGroup.rotation.y += (mouseX * 0.5 - mainGroup.rotation.y) * 0.03;

                ring1.rotation.z += 0.008;
                ring2.rotation.z -= 0.006;
                particles.rotation.y -= 0.002;

                renderer.render(scene, camera);
            }
            animate();

            window.addEventListener('resize', () => {
                if (container.clientWidth > 0) {
                    camera.aspect = container.clientWidth / container.clientHeight;
                    camera.updateProjectionMatrix();
                    renderer.setSize(container.clientWidth, container.clientHeight);
                }
            });
        })();
    </script>
</body>
</html>