import GraphModal from "graph-modal";

function closeBurgerMenu() {
  const burger = document.querySelector("[data-burger][aria-expanded='true']");
  if (burger) {
    burger.click();
  }
}

function initFormHandlers() {
  const root = document.querySelector(".graph-modal");
  if (!root || root.dataset.modalReady === "true") {
    return;
  }
  root.dataset.modalReady = "true";

  const modal = new GraphModal({
    isOpen: () => {
      document.dispatchEvent(new CustomEvent("architect:cf7-needed"));
      closeBurgerMenu();
      waitConsentLock();
    },
  });

  modal.focusTrap = function () {
    if (this.isOpen && this.modalContainer) {
      if (!this.modalContainer.hasAttribute("tabindex")) {
        this.modalContainer.setAttribute("tabindex", "-1");
      }
      this.modalContainer.focus({ preventScroll: true });
      return;
    }
    if (this.previousActiveElement && typeof this.previousActiveElement.focus === "function") {
      this.previousActiveElement.focus({ preventScroll: true });
    }
  };

  const lockTargets = () =>
    document.querySelectorAll(".fix-block, .hero");

  modal.disableScroll = function () {
    const gap = Math.max(0, window.innerWidth - document.documentElement.clientWidth);
    document.documentElement.classList.add("is-modal-lock");
    document.documentElement.style.overflow = "hidden";
    document.body.style.paddingRight = `${gap}px`;
    lockTargets().forEach((el) => {
      el.style.paddingRight = `${gap}px`;
    });
  };

  modal.enableScroll = function () {
    document.documentElement.classList.remove("is-modal-lock");
    document.documentElement.style.overflow = "";
    document.body.style.paddingRight = "";
    document.body.style.top = "";
    document.body.classList.remove("disable-scroll");
    lockTargets().forEach((el) => {
      el.style.paddingRight = "";
    });
  };

  document.addEventListener("click", function (e) {
    const trigger = e.target.closest("[data-graph-path]");
    if (trigger) {
      e.preventDefault();
    }
  });

  const consentMessage = "Подтвердите согласие на обработку персональных данных";

  function getModalForm() {
    const wrap = document.querySelector(
      '[data-graph-target="modal-leadform"] .graph-modal__form',
    );
    if (!wrap) {
      return null;
    }
    const form = wrap.querySelector("form");
    return form ? { wrap, form } : null;
  }

  function getConsentBox(form) {
    return form.querySelector(".wpcf7-acceptance input[type='checkbox']");
  }

  function getSubmitBtn(form) {
    return form.querySelector(".form__btn, .wpcf7-submit, button[type='submit']");
  }

  function ensureBtnWrap(btn) {
    if (!btn || btn.parentElement.classList.contains("form__btn-wrap")) {
      return btn ? btn.parentElement : null;
    }
    const wrap = document.createElement("span");
    wrap.className = "form__btn-wrap";
    btn.parentNode.insertBefore(wrap, btn);
    wrap.appendChild(btn);
    return wrap;
  }

  function isSubmitClick(event, form) {
    if (!getSubmitBtn(form)) {
      return false;
    }
    return Boolean(
      event.target.closest(".form__btn, .wpcf7-submit, button[type='submit'], .form__btn-wrap"),
    );
  }

  function getConsentWrap(form) {
    return (
      form.querySelector(".wpcf7-acceptance .wpcf7-form-control-wrap") ||
      form.querySelector(".form-argee .wpcf7-form-control-wrap") ||
      form.querySelector(".form-argee")
    );
  }

  function clearConsentError(form) {
    const wrap = getConsentWrap(form);
    if (!wrap) {
      return;
    }
    wrap.querySelectorAll(".wpcf7-not-valid-tip").forEach((tip) => tip.remove());
  }

  function showConsentError(form) {
    const wrap = getConsentWrap(form);
    if (!wrap || wrap.querySelector(".wpcf7-not-valid-tip")) {
      return;
    }
    const tip = document.createElement("span");
    tip.className = "wpcf7-not-valid-tip";
    tip.setAttribute("aria-hidden", "true");
    tip.textContent = consentMessage;
    wrap.appendChild(tip);
  }

  function syncConsentLock() {
    const ctx = getModalForm();
    if (!ctx) {
      return;
    }
    const { form } = ctx;
    const checkbox = getConsentBox(form);
    const btn = getSubmitBtn(form);
    if (!checkbox || !btn) {
      return;
    }
    const allowed = checkbox.checked;
    ensureBtnWrap(btn);
    btn.disabled = !allowed;
    btn.classList.toggle("is-disabled", !allowed);
    btn.setAttribute("aria-disabled", allowed ? "false" : "true");
    if (allowed) {
      clearConsentError(form);
    }
  }

  function bindConsentLock() {
    const ctx = getModalForm();
    if (!ctx || ctx.wrap.dataset.consentBound === "true") {
      return;
    }
    const { form } = ctx;
    if (!getConsentBox(form) || !getSubmitBtn(form)) {
      return;
    }
    ctx.wrap.dataset.consentBound = "true";
    syncConsentLock();

    form.addEventListener(
      "change",
      function (e) {
        if (e.target.closest(".wpcf7-acceptance")) {
          e.stopImmediatePropagation();
        }
        syncConsentLock();
      },
      true,
    );

    form.addEventListener(
      "click",
      function (e) {
        if (getConsentBox(form)?.checked || !isSubmitClick(e, form)) {
          return;
        }
        e.preventDefault();
        e.stopImmediatePropagation();
        showConsentError(form);
      },
      true,
    );

    form.addEventListener(
      "submit",
      function (e) {
        if (getConsentBox(form)?.checked) {
          return;
        }
        e.preventDefault();
        e.stopImmediatePropagation();
        showConsentError(form);
      },
      true,
    );
  }

  function waitConsentLock() {
    bindConsentLock();
    if (getModalForm()?.wrap?.dataset.consentBound === "true") {
      return;
    }
    let tries = 0;
    const timer = setInterval(function () {
      tries += 1;
      bindConsentLock();
      if (getModalForm()?.wrap?.dataset.consentBound === "true" || tries > 40) {
        clearInterval(timer);
      }
    }, 200);
  }

  waitConsentLock();
  document.addEventListener("wpcf7statuschanged", bindConsentLock);
  document.addEventListener("architect:cf7-needed", waitConsentLock);

  function isModalForm(form) {
    return form && form.closest("[data-graph-target]");
  }

  function openStatus(target) {
    setTimeout(() => {
      modal.open(target);
    }, 300);
  }

  document.addEventListener(
    "wpcf7mailsent",
    function (event) {
      if (isModalForm(event.target)) {
        modal.close();
        openStatus("modal-send");
      }
    },
    false,
  );

  document.addEventListener(
    "wpcf7mailfailed",
    function (event) {
      if (isModalForm(event.target)) {
        modal.close();
        openStatus("modal-failed");
      }
    },
    false,
  );

  document.addEventListener(
    "wpcf7spam",
    function (event) {
      if (isModalForm(event.target)) {
        modal.close();
        openStatus("modal-failed");
      }
    },
    false,
  );
}

if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", initFormHandlers);
} else {
  initFormHandlers();
}
