<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Sistem Kasir</title>
    <style>
        body {font-family: Arial, sans-serif; background:#f4f7fb; margin:0; padding:0;}
        .login-box {width:360px; margin:80px auto; background:#fff; border:1px solid #ddd; padding:24px; border-radius:6px; box-shadow:0 2px 10px rgba(0,0,0,0.08);}
        h1 {margin-top:0; font-size:24px;}
        .form-group {margin-bottom:16px;}
        label {display:block; margin-bottom:8px; font-weight:600;}
        input {width:100%; padding:10px; border:1px solid #ccc; border-radius:4px;}
        button {width:100%; padding:12px; border:none; border-radius:4px; background:#2d6cdf; color:#fff; font-size:16px; cursor:pointer;}
        .alert {background:#fff3cd; color:#664d03; border:1px solid #ffeeba; padding:12px; margin-bottom:16px; border-radius:4px;}
    </style>
</head>
<body>
<div class="login-box">
    <h1>Login Sistem Kasir</h1>
    <?php if (!empty($error)): ?>
        <div class="alert"><?= $error ?></div>
    <?php endif; ?>
    <?= validation_errors('<div class="alert">', '</div>'); ?>
    <form method="post" action="<?= site_url('auth/login') ?>">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?= set_value('username') ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Masuk</button>
    </form>
    <p style="margin-top:14px; color:#555;">Gunakan <strong>admin/admin123</strong> jika belum ada akun.</p>
</div>
</body>
</html>
