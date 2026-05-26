<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="flex-row">
    <div class="flex-card">
        <h3>Produk</h3>
        <p><?= $product_count ?> item</p>
    </div>
    <div class="flex-card">
        <h3>Kategori</h3>
        <p><?= $category_count ?> item</p>
    </div>
    <div class="flex-card">
        <h3>Pelanggan</h3>
        <p><?= $customer_count ?> data</p>
    </div>
    <div class="flex-card">
        <h3>Transaksi</h3>
        <p><?= $transaction_count ?> transaksi</p>
    </div>
</div>
<div class="card">
    <h3>Riwayat Transaksi Terbaru</h3>
    <?php if (!empty($recent_transactions)): ?>
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
                        <td><?= $trx->id ?></td>
                        <td><?= $trx->customer_name ?: 'Umum' ?></td>
                        <td>Rp <?= number_format($trx->total, 0, ',', '.') ?></td>
                        <td><?= $trx->created_at ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Tidak ada transaksi terbaru.</p>
    <?php endif; ?>
</div>
