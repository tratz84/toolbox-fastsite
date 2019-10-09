<?php


namespace fastsite\model;


class Redirect extends base\RedirectBase {

    public function __construct($id=null) {
        parent::__construct( $id );
        
        $this->setActive( true );
    }
    
    
    public function match($url) {
        if ($this->getMatchType() == 'exact') {
            if ($url == $this->getPattern()) {
                return true;
            }
        }
        else if ($this->getMatchType() == 'wildcard') {
            if (fnmatch($this->getPattern(), $url, FNM_NOESCAPE)) {
                return true;
            }
        }
        else if ($this->getMatchType() == 'pattern') {
            if (preg_match('/'.$this->getPattern().'/', $url)) {
                return true;
            }
        }
        
        return false;
    }

}

