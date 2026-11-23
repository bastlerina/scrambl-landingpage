<?php
require_once __DIR__ . '/i18n.php';
// Inhalt gibt es auf Deutsch und Englisch; Franzoesisch zeigt die englische Fassung
$zhdkLang = current_lang() === 'de' ? 'de' : 'en';
include __DIR__ . '/partials/zhdk/head-' . $zhdkLang . '.php';
$zhdkUrl = 'https://app.scrambl.org/skills/offer/domains/?start_with_occupations=true&edu_school=59b54200e8334826a325be241026746a&edu_uid=&utm_medium=display&utm_source=ZHdK&utm_campaign=CEF2022&utm_content=Dislclaimer';
$pageTitle = 'SkillMatching ZHdK – Scrambl.';
$pageDescription = $zhdkSub;
$currentPage = 'zhdk';
include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/nav.php';
?>

  <!-- HERO -->
  <section class="hero-page">
    <div class="container">
      <div class="zhdk-label">Disclaimer</div>
      <h1><?= h($zhdkTitle) ?></h1>
      <p style="max-width:760px;"><?= h($zhdkSub) ?></p>
      <a href="<?= h($zhdkUrl) ?>" class="btn btn-dark"><?= h($zhdkCta) ?></a>
    </div>
  </section>

  <section class="section section-white section-last">
    <div class="container-sm zhdk-content">
<?php include __DIR__ . '/partials/zhdk/content-' . $zhdkLang . '.php'; ?>
    </div>
  </section>

<?php include __DIR__ . '/partials/footer.php'; ?>
