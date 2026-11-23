  <!-- FOOTER -->
  <footer class="footer">
    <div class="container">
      <div class="footer-inner">
        <span class="logo"><img src="images/Scrambl_Transparent.svg" alt="Scrambl" class="logo-img"></span>
        <div class="footer-right">
          <p class="footer-copy">
            <?php // Auf den Lebenslauf-Upload-Seiten nur «© 2026 Scrambl.», ohne «Alle Rechte vorbehalten.»
            $footerCopy = t('footer.copyright');
            if (($currentPage ?? '') === 'cv-upload') $footerCopy = preg_replace('/(Scrambl\.).*$/u', '$1', $footerCopy); ?>
            <span class="footer-copyright"><?= h($footerCopy) ?></span>
            <a href="impressum.php"><?= h(t('footer.impressum')) ?></a>
            <a href="agb.php"><?= h(t('footer.agb')) ?></a>
            <a href="datenschutz.php"><?= h(t('footer.datenschutz')) ?></a>
          </p>
        </div>
      </div>
    </div>
  </footer>

<?php if (GA_MEASUREMENT_ID !== '' || GTM_CONTAINER_ID !== ''): ?>
  <div class="cookie-overlay" id="cookieOverlay" hidden></div>
  <div class="cookie-banner" id="cookieBanner" hidden role="dialog" aria-live="polite" aria-label="<?= h(t('cookie.title')) ?>">
    <p><?= h(t('cookie.text')) ?> <a href="datenschutz.php"><?= h(t('cookie.more')) ?></a></p>
    <div class="cookie-actions">
      <button type="button" class="btn btn-outline btn-sm" data-consent="denied"><?= h(t('cookie.decline')) ?></button>
      <button type="button" class="btn btn-dark btn-sm" data-consent="granted"><?= h(t('cookie.accept')) ?></button>
    </div>
  </div>
  <script>
    (function () {
      var b = document.getElementById('cookieBanner'); var c = null;
      try { c = localStorage.getItem('scrambl_consent'); } catch (e) {}
      var o = document.getElementById('cookieOverlay');
      if (!c) { b.hidden = false; o.hidden = false; }
      b.querySelectorAll('[data-consent]').forEach(function (btn) {
        btn.addEventListener('click', function () {
          var v = btn.getAttribute('data-consent');
          try { localStorage.setItem('scrambl_consent', v); } catch (e) {}
          if (v === 'granted' && window.scramblLoadGtm) scramblLoadGtm();
          else if (v === 'granted' && window.gtag) gtag('consent', 'update', { analytics_storage: 'granted' });
          b.hidden = true; o.hidden = true;
        });
      });
    })();
  </script>
<?php endif; ?>
  <script>
    window.SITE_I18N = {
      formSending: <?= json_encode(t('form.sending'), JSON_UNESCAPED_UNICODE) ?>,
      formSent: <?= json_encode(t('form.sent'), JSON_UNESCAPED_UNICODE) ?>,
      formThanks: <?= json_encode(t('form.thanks'), JSON_UNESCAPED_UNICODE) ?>,
      formError: <?= json_encode(t('form.error_generic'), JSON_UNESCAPED_UNICODE) ?>
    };
  </script>
  <script src="script.js?v=<?= @filemtime(__DIR__ . '/../script.js') ?>"></script>
</body>
</html>
