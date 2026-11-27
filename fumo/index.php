<!DOCTYPE html>
<html lang="de-CH">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Fumo Talentpool</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&display=swap" rel="stylesheet">
<style>
/* VOICE: sachlich, freundlich, kurz – wie die Website von Fuchs-Movesa
   IDEA: ein Kontaktformular aus dem Fuchs-Movesa-Shop, nichts mehr
   PICTURE: das Formular selbst, eine ruhige Spalte
   COLOUR/TYPE: Weiss, Anthrazit #333, Buttons #555 > #111, Fehler #dc0000; Heebo 400/500/700
   LAYOUT: Logo-Kopf, Titel, Intro, Formular, schwarzer Footer-Balken mit «powered by Scrambl.» */
:root{color-scheme:light dark;
  --bg:light-dark(#fff,#1b1b1b);--ink:light-dark(#333,#ececec);--muted:light-dark(#666,#a9a9a9);
  --line:light-dark(#cdcdcd,#555);--soft:light-dark(#f3f3f3,#242424);--logo:light-dark(#2f2912,#ececec);
  --btn:light-dark(#555,#e6e6e6);--btn-ink:light-dark(#fff,#111);--btn-hover:light-dark(#111,#fff);
  --err:light-dark(#dc0000,#ff6b6b);--ok:light-dark(#61b500,#8ad63a)}
:root[data-theme=light]{color-scheme:light}:root[data-theme=dark]{color-scheme:dark}
*{box-sizing:border-box;min-width:0}
html,body{height:100%}
body{margin:0;background:var(--bg);color:var(--ink);font:16px/1.55 Heebo,"Helvetica Neue",Arial,sans-serif;overflow-x:clip;display:flex;flex-direction:column}

/* Kopf */
.head{border-bottom:1px solid var(--line)}
.head .in{max-width:1380px;margin:0 auto;padding:18px max(5vw,16px)}
.logo{display:block;height:46px;width:auto;color:var(--logo);overflow:visible;padding-right:2px}

/* Inhalt */
main{flex:1}
.band{padding:clamp(56px,9vw,120px) max(5vw,16px) clamp(48px,7vw,96px)}
.wrap{max-width:560px;margin:0 auto}
h1{font-weight:700;font-size:clamp(32px,5vw,46px);line-height:1.1;margin:0 0 16px;text-wrap:balance}
.intro{font-size:17px;margin:0 0 36px;max-width:60ch}

/* Felder im Stil der Website: Unterstrich-Feld mit schwebendem Label */
form{display:grid;grid-template-columns:minmax(0,1fr) minmax(0,1fr);gap:8px 28px}
.field{position:relative;padding-top:14px}
.field.full{grid-column:1/-1}
.field input{width:100%;font:inherit;font-size:16px;color:var(--ink);background:transparent;border:0;border-bottom:1px solid var(--line);border-radius:0;padding:10px 0 9px;outline:none;transition:border-color .3s cubic-bezier(.165,.84,.44,1)}
.field label{position:absolute;left:0;top:24px;font-size:15px;color:var(--muted);pointer-events:none;transition:all .3s cubic-bezier(.165,.84,.44,1)}
.field input:focus{border-bottom:2px solid var(--ink);padding-bottom:8px}
.field input:focus+label,.field input:not(:placeholder-shown)+label{top:0;font-size:12px;color:var(--ink)}
.field .msg{display:block;min-height:20px;font-size:13px;color:var(--err);padding-top:3px}
.field.bad input{border-bottom-color:var(--err)}
.field.bad label{color:var(--err)!important}

.consent{grid-column:1/-1;font-size:13px;color:var(--muted);margin:10px 0 0}
.actions{grid-column:1/-1;margin-top:18px}
button{-webkit-appearance:none;appearance:none;font:500 16px/1.25 Heebo,sans-serif;letter-spacing:.5px;color:var(--btn-ink);background:var(--btn);border:2px solid var(--btn);border-radius:0;padding:12px 32px;min-height:48px;cursor:pointer;transition:all .3s cubic-bezier(.165,.84,.44,1)}
button:hover,button:focus-visible{background:var(--btn-hover);border-color:var(--btn-hover)}
button:focus-visible{outline:2px solid var(--ink);outline-offset:3px}
button:disabled{background:#b1b1b1;border-color:#b1b1b1;color:#fff;cursor:not-allowed}

.hp{position:absolute;left:-9999px;width:1px;height:1px;overflow:hidden}
.senderr{color:var(--err);font-size:14px;margin:12px 0 0;min-height:1px}
.checks{grid-column:1/-1;display:grid;gap:12px;margin-top:4px}
.check{display:flex;gap:12px;align-items:flex-start;cursor:pointer;font-size:15px;line-height:1.45}
.check input{-webkit-appearance:none;appearance:none;flex:none;width:20px;height:20px;margin:1px 0 0;border:1px solid var(--muted);border-radius:0;background:var(--bg);cursor:pointer;display:grid;place-content:center;transition:all .2s}
.check input:checked{background:var(--btn);border-color:var(--btn)}
.check input:checked::after{content:"";width:11px;height:6px;border:solid var(--btn-ink);border-width:0 0 2px 2px;transform:translateY(-2px) rotate(-45deg)}
.check input:focus-visible{outline:2px solid var(--ink);outline-offset:2px}
.check a{color:var(--ink);text-decoration:underline}
.check.bad input{border-color:var(--err);background:light-dark(#ffc3c3,#4a1f1f)}
.checks .msg{display:block;min-height:18px;font-size:13px;color:var(--err);padding-left:32px}
/* Bestätigung */
.done{display:none;background:var(--soft);padding:28px 28px 30px;border-left:4px solid var(--ok)}
.done h2{font-size:24px;line-height:1.2;margin:0 0 8px}
.done p{margin:0}
.sent form,.sent .intro{display:none}
.sent .done{display:block}

/* Footer: schwarzer Balken wie footer-meta der Website */
.foot{background:#333;color:#cdcdcd;font-size:14px;line-height:1.57}
.foot .in{max-width:1380px;margin:0 auto;padding:12px max(5vw,16px);display:flex;flex-wrap:wrap;justify-content:space-between;gap:4px 24px}
.foot a{color:#fff;text-decoration:none;font-weight:500}
.foot a:hover{text-decoration:underline}
.foot .legal{display:flex;flex-wrap:wrap;gap:4px 20px}
.foot .legal a{color:#cdcdcd;font-weight:400;padding:6px 0;margin:-6px 0}
.foot .legal a:hover{color:#fff}

@media(max-width:600px){
  form{grid-template-columns:minmax(0,1fr)}
  .logo{height:36px}
  button{width:100%}
}
@media(prefers-reduced-motion:reduce){*{transition:none!important}}
</style>
</head>
<body>

<header class="head"><div class="in">
  <a href="https://www.fuchs-movesa.ch/de" aria-label="Zur Website von Fuchs-Movesa"><svg class="logo" viewBox="0 0 768.11 169.67" role="img" aria-label="Fuchs-Movesa – bike parts, outdoor &amp; sport" fill="currentColor"><path d="M60.4,163.37c-2.07,0-6.48-.86-18.31-5.61-13.6-5.46-31.37-15.79-38.79-33.96-4.99-12.24-4.31-25.77,2.03-40.21,8.07-18.36,23.78-34.58,46.71-48.21,22.69-13.48,47.66-21.52,64.6-25.89C152.85.16,169.47,0,170.16,0h0c1.98-.01,3.89,1,4.99,2.7.63.97.97,2.09.97,3.25,0,.83-.17,1.64-.51,2.41l-12.92,29.16c-.93,2.09-3,3.48-5.28,3.54-.13,0-12.33.47-32.76,7.46l23.74-.1h.02c2.02,0,3.88,1.01,4.98,2.7.63.97.97,2.09.97,3.25,0,.84-.17,1.65-.51,2.42l-12.67,28.37c-.96,2.14-3.09,3.52-5.43,3.52,0,0-61.34.02-67.2.02-3.29,1.83-15.63,10.11-15.63,30.98,0,2.73.21,5.62.63,8.59,2.24,15.85,10.99,24.86,11.08,24.95,1.11,1.1,1.75,2.64,1.75,4.22,0,.66-.11,1.32-.33,1.94-.73,2.14-2.66,3.7-4.9,3.97-.21.02-.46.04-.75.04ZM170.17,3.2c-.67,0-16.9.16-52.73,9.39-16.75,4.32-41.41,12.25-63.77,25.54-22.34,13.28-37.62,29-45.41,46.74-5.98,13.62-6.65,26.31-1.99,37.72,6.99,17.13,23.99,26.97,37.02,32.2,12.44,5,16.3,5.52,17.49,5.36,1.03-.12,1.92-.84,2.26-1.84.1-.29.15-.58.15-.89,0-.73-.3-1.44-.81-1.96-.1-.1-9.57-9.74-11.98-26.76-.44-3.11-.66-6.15-.66-9.03,0-23.52,14.73-32.45,17.68-34l.74-.18c1.96,0,67.61-.02,67.61-.02,1.08,0,2.07-.64,2.51-1.63l12.67-28.36c.16-.35.24-.73.24-1.12,0-.53-.15-1.06-.45-1.5-.51-.78-1.37-1.25-2.31-1.25h-.01l-39.68.16,6.11-3.06c26.36-10.32,42.33-10.86,42.48-10.86,1.06-.03,2.02-.67,2.45-1.63l12.92-29.16c.16-.35.24-.73.24-1.11,0-.53-.15-1.06-.45-1.5-.51-.78-1.37-1.25-2.3-1.25h0Z"/><path d="M118.57,17h0c-16.46,4.24-40.68,12.03-62.58,25.05-21.51,12.78-36.17,27.81-43.57,44.66-3.09,7.03-4.66,13.83-4.66,20.21,0,4.85.91,9.55,2.71,13.95,6.39,15.66,22.29,24.79,34.5,29.7,4.38,1.76,7.96,3.06,10.78,3.93-3.35-4.69-8.19-13.22-9.87-25.16-.47-3.29-.7-6.51-.7-9.58,0-29.26,21.04-38.59,21.25-38.68l.34-.14s67.05-.02,67.82-.02c.3-.67,10.35-23.17,11.05-24.74-1.8,0-55.29.22-55.29.22l3.73-3.19c.45-.38,3.48-2.62,19.27-8.8,23.03-9.01,38.14-10.72,42.71-11.04.28-.63,10.62-23.95,11.29-25.47-6.28.44-21.96,2.2-48.76,9.11Z"/><path d="M141.15,169.67c-36.06,0-59.06-8.32-68.38-24.73-2.96-5.22-4.46-11.12-4.46-17.56,0-13.53,6.51-24.86,7.26-26.1,1.07-1.79,3.02-2.9,5.09-2.9l64.97-.18L188.98,4.13c.95-2.07,3.05-3.43,5.33-3.45,1.7,0,41.84-.25,73.3,18.86,7.94,4.82,18.76,13.22,25.18,25.84,6.73,13.21,7.01,27.57.83,42.68-8.46,20.7-27.79,38.47-59.08,54.32-2.25,1.14-4.99.73-6.81-1.02-1.16-1.12-1.83-2.68-1.83-4.29,0-.86.18-1.69.54-2.47l33.38-72.92-16.9.05-43.28,93.3c-.73,1.58-2.11,2.75-3.78,3.22l-21.77,6.14c-2.21.62-4.6-.09-6.11-1.83-.94-1.08-1.45-2.46-1.45-3.89,0-.84.17-1.65.51-2.41l41.9-94.42-14.65.05-47.74,104.3c-.96,2.11-3.09,3.47-5.41,3.47ZM194.35,3.88c-1.06.01-2.02.64-2.47,1.6l-44.22,95.92-67.01.19c-.96,0-1.86.51-2.35,1.34-.28.46-6.81,11.58-6.81,24.47,0,5.88,1.36,11.25,4.05,15.98,8.71,15.34,30.78,23.12,65.6,23.12,1.07,0,2.05-.63,2.5-1.61l48.59-106.16,21.63-.07-43.9,98.93c-.16.36-.24.73-.24,1.12,0,.66.24,1.3.67,1.8.7.8,1.8,1.14,2.82.84l21.77-6.14c.77-.22,1.41-.76,1.75-1.49l44.13-95.14,23.93-.08-35.45,77.46c-.16.36-.25.75-.25,1.14,0,.75.31,1.47.84,1.98.84.81,2.11,1,3.15.47,30.58-15.49,49.41-32.72,57.57-52.68,5.81-14.21,5.57-27.68-.72-40.02-6.09-11.95-16.41-19.95-24-24.56C235.27,3.63,195.95,3.86,194.35,3.88h0Z"/><path d="M151.07,104.88h0l-.48,1.05s-68.14.19-68.86.19c-1.52,2.87-5.64,11.58-5.64,21.31,0,5.09,1.15,9.7,3.42,13.69,7.75,13.63,28.1,20.62,60.49,20.78.33-.71,49.31-107.74,49.31-107.74l31.57-.1s-44.17,99.55-45.19,101.84c2.08-.59,16.82-4.75,17.28-4.88.23-.5,45.01-97.02,45.01-97.02l33.94-.11s-34.77,75.96-36.2,79.1c26.81-14.33,43.44-30,50.74-47.87,2.54-6.23,3.83-12.35,3.83-18.19,0-21.37-16.73-34.72-26.7-40.78-26.61-16.16-60.55-17.61-68.06-17.72-.33.71-44.46,96.45-44.46,96.45Z"/><path d="M332.73,45.14v11.99h19.08v8.39h-19.08v19.65h-10.46v-48.48h31.83v8.46h-21.38Z"/><path d="M389.44,49.13v36.03h-9.42l-.27-3.76c-1.13,1.42-2.52,2.51-4.16,3.28s-3.52,1.15-5.63,1.15c-3.75,0-6.69-1.09-8.81-3.26-2.12-2.17-3.18-5.55-3.18-10.12v-23.31h10.02v23.38c0,1.78.44,3.09,1.32,3.93.88.84,2.09,1.27,3.65,1.27,3.08,0,5.23-1.08,6.43-3.23v-25.34h10.06Z"/><path d="M426.67,72.54c0,2.55-.67,4.84-2,6.86-1.33,2.02-3.13,3.6-5.41,4.73s-4.8,1.7-7.58,1.7c-3.62,0-6.68-.79-9.19-2.36-2.51-1.58-4.39-3.74-5.64-6.49-1.25-2.75-1.88-5.88-1.88-9.39v-.87c0-3.51.63-6.64,1.88-9.39,1.25-2.75,3.13-4.92,5.63-6.49,2.5-1.58,5.54-2.36,9.14-2.36,2.95,0,5.56.57,7.84,1.71,2.28,1.14,4.05,2.79,5.31,4.93,1.27,2.14,1.9,4.67,1.9,7.58h-9.42c-.02-1.78-.55-3.24-1.57-4.4-1.02-1.15-2.44-1.73-4.26-1.73-2.44,0-4.12.92-5.03,2.75s-1.37,4.3-1.37,7.41v.87c0,3.18.45,5.66,1.35,7.46s2.6,2.7,5.11,2.7c1.73,0,3.12-.47,4.16-1.4s1.58-2.2,1.6-3.8h9.42Z"/><path d="M460.12,51.83c2.1,2.24,3.15,5.83,3.15,10.76v22.58h-10.06v-22.64c0-2.17-.46-3.71-1.38-4.6-.92-.89-2.33-1.33-4.21-1.33-2.68,0-4.62.98-5.79,2.93v25.64h-10.06v-51.15h10.06v18.98c1.2-1.47,2.6-2.58,4.21-3.36,1.61-.78,3.37-1.17,5.28-1.17,3.78,0,6.71,1.12,8.81,3.36Z"/><path d="M469.52,59.72c0-2.04.58-3.92,1.75-5.63,1.17-1.71,2.85-3.07,5.04-4.1,2.2-1.02,4.76-1.53,7.69-1.53,3.08,0,5.78.5,8.09,1.48,2.31.99,4.08,2.36,5.33,4.13s1.86,3.78,1.86,6.04h-10.06c0-1.44-.43-2.57-1.3-3.38-.87-.81-2.19-1.22-3.96-1.22-1.47,0-2.63.35-3.51,1.03-.88.69-1.32,1.58-1.32,2.66s.5,1.89,1.48,2.53c.99.65,2.67,1.19,5.04,1.63,2.84.53,5.25,1.23,7.23,2.08,1.98.86,3.55,2.04,4.71,3.55,1.17,1.51,1.75,3.43,1.75,5.76,0,2.11-.63,4-1.88,5.68-1.25,1.68-3.04,2.99-5.36,3.95s-5.01,1.43-8.07,1.43c-3.24,0-6.04-.6-8.41-1.78s-4.16-2.71-5.39-4.58-1.85-3.81-1.85-5.83h9.49c.07,1.73.69,3.01,1.86,3.85,1.18.83,2.68,1.25,4.53,1.25,1.71,0,3.03-.33,3.95-.98.92-.65,1.38-1.54,1.38-2.65,0-.69-.2-1.27-.62-1.75-.41-.48-1.14-.93-2.2-1.35-1.05-.42-2.55-.84-4.48-1.27-8.52-1.82-12.79-5.49-12.79-11.02Z"/><path d="M505.82,68.41v-8.16h19.05v8.16h-19.05Z"/><path d="M584.87,85.16h-10.49v-12.52l1.03-23.18-12.72,35.7h-7.09l-12.69-35.7,1.03,23.18v12.52h-10.46v-48.48h13.69l11.99,34.6,11.99-34.6h13.72v48.48Z"/><path d="M593.21,57.36c1.34-2.77,3.3-4.95,5.88-6.53,2.58-1.58,5.65-2.36,9.22-2.36s6.69.79,9.27,2.36c2.58,1.58,4.55,3.75,5.89,6.53,1.34,2.78,2.01,5.93,2.01,9.46v.7c0,3.53-.67,6.68-2.01,9.44s-3.3,4.93-5.88,6.51c-2.58,1.58-5.65,2.36-9.22,2.36s-6.69-.79-9.27-2.36c-2.58-1.58-4.55-3.75-5.89-6.51s-2.01-5.91-2.01-9.44v-.7c0-3.53.67-6.68,2.01-9.46ZM602.95,74.95c1.13,1.85,2.94,2.78,5.43,2.78s4.23-.93,5.36-2.8,1.7-4.34,1.7-7.43v-.7c0-3.06-.57-5.54-1.7-7.43-1.13-1.89-2.94-2.83-5.43-2.83s-4.23.95-5.36,2.85-1.7,4.37-1.7,7.41v.7c0,3.11.57,5.59,1.7,7.44Z"/><path d="M661.22,49.13l-12.05,36.03h-9.76l-12.09-36.03h10.56l6.43,23.81,6.39-23.81h10.52Z"/><path d="M696.98,70.41h-22.78c.38,2.24,1.31,4.02,2.8,5.34,1.49,1.32,3.4,1.98,5.73,1.98,1.73,0,3.33-.33,4.81-.98,1.48-.65,2.73-1.64,3.78-2.95l4.83,5.56c-1.27,1.82-3.11,3.35-5.54,4.6s-5.28,1.86-8.54,1.86c-3.68,0-6.89-.78-9.61-2.33-2.72-1.55-4.81-3.66-6.26-6.33-1.45-2.66-2.18-5.6-2.18-8.82v-1.27c0-3.6.68-6.8,2.03-9.62,1.35-2.82,3.31-5.02,5.86-6.61,2.55-1.59,5.57-2.38,9.06-2.38s6.29.72,8.69,2.16c2.4,1.44,4.22,3.49,5.46,6.14,1.24,2.65,1.86,5.78,1.86,9.37v4.26ZM687.13,62.88c-.05-1.95-.58-3.5-1.61-4.63s-2.57-1.7-4.61-1.7c-1.91,0-3.4.63-4.48,1.9s-1.78,3.01-2.11,5.23h12.82v-.8Z"/><path d="M701.48,59.72c0-2.04.58-3.92,1.75-5.63,1.17-1.71,2.85-3.07,5.04-4.1,2.2-1.02,4.76-1.53,7.69-1.53,3.08,0,5.78.5,8.09,1.48,2.31.99,4.08,2.36,5.33,4.13s1.86,3.78,1.86,6.04h-10.06c0-1.44-.43-2.57-1.3-3.38-.87-.81-2.19-1.22-3.96-1.22-1.47,0-2.63.35-3.51,1.03-.88.69-1.32,1.58-1.32,2.66s.5,1.89,1.48,2.53c.99.65,2.67,1.19,5.04,1.63,2.84.53,5.25,1.23,7.23,2.08,1.98.86,3.55,2.04,4.71,3.55,1.17,1.51,1.75,3.43,1.75,5.76,0,2.11-.63,4-1.88,5.68-1.25,1.68-3.04,2.99-5.36,3.95s-5.01,1.43-8.07,1.43c-3.24,0-6.04-.6-8.41-1.78s-4.16-2.71-5.39-4.58-1.85-3.81-1.85-5.83h9.49c.07,1.73.69,3.01,1.86,3.85,1.18.83,2.68,1.25,4.53,1.25,1.71,0,3.03-.33,3.95-.98.92-.65,1.38-1.54,1.38-2.65,0-.69-.2-1.27-.62-1.75-.41-.48-1.14-.93-2.2-1.35-1.05-.42-2.55-.84-4.48-1.27-8.52-1.82-12.79-5.49-12.79-11.02Z"/><path d="M767.01,81.23c.25,1.27.61,2.39,1.1,3.36v.57h-10.09c-.45-.87-.77-1.94-.97-3.23-2.29,2.6-5.29,3.9-9.02,3.9-2.26,0-4.33-.47-6.19-1.4s-3.33-2.22-4.41-3.86c-1.08-1.64-1.61-3.5-1.61-5.56,0-3.8,1.41-6.72,4.23-8.77,2.82-2.05,6.97-3.08,12.45-3.08h4.1v-2.03c0-1.66-.42-2.96-1.27-3.88-.84-.92-2.11-1.38-3.8-1.38-1.53,0-2.73.36-3.58,1.08-.85.72-1.28,1.75-1.28,3.08h-10.06c0-2.15.64-4.11,1.91-5.86,1.28-1.75,3.08-3.14,5.43-4.16,2.34-1.02,5.04-1.53,8.11-1.53,2.84,0,5.36.48,7.56,1.43,2.2.96,3.92,2.39,5.16,4.3,1.24,1.91,1.86,4.24,1.86,6.99v15.08c0,2.04.12,3.7.37,4.96ZM754.15,77.25c1.11-.63,1.92-1.4,2.43-2.31v-6.03h-3.83c-2.33,0-4.07.51-5.21,1.52-1.14,1.01-1.71,2.33-1.71,3.95,0,1.13.4,2.05,1.22,2.76.81.71,1.89,1.07,3.25,1.07,1.47,0,2.75-.32,3.86-.95Z"/><path d="M335.33,116.73c1.2.87,2.11,2.08,2.73,3.65.62,1.57.94,3.41.94,5.5v.4c0,2.01-.31,3.8-.94,5.37s-1.54,2.8-2.73,3.69c-1.2.89-2.63,1.34-4.28,1.34-2.59,0-4.59-.9-6-2.71l-.17,2.33h-3.24v-29.09h3.54v10.79c1.4-1.72,3.35-2.57,5.83-2.57,1.68,0,3.12.43,4.32,1.3ZM335.46,125.89c0-2.25-.43-4.06-1.28-5.44-.85-1.38-2.21-2.07-4.06-2.07-1.2,0-2.21.29-3.02.86-.82.57-1.46,1.35-1.92,2.34v8.96c.48.97,1.13,1.75,1.96,2.33.82.58,1.83.87,3.02.87,1.78,0,3.11-.69,3.99-2.07s1.32-3.17,1.32-5.37v-.4Z"/><path d="M347.06,108.92c.37.38.56.86.56,1.44s-.19,1.04-.56,1.41c-.37.37-.89.56-1.54.56s-1.17-.19-1.52-.56c-.36-.37-.54-.84-.54-1.41s.18-1.06.54-1.44c.36-.38.87-.57,1.52-.57s1.17.19,1.54.57ZM343.71,136.31v-20.49h3.54v20.49h-3.54Z"/><path d="M358.6,126.8l-2.2,2.27v7.23h-3.54v-29.09h3.54v17.58l1.88-2.22,6.33-6.76h4.3l-7.97,8.54,8.92,11.95h-4.17l-7.08-9.51Z"/><path d="M389.03,127.03h-13.86c.04,1.28.3,2.43.79,3.47.49,1.04,1.19,1.85,2.09,2.45s1.96.9,3.17.9,2.21-.24,3.08-.72c.87-.48,1.64-1.17,2.32-2.06l2.14,1.67c-.76,1.16-1.77,2.11-3.03,2.85s-2.83,1.11-4.7,1.11-3.51-.42-4.94-1.27c-1.43-.84-2.53-2.02-3.3-3.52s-1.17-3.21-1.17-5.11v-.82c0-2.13.42-4,1.25-5.6.84-1.6,1.94-2.82,3.3-3.66,1.37-.85,2.84-1.27,4.4-1.27,1.91,0,3.49.43,4.74,1.28,1.26.85,2.19,2.03,2.79,3.53.61,1.5.91,3.24.91,5.21v1.57ZM385.49,123.92c-.1-1.6-.53-2.94-1.3-4.02-.76-1.08-1.96-1.62-3.61-1.62-1.41,0-2.59.51-3.53,1.54-.94,1.03-1.53,2.48-1.77,4.37h10.21v-.26Z"/><path d="M416.4,116.73c1.2.87,2.11,2.08,2.73,3.65.62,1.57.93,3.41.93,5.5v.4c0,2.01-.31,3.8-.94,5.37s-1.54,2.8-2.73,3.69c-1.19.89-2.62,1.34-4.27,1.34-2.48,0-4.42-.78-5.85-2.35v9.85h-3.54v-28.37h3.22l.19,2.24c1.43-1.74,3.4-2.61,5.93-2.61,1.69,0,3.14.43,4.34,1.3ZM416.51,125.89c0-1.41-.2-2.69-.6-3.82-.4-1.13-1.01-2.03-1.84-2.7-.83-.67-1.85-1.01-3.08-1.01-1.11,0-2.06.25-2.84.76-.78.51-1.42,1.19-1.89,2.06v9.87c1.05,1.86,2.64,2.78,4.77,2.78,1.22,0,2.23-.34,3.05-1.01.82-.67,1.43-1.58,1.83-2.72.4-1.14.6-2.41.6-3.83v-.4Z"/><path d="M440.31,134.06c.13.76.3,1.41.53,1.94v.3h-3.7c-.21-.49-.38-1.2-.49-2.14-.71.76-1.56,1.37-2.55,1.83-.99.46-2.08.69-3.27.69-1.36,0-2.57-.27-3.63-.81s-1.87-1.27-2.44-2.19-.86-1.94-.86-3.07c0-1.45.37-2.68,1.13-3.69.75-1.01,1.81-1.77,3.2-2.28,1.38-.51,3.01-.77,4.89-.77h3.45v-1.63c0-1.25-.37-2.23-1.11-2.94-.74-.71-1.8-1.07-3.19-1.07-.84,0-1.6.15-2.27.44-.67.3-1.19.7-1.56,1.19-.37.5-.56,1.04-.56,1.62h-3.54c0-1,.34-1.96,1.02-2.9s1.64-1.7,2.88-2.28,2.65-.88,4.24-.88,2.84.26,3.99.77c1.14.51,2.04,1.28,2.68,2.31.64,1.03.97,2.29.97,3.78v9.54c0,.72.06,1.46.19,2.23ZM433.62,133.23c.7-.28,1.3-.66,1.81-1.13.51-.47.89-.97,1.16-1.52v-4.24h-2.88c-2.02,0-3.57.32-4.64.96-1.07.64-1.61,1.58-1.61,2.83,0,.67.15,1.27.45,1.8s.75.95,1.33,1.26c.58.31,1.29.46,2.12.46s1.56-.14,2.26-.43Z"/><path d="M454.84,115.52c.34.06.57.12.7.18v3.24c-.54-.1-1.12-.15-1.72-.15-1.16,0-2.13.26-2.91.78-.78.52-1.36,1.24-1.75,2.18v14.56h-3.54v-20.49h3.45l.07,2.33c.53-.86,1.2-1.52,2.01-2,.81-.47,1.75-.71,2.84-.71.23,0,.51.03.85.09Z"/><path d="M468.39,136.31c-.81.25-1.71.38-2.71.38-1.43,0-2.57-.43-3.44-1.29-.87-.86-1.3-2.25-1.3-4.19v-12.73h-3.73v-2.67h3.73v-4.98h3.54v4.98h3.83v2.67h-3.83v12.74c0,.97.2,1.63.61,1.96s.95.5,1.65.5c.26,0,.55-.02.87-.07.32-.04.57-.09.76-.14l.02,2.82Z"/><path d="M474.11,125.19c-1.24-.91-1.86-2.16-1.86-3.77,0-1.08.31-2.08.94-2.99.63-.91,1.52-1.64,2.68-2.18,1.15-.54,2.48-.81,3.97-.81,1.59,0,2.98.28,4.17.85s2.09,1.34,2.72,2.3.94,2.04.94,3.23h-3.54c0-.58-.17-1.14-.51-1.68s-.84-.99-1.49-1.34c-.65-.35-1.41-.52-2.28-.52-.92,0-1.69.14-2.29.43-.61.28-1.05.66-1.34,1.12-.28.46-.43.96-.43,1.49s.13.99.39,1.35c.26.36.72.69,1.4.98.68.29,1.65.57,2.93.85,1.72.39,3.11.85,4.19,1.38s1.87,1.18,2.4,1.95c.52.77.78,1.7.78,2.8,0,1.19-.33,2.24-.98,3.15-.66.92-1.59,1.63-2.78,2.14-1.2.51-2.59.77-4.17.77-1.74,0-3.25-.31-4.52-.94-1.27-.63-2.23-1.45-2.89-2.47s-.99-2.11-.99-3.28h3.54c.05.91.32,1.65.79,2.22s1.08.99,1.79,1.24c.72.25,1.47.38,2.26.38.92,0,1.71-.13,2.38-.39.66-.26,1.17-.61,1.51-1.06s.51-.96.51-1.53-.12-1.06-.36-1.48c-.24-.42-.7-.8-1.38-1.16-.68-.35-1.67-.66-2.96-.93-2.43-.51-4.27-1.21-5.52-2.12Z"/><path d="M494.74,138.65c-.6,1.26-1.41,2.31-2.44,3.14l-2.01-1.36c.62-.87,1.09-1.74,1.4-2.61s.47-1.8.47-2.8v-2.86h3.46v2.8c0,1.2-.3,2.43-.89,3.69Z"/><path d="M509.9,120.51c.76-1.58,1.84-2.82,3.25-3.72,1.41-.9,3.05-1.35,4.92-1.35s3.55.45,4.96,1.35c1.41.9,2.5,2.14,3.25,3.72.76,1.58,1.14,3.36,1.14,5.34v.43c0,1.98-.38,3.76-1.14,5.33-.76,1.57-1.84,2.81-3.25,3.71-1.41.9-3.05,1.35-4.93,1.35s-3.53-.45-4.94-1.35c-1.41-.9-2.49-2.14-3.25-3.71-.77-1.57-1.14-3.35-1.14-5.33v-.43c0-1.98.38-3.76,1.14-5.34ZM512.95,130.09c.44,1.15,1.09,2.06,1.96,2.74.87.68,1.93,1.01,3.18,1.01s2.29-.34,3.16-1.01c.87-.67,1.52-1.59,1.96-2.74.43-1.15.65-2.42.65-3.81v-.43c0-1.39-.22-2.66-.67-3.81s-1.1-2.06-1.97-2.75c-.87-.68-1.93-1.02-3.18-1.02s-2.29.34-3.15,1.02c-.87.68-1.52,1.6-1.95,2.75-.43,1.15-.65,2.42-.65,3.81v.43c0,1.39.22,2.66.65,3.81Z"/><path d="M547.88,115.81v20.49h-3.37l-.06-2.03c-1.36,1.6-3.36,2.41-6,2.41-2.11,0-3.75-.62-4.94-1.86-1.19-1.24-1.78-3.17-1.78-5.79v-13.22h3.54v13.26c0,1.7.35,2.91,1.05,3.61.7.7,1.6,1.05,2.7,1.05,2.65,0,4.42-.99,5.32-2.97v-14.94h3.54Z"/><path d="M561.88,136.31c-.81.25-1.71.38-2.71.38-1.43,0-2.57-.43-3.44-1.29-.87-.86-1.3-2.25-1.3-4.19v-12.73h-3.73v-2.67h3.73v-4.98h3.54v4.98h3.83v2.67h-3.83v12.74c0,.97.2,1.63.61,1.96s.95.5,1.65.5c.26,0,.55-.02.87-.07.32-.04.57-.09.76-.14l.02,2.82Z"/><path d="M582.33,107.22v29.09h-3.24l-.17-2.18c-1.39,1.7-3.33,2.56-5.83,2.56-1.58,0-2.98-.45-4.21-1.34-1.22-.9-2.17-2.13-2.85-3.71-.68-1.58-1.02-3.36-1.02-5.34v-.4c0-2.07.34-3.89,1-5.47.67-1.58,1.62-2.8,2.84-3.67,1.22-.87,2.64-1.31,4.26-1.31,2.41,0,4.3.8,5.66,2.41v-10.63h3.54ZM578.79,130.76v-9.49c-.48-.9-1.12-1.6-1.9-2.12-.79-.52-1.75-.78-2.89-.78-1.22,0-2.24.33-3.06.99-.82.66-1.42,1.56-1.8,2.7-.39,1.14-.58,2.41-.58,3.83v.4c0,1.42.19,2.68.58,3.8.38,1.12.98,2,1.79,2.66.81.66,1.82.98,3.03.98,2.19,0,3.79-.99,4.83-2.97Z"/><path d="M588,120.51c.76-1.58,1.84-2.82,3.25-3.72,1.41-.9,3.05-1.35,4.92-1.35s3.55.45,4.96,1.35c1.41.9,2.5,2.14,3.25,3.72.76,1.58,1.14,3.36,1.14,5.34v.43c0,1.98-.38,3.76-1.14,5.33-.76,1.57-1.84,2.81-3.25,3.71-1.41.9-3.05,1.35-4.93,1.35s-3.53-.45-4.94-1.35c-1.41-.9-2.49-2.14-3.25-3.71-.77-1.57-1.14-3.35-1.14-5.33v-.43c0-1.98.38-3.76,1.14-5.34ZM591.05,130.09c.44,1.15,1.09,2.06,1.96,2.74.87.68,1.93,1.01,3.18,1.01s2.29-.34,3.16-1.01c.87-.67,1.52-1.59,1.96-2.74.43-1.15.65-2.42.65-3.81v-.43c0-1.39-.22-2.66-.67-3.81s-1.1-2.06-1.97-2.75c-.87-.68-1.93-1.02-3.18-1.02s-2.29.34-3.15,1.02c-.87.68-1.52,1.6-1.95,2.75-.43,1.15-.65,2.42-.65,3.81v.43c0,1.39.22,2.66.65,3.81Z"/><path d="M610.13,120.51c.76-1.58,1.84-2.82,3.25-3.72,1.41-.9,3.05-1.35,4.92-1.35s3.55.45,4.96,1.35c1.41.9,2.5,2.14,3.25,3.72.76,1.58,1.14,3.36,1.14,5.34v.43c0,1.98-.38,3.76-1.14,5.33-.76,1.57-1.84,2.81-3.25,3.71-1.41.9-3.05,1.35-4.93,1.35s-3.53-.45-4.94-1.35c-1.41-.9-2.49-2.14-3.25-3.71-.77-1.57-1.14-3.35-1.14-5.33v-.43c0-1.98.38-3.76,1.14-5.34ZM613.19,130.09c.44,1.15,1.09,2.06,1.96,2.74.87.68,1.93,1.01,3.18,1.01s2.29-.34,3.16-1.01c.87-.67,1.52-1.59,1.96-2.74.43-1.15.65-2.42.65-3.81v-.43c0-1.39-.22-2.66-.67-3.81s-1.1-2.06-1.97-2.75c-.87-.68-1.93-1.02-3.18-1.02s-2.29.34-3.15,1.02c-.87.68-1.52,1.6-1.95,2.75-.43,1.15-.65,2.42-.65,3.81v.43c0,1.39.22,2.66.65,3.81Z"/><path d="M641.27,115.52c.34.06.57.12.7.18v3.24c-.54-.1-1.12-.15-1.72-.15-1.16,0-2.13.26-2.91.78-.78.52-1.36,1.24-1.75,2.18v14.56h-3.54v-20.49h3.45l.07,2.33c.53-.86,1.2-1.52,2.01-2,.81-.47,1.75-.71,2.84-.71.23,0,.51.03.85.09Z"/><path d="M668.05,136.31l-1.82-2.18c-.92.83-2.01,1.47-3.28,1.9-1.26.43-2.53.65-3.83.65-1.81,0-3.38-.33-4.73-.99-1.35-.66-2.39-1.58-3.12-2.76-.72-1.17-1.09-2.52-1.09-4.03,0-1.05.22-2,.65-2.85.43-.85,1.03-1.64,1.79-2.36.76-.72,1.73-1.5,2.92-2.33-1.05-1.28-1.83-2.4-2.34-3.36s-.77-1.95-.77-2.96c0-1.42.28-2.62.85-3.63.57-1,1.37-1.76,2.41-2.28,1.04-.52,2.26-.78,3.65-.78,1.31,0,2.47.26,3.46.79,1,.52,1.76,1.23,2.3,2.12.54.89.81,1.86.81,2.91,0,1.24-.32,2.32-.95,3.24s-1.57,1.84-2.8,2.77l-2.06,1.53,6.11,7.33c.85-1.63,1.27-3.45,1.27-5.45h3.18c0,3.22-.78,5.88-2.33,7.99l3.94,4.73h-4.24ZM661.8,133.29c.87-.37,1.68-.9,2.42-1.58l-6.74-8.07-.77.59c-1.19.88-1.98,1.73-2.38,2.53-.4.8-.6,1.52-.6,2.15,0,.92.2,1.75.61,2.5s1.01,1.34,1.82,1.78c.81.44,1.8.66,2.97.66.91,0,1.8-.19,2.67-.56ZM657.52,111.7c-.5.33-.89.78-1.14,1.35s-.39,1.19-.39,1.88.19,1.35.57,2.07c.38.72.94,1.55,1.67,2.47l1.95-1.4c.87-.59,1.5-1.17,1.89-1.73s.59-1.28.59-2.17c0-.5-.13-.99-.4-1.45s-.65-.83-1.14-1.11c-.5-.28-1.09-.42-1.77-.42s-1.31.17-1.82.5Z"/><path d="M682.98,125.19c-1.24-.91-1.86-2.16-1.86-3.77,0-1.08.31-2.08.94-2.99.63-.91,1.52-1.64,2.68-2.18,1.15-.54,2.48-.81,3.97-.81,1.59,0,2.98.28,4.17.85s2.09,1.34,2.72,2.3.94,2.04.94,3.23h-3.54c0-.58-.17-1.14-.51-1.68s-.84-.99-1.49-1.34c-.65-.35-1.41-.52-2.28-.52-.92,0-1.69.14-2.29.43-.61.28-1.05.66-1.34,1.12-.28.46-.43.96-.43,1.49s.13.99.39,1.35c.26.36.72.69,1.4.98.68.29,1.65.57,2.93.85,1.72.39,3.11.85,4.19,1.38s1.87,1.18,2.4,1.95c.52.77.78,1.7.78,2.8,0,1.19-.33,2.24-.98,3.15-.66.92-1.59,1.63-2.78,2.14-1.2.51-2.59.77-4.17.77-1.74,0-3.25-.31-4.52-.94-1.27-.63-2.23-1.45-2.89-2.47s-.99-2.11-.99-3.28h3.54c.05.91.32,1.65.79,2.22s1.08.99,1.79,1.24c.72.25,1.47.38,2.26.38.92,0,1.71-.13,2.38-.39.66-.26,1.17-.61,1.51-1.06s.51-.96.51-1.53-.12-1.06-.36-1.48c-.24-.42-.7-.8-1.38-1.16-.68-.35-1.67-.66-2.96-.93-2.43-.51-4.27-1.21-5.52-2.12Z"/><path d="M714.95,116.73c1.2.87,2.11,2.08,2.73,3.65.62,1.57.93,3.41.93,5.5v.4c0,2.01-.31,3.8-.94,5.37s-1.54,2.8-2.73,3.69c-1.19.89-2.62,1.34-4.27,1.34-2.48,0-4.42-.78-5.85-2.35v9.85h-3.54v-28.37h3.22l.19,2.24c1.43-1.74,3.4-2.61,5.93-2.61,1.69,0,3.14.43,4.34,1.3ZM715.06,125.89c0-1.41-.2-2.69-.6-3.82-.4-1.13-1.01-2.03-1.84-2.7-.83-.67-1.85-1.01-3.08-1.01-1.11,0-2.06.25-2.84.76-.78.51-1.42,1.19-1.89,2.06v9.87c1.05,1.86,2.64,2.78,4.77,2.78,1.22,0,2.23-.34,3.05-1.01.82-.67,1.43-1.58,1.83-2.72.4-1.14.6-2.41.6-3.83v-.4Z"/><path d="M723.29,120.51c.76-1.58,1.84-2.82,3.25-3.72,1.41-.9,3.05-1.35,4.92-1.35s3.55.45,4.96,1.35c1.41.9,2.5,2.14,3.25,3.72.76,1.58,1.14,3.36,1.14,5.34v.43c0,1.98-.38,3.76-1.14,5.33-.76,1.57-1.84,2.81-3.25,3.71-1.41.9-3.05,1.35-4.93,1.35s-3.53-.45-4.94-1.35c-1.41-.9-2.49-2.14-3.25-3.71-.77-1.57-1.14-3.35-1.14-5.33v-.43c0-1.98.38-3.76,1.14-5.34ZM726.35,130.09c.44,1.15,1.09,2.06,1.96,2.74.87.68,1.93,1.01,3.18,1.01s2.29-.34,3.16-1.01c.87-.67,1.52-1.59,1.96-2.74.43-1.15.65-2.42.65-3.81v-.43c0-1.39-.22-2.66-.67-3.81s-1.1-2.06-1.97-2.75c-.87-.68-1.93-1.02-3.18-1.02s-2.29.34-3.15,1.02c-.87.68-1.52,1.6-1.95,2.75-.43,1.15-.65,2.42-.65,3.81v.43c0,1.39.22,2.66.65,3.81Z"/><path d="M754.42,115.52c.34.06.57.12.7.18v3.24c-.54-.1-1.12-.15-1.72-.15-1.16,0-2.13.26-2.91.78-.78.52-1.36,1.24-1.75,2.18v14.56h-3.54v-20.49h3.45l.07,2.33c.53-.86,1.2-1.52,2.01-2,.81-.47,1.75-.71,2.84-.71.23,0,.51.03.85.09Z"/><path d="M767.98,136.31c-.81.25-1.71.38-2.71.38-1.43,0-2.57-.43-3.44-1.29-.87-.86-1.3-2.25-1.3-4.19v-12.73h-3.73v-2.67h3.73v-4.98h3.54v4.98h3.83v2.67h-3.83v12.74c0,.97.2,1.63.61,1.96s.95.5,1.65.5c.26,0,.55-.02.87-.07.32-.04.57-.09.76-.14l.02,2.82Z"/></svg></a>
</div></header>

<main><section class="band"><div class="wrap" id="box">
  <h1>Werde Teil vom Team Fuchs-Movesa.</h1>
  <p class="intro">Du begeisterst dich für Bikes, Outdoor und Sport? Hinterlasse uns deine Kontaktdaten und deinen Wunschberuf. Sobald eine passende Stelle frei wird, melden wir uns bei dir.</p>

  <form id="f" action="/fumo/senden.php" method="post" novalidate>
    <div class="hp" aria-hidden="true"><label for="firma">Firma</label><input id="firma" name="firma" type="text" tabindex="-1" autocomplete="off"></div>
    <div class="field"><input id="vorname" name="vorname" type="text" autocomplete="given-name" placeholder=" " required><label for="vorname">Vorname *</label><span class="msg" id="vorname-m"></span></div>
    <div class="field"><input id="nachname" name="nachname" type="text" autocomplete="family-name" placeholder=" " required><label for="nachname">Nachname *</label><span class="msg" id="nachname-m"></span></div>
    <div class="field"><input id="telefon" name="telefon" type="tel" autocomplete="tel" inputmode="tel" placeholder=" " required><label for="telefon">Telefon *</label><span class="msg" id="telefon-m"></span></div>
    <div class="field"><input id="email" name="email" type="email" autocomplete="email" placeholder=" " required><label for="email">E-Mail *</label><span class="msg" id="email-m"></span></div>
    <div class="field full"><input id="beruf" name="wunschberuf" type="text" placeholder=" " required><label for="beruf">Wunschberuf *</label><span class="msg" id="beruf-m"></span></div>
    <p class="consent">Wir achten darauf, sorgfältig und respektvoll mit deinen Bewerberinformationen umzugehen. Deine Daten werden in der Regel nach 3 Monaten gelöscht, wenn kein aktiver Bewerbungsprozess besteht oder wenn du nicht in den Talentpool aufgenommen wirst. Wenn du zustimmst, im Talentpool zu sein, werden deine Daten ein Jahr gespeichert. So können wir dich für zukünftige Stellenangebote berücksichtigen und dich direkt kontaktieren, wenn passende Möglichkeiten verfügbar sind. Auf deinen Wunsch hin können wir deine Daten jederzeit löschen – hierfür reicht eine kurze Anfrage.</p>
    <div class="checks">
      <label class="check"><input type="checkbox" name="talentpool" value="1"><span>Ich möchte Teil des Scrambl. Talentpools werden</span></label>
      <label class="check"><input type="checkbox" name="partner_access" value="1"><span>Ich möchte, dass Fuchs-Movesa Zugang zu meinem Talentpool-Profil erhält</span></label>
      <label class="check" id="privacy-f"><input type="checkbox" id="privacy" name="privacy" value="1" required aria-describedby="privacy-m"><span>Ich habe die <a href="/datenschutz.php" target="_blank" rel="noopener">Datenschutzerklärung</a> zur Kenntnis genommen *</span></label>
      <span class="msg" id="privacy-m"></span>
    </div>
    <div class="actions"><button type="submit" id="send">Absenden</button><p class="senderr" id="senderr" role="alert"></p></div>
  </form>

  <div class="done" role="status" aria-live="polite">
    <h2>Danke, <span id="dn"></span>!</h2>
    <p>Deine Angaben sind bei uns angekommen. Wir melden uns, sobald eine passende Stelle frei wird.</p>
  </div>
</div></section></main>

<footer class="foot"><div class="in">
  <nav class="legal" aria-label="Rechtliches"><span>© Fuchs-Movesa AG</span><a href="/agb.php" target="_blank" rel="noopener">AGB</a><a href="/datenschutz.php" target="_blank" rel="noopener">Datenschutz</a></nav>
  <span>powered by <a href="https://scrambl.org" target="_blank" rel="noopener">Scrambl.</a></span>
</div></footer>

<script>
{
  const f=document.getElementById('f'), box=document.getElementById('box');
  const rules={
    vorname:v=>v.trim()?'':'Bitte gib deinen Vornamen ein.',
    nachname:v=>v.trim()?'':'Bitte gib deinen Nachnamen ein.',
    telefon:v=>/^[+\d][\d\s()\/-]{6,}$/.test(v.trim())?'':'Bitte gib eine gültige Telefonnummer ein.',
    email:v=>/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v.trim())?'':'Bitte gib eine gültige E-Mail-Adresse ein.',
    beruf:v=>v.trim()?'':'Bitte gib deinen Wunschberuf ein.'
  };
  const check=id=>{
    const el=document.getElementById(id), m=rules[id](el.value);
    el.closest('.field').classList.toggle('bad',!!m);
    el.setAttribute('aria-invalid',m?'true':'false');
    document.getElementById(id+'-m').textContent=m;
    return !m;
  };
  Object.keys(rules).forEach(id=>{
    const el=document.getElementById(id);
    el.setAttribute('aria-describedby',id+'-m');
    el.addEventListener('blur',()=>{ if(el.value) check(id); });
    el.addEventListener('input',()=>{ if(el.closest('.field').classList.contains('bad')) check(id); });
  });
  const priv=document.getElementById('privacy');
  const checkPrivacy=()=>{
    const ok=priv.checked;
    document.getElementById('privacy-f').classList.toggle('bad',!ok);
    priv.setAttribute('aria-invalid',ok?'false':'true');
    document.getElementById('privacy-m').textContent=ok?'':'Bitte bestätige, dass du die Datenschutzerklärung zur Kenntnis genommen hast.';
    return ok;
  };
  priv.addEventListener('change',()=>{ if(document.getElementById('privacy-f').classList.contains('bad')) checkPrivacy(); });
  const btn=document.getElementById('send'), err=document.getElementById('senderr');
  const map={wunschberuf:'beruf'};
  const done=()=>{
    document.getElementById('dn').textContent=document.getElementById('vorname').value.trim();
    box.classList.add('sent');
    window.scrollTo({top:0,behavior:'smooth'});
  };
  f.addEventListener('submit',async e=>{
    e.preventDefault();
    err.textContent='';
    const bad=Object.keys(rules).filter(id=>!check(id));
    const pOk=checkPrivacy();
    if(bad.length){ document.getElementById(bad[0]).focus(); return; }
    if(!pOk){ priv.focus(); return; }
    // Vorschau ausserhalb von scrambl.org: nichts senden, nur Bestätigung zeigen
    if(!/(^|\.)scrambl\.org$/.test(location.hostname)){ done(); return; }
    btn.disabled=true; btn.textContent='Wird gesendet …';
    try{
      const r=await fetch(f.getAttribute('action'),{method:'POST',body:new FormData(f),headers:{'Accept':'application/json'}});
      const j=await r.json().catch(()=>({}));
      if(r.ok && j.ok){ done(); return; }
      (j.felder||[]).forEach(n=>n==='privacy'?checkPrivacy():check(map[n]||n));
      err.textContent=j.fehler||'Das Senden hat nicht geklappt. Bitte versuche es nochmals.';
    }catch(x){
      err.textContent='Keine Verbindung. Bitte prüfe dein Internet und versuche es nochmals.';
    }
    btn.disabled=false; btn.textContent='Absenden';
  });
}
</script>
</body>
</html>
