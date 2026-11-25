(() => {
  "use strict";

  const toggle = document.querySelector(".nav-toggle");
  const navigation = document.querySelector("#primary-nav");

  const localToday = new Date();
  localToday.setMinutes(localToday.getMinutes() - localToday.getTimezoneOffset());
  document.querySelectorAll('input[type="date"]').forEach((input) => {
    input.min = localToday.toISOString().slice(0, 10);
  });

  const year = document.querySelector("#copyright-year");
  if (year) year.textContent = String(new Date().getFullYear());

  if (toggle && navigation) {
    const setNavigationOpen = (isOpen) => {
      toggle.setAttribute("aria-expanded", String(isOpen));
      toggle.setAttribute("aria-label", isOpen ? "Close navigation" : "Open navigation");
      navigation.classList.toggle("is-open", isOpen);
    };

    toggle.addEventListener("click", () => {
      const isOpen = toggle.getAttribute("aria-expanded") === "true";
      setNavigationOpen(!isOpen);
    });

    navigation.addEventListener("click", (event) => {
      if (event.target.closest("a")) {
        setNavigationOpen(false);
      }
    });

    document.addEventListener("keydown", (event) => {
      if (event.key === "Escape" && navigation.classList.contains("is-open")) {
        setNavigationOpen(false);
        toggle.focus();
      }
    });
  }

  const moments = document.querySelector(".moments");
  const reel = document.querySelector(".moment-reel");
  const momentToggle = document.querySelector(".moment-toggle");
  if (moments && reel && momentToggle && "IntersectionObserver" in window) {
    const reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)");
    let visible = false;
    let paused = false;
    const updateReel = () => {
      reel.classList.toggle("is-animating", visible && !document.hidden && !paused && !reducedMotion.matches);
      momentToggle.hidden = reducedMotion.matches;
      momentToggle.textContent = paused ? momentToggle.dataset.playLabel : momentToggle.dataset.pauseLabel;
    };

    momentToggle.addEventListener("click", () => {
      paused = !paused;
      updateReel();
    });
    document.addEventListener("visibilitychange", updateReel);
    reducedMotion.addEventListener("change", updateReel);
    new IntersectionObserver((entries) => {
      visible = entries[0].isIntersecting;
      updateReel();
    }).observe(moments);
    updateReel();
  }

  const forms = document.querySelectorAll("form[data-async-form]");

  forms.forEach((form) => {
    form.addEventListener("submit", async (event) => {
      event.preventDefault();

      const timeField = form.querySelector('input[name="time"]');
      if (timeField) {
        const hour = Number(timeField.value.split(":")[0]);
        const withinBusinessHours = Number.isInteger(hour) && (hour >= 8 || hour < 2);
        timeField.setCustomValidity(withinBusinessHours ? "" : form.dataset.timeError);
      }

      if (!form.reportValidity()) return;

      const feedback = form.querySelector("[data-form-feedback]");
      const submit = form.querySelector('button[type="submit"]');
      const submitLabel = submit.textContent;

      if (!feedback || !submit) return;

      feedback.textContent = form.dataset.loadingMessage;
      feedback.dataset.state = "loading";
      submit.disabled = true;

      try {
        if (!window.grecaptcha) {
          throw new Error(form.dataset.captchaError);
        }

        const token = await new Promise((resolve, reject) => {
          window.grecaptcha.ready(() => {
            window.grecaptcha
              .execute(form.dataset.siteKey, { action: form.dataset.captchaAction })
              .then(resolve, reject);
          });
        });

        const body = new URLSearchParams(new FormData(form));
        body.set("token", token);

        const response = await fetch(form.action, {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded;charset=UTF-8" },
          body,
        });

        const result = await response.json();
        if (!response.ok || result.status !== "ok") {
          throw new Error(result.message || form.dataset.submitError);
        }

        form.reset();
        feedback.textContent = form.dataset.successMessage;
        feedback.dataset.state = "success";
      } catch (error) {
        feedback.textContent = error.message || form.dataset.submitError;
        feedback.dataset.state = "error";
      } finally {
        submit.disabled = false;
        submit.textContent = submitLabel;
      }
    });
  });
})();
