* propojování vícero modulů v systemu
* hlavní je IRenderer
  * následuje VectorRenderer a RasterRenderer, tyto vychází z IRendereru -> proto ho taky vrací
  * využíváme abstraktní třídy Shape aby nebyl specifikovaný žádný tvar a bylo možno vytvořit si vlastní tvary s využitím vlastního rendereru namísto vytvoření např. ShapeVector, ShapeRastal
* bez bridge by se počet tříd zdvojnásoboval pokaždé kdy bychom chtěli přidat novou komponentu
  * např chci další vykreslení třeba v metrické soustavě potřeboval bych k tomu nový MetricalRenderer a zároven ShapeMetrical
  * díky bridge stačí vytvořit pouze MetricalRenderer