<?php
require_once __DIR__ . '/i18n.php';
$pageTitle = t('meta.home_title');
$pageDescription = t('meta.home_description');
$currentPage = 'home';

$clientLogos = [
    ['file' => 'szkb', 'url' => 'https://www.szkb.ch'],
    ['file' => 'FuMo', 'url' => null],
    ['file' => 'usp', 'url' => 'https://www.united-security-providers.ch'],
    ['file' => 'Koeniz', 'url' => 'https://www.koeniz.ch'],
    ['file' => 'blkb', 'url' => 'https://www.blkb.ch'],
    ['file' => 'SLG', 'url' => null],
    ['file' => 'Ofelec', 'url' => null],
    ['file' => 'Certas', 'url' => null],
    ['file' => 'Pensimo', 'url' => 'https://www.pensimo.ch'],
    ['file' => 'Fedpol', 'url' => 'https://www.fedpol.admin.ch'],
    ['file' => 'Innova', 'url' => 'https://www.innova.ch'],
    ['file' => 'Autoform', 'url' => 'https://www.autoform.com'],
    ['file' => 'Helsana', 'url' => 'https://www.helsana.ch'],
    ['file' => 'Endress', 'url' => 'https://www.endress.com'],
    ['file' => 'Valantic', 'url' => 'https://www.valantic.com'],
    ['file' => 'Farner', 'url' => 'https://www.farner.ch'],
    ['file' => 'Guebelin', 'url' => 'https://www.gubelin.com'],
    ['file' => 'Infosystem', 'url' => null],
    ['file' => 'Mobility', 'url' => 'https://www.mobility.ch'],
    ['file' => 'schibli', 'url' => 'https://www.schibli.com'],
    ['file' => 'schneeberger', 'url' => 'https://www.schneeberger.com'],
    ['file' => 'Trafag', 'url' => 'https://www.trafag.com'],
    ['file' => 'Volvo', 'url' => 'https://www.volvogroup.com'],
    ['file' => 'ziemer', 'url' => 'https://www.ziemergroup.com'],
];

$testimonials = [
    ['quote' => t('home.testimonials.t1.quote'), 'author' => t('home.testimonials.t1.author'), 'role' => t('home.testimonials.t1.role')],
    ['quote' => t('home.testimonials.t2.quote'), 'author' => t('home.testimonials.t2.author'), 'role' => t('home.testimonials.t2.role')],
    ['quote' => t('home.testimonials.t3.quote'), 'author' => t('home.testimonials.t3.author'), 'role' => t('home.testimonials.t3.role')],
    ['quote' => t('home.testimonials.t4.quote'), 'author' => t('home.testimonials.t4.author'), 'role' => t('home.testimonials.t4.role')],
];

