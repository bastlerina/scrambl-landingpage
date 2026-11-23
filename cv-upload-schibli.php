<?php
require_once __DIR__ . '/i18n.php';
// Lebenslauf-Upload Schibli (/cv-upload-schibli)
$cvSource = 'Lebenslauf-Upload Schibli';
$cvPartner = 'Schibli';
$cvPartnerPhrase = 'Schibli';
// Ansprechpersonen unten auf der Seite. Leeres 'photo' = Initialen, leere 'email'/'linkedin' = Symbol ausgeblendet.
$cvContacts = [
    ['name' => 'Tamara',    'photo' => 'images/team/tamara.jpg',    'email' => 'tamara@scrambl.org',    'linkedin' => ''],
    ['name' => 'Sandro',    'photo' => 'images/team/sandro.jpg',    'email' => 'community@scrambl.org', 'linkedin' => ''],
    ['name' => 'Annie',     'photo' => 'images/team/annie.png',     'email' => 'community@scrambl.org', 'linkedin' => ''],
    ['name' => 'Christina', 'photo' => 'images/team/christina.jpg', 'email' => 'christina@scrambl.org', 'linkedin' => ''],
];
include __DIR__ . '/partials/cv-upload.php';
