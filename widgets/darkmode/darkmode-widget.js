document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("dark-mode-toggle")
    .addEventListener("click", function () {
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
    });
});
