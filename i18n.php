<?php
const SUPPORTED_LANGS = ['de', 'en', 'fr'];
const DEFAULT_LANG = 'de';
// Google Analytics 4: Mess-ID (z. B. 'G-ABC123XYZ'). Leer = Analytics und Cookie-Hinweis aus.
const GA_MEASUREMENT_ID = 'G-GGZHS4VDMZ';
// Google Tag Manager Container (z. B. 'GTM-ABC123'). Wenn gesetzt, laeuft GA4 ueber den Container
// (dort ist G-GGZHS4VDMZ eingerichtet) statt direkt — sonst wuerde doppelt gezaehlt.
// Der Container wird erst nach Zustimmung im Cookie-Hinweis geladen (enthaelt auch Meta Pixel + Clarity).
const GTM_CONTAINER_ID = 'GTM-5QJ26D8';
const HUBSPOT_MEETING_URL = 'https://meetings-eu1.hubspot.com/christina-weibel/scrambl-meeting';

$lang = $_GET['lang'] ?? ($_COOKIE['lang'] ?? DEFAULT_LANG);
if (!in_array($lang, SUPPORTED_LANGS, true)) {
    $lang = DEFAULT_LANG;
}
if (!headers_sent()) {
    setcookie('lang', $lang, time() + 60 * 60 * 24 * 365, '/');
}

$GLOBALS['__translations'] = require __DIR__ . '/lang/' . $lang . '.php';
$GLOBALS['__lang'] = $lang;

function t(string $key): string {
    return $GLOBALS['__translations'][$key] ?? $key;
}

if (!function_exists('h')) {
    function h($value): string {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }
}

function current_lang(): string {
    return $GLOBALS['__lang'];
}

// Baut die URL fuer den Sprachumschalter, behaelt Seite + bestehende Query-Parameter bei.
function lang_switch_url(string $targetLang): string {
    $params = $_GET;
    $params['lang'] = $targetLang;
    return basename($_SERVER['SCRIPT_NAME']) . '?' . http_build_query($params);
}

const SITE_BASE_URL = 'https://www.scrambl.org/';

// Baut die absolute, kanonische URL der aktuellen Seite fuer eine gegebene Sprache
// (fuer <link rel="canonical">, hreflang-Alternates und die Sitemap).
function canonical_url(?string $forLang = null): string {
    $page = basename($_SERVER['SCRIPT_NAME']);
    $lang = $forLang ?? current_lang();
    $url = SITE_BASE_URL . $page;
    if ($lang !== DEFAULT_LANG) {
        $url .= '?lang=' . $lang;
    }
    return $url;
}

// Gibt einen Titel-Text aus, gefolgt von genau einem farbigen Punkt.
// Ein bereits vorhandener Punkt am Textende wird entfernt, damit nie zwei Punkte entstehen.
function title_dot(string $text, string $color = 'teal'): string {
    $text = rtrim($text);
    if (substr($text, -1) === '?') {
        $text = substr($text, 0, -1);
        return h($text) . '<span class="title-dot title-dot--' . h($color) . '">?</span>';
    }
    if (substr($text, -1) === '.') {
        $text = substr($text, 0, -1);
    }
    return h($text) . '<span class="title-dot title-dot--' . h($color) . '">.</span>';
}

// Kleine Icon-Bibliothek fuer Problem-/Loesungs-Karten (dezente Outline-Icons, 24x24).
function card_icon(string $name): void {
    $icons = [
        'clock'       => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3.5 2"/>',
        'lost'        => '<path d="M4 7l1-3h14l1 3M5 7v12a1 1 0 001 1h12a1 1 0 001-1V7M9 11h6"/>',
        'eye-slash'   => '<path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/><path d="M4 4l16 16"/>',
        'tag'         => '<path d="M12 3l8 8-9 9-8-8V4z"/><circle cx="8.5" cy="7.5" r="1.1" fill="currentColor" stroke="none"/>',
        'megaphone'   => '<path d="M3 11v2a2 2 0 002 2h1l3 4V7L6 11H5a2 2 0 00-2 0z"/><path d="M9 7l9-4v18l-9-4"/>',
        'funnel'      => '<path d="M4 4h16l-6 8v6l-4 2v-8z"/>',
        'coin'        => '<rect x="3" y="6" width="18" height="12" rx="2"/><circle cx="12" cy="12" r="2.5"/><path d="M6.5 9v.01M17.5 15v.01"/>',
        'database'    => '<ellipse cx="12" cy="6" rx="8" ry="3"/><path d="M4 6v6c0 1.7 3.6 3 8 3s8-1.3 8-3V6M4 12v6c0 1.7 3.6 3 8 3s8-1.3 8-3v-6"/>',
        'refresh'     => '<path d="M4 4v5h5M20 20v-5h-5"/><path d="M4.6 9a8 8 0 0113.9-3M19.4 15a8 8 0 01-13.9 3"/>',
        'warning'     => '<path d="M12 3l10 18H2z"/><path d="M12 10v4"/><circle cx="12" cy="17" r="0.6" fill="currentColor" stroke="none"/>',
        'user-plus'   => '<circle cx="10" cy="8" r="3.6"/><path d="M3.5 20v-1a5 5 0 015-5h3.5"/><path d="M18 14v6M15 17h6"/>',
        'user-up'     => '<circle cx="10" cy="8" r="3.6"/><path d="M3.5 20v-1a5 5 0 015-5h3a5 5 0 013.2 1.2"/><path d="M14.5 20.5l6-6M17 14.5h3.5V18"/>',
        'building'    => '<path d="M5 21V6l7-3 7 3v15"/><path d="M9 21v-6h6v6M9 10h1m3 0h1m-5 4h1m3 0h1"/>',
    ];
    $path = $icons[$name] ?? '';
    echo '<div class="card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">' . $path . '</svg></div>';
}

// Gibt FAQPage-JSON-LD fuer die FAQ-Keys "{$prefix}q1"/"{$prefix}a1" ... aus (Rich-Snippet-faehig).
function faq_schema(string $prefix, int $count): void {
    $items = [];
    for ($i = 1; $i <= $count; $i++) {
        $q = t("{$prefix}q{$i}");
        $a = t("{$prefix}a{$i}");
        $items[] = [
            '@type' => 'Question',
            'name' => $q,
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $a],
        ];
    }
    $schema = ['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $items];
    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
}
