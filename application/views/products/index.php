<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card">
    <div class="card-title">
        <div>
            <h3>Daftar Produk</h3>
            <p>Data produk lengkap dengan kategori, harga, dan stok terkini.</p>
        </div>
        <a class="btn" href="<?= site_url('master-data/products/create') ?>">Tambah Produk</a>
    </div>
    <?php if (!empty($products)): ?>
        <div class="table-wrap">
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
                            <td>#<?= $product->id ?></td>
                            <td><?= $product->name ?></td>
                            <td><?= $product->category_name ?></td>
                            <td>Rp <?= number_format($product->price, 0, ',', '.') ?></td>
                            <td><?= $product->stock ?></td>
                            <td>
                                <div class="stack-actions">
                                    <a class="btn btn-sm" href="<?= site_url('master-data/products/edit/' . $product->id) ?>">Edit</a>
                                    <a class="btn btn-danger btn-sm" href="<?= site_url('master-data/products/delete/' . $product->id) ?>" onclick="return confirm('Hapus produk ini?')">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <strong>Belum ada produk</strong>
            Tambahkan produk supaya kasir bisa mulai melakukan transaksi.
        </div>
    <?php endif; ?>
</div>
