<?php
/** @var array $errors */
/** @var array $old */
/** @var array $diskusi */
?>
<section class="section section--narrow">
    <header class="section-header">
        <div>
            <h1 class="section-title">Perbarui Diskusi</h1>
            <p class="section-subtitle">Sesuaikan detail diskusi agar tetap relevan dengan perkembangan terbaru.</p>
        </div>
    </header>

    <form method="POST" action="/diskusi/<?= e((string) $diskusi['id']) ?>" class="form">
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group<?= isset($errors['judul']) ? ' form-group--error' : '' ?>">
            <label for="judul" class="form-label">Judul Diskusi</label>
            <input type="text" id="judul" name="judul" class="form-input" value="<?= e($old['judul'] ?? $diskusi['judul']) ?>" required>
            <?php if (isset($errors['judul'])): ?>
                <p class="form-error"><?= e($errors['judul']) ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group<?= isset($errors['penulis']) ? ' form-group--error' : '' ?>">
            <label for="penulis" class="form-label">Penulis / Unit Pengusul</label>
            <input type="text" id="penulis" name="penulis" class="form-input" value="<?= e($old['penulis'] ?? $diskusi['penulis']) ?>" required>
            <?php if (isset($errors['penulis'])): ?>
                <p class="form-error"><?= e($errors['penulis']) ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group<?= isset($errors['isi']) ? ' form-group--error' : '' ?>">
            <label for="isi" class="form-label">Isi Diskusi</label>
            <textarea id="isi" name="isi" rows="6" class="form-textarea" required><?= e($old['isi'] ?? $diskusi['isi']) ?></textarea>
            <?php if (isset($errors['isi'])): ?>
                <p class="form-error"><?= e($errors['isi']) ?></p>
            <?php endif; ?>
        </div>

        <div class="form-actions">
            <a class="button" href="/diskusi">Batal</a>
            <button type="submit" class="button button--primary">Perbarui</button>
        </div>
    </form>
</section>
