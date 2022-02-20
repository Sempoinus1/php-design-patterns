* máme implementovaný built-in observer, který má metody attach, detach
  * tyto metody nám pomohou k tomu správně logovat skrz observer 
  * jestliže tedy není attachnutý žádný observer nehodí se nám žádná hláška
* observery jsou definovaný jako samostatná třída
  * každý observer kontroluje sobě daný stav
    * tzn. každý observer loguje a reaguje na - teoreticky stejné věci jinak