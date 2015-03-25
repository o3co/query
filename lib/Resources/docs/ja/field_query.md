# FQL

FQL - Field Query Language - は、フィールド単位での条件を定義するための、拡張クエリ言語です。
例えば、Luceneの　`q=field:+abc`　は、フィールド`field`に対し、`+abc`と条件を指定しまします。　この`+abc`、フィールドに対する値の条件の定義言語をFQLと位置づけ、本Query Componentでは、Criteriaを通し、指定することをできるようにしています。

ここで注意が必要なことは、多くの場合、FQLは、RQL - Requested Query Language - の一部であるということを理解してください。
RQLが複合的な、`(field:+abc) OR (field:+def)`　といった「完全な構文」（Expression）を含むことができることに対し、FQLは、「条件の構文」(Expression)のみを含むことができるということです。

もちろん、FqlをCqlDefinitionと分離することは可能です。しかし、拡張性を考慮した場合、FqlDefinitionは、CqlDefinitionに含めることをお勧めします。


## FQLを用いたCriteriaの利用例（CQL Extensionを利用）

```
$criteria = array('name' => 'or:(John Josh)');

$criteriaParser = new CriteriaParser(new QueryBuilder(), new FqlDefinition());
$query = $criteriaParser->parse($criteria);

// Query "name:John OR Josh" will be generated.
```



----

[戻る](./index.md)
