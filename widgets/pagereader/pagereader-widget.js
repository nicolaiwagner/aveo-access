function setCookie(name, value, days) {
  var expires = "";
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
    expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(";");
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == " ") c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
}

function eraseCookie(name) {
  document.cookie = name + "=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;";
}

document.addEventListener("DOMContentLoaded", function () {
  var scriptTag; // Holds the dynamically added script element

  function addScript() {
    if (!scriptTag) {
      scriptTag = document.createElement("script");
      scriptTag.src = "https://unpkg.com/ttsreader-plugin/main.js";
      scriptTag.async = true;
      document.head.appendChild(scriptTag);
      setCookie("scriptAdded", "true", 7);
    }
  }

  function removeScript() {
    if (scriptTag) {
      document.head.removeChild(scriptTag);
      scriptTag = null;
      eraseCookie("scriptAdded");
      location.reload(); // Consider whether you truly need to reload the page here
    }
  }

  function toggleScriptState() {
    if (scriptTag) {
      removeScript();
    } else {
      addScript();
    }
  }

  function initializeState() {
    var toggleIconOn = document.getElementById("page-reader-toggle");
    var toggleIconOff = document.getElementById("page-reader-toggle-off");

    if (getCookie("scriptAdded") === "true") {
      toggleIconOn.style.display = "none";
      toggleIconOff.style.display = "block";
      addScript();
    } else {
      toggleIconOn.style.display = "block";
      toggleIconOff.style.display = "none";
    }
  }

  var toggleButton = document.getElementById("page-reader-toggle-button");
  var toggleIconOn = document.getElementById("page-reader-toggle");
  var toggleIconOff = document.getElementById("page-reader-toggle-off");

  // Consolidating event listeners for both button and icons
  if (toggleButton) {
    toggleButton.addEventListener("click", toggleScriptState);
  }

  if (toggleIconOn && toggleIconOff) {
    toggleIconOn.addEventListener("click", function () {
      toggleIconOn.style.display = "none";
      toggleIconOff.style.display = "block";
      toggleScriptState();
    });

    toggleIconOff.addEventListener("click", function () {
      toggleIconOff.style.display = "none";
      toggleIconOn.style.display = "block";
      toggleScriptState();
    });
  }

  initializeState();
});
