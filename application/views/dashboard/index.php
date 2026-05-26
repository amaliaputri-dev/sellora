<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="page-hero">
    <div>
        <h1>Dashboard Penjualan</h1>
        <p>Pantau ringkasan stok, pelanggan, dan aktivitas transaksi terbaru dari satu halaman yang lebih ringkas.</p>
    </div>
    <div class="hero-chip">Ringkasan hari ini</div>
</div>
<div class="flex-row">
    <div class="flex-card">
        <h3>Produk</h3>
        <div class="metric-number"><?= $product_count ?></div>
        <p class="metric-label">item terdaftar</p>
    </div>
    <div class="flex-card">
        <h3>Kategori</h3>
        <div class="metric-number"><?= $category_count ?></div>
        <p class="metric-label">kelompok barang</p>
    </div>
    <div class="flex-card">
        <h3>Pelanggan</h3>
        <div class="metric-number"><?= $customer_count ?></div>
        <p class="metric-label">data pelanggan</p>
    </div>
    <div class="flex-card">
        <h3>Transaksi</h3>
        <div class="metric-number"><?= $transaction_count ?></div>
        <p class="metric-label">riwayat penjualan</p>
    </div>
</div>
<div class="card">
    <div class="card-title">
        <div>
            <h3>Riwayat Transaksi Terbaru</h3>
            <p>Lima transaksi terakhir yang tercatat di sistem.</p>
        </div>
    </div>
    <?php if (!empty($recent_transactions)): ?>
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pelanggan</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recent_transactions as $trx): ?>
                        <tr>
                            <td>#<?= $trx->id ?></td>
                            <td><?= $trx->customer_name ?: 'Umum' ?></td>
                            <td>Rp <?= number_format($trx->total, 0, ',', '.') ?></td>
                            <td><?= $trx->created_at ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <strong>Belum ada transaksi terbaru</strong>
            Data transaksi akan muncul di sini setelah ada penjualan.
        </div>
    <?php endif; ?>
</div>
