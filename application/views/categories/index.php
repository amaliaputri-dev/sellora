<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card">
    <a class="btn" href="<?= site_url('categories/create') ?>">Tambah Kategori</a>
</div>
<div class="card">
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
                    <td><?= $category->id ?></td>
                    <td><?= $category->name ?></td>
                    <td>
                        <a class="btn" href="<?= site_url('categories/edit/' . $category->id) ?>">Edit</a>
                        <a class="btn btn-danger" href="<?= site_url('categories/delete/' . $category->id) ?>" onclick="return confirm('Hapus kategori ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
