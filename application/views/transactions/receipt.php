<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card">
    <h3>Struk Transaksi #<?= $transaction->id ?></h3>
    <p><strong>Pelanggan:</strong> <?= $transaction->customer_name ?: 'Umum' ?></p>
    <p><strong>Tanggal:</strong> <?= $transaction->created_at ?></p>
    <table class="table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= $item->product_name ?></td>
                    <td>Rp <?= number_format($item->price, 0, ',', '.') ?></td>
                    <td><?= $item->quantity ?></td>
                    <td>Rp <?= number_format($item->subtotal, 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td><strong>Rp <?= number_format($transaction->total, 0, ',', '.') ?></strong></td>
            </tr>
            <tr>
                <td colspan="3"><strong>Bayar</strong></td>
                <td>Rp <?= number_format($transaction->paid, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td colspan="3"><strong>Kembalian</strong></td>
                <td>Rp <?= number_format($transaction->change, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>
    <a class="btn" href="<?= site_url('transaksi') ?>">Kembali ke Transaksi</a>
</div>
