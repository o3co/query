# Query言語

Queryコンポーネントでは、以下の３つの種類のクエリ言語を利用します。

  1. NQL (Native Query Language) 
  2. CQL (Custom Query Language)
  3. FQL (Field Query Language)
  
  
## NQLとは？

NQL (Native Query Language)とは、SQLやDQL, LuceneQueryといった、データストア層が提供するのクエリ言語を指します。
本コンポーネントは、このNQLまたはNQLを制御するコンポーネントクラスを生成し、サービスへと橋渡します。

## CQLとFQLとは？

CQL (Custom Query Language)と FQL (Field Query Language)は、リクエストされる際に渡されるQuery言語です。
既存のNQLを用いることも可能ですが、QueryコンポーネントのSimpleExpressionを表現するためのクエリ言語です。


FQLは、Criteriaを用いた際に1フィールドに対してのクエリ言語です。多くの場合、CQLのサブセットとなります。


----

[戻る](./index.md)