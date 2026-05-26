<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card">
    <a class="btn" href="<?= site_url('master-data/products/create') ?>">Tambah Produk</a>
</div>
<div class="card">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product->id ?></td>
                    <td><?= $product->name ?></td>
                    <td><?= $product->category_name ?></td>
                    <td>Rp <?= number_format($product->price, 0, ',', '.') ?></td>
                    <td><?= $product->stock ?></td>
                    <td>
                        <a class="btn" href="<?= site_url('master-data/products/edit/' . $product->id) ?>">Edit</a>
                        <a class="btn btn-danger" href="<?= site_url('master-data/products/delete/' . $product->id) ?>" onclick="return confirm('Hapus produk ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
