<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        $eventManager->attach(MvcEvent::EVENT_ROUTE,
        		array($this, 'protectPage'), -100);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function protectPage(MvcEvent $event)
    {
    	$match = $event->getRouteMatch();
    	if(!$match) {
    		// we cannot do anything without a resolved route
    		return;
    	}
    	
    	$controller = $match->getParam('controller');
    	$action = $match->getParam('action');
    	$namespace = $match->getParam('__NAMESPACE__');
    	
    	
    	//check to work only for the current module
    	if (strpos($namespace,__NAMESPACE__)!==0) {
    		return;
    	}
    	
    	 
    	$services = $event->getApplication()->getServiceManager();
    	 
    	$auth = $services->get('auth');
    	$acl      = $services->get('acl');
    	$config = $services->get('config');
    	
    	$parts           = explode('\\', $namespace);
    	$moduleNamespace = $parts[0];
    	
    	// get the role of the current user
    	$currentUser = $services->get('user');
    	$role = $currentUser->getRole();
    	
    	$aclModules = $config['acl']['modules'];
    	if (!empty($aclModules) && !in_array($moduleNamespace, $aclModules)) {
    		return;
    	}
    	 
    	
    	$resourceAliases = $config['acl']['resource_aliases'];
    	if (isset($resourceAliases[$controller])) {
    		$resource = $resourceAliases[$controller];
    	} else {
    		$resource = strtolower(substr($controller, strrpos($controller,'\\')+1));
    	}
    	
    	if(!$acl->hasResource($resource)) {
    		$acl->addResource($resource);
    	}
    	
    	
    	try {
    		if($acl->isAllowed($role, $resource, $action)) {
    			return;
    		}
    	} catch(AclException $ex) {
    		print 'ninja';die;
    	}
    	
    	$response = $event->getResponse();
    	$response->setStatusCode(403);
    	
    	$match->setParam('controller', 'Application\Controller\Index');
    	$match->setParam('action', 'index');
    	
    	/*
    	
    	if (!$auth->hasIdentity()) {
    		// Set the response code to HTTP 401: Auth Required
    		$response = $event->getResponse();
    		$response->setStatusCode(401);
    
    		$match->setParam('controller', 'Application\Controller\Users');
    		$match->setParam('action', 'login');
    	}
    	*/
    }
}
