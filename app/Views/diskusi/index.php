<?php
/** @var array<int, array<string, mixed>> $items */
/** @var array $errors */
/** @var array $old */
?>
<section class="section">
    <div class="section-header">
        <div>
            <h1 class="section-title">Forum Diskusi ASN</h1>
            <p class="section-subtitle">Kolaborasi lintas OPD untuk menyelesaikan isu dan berbagi ide inovatif.</p>
        </div>
        <div class="section-actions">
            <a class="button button--primary" href="/diskusi/create">+ Diskusi Baru</a>
        </div>
    </div>

    <?php if (empty($items)): ?>
        <div class="empty-state">
            <h2>Tidak ada diskusi</h2>
            <p>Mulailah percakapan pertama Anda dengan membuat diskusi baru.</p>
            <a class="button button--primary" href="/diskusi/create">Buat Diskusi</a>
        </div>
    <?php else: ?>
        <div class="table-wrapper">
            <table class="table">
                <thead>
                <tr>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td>
                            <a class="table-link" href="/diskusi/<?= e((string) $item['id']) ?>">
                                <?= e($item['judul']) ?>
                            </a>
                        </td>
                        <td><?= e($item['penulis']) ?></td>
                        <td><?= e(format_datetime($item['created_at'])) ?></td>
                        <td class="table-actions">
                            <a class="action-link" href="/diskusi/<?= e((string) $item['id']) ?>">Detail</a>
                            <a class="action-link" href="/diskusi/<?= e((string) $item['id']) ?>/edit">Ubah</a>
                            <form method="POST" action="/diskusi/<?= e((string) $item['id']) ?>" onsubmit="return confirm('Hapus diskusi ini?');">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="action-link action-link--danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</section>
