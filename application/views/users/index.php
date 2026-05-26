<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php if (!empty($message)): ?>
    <div class="alert"><?= html_escape($message) ?></div>
<?php endif; ?>
<div class="card">
    <a class="btn" href="<?= site_url('akun/users/create') ?>">Tambah User</a>
</div>
<div class="card">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= html_escape($user->username) ?></td>
                        <td><?= html_escape(strtoupper($user->role)) ?></td>
                        <td><?= $user->created_at ?></td>
                        <td>
                            <a class="btn" href="<?= site_url('akun/users/edit/' . $user->id) ?>">Edit</a>
                            <?php if ((int) $current_user->id !== (int) $user->id): ?>
                                <a class="btn btn-danger" href="<?= site_url('akun/users/delete/' . $user->id) ?>" onclick="return confirm('Hapus user ini?')">Hapus</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
