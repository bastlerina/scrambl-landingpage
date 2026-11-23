<?php
require_once __DIR__ . '/i18n.php';
$pageTitle = t('meta.configurator_title');
$pageDescription = t('meta.configurator_description');
$currentPage = 'ausgangslage';
$hubspotUrl = 'https://meetings-eu1.hubspot.com/christina-weibel/scrambl-meeting';

// Deutsche Fassung der Fragen/Antworten fuer die interne Anfrage-Mail (unabhaengig von der Seitensprache)
$deT = require __DIR__ . '/lang/de.php';
$cfgSummaryDe = [];
foreach ([
    'groesse' => [1, ['xs', 'sm', 'md', 'lg'], '%s.opt.%s'],
    'hauptproblem' => [2, ['attraction', 'activation', 'development'], '%s.opt.%s.label'],
    'ats' => [3, ['aktiv', 'wenig', 'nein'], '%s.opt.%s'],
    'ausschreibungen' => [4, ['low', 'mid', 'high', 'vhigh'], '%s.opt.%s'],
    'themen' => [5, ['kosten', 'speed', 'fluktuation', 'mobilitaet', 'gl', 'compliance'], '%s.opt.%s'],
] as $id => [$n, $vals, $fmt]) {
    $opts = [];
    foreach ($vals as $v) $opts[$v] = $deT[sprintf($fmt, "cfg.step$n", $v)] ?? $v;
    $cfgSummaryDe[$id] = ['title' => $deT["cfg.step$n.title"] ?? $id, 'options' => $opts];
}

$steps = [
    [
        'id' => 'groesse', 'type' => 'pills',
        'title' => t('cfg.step1.title'), 'sub' => t('cfg.step1.sub'),
        'options' => [
            ['value' => 'xs', 'label' => t('cfg.step1.opt.xs')],
            ['value' => 'sm', 'label' => t('cfg.step1.opt.sm')],
            ['value' => 'md', 'label' => t('cfg.step1.opt.md')],
            ['value' => 'lg', 'label' => t('cfg.step1.opt.lg')],
        ],
    ],
    [
        'id' => 'hauptproblem', 'type' => 'cards',
        'title' => t('cfg.step2.title'), 'sub' => t('cfg.step2.sub'),
        'options' => [
            ['value' => 'attraction', 'label' => t('cfg.step2.opt.attraction.label'), 'sub' => t('cfg.step2.opt.attraction.sub')],
            ['value' => 'activation', 'label' => t('cfg.step2.opt.activation.label'), 'sub' => t('cfg.step2.opt.activation.sub')],
            ['value' => 'development', 'label' => t('cfg.step2.opt.development.label'), 'sub' => t('cfg.step2.opt.development.sub')],
        ],
    ],
    [
        'id' => 'ats', 'type' => 'pills',
        'title' => t('cfg.step3.title'), 'sub' => t('cfg.step3.sub'),
        'options' => [
            ['value' => 'aktiv', 'label' => t('cfg.step3.opt.aktiv')],
            ['value' => 'wenig', 'label' => t('cfg.step3.opt.wenig')],
            ['value' => 'nein', 'label' => t('cfg.step3.opt.nein')],
        ],
    ],
    [
        'id' => 'ausschreibungen', 'type' => 'pills',
        'title' => t('cfg.step4.title'), 'sub' => t('cfg.step4.sub'),
        'options' => [
            ['value' => 'low', 'label' => t('cfg.step4.opt.low')],
            ['value' => 'mid', 'label' => t('cfg.step4.opt.mid')],
            ['value' => 'high', 'label' => t('cfg.step4.opt.high')],
            ['value' => 'vhigh', 'label' => t('cfg.step4.opt.vhigh')],
        ],
    ],
    [
        'id' => 'themen', 'type' => 'pills-multi',
        'title' => t('cfg.step5.title'), 'sub' => t('cfg.step5.sub'),
        'options' => [
            ['value' => 'kosten', 'label' => t('cfg.step5.opt.kosten')],
            ['value' => 'speed', 'label' => t('cfg.step5.opt.speed')],
            ['value' => 'fluktuation', 'label' => t('cfg.step5.opt.fluktuation')],
            ['value' => 'mobilitaet', 'label' => t('cfg.step5.opt.mobilitaet')],
            ['value' => 'gl', 'label' => t('cfg.step5.opt.gl')],
            ['value' => 'compliance', 'label' => t('cfg.step5.opt.compliance')],
        ],
    ],
];

