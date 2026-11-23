<?php
// Erwartet optional: $formButtonKey (Default: form.cta_default), $formButtonClass (Default: btn-dark)
$formButtonKey   = $formButtonKey   ?? 'form.cta_default';
$formButtonClass = $formButtonClass ?? 'btn-dark';
// Interner Formularname fuer die Benachrichtigungs-Mail (immer deutsch, unabhaengig von der Sprache)
$formNames = [
    'form.cta_default' => 'Kontaktformular «Kostenloses Erstgespräch buchen»',
    'form.cta_contact' => 'Kontaktformular «Kontakt aufnehmen»',
    'form.cta_video'   => 'Formular «Demo Video erhalten»',
];
?>
      <form class="contact-form">
        <input type="hidden" name="form_name" value="<?= h($formNames[$formButtonKey] ?? $formButtonKey) ?>">
        <div class="form-row">
          <input type="text" name="first_name" placeholder="<?= h(t('form.first_name')) ?>" required />
          <input type="text" name="last_name" placeholder="<?= h(t('form.last_name')) ?>" required />
        </div>
        <div class="form-row">
          <input type="text" name="company" placeholder="<?= h(t('form.company')) ?>" />
          <input type="email" name="email" placeholder="<?= h(t('form.email')) ?>" required />
        </div>
        <button type="submit" class="btn <?= h($formButtonClass) ?> btn-full"><?= h(t($formButtonKey)) ?></button>
        <p class="form-message" style="display:none;margin-top:0.75rem;font-size:0.9rem;"></p>
      </form>
