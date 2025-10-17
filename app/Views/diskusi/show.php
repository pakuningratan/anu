<?php
/** @var array $diskusi */
?>
<section class="section section--narrow">
    <header class="section-header">
        <div>
            <h1 class="section-title"><?= e($diskusi['judul']) ?></h1>
            <p class="meta">Oleh <?= e($diskusi['penulis']) ?> · Diperbarui <?= e(format_datetime($diskusi['updated_at'])) ?></p>
        </div>
        <div class="section-actions">
            <a class="button" href="/diskusi/<?= e((string) $diskusi['id']) ?>/edit">Ubah</a>
            <form method="POST" action="/diskusi/<?= e((string) $diskusi['id']) ?>" onsubmit="return confirm('Hapus diskusi ini?');">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="button button--danger">Hapus</button>
            </form>
        </div>
    </header>

    <article class="card">
        <div class="card-body">
            <p><?= e($diskusi['isi']) ?></p>
        </div>
    </article>

    <div class="form-actions form-actions--space">
        <a class="button" href="/diskusi">← Kembali ke daftar diskusi</a>
    </div>
</section>
