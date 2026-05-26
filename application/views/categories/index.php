<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card">
    <div class="card-title">
        <div>
            <h3>Daftar Kategori</h3>
            <p>Kelola pengelompokan produk agar pencarian dan stok lebih rapi.</p>
        </div>
        <a class="btn" href="<?= site_url('master-data/categories/create') ?>">Tambah Kategori</a>
    </div>
    <?php if (!empty($categories)): ?>
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td>#<?= $category->id ?></td>
                            <td><?= $category->name ?></td>
                            <td>
                                <div class="stack-actions">
                                    <a class="btn btn-sm" href="<?= site_url('master-data/categories/edit/' . $category->id) ?>">Edit</a>
                                    <a class="btn btn-danger btn-sm" href="<?= site_url('master-data/categories/delete/' . $category->id) ?>" onclick="return confirm('Hapus kategori ini?')">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <strong>Belum ada kategori</strong>
            Tambahkan kategori pertama untuk mulai mengelompokkan produk.
        </div>
    <?php endif; ?>
</div>
