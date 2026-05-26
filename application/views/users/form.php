<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card">
    <?php if (!empty($custom_error)): ?>
        <div class="alert"><?= html_escape($custom_error) ?></div>
    <?php endif; ?>
    <?= validation_errors('<div class="alert">', '</div>'); ?>
    <form method="post" action="<?= current_url() ?>">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="<?= set_value('username', $user_item->username ?? '') ?>" required>
        </div>
        <div class="form-group">
            <label>Role</label>
            <select name="role" required>
                <option value="admin" <?= set_select('role', 'admin', isset($user_item) && $user_item->role === 'admin') ?>>Admin</option>
                <option value="kasir" <?= set_select('role', 'kasir', isset($user_item) && $user_item->role === 'kasir') ?>>Kasir</option>
            </select>
        </div>
        <div class="form-group">
            <label>Password <?= !empty($user_item) ? '(kosongkan jika tidak diubah)' : '' ?></label>
            <input type="password" name="password" <?= empty($user_item) ? 'required' : '' ?>>
        </div>
        <button class="btn" type="submit">Simpan</button>
    </form>
</div>
