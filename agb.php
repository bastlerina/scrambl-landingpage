<?php
require_once __DIR__ . '/i18n.php';
$pageTitle = t('meta.agb_title');
$pageDescription = t('meta.agb_description');
$currentPage = 'agb';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/nav.php';
?>

  <section class="section section-white" style="margin-top:64px;">
    <div class="container" style="max-width:900px; padding-top: 9.75rem;">
<?php
$agbLang = in_array(current_lang(), ['en', 'fr'], true) ? current_lang() : 'de';
$agbHead = [
    'de' => ['Allgemeine Geschäftsbedingungen', 'Von Scrambl. | Aktualisiert: 01.01.2026'],
    'en' => ['General Terms and Conditions', 'By Scrambl. | Last updated: 1 January 2026'],
    'fr' => ['Conditions générales', 'Par Scrambl. | Dernière mise à jour : 01.01.2026'],
][$agbLang];
?>
      <h1 style="margin-bottom:0.5rem;"><?= title_dot($agbHead[0], 'green') ?></h1>
      <p class="section-sub"><?= h($agbHead[1]) ?></p>
      <?php if (current_lang() !== 'de'): ?>
      <p class="section-sub" style="font-style:italic;"><?= h(t('legal.note')) ?></p>
      <?php endif; ?>

      <div class="legal-content">
<?php include __DIR__ . '/partials/legal/agb-' . $agbLang . '.php'; ?>
      </div>
    </div>
  </section>

<?php include __DIR__ . '/partials/footer.php'; ?>
