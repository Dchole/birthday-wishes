export const getSession = () => sessionStorage.getItem("data");

export const storeSession = data =>
  sessionStorage.setItem("data", JSON.stringify(data));

export const editSession = (key, value) => {
  const data = JSON.parse(getSession());
  data[key] = value;

  sessionStorage.setItem("data", JSON.stringify(data));
};

export const removeSession = () => sessionStorage.clear();
