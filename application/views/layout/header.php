<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($title) ? $title . ' - Sistem Kasir' : 'Sistem Kasir' ?></title>
    <style>
        * {box-sizing:border-box;}
        body {font-family:Segoe UI, Tahoma, sans-serif; margin:0; background:#eef3f8; color:#1f2937;}
        a {color:inherit;}
        .topbar {background:linear-gradient(135deg, #1d4ed8, #1e3a8a); color:#fff; padding:16px 24px; display:flex; justify-content:space-between; align-items:center; box-shadow:0 10px 30px rgba(30, 58, 138, 0.18);}
        .topbar-actions {display:flex; align-items:center; gap:10px;}
        .topbar-user {font-size:14px; color:rgba(255,255,255,0.92);}
        .app {display:flex; min-height:calc(100vh - 64px);}
        .sidebar {width:240px; background:#0f172a; padding:24px 18px; color:#fff;}
        .sidebar h2 {margin:0 0 18px; font-size:18px; letter-spacing:0.02em;}
        .sidebar-section {margin:18px 0 8px; padding:0 12px; font-size:11px; font-weight:700; letter-spacing:0.08em; text-transform:uppercase; color:#64748b;}
        .sidebar-section:first-of-type {margin-top:0;}
        .sidebar a {display:block; color:#cbd5e1; text-decoration:none; padding:10px 12px; margin:4px 0; border-radius:10px; transition:background 0.2s ease, color 0.2s ease;}
        .sidebar a:hover {background:#1e293b; color:#fff;}
        .content {flex:1; padding:28px;}
        .content h1 {margin-top:0; margin-bottom:22px;}
        .card, .flex-card {background:#fff; border:1px solid #dbe4ee; border-radius:16px; box-shadow:0 10px 30px rgba(15, 23, 42, 0.06);}
        .card {padding:20px; margin-bottom:20px;}
        .card h3, .flex-card h3 {margin-top:0;}
        .table-wrap {overflow-x:auto;}
        .table {width:100%; border-collapse:collapse; min-width:640px;}
        .table th, .table td {padding:12px 14px; border-bottom:1px solid #e5e7eb; text-align:left; vertical-align:middle;}
        .table th {background:#f8fafc; color:#334155;}
        .btn {display:inline-flex; align-items:center; justify-content:center; padding:10px 16px; border:0; border-radius:10px; text-decoration:none; background:#2563eb; color:#fff; cursor:pointer; font-weight:600;}
        .btn:hover {background:#1d4ed8;}
        .btn-danger {background:#dc2626;}
        .btn-danger:hover {background:#b91c1c;}
        .btn-secondary {background:#64748b;}
        .btn-secondary:hover {background:#475569;}
        .btn-topbar {background:rgba(255,255,255,0.16); color:#fff;}
        .btn-topbar:hover {background:rgba(255,255,255,0.24);}
        .alert {background:#fff1f2; color:#9f1239; padding:14px 16px; border:1px solid #fecdd3; border-radius:12px; margin-bottom:18px;}
        .form-group {margin-bottom:16px;}
        label {display:block; margin-bottom:8px; font-weight:600;}
        input, select {width:100%; padding:11px 12px; border:1px solid #cbd5e1; border-radius:10px; background:#fff;}
        input:focus, select:focus {outline:none; border-color:#2563eb; box-shadow:0 0 0 3px rgba(37, 99, 235, 0.12);}
        .toolbar {display:flex; gap:16px; flex-wrap:wrap; align-items:end;}
        .toolbar-search {flex:1 1 260px;}
        .toolbar-actions {display:flex; gap:10px; flex-wrap:wrap;}
        .inline-form {display:flex; align-items:center; gap:8px; flex-wrap:wrap;}
        .input-qty {width:84px; min-width:84px;}
        .flex-row {display:flex; gap:16px; flex-wrap:wrap; margin-bottom:20px;}
        .flex-card {flex:1; min-width:180px; padding:18px; margin-bottom:4px;}
        @media (max-width: 900px) {
            .app {flex-direction:column;}
            .sidebar {width:100%;}
            .content {padding:18px;}
            .table {min-width:560px;}
        }
    </style>
</head>
<body>
<div class="topbar">
    <div><strong>Sistem Kasir</strong></div>
    <div class="topbar-actions">
        <?php if (!empty($current_user->username)): ?>
            <span class="topbar-user">Halo, <?= html_escape($current_user->username) ?></span>
        <?php endif; ?>
        <a class="btn btn-topbar" href="<?= site_url('auth/logout') ?>">Logout</a>
    </div>
</div>
<div class="app">
