document.addEventListener("DOMContentLoaded", () => {
  const elementsToUpdate = document.querySelectorAll(
    "h1, h2, h3, h4, h5, h6, p, a, span"
  );

  // Function to adjust font size
  const adjustFontSize = (adjustment) => {
    elementsToUpdate.forEach((element) => {
      const currentSize = parseFloat(
        window.getComputedStyle(element, null).getPropertyValue("font-size")
      );
      if (adjustment === "reset") {
        element.style.fontSize = ""; // Reset to stylesheet default
      } else {
        element.style.fontSize = `${
          currentSize + (adjustment === "increase" ? 2 : -2)
        }px`;
      }
    });
  };

  // Attach event listeners to buttons
  document
    .getElementById("increase-text-size")
    .addEventListener("click", () => adjustFontSize("increase"));
  document
    .getElementById("decrease-text-size")
    .addEventListener("click", () => adjustFontSize("decrease"));
  document
    .getElementById("reset-text-size")
    .addEventListener("click", () => adjustFontSize("reset"));
});
