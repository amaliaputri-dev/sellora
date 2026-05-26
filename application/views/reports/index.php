<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card">
    <form method="get" action="<?= site_url('reports') ?>">
        <div class="flex-row">
            <div style="flex:1; min-width:180px;">
                <label>Tanggal Mulai</label>
                <input type="date" name="start_date" value="<?= set_value('start_date', $start_date) ?>">
            </div>
            <div style="flex:1; min-width:180px;">
                <label>Tanggal Selesai</label>
                <input type="date" name="end_date" value="<?= set_value('end_date', $end_date) ?>">
            </div>
            <div style="align-self:flex-end;">
                <button class="btn" type="submit">Lihat Laporan</button>
            </div>
        </div>
    </form>
</div>
<div class="card">
    <?php if (!empty($report)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pelanggan</th>
                    <th>Total</th>
                    <th>Bayar</th>
                    <th>Kembalian</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($report as $row): ?>
                    <tr>
                        <td><?= $row->id ?></td>
                        <td><?= $row->customer_name ?: 'Umum' ?></td>
                        <td>Rp <?= number_format($row->total, 0, ',', '.') ?></td>
                        <td>Rp <?= number_format($row->paid, 0, ',', '.') ?></td>
                        <td>Rp <?= number_format($row->change, 0, ',', '.') ?></td>
                        <td><?= $row->created_at ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Tidak ada data laporan pada rentang tersebut.</p>
    <?php endif; ?>
</div>
