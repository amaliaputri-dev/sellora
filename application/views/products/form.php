<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card">
    <?= validation_errors('<div class="alert">', '</div>'); ?>
    <form method="post" action="<?= current_url() ?>">
        <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" name="name" value="<?= set_value('name', $product->name ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label>Kategori</label>
            <select name="category_id" required>
                <option value="">-- Pilih Kategori --</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category->id ?>" <?= set_select('category_id', $category->id, isset($product) && $product->category_id == $category->id) ?>><?= $category->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="price" value="<?= set_value('price', $product->price ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stock" value="<?= set_value('stock', $product->stock ?? '') ?>" required>
        </div>
        <button class="btn" type="submit">Simpan</button>
    </form>
</div>
