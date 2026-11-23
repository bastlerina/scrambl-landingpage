<?php
require_once __DIR__ . '/i18n.php';
$pageTitle = t('meta.datenschutz_title');
$pageDescription = t('meta.datenschutz_description');
$currentPage = 'datenschutz';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/nav.php';
?>

  <section class="section section-white section-last" style="margin-top:64px;">
    <div class="container" style="max-width:900px; padding-top: 9.75rem;">
<?php
// Sprachfassungen: vorhandene Uebersetzung, sonst Deutsch
$dsLang = (current_lang() !== 'de' && is_file(__DIR__ . '/partials/legal/datenschutz-' . current_lang() . '.php')) ? current_lang() : 'de';
$dsTitle = ['de' => 'Datenschutzrichtlinien', 'en' => 'Privacy Policy', 'fr' => 'Politique de confidentialité'][$dsLang];
?>
      <h1 style="margin-bottom:0.5rem;"><?= title_dot($dsTitle, 'green') ?></h1>
      <?php if (current_lang() !== 'de'): ?>
      <p class="section-sub" style="font-style:italic;"><?= h(t('legal.note')) ?></p>
      <?php endif; ?>

      <div class="legal-content">
<?php include __DIR__ . '/partials/legal/datenschutz-' . $dsLang . '.php'; ?>
      </div>
    </div>
  </section>

<?php include __DIR__ . '/partials/footer.php'; ?>
