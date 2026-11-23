<!DOCTYPE html>
<html lang="<?= h(current_lang()) ?>">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= h($pageTitle ?? 'Scrambl') ?></title>
  <?php if (!empty($pageDescription)): ?>
  <meta name="description" content="<?= h($pageDescription) ?>" />
  <?php endif; ?>
  <link rel="icon" type="image/png" href="images/favicon-32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="images/favicon-512.png" sizes="512x512" />
  <link rel="apple-touch-icon" href="images/apple-touch-icon.png" />
  <link rel="canonical" href="<?= h(canonical_url()) ?>" />
  <?php foreach (SUPPORTED_LANGS as $altLang): ?>
  <link rel="alternate" hreflang="<?= h($altLang) ?>" href="<?= h(canonical_url($altLang)) ?>" />
  <?php endforeach; ?>
  <link rel="alternate" hreflang="x-default" href="<?= h(canonical_url(DEFAULT_LANG)) ?>" />

  <meta property="og:type" content="website" />
  <meta property="og:site_name" content="Scrambl." />
  <meta property="og:title" content="<?= h($pageTitle ?? 'Scrambl') ?>" />
  <?php if (!empty($pageDescription)): ?>
  <meta property="og:description" content="<?= h($pageDescription) ?>" />
  <?php endif; ?>
  <meta property="og:url" content="<?= h(canonical_url()) ?>" />
  <meta property="og:image" content="<?= h(SITE_BASE_URL) ?>images/og-default.jpg" />
  <meta property="og:image:width" content="1200" />
  <meta property="og:image:height" content="630" />
  <meta property="og:locale" content="<?= h(current_lang()) ?>" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?= h($pageTitle ?? 'Scrambl') ?>" />
  <?php if (!empty($pageDescription)): ?>
  <meta name="twitter:description" content="<?= h($pageDescription) ?>" />
  <?php endif; ?>
  <meta name="twitter:image" content="<?= h(SITE_BASE_URL) ?>images/og-default.jpg" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css?v=<?= @filemtime(__DIR__ . '/../style.css') ?>" />

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "Scrambl. AG",
    "url": "<?= h(SITE_BASE_URL) ?>",
    "logo": "<?= h(SITE_BASE_URL) ?>images/Scrambl_Transparent.svg",
    "email": "community@scrambl.org",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "c/o LUREVO Treuhand AG, Grosshofstrasse 9",
      "postalCode": "6010",
      "addressLocality": "Kriens",
      "addressCountry": "CH"
    }
  }
  </script>
<?php if (GTM_CONTAINER_ID !== ''): ?>
  <!-- Google Tag Manager: wird erst nach Zustimmung im Cookie-Hinweis geladen, weil der Container
       neben GA4 auch Meta Pixel und Clarity enthaelt (die den Consent Mode nicht beachten) -->
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){ dataLayer.push(arguments); }
    gtag('consent', 'default', { analytics_storage: 'denied', ad_storage: 'denied', ad_user_data: 'denied', ad_personalization: 'denied', wait_for_update: 500 });
    window.scramblLoadGtm = function () {
      if (window.scramblGtmLoaded) return;
      window.scramblGtmLoaded = true;
      gtag('consent', 'update', { analytics_storage: 'granted', ad_storage: 'granted', ad_user_data: 'granted', ad_personalization: 'granted' });
      dataLayer.push({ 'gtm.start': new Date().getTime(), event: 'gtm.js' });
      var s = document.createElement('script');
      s.async = true;
      s.src = 'https://www.googletagmanager.com/gtm.js?id=<?= h(GTM_CONTAINER_ID) ?>';
      document.head.appendChild(s);
    };
    try { if (localStorage.getItem('scrambl_consent') === 'granted') scramblLoadGtm(); } catch (e) {}
  </script>
<?php elseif (GA_MEASUREMENT_ID !== ''): ?>
  <!-- Google Analytics 4 mit Consent Mode: misst erst nach Zustimmung im Cookie-Hinweis -->
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){ dataLayer.push(arguments); }
    gtag('consent', 'default', { analytics_storage: 'denied', ad_storage: 'denied', ad_user_data: 'denied', ad_personalization: 'denied', wait_for_update: 500 });
    try { if (localStorage.getItem('scrambl_consent') === 'granted') gtag('consent', 'update', { analytics_storage: 'granted' }); } catch (e) {}
    gtag('js', new Date());
    gtag('config', '<?= h(GA_MEASUREMENT_ID) ?>', { anonymize_ip: true });
  </script>
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?= h(GA_MEASUREMENT_ID) ?>"></script>
<?php endif; ?>
</head>
<body>
