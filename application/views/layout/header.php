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
        :root {
            --bg:#efe7da;
            --bg-deep:#e4d7c3;
            --panel:#fffdf9;
            --panel-soft:#f7f0e6;
            --line:#ddcfbc;
            --line-soft:#eadfce;
            --text:#241f1a;
            --muted:#75695c;
            --accent:#a66a2c;
            --accent-dark:#845321;
            --header-start:#6f1d1b;
            --header-end:#a44200;
            --navy:#1f2a2a;
            --navy-soft:#2f3d3c;
            --danger:#b64d3d;
            --danger-dark:#943d30;
            --shadow:0 20px 45px rgba(49, 32, 17, 0.10);
        }
        body {font-family:Segoe UI, Tahoma, sans-serif; margin:0; background:
            radial-gradient(circle at top left, rgba(255,255,255,0.65), transparent 28%),
            radial-gradient(circle at bottom right, rgba(166,106,44,0.10), transparent 24%),
            linear-gradient(180deg, #f7f1e8 0%, var(--bg) 58%, var(--bg-deep) 100%);
            color:var(--text);}
        a {color:inherit;}
        .topbar {background:linear-gradient(135deg, var(--header-start), var(--header-end)); color:#fff4ea; padding:18px 28px; display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid rgba(255,255,255,0.10); box-shadow:0 14px 30px rgba(111, 29, 27, 0.18);}
        .topbar-actions {display:flex; align-items:center; gap:10px;}
        .topbar-user {font-size:14px; color:rgba(255,244,234,0.84);}
        .app {display:flex; min-height:calc(100vh - 64px);}
        .sidebar {width:250px; background:linear-gradient(180deg, #243130, #1f2a2a); padding:28px 18px; color:#f6efe7; border-right:1px solid rgba(255,255,255,0.06);}
        .sidebar h2 {margin:0 0 18px; font-size:18px; letter-spacing:0.02em; color:#fff7ed;}
        .sidebar-section {margin:20px 0 8px; padding:0 12px; font-size:11px; font-weight:700; letter-spacing:0.08em; text-transform:uppercase; color:#b9aaa0;}
        .sidebar-section:first-of-type {margin-top:0;}
        .sidebar a {display:block; color:#e8ddd2; text-decoration:none; padding:11px 12px; margin:4px 0; border-radius:12px; transition:background 0.2s ease, color 0.2s ease, transform 0.2s ease;}
        .sidebar a:hover {background:rgba(255,255,255,0.10); color:#fff; transform:translateX(2px);}
        .content {flex:1; padding:32px;}
        .content h1 {margin-top:0; margin-bottom:22px;}
        .page-hero {display:flex; justify-content:space-between; gap:20px; align-items:flex-end; padding:28px 30px; margin-bottom:22px; border-radius:26px; background:
            linear-gradient(135deg, rgba(36,49,48,0.96), rgba(61,79,77,0.93)),
            linear-gradient(135deg, #ffffff, #faf8f3);
            border:1px solid rgba(255,255,255,0.10); box-shadow:0 24px 60px rgba(36,49,48,0.22);}
        .page-hero h1 {margin:0 0 8px; font-size:32px; font-weight:700; color:#fff7ed;}
        .page-hero p {margin:0; color:rgba(255,247,237,0.76); line-height:1.6; max-width:700px;}
        .hero-chip {display:inline-flex; align-items:center; gap:8px; padding:10px 14px; border-radius:999px; background:rgba(255,255,255,0.12); color:#fff7ed; font-size:12px; font-weight:700; backdrop-filter:blur(6px);}
        .card, .flex-card {background:linear-gradient(180deg, rgba(255,253,249,0.98), rgba(247,240,230,0.96)); border:1px solid rgba(221,207,188,0.92); border-radius:18px; box-shadow:var(--shadow);}
        .card {padding:22px; margin-bottom:22px;}
        .card h3, .flex-card h3 {margin-top:0;}
        .card-title {display:flex; justify-content:space-between; gap:14px; align-items:center; margin-bottom:16px;}
        .card-title p {margin:4px 0 0; color:var(--muted);}
        .table-wrap {overflow-x:auto;}
        .table {width:100%; border-collapse:separate; border-spacing:0; min-width:640px;}
        .table th, .table td {padding:14px 14px; border-bottom:1px solid var(--line-soft); text-align:left; vertical-align:middle;}
        .table th {background:rgba(166,106,44,0.08); color:#6a5644; font-size:12px; text-transform:uppercase; letter-spacing:0.05em;}
        .table tr:hover td {background:rgba(255,255,255,0.42);}
        .btn {display:inline-flex; align-items:center; justify-content:center; padding:10px 16px; border:0; border-radius:12px; text-decoration:none; background:var(--accent); color:#fff8f1; cursor:pointer; font-weight:600; transition:transform 0.15s ease, background 0.15s ease, box-shadow 0.15s ease;}
        .btn:hover {background:var(--accent-dark); transform:translateY(-1px); box-shadow:0 12px 24px rgba(166,106,44,0.18);}
        .btn-danger {background:var(--danger);}
        .btn-danger:hover {background:var(--danger-dark);}
        .btn-secondary {background:#7f6f5d;}
        .btn-secondary:hover {background:#695a4b;}
        .btn-topbar {background:rgba(255,255,255,0.14); color:#fff7ed; border:1px solid rgba(255,255,255,0.12);}
        .btn-topbar:hover {background:rgba(255,255,255,0.22);}
        .btn-ghost {background:rgba(166,106,44,0.10); color:#7a5225;}
        .btn-ghost:hover {background:rgba(166,106,44,0.16);}
        .btn-sm {padding:8px 12px; font-size:13px;}
        .stack-actions {display:flex; flex-wrap:wrap; gap:8px;}
        .alert {background:#fdf1ee; color:#8a3f33; padding:14px 16px; border:1px solid #efd3cc; border-radius:14px; margin-bottom:18px;}
        .empty-state {padding:30px 24px; text-align:center; color:var(--muted); border:1px dashed var(--line); border-radius:16px; background:rgba(255,255,255,0.34);}
        .empty-state strong {display:block; margin-bottom:6px; color:var(--text);}
        .badge {display:inline-flex; align-items:center; padding:6px 10px; border-radius:999px; font-size:12px; font-weight:700; letter-spacing:0.02em;}
        .badge-admin {background:rgba(166,106,44,0.12); color:#7a5225;}
        .badge-kasir {background:rgba(47,93,80,0.12); color:#2f5d50;}
        .metric-number {font-size:32px; font-weight:700; margin:8px 0 4px; color:#2b2520;}
        .metric-label {margin:0; color:var(--muted);}
        .muted {color:var(--muted);}
        .form-group {margin-bottom:16px;}
        label {display:block; margin-bottom:8px; font-weight:600;}
        input, select {width:100%; padding:12px 13px; border:1px solid #d9d2c8; border-radius:12px; background:#fffdfa;}
        input[readonly] {background:#f7f0e6; color:#6d675e;}
        input:focus, select:focus {outline:none; border-color:var(--accent); box-shadow:0 0 0 3px rgba(166,106,44,0.10);}
        .toolbar {display:flex; gap:16px; flex-wrap:wrap; align-items:end;}
        .toolbar-search {flex:1 1 260px;}
        .toolbar-actions {display:flex; gap:10px; flex-wrap:wrap;}
        .inline-form {display:flex; align-items:center; gap:8px; flex-wrap:wrap;}
        .input-qty {width:84px; min-width:84px;}
        .flex-row {display:flex; gap:16px; flex-wrap:wrap; margin-bottom:20px;}
        .flex-card {flex:1; min-width:180px; padding:20px; margin-bottom:4px; position:relative; overflow:hidden;}
        .flex-card::after {content:''; position:absolute; inset:auto -30px -30px auto; width:110px; height:110px; background:radial-gradient(circle, rgba(166,106,44,0.14), transparent 70%);}
        .receipt-meta {display:grid; grid-template-columns:repeat(2, minmax(220px, 1fr)); gap:14px; margin-bottom:18px;}
        .receipt-box {padding:14px 16px; border-radius:16px; background:rgba(255,255,255,0.46); border:1px solid var(--line-soft);}
        .receipt-box span {display:block; font-size:12px; color:var(--muted); text-transform:uppercase; letter-spacing:0.04em; margin-bottom:4px;}
        @media (max-width: 900px) {
            .app {flex-direction:column;}
            .sidebar {width:100%;}
            .content {padding:18px;}
            .table {min-width:560px;}
            .page-hero {padding:20px; align-items:flex-start; flex-direction:column;}
            .receipt-meta {grid-template-columns:1fr;}
        }
    </style>
</head>
<body>
<div class="topbar">
    <div><strong>Sistem Kasir</strong></div>
    <div class="topbar-actions">
        <?php if (!empty($current_user->username)): ?>
            <span class="topbar-user">Halo, <?= html_escape($current_user->username) ?> (<?= html_escape($current_user->role ?? 'user') ?>)</span>
        <?php endif; ?>
        <a class="btn btn-topbar" href="<?= site_url('auth/logout') ?>">Logout</a>
    </div>
</div>
<div class="app">
