import { redirect } from "../utils.js";

async function sendPostRequest(pathname, data) {
  const res = await fetch(`${location.origin}/wishes/api/${pathname}`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify(data)
  });

  if (!res.ok) {
    const data = await res.json();
    throw new Error(data.message);
  }

  // If page is not already at /confirmation.html, then redirect
  location.pathname !== "confirmation.html" && redirect();
}

export default sendPostRequest;
