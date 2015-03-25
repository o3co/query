# SimpleExpression

Queryオブジェクトは、CQLまたはQueryBuilderで作成された構成をSimpleExpressionを用いて管理しています。　SimpleExpressionは、ASTとは異なり、意味合いで管理する構成です。（通常ASTから変換されるIRに該当）
これは、ASTの関心が、言語構成にあることに対し、Queryコンポーネントは、概念の構成のみに関心をフォーカスしているためです。

## Statement

文。Queryの全文。SimpleExpression全体を含まめる。

## 

