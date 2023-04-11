<?php
include 'url.php';
session_start();

if (!isset($_SESSION['login'])) {
  header("Location: ../index.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= BASEURL; ?>/BS/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= BASEURL; ?>/fonts/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= BASEURL; ?>/datatables/datatables.css">

  <!-- Custom styles for this template -->
  <link href="<?= BASEURL; ?>/css/admin.css" rel="stylesheet">

  <title>Halaman Admin</title>
</head>

<body>

  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-5" href="index.php">
      <i class="fa fa-sitemap"></i>
      <cite class="ms-2 fw-bold">Administrator</cite>
    </a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </header>

  <div class="container-fluid">
    <div class="row">

      <?php include 'sidebar.php'; ?>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">