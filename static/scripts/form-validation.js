// Select all inputs except radio buttons
const INPUTS = document.querySelectorAll(
  "form#subscription input:not([type=radio])"
);

INPUTS.forEach(input => {
  const [label] = input.labels; // Get label for input

  const helperTextElement = document.createElement("p");
  helperTextElement.id = input.name + "-helper-text"; // generate id for helper text from input name

  input.addEventListener("blur", function () {
    this.className = "dirty"; // Set input class to "dirty" since field has been touched

    colorLabel(this, label); // validate and change label color according to input validity

    /* Create Helper text to guide user when there is an error */
    setHelperText(this, helperTextElement); // set helper text content with validation message

    this.nextSibling.replaceWith(helperTextElement); // Insert helper text after input field
    this.setAttribute("aria-describedby", helperTextElement.id);
  });

  input.addEventListener("input", function () {
    colorLabel(this, label);
    setHelperText(this, helperTextElement);
  }); // Validate and update fields while user enter input
});

function colorLabel(input, label) {
  if (!input.validity.valid) {
    label.style.setProperty("color", "var(--error-color)");
  } else {
    label.style.setProperty("color", "initial");
  }
}

function setHelperText(input, helperTextElement) {
  helperTextElement.textContent = input.validationMessage; // set helper text content with validation message
}
