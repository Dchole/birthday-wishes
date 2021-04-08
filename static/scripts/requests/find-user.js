import { storeSession } from "../session-storage.js";
import { formConfig, redirect, setSubmitting } from "../utils.js";

const FORM = document.getElementById("edit-form");

FORM.addEventListener("submit", handleSubmit);

async function handleSubmit(event) {
  event.preventDefault();

  const [submitButton, fields] = formConfig(this);
  const [{ value }] = fields;

  const params = encodeURIComponent(`account=${value}`);

  try {
    setSubmitting(submitButton, true);

    const res = await fetch(
      `${location.origin}/wishes/api/find-user?${params}`
    );

    const data = await res.json();

    if (!res.ok) {
      throw new Error(data.message);
    }

    storeSession(data);
    redirect();
  } catch (error) {
    console.error(error.message);
  } finally {
    setSubmitting(submitButton, false);
  }
}
