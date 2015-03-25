# Queryクラス


## Queryの生成

Queryコンポーネントでは、Queryを生成する方法をいくつか用意しています。

  1. nativeQuery文字列による生成
      
    	$query = new Query('QUERY STRING', $parameters);
    
  2. QueryBuilderを用いた生成
  
		$query = $qb
				->add($qb->expr()->eq('field', 'value'))
				->add('field2 = :value')
				->setParameter('value', $value)
				->getQuery();
		
  3. CriteriaParserを用いた生成

		$criteriaParser = new CriteriaParser($queryBuilder, $fqlParser);
		$query = $criteriaParser->parse(array('field' => 'value'));
	
  4. QueryGeneratorを用いた生成（QueryBuilderの内部の挙動）
  	
  	// QueryParserを用いるなどで、DMLPartを生成する
  	$statement = $queryParser->parse($requestedQueryString);
  	// QueryGeneratorは、DMLPartからQuery文字列を生成する
  	$queryString = $queryGenerator->generate($statement);
  	$query = new Query($queryString);

## Queryの結果を取得する

Queryクラスの目的は、NativeQueryの生成と、その結果を隠蔽することです。


```
$results = $query->getResults();

$result = $query->getSingleResult();
```

----

[戻る](./index.md)

