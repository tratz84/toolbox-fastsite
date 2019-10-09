<?php


namespace fastsite\model;


class Redirect extends base\RedirectBase {

    public function __construct($id=null) {
        parent::__construct( $id );
        
        $this->setActive( true );
        
        
    }

}

