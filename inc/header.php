<?php
// header.php
// Declare $pageTitle before including this file on each page
if (!isset($pageTitle)) {
    $pageTitle = "OWUTECH Consults - Connecting Learners to Partner Institutions";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="OWUTECH Consults - Connecting Learners to Partner Institutions. Browse accredited programs and apply directly to partner universities and colleges.">
    <meta name="keywords" content="owutech consults, education, nigeria, universities, courses, application">

    <!-- Dynamic Title -->
    <title><?php echo htmlspecialchars($pageTitle); ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://owutechconsults.com.ng/assets/img/bg/logo.jpg">

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all-fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="home">
    <!-- Preloader -->
    <div class="preloader">
        <div class="loader-book">
            <div class="loader-book-page"></div>
            <div class="loader-book-page"></div>
            <div class="loader-book-page"></div>
        </div>
    </div>
    <!-- End Preloader -->

    <!-- Header -->
    <header class="header">
        <!-- Top Bar -->
        <div class="header-top" >
            <div class="container">
                <div class="header-top-wrap">
                    <div class="header-top-left">
                        <p class="header-top-news" style="color:white;" >Welcome to OWUTECH Consults – Connecting Learners to Partner Institutions.</p>
                    </div>
                    <div class="header-top-right">
                        <div class="header-top-menu">
                            <a href="#" style="color:white;">Login</a>
                            <a href="#" style="color:white;">Students</a>
                            <a href="#" style="color:white;">Help Desk</a>
                            <a href="#" style="color:white;">Alumni</a>
                            <a href="#" style="color:white;">Faculty</a>
                            <a href="#" style="color:white;">Contact</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Navigation -->
        <div class="main-navigation">
            <nav class="navbar navbar-expand-lg">
                <div class="container position-relative">
                    <a class="navbar-brand" href="index.php">
                        <img src="assets/img/bg/logo.jpg" alt="OWUTECH Logo">
                    </a>

                    <div class="mobile-menu-right">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-mobile-icon"><i class="far fa-bars"></i></span>
                        </button>
                    </div>

                    <div class="collapse navbar-collapse" id="main_nav">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="institutions.php">Institutions</a></li>
                            <li class="nav-item"><a class="nav-link" href="courses.php">Courses</a></li>
                            <li class="nav-item"><a class="nav-link" href="how-to-apply.php">How to Apply</a></li>
                            <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                        </ul>

                        <div class="nav-right">
                            <div class="nav-right-btn mt-2">
                                <a href="./apply" class="theme-btn"><span class="fal fa-pencil"></span>Apply Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- End Header -->

    <!-- Popup Search -->
    <div class="search-popup">
        <button class="close-search"><span class="far fa-times"></span></button>
        <form action="search.php" method="get">
            <div class="form-group">
                <input type="search" name="q" placeholder="Search for courses or institutions..." required>
                <button type="submit"><i class="far fa-search"></i></button>
            </div>
        </form>
    </div>
    <!-- End Popup Search -->
