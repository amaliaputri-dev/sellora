<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php if (!empty($message)): ?>
    <div class="alert"><?= html_escape($message) ?></div>
<?php endif; ?>
<div class="card">
    <div class="card-title">
        <div>
            <h3>Manajemen User</h3>
            <p>Kelola akun admin dan kasir dari satu halaman.</p>
        </div>
        <a class="btn" href="<?= site_url('akun/users/create') ?>">Tambah User</a>
    </div>
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
                    <?php $badge_class = $user->role === 'admin' ? 'badge-admin' : 'badge-kasir'; ?>
                    <tr>
                        <td>#<?= $user->id ?></td>
                        <td><?= html_escape($user->username) ?></td>
                        <td><span class="badge <?= $badge_class ?>"><?= html_escape(strtoupper($user->role)) ?></span></td>
                        <td><?= $user->created_at ?></td>
                        <td>
                            <div class="stack-actions">
                                <a class="btn btn-sm" href="<?= site_url('akun/users/edit/' . $user->id) ?>">Edit</a>
                                <?php if ((int) $current_user->id !== (int) $user->id): ?>
                                    <a class="btn btn-danger btn-sm" href="<?= site_url('akun/users/delete/' . $user->id) ?>" onclick="return confirm('Hapus user ini?')">Hapus</a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
