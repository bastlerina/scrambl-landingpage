<?php
require_once __DIR__ . '/i18n.php';
$pageTitle = t('meta.talent_activation_title');
$pageDescription = t('meta.talent_activation_description');
$currentPage = 'talent-discovery';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/nav.php';
?>

  <!-- ① HERO – türkis, zentriert -->
  <section class="hero-page">
    <div class="container">
      <h1 style="max-width:720px; margin-left:auto; margin-right:auto;"><?= title_dot(t('taa.hero.title'), 'green') ?></h1>
      <p><?= h(t('taa.hero.text')) ?></p>
      <a href="<?= h(HUBSPOT_MEETING_URL) ?>" target="_blank" rel="noopener" class="btn btn-dark" style="display:inline-block;"><?= h(t('taa.hero.cta')) ?></a>
    </div>
  </section>
  <!-- ② PROBLEM – helltürkis, linksbündig -->
  <section class="section section-mint">
    <div class="container">
      <h2 class="section-title-center"><?= title_dot(t('taa.problem.title'), 'green') ?></h2>
      <p class="section-sub" style="text-align:center; max-width:640px; margin-left:auto; margin-right:auto;"><?= h(t('taa.problem.sub')) ?></p>
      <div class="cards-4">
        <div class="card">
          <?php card_icon('lost'); ?>
          <h3><?= h(t('taa.problem.card1.title')) ?></h3>
          <p><?= h(t('taa.problem.card1.text')) ?></p>
        </div>
        <div class="card">
          <?php card_icon('refresh'); ?>
          <h3><?= h(t('taa.problem.card2.title')) ?></h3>
          <p><?= h(t('taa.problem.card2.text')) ?></p>
        </div>
        <div class="card">
          <?php card_icon('warning'); ?>
          <h3><?= h(t('taa.problem.card3.title')) ?></h3>
          <p><?= h(t('taa.problem.card3.text')) ?></p>
        </div>
        <div class="card">
          <?php card_icon('building'); ?>
          <h3><?= h(t('taa.problem.card4.title')) ?></h3>
          <p><?= h(t('taa.problem.card4.text')) ?></p>
        </div>
      </div>
    </div>
  </section>
  <!-- ③ LÖSUNG – türkis, linksbündig, 4 Karten -->
  <section class="section section-teal">
    <div class="container">
      <img src="images/mockup-front-profil.png" alt="<?= h(t('taa.solution.title')) ?>" loading="lazy" class="img-before-title img-laptop img-before-title--top">
      <h2 class="section-title-center"><?= title_dot(t('taa.solution.title'), 'green') ?></h2>
      <p class="section-sub" style="text-align:center; max-width:640px; margin-left:auto; margin-right:auto;"><?= h(t('taa.solution.sub')) ?></p>
      <div class="tile-grid">
        <div class="tile-card">
          <div class="tile-num"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5L19 8"/></svg></div>
          <div>
            <h3><?= h(t('taa.solution.card1.title')) ?></h3>
            <p><?= h(t('taa.solution.card1.text')) ?></p>
          </div>
        </div>
        <div class="tile-card">
          <div class="tile-num"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5L19 8"/></svg></div>
          <div>
            <h3><?= h(t('taa.solution.card2.title')) ?></h3>
            <p><?= h(t('taa.solution.card2.text')) ?></p>
          </div>
        </div>
        <div class="tile-card">
          <div class="tile-num"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5L19 8"/></svg></div>
          <div>
            <h3><?= h(t('taa.solution.card3.title')) ?></h3>
            <p><?= h(t('taa.solution.card3.text')) ?></p>
          </div>
        </div>
        <div class="tile-card">
          <div class="tile-num"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5L19 8"/></svg></div>
          <div>
            <h3><?= h(t('taa.solution.card4.title')) ?></h3>
            <p><?= h(t('taa.solution.card4.text')) ?></p>
          </div>
        </div>
      </div>
      <div style="text-align:center; margin-top:2rem;">
        <button type="button" class="btn btn-outline" data-offer-open=""><?= h(t('ta.solution.offer_cta')) ?></button>
      </div>
    </div>
  </section>
  <!-- ④ PASST-SECTION – helltürkis, linksbündig -->
  <section class="section section-mint">
    <div class="container-sm">
      <h2 class="section-title-center"><?= title_dot(t('taa.fit.title'), 'teal') ?></h2>
      <p class="section-sub" style="text-align:center;"><?= h(t('taa.fit.sub')) ?></p>
      <div class="checklist">
        <label class="check-row">
          <input type="checkbox" />
          <div class="check-circle"></div>
          <span class="check-label"><?= h(t('taa.fit.check1')) ?></span>
        </label>
        <label class="check-row">
          <input type="checkbox" />
          <div class="check-circle"></div>
          <span class="check-label"><?= h(t('taa.fit.check2')) ?></span>
        </label>
        <label class="check-row">
          <input type="checkbox" />
          <div class="check-circle"></div>
          <span class="check-label"><?= h(t('taa.fit.check3')) ?></span>
        </label>
        <label class="check-row">
          <input type="checkbox" />
          <div class="check-circle"></div>
          <span class="check-label"><?= h(t('taa.fit.check4')) ?></span>
        </label>
        <label class="check-row">
          <input type="checkbox" />
          <div class="check-circle"></div>
          <span class="check-label"><?= h(t('taa.fit.check5')) ?></span>
        </label>
        <label class="check-row">
          <input type="checkbox" />
          <div class="check-circle"></div>
          <span class="check-label"><?= h(t('taa.fit.check6')) ?></span>
        </label>
      </div>
      <div class="check-hint" id="checkHint" data-checked-text="<?= h(t('taa.fit.hint_checked')) ?>">
        <?= h(t('taa.fit.hint')) ?>
      </div>
      <div class="mt-md">
        <a href="#kontakt" class="btn btn-outline"><?= h(t('taa.fit.cta')) ?></a>
      </div>
    </div>
  </section>
  <!-- ④.5 PERSONALDIENSTLEISTER & COACHES – türkis, zentriert, Modul mit Absprung -->
  <section class="section section-teal">
    <div class="container" style="text-align:center;">
      <h2><?= title_dot(t('taa.agencies.title'), 'teal') ?></h2>
      <p class="section-sub" style="margin-top:0.5rem;"><?= h(t('taa.agencies.text')) ?></p>
      <div class="mt-md">
        <a href="talentpool-management.php" class="btn btn-outline"><?= h(t('taa.agencies.cta')) ?></a>
      </div>
    </div>
  </section>
  <!-- ⑤ FAQ – türkis, linksbündig, einfache Text-Blöcke -->
  <section class="section section-teal section-faq">
    <div class="container-sm">
      <h2 class="section-title-left"><?= title_dot(t('taa.faq.title'), 'teal') ?></h2>
      <div class="faq">
        <div class="faq-item">
          <div class="faq-q"><?= h(t('taa.faq.q1')) ?></div>
          <p class="faq-a"><?= h(t('taa.faq.a1')) ?></p>
        </div>
        <div class="faq-item">
          <div class="faq-q"><?= h(t('taa.faq.q2')) ?></div>
          <p class="faq-a"><?= h(t('taa.faq.a2')) ?></p>
        </div>
        <div class="faq-item">
          <div class="faq-q"><?= h(t('taa.faq.q3')) ?></div>
          <p class="faq-a"><?= h(t('taa.faq.a3')) ?></p>
        </div>
        <div class="faq-item">
          <div class="faq-q"><?= h(t('taa.faq.q4')) ?></div>
          <p class="faq-a"><?= h(t('taa.faq.a4')) ?></p>
        </div>
        <div class="faq-item">
          <div class="faq-q"><?= h(t('taa.faq.q5')) ?></div>
          <p class="faq-a"><?= h(t('taa.faq.a5')) ?></p>
        </div>
        <div class="faq-item">
          <div class="faq-q"><?= h(t('taa.faq.q6')) ?></div>
          <p class="faq-a"><?= h(t('taa.faq.a6')) ?></p>
        </div>
        <div class="faq-item">
          <div class="faq-q"><?= h(t('taa.faq.q7')) ?></div>
          <p class="faq-a"><?= h(t('taa.faq.a7')) ?></p>
        </div>
        <div class="faq-item">
          <div class="faq-q"><?= h(t('taa.faq.q8')) ?></div>
          <p class="faq-a"><?= h(t('taa.faq.a8')) ?></p>
        </div>
      </div>
    </div>
    <?php faq_schema('taa.faq.', 8); ?>
  </section>
  <!-- ⑥ FOOTER CTA – helltürkis, zentriert -->
  <section class="section section-mint section-last" id="kontakt">
    <div class="container-sm" style="text-align:center;">
      <h2><?= title_dot(t('taa.cta.title'), 'teal') ?></h2>
      <p class="section-sub" style="margin-top:0.5rem;"><?= h(t('taa.cta.text')) ?></p>
      <?php include __DIR__ . '/partials/contact-form.php'; ?>
    </div>
  </section>

<?php $offerWithModules = false; $offerTopic = 'Talente entwickeln'; include __DIR__ . '/partials/offer-modal.php'; ?>

<?php include __DIR__ . '/partials/footer.php'; ?>
