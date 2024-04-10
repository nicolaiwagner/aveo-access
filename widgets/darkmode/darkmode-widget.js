document
  .getElementById("dark-mode-toggle")
  .addEventListener("click", function () {
    document.body.classList.toggle("dark-mode-bg");
    document
      .querySelectorAll("h1, h2, h3, h4, h5, h6")
      .forEach(function (element) {
        element.classList.toggle("dark-mode-header");
      });
  });
