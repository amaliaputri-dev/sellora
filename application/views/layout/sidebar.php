<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <div class="sidebar">
        <h2>Navigasi</h2>
        <div class="sidebar-section">Utama</div>
        <a href="<?= site_url('dashboard') ?>">Dashboard</a>

        <div class="sidebar-section">Master Data</div>
        <a href="<?= site_url('master-data/products') ?>">Produk</a>
        <a href="<?= site_url('master-data/categories') ?>">Kategori</a>
        <a href="<?= site_url('master-data/customers') ?>">Pelanggan</a>

        <div class="sidebar-section">Transaksi</div>
        <a href="<?= site_url('transaksi') ?>">Kasir</a>
        <a href="<?= site_url('transaksi/riwayat') ?>">Riwayat Transaksi</a>
        <a href="<?= site_url('transaksi/laporan') ?>">Laporan Penjualan</a>

        <div class="sidebar-section">Akun</div>
        <a href="<?= site_url('auth/logout') ?>">Logout</a>
    </div>
    <div class="content">
        <h1><?= isset($title) ? $title : 'Sistem Kasir' ?></h1>
