import handleSubmit from "./handleSubmit.js";
import { getSession } from "../session-storage.js";
import { formConfig, reformDate } from "../utils.js";

const FORM = document.getElementById("edit-form");

const [, fields] = formConfig(FORM);
const data = getSession();

window.addEventListener("load", () => {
  fields.forEach(field => {
    if (field.name === "dob") {
      field.value = reformDate(data?.[field.name] || "14-11");
      return;
    }

    if (field.name === "channel" && field.id === "sms") {
      field.checked = true;
      return;
    }

    field.value = data?.[field.name];
  });
});

FORM.addEventListener("submit", event =>
  handleSubmit(event, FORM, "edit-details.php")
);
