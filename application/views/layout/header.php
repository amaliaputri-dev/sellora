<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($title) ? $title . ' - Sistem Kasir' : 'Sistem Kasir' ?></title>
    <style>
        body {font-family: Arial, sans-serif; margin:0; padding:0; background:#f2f2f2;}
        .topbar {background:#2d6cdf; color:#fff; padding:12px 20px; display:flex; justify-content:space-between; align-items:center;}
        .topbar a {color:#ffffff; text-decoration:none; margin-left:12px;}
        .app {display:flex; min-height:calc(100vh - 50px);}
        .sidebar {width:220px; background:#1f3e8a; padding:20px; color:#fff;}
        .sidebar h2 {margin-top:0; font-size:18px;}
        .sidebar a {display:block; color:#dce4f5; text-decoration:none; margin:10px 0;}
        .sidebar a:hover {color:#fff;}
        .content {flex:1; padding:24px;}
        .card {background:#fff; border:1px solid #dcdcdc; padding:18px; margin-bottom:18px; border-radius:4px;}
        .card h3 {margin-top:0;}
        .table {width:100%; border-collapse:collapse;}
        .table th, .table td {padding:10px; border:1px solid #e5e5e5;}
        .btn {display:inline-block; padding:8px 14px; border-radius:4px; text-decoration:none; background:#2d6cdf; color:#fff;}
        .btn-danger {background:#d9534f;}
        .btn-secondary {background:#6c757d;}
        .alert {background:#ffe7e7; color:#842029; padding:12px; border:1px solid #f5c2c7; border-radius:4px; margin-bottom:18px;}
        .form-group {margin-bottom:14px;}
        label {display:block; margin-bottom:6px; font-weight:600;}
        input, select {width:100%; padding:10px; border:1px solid #ccc; border-radius:4px;}
        .flex-row {display:flex; gap:16px; flex-wrap:wrap;}
        .flex-card {flex:1; min-width:180px; background:#fff; border:1px solid #dcdcdc; padding:16px; border-radius:4px;}
    </style>
</head>
<body>
<div class="topbar">
    <div><strong>Sistem Kasir</strong></div>
    <div>
        <?= $this->session->userdata('username') ? 'Halo, ' . $this->session->userdata('username') : '' ?>
        <?php if ($this->session->userdata('logged_in')): ?>
            <a href="<?= site_url('auth/logout') ?>">Logout</a>
        <?php endif; ?>
    </div>
</div>
<div class="app">
