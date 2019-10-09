<?php


use base\model\Menu;
use core\Context;
use core\ObjectContainer;
use core\event\CallbackPeopleEventListener;
use core\event\EventBus;
use core\exception\InvalidStateException;
use core\filter\FilterChain;
use core\filter\DispatchFilter;
use core\container\ObjectHookCall;


if (is_standalone_installation() == false) {
    throw new InvalidStateException('fastsite-module not supported in multi-administration-mode');
}

if (defined('MODULE_FASTSITE'))
    return;

define('MODULE_FASTSITE', 1);


require_once dirname(__FILE__).'/lib/functions/webpage_helper.php';
require_once dirname(__FILE__).'/lib/functions/template_helper.php';


Context::getInstance()->enableModule('fastsite');

$eb = ObjectContainer::getInstance()->get(EventBus::class);


$eb->subscribe('base', 'MenuService::listMainMenu', new CallbackPeopleEventListener(function($evt) {
    
    $ac = $evt->getSource();
    
    $miFastsite = new Menu();
    $miFastsite->setIconLabelUrl('fa-file-archive-o', 'Fastsite', '/?m=fastsite&c=webpage');
    $miFastsite->setMenuAsFirstChild(false);
    $ac->add($miFastsite);
    
    
    $miWebpage = new Menu();
    $miWebpage->setIconLabelUrl('fa-file-archive-o', 'Webpages', '/?m=fastsite&c=webpage');
    $miFastsite->addChildMenu($miWebpage);
    
    $miMedia = new Menu();
    $miMedia->setIconLabelUrl('fa-image', 'Media', '/?m=fastsite&c=media/files');
    $miFastsite->addChildMenu($miMedia);
    
    $miMenu = new Menu();
    $miMenu->setIconLabelUrl('fa-file-archive-o', 'Webmenu', '/?m=fastsite&c=webmenu');
    $miFastsite->addChildMenu($miMenu);
    
    $miWebforms = new Menu();
    $miWebforms->setIconLabelUrl('fa-file-text-o', 'Formulieren', '/?m=fastsite&c=webforms');
    $miFastsite->addChildMenu($miWebforms);

    $miRedirects = new Menu();
    $miRedirects->setIconLabelUrl('fa-arrows-alt', 'Redirects', '/?m=fastsite&c=redirect');
    $miFastsite->addChildMenu($miRedirects);
    
    $miTemplates = new Menu();
    $miTemplates->setIconLabelUrl('fa-file-archive-o', 'Templates', '/?m=fastsite&c=template/template');
    $miFastsite->addChildMenu($miTemplates);
    
}));

$eb->subscribe('core', 'pre-call-'.FilterChain::class.'::execute', new CallbackPeopleEventListener(function($evt) {
    
    if (strpos($_SERVER['REQUEST_URI'], BASE_HREF.'backend/') !== false) {
        return;
    }
    if (strpos($_SERVER['REQUEST_URI'], BASE_HREF.'module/') !== false) {
        return;
    }
    
    /**
     * @var ObjectHookCall $ohc
     */
    $ohc = $evt->getSource();
    $filterChain = $ohc->getObject();
    $filterChain->clearFilters();
   
    $filterChain->addFilter( new \fastsite\filter\FastsiteSessionFilter() );
    $filterChain->addFilter( new \core\filter\ModulePublicFilter() );
    $filterChain->addFilter( new \fastsite\filter\FastsiteTemplateFilter() );
    $filterChain->addFilter( new \fastsite\filter\FastsiteMediaFilter() );
    $filterChain->addFilter( new \core\filter\DatabaseFilter() );
    $filterChain->addFilter( new \fastsite\filter\FastsiteRedirectFilter() );
    $filterChain->addFilter( new \fastsite\filter\FastsiteRouteFilter() );
    $filterChain->addFilter( new DispatchFilter() );
}));

add_filter('appUrl', function($url) {
    $url = substr($url, strlen(BASE_HREF));
    
    return BASE_HREF . 'backend/' . $url;
});


