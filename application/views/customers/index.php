<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card">
    <div class="card-title">
        <div>
            <h3>Daftar Pelanggan</h3>
            <p>Data pelanggan tersimpan untuk kebutuhan arsip dan tindak lanjut penjualan.</p>
        </div>
        <a class="btn" href="<?= site_url('master-data/customers/create') ?>">Tambah Pelanggan</a>
    </div>
    <?php if (!empty($customers)): ?>
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td>#<?= $customer->id ?></td>
                            <td><?= $customer->name ?></td>
                            <td><?= $customer->phone ?: '-' ?></td>
                            <td><?= $customer->email ?: '-' ?></td>
                            <td>
                                <div class="stack-actions">
                                    <a class="btn btn-sm" href="<?= site_url('master-data/customers/edit/' . $customer->id) ?>">Edit</a>
                                    <a class="btn btn-danger btn-sm" href="<?= site_url('master-data/customers/delete/' . $customer->id) ?>" onclick="return confirm('Hapus pelanggan ini?')">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <strong>Belum ada pelanggan</strong>
            Tambahkan data pelanggan untuk kebutuhan arsip atau penjualan khusus.
        </div>
    <?php endif; ?>
</div>
