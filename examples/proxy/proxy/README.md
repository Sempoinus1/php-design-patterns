* původní metoda nám umožnuje pouze jednu funkcionalitu - aktuálně řídit auto
  * řízení auta ale je restriktováno a nechceme měnit původní kód tak využijeme proxy
  * proxy je třída která bude vypadat prakticky stejně jako původní třída Car
    * ale bude se starat o restrikce 
      * zde například jestli řidič je dostatečně starý na to aby mohl řídit auto