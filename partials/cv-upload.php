<?php
// Gemeinsame Vorlage Lebenslauf-Upload. Vorher setzen:
//   $cvSource        Formularname fuer die Mail (z. B. 'Lebenslauf-Upload SZKB')
//   $cvPartner       Firmenname fuer die Mail oder '' (ohne Partner-Checkbox)
//   $cvPartnerPhrase Text in der Checkbox nach «Ich möchte, dass …» (z. B. 'die Schwyzer Kantonalbank')
//   $cvContacts      optional: eigene Ansprechpersonen statt der Standardliste unten ([] = keine)
$cvPartner = $cvPartner ?? '';
$cvPartnerPhrase = $cvPartnerPhrase ?? $cvPartner;
// Ansprechpersonen unten auf der Seite (fuer alle Lebenslauf-Upload-Seiten gleich, pro Seite ueberschreibbar).
// Leeres 'photo' = Initiale, leere 'email'/'linkedin' = Symbol ausgeblendet.
$cvContacts = $cvContacts ?? [
    ['name' => 'Tamara',    'photo' => 'images/team/tamara.jpg',    'email' => 'tamara@scrambl.org',    'linkedin' => ''],
    ['name' => 'Sandro',    'photo' => 'images/team/sandro.jpg',    'email' => 'community@scrambl.org', 'linkedin' => ''],
    ['name' => 'Annie',     'photo' => 'images/team/annie.png',     'email' => 'community@scrambl.org', 'linkedin' => ''],
    ['name' => 'Christina', 'photo' => 'images/team/christina.jpg', 'email' => 'christina@scrambl.org', 'linkedin' => ''],
];
$pageTitle = 'Deine Bewerbung – Scrambl.';
$pageDescription = 'Lebenslauf hochladen und Teil des Scrambl. Talentpools werden.';
$currentPage = 'cv-upload';
include __DIR__ . '/head.php';
?>
  <style>body { background: #bfece9; } body::before { opacity: 0.35; }</style>
  <header class="cv-header">
    <a href="index.php" class="logo"><img src="images/Scrambl_Transparent.svg" alt="Scrambl" class="logo-img"></a>
  </header>

  <section class="section section-mint section-last cv-page">
    <div class="container">

      <div id="cvForm">
        <h1 class="cv-title"><?= title_dot('Deine Bewerbung', 'teal') ?></h1>
        <p class="cv-intro">Wir achten darauf, sorgfältig und respektvoll mit deinen Bewerberinformationen umzugehen. Deine Daten werden in der Regel nach 3 Monaten gelöscht, wenn kein aktiver Bewerbungsprozess besteht oder wenn du nicht in den Talentpool aufgenommen wirst. Wenn du zustimmst, im Talentpool zu sein, werden deine Daten ein Jahr gespeichert. So können wir dich für zukünftige Stellenangebote berücksichtigen und dich direkt kontaktieren, wenn passende Möglichkeiten verfügbar sind. Auf deinen Wunsch hin können wir deine Daten jederzeit löschen – hierfür reicht eine kurze Anfrage.</p>

        <form class="cv-form" id="cvUploadForm" novalidate>
          <input type="hidden" name="source" value="<?= h($cvSource) ?>">
          <input type="hidden" name="partner_name" value="<?= h($cvPartner) ?>">

          <label class="cv-label" for="cvEmail">E-Mail-Adresse *</label>
          <input type="email" id="cvEmail" name="email" class="cv-input" required autocomplete="email">

          <label class="cv-label">Im ersten Schritt reicht dein Lebenslauf *</label>
          <label class="cv-file">
            <input type="file" name="cv" id="cvFile" accept=".pdf,.doc,.docx,.rtf,.odt,.txt,.jpg,.jpeg,.png" required>
            <span class="cv-file-btn"><span aria-hidden="true">+</span> Lebenslauf hochladen</span>
            <span class="cv-file-name" id="cvFileName"></span>
          </label>
          <p class="cv-hint">PDF, Word oder Bild, max. 8 MB.</p>

          <div class="cv-checks">
            <label class="cv-check"><input type="checkbox" name="talentpool" value="1"><span>Ich möchte Teil des Scrambl. Talentpools werden</span></label>
            <?php if ($cvPartner): ?>
            <label class="cv-check"><input type="checkbox" name="partner_access" value="1"><span>Ich möchte, dass <?= h($cvPartnerPhrase) ?> Zugang zu meinem Talentpool-Profil erhält</span></label>
            <?php endif; ?>
            <label class="cv-check"><input type="checkbox" name="privacy" value="1" required><span>Ich habe die <a href="datenschutz.php" target="_blank">Datenschutzerklärung</a> zur Kenntnis genommen *</span></label>
          </div>

          <p class="cv-error" id="cvError" hidden></p>
          <button type="submit" class="btn btn-dark btn-full" id="cvSubmit">Einreichen</button>
        </form>
      </div>

      <div id="cvThanks" class="cv-thanks" hidden>
        <svg class="cv-thumb" viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M26 30c4-4 6-9 6-15 0-3 2-5 4-4 3 1 3 7 1 13h11c3 0 5 3 4 6l-3 15c-1 3-3 5-6 5H27"/>
          <rect x="15" y="29" width="11" height="25" rx="2.5"/>
          <path d="M12 12l2 2M12 14l2-2M50 9l2 2M50 11l2-2M54 18l2 2M54 20l2-2"/>
        </svg>
        <h1 class="cv-title"><?= title_dot('Vielen Dank für dein Interesse', 'teal') ?></h1>
        <p>Wir melden uns in den nächsten 7 Tagen mit einer Rückmeldung bei dir.</p>
      </div>

    </div>
  </section>

  <?php if (!empty($cvContacts)): ?>
  <section class="cv-contacts">
    <div class="container cv-contacts-inner">
      <div>
        <h2 class="cv-contacts-title"><?= title_dot('Deine Ansprechpersonen', 'green') ?></h2>
        <ul class="cv-contacts-list">
          <?php foreach ($cvContacts as $c): ?>
          <li class="cv-contact">
            <?php if (!empty($c['photo'])): ?>
            <img src="<?= h($c['photo']) ?>" alt="<?= h($c['name']) ?>" class="cv-contact-photo" loading="lazy">
            <?php else: ?>
            <span class="cv-contact-photo cv-contact-initial" aria-hidden="true"><?= h(mb_substr($c['name'], 0, 1)) ?></span>
            <?php endif; ?>
            <span class="cv-contact-name"><?= h($c['name']) ?></span>
            <span class="cv-contact-links">
              <?php if (!empty($c['email'])): ?>
              <a href="mailto:<?= h($c['email']) ?>" aria-label="E-Mail an <?= h($c['name']) ?>"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="1.5"/><path d="M3.5 6l8.5 7 8.5-7"/></svg></a>
              <?php endif; ?>
              <?php if (!empty($c['linkedin'])): ?>
              <a href="<?= h($c['linkedin']) ?>" target="_blank" rel="noopener" aria-label="<?= h($c['name']) ?> auf LinkedIn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8.5 10.5v5.5M8.5 8v.01M11.5 16v-5.5M11.5 13c0-1.5 1-2.5 2.3-2.5s2.2.9 2.2 2.5v3" stroke-linecap="round"/></svg></a>
              <?php endif; ?>
            </span>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <script>
  (function () {
    const form = document.getElementById('cvUploadForm');
    const file = document.getElementById('cvFile');
    const fileName = document.getElementById('cvFileName');
    const err = document.getElementById('cvError');
    const btn = document.getElementById('cvSubmit');
    const showError = (msg) => { err.textContent = msg; err.hidden = false; };
    file.addEventListener('change', () => { fileName.textContent = file.files[0] ? file.files[0].name : ''; err.hidden = true; });
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      err.hidden = true;
      const email = form.email.value.trim();
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) return showError('Bitte gib eine gültige E-Mail-Adresse an.');
      if (!file.files[0]) return showError('Bitte lade deinen Lebenslauf hoch.');
      if (file.files[0].size > 8 * 1024 * 1024) return showError('Die Datei ist grösser als 8 MB – bitte eine kleinere Datei wählen.');
      if (!form.privacy.checked) return showError('Bitte bestätige, dass du die Datenschutzerklärung zur Kenntnis genommen hast.');
      btn.disabled = true; btn.textContent = 'Wird gesendet …';
      fetch('submit-cv.php', { method: 'POST', body: new FormData(form) })
        .then(r => r.json())
        .then(res => {
          if (!res.success) throw new Error(res.error || 'error');
          document.getElementById('cvForm').hidden = true;
          document.getElementById('cvThanks').hidden = false;
          window.scrollTo({ top: 0, behavior: 'smooth' });
        })
        .catch(() => {
          btn.disabled = false; btn.textContent = 'Einreichen';
          showError('Das hat leider nicht geklappt. Bitte versuche es erneut oder schreibe uns an community@scrambl.org.');
        });
    });
  })();
  </script>
<?php include __DIR__ . '/footer.php'; ?>
