<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <div class="sidebar">
        <h2>Menu</h2>
        <a href="<?= site_url('dashboard') ?>">Dashboard</a>
        <a href="<?= site_url('products') ?>">Data Produk</a>
        <a href="<?= site_url('categories') ?>">Data Kategori</a>
        <a href="<?= site_url('customers') ?>">Data Pelanggan</a>
        <a href="<?= site_url('transactions') ?>">Transaksi Kasir</a>
        <a href="<?= site_url('transactions/history') ?>">Riwayat Transaksi</a>
        <a href="<?= site_url('reports') ?>">Laporan Penjualan</a>
        <a href="<?= site_url('auth/logout') ?>">Logout</a>
    </div>
    <div class="content">
        <h1><?= isset($title) ? $title : 'Sistem Kasir' ?></h1>
