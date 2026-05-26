<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card">
    <?= validation_errors('<div class="alert">', '</div>'); ?>
    <form method="post" action="<?= current_url() ?>">
        <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" name="name" value="<?= set_value('name', $category->name ?? '') ?>" required>
        </div>
        <button class="btn" type="submit">Simpan</button>
    </form>
</div>
