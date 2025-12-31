<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NextGen Home | Professional Edition</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&family=Poppins:wght@600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1abc9c;
            --primary-hover: #16a085;
            --glass-bg: rgba(255, 255, 255, 0.1);
            --text-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body, html {
            height: 100%;
            width: 100%;
            font-family: 'Inter', sans-serif;
            color: #fff;
            overflow: hidden;
        }

        /* Background Video & Overlay */
        .video-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.8));
            z-index: -1;
        }

        /* Header */
        header {
            position: fixed;
            top: 0;
            width: 100%;
            padding: 25px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 10;
        }

        header h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .nav-links a {
            text-decoration: none;
            color: #fff;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 600;
            background-color: var(--primary-color);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(26, 188, 156, 0.3);
        }

        .nav-links a:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(26, 188, 156, 0.4);
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 0 20px;
        }

        .hero h2 {
            font-family: 'Poppins', sans-serif;
            font-size: clamp(40px, 8vw, 72px);
            margin-bottom: 15px;
            line-height: 1.1;
            text-shadow: var(--text-shadow);
            animation: fadeInUp 1s ease forwards;
        }

        .hero p {
            font-size: clamp(16px, 2vw, 20px);
            max-width: 700px;
            line-height: 1.6;
            margin-bottom: 30px;
            opacity: 0.9;
            text-shadow: var(--text-shadow);
            animation: fadeInUp 1.2s ease forwards;
        }

        /* Call to Action Button */
        .cta-btn {
            padding: 15px 45px;
            border: 2px solid #fff;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            text-transform: uppercase;
            letter-spacing: 2px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            transition: 0.3s;
            animation: fadeInUp 1.4s ease forwards;
        }

        .cta-btn:hover {
            background: #fff;
            color: #000;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            header { padding: 20px 30px; }
            header h1 { font-size: 20px; }
        }
    </style>
</head>
<body>

    <video autoplay muted loop playsinline class="video-bg">
        <source src="notice.mp4" type="video/mp4">
    </video>

    <div class="overlay"></div>

    <header>
       
    <h1> CODE  <span style="color: var(--primary-color);"> BLOCK </span></h1>
        <div class="nav-links">
           <a href="shreg.php">Sign In</a> 
        </div>
    </header>

    <div class="hero">
       <b> <h1>EMPOWER YOUR<br>LEARNING JOURNEY</h1>
<p>Unlock your potential with expert-led courses and hands-on training. Build the skills that drive success in today's competitive world.</p> <b>

        <a href="#explore" class="cta-btn">Get Started</a>
    </div>

</body>
</html>
