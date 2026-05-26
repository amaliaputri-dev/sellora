<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($title) ? $title : 'Login' ?> - Sistem Kasir</title>
    <style>
        * {box-sizing:border-box;}
        body {font-family:Segoe UI, Tahoma, sans-serif; background:linear-gradient(180deg, #e2e8f0, #f8fafc); margin:0; min-height:100vh; display:flex; align-items:center; justify-content:center; padding:24px;}
        .login-box {width:100%; max-width:420px; background:#fff; border:1px solid #dbe4ee; padding:28px; border-radius:18px; box-shadow:0 20px 50px rgba(15, 23, 42, 0.08);}
        h1 {margin:0 0 10px; font-size:28px; color:#0f172a;}
        p {margin:0 0 20px; color:#475569; line-height:1.6;}
        .form-group {margin-bottom:16px;}
        label {display:block; margin-bottom:8px; font-weight:600; color:#0f172a;}
        input {width:100%; padding:12px 14px; border:1px solid #cbd5e1; border-radius:12px; background:#fff;}
        input:focus {outline:none; border-color:#2563eb; box-shadow:0 0 0 3px rgba(37, 99, 235, 0.12);}
        .btn {display:inline-flex; width:100%; justify-content:center; padding:12px 16px; border-radius:12px; text-decoration:none; background:#2563eb; color:#fff; font-weight:600;}
        button.btn {border:0; cursor:pointer;}
        .btn:hover {background:#1d4ed8;}
        .alert {background:#fff7ed; color:#9a3412; border:1px solid #fed7aa; padding:12px 14px; margin-bottom:18px; border-radius:12px;}
        .note {margin-top:16px; padding:12px 14px; border-radius:12px; background:#eff6ff; color:#1e40af; border:1px solid #bfdbfe;}
    </style>
</head>
<body>
<div class="login-box">
    <h1>Sistem Kasir</h1>
    <?php if (!empty($message)): ?>
        <div class="alert"><?= html_escape($message) ?></div>
    <?php endif; ?>
    <?= validation_errors('<div class="alert">', '</div>'); ?>
    <p>Silakan login dengan username dan password. Session tidak dipakai, jadi status login disimpan lewat cookie browser.</p>
    <form method="post" action="<?= site_url('auth/login') ?>">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?= set_value('username') ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button class="btn" type="submit">Masuk</button>
    </form>
    <div class="note">Akun default: <strong>admin</strong> / <strong>admin123</strong></div>
</div>
</body>
</html>
