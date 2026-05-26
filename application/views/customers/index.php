<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card">
    <a class="btn" href="<?= site_url('customers/create') ?>">Tambah Pelanggan</a>
</div>
<div class="card">
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
                    <td><?= $customer->id ?></td>
                    <td><?= $customer->name ?></td>
                    <td><?= $customer->phone ?></td>
                    <td><?= $customer->email ?></td>
                    <td>
                        <a class="btn" href="<?= site_url('customers/edit/' . $customer->id) ?>">Edit</a>
                        <a class="btn btn-danger" href="<?= site_url('customers/delete/' . $customer->id) ?>" onclick="return confirm('Hapus pelanggan ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
