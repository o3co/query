# Query言語

Queryコンポーネントでは、以下の３つの種類のクエリ言語を対応しています。

  1. NQL (Native Query Language) 
  2. RQL (Requested Query Language)
  3. FQL (Field Query Language)
  
  
## NQLとは？

NQL (Native Query Language)とは、SQLやDQL, LuceneQueryといった、他のサービスのクエリ言語を指します。
本コンポーネントは、このNQLを生成、サービスへと橋渡しするためのコンポーネントです。

## RQLとFQLとは？

RQL (Requested Query Language)と FQL (Field Query Language)は、リクエストされる際に渡されるQuery言語です。
既存のNQLを用いることも可能です。

RQLの目的は、CriteriaやWebQueryを実現するためのものです。　一つのサービス内部で、SQLと検索エンジンを使っていた場合、その先のエンジンサービスに依存することなく、共通のクエリで呼び出せるべきであり、この共通のクエリを実現するために定義されている言語です。

また、FQLは、RQLのような完全なクエリではなく、Criteriaと呼ばれる、「フィールド」対「値の条件」を指定するための部分的な表現となります。


## 使用例
以下のようなケースの場合、サービスの選択を切り替えるたびに、APIで指定できるクエリ形式が変わることは、APIのユーザビリティ・ユーザエクスペリエンスの観点から望ましいことではない。
これらの問題を解決するために、サービス切り替え後も、今までのAPIの書式を維持することが大切である。

### Case 1
API usersは、現在、データストアにMySQLだけを用いていた。　しかし、アクセス量の増加に伴い、CloudSearchをFetch時に用いるようにしたい。

### Case 2
CloudSearchを用いていたが、Solrに切り替えたい。

----

[戻る](./index.md)