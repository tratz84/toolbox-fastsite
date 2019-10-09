<?php


use core\controller\BaseController;
use fastsite\form\FastsiteRedirectForm;
use fastsite\model\Redirect;
use fastsite\service\FastsiteRedirectService;

class redirectController extends BaseController {
    
    
    
    public function action_index() {
        
        
        return $this->render();
    }
    
    public function action_search() {
        $pageNo = isset($_REQUEST['pageNo']) ? (int)$_REQUEST['pageNo'] : 0;
        $limit = $this->ctx->getPageSize();
        
        $redirectService = $this->oc->get(FastsiteRedirectService::class);
        
        $r = $redirectService->searchRedirect($pageNo*$limit, $limit, $_REQUEST);
        
        $arr = array();
        $arr['listResponse'] = $r;
        
        $this->json($arr);
    }
    
    
    public function action_edit() {
        $this->form = new FastsiteRedirectForm();
        
        $redirectService = object_container_get( FastsiteRedirectService::class );
        if (get_var('id')) {
            $redirect = $redirectService->readRedirect( get_var('id') );
        } else {
            $redirect = new Redirect();
        }
        
        $this->form->bind( $redirect );
        
        if (is_post()) {
            $this->form->bind( $_REQUEST );
            
            if ($this->form->validate()) {
                $redirectService->saveRedirect($this->form);
                
                redirect('/?m=fastsite&c=redirect');
            }
        }
        
        $this->isNew = $redirect->isNew();
        
        return $this->render();
    }
    
    
    public function action_sort() {
        $ids = explode(',', get_var('ids'));
        
        $redirectService = object_container_get( FastsiteRedirectService::class );
        $redirectService->updateRedirectSort( $ids );
        
        $this->json(array(
            'success' => true
        ));
    }
    
    
    public function action_delete() {
        
        $redirectService = object_container_get( FastsiteRedirectService::class );
        if (get_var('id')) {
            $redirectService->deleteRedirect( get_var('id') );
        }
        
        
        redirect('/?m=fastsite&c=redirect');
    }
    
    
}