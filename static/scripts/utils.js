export const formatDate = date =>
  date.split("-").reverse().join("-").slice(0, 5);
