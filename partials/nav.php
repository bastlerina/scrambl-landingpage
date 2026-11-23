<?php
// Erwartet: $currentPage (z.B. 'home', 'talent-attraction', 'talent-discovery', 'skill-intelligence', 'ueber-uns')
$currentPage = $currentPage ?? '';
?>
  <!-- NAVIGATION -->
  <nav class="navbar" id="navbar">
    <div class="nav-inner">
      <a href="index.php" class="logo"><img src="images/Scrambl_Transparent.svg" alt="Scrambl" class="logo-img"></a>
      <ul class="nav-links">
        <li><a href="talent-attraction.php" class="<?= $currentPage === 'talent-attraction' ? 'active' : '' ?>"><?= h(t('nav.talent_attraction')) ?></a></li>
        <li><a href="talent-discovery.php" class="<?= $currentPage === 'talent-discovery' ? 'active' : '' ?>"><?= h(t('nav.talent_activation')) ?></a></li>
        <li><a href="skill-intelligence.php" class="<?= $currentPage === 'skill-intelligence' ? 'active' : '' ?>"><?= h(t('nav.skill_intelligence')) ?></a></li>
        <li><a href="ueber-uns.php" class="<?= $currentPage === 'ueber-uns' ? 'active' : '' ?>"><?= h(t('nav.about')) ?></a></li>
        <li class="lang-dropdown" id="langDropdown">
          <button class="lang-dropdown-toggle" id="langDropdownToggle" aria-haspopup="true" aria-expanded="false">
            <?= h(strtoupper(current_lang())) ?>
            <svg class="lang-dropdown-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
          </button>
          <ul class="lang-dropdown-menu">
            <?php foreach (SUPPORTED_LANGS as $l): ?>
            <li><a href="<?= h(lang_switch_url($l)) ?>" class="<?= current_lang() === $l ? 'active' : '' ?>"><?= h(strtoupper($l)) ?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>
      </ul>
      <button class="hamburger" id="hamburger" aria-label="<?= h(t('nav.menu_open')) ?>">
        <span></span><span></span><span></span>
      </button>
    </div>
    <div class="navbar-wave">
      <svg viewBox="0 150 2736 90.5" preserveAspectRatio="none">
        <g filter="url(#navwave-shadow)">
          <path d="M2737 170H1823C1267.5 170 716.5 204.5 435.5 204.5C154.5 204.5 0 192 0 192V12H2737V170Z" fill="white"/>
        </g>
        <defs>
          <filter id="navwave-shadow" x="-24" y="0" width="2785" height="240.5" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
            <feFlood flood-opacity="0" result="BackgroundImageFix"/>
            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
            <feOffset dy="12"/>
            <feGaussianBlur stdDeviation="12"/>
            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.12 0"/>
            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
            <feOffset dy="2"/>
            <feGaussianBlur stdDeviation="4"/>
            <feColorMatrix type="matrix" values="0 0 0 0 0.27451 0 0 0 0 0.305882 0 0 0 0 0.356863 0 0 0 0.11 0"/>
            <feBlend mode="normal" in2="effect1_dropShadow" result="effect2_dropShadow"/>
            <feBlend mode="normal" in="SourceGraphic" in2="effect2_dropShadow" result="shape"/>
          </filter>
        </defs>
      </svg>
    </div>
  </nav>
