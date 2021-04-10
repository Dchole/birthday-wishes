import { storeSession } from "../session-storage.js";
import {
  createFormData,
  formatDate,
  formConfig,
  setSubmitting
} from "../utils.js";
import sendPostRequest from "../sendPost.js";

async function handleSubmit(event, form, apiEndpoint = "subscribe.php") {
  event.preventDefault();

  const [submitButton, fields] = formConfig(form);

  const parsedFields = [...fields]
    .map(field => {
      let { name, value } = field;

      if (name === "dob") {
        value = formatDate(value);
        return { name, value };
      }

      return { name, value };
    })
    .filter(field => {
      let channel;

      if (field.name === "channel" && !field.checked) {
        channel = field.value;
      }

      return field.value !== channel;
    });

  console.log(parsedFields);

  const formData = createFormData(parsedFields);

  console.log(formData);

  //   try {
  //     setSubmitting(submitButton, true);
  //     storeSession(formData);
  //     await sendPostRequest(apiEndpoint, formData);
  //   } catch (error) {
  //     console.error(error.message);
  //   } finally {
  //     setSubmitting(submitButton, false);
  //   }
}

export default handleSubmit;
