<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link href="<?php echo URL ?>/public/css/estilos.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
    <title><?php echo APP_NOME ?></title>
</head>

<body>



<header class="header">

<div class="header-top">
  <div class="container">

    <ul class="header-top-list">

      <li class="header-top-item">
        <ion-icon name="call-outline" aria-hidden="true"></ion-icon>

        <p class="item-title">Call Us :</p>

        <a href="tel:01234567895" class="item-link">012 (345) 67 895</a>
      </li>

      <li class="header-top-item">
        <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

        <p class="item-title">Opening Hour :</p>

        <p class="item-text">Sunday - Friday, 08 am - 09 pm</p>
      </li>

      <li>
        <ul class="social-list">

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-youtube"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="chatbubble-ellipses-outline"></ion-icon>
            </a>
          </li>

        </ul>
      </li>

    </ul>

  </div>
</div>

<div class="header-bottom" data-header>
  <div class="container">

    <a href="#" class="logo">
      Barber
      <span class="span">Hair Salon</span>
    </a>

    <nav class="navbar container" data-navbar>
      <ul class="navbar-list">

        <li class="navbar-item">
          <a href="#home" class="navbar-link" data-nav-link>Home</a>
        </li>

        <li class="navbar-item">
          <a href="#services" class="navbar-link" data-nav-link>Services</a>
        </li>

        <li class="navbar-item">
          <a href="#pricing" class="navbar-link" data-nav-link>Pricing</a>
        </li>

        <li class="navbar-item">
          <a href="#gallery" class="navbar-link" data-nav-link>Gallery</a>
        </li>

        <li class="navbar-item">
          <a href="#appointment" class="navbar-link" data-nav-link>Appointment</a>
        </li>

        <li class="navbar-item">
          <a href="#" class="navbar-link" data-nav-link>Contact</a>
        </li>

      </ul>
    </nav>

    <button class="nav-toggle-btn" aria-label="toggle menu" data-nav-toggler>
      <ion-icon name="menu-outline" aria-hidden="true"></ion-icon>
    </button>

    <a href="#" class="btn has-before">
      <span class="span">Appointment</span>

      <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
    </a>

  </div>
</div>

</header>