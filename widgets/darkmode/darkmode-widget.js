document.addEventListener("DOMContentLoaded", function () {
  const toggleDarkMode = function () {
    document.body.classList.toggle("dark-mode-bg");
    document
      .querySelectorAll("h1, h2, h3, h4, h5, h6")
      .forEach(function (element) {
        element.classList.toggle("dark-mode-header");
      });
    document.querySelectorAll("p").forEach(function (element) {
      element.classList.toggle("dark-mode-paragraph");
    });
    document.querySelectorAll("a").forEach(function (element) {
      element.classList.toggle("dark-mode-link");
    });
    document.querySelectorAll("span").forEach(function (element) {
      element.classList.toggle("dark-mode-span");
    });

    localStorage.setItem(
      "darkMode",
      document.body.classList.contains("dark-mode-bg")
    );
  };

  document
    .getElementById("dark-mode-toggle")
    .addEventListener("click", toggleDarkMode);
  3;
  if (localStorage.getItem("darkMode") === "true") {
    toggleDarkMode();
  }
});
