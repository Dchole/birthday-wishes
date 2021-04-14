const NAV_LINKS = document.querySelectorAll("nav a");

NAV_LINKS.forEach(link => {
  if (link.pathname === location.pathname) {
    link.style.color = "#ff9800";
  }
});
