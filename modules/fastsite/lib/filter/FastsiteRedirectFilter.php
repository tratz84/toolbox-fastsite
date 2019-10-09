<?php

namespace fastsite\filter;


use fastsite\service\FastsiteRedirectService;

class FastsiteRedirectFilter {
    
    
    public function doFilter($filterChain) {
        
        $redirectService = object_container_get(FastsiteRedirectService::class);
        
        $redirects = $redirectService->readActiveRedirects();
        
        $uri = app_request_uri();
        foreach($redirects as $r) {
            if ( $r->match( $uri ) ) {
                redirect( $r->getRedirectUrl() );
            }
        }
        
        $filterChain->next();
    }
    
    
    
}
