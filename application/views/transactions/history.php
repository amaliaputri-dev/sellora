<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card">
    <?php if (!empty($transactions)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pelanggan</th>
                    <th>Total</th>
                    <th>Bayar</th>
                    <th>Kembalian</th>
                    <th>Tanggal</th>
                    <th>Struk</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $trx): ?>
                    <tr>
                        <td><?= $trx->id ?></td>
                        <td><?= $trx->customer_name ?: 'Umum' ?></td>
                        <td>Rp <?= number_format($trx->total, 0, ',', '.') ?></td>
                        <td>Rp <?= number_format($trx->paid, 0, ',', '.') ?></td>
                        <td>Rp <?= number_format($trx->change, 0, ',', '.') ?></td>
                        <td><?= $trx->created_at ?></td>
                        <td><a class="btn" href="<?= site_url('transaksi/struk/' . $trx->id) ?>">Cetak</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Belum ada transaksi.</p>
    <?php endif; ?>
</div>
