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

    // Update storage and UI synchronously
    localStorage.setItem("darkMode", isDarkMode);

    const darkModeIcon = document.getElementById("dark-mode-toggle-icon");
    const lightModeIcon = document.getElementById("light-mode-toggle");

    if (darkModeIcon && lightModeIcon) {
      darkModeIcon.style.display = isDarkMode ? "none" : "block";
      lightModeIcon.style.display = isDarkMode ? "block" : "none";
    }
  };

  const toggleMode = () => {
    const isDarkMode = localStorage.getItem("darkMode") === "true";
    applyMode(!isDarkMode);
  };

  const darkModeToggleBtn = document.getElementById("dark-mode-toggle");

  if (darkModeToggleBtn) {
    darkModeToggleBtn.addEventListener("click", toggleMode);
  }

  if (localStorage.getItem("darkMode") === "true") {
    applyMode(true);
  } else {
    applyMode(false);
  }

  jQuery(document).ready(function ($) {
    $("#dark-mode-toggle-icon, #light-mode-toggle").click(function () {
      toggleMode();
    });
  });
});
