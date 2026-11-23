<?php
require_once __DIR__ . '/i18n.php';
$pageTitle = t('meta.impressum_title');
$pageDescription = t('meta.impressum_description');
$currentPage = 'impressum';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/nav.php';
?>

  <section class="section section-white" style="margin-top:64px;">
    <div class="container-sm" style="padding-top: 9.75rem;">
      <h1 style="margin-bottom:1.5rem;"><?= title_dot('Impressum', 'green') ?></h1>
      <?php if (current_lang() !== 'de'): ?>
      <p class="section-sub" style="font-style:italic;"><?= h(t('legal.note')) ?></p>
      <?php endif; ?>

      <div class="legal-content">
        <p><strong>Name</strong><br>Scrambl. AG</p>
        <p><strong>Adresse</strong><br>Grosshofstrasse 9<br>c/o LUREVO Treuhand AG<br>6010 Kriens</p>
        <p><strong>E-Mail</strong><br><a href="mailto:community@scrambl.org">community@scrambl.org</a></p>
        <p><strong>UID</strong><br>CHE-240.007.713</p>
      </div>
    </div>
  </section>

<?php include __DIR__ . '/partials/footer.php'; ?>
