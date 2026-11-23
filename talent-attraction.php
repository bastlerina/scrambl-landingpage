<?php
require_once __DIR__ . '/i18n.php';
$pageTitle = t('meta.talent_attraction_title');
$pageDescription = t('meta.talent_attraction_description');
$currentPage = 'talent-attraction';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/nav.php';
?>

  <!-- ① HERO – türkis, zentriert -->
  <section class="hero-page">
    <div class="container">
      <h1><?= title_dot(t('ta.hero.title'), 'green') ?></h1>
      <p><?= h(t('ta.hero.text')) ?></p>
      <a href="<?= h(HUBSPOT_MEETING_URL) ?>" target="_blank" rel="noopener" class="btn btn-dark" style="display:inline-block;"><?= h(t('ta.hero.cta')) ?></a>
    </div>
  </section>
  <!-- ② STATS – weiß, zentriert -->
  <section class="section section-white">
    <div class="container">
      <h2 class="section-title-center"><?= title_dot(t('ta.stats.title'), 'green') ?></h2>
      <div class="stat-boxes">
        <div class="stat-box">
          <div class="stat-big"><?= h(t('ta.stats.box1.num')) ?></div>
          <div class="stat-desc"><?= h(t('ta.stats.box1.text')) ?></div>
        </div>
        <div class="stat-box">
          <div class="stat-big"><?= h(t('ta.stats.box2.num')) ?></div>
          <div class="stat-desc"><?= h(t('ta.stats.box2.text')) ?></div>
        </div>
        <div class="stat-box">
          <div class="stat-big"><?= h(t('ta.stats.box3.num')) ?></div>
          <div class="stat-desc"><?= h(t('ta.stats.box3.text')) ?></div>
        </div>
        <div class="stat-box">
          <div class="stat-big"><?= h(t('ta.stats.box4.num')) ?></div>
          <div class="stat-desc"><?= h(t('ta.stats.box4.text')) ?></div>
        </div>
      </div>
    </div>
  </section>
  <!-- ③ PROBLEM – türkis, linksbündig -->
  <section class="section section-teal">
    <div class="container">
      <h2 class="section-title-center teal-text"><?= title_dot(t('ta.problem.title'), 'green') ?></h2>
      <p class="section-sub-white" style="text-align:center; max-width:640px; margin-left:auto; margin-right:auto;"><?= h(t('ta.problem.sub')) ?></p>
      <div class="cards-4">
        <div class="card">
          <?php card_icon('megaphone'); ?>
          <h3><?= h(t('ta.problem.card1.title')) ?></h3>
          <p><?= h(t('ta.problem.card1.text')) ?></p>
        </div>
        <div class="card">
          <?php card_icon('funnel'); ?>
          <h3><?= h(t('ta.problem.card2.title')) ?></h3>
          <p><?= h(t('ta.problem.card2.text')) ?></p>
        </div>
        <div class="card">
          <?php card_icon('coin'); ?>
          <h3><?= h(t('ta.problem.card3.title')) ?></h3>
          <p><?= h(t('ta.problem.card3.text')) ?></p>
        </div>
        <div class="card">
          <?php card_icon('database'); ?>
          <h3><?= h(t('ta.problem.card4.title')) ?></h3>
          <p><?= h(t('ta.problem.card4.text')) ?></p>
        </div>
      </div>
    </div>
  </section>
  <!-- ④ LÖSUNG – helltürkis, linksbündig, 3 sichtbare Blöcke -->
  <section class="section section-mint">
    <div class="container-wide">
      <h2 class="section-title-center"><?= title_dot(t('ta.solution.title'), 'green') ?></h2>
      <div class="solution-blocks">
        <div class="solution-block">
          <img src="images/WEbsite_Story_frontal.jpg" alt="<?= h(t('ta.solution.block1.tag')) ?>">
          <div class="card-tag"><?= h(t('ta.solution.block1.tag')) ?></div>
          <h3><?= h(t('ta.solution.block1.title')) ?></h3>
          <p><strong><?= h(t('ta.solution.block1.lead')) ?>:</strong> <?= h(t('ta.solution.block1.text1')) ?> <?= h(t('ta.solution.block1.text2')) ?></p>
          <div class="solution-benefits-label"><?= h(t('ta.solution.benefits_label')) ?></div>
          <ul class="card-bullets mt-sm">
            <li><?= h(t('ta.solution.block1.bullet1')) ?></li>
            <li><?= h(t('ta.solution.block1.bullet2')) ?></li>
            <li><?= h(t('ta.solution.block1.bullet3')) ?></li>
          </ul>
          <button type="button" class="btn btn-outline btn-sm solution-cta" data-offer-open="slot"><?= h(t('ta.solution.offer_cta')) ?></button>
        </div>
        <div class="solution-block">
          <img src="images/WEbsite_ActiveSourcing_spider.jpg" alt="<?= h(t('ta.solution.block2.tag')) ?>">
          <div class="card-tag"><?= h(t('ta.solution.block2.tag')) ?></div>
          <h3><?= h(t('ta.solution.block2.title')) ?></h3>
          <p><strong><?= h(t('ta.solution.block2.lead')) ?>:</strong> <?= h(t('ta.solution.block2.text1')) ?> <?= h(t('ta.solution.block2.text2')) ?></p>
          <div class="solution-benefits-label"><?= h(t('ta.solution.benefits_label')) ?></div>
          <ul class="card-bullets mt-sm">
            <li><?= h(t('ta.solution.block2.bullet1')) ?></li>
            <li><?= h(t('ta.solution.block2.bullet2')) ?></li>
            <li><?= h(t('ta.solution.block2.bullet3')) ?></li>
          </ul>
          <button type="button" class="btn btn-outline btn-sm solution-cta" data-offer-open="credit"><?= h(t('ta.solution.offer_cta')) ?></button>
        </div>
        <div class="solution-block">
          <img src="images/WEbsite_talentpool.jpg" alt="<?= h(t('ta.solution.block3.tag')) ?>">
          <div class="card-tag"><?= h(t('ta.solution.block3.tag')) ?></div>
          <h3><?= h(t('ta.solution.block3.title')) ?></h3>
          <p><strong><?= h(t('ta.solution.block3.lead')) ?>:</strong> <?= h(t('ta.solution.block3.text1')) ?> <?= h(t('ta.solution.block3.text2')) ?></p>
          <div class="solution-benefits-label"><?= h(t('ta.solution.benefits_label')) ?></div>
          <ul class="card-bullets mt-sm">
            <li><?= h(t('ta.solution.block3.bullet1')) ?></li>
            <li><?= h(t('ta.solution.block3.bullet2')) ?></li>
            <li><?= h(t('ta.solution.block3.bullet3')) ?></li>
          </ul>
          <button type="button" class="btn btn-outline btn-sm solution-cta" data-offer-open="pool"><?= h(t('ta.solution.offer_cta')) ?></button>
        </div>
      </div>
    </div>
  </section>
  <!-- ⑤ PROZESS – türkis, linksbündig -->
  <section class="section section-teal">
    <div class="container">
      <h2 class="section-title-center teal-text"><?= title_dot(t('ta.process.title'), 'teal') ?></h2>
      <div class="process-steps">
        <div class="process-step">
          <div class="step-num">1</div>
          <div class="step-content">
            <h3><?= h(t('ta.process.step1.title')) ?></h3>
            <p><?= h(t('ta.process.step1.text')) ?></p>
            <ul>
              <li><?= h(t('ta.process.step1.li1')) ?></li>
              <li><?= h(t('ta.process.step1.li2')) ?></li>
            </ul>
          </div>
          <div class="step-img"><img src="images/prozess/Anforderungen-definieren-1.png" alt="<?= h(t('ta.process.step1.title')) ?>" loading="lazy"></div>
        </div>
        <div class="process-step">
          <div class="step-num">2</div>
          <div class="step-content">
            <h3><?= h(t('ta.process.step2.title')) ?></h3>
            <p><?= h(t('ta.process.step2.text')) ?></p>
            <ul>
              <li><?= h(t('ta.process.step2.li1')) ?></li>
              <li><?= h(t('ta.process.step2.li2')) ?></li>
            </ul>
          </div>
          <div class="step-img"><img src="images/prozess/Reichweite-steigern-2.png" alt="<?= h(t('ta.process.step2.title')) ?>" loading="lazy"></div>
        </div>
        <div class="process-step">
          <div class="step-num">3</div>
          <div class="step-content">
            <h3><?= h(t('ta.process.step3.title')) ?></h3>
            <p><?= h(t('ta.process.step3.text')) ?></p>
            <ul>
              <li><?= h(t('ta.process.step3.li1')) ?></li>
            </ul>
          </div>
          <div class="step-img"><img src="images/prozess/Talente-finden-3.png" alt="<?= h(t('ta.process.step3.title')) ?>" loading="lazy"></div>
        </div>
        <div class="process-step">
          <div class="step-num">4</div>
          <div class="step-content">
            <h3><?= h(t('ta.process.step4.title')) ?></h3>
            <p><?= h(t('ta.process.step4.text')) ?></p>
            <ul>
              <li><?= h(t('ta.process.step4.li1')) ?></li>
              <li><?= h(t('ta.process.step4.li2')) ?></li>
            </ul>
          </div>
          <div class="step-img"><img src="images/prozess/Erlebnis-optimieren-4.png" alt="<?= h(t('ta.process.step4.title')) ?>" loading="lazy"></div>
        </div>
        <div class="process-step">
          <div class="step-num">5</div>
          <div class="step-content">
            <h3><?= h(t('ta.process.step5.title')) ?></h3>
            <p><?= h(t('ta.process.step5.text')) ?></p>
            <ul>
              <li><?= h(t('ta.process.step5.li1')) ?></li>
              <li><?= h(t('ta.process.step5.li2')) ?></li>
            </ul>
          </div>
          <div class="step-img"><img src="images/prozess/Talente-vorselektieren-5.png" alt="<?= h(t('ta.process.step5.title')) ?>" loading="lazy"></div>
        </div>
        <div class="process-step">
          <div class="step-num">6</div>
          <div class="step-content">
            <h3><?= h(t('ta.process.step6.title')) ?></h3>
            <p><?= h(t('ta.process.step6.text')) ?></p>
            <ul>
              <li><?= h(t('ta.process.step6.li1')) ?></li>
              <li><?= h(t('ta.process.step6.li2')) ?></li>
            </ul>
          </div>
          <div class="step-img"><img src="images/prozess/Beziehungen-aufbauen-6.png" alt="<?= h(t('ta.process.step6.title')) ?>" loading="lazy"></div>
        </div>
      </div>
      <div class="mt-lg" style="text-align:center;">
        <a href="<?= h(HUBSPOT_MEETING_URL) ?>" target="_blank" rel="noopener" class="btn btn-outline"><?= h(t('ta.process.cta')) ?></a>
      </div>
    </div>
  </section>
  <!-- ⑤b FAQ – weiss, linksbündig -->
  <section class="section section-white section-faq">
    <div class="container-sm">
      <h2 class="section-title-left"><?= title_dot(t('ta.faq.title'), 'teal') ?></h2>
      <div class="faq">
        <?php for ($i = 1; $i <= 5; $i++): ?>
        <div class="faq-item"><div class="faq-q"><?= h(t("ta.faq.q$i")) ?></div><p class="faq-a"><?= h(t("ta.faq.a$i")) ?></p></div>
        <?php endfor; ?>
      </div>
    </div>
    <?php faq_schema('ta.faq.', 5); ?>
  </section>
  <!-- ⑥ FOOTER CTA – türkis, zentriert -->
  <section class="section section-teal section-last" id="kontakt">
    <div class="container-sm" style="text-align:center; max-width:900px;">
      <h2 class="teal-text"><?= title_dot(t('ta.cta.title'), 'teal') ?></h2>
      <p class="section-sub-white" style="margin-top:0.5rem;"><?= h(t('ta.cta.text')) ?></p>
      <?php include __DIR__ . '/partials/contact-form.php'; ?>
    </div>
  </section>


<?php include __DIR__ . '/partials/offer-modal.php'; ?>

<?php include __DIR__ . '/partials/footer.php'; ?>
