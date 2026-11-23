<?php
require_once __DIR__ . '/i18n.php';
$pageTitle = t('meta.about_title');
$pageDescription = t('meta.about_description');
$currentPage = 'ueber-uns';

$teamMembers = [
    ['name' => 'Dr. Marc Burkhalter', 'role' => 'Co-Founder', 'photo' => 'images/team/marc.jpg', 'email' => 'marc@scrambl.org'],
    ['name' => 'Christina Weibel', 'role' => 'Co-Founder', 'photo' => 'images/team/christina.jpg', 'email' => 'christina@scrambl.org'],
    ['name' => 'Johannes Wotzka', 'role' => 'Co-Founder', 'photo' => 'images/team/johannes.jpg', 'email' => 'johannes@scrambl.org'],
    ['name' => 'Tamara Candra', 'role' => 'Talent Acquisition Manager', 'photo' => 'images/team/tamara.jpg', 'email' => 'tamara@scrambl.org'],
    ['name' => 'Robin Haupt', 'role' => 'Software Developer', 'photo' => 'images/team/robin.jpg', 'email' => 'robin@scrambl.org'],
    ['name' => 'Iris Kreye', 'role' => 'Job Data Quality & Ads Manager', 'photo' => 'images/team/iris.jpg', 'email' => 'iris@scrambl.org'],
    ['name' => 'Annie Meier', 'role' => 'Talent Acquisition Manager', 'photo' => 'images/team/annie.png', 'email' => 'community@scrambl.org'],
    ['name' => 'Sandro Marquardt', 'role' => 'Talent Manager', 'photo' => 'images/team/sandro.jpg', 'email' => 'community@scrambl.org'],
    ['name' => 'Moustache', 'role' => 'Chief Happiness Officer', 'photo' => 'images/team/moustache.jpeg', 'email' => 'community@scrambl.org'],
];

include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/nav.php';
?>

  <!-- HERO -->
  <section class="hero-page">
    <div class="container">
      <h1><?= title_dot(t('about.hero.title'), 'green') ?></h1>
      <p class="section-sub" style="font-size:clamp(0.93rem, 0.6rem + 1.2vw, 1.05rem); margin-top:0.5rem; margin-bottom:0;"><?= h(t('about.mission.text1')) ?> <?= h(t('about.mission.text2')) ?></p>
      <div class="team-grid" style="margin-top:3rem;">
        <?php foreach ($teamMembers as $member): ?>
        <div class="team-card">
          <?php if (!empty($member['photo'])): ?>
          <div class="team-photo">
            <img src="<?= h($member['photo']) ?>" alt="<?= h($member['name']) ?>">
          </div>
          <?php else: ?>
          <div class="team-photo img-placeholder">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4.4 3.6-7 8-7s8 2.6 8 7"/></svg>
            <span><?= h(t('about.placeholder')) ?></span>
          </div>
          <?php endif; ?>
          <div class="team-name"><?= h($member['name']) ?></div>
          <div class="team-role"><?= h($member['role']) ?></div>
          <?php if (!empty($member['email'])): ?>
          <a class="team-mail" href="mailto:<?= h($member['email']) ?>" title="<?= h($member['email']) ?>" aria-label="E-Mail an <?= h($member['name']) ?>"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3.5 6.5l8.5 6 8.5-6"/></svg><span><?= h(t('about.contact.email_label')) ?></span></a>
          <?php endif; ?>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <!-- KONTAKT -->
  <section class="section section-white section-last" id="kontakt">
    <div class="container-sm" style="text-align:center;">
      <h2 style="font-size:clamp(1.3rem, 4vw, 2.2rem);"><?= title_dot(t('about.contact.title'), 'green') ?></h2>
      <p class="section-sub" style="text-align:center;"><?= h(t('about.contact.text')) ?></p>

      <form class="contact-form">
        <input type="hidden" name="form_name" value="Kontaktformular «Über uns»">
        <div class="form-row">
          <input type="text" name="first_name" placeholder="<?= h(t('form.first_name')) ?>" required />
          <input type="text" name="last_name" placeholder="<?= h(t('form.last_name')) ?>" required />
        </div>
        <div class="form-row">
          <input type="email" name="email" placeholder="<?= h(t('form.email')) ?>" required />
          <input type="tel" name="phone" placeholder="<?= h(t('form.phone')) ?>" />
        </div>
        <textarea name="message" placeholder="<?= h(t('form.message')) ?>" rows="4" style="font:inherit; padding:12px 16px; border:1.5px solid var(--border); border-radius:var(--radius); resize:vertical;"></textarea>
        <button type="submit" class="btn btn-dark btn-full"><?= h(t('form.cta_send')) ?></button>
        <p class="form-message" style="display:none;margin-top:0.75rem;font-size:0.9rem;"></p>
      </form>

      <div class="legal-content contact-info-grid" style="text-align:left; max-width:640px; margin:3rem auto 0; border-top:1px solid var(--border); padding-top:2rem;">
        <div>
          <p><strong><?= h(t('about.contact.phone_label')) ?></strong><br><a href="tel:+41767237253"><?= h(t('about.contact.phone')) ?></a><br><?= h(t('about.contact.hours')) ?></p>
          <p><strong><?= h(t('about.contact.email_label')) ?></strong><br><a href="mailto:community@scrambl.org">community@scrambl.org</a></p>
        </div>
        <div>
          <p><strong><?= h(t('about.contact.address_label')) ?></strong><br>Scrambl. AG<br>Grosshofstrasse 9<br>c/o LUREVO Treuhand AG<br>6010 Kriens</p>
        </div>
      </div>
    </div>
  </section>

<?php include __DIR__ . '/partials/footer.php'; ?>
