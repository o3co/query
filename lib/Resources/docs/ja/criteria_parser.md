# CriteriaParser

CriteriaParserは、配列で指定されるフィールド　対　値のクリテリアを、Queryに変換するためのパーサコンポーネントです。 

## 使用例

````
$criteriaParser = new CriteriaParser($queryBuilder);

$query = $criteriaParser->parse($criteria);
```

## 内部構成

CriteriaParserは、各フィールドをFqlParserを用いて、Expressionに変換した後、QueryBuilderを用いて、Query変換します。


----

[戻る](./index.md)