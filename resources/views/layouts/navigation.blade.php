<?php

?>

<nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: transparent !important;">

  <div class="container-fluid position-relative mx-4 mt-2">
    <a class="navbar-brand fs-3" href="{{ route('home') }}">@include('components.application-logo')</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('team') }}">Lawyers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('about') }}">About Us</a>
        </li>
        <li class="flex-grow-1  ">
          <span></span>
        </li>
        @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">Register</a>
        </li>
        <li class="nav-item justify-self-end">
          <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>
        @endguest

        @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Profile</a>
          <ul class="dropdown-menu dropdown-menu-end text-center">
            <li><a class="dropdown-item" href="{{ route('password-confirm') }}">Settings</a></li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
          </ul>
        </li>
        @endauth
      </ul>
    </div>
  </div>

</nav>