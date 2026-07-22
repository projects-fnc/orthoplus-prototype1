<?php
// ============================================================
// PHP Form Handling for Appointment & Contact
// ============================================================
$formMessage = '';
$formType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['appointment_submit'])) {
        $name = htmlspecialchars($_POST['name'] ?? '');
        $phone = htmlspecialchars($_POST['phone'] ?? '');
        $date = htmlspecialchars($_POST['date'] ?? '');
        $department = htmlspecialchars($_POST['department'] ?? '');
        
        // Simulate successful booking
        $formMessage = "Thank you, $name! Your request for $department on $date has been received.";
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
    <title>Ortho Plus | Move Better. Live Better.</title>

    <!-- Google Fonts (Poppins and Montserrat) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            /* Ortho Plus Brand Colors */
            --primary: #0B4F8C; /* Deep Royal Blue */
            --primary-light: #1668B3; 
            --secondary: #2AA198; /* Healing Teal */
            --accent: #7AC943; /* Vibrant Lime Green */
            
            --white: #ffffff;
            --off-white: #F7F9FC;
            --light-gray: #E2E8F0;
            
            --text: #1E293B;
            --text-light: #64748B;
            
            --spacing-sm: 16px;
            --spacing-md: 32px;
            --spacing-lg: 60px;
            --spacing-xl: 100px;
            
            --transition: 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text);
            background: var(--white);
            line-height: 1.7;
            overflow-x: hidden;
        }

        a { text-decoration: none; }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .text-center { text-align: center; }
        .text-left { text-align: left; }

        /* ============ BUTTONS ============ */
        .btn {
            display: inline-block;
            padding: 12px 28px;
            background: var(--primary);
            color: var(--white);
            font-weight: 600;
            border-radius: 50px;
            transition: var(--transition);
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background: var(--secondary);
            color: var(--white);
        }
        .btn-outline {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
        }
        .btn-outline:hover {
            background: var(--primary);
            color: var(--white);
        }

        /* ============ HEADER ============ */
        header {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 15px 0;
        }
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo-text {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            font-size: 1.8rem;
            line-height: 1;
        }
        .logo-subtext {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 1.2px;
            color: var(--primary);
            margin-top: 4px;
        }
        nav ul {
            display: flex;
            list-style: none;
            gap: 20px;
            align-items: center;
        }
        nav a {
            color: var(--text);
            font-weight: 500;
            font-size: 0.95rem;
            transition: var(--transition);
        }
        nav a:hover, nav a.active {
            color: var(--secondary);
        }
        .btn-whatsapp {
            background: var(--accent);
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
        }
        .btn-whatsapp:hover {
            background: #66B035;
        }

        /* ============ HERO SECTION ============ */
        .hero {
            padding-top: 100px;
            min-height: 90vh;
            display: flex;
            align-items: center;
            /* Full background banner, text on left, image visible only on the right */
            background: linear-gradient(to right, 
                rgba(247, 249, 252, 1) 0%, 
                rgba(247, 249, 252, 0.95) 45%, 
                rgba(247, 249, 252, 0) 100%), 
                url('https://images.unsplash.com/photo-1579684385127-1ef15d508118?w=1600&q=80') center right/cover no-repeat;
            position: relative;
        }
        .hero .container {
            width: 100%;
        }
        .hero-content-inner {
            max-width: 600px;
        }
        .hero h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 20px;
            line-height: 1.2;
        }
        .hero p {
            font-size: 1.1rem;
            color: var(--text-light);
            margin-bottom: 30px;
        }
        .hero-content-btns {
            display: flex;
            gap: 15px;
        }

        @media (max-width: 768px) {
            .hero {
                background: linear-gradient(to right, 
                rgba(247, 249, 252, 0.95) 0%, 
                rgba(247, 249, 252, 0.95) 100%), 
                url('https://images.unsplash.com/photo-1579684385127-1ef15d508118?w=1600&q=80') center/cover no-repeat;
                text-align: center;
            }
            .hero-content-inner { margin: 0 auto; }
            .hero-content-btns { justify-content: center; }
            .hero h1 { font-size: 2.5rem; }
        }

        /* ============ SECTION STYLES ============ */
        .section {
            padding: var(--spacing-xl) 0;
        }
        .section-header {
            margin-bottom: var(--spacing-lg);
        }
        .section-header h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 15px;
        }

        /* ============ ABOUT SECTION ============ */
        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
        }
        .about-features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 30px;
        }
        .about-feature {
            background: var(--off-white);
            padding: 20px;
            border-radius: 12px;
            border: 1px solid var(--light-gray);
            transition: var(--transition);
        }
        .about-feature:hover {
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border-color: var(--secondary);
        }
        .about-feature h4 {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 1rem;
        }
        .about-feature p {
            font-size: 0.85rem;
            color: var(--text-light);
            margin: 0;
        }
        .about-image img {
            width: 100%;
            border-radius: 16px;
            object-fit: cover;
        }
        @media (max-width: 768px) {
            .about-content { grid-template-columns: 1fr; }
        }

        /* ============ GRID LAYOUTS (SERVICES & DOCTORS) ============ */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        .service-card {
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid var(--light-gray);
            transition: var(--transition);
        }
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(11, 79, 140, 0.1);
        }
        .service-img img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }
        .service-content {
            padding: 25px;
            text-align: center;
        }
        .service-content h3 {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 1.2rem;
        }
        .service-content p {
            color: var(--text-light);
            font-size: 0.95rem;
        }

        /* ============ BOOKING SECTION ============ */
        .contact-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            background: var(--off-white);
            padding: 40px;
            border-radius: 16px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            font-family: inherit;
        }
        .form-message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            background: #E7F6DF;
            color: #3A731F;
            border: 1px solid var(--accent);
        }
        @media (max-width: 768px) {
            .contact-container { grid-template-columns: 1fr; }
        }

        /* ============ FOOTER ============ */
        footer {
            background: var(--primary);
            color: var(--white);
            padding: 60px 0 20px;
        }
        .footer-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }
        .footer-about .logo-text {
            color: var(--white);
            margin-bottom: 15px;
        }
        .footer-about p {
            color: #cbd5e1;
            font-size: 0.9rem;
        }
        .footer-links h3 {
            margin-bottom: 20px;
            font-size: 1.2rem;
        }
        .footer-links ul {
            list-style: none;
        }
        .footer-links ul li {
            margin-bottom: 10px;
        }
        .footer-links ul li a, .footer-links ul li {
            color: #cbd5e1;
            transition: var(--transition);
        }
        .footer-links ul li a:hover {
            color: var(--accent);
        }
        .copyright {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: #cbd5e1;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    
    <!-- Preloader -->
    <div id="preloader" style="position: fixed; inset: 0; background: #F7F9FC; z-index: 99999; display: flex; align-items: center; justify-content: center; transition: opacity 0.5s;">
        <div style="width: 50px; height: 50px; border: 4px solid var(--secondary); border-top-color: transparent; border-radius: 50%; animation: spin 1s linear infinite;"></div>
    </div>
    <script>
        window.addEventListener('load', () => {
            document.getElementById('preloader').style.opacity = '0';
            setTimeout(() => document.getElementById('preloader').style.display = 'none', 500);
        });
    </script>
    <style>@keyframes spin { 100% { transform: rotate(360deg); } }</style>

    <!-- Header & Navigation -->
    <header id="header">
        <div class="container header-container">
            <a href="#" class="logo">
                <div class="logo-text">
                    <span style="color: var(--primary);">ORTHO</span><span style="color: var(--secondary);">PLUS</span><span style="color: var(--accent);">+</span>
                </div>
                <div class="logo-subtext">MOVE BETTER. LIVE BETTER.</div>
            </a>
            
            <nav id="main-nav">
                <ul>
                    <li><a href="#home" class="active">Home</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#services">Treatments</a></li>
                    <li><a href="#doctors">Specialists</a></li>
                    <li><a href="#booking" class="btn btn-whatsapp"><i class="bi bi-calendar-check"></i> Book Now</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <div class="hero-content-inner">
                <h1>Restoring Mobility & Improving Lives</h1>
                <p>Expert care in orthopedics, joint replacement, and sports medicine. Trust our specialists to help you move better and live a pain-free life.</p>
                <div class="hero-content-btns">
                    <a href="#booking" class="btn">Book Consultation</a>
                    <a href="#services" class="btn btn-outline">Our Treatments</a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section about">
        <div class="container">
            <div class="section-header text-center">
                <h2>About Ortho Plus</h2>
                <p>A Foundation Built on Trust & Expertise</p>
            </div>
            
            <div class="about-content">
                <div>
                    <p>At Ortho Plus, we specialize exclusively in the diagnosis, treatment, and rehabilitation of bone, joint, and muscle conditions. Our mission is to restore your movement and eliminate pain using advanced medical techniques.</p>
                    
                    <div class="about-features">
                        <div class="about-feature">
                            <h4>Advanced Imaging</h4>
                            <p>On-site digital X-rays and MRI for accurate, fast diagnosis.</p>
                        </div>
                        <div class="about-feature">
                            <h4>Specialized Care</h4>
                            <p>Focused exclusively on musculoskeletal health and recovery.</p>
                        </div>
                        <div class="about-feature">
                            <h4>Rehabilitation</h4>
                            <p>Comprehensive physical therapy programs for post-op recovery.</p>
                        </div>
                        <div class="about-feature">
                            <h4>Minimally Invasive</h4>
                            <p>Modern surgical techniques for faster healing times.</p>
                        </div>
                    </div>
                </div>
                
                <div class="about-image">
                    <!-- Removed Board Certified overlay per instructions -->
                    <img src="https://images.unsplash.com/photo-1581056771107-24ca5f033842?w=800&q=80" alt="Orthopedic Clinic Facility">
                </div>
            </div>
        </div>
    </section>

    <!-- Our Treatments Section -->
    <section id="services" class="section services">
        <div class="container">
            <div class="section-header text-center">
                <h2>Our Treatments</h2>
                <p>Comprehensive care to keep you moving.</p>
            </div>
            
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-img">
                        <img src="https://images.unsplash.com/photo-1579684453377-48ec05c6b30a?w=600&q=80" alt="Joint Replacement">
                    </div>
                    <div class="service-content">
                        <h3>Joint Replacement</h3>
                        <p>Advanced hip, knee, and shoulder replacement surgeries.</p>
                    </div>
                </div>
                
                <div class="service-card">
                    <div class="service-img">
                        <img src="https://images.unsplash.com/photo-1574680096145-d05b474e2155?w=600&q=80" alt="Sports Medicine">
                    </div>
                    <div class="service-content">
                        <h3>Sports Medicine</h3>
                        <p>Treatment of athletic injuries including ACL and meniscus repairs.</p>
                    </div>
                </div>
                
                <div class="service-card">
                    <div class="service-img">
                        <img src="https://images.unsplash.com/photo-1584515933487-779824d29309?w=600&q=80" alt="Spine Care">
                    </div>
                    <div class="service-content">
                        <h3>Spine Care</h3>
                        <p>Comprehensive care for back and neck pain and herniated discs.</p>
                    </div>
                </div>
            </div>
            
            <div class="text-center" style="margin-top: 40px;">
                <a href="treatments.html" class="btn btn-outline">View All Treatments</a>
            </div>
        </div>
    </section>

    <!-- Meet Our Specialists Section -->
    <section id="doctors" class="section services">
        <div class="container">
            <div class="section-header text-center">
                <h2>Meet Our Specialists</h2>
                <p>Our experts are recognized leaders in orthopedics.</p>
            </div>

            <div class="services-grid">
                <!-- Doctor 1 -->
                <div class="service-card">
                    <div class="service-img">
                        <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400&h=500&fit=crop" alt="Dr. Robert Hayes">
                    </div>
                    <div class="service-content">
                        <h3>Dr. Robert Hayes</h3>
                        <p style="color: var(--secondary); font-weight: 600; margin-bottom: 5px;">Joint Replacement</p>
                        <p>Board-certified orthopedic surgeon specializing in arthroplasty.</p>
                    </div>
                </div>

                <!-- Doctor 2 -->
                <div class="service-card">
                    <div class="service-img">
                        <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=500&fit=crop" alt="Dr. Elena Rostova">
                    </div>
                    <div class="service-content">
                        <h3>Dr. Elena Rostova</h3>
                        <p style="color: var(--secondary); font-weight: 600; margin-bottom: 5px;">Sports Medicine</p>
                        <p>Expert in arthroscopic knee and shoulder repair.</p>
                    </div>
                </div>

                <!-- Doctor 3 -->
                <div class="service-card">
                    <div class="service-img">
                        <img src="https://images.unsplash.com/photo-1594824476967-48c8b964273f?w=400&h=500&fit=crop" alt="Dr. David Lin">
                    </div>
                    <div class="service-content">
                        <h3>Dr. David Lin</h3>
                        <p style="color: var(--secondary); font-weight: 600; margin-bottom: 5px;">Spine Surgeon</p>
                        <p>Specializes in minimally invasive spinal surgery.</p>
                    </div>
                </div>
            </div>
            
            <div class="text-center" style="margin-top: 40px;">
                <a href="specialists.html" class="btn btn-outline">See All Specialists</a>
            </div>
        </div>
    </section>

    <!-- Booking Page -->
    <section id="booking" class="section">
        <div class="container">
            <div class="section-header text-center">
                <h2>Book Now</h2>
                <p>Take the first step toward living pain-free.</p>
            </div>
            
            <div class="contact-container">
                <div class="contact-info">
                    <h3>Fast & Easy Scheduling</h3>
                    <p style="margin-bottom: 20px; color: var(--text-light);">Send us your details and our team will contact you to confirm a time that works best for you.</p>
                    
                    <ul style="list-style: none;">
                        <li style="margin-bottom: 15px;"><i class="bi bi-geo-alt" style="color: var(--secondary); margin-right: 10px;"></i> 100 Ortho Way, Medical District, NY</li>
                        <li style="margin-bottom: 15px;"><i class="bi bi-telephone" style="color: var(--secondary); margin-right: 10px;"></i> +1 (555) 222-1000</li>
                        <li style="margin-bottom: 15px;"><i class="bi bi-envelope" style="color: var(--secondary); margin-right: 10px;"></i> appointments@orthoplus.com</li>
                    </ul>
                </div>
                    
                <div class="contact-form">
                    <?php if ($formMessage && isset($_POST['appointment_submit'])): ?>
                        <div class="form-message"><?php echo $formMessage; ?></div>
                    <?php endif; ?>
                    <form method="POST" action="#booking">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="department">Specialty / Concern</label>
                            <select id="department" name="department" class="form-control" required>
                                <option value="">Select Concern</option>
                                <option value="Joint Replacement">Joint Replacement</option>
                                <option value="Sports Injury">Sports Injury</option>
                                <option value="Spine Care">Spine Care</option>
                                <option value="General">General Orthopedics</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date">Preferred Date</label>
                            <input type="date" id="date" name="date" class="form-control" required min="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <button type="submit" name="appointment_submit" class="btn" style="width: 100%;">Confirm Request</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-container">
                <div class="footer-about">
                    <div class="logo-text">ORTHO<span style="color:var(--secondary);">PLUS</span><span style="color:var(--accent);">+</span></div>
                    <p>Trust. Expertise. Confidence. We are dedicated to providing the highest quality orthopedic care to restore your mobility.</p>
                </div>
                
                <div class="footer-links">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#services">Treatments</a></li>
                        <li><a href="#doctors">Specialists</a></li>
                    </ul>
                </div>
                
                <div class="footer-links">
                    <h3>Treatments</h3>
                    <ul>
                        <li><a href="#">Joint Replacement</a></li>
                        <li><a href="#">Sports Medicine</a></li>
                        <li><a href="#">Spine Care</a></li>
                        <li><a href="#">Physical Therapy</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; <?php echo date('Y'); ?> Ortho Plus Orthopedic Center. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>
