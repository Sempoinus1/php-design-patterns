* Open Closed Principe 
  * části systému nebo celý systém by měl být otevřen k rozširování funkcí
  * hlavní třídy by měly být uzavřeny pro jakoukoliv modifikaci a měly by být jednoduše modifikovatelné právě skrze dědičnost
  * každá třída by měla mít na starosti pouze jednu věc
    * v tomto případě
      * filter se stará pouze o to aby vyfiltroval pole
      * specification se stará o to že jsou uspokojeny všechny podmínky pro to aby filter vyhodil přesně co má
  * nová funkcionalita má novou classu 