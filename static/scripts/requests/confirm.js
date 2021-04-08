import { editSession } from "../session-storage.js";
import { createFormData, formConfig, setSubmitting } from "../utils.js";
import sendPostRequest from "./_sendPost.js";

const FORM = document.getElementById("confirmation-form");

FORM.addEventListener("submit", handleSubmit);

async function handleSubmit(event) {
  event.preventDefault();

  const [submitButton, fields] = formConfig(this);
  const formData = createFormData(fields);

  try {
    setSubmitting(submitButton, true);
    await sendPostRequest("verify.php", formData);
    editSession("confirmed", true);
  } catch (error) {
    console.error(error.message);
  } finally {
    setSubmitting(submitButton, true);
  }
}
