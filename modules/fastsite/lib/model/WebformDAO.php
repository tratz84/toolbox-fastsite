<?php


namespace fastsite\model;


use core\db\query\QueryBuilder;

class WebformDAO extends \core\db\DAOObject {

	public function __construct() {
		$this->setResource( 'default' );
		$this->setObjectName( '\\fastsite\\model\\Webform' );
	}

	
	public function read($id) {
	    return $this->queryOne('select * from fastsite__webform where webform_id=?', array($id));
	}
	
	
	public function search($opts=array()) {
	    
	    $qb = $this->createQueryBuilder();
	    $qb->setTable('fastsite__webform');
	    
	    $qb->setOrderBy('webform_name');
	    
	    return $qb->queryCursor(Webform::class);
	}

}

