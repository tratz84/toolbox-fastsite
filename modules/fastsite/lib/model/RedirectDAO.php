<?php


namespace fastsite\model;


class RedirectDAO extends \core\db\DAOObject {

	public function __construct() {
		$this->setResource( 'default' );
		$this->setObjectName( '\\fastsite\\model\\Redirect' );
	}
	
	
	public function read($id) {
	    return $this->queryOne('select * from fastsite__redirect where redirect_id=?', array($id));
	}
	
	public function delete($id) {
	    return $this->query('delete from fastsite__redirect where redirect_id=?', array($id));
	}
	
	public function nextSort() {
	    $r = (int)$this->queryValue('select max(sort) from fastsite__redirect');
	    
	    return $r + 1;
	}
	
	
	public function search($opts=array()) {
	    $qb = $this->createQueryBuilder();
	    $qb->setTable('fastsite__redirect');
	    
	    $qb->setOrderBy('sort asc');
	    
	    return $qb->queryCursor(Redirect::class);
	}

}

