<?php
namespace O3Co\Query\Query\Term;

use O3Co\Query\Query\Term;
use O3Co\Query\Query\Term\ConditionalExpression;

/**
 * ConditionalClause 
 *   ConditionalClause bind all internal terms with AND op
 * @uses AbstractClause
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ConditionalClause extends AbstractClause 
{
	/**
	 * add 
	 * 
	 * @param Term $term 
	 * @access public
	 * @return void
	 */
	public function add(Term $term)
	{
		if(!$term instanceof ConditionalExpression) {
			throw new \RuntimeException('ConditionalClause only accept ConditionalExpression for its term');
		}

		return parent::add($term);
	}

    /**
     * getFirstExpression 
     * 
     * @access public
     * @return void
     */
    public function getFirstExpression()
    {
        return $this->getTerms()[0];
    }

    /**
     * getExpresions 
     * 
     * @access public
     * @return void
     */
    public function getExpressions()
    {
        return $this->getTerms();
    }

    public function setExpressions(array $exprs)
    {
        $this->setTerms($exprs);
    }
}
