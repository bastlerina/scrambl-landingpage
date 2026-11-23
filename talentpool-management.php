<?php
require_once __DIR__ . '/i18n.php';
$pageTitle = t('meta.talentpool_management_title');
$pageDescription = t('meta.talentpool_management_description');
$currentPage = 'talentpool-management';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/nav.php';
?>

  <!-- ① HERO – türkis, zentriert -->
  <section class="hero-page">
    <div class="container">
      <h1><?= title_dot(t('tpm.hero.title'), 'green') ?></h1>
      <p><?= h(t('tpm.hero.text')) ?></p>
      <a href="<?= h(HUBSPOT_MEETING_URL) ?>" target="_blank" rel="noopener" class="btn btn-dark" style="display:inline-block;"><?= h(t('tpm.hero.cta')) ?></a>
    </div>
  </section>
  <!-- ② PROBLEM – helltürkis, zentriert, 3 Karten -->
  <section class="section section-mint">
    <div class="container">
      <h2 class="section-title-center"><?= title_dot(t('tpm.problem.title'), 'green') ?></h2>
      <div class="cards-3">
        <div class="card">
          <?php card_icon('clock'); ?>
          <h3><?= h(t('tpm.problem.card1.title')) ?></h3>
          <p><?= h(t('tpm.problem.card1.text')) ?></p>
        </div>
        <div class="card">
          <?php card_icon('funnel'); ?>
          <h3><?= h(t('tpm.problem.card2.title')) ?></h3>
          <p><?= h(t('tpm.problem.card2.text')) ?></p>
        </div>
        <div class="card">
          <?php card_icon('warning'); ?>
          <h3><?= h(t('tpm.problem.card3.title')) ?></h3>
          <p><?= h(t('tpm.problem.card3.text')) ?></p>
        </div>
      </div>
    </div>
  </section>
  <!-- ④ ZWISCHEN-CTA – helltürkis, zentriert -->
  <section class="section section-mint section-balanced">
    <div class="container" style="text-align:center;">
      <img src="images/mockup-front-stellen.png" alt="<?= h(t('tpm.hero.title')) ?>" loading="lazy" class="img-before-title img-laptop">
      <h2><?= title_dot(t('tpm.midcta.title'), 'teal') ?></h2>
      <div class="mt-md">
        <a href="<?= h(HUBSPOT_MEETING_URL) ?>" target="_blank" rel="noopener" class="btn btn-dark" style="display:inline-block;"><?= h(t('tpm.midcta.cta')) ?></a>
      </div>
    </div>
  </section>
  <!-- ⑤ FEATURES – weiss, 4 Karten -->
  <section class="section section-white">
    <div class="container">
      <h2 class="section-title-center"><?= title_dot(t('tpm.features.title'), 'teal') ?></h2>
      <div class="cards-4">
        <div class="card">
          <?php card_icon('refresh'); ?>
          <h3><?= h(t('tpm.features.card1.title')) ?></h3>
          <p><?= h(t('tpm.features.card1.text')) ?></p>
        </div>
        <div class="card">
          <?php card_icon('tag'); ?>
          <h3><?= h(t('tpm.features.card2.title')) ?></h3>
          <p><?= h(t('tpm.features.card2.text')) ?></p>
        </div>
        <div class="card">
          <?php card_icon('database'); ?>
          <h3><?= h(t('tpm.features.card3.title')) ?></h3>
          <p><?= h(t('tpm.features.card3.text')) ?></p>
        </div>
        <div class="card">
          <?php card_icon('building'); ?>
          <h3><?= h(t('tpm.features.card4.title')) ?></h3>
          <p><?= h(t('tpm.features.card4.text')) ?></p>
        </div>
      </div>
      <div class="mt-lg" style="text-align:center;">
        <a href="<?= h(HUBSPOT_MEETING_URL) ?>" target="_blank" rel="noopener" class="btn btn-outline"><?= h(t('tpm.hero.cta')) ?></a>
      </div>
    </div>
  </section>
  <!-- ⑥ SOCIAL PROOF – türkis, zentriert -->
  <section class="section section-teal">
    <div class="container-sm" style="text-align:center;">
      <h2><?= title_dot(t('tpm.social.title'), 'green') ?></h2>
      <p class="section-sub" style="margin-top:0.5rem;"><?= h(t('tpm.social.text')) ?></p>
      <div class="mt-md">
        <a href="<?= h(HUBSPOT_MEETING_URL) ?>" target="_blank" rel="noopener" class="btn btn-outline"><?= h(t('tpm.social.cta')) ?></a>
      </div>
    </div>
  </section>
  <!-- ⑦ ABSCHLUSS + FORMULAR – helltürkis, zentriert -->
  <section class="section section-mint section-last" id="kontakt">
    <div class="container-sm" style="text-align:center;">
      <h2><?= title_dot(t('tpm.cta.title'), 'teal') ?></h2>
      <p class="section-sub" style="margin-top:0.5rem;"><?= h(t('tpm.cta.text')) ?></p>
      <?php $formButtonKey = 'form.cta_video'; include __DIR__ . '/partials/contact-form.php'; ?>
    </div>
  </section>

<?php include __DIR__ . '/partials/footer.php'; ?>
