<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card">
    <?= validation_errors('<div class="alert">', '</div>'); ?>
    <form method="post" action="<?= current_url() ?>">
        <div class="form-group">
            <label>Nama Pelanggan</label>
            <input type="text" name="name" value="<?= set_value('name', $customer->name ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label>Telepon</label>
            <input type="text" name="phone" value="<?= set_value('phone', $customer->phone ?? '') ?>">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?= set_value('email', $customer->email ?? '') ?>">
        </div>
        <button class="btn" type="submit">Simpan</button>
    </form>
</div>
