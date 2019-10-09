<?php


namespace fastsite\model\base;


class RedirectBase extends \core\db\DBObject {

	public function __construct($id=null) {
		$this->setResource( 'default' );
		$this->setTableName( 'fastsite__redirect' );
		$this->setPrimaryKey( 'redirect_id' );
		$this->setDatabaseFields( array (
  'redirect_id' => 
  array (
    'Field' => 'redirect_id',
    'Type' => 'int(11)',
    'Null' => 'NO',
    'Key' => 'PRI',
    'Default' => NULL,
    'Extra' => 'auto_increment',
  ),
  'match_type' => 
  array (
    'Field' => 'match_type',
    'Type' => 'enum(\'regexp\',\'wildcard\',\'exact\')',
    'Null' => 'YES',
    'Key' => '',
    'Default' => NULL,
    'Extra' => '',
  ),
  'pattern' => 
  array (
    'Field' => 'pattern',
    'Type' => 'varchar(255)',
    'Null' => 'YES',
    'Key' => '',
    'Default' => NULL,
    'Extra' => '',
  ),
  'redirect_url' => 
  array (
    'Field' => 'redirect_url',
    'Type' => 'varchar(255)',
    'Null' => 'YES',
    'Key' => '',
    'Default' => NULL,
    'Extra' => '',
  ),
  'active' => 
  array (
    'Field' => 'active',
    'Type' => 'tinyint(1)',
    'Null' => 'YES',
    'Key' => '',
    'Default' => '1',
    'Extra' => '',
  ),
  'sort' => 
  array (
    'Field' => 'sort',
    'Type' => 'int(11)',
    'Null' => 'YES',
    'Key' => '',
    'Default' => NULL,
    'Extra' => '',
  ),
  'edited' => 
  array (
    'Field' => 'edited',
    'Type' => 'datetime',
    'Null' => 'YES',
    'Key' => '',
    'Default' => NULL,
    'Extra' => '',
  ),
  'created' => 
  array (
    'Field' => 'created',
    'Type' => 'datetime',
    'Null' => 'YES',
    'Key' => '',
    'Default' => NULL,
    'Extra' => '',
  ),
) );
		
		if ($id != null)
			$this->setField($this->primaryKey, $id);
	}
	
		
	public function setRedirectId($p) { $this->setField('redirect_id', $p); }
	public function getRedirectId() { return $this->getField('redirect_id'); }
	
		
	public function setMatchType($p) { $this->setField('match_type', $p); }
	public function getMatchType() { return $this->getField('match_type'); }
	
		
	public function setPattern($p) { $this->setField('pattern', $p); }
	public function getPattern() { return $this->getField('pattern'); }
	
		
	public function setRedirectUrl($p) { $this->setField('redirect_url', $p); }
	public function getRedirectUrl() { return $this->getField('redirect_url'); }
	
		
	public function setActive($p) { $this->setField('active', $p); }
	public function getActive() { return $this->getField('active'); }
	
		
	public function setSort($p) { $this->setField('sort', $p); }
	public function getSort() { return $this->getField('sort'); }
	
		
	public function setEdited($p) { $this->setField('edited', $p); }
	public function getEdited() { return $this->getField('edited'); }
	
		
	public function setCreated($p) { $this->setField('created', $p); }
	public function getCreated() { return $this->getField('created'); }
	
	
}