include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/nav.php';
?>

  <!-- ① HERO – linksbündig, Bild rechts -->
  <section class="hero-home">
    <div class="hero-inner">
      <div class="hero-text">
        <h1><?= t('home.hero.title') ?><span class="title-dot title-dot--green">.</span></h1>
        <p><?= h(t('home.hero.text')) ?></p>
        <a href="<?= h(HUBSPOT_MEETING_URL) ?>" target="_blank" rel="noopener" class="btn btn-dark"><?= h(t('home.hero.cta')) ?></a>
      </div>
      <div class="hero-img hero-img-photo"><img src="images/bildneuneu.png" alt="<?= h(t('home.hero.image_alt')) ?>"></div>
    </div>
  </section>
  <!-- ② PROBLEM – weiß, linksbündig -->
  <section class="section section-white">
    <div class="container-wide">
      <h2 class="section-title-center" style="max-width:760px; margin-left:auto; margin-right:auto;"><?= title_dot(t('home.problem.title'), 'green') ?></h2>
      <div class="cards-4">
        <div class="card">
          <?php card_icon('clock'); ?>
          <h3><?= h(t('home.problem.card1.title')) ?></h3>
          <p><?= h(t('home.problem.card1.text')) ?></p>
        </div>
        <div class="card">
          <?php card_icon('lost'); ?>
          <h3><?= h(t('home.problem.card2.title')) ?></h3>
          <p><?= h(t('home.problem.card2.text')) ?></p>
        </div>
        <div class="card">
          <?php card_icon('eye-slash'); ?>
          <h3><?= h(t('home.problem.card3.title')) ?></h3>
          <p><?= h(t('home.problem.card3.text')) ?></p>
        </div>
        <div class="card">
          <?php card_icon('tag'); ?>
          <h3><?= h(t('home.problem.card4.title')) ?></h3>
          <p><?= h(t('home.problem.card4.text')) ?></p>
        </div>
      </div>
    </div>
  </section>
  <!-- ③ EINSTIEG – türkis, linksbündig -->
  <section class="section section-teal">
    <div class="container">
      <h2 class="section-title-center teal-text"><?= title_dot(t('home.entry.title'), 'green') ?></h2>
      <div class="cards-3 cards-2">
        <div class="card-entry">
          <?php card_icon('user-plus'); ?>
          <h3 class="entry-title"><?= h(t('nav.talent_attraction')) ?></h3>
          <p class="entry-sub"><?= h(t('home.entry.card1.title')) ?></p>
          <p><?= h(t('home.entry.card1.text')) ?></p>
          <ul class="card-bullets">
            <li><?= h(t('home.entry.card1.bullet1')) ?></li>
            <li><?= h(t('home.entry.card1.bullet2')) ?></li>
            <li><?= h(t('home.entry.card1.bullet3')) ?></li>
          </ul>
          <a href="talent-attraction.php" class="btn btn-outline btn-sm"><?= h(t('home.entry.card1.cta')) ?></a>
        </div>
        <div class="card-entry">
          <?php card_icon('user-up'); ?>
          <h3 class="entry-title"><?= h(t('nav.talent_activation')) ?></h3>
          <p class="entry-sub"><?= h(t('home.entry.card2.title')) ?></p>
          <p><?= h(t('home.entry.card2.text')) ?></p>
          <ul class="card-bullets">
            <li><?= h(t('home.entry.card2.bullet1')) ?></li>
            <li><?= h(t('home.entry.card2.bullet2')) ?></li>
            <li><?= h(t('home.entry.card2.bullet3')) ?></li>
          </ul>
          <a href="talent-discovery.php" class="btn btn-outline btn-sm"><?= h(t('home.entry.card2.cta')) ?></a>
        </div>
        <?php /* Talente entwickeln: vorerst ausgeblendet (Coming soon), Übersetzungen bleiben in lang/de.php erhalten
        <div class="card-entry" style="opacity:0.8;">
          <div class="card-tag"><?= h(t('home.entry.card3.tag')) ?></div>
          <h3><?= h(t('home.entry.card3.title')) ?></h3>
          <p><?= h(t('home.entry.card3.text')) ?></p>
          <ul class="card-bullets">
            <li><?= h(t('home.entry.card3.bullet1')) ?></li>
            <li><?= h(t('home.entry.card3.bullet2')) ?></li>
            <li><?= h(t('home.entry.card3.bullet3')) ?></li>
          </ul>
          <span class="btn btn-outline btn-sm btn-disabled"><?= h(t('home.entry.card3.cta')) ?></span>
        </div>
        */ ?>
      </div>
      <div style="text-align:center; margin-top:2.5rem;"><a href="ausgangslage.php" class="btn btn-dark btn-lg"><?= h(t('home.entry.link')) ?></a></div>
    </div>
  </section>
  <!-- ④ TESTIMONIALS – weiß -->
  <section class="section section-white">
    <div class="container">
      <h2 class="section-title-center"><?= title_dot(t('home.testimonials.title'), 'green') ?></h2>
      <div class="testimonial-slider">
        <?php foreach ($testimonials as $i => $tst): ?>
        <div class="testimonial-card<?= $i === 0 ? ' active' : '' ?>" data-index="<?= $i ?>">
          <p class="testimonial-quote">«<?= h($tst['quote']) ?>»</p>
          <div class="testimonial-author"><?= h($tst['author']) ?></div>
          <div class="testimonial-role"><?= h($tst['role']) ?></div>
        </div>
        <?php endforeach; ?>
        <?php if (count($testimonials) > 1): ?>
        <button type="button" class="testimonial-arrow testimonial-arrow--prev" aria-label="Vorheriges Testimonial"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M15 5l-7 7 7 7"/></svg></button>
        <button type="button" class="testimonial-arrow testimonial-arrow--next" aria-label="Nächstes Testimonial"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5l7 7-7 7"/></svg></button>
        <div class="testimonial-dots">
          <?php foreach ($testimonials as $i => $tst): ?>
          <button class="testimonial-dot<?= $i === 0 ? ' active' : '' ?>" data-index="<?= $i ?>" aria-label="Testimonial <?= $i + 1 ?>"></button>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <!-- ④b KUNDEN – Logoleiste -->
  <section class="section-slim">
    <div class="container">
      <h2 class="section-title-center" style="margin-bottom:1.5rem;"><?= title_dot(t('home.clients.title'), 'teal') ?></h2>
      <div class="clients-row">
        <?php foreach ($clientLogos as $logo): ?>
        <?php if ($logo['url']): ?>
        <a class="client-logo" href="<?= h($logo['url']) ?>" target="_blank" rel="noopener"><img src="images/kunden/<?= h($logo['file']) ?>.png" alt="<?= h($logo['file']) ?>"></a>
        <?php else: ?>
        <div class="client-logo"><img src="images/kunden/<?= h($logo['file']) ?>.png" alt="<?= h($logo['file']) ?>"></div>
        <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <!-- ⑤ BENEFITS – türkis, linksbündig -->
  <section class="section section-teal">
    <div class="container">
      <img src="images/mockup-weiterbildung.png" alt="<?= h(t('home.benefits.title')) ?>" loading="lazy" class="img-before-title img-before-title--spaced" style="max-width:760px;">
      <h2 class="section-title-center teal-text"><?= title_dot(t('home.benefits.title'), 'teal') ?></h2>
      <p class="section-sub-white" style="text-align:center; max-width:900px; margin-left:auto; margin-right:auto;"><?= h(t('home.benefits.sub')) ?></p>
      <div class="benefit-rows">
        <div class="benefit-row">
          <div class="benefit-check">✓</div>
          <div>
            <strong><?= h(t('home.benefits.row1.title')) ?></strong>
            <p><?= h(t('home.benefits.row1.text')) ?></p>
          </div>
        </div>
        <div class="benefit-row">
          <div class="benefit-check">✓</div>
          <div>
            <strong><?= h(t('home.benefits.row2.title')) ?></strong>
            <p><?= h(t('home.benefits.row2.text')) ?></p>
          </div>
        </div>
        <div class="benefit-row">
          <div class="benefit-check">✓</div>
          <div>
            <strong><?= h(t('home.benefits.row3.title')) ?></strong>
            <p><?= h(t('home.benefits.row3.text')) ?></p>
          </div>
        </div>
        <div class="benefit-row">
          <div class="benefit-check">✓</div>
          <div>
            <strong><?= h(t('home.benefits.row4.title')) ?></strong>
            <p><?= h(t('home.benefits.row4.text')) ?></p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ⑥ DATEN – weiß, zentriert -->
  <section class="section section-white section-stats-graphic">
    <div class="container" style="text-align:center; max-width:1200px;">
      <h2 class="section-title-center"><?= title_dot(t('home.data.title'), 'teal') ?></h2>
      <p class="section-sub" style="max-width:820px; margin-left:auto; margin-right:auto;"><?= h(t('home.data.text')) ?></p>
      <div class="stat-boxes">
        <div class="stat-box">
          <div class="stat-big"><?= h(t('home.data.stat1.num')) ?></div>
          <div class="stat-desc"><?= t('home.data.stat1.label') ?></div>
        </div>
        <div class="stat-box">
          <div class="stat-big"><?= h(t('home.data.stat2.num')) ?></div>
          <div class="stat-desc"><?= t('home.data.stat2.label') ?></div>
        </div>
        <div class="stat-box">
          <div class="stat-big"><?= h(t('home.data.stat3.num')) ?></div>
          <div class="stat-desc"><?= t('home.data.stat3.label') ?></div>
        </div>
        <div class="stat-box">
          <div class="stat-big"><?= h(t('home.data.stat4.num')) ?></div>
          <div class="stat-desc"><?= t('home.data.stat4.label') ?></div>
        </div>
      </div>
      <div class="mt-lg">
        <a href="<?= h(HUBSPOT_MEETING_URL) ?>" target="_blank" rel="noopener" class="btn btn-outline"><?= h(t('home.data.cta')) ?></a>
      </div>
    </div>
  </section>
  <!-- ⑦ FOOTER CTA – türkis, zentriert -->
  <section class="section section-teal section-last" id="kontakt">
    <div class="container-sm" style="text-align:center;">
      <h2 class="teal-text"><?= title_dot(t('home.cta.title'), 'teal') ?></h2>
      <p class="section-sub-white" style="margin-top:0.5rem;"><?= h(t('home.cta.text')) ?></p>
      <?php include __DIR__ . '/partials/contact-form.php'; ?>
    </div>
  </section>

<?php include __DIR__ . '/partials/footer.php'; ?>
