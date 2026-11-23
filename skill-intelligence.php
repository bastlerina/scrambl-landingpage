<?php
require_once __DIR__ . '/i18n.php';
$pageTitle = t('meta.skill_intelligence_title');
$pageDescription = t('meta.skill_intelligence_description');
$currentPage = 'skill-intelligence';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/nav.php';
?>

  <!-- HERO -->
  <section class="hero-page">
    <div class="container">
      <h1 style="max-width:720px; margin-left:auto; margin-right:auto;"><?= title_dot(t('si.hero.title'), 'green') ?></h1>
      <p><?= h(t('si.hero.text')) ?></p>
      <a href="<?= h(HUBSPOT_MEETING_URL) ?>" target="_blank" rel="noopener" class="btn btn-dark"><?= h(t('si.hero.cta')) ?></a>
    </div>
  </section>
  <!-- DATEN SECTION -->
  <section class="section section-white">
    <div class="container">
      <h2 class="section-title-center"><?= title_dot(t('si.data.title'), 'green') ?></h2>
      <div class="stat-boxes">
        <div class="stat-box">
          <div class="stat-big"><?= h(t('si.data.stat1.num')) ?></div>
          <div class="stat-desc"><?= t('si.data.stat1.label') ?></div>
        </div>
        <div class="stat-box">
          <div class="stat-big"><?= h(t('si.data.stat2.num')) ?></div>
          <div class="stat-desc"><?= t('si.data.stat2.label') ?></div>
        </div>
        <div class="stat-box">
          <div class="stat-big"><?= h(t('si.data.stat3.num')) ?></div>
          <div class="stat-desc"><?= t('si.data.stat3.label') ?></div>
        </div>
        <div class="stat-box">
          <div class="stat-big"><?= h(t('si.data.stat4.num')) ?></div>
          <div class="stat-desc"><?= t('si.data.stat4.label') ?></div>
        </div>
      </div>
      <img src="images/skillintelligence/skills-berufe.svg" alt="" loading="lazy" class="si-berufe-img">
    </div>
  </section>
  <!-- WISSENSMODELL SECTION -->
  <section class="section section-white">
    <div class="container">
      <h2 class="section-title-center"><?= title_dot(t('si.model.title'), 'green') ?></h2>
      <p class="section-sub" style="max-width:900px; text-align:center; margin-left:auto; margin-right:auto;"><?= h(t('si.model.text')) ?></p>
      <div class="feat-list" style="max-width:640px; margin-left:auto; margin-right:auto;">
        <div class="feat-row"><div class="feat-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5L19 8"/></svg></div><span><?= h(t('si.model.feat1')) ?></span></div>
        <div class="feat-row"><div class="feat-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5L19 8"/></svg></div><span><?= h(t('si.model.feat2')) ?></span></div>
        <div class="feat-row"><div class="feat-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5L19 8"/></svg></div><span><?= h(t('si.model.feat3')) ?></span></div>
        <div class="feat-row"><div class="feat-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5L19 8"/></svg></div><span><?= h(t('si.model.feat4')) ?></span></div>
      </div>
      <p class="section-sub mt-md" style="max-width:900px; text-align:center; margin-left:auto; margin-right:auto;"><?= h(t('si.model.access_note')) ?></p>
      <div class="mt-lg" style="text-align:center;">
        <a href="<?= h(HUBSPOT_MEETING_URL) ?>" target="_blank" rel="noopener" class="btn btn-outline"><?= h(t('si.model.cta')) ?></a>
      </div>
    </div>
  </section>
  <!-- ZIELGRUPPEN -->
  <section class="section section-white">
    <div class="container">
      <h2 class="section-title-center"><?= title_dot(t('si.target.title'), 'green') ?></h2>
      <div class="si-target-list">
        <div class="card si-target-card">
          <div class="si-target-head">
            <h3><?= h(t('si.target.card1.title')) ?></h3>
            <p class="si-card-lead"><?= h(t('si.target.card1.lead')) ?></p>
          </div>
          <p class="si-target-text"><?= h(t('si.target.card1.text')) ?></p>
        </div>
        <div class="card si-target-card">
          <div class="si-target-head">
            <h3><?= h(t('si.target.card2.title')) ?></h3>
            <p class="si-card-lead"><?= h(t('si.target.card2.lead')) ?></p>
          </div>
          <p class="si-target-text"><?= h(t('si.target.card2.text')) ?></p>
        </div>
        <div class="card si-target-card">
          <div class="si-target-head">
            <h3><?= h(t('si.target.card3.title')) ?></h3>
            <p class="si-card-lead"><?= h(t('si.target.card3.lead')) ?></p>
          </div>
          <p class="si-target-text"><?= h(t('si.target.card3.text')) ?></p>
        </div>
      </div>
    </div>
  </section>
  <!-- LEISTUNGSMODULE -->
  <section class="section section-white">
    <div class="container">
      <h2 class="section-title-center"><?= title_dot(t('si.modules.title'), 'green') ?></h2>
      <div class="cards-3 si-cards">
        <div class="card si-module-card">
          <h3><?= h(t('si.modules.card1.title')) ?></h3>
          <p><?= h(t('si.modules.card1.text')) ?></p>
          <div class="si-example"><span><?= h(t('si.modules.example')) ?></span><?= h(t('si.modules.card1.example')) ?></div>
          <button type="button" class="btn btn-outline btn-sm si-module-cta" data-offer-open="infra"><?= h(t('ta.solution.offer_cta')) ?></button>
        </div>
        <div class="card si-module-card">
          <h3><?= h(t('si.modules.card2.title')) ?></h3>
          <p><?= h(t('si.modules.card2.text')) ?></p>
          <div class="si-example"><span><?= h(t('si.modules.example')) ?></span><?= h(t('si.modules.card2.example')) ?></div>
          <button type="button" class="btn btn-outline btn-sm si-module-cta" data-offer-open="saas"><?= h(t('ta.solution.offer_cta')) ?></button>
        </div>
        <div class="card si-module-card">
          <h3><?= h(t('si.modules.card3.title')) ?></h3>
          <p><?= h(t('si.modules.card3.text')) ?></p>
          <div class="si-example"><span><?= h(t('si.modules.example')) ?></span><?= h(t('si.modules.card3.example')) ?></div>
          <button type="button" class="btn btn-outline btn-sm si-module-cta" data-offer-open="intel"><?= h(t('ta.solution.offer_cta')) ?></button>
        </div>
      </div>
    </div>
  </section>
  <!-- CTA SECTION -->
  <section class="section section-teal section-tight-bottom" id="kontakt">
    <div class="container" style="text-align:center; max-width:1300px;">
      <h2 style="max-width:1200px; margin-left:auto; margin-right:auto;"><?= title_dot(t('si.cta.title'), 'teal') ?></h2>
      <?php $formButtonKey = 'form.cta_default'; $formButtonClass = 'btn-dark'; include __DIR__ . '/partials/contact-form.php'; ?>
    </div>
  </section>
  <!-- FAQ SECTION -->
  <section class="section section-white section-faq">
    <div class="container-sm">
      <h2 class="section-title-left"><?= title_dot(t('si.faq.title'), 'teal') ?></h2>
      <div class="faq">
        <?php for ($i = 1; $i <= 12; $i++): ?>
        <div class="faq-item"><div class="faq-q"><?= h(t("si.faq.q$i")) ?></div><p class="faq-a"><?= h(t("si.faq.a$i")) ?></p></div>
        <?php endfor; ?>
      </div>
    </div>
    <?php faq_schema('si.faq.', 12); ?>
  </section>
  <!-- NOCH FRAGEN -->
  <section class="section section-mint section-last">
    <div class="container-sm" style="text-align:center;">
      <h2><?= title_dot(t('si.contact.title'), 'teal') ?></h2>
      <p style="margin-bottom:2rem;"><?= h(t('si.contact.text')) ?></p>
      <?php $formButtonKey = 'form.cta_contact'; $formButtonClass = 'btn-dark'; include __DIR__ . '/partials/contact-form.php'; ?>
    </div>
  </section>

<?php
$offerTopic = 'Skill Intelligence';
$offerModules = [
    ['infra', 'Skill Intelligence – Skill-Infrastruktur as a Service', 'si.modules.card1.title', null],
    ['saas', 'Skill Intelligence – Skill-Matching SaaS', 'si.modules.card2.title', null],
    ['intel', 'Skill Intelligence – Skill Intelligence as a Service', 'si.modules.card3.title', null],
];
include __DIR__ . '/partials/offer-modal.php';
?>

<?php include __DIR__ . '/partials/footer.php'; ?>
