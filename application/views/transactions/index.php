<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php if (!empty($error)): ?>
    <div class="alert"><?= nl2br(html_escape($error)) ?></div>
<?php endif; ?>
<div class="card">
    <form method="get" action="<?= site_url('transaksi') ?>">
        <div class="toolbar">
            <div class="toolbar-search">
                <input type="text" name="search" value="<?= html_escape($search) ?>" placeholder="Cari nama produk atau ID...">
            </div>
            <div class="toolbar-actions">
                <button class="btn" type="submit">Cari Produk</button>
                <a class="btn btn-secondary" href="<?= site_url('transaksi') ?>">Reset</a>
            </div>
        </div>
    </form>
</div>
<div class="card">
    <h3>Hasil Pencarian Produk</h3>
    <?php if (!empty($products)): ?>
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
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
                            <td>Rp <?= number_format($product->price, 0, ',', '.') ?></td>
                            <td><?= $product->stock ?></td>
                            <td>
                                <form method="post" action="<?= site_url('transaksi/tambah') ?>" class="inline-form">
                                    <input type="hidden" name="product_id" value="<?= $product->id ?>">
                                    <input class="input-qty" type="number" name="quantity" value="1" min="1">
                                    <button class="btn" type="submit">Tambah</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p>Tidak ada produk ditemukan.</p>
    <?php endif; ?>
</div>
<div class="card">
    <h3>Keranjang</h3>
    <?php if (!empty($cart)): ?>
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($cart as $item): ?>
                        <?php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; ?>
                        <tr>
                            <td><?= $item['name'] ?></td>
                            <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                            <td><a class="btn btn-danger" href="<?= site_url('transaksi/hapus/' . $item['id']) ?>">Hapus</a></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3"><strong>Total</strong></td>
                        <td colspan="2"><strong>Rp <?= number_format($total, 0, ',', '.') ?></strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <form method="post" action="<?= site_url('transaksi/checkout') ?>">
            <div class="form-group">
                <label>Pelanggan</label>
                <select name="customer_id" required>
                    <option value="">-- Pilih Pelanggan --</option>
                    <?php foreach ($customers as $customer): ?>
                        <option value="<?= $customer->id ?>"><?= $customer->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Bayar</label>
                <input type="number" name="amount_paid" step="0.01" required>
            </div>
            <div class="form-group">
                <button class="btn" type="submit">Bayar</button>
                <a class="btn btn-secondary" href="<?= site_url('transaksi/bersihkan') ?>">Bersihkan Keranjang</a>
            </div>
        </form>
    <?php else: ?>
        <p>Keranjang kosong. Tambahkan produk terlebih dahulu.</p>
    <?php endif; ?>
</div>
