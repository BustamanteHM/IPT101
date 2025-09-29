<?php


// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db.php';
$messages = include 'en.php';
require 'EmailController.php';

// Check DB connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$emailController = new EmailController($conn, $messages);

$errors = [];
$old = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    error_log("Form submitted: " . print_r($_POST, true)); // Debug line
    $old = $_POST;
    $errors = $emailController->validate($_POST);

    if (empty($errors)) {
        if ($emailController->saveMessage($_POST)) {
            echo "<script>alert('Message sent successfully!');</script>";
            $old = []; // clear form
        } else {
            echo "<script>alert('Failed to send message.');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Portfolio</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <link rel="stylesheet" href="css/body.css">
  <link rel="stylesheet" href="css/cardgrid.css">
  <link rel="stylesheet" href="css/contactform.css">
  <link rel="stylesheet" href="css/container.css">
  <link rel="stylesheet" href="css/hamburger.css">
  <link rel="stylesheet" href="css/hero_section.css">
  <link rel="stylesheet" href="css/mobile_design.css">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/section.css">
  <link rel="stylesheet" href="css/skillsection.css">
  <link rel="stylesheet" href="css/theme.css">
  <link rel="stylesheet" href="css/footer.css">
</head>
<body>
  <!-- Navigation Bar -->
  <nav class="navbar">
    <div class="container">
      <div class="nav-left">
        <ul class="nav-links">
          <li><a href="#hero">Home</a></li>
          <li><a href="#skills">Skills</a></li>
          <li><a href="#education">Education</a></li>
          <li><a href="#projects">Projects</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </div>

      <div class="nav-right">
        <select id="languageSelector" class="language-selector">
          <option value="en">🇬🇧 English</option>
          <option value="fil">🇵🇭 Filipino</option>
        </select>
        <button id="themeToggle" class="theme-toggle" aria-label="Toggle theme">
          <span class="theme-icon">themetoggle</span>
        </button>
      </div>

      <div class="hamburger">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </nav>

  <!-- HERO Section -->
  <section id="hero" class="hero">
    <div class="container">
      <div class="hero-content">
        <div class="hero-text">
          <h1 id="greetingText">Hello, I'm Harold Mark</h1>
          <p id="heroDescription">I'm a passionate web developer creating impactful digital solutions.</p>
        </div>
        <div class="hero-image">
          <img src="image/112.jpg" alt="Your Profile">
        </div>
      </div>
    </div>
  </section>

  <!-- Skills Section -->
  <section id="skills">
    <div class="container">
      <h2 id="skillsTitle">Skills</h2>
      <div class="skills">
        <div class="card">HTML & CSS</div>
        <div class="card">JavaScript (Basic)</div>
        <div class="card">VB.NET</div>
        <div class="card">WordPress</div>
      </div>
    </div>
  </section>

  <!-- Educational Background -->
  <section id="education">
    <div class="container">
      <h2 id="educationTitle">Educational Background</h2>
      <div class="education">
        <div class="card">
          <h3>Bachelor of Science in Information Technology</h3>
          <p>SOCOTECH 2024-2025</p>
        </div>
        <div class="card">
          <h3>High School</h3>
          <p>Del monte National high school 2014 - 2020</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Recent Projects -->
  <section id="projects">
    <div class="container">
      <h2 id="projectsTitle">Recent Projects</h2>
      <div class="projects">
        <div class="card">
          <h3 id="posTitle">Simple POS System</h3>
          <p id="posDescription">A VB.NET POS with inventory management and receipt printing.</p>
        </div>
        <div class="card">
          <h3 id="portfolioTitle">Portfolio Website</h3>
          <p id="portfolioDescription">This personal portfolio using HTML and CSS.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Form -->
  <!-- Contact Form -->
<section id="contact">
  <div class="container">
    <form id="contactForm" method="POST" action="">
      <input type="text" id="name" name="name" placeholder="Your Name" value="<?= htmlspecialchars($old['name'] ?? '') ?>">
      <div class="error"><?= $errors['name'] ?? '' ?></div>

      <input type="text" id="subject" name="subject" placeholder="Subject" value="<?= htmlspecialchars($old['subject'] ?? '') ?>">
      <div class="error"><?= $errors['subject'] ?? '' ?></div>

      <input type="email" id="email" name="email" placeholder="Email Address" value="<?= htmlspecialchars($old['email'] ?? '') ?>">
      <div class="error"><?= $errors['email'] ?? '' ?></div>

      <textarea id="message" name="message" placeholder="Message (max 150 characters)" maxlength="150"><?= htmlspecialchars($old['message'] ?? '') ?></textarea>
      <div class="error"><?= $errors['message'] ?? '' ?></div>

      <button type="submit">Send Message</button>

        <a href="dashboard.php" target="_blank">
          <button type="button" class="db-btn">Check DB</button>
        </a>
        <button type="button" class="clear-btn" onclick="clearForm()">Clear All</button>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="container">
      <p>© 2025 All rights reserved. | <a href="#">LinkedIn</a> | <a href="#">GitHub</a></p>
    </div>
  </footer>
  <script src="javascript/navbar.js"></script>
  <!--<script src="javascript/formvalidation.js"></script>-->
  <script src="javascript/project.js"></script>
  <script src="javascript/themetoggle.js"></script>
  <script src="javascript/language.js"></script>
  <script src="javascript/contact.js"></script>
  <script>
    // Add this JS if not present in contact.js
    function clearForm() {
      document.getElementById('contactForm').reset();
      document.querySelectorAll('.error').forEach(e => e.textContent = '');
    }
  </script>
</body>
</html>