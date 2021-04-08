import { storeSession } from "../session-storage.js";
import {
  createFormData,
  formatDate,
  formConfig,
  setSubmitting
} from "../utils.js";
import sendPostRequest from "./_sendPost.js";

const FORM = document.querySelector("form#subscription");

FORM.addEventListener("submit", handleSubmit);

async function handleSubmit(event) {
  event.preventDefault();

  const [submitButton, fields] = formConfig(this);

  const parsedFields = [...fields].map(({ name, value }) => {
    if (name === "dob") {
      value = formatDate(value);
      return { name, value };
    }

    return { name, value };
  });

  const formData = createFormData(parsedFields);

  try {
    setSubmitting(submitButton, true);
    storeSession(formData);
    await sendPostRequest("subscribe.php", formData);
  } catch (error) {
    console.error(error.message);
  } finally {
    setSubmitting(submitButton, false);
  }
}
