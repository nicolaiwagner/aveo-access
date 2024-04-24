// document.addEventListener("DOMContentLoaded", function () {
//   const toggleDarkMode = function () {
//     document.body.classList.toggle("dark-mode-bg");
//     document
//       .querySelectorAll("h1, h2, h3, h4, h5, h6")
//       .forEach(function (element) {
//         element.classList.toggle("dark-mode-header");
//       });
//     document.querySelectorAll("p").forEach(function (element) {
//       element.classList.toggle("dark-mode-paragraph");
//     });
//     document.querySelectorAll("main div").forEach(function (element) {
//       element.classList.toggle("dark-mode-div-bg");
//     });
//     document.querySelectorAll("a").forEach(function (element) {
//       element.classList.toggle("dark-mode-link");
//     });
//     document.querySelectorAll("span").forEach(function (element) {
//       element.classList.toggle("dark-mode-span");
//     });

//     localStorage.setItem(
//       "darkMode",
//       document.body.classList.contains("dark-mode-bg")
//     );
//   };

//   document
//     .getElementById("dark-mode-toggle")
//     .addEventListener("click", toggleDarkMode);
//   3;
//   if (localStorage.getItem("darkMode") === "true") {
//     toggleDarkMode();
//   }
// });

document.addEventListener("DOMContentLoaded", () => {
  const bodyClasses = document.body.classList;
  const elementsToUpdate = document.querySelectorAll(
    "h1, h2, h3, h4, h5, h6, p, main div, a, span"
  );

  const applyMode = (isDarkMode) => {
    bodyClasses.toggle("dark-mode-bg", isDarkMode);
    elementsToUpdate.forEach((element) => {
      element.classList.toggle(
        "dark-mode-header",
        isDarkMode && element.tagName.startsWith("H")
      );
      element.classList.toggle(
        "dark-mode-paragraph",
        isDarkMode && element.tagName === "P"
      );
      element.classList.toggle(
        "dark-mode-div-bg",
        isDarkMode && element.closest("main div")
      );
      element.classList.toggle(
        "dark-mode-link",
        isDarkMode && element.tagName === "A"
      );
      element.classList.toggle(
        "dark-mode-span",
        isDarkMode && element.tagName === "SPAN"
      );
    });
    localStorage.setItem("darkMode", isDarkMode);
  };

  const toggleDarkMode = () => applyMode(true);
  const toggleLightMode = () => applyMode(false);

  document
    .getElementById("dark-mode-toggle")
    .addEventListener("click", toggleDarkMode);
  document
    .getElementById("light-mode-toggle")
    .addEventListener("click", toggleLightMode);

  if (localStorage.getItem("darkMode") === "true") {
    toggleDarkMode();
  } else {
    toggleLightMode();
  }
});

jQuery(document).ready(function ($) {
  $("#dark-mode-toggle, #light-mode-toggle").click(function () {
    // Toggle visibility between the dark mode and light mode icons
    $("#dark-mode-toggle").toggle();
    $("#light-mode-toggle").toggle();
  });
});
