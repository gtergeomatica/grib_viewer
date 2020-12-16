<?php

?>

<header class="masthead mb-auto">
    <div class="inner" style="margin-top: 0px;">
      <h1 class="masthead-brand" style="margin-left: 20px;"><span style="color: #e6335b;">Risq'eau</span> <span style="color: #394283;">WebGIS</span>
      <img class="masthead" src="./icon/logo_risqueau.png" style="max-height: 100px; margin-bottom: 0px !important;"></h1>
      <!--nav class="nav nav-masthead justify-content-center">
        <a class="nav-link " href="http://servizi-meteoliguria.arpal.gov.it/MAPPE/mappe.php?pagina=12" target="_blank">Meteo Liguria ARPAL</a>
        <a class="nav-link" href="https://www.windy.com/multimodel/43.859/7.962?gfs,rainAccu,43.633,7.962,9,m:eSgagor" target="_blank">San Lorenzo al Mare</a>
        <a class="nav-link" href="https://www.windy.com/multimodel/43.797/7.647?gfs,rainAccu,43.571,7.646,9,m:eR8agnT" target="_blank">Vallecrosia</a>
        <a class="nav-link" href="http://www.lamma.rete.toscana.it/modelli/atmo/mappe/atmosfera?model=wrf03ecm" target="_blank">Consorzio LAMMA</a>
      </nav-->
	<nav class="navbar navbar-expand-lg navbar-light rounded">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample10" aria-controls="navbarsExample10" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample10">
      <ul class="navbar-nav">
        <!--li class="nav-item">
          <span class="navbar-brand">Link utili</span>
        </li-->
        <li class="nav-item">
        <a class="nav-link" href="https://www.risqeau.eu/ " target="_blank">Progetto Risq'eau</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Direzione Onda
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">San Lorenzo al Mare</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="./scenari_slm.php" target="_blank">Libeccio</a></li>
              <li><a class="dropdown-item" href="./scenari_slm.php" target="_blank">Grecale</a></li>
              <li><a class="dropdown-item" href="./scenari_slm.php" target="_blank">Grecale–Levante–Libeccio</a></li>
              <li><a class="dropdown-item" href="./scenari_slm.php" target="_blank">Levante–Libeccio–Tramontana</a></li>
              <li><a class="dropdown-item" href="./scenari_slm.php" target="_blank">Libeccio–Grecale</a></li>
              <li><a class="dropdown-item" href="./scenari_slm.php" target="_blank">Libeccio–Grecale–Meridionale</a></li>
              <li><a class="dropdown-item" href="./scenari_slm.php" target="_blank">Libeccio–Tramontana</a></li>
              <li><a class="dropdown-item" href="./scenari_slm.php" target="_blank">Grecale–Scirocco–Libeccio</a></li>
              <li><a class="dropdown-item" href="./scenari_slm.php" target="_blank">Scirocco–Libeccio</a></li>
              <li><a class="dropdown-item" href="./scenari_slm.php" target="_blank">Grecale–Libeccio</a></li>
            </ul>
          </li>
          <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Vallecrosia</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="./scenari_v.php" target="_blank">Libeccio–Meridionale</a></li>
              <li><a class="dropdown-item" href="./scenari_v.php" target="_blank">Tramontana–Levante</a></li>
              <li><a class="dropdown-item" href="./scenari_v.php" target="_blank">Scirocco–Libeccio</a></li>
              <li><a class="dropdown-item" href="./scenari_v.php" target="_blank">Scirocco–Libeccio–Tramontana</a></li>
              <li><a class="dropdown-item" href="./scenari_v.php" target="_blank">Libeccio–Grecale–Tramontana</a></li>
              <li><a class="dropdown-item" href="./scenari_v.php" target="_blank">Levante-Scirocco–Libeccio</a></li>
              <li><a class="dropdown-item" href="./scenari_v.php" target="_blank">Libeccio–Tramontana–Scirocco</a></li>
              <li><a class="dropdown-item" href="./scenari_v.php" target="_blank">Libeccio</a></li>
              <li><a class="dropdown-item" href="./scenari_v.php" target="_blank">Scirocco–Grecale</a></li>
              <li><a class="dropdown-item" href="./scenari_v.php" target="_blank">Meridionale–Levante–Libeccio</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Direzione Vento
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">San Lorenzo al Mare</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="./scenari_slm.php" target="_blank">Libeccio</a></li>
              <li><a class="dropdown-item" href="./scenari_slm.php" target="_blank">Tramontana</a></li>
              <li><a class="dropdown-item" href="./scenari_slm.php" target="_blank">Tramontana–Libeccio</a></li>
              <li><a class="dropdown-item" href="./scenari_slm.php" target="_blank">Grecale–Libeccio–Tramontana</a></li>
              <li><a class="dropdown-item" href="./scenari_slm.php" target="_blank">Libeccio–Tramontana</a></li>
              <li><a class="dropdown-item" href="./scenari_slm.php" target="_blank">Grecale–Libeccio–Tramontana</a></li>
              <li><a class="dropdown-item" href="./scenari_slm.php" target="_blank">Libeccio–Tramontana</a></li>
              <li><a class="dropdown-item" href="./scenari_slm.php" target="_blank">Tramontana–Libeccio</a></li>
              <li><a class="dropdown-item" href="./scenari_slm.php" target="_blank">Scirocco–Tramontana</a></li>
              <li><a class="dropdown-item" href="./scenari_slm.php" target="_blank">Tramontana–Scirocco</a></li>
            </ul>
          </li>
          <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Vallecrosia</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="./scenari_v.php" target="_blank">Libeccio–Tramontana</a></li>
              <li><a class="dropdown-item" href="./scenari_v.php" target="_blank">Tramontana</a></li>
              <li><a class="dropdown-item" href="./scenari_v.php" target="_blank">Libeccio–Grecale–Scirocco</a></li>
              <li><a class="dropdown-item" href="./scenari_v.php" target="_blank">Libeccio–Tramontana–Scirocco</a></li>
              <li><a class="dropdown-item" href="./scenari_v.php" target="_blank">Tramontana–Libeccio</a></li>
              <li><a class="dropdown-item" href="./scenari_v.php" target="_blank">Grecale–Levante–Libeccio</a></li>
              <li><a class="dropdown-item" href="./scenari_v.php" target="_blank">Libeccio–Tramontana</a></li>
              <li><a class="dropdown-item" href="./scenari_v.php" target="_blank">Levante–Libeccio–Tramontana</a></li>
              <li><a class="dropdown-item" href="./scenari_v.php" target="_blank">Grecale–Libeccio–Tramontana</a></li>
              <li><a class="dropdown-item" href="./scenari_v.php" target="_blank">Tramontana–Libeccio</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">WINDY.COM</a>
        <div class="dropdown-menu" aria-labelledby="dropdown03">
          <a class="dropdown-item" href="https://www.windy.com/multimodel/43.859/7.962?gfs,rainAccu,43.633,7.962,9,m:eSgagor" target="_blank">San Lorenzo al Mare</a>
          <a class="dropdown-item" href="https://www.windy.com/multimodel/43.797/7.647?gfs,rainAccu,43.571,7.646,9,m:eR8agnT" target="_blank">Vallecrosia</a>
        </div>
      </li>
        <li class="nav-item">
        <a class="nav-link" href="http://servizi-meteoliguria.arpal.gov.it/MAPPE/mappe.php?pagina=12" target="_blank">Meteo Liguria ARPAL</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://www.lamma.rete.toscana.it/modelli/atmo/mappe/atmosfera?model=wrf03ecm" target="_blank">Consorzio LAMMA</a>
      </li>
      </ul>
    </div>
  </nav>
    </div>
  </header>
