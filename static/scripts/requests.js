import { formatDate } from "./utils.js";

const FORM = document.querySelector("form#subscription");

FORM.addEventListener("submit", handleSubmit);

async function handleSubmit(event) {
  event.preventDefault();

  const submitButton = this.querySelector('button[type="submit"]');

  const formData = {};
  const fields = this.querySelectorAll("input");

  [...fields]
    .map(({ name, value }) => {
      if (name === "dob") {
        value = formatDate(value);

        return { name, value };
      }

      return { name, value };
    })
    .forEach(({ name, value }) => {
      formData[name] = value;
    });

  try {
    setSubmitting(submitButton, true);

    const res = await fetch(`${location.href}/api/subscribe.php`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(formData)
    });

    if (!res.ok) {
      console.error("Error");
      return;
    }

    const data = await res.json();
    console.log(data);
  } catch (error) {
    console.error(error.message);
  } finally {
    setSubmitting(submitButton, false);
  }
}

function setSubmitting(button, isSubmitting) {
  button.disabled = isSubmitting;
  button.setAttribute("aria-busy", isSubmitting);
}
