import handleSubmit from "./handleSubmit.js";

const FORM = document.getElementById("subscription");

console.log(FORM);

FORM.addEventListener("submit", event => handleSubmit(event, FORM));
