export const formatDate = date =>
  date.split("-").reverse().join("-").slice(0, 5);

export const reformDate = date =>
  `${new Date().getFullYear()}-` + date.split("-").reverse().join("-");

export const formConfig = form => {
  const submitButton = form.querySelector('button[type="submit"]');
  const fields = form.querySelectorAll("input");

  return [submitButton, fields];
};

export const createFormData = fields => {
  const formData = {};

  [...fields].forEach(({ name, value }) => {
    formData[name] = value;
  });

  return formData;
};

export const setSubmitting = (button, isSubmitting) => {
  button.disabled = isSubmitting;
  button.setAttribute("aria-busy", isSubmitting);
};

export const redirect = (pathname = "confirmation.html") =>
  location.replace(pathname);
