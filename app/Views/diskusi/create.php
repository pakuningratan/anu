<?php
/** @var array $errors */
/** @var array $old */
?>
<section class="section section--narrow">
    <header class="section-header">
        <div>
            <h1 class="section-title">Buat Diskusi Baru</h1>
            <p class="section-subtitle">Bagikan isu strategis atau ide inovatif untuk ditindaklanjuti bersama.</p>
        </div>
    </header>

    <form method="POST" action="/diskusi" class="form">
        <div class="form-group<?= isset($errors['judul']) ? ' form-group--error' : '' ?>">
            <label for="judul" class="form-label">Judul Diskusi</label>
            <input type="text" id="judul" name="judul" class="form-input" value="<?= e($old['judul'] ?? '') ?>" required>
            <?php if (isset($errors['judul'])): ?>
                <p class="form-error"><?= e($errors['judul']) ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group<?= isset($errors['penulis']) ? ' form-group--error' : '' ?>">
            <label for="penulis" class="form-label">Penulis / Unit Pengusul</label>
            <input type="text" id="penulis" name="penulis" class="form-input" value="<?= e($old['penulis'] ?? '') ?>" required>
            <?php if (isset($errors['penulis'])): ?>
                <p class="form-error"><?= e($errors['penulis']) ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group<?= isset($errors['isi']) ? ' form-group--error' : '' ?>">
            <label for="isi" class="form-label">Isi Diskusi</label>
            <textarea id="isi" name="isi" rows="6" class="form-textarea" required><?= e($old['isi'] ?? '') ?></textarea>
            <?php if (isset($errors['isi'])): ?>
                <p class="form-error"><?= e($errors['isi']) ?></p>
            <?php endif; ?>
        </div>

        <div class="form-actions">
            <a class="button" href="/diskusi">Batal</a>
            <button type="submit" class="button button--primary">Simpan Diskusi</button>
        </div>
    </form>
</section>
