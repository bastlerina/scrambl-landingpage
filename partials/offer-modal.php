<?php
// Overlay "Angebot erhalten". Optional vorher setzen:
//   $offerWithModules = false  -> ohne Angebotsauswahl (nur Kontaktdaten)
//   $offerTopic = '...'        -> Betreff in der Nachricht, wenn keine Module gewaehlt werden koennen
//   $offerModules = [[key, Name fuer die Mail, Titel-Schluessel, Untertitel-Schluessel|null], ...]
//                  -> eigene Angebotsliste (Standard: Matching Slot / Credit / Managed Talentpool)
$offerWithModules = $offerWithModules ?? true;
$offerTopic = $offerTopic ?? '';
$offerModules = $offerModules ?? [
    ['slot', 'Matching Slot', 'ta.solution.block1.tag', 'ta.solution.block1.title'],
    ['credit', 'Matching Credit', 'ta.solution.block2.tag', 'ta.solution.block2.title'],
    ['pool', 'Managed Talentpool', 'ta.solution.block3.tag', 'ta.solution.block3.title'],
];
?>
  <!-- Overlay "Angebot erhalten" (oeffnet ueber die Buttons in den Produkt-Karten) -->
  <div class="offer-modal" id="offerModal" data-offer-topic="<?= h($offerTopic) ?>" hidden>
    <div class="offer-modal-backdrop" data-offer-close></div>
    <div class="offer-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="offerModalTitle">
      <button type="button" class="offer-modal-close" data-offer-close aria-label="<?= h(t('ta.offer.close')) ?>">&times;</button>
      <h3 id="offerModalTitle"><?= title_dot(t('ta.offer.title'), 'teal') ?></h3>
      <p class="offer-modal-text"><?= h(t('ta.offer.text')) ?></p>
      <form class="contact-form on-white offer-form">
        <input type="hidden" name="form_name" value="Overlay «Angebot erhalten»">
        <?php if ($offerWithModules): ?>
        <div class="offer-modules-label"><?= h(t('ta.offer.modules')) ?></div>
        <div class="offer-modules">
          <?php foreach ($offerModules as [$key, $name, $titleKey, $subKey]): ?>
          <label class="offer-module">
            <input type="checkbox" name="offer_module" value="<?= h($name) ?>" data-offer-key="<?= h($key) ?>">
            <span><strong><?= h(t($titleKey)) ?></strong><?php if ($subKey): ?><br><?= h(t($subKey)) ?><?php endif; ?></span>
          </label>
          <?php endforeach; ?>
        </div>
        <p class="offer-module-error" hidden><?= h(t('ta.offer.no_module')) ?></p>
        <div class="offer-modules-label offer-contact-label"><?= h(t('ta.offer.contact')) ?></div>
        <?php else: ?>
        <div class="offer-modules-label"><?= h(t('ta.offer.contact')) ?></div>
        <?php endif; ?>
        <input type="hidden" name="message" value="">
        <div class="form-row">
          <input type="text" name="first_name" placeholder="<?= h(t('form.first_name')) ?>" required />
          <input type="text" name="last_name" placeholder="<?= h(t('form.last_name')) ?>" required />
        </div>
        <div class="form-row">
          <input type="email" name="email" placeholder="<?= h(t('form.email')) ?>" required />
          <input type="tel" name="phone" placeholder="<?= h(t('form.phone')) ?>" required />
        </div>
        <input type="text" name="company" placeholder="<?= h(t('form.company')) ?> (<?= h(t('ta.offer.optional')) ?>)" />
        <button type="submit" class="btn btn-dark offer-submit"><?= h(t('ta.offer.submit')) ?></button>
        <p class="form-message" style="display:none;margin-top:0.75rem;font-size:0.9rem;"></p>
      </form>
      <div class="offer-success" hidden>
        <div class="offer-success-icon" aria-hidden="true">✓</div>
        <p class="offer-success-title"><?= h(t('form.thanks_title')) ?></p>
        <p><?= h(t('form.thanks_text')) ?></p>
        <button type="button" class="btn btn-outline btn-sm" data-offer-close><?= h(t('ta.offer.close')) ?></button>
      </div>
    </div>
  </div>