function cfg_result(string $key): array {
    return [
        'badge' => t("cfg.result.$key.badge"),
        'dotClass' => "dot-$key",
        'title' => t("cfg.result.$key.title"),
        'lead' => t("cfg.result.$key.lead"),
        'kpis' => [
            ['num' => t("cfg.result.$key.kpi1.num"), 'text' => t("cfg.result.$key.kpi1.text")],
            ['num' => t("cfg.result.$key.kpi2.num"), 'text' => t("cfg.result.$key.kpi2.text")],
            ['num' => t("cfg.result.$key.kpi3.num"), 'text' => t("cfg.result.$key.kpi3.text")],
        ],
        'steps' => [
            ['text' => t("cfg.result.$key.step1")],
            ['text' => t("cfg.result.$key.step2")],
            ['text' => t("cfg.result.$key.step3")],
            ['text' => t("cfg.result.$key.step4")],
        ],
        'also' => [t("cfg.result.$key.also1"), t("cfg.result.$key.also2")],
    ];
}

$results = [
    'attraction' => cfg_result('attraction'),
    'activation' => cfg_result('activation'),
    'development' => cfg_result('development'),
];

$labels = [
    'stepOf' => t('cfg.step_of'),
    'back' => t('cfg.nav.back'),
    'next' => t('cfg.nav.next'),
    'showResult' => t('cfg.nav.show_result'),
    'restart' => t('cfg.nav.restart'),
    'whatItMeans' => t('cfg.result.what_it_means'),
    'alsoRelevant' => t('cfg.result.also_relevant'),
];

