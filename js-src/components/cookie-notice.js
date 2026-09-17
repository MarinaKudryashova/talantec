const COOKIE_KEY = 'cookieAccepted';
const COOKIE_MAX_AGE = 60 * 60 * 24 * 365;
const CONSENT_EVENT = 'architect:cookie-consent';

const readConsent = () => {
  try {
    const stored = localStorage.getItem(COOKIE_KEY);
    if (stored === 'true') {
      return true;
    }
    if (stored === 'false') {
      return false;
    }
  } catch (e) {
    // private mode / blocked storage
  }

  const match = document.cookie.split('; ').find((item) => item.startsWith(`${COOKIE_KEY}=`));
  if (match === `${COOKIE_KEY}=true`) {
    return true;
  }
  if (match === `${COOKIE_KEY}=false`) {
    return false;
  }

  return null;
};

const persistConsent = (accepted) => {
  const value = accepted ? 'true' : 'false';
  const secure = window.location.protocol === 'https:' ? '; Secure' : '';
  document.cookie = `${COOKIE_KEY}=${value}; Path=/; Max-Age=${COOKIE_MAX_AGE}; SameSite=Lax${secure}`;

  try {
    localStorage.setItem(COOKIE_KEY, value);
  } catch (e) {
    // cookie is the source of truth for the next page load
  }

  window.dispatchEvent(new CustomEvent(CONSENT_EVENT, {
    detail: { accepted },
  }));
};

const analyticsAlreadyLoaded = () => Boolean(
  window.ym || window.gtag || window.ga || window.google_tag_manager
);

const hideNotice = (notice) => {
  notice.classList.remove('is-visible');
};

const showNotice = (notice) => {
  notice.classList.add('is-visible');
};

const scheduleShow = (show) => {
  if (typeof window.requestIdleCallback === 'function') {
    window.requestIdleCallback(show, { timeout: 2000 });
    return;
  }

  window.setTimeout(show, 1000);
};

document.addEventListener('DOMContentLoaded', () => {
  const notice = document.getElementById('cookie-notice');
  const acceptBtn = document.getElementById('cookie-accept');
  const declineBtn = document.getElementById('cookie-decline');

  if (!notice || !acceptBtn || !declineBtn) {
    return;
  }

  if (readConsent() === null) {
    scheduleShow(() => {
      if (readConsent() === null) {
        showNotice(notice);
      }
    });
  }

  acceptBtn.addEventListener('click', () => {
    persistConsent(true);
    hideNotice(notice);
  });

  declineBtn.addEventListener('click', () => {
    persistConsent(false);
    hideNotice(notice);

    if (analyticsAlreadyLoaded()) {
      window.location.reload();
    }
  });

  document.querySelectorAll('[data-cookie-settings]').forEach((btn) => {
    btn.addEventListener('click', () => {
      showNotice(notice);
    });
  });
});
