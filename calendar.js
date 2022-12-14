// Funktion til at 'toggle' den valgte dato
function toggleSelected(elem) {
  /**
  * Sæt 'i' til 0, og at så længe i er mindre end længden af listen af datoer så sættes den 1 op
  * for hver gang den kører igennem loopet.
  * Hvis det klikkede element ikke er lig med i's værdi, så fjern klassen activeDate fra den
  * Det samme skal ske hvis den klikkede knap's klasseliste allerede har activeDate
  * Dette forsikrer at der altid kun er EN med klassen activeDate, 
  * og denne ikke har flere klasser med samme navn
  * Ellers giv den klikkede dato klassen 'activeDate'
  */
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
/**
 * Vælg alle med klassen 'date' til at køre igennem ovenstående funktion
 */
toggleSelected(document.querySelectorAll(".date"));
