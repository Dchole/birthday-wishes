import { test } from "./confetti.js";

const FORM = document.querySelector("form#subscription");

FORM.addEventListener("submit", event => {
  event.preventDefault();

  const formData = new FormData(FORM);

  test();
});