include __DIR__ . '/partials/head.php';
include __DIR__ . '/partials/nav.php';
?>
<style>
.cfg-section { padding: 48px 0 80px; margin-top: 64px; }
.cfg-card { background: var(--white); border-radius: var(--radius); box-shadow: var(--shadow-md); max-width: 620px; margin: 32px auto 0; overflow: hidden; }
@media (max-width: 680px) { .cfg-card { margin: 32px 24px 0; } }
.cfg-progress-bar { height: 3px; background: var(--light); position: relative; overflow: hidden; }
.cfg-progress-fill { height: 100%; background: var(--green); transition: width 0.4s ease; }
.cfg-step-dots { display: flex; gap: 6px; padding: 16px 32px 0; }
.cfg-step-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--border); transition: all 0.3s; }
.cfg-step-dot.active { background: var(--green); width: 18px; border-radius: 3px; }
.cfg-step-dot.done { background: var(--green); opacity: 0.5; }
.cfg-form-header { padding: 24px 32px 0; }
.cfg-step-label { font-size: 11px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; color: var(--teal-dark); margin-bottom: 8px; }
.cfg-form-title { font-size: 1.15rem; font-weight: 700; line-height: 1.3; color: var(--dark); margin-bottom: 6px; }
.cfg-form-sub { font-size: 0.85rem; color: var(--mid); }
.cfg-form-body { padding: 20px 32px 24px; }
.cfg-pills { display: flex; flex-wrap: wrap; gap: 8px; }
.cfg-pill { font: inherit; font-size: 0.85rem; color: var(--dark-mid); background: var(--light); border: 1px solid var(--border); border-radius: 100px; padding: 7px 16px; cursor: pointer; transition: all 0.15s ease; }
.cfg-pill:hover { border-color: var(--teal); color: var(--teal-dark); }
.cfg-pill.selected { background: var(--teal-light); border-color: var(--teal); color: var(--teal-dark); font-weight: 600; }
.cfg-choice-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 10px; }
.cfg-choice-card { font: inherit; background: var(--light); border: 1px solid var(--border); border-radius: var(--radius); padding: 16px; cursor: pointer; text-align: left; transition: all 0.15s ease; }
.cfg-choice-card:hover { border-color: var(--teal); background: var(--white); }
.cfg-choice-card.selected { background: var(--teal-light); border-color: var(--teal); }
.cfg-card-title { font-size: 0.85rem; font-weight: 600; color: var(--dark); display: block; margin-bottom: 3px; }
.cfg-card-sub { font-size: 0.75rem; color: var(--mid); }
.cfg-form-footer { padding: 0 32px 28px; display: flex; align-items: center; justify-content: space-between; gap: 12px; }
.cfg-btn-back { font-size: 0.85rem; color: var(--mid); background: none; border: none; cursor: pointer; }
.cfg-btn-back:hover { color: var(--dark-mid); }
.cfg-btn-next { font-size: 0.9rem; font-weight: 600; color: #fff; background: var(--teal); border: none; border-radius: 100px; padding: 11px 26px; cursor: pointer; transition: background 0.15s, opacity 0.15s; }
.cfg-btn-next:hover { background: var(--teal-dark); }
.cfg-btn-next:disabled { opacity: 0.4; cursor: not-allowed; }
.cfg-result-screen { display: none; opacity: 0; transition: opacity 0.35s ease; }
.cfg-result-screen.visible { display: block; opacity: 1; }
.cfg-result-badge { display: inline-flex; align-items: center; gap: 6px; font-size: 0.7rem; font-weight: 600; letter-spacing: 0.06em; text-transform: uppercase; padding: 5px 12px; border-radius: 100px; margin-bottom: 14px; }
.badge-attraction { background: var(--teal-light); color: var(--teal-dark); }
.badge-activation { background: var(--green-light); color: var(--green-dark); }
.badge-development { background: var(--light); color: var(--dark); }
.cfg-result-title { font-size: 1.25rem; font-weight: 700; line-height: 1.25; color: var(--dark); margin-bottom: 10px; }
.cfg-result-lead { font-size: 0.9rem; color: var(--dark-mid); margin-bottom: 20px; line-height: 1.65; }
.cfg-result-divider { height: 1px; background: var(--border); margin: 20px 0; }
.cfg-kpi-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-bottom: 20px; }
.cfg-kpi-item { background: var(--light); border-radius: var(--radius); padding: 14px 12px; text-align: center; }
.cfg-kpi-num { font-size: 1.3rem; font-weight: 700; display: block; margin-bottom: 4px; }
.cfg-kpi-item.dot-attraction .cfg-kpi-num { color: var(--teal-dark); }
.cfg-kpi-item.dot-activation .cfg-kpi-num { color: var(--green-dark); }
.cfg-kpi-item.dot-development .cfg-kpi-num { color: var(--dark); }
.cfg-kpi-text { font-size: 0.72rem; color: var(--mid); line-height: 1.35; }
.cfg-result-steps { list-style: none; }
.cfg-result-step { display: flex; gap: 14px; align-items: flex-start; margin-bottom: 14px; }
.cfg-step-dot-num { width: 24px; height: 24px; border-radius: 50%; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; font-weight: 600; }
.dot-attraction.cfg-step-dot-num { background: var(--teal-light); color: var(--teal-dark); }
.dot-activation.cfg-step-dot-num { background: var(--green-light); color: var(--green-dark); }
.dot-development.cfg-step-dot-num { background: var(--light); color: var(--dark); }
.cfg-step-text { font-size: 0.85rem; color: var(--dark-mid); line-height: 1.55; }
.cfg-step-text strong { color: var(--dark); font-weight: 600; }
.cfg-also-relevant { background: var(--light); border-radius: var(--radius); padding: 14px 16px; margin-top: 16px; }
.cfg-also-label { font-size: 0.7rem; font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase; color: var(--mid); margin-bottom: 8px; }
.cfg-also-tags { display: flex; flex-wrap: wrap; gap: 6px; }
.cfg-also-tag { font-size: 0.75rem; background: var(--white); border: 1px solid var(--border); color: var(--dark-mid); padding: 4px 12px; border-radius: 100px; }
.cfg-cta-section { margin-top: 24px; padding: 20px 0 0; border-top: 1px solid var(--border); display: flex; flex-direction: column; gap: 10px; }
.cfg-btn-cta-primary { font-size: 0.9rem; font-weight: 600; color: #fff; background: var(--teal); border: none; border-radius: 100px; padding: 13px 28px; cursor: pointer; width: 100%; transition: background 0.15s; text-align: center; text-decoration: none; }
.cfg-btn-cta-primary:hover { background: var(--teal-dark); }
.cfg-btn-cta-secondary { cursor: pointer; font-size: 0.85rem; color: var(--dark-mid); background: none; border: 1px solid var(--border); border-radius: 100px; padding: 10px 24px; width: 100%; transition: all 0.15s; text-decoration: none; text-align: center; display: block; }
.cfg-btn-cta-secondary:hover { border-color: var(--teal); color: var(--teal-dark); }
.cfg-restart-btn { font-size: 0.78rem; color: var(--mid); background: none; border: none; cursor: pointer; margin-top: 4px; text-align: center; }
@media (max-width: 480px) {
  .cfg-form-header, .cfg-form-body, .cfg-form-footer { padding-left: 20px; padding-right: 20px; }
  .cfg-kpi-grid { grid-template-columns: 1fr; }
}
</style>

<section class="cfg-section">
  <div class="container-sm" style="text-align:center; max-width:820px;">
    <h1 class="section-title-center" style="margin-top:2.5rem;"><?= title_dot(t('cfg.hero.title'), 'green') ?></h1>
    <p class="section-sub"><?= h(t('cfg.hero.text')) ?></p>
  </div>

  <div class="cfg-card" id="cfgCard">
    <div class="cfg-progress-bar"><div class="cfg-progress-fill" id="cfgProgressFill" style="width:0%"></div></div>
    <div class="cfg-step-dots" id="cfgStepDots"></div>
    <div id="cfgStepContainer"></div>

    <div id="cfgResultScreen" class="cfg-result-screen">
      <div class="cfg-form-header">
        <div id="cfgResultBadge" class="cfg-result-badge"></div>
        <div class="cfg-result-title" id="cfgResultTitle"></div>
        <div class="cfg-result-lead" id="cfgResultLead"></div>
      </div>
      <div class="cfg-form-body">
        <div class="cfg-kpi-grid" id="cfgResultKpis"></div>
        <div class="cfg-result-divider"></div>
        <p class="cfg-form-sub" style="margin-bottom:14px;font-weight:600;color:var(--dark);"><?= h(t('cfg.result.what_it_means')) ?></p>
        <ul class="cfg-result-steps" id="cfgResultSteps"></ul>
        <div class="cfg-also-relevant" id="cfgAlsoRelevant" style="display:none">
          <div class="cfg-also-label"><?= h(t('cfg.result.also_relevant')) ?></div>
          <div class="cfg-also-tags" id="cfgAlsoTags"></div>
        </div>
        <div class="cfg-cta-section">
          <a href="<?= h($hubspotUrl) ?>" target="_blank" rel="noopener" class="cfg-btn-cta-primary"><?= h(t('cfg.result.cta_primary')) ?></a>
          <button type="button" class="cfg-btn-cta-secondary" data-offer-open=""><?= h(t('ta.solution.offer_cta')) ?></button>
          <button class="cfg-restart-btn" onclick="cfgRestart()"><?= h(t('cfg.nav.restart')) ?></button>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
const CFG_STEPS = <?= json_encode($steps, JSON_UNESCAPED_UNICODE) ?>;
const CFG_RESULTS = <?= json_encode($results, JSON_UNESCAPED_UNICODE) ?>;
const CFG_LABELS = <?= json_encode($labels, JSON_UNESCAPED_UNICODE) ?>;
const CFG_SUMMARY_DE = <?= json_encode($cfgSummaryDe, JSON_UNESCAPED_UNICODE) ?>;

let cfgCurrentStep = 0;
let cfgAnswers = {};

function cfgBuildStepDots() {
  const container = document.getElementById('cfgStepDots');
  container.innerHTML = '';
  CFG_STEPS.forEach((_, i) => {
    const dot = document.createElement('div');
    dot.className = 'cfg-step-dot' + (i === 0 ? ' active' : '');
    dot.id = 'cfg-dot-' + i;
    container.appendChild(dot);
  });
}

function cfgUpdateDots() {
  CFG_STEPS.forEach((_, i) => {
    const dot = document.getElementById('cfg-dot-' + i);
    if (!dot) return;
    dot.className = 'cfg-step-dot';
    if (i < cfgCurrentStep) dot.classList.add('done');
    else if (i === cfgCurrentStep) dot.classList.add('active');
  });
}

function cfgRenderStep(idx) {
  const step = CFG_STEPS[idx];
  const container = document.getElementById('cfgStepContainer');
  const pct = Math.round((idx / CFG_STEPS.length) * 100);
  document.getElementById('cfgProgressFill').style.width = pct + '%';
  cfgUpdateDots();

  let optionsHTML = '';
  if (step.type === 'pills' || step.type === 'pills-multi') {
    const multi = step.type === 'pills-multi';
    optionsHTML = `<div class="cfg-pills" id="cfgOptGroup">${step.options.map(o =>
      `<button type="button" class="cfg-pill" data-value="${o.value}" onclick="cfgSelectOption(this, ${multi})">${o.label}</button>`
    ).join('')}</div>`;
  } else if (step.type === 'cards') {
    optionsHTML = `<div class="cfg-choice-cards" id="cfgOptGroup">${step.options.map(o =>
      `<button type="button" class="cfg-choice-card" data-value="${o.value}" onclick="cfgSelectOption(this, false)">
        <span class="cfg-card-title">${o.label}</span>
        <span class="cfg-card-sub">${o.sub}</span>
      </button>`
    ).join('')}</div>`;
  }

  const isLast = idx === CFG_STEPS.length - 1;
  const stepOfLabel = CFG_LABELS.stepOf.replace('%d', idx + 1).replace('%d', CFG_STEPS.length);

  container.innerHTML = `
    <div class="cfg-step-screen">
      <div class="cfg-form-header">
        <div class="cfg-step-label">${stepOfLabel}</div>
        <div class="cfg-form-title">${step.title}</div>
        <div class="cfg-form-sub">${step.sub}</div>
      </div>
      <div class="cfg-form-body">
        <div>${optionsHTML}</div>
      </div>
      <div class="cfg-form-footer">
        ${idx > 0 ? '<button class="cfg-btn-back" onclick="cfgGoBack()">' + CFG_LABELS.back + '</button>' : '<span></span>'}
        <button class="cfg-btn-next" id="cfgBtnNext" onclick="cfgGoNext()" disabled>
          ${isLast ? CFG_LABELS.showResult : CFG_LABELS.next} →
        </button>
      </div>
    </div>
  `;

  const prev = cfgAnswers[step.id];
  if (prev) {
    const all = document.querySelectorAll('#cfgOptGroup [data-value]');
    all.forEach(el => {
      const vals = Array.isArray(prev) ? prev : [prev];
      if (vals.includes(el.dataset.value)) el.classList.add('selected');
    });
    document.getElementById('cfgBtnNext').disabled = false;
  }
}

function cfgSelectOption(el, multi) {
  if (multi) {
    el.classList.toggle('selected');
  } else {
    document.getElementById('cfgOptGroup').querySelectorAll('.cfg-pill, .cfg-choice-card').forEach(b => b.classList.remove('selected'));
    el.classList.add('selected');
  }
  const selected = document.querySelectorAll('#cfgOptGroup .selected');
  document.getElementById('cfgBtnNext').disabled = selected.length === 0;
}

function cfgGoNext() {
  const step = CFG_STEPS[cfgCurrentStep];
  const selected = document.querySelectorAll('#cfgOptGroup .selected');
  if (selected.length === 0) return;

  const values = Array.from(selected).map(el => el.dataset.value);
  cfgAnswers[step.id] = step.type === 'pills-multi' ? values : values[0];

  if (cfgCurrentStep < CFG_STEPS.length - 1) {
    cfgCurrentStep++;
    cfgRenderStep(cfgCurrentStep);
  } else {
    cfgShowResult();
  }
}

function cfgGoBack() {
  if (cfgCurrentStep > 0) {
    cfgCurrentStep--;
    cfgRenderStep(cfgCurrentStep);
  }
}

function cfgComputeResult() {
  let primary = cfgAnswers.hauptproblem || 'attraction';
  const themen = cfgAnswers.themen || [];
  if (themen.includes('mobilitaet') || themen.includes('fluktuation')) {
    if (primary !== 'activation') primary = 'development';
  }
  if (cfgAnswers.ats === 'aktiv' && primary === 'attraction' && (themen.includes('kosten') || themen.includes('speed'))) {
    primary = 'activation';
  }
  return primary;
}

function cfgShowResult() {
  const key = cfgComputeResult();
  const r = CFG_RESULTS[key];

  document.getElementById('cfgStepContainer').style.display = 'none';
  document.getElementById('cfgStepDots').style.display = 'none';
  document.getElementById('cfgProgressFill').style.width = '100%';

  document.getElementById('cfgResultBadge').className = 'cfg-result-badge badge-' + key;
  document.getElementById('cfgResultBadge').textContent = '✦ ' + r.badge;
  // Overlay "Angebot erhalten": Ergebnis und alle Antworten des Wizards in die Anfrage uebernehmen
  const offerModal = document.getElementById('offerModal');
  if (offerModal) {
    const resultName = {attraction: 'Talent Attraction', activation: 'Talent Activation', development: 'Talent Development'}[key] || key;
    offerModal.dataset.offerTopic = 'Ausgangslage einschätzen – Ergebnis: ' + resultName;
    const lines = Object.keys(CFG_SUMMARY_DE).map(id => {
      const q = CFG_SUMMARY_DE[id];
      const a = cfgAnswers[id];
      const vals = (Array.isArray(a) ? a : (a ? [a] : [])).map(v => q.options[v] || v);
      return '- ' + q.title + ': ' + (vals.length ? vals.join(', ') : '–');
    });
    offerModal.dataset.offerDetails = 'Antworten im Wizard:\n' + lines.join('\n');
  }
  document.getElementById('cfgResultTitle').textContent = r.title;
  document.getElementById('cfgResultLead').textContent = r.lead;

  document.getElementById('cfgResultKpis').innerHTML = r.kpis.map(k =>
    `<div class="cfg-kpi-item dot-${key}"><span class="cfg-kpi-num">${k.num}</span><span class="cfg-kpi-text">${k.text}</span></div>`
  ).join('');

  document.getElementById('cfgResultSteps').innerHTML = r.steps.map((s, i) =>
    `<li class="cfg-result-step">
      <div class="cfg-step-dot-num dot-${key}">${i + 1}</div>
      <span class="cfg-step-text">${s.text}</span>
    </li>`
  ).join('');

  if (r.also && r.also.length) {
    document.getElementById('cfgAlsoRelevant').style.display = 'block';
    document.getElementById('cfgAlsoTags').innerHTML = r.also.map(t => `<span class="cfg-also-tag">${t}</span>`).join('');
  }

  const rs = document.getElementById('cfgResultScreen');
  rs.style.display = 'block';
  requestAnimationFrame(() => rs.classList.add('visible'));

  fetch('submit-configurator.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      groesse: cfgAnswers.groesse || '',
      hauptproblem: cfgAnswers.hauptproblem || '',
      ats: cfgAnswers.ats || '',
      ausschreibungen: cfgAnswers.ausschreibungen || '',
      themen: cfgAnswers.themen || [],
      result_key: key,
    })
  }).catch(() => {});
}

function cfgRestart() {
  cfgCurrentStep = 0;
  cfgAnswers = {};
  document.getElementById('cfgResultScreen').classList.remove('visible');
  document.getElementById('cfgResultScreen').style.display = 'none';
  document.getElementById('cfgStepContainer').style.display = '';
  document.getElementById('cfgStepDots').style.display = '';
  cfgRenderStep(0);
}

cfgBuildStepDots();
cfgRenderStep(0);
</script>

<?php $offerWithModules = false; $offerTopic = 'Ausgangslage einschätzen'; include __DIR__ . '/partials/offer-modal.php'; ?>

<?php include __DIR__ . '/partials/footer.php'; ?>
