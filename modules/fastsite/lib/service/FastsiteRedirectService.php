<?php


namespace fastsite\service;


use core\forms\lists\ListResponse;
use core\service\ServiceBase;
use fastsite\model\RedirectDAO;
use fastsite\form\FastsiteRedirectForm;
use fastsite\model\Redirect;
use core\exception\ObjectNotFoundException;

class FastsiteRedirectService extends ServiceBase {
    
    
    public function readRedirect($redirectId) {
        $rDao = new RedirectDAO();
        
        return $rDao->read($redirectId);
    }
    
    
    public function deleteRedirect($redirectId) {
        $r = $this->readRedirect($redirectId);
        
        if ($r == null) {
            throw new ObjectNotFoundException('Redirect not found');
        }
        
        $rDao = new RedirectDAO();
        $rDao->delete( $redirectId );
    }
    
    
    public function saveRedirect(FastsiteRedirectForm $form) {
        $redirect_id = $form->getWidgetValue('redirect_id');
        
        if ($redirect_id) {
            $r = $this->readRedirect($redirect_id);
        } else {
            $r = new Redirect();
        }
        
        $form->fill($r, array('match_type', 'pattern', 'redirect_url', 'active'));
        
        if ($r->isNew()) {
            $rDao = new RedirectDAO();
            $s = $rDao->nextSort();
            $r->setSort( $s );
        }
        
        $r->save();
        
        return $r;
    }
    
    public function searchRedirect($start, $limit, $opts=array()) {
        $rDao = new RedirectDAO();
        
        $cursor = $rDao->search($opts);
        
        $r = ListResponse::fillByCursor($start, $limit, $cursor, array('redirect_id', 'match_type', 'pattern', 'redirect_url', 'active', 'edited', 'created'));
        
        return $r;
    }
    
    
}
