/* ============================================================
   SCRAMBL – Interactive JS
   ============================================================ */

document.addEventListener('DOMContentLoaded', () => {

  // --- Scroll reveal (fade-in) ---
  // Dezentes Einblenden von unten fuer alle Inhaltselemente (nicht im Overlay)
  const revealSelectors = [
    '.card', '.card-entry', '.solution-block', '.stat-item', '.stat-box', '.faq-item', '.benefit-row',
    '.process-step', '.check-row', '.feat-row', '.testimonial-slider', '.tile-card',
    'section h1', 'section h2', '.hero-text', '.hero-img', '.hero-page p', '.hero-page .btn',
    '.section-sub', '.section-sub-white', '.img-before-title', '.si-berufe-img', '.client-logo',
    '.check-hint', '.team-card', '.contact-form', '.legal-content', '.cfg-card'
  ].join(', ');
  const revealCandidates = [...document.querySelectorAll(revealSelectors)].filter(el => !el.closest('.offer-modal'));
  // verschachtelte Treffer nur einmal animieren (aeusseres Element genuegt)
  const revealEls = revealCandidates.filter(el => !revealCandidates.some(o => o !== el && o.contains(el)));
  if ('IntersectionObserver' in window && revealEls.length) {
    revealEls.forEach(el => el.classList.add('reveal'));
    const revealObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('in-view');
          revealObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.05, rootMargin: '0px 0px -30px 0px' });
    revealEls.forEach(el => revealObserver.observe(el));
    // Elemente, die beim Laden schon sichtbar sind, sicher einblenden (auch wenn Bilder noch laden)
    requestAnimationFrame(() => revealEls.forEach(el => {
      if (el.getBoundingClientRect().top < window.innerHeight) el.classList.add('in-view');
    }));
  }

  // --- Navbar scroll effect ---
  const navbar = document.getElementById('navbar');
  if (navbar) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 30) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    });
  }

  // --- Sprachauswahl-Dropdown ---
  const langDropdown = document.getElementById('langDropdown');
  const langDropdownToggle = document.getElementById('langDropdownToggle');
  if (langDropdown && langDropdownToggle) {
    langDropdownToggle.addEventListener('click', (e) => {
      e.stopPropagation();
      const isOpen = langDropdown.classList.toggle('open');
      langDropdownToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
    document.addEventListener('click', (e) => {
      if (!langDropdown.contains(e.target)) {
        langDropdown.classList.remove('open');
        langDropdownToggle.setAttribute('aria-expanded', 'false');
      }
    });
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        langDropdown.classList.remove('open');
        langDropdownToggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  // --- Hamburger menu ---
  const hamburger = document.getElementById('hamburger');
  const navLinks  = document.querySelector('.nav-links');
  const navbarWave = document.querySelector('.navbar-wave');
  if (hamburger && navLinks) {
    hamburger.addEventListener('click', () => {
      const opening = !navLinks.classList.contains('open');
      navLinks.classList.toggle('open');
      hamburger.classList.toggle('active');
      if (navbarWave) {
        if (opening) {
          navbarWave.style.top = (64 + navLinks.offsetHeight) + 'px';
        } else {
          navbarWave.style.top = '';
        }
      }
    });
    window.addEventListener('resize', () => {
      if (window.innerWidth > 879) {
        navLinks.classList.remove('open');
        hamburger.classList.remove('active');
        if (navbarWave) navbarWave.style.top = '';
      }
    });
  }

  // --- Accordion (neue Klassen: .acc-header / .acc-item) ---
  document.querySelectorAll('.acc-header').forEach(btn => {
    btn.addEventListener('click', () => {
      const item = btn.closest('.acc-item');
      const isOpen = item.classList.contains('open');
      document.querySelectorAll('.acc-item').forEach(i => i.classList.remove('open'));
      if (!isOpen) item.classList.add('open');
    });
  });

  // --- Checklist counter (neue Klassen: .check-row) ---
  const checkItems = document.querySelectorAll('.check-row input[type="checkbox"]');
  const checkHint  = document.getElementById('checkHint');
  if (checkItems.length && checkHint) {
    const originalText = checkHint.textContent;
    checkItems.forEach(cb => {
      cb.addEventListener('change', () => {
        const checked = document.querySelectorAll('.check-row input:checked').length;
        if (checked >= 2) {
          checkHint.style.background = 'var(--teal)';
          checkHint.style.borderColor = 'var(--teal-dark)';
          checkHint.style.color = 'var(--white)';
          checkHint.textContent = (checkHint.dataset.checkedText || '{n}').replace('{n}', checked);
        } else {
          checkHint.style.background = '';
          checkHint.style.borderColor = '';
          checkHint.style.color = '';
          checkHint.textContent = originalText;
        }
      });
    });
  }

  // --- Smooth scroll for anchor links ---
  document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', e => {
      const target = document.querySelector(link.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  // --- Overlay "Angebot erhalten": oeffnen mit vorausgewaehltem Angebot ---
  const offerModal = document.getElementById('offerModal');
  if (offerModal) {
    const offerForm = offerModal.querySelector('form');
    const boxes = offerModal.querySelectorAll('input[name="offer_module"]');
    const moduleError = offerModal.querySelector('.offer-module-error');
    let lastTrigger = null;
    const openOffer = (key, trigger) => {
      offerForm.hidden = false;
      const done = offerModal.querySelector('.offer-success');
      if (done) done.hidden = true;
      boxes.forEach(b => { b.checked = b.dataset.offerKey === key; });
      if (moduleError) moduleError.hidden = true;
      offerModal.hidden = false;
      document.body.classList.add('offer-modal-open');
      lastTrigger = trigger;
      const first = offerForm.querySelector('input[name="first_name"]');
      if (first) setTimeout(() => first.focus(), 50);
    };
    const closeOffer = () => {
      offerModal.hidden = true;
      document.body.classList.remove('offer-modal-open');
      if (lastTrigger) lastTrigger.focus();
    };
    document.querySelectorAll('[data-offer-open]').forEach(btn => {
      btn.addEventListener('click', () => {
        // optional eigenes Thema pro Button (z.B. Leistungsmodul), sonst Thema der Seite
        offerModal.dataset.buttonTopic = btn.dataset.offerTopic || '';
        openOffer(btn.dataset.offerOpen, btn);
      });
    });
    offerModal.querySelectorAll('[data-offer-close]').forEach(el => el.addEventListener('click', closeOffer));
    document.addEventListener('keydown', e => { if (e.key === 'Escape' && !offerModal.hidden) closeOffer(); });
    boxes.forEach(b => b.addEventListener('change', () => { if (moduleError) moduleError.hidden = true; }));
    // Gewaehlte Angebote in die Nachricht schreiben (laeuft vor dem allgemeinen Formular-Versand unten)
    offerForm.addEventListener('submit', e => {
      if (!boxes.length) {
        offerForm.querySelector('input[name="message"]').value = 'Angebotsanfrage: ' + (offerModal.dataset.buttonTopic || offerModal.dataset.offerTopic || document.title)
          + (offerModal.dataset.offerDetails ? '\n\n' + offerModal.dataset.offerDetails : '');
        return;
      }
      const chosen = [...boxes].filter(b => b.checked).map(b => b.value);
      if (!chosen.length) {
        e.preventDefault();
        e.stopImmediatePropagation();
        if (moduleError) moduleError.hidden = false;
        return;
      }
      offerForm.querySelector('input[name="message"]').value = 'Angebotsanfrage für: ' + chosen.join(', ');
    });
  }

  // --- Kontaktformulare ---
  document.querySelectorAll('form.contact-form').forEach(form => {
    form.addEventListener('submit', e => {
      e.preventDefault();
      const btn = form.querySelector('button[type="submit"]');
      const msg = form.querySelector('.form-message');
      const orig = btn ? btn.textContent : '';

      const data = new FormData(form);
      data.set('source_page', document.title || location.pathname);
      data.set('source_url', location.href);
      data.set('lang', document.documentElement.lang || '');

      if (btn) { btn.disabled = true; btn.textContent = window.SITE_I18N?.formSending || 'Wird gesendet...'; }

      fetch('submit-form.php', { method: 'POST', body: data })
        .then(r => r.json())
        .then(result => {
          if (result.success) {
            if (btn) { btn.textContent = '✓ ' + (window.SITE_I18N?.formSent || 'Anfrage gesendet!'); btn.style.background = 'var(--success)'; btn.style.borderColor = 'var(--success)'; }
            const thanks = window.SITE_I18N?.formThanks || 'Vielen Dank! Wir haben Ihre Anfrage erhalten und melden uns in Kürze bei Ihnen.';
            const modal = form.closest('.offer-modal');
            if (modal) {
              // Overlay: Formular durch Bestaetigung ersetzen
              const done = modal.querySelector('.offer-success');
              if (done) { form.hidden = true; done.hidden = false; }
            } else if (msg) {
              msg.textContent = thanks;
              msg.style.color = 'var(--dark)';
              msg.style.fontWeight = '600';
              msg.style.display = 'block';
            }
            setTimeout(() => {
              if (btn) { btn.disabled = false; btn.textContent = orig; btn.style.background = ''; btn.style.borderColor = ''; }
              form.reset();
            }, 3000);
          } else {
            throw new Error(result.error || 'unknown');
          }
        })
        .catch(() => {
          if (btn) { btn.disabled = false; btn.textContent = orig; }
          if (msg) {
            msg.textContent = window.SITE_I18N?.formError || 'Da ist etwas schiefgelaufen. Bitte versuchen Sie es erneut oder schreiben Sie uns direkt eine E-Mail.';
            msg.style.color = 'var(--error)';
            msg.style.display = 'block';
          }
        });
    });
  });

  // Testimonial-Slider (seitlicher Slide statt Fade von unten)
  document.querySelectorAll('.testimonial-slider').forEach(slider => {
    const cards = slider.querySelectorAll('.testimonial-card');
    const dots = slider.querySelectorAll('.testimonial-dot');
    let current = 0;
    cards.forEach((c, i) => { if (c.classList.contains('active')) current = i; });

    dots.forEach(dot => {
      dot.addEventListener('click', () => {
        const index = parseInt(dot.dataset.index, 10);
        if (index === current) return;
        const goingForward = index > current;
        const oldCard = cards[current];
        const newCard = cards[index];

        oldCard.classList.remove('active');
        if (goingForward) {
          oldCard.classList.add('prev');
          newCard.classList.remove('prev');
        } else {
          oldCard.classList.remove('prev');
          newCard.classList.add('prev');
          // Force layout at the "prev" (left) position before animating in from there
          newCard.getBoundingClientRect();
        }
        requestAnimationFrame(() => {
          newCard.classList.add('active');
          newCard.classList.remove('prev');
        });

        dots.forEach(d => d.classList.toggle('active', parseInt(d.dataset.index, 10) === index));
        current = index;
      });
    });
    // Pfeile links/rechts: zum vorherigen/naechsten Testimonial (rundum)
    const go = (step) => { const i = (current + step + cards.length) % cards.length; if (dots[i]) dots[i].click(); };
    const prevBtn = slider.querySelector('.testimonial-arrow--prev');
    const nextBtn = slider.querySelector('.testimonial-arrow--next');
    if (prevBtn) prevBtn.addEventListener('click', () => go(-1));
    if (nextBtn) nextBtn.addEventListener('click', () => go(1));
  });

});
