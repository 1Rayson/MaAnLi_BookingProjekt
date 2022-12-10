function toggleSelected(elem) {
  for (var i = 0; i < elem.length; i++) {
    elem[i].addEventListener("click", function (e) {
      var current = this;
      for (var i = 0; i < elem.length; i++) {
        if (current != elem[i]) {
          elem[i].classList.remove("activeDate");
        } else if (current.classList.contains("activeDate") === true) {
          current.classList.remove("activeDate");
        } else {
          current.classList.add("activeDate");
        }
      }
      e.preventDefault();
    });
  }
}
toggleSelected(document.querySelectorAll(".date"));
