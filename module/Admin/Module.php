<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        $e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractController', 'dispatch', function($e) {
        	$controller      = $e->getTarget();
        	$controllerClass = get_class($controller);
        	$moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
        	$config          = $e->getApplication()->getServiceManager()->get('config');
        	if (isset($config['module_layouts'][$moduleNamespace])) {
        		$controller->layout($config['module_layouts'][$moduleNamespace]);
        	}
        }, 100);
        
        
        $eventManager->attach(MvcEvent::EVENT_ROUTE,
        		array($this, 'protectPage'), -100);
        
        
        

        /*
        $e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractController', 'dispatch', function($e) {
        	$controller      = $e->getTarget();
        	$controllerClass = get_class($controller);
        	$moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
        	$config          = $e->getApplication()->getServiceManager()->get('config');
        	if (isset($config['module_layouts'][$moduleNamespace])) {
        		$controller->layout($config['module_layouts'][$moduleNamespace]);
        	}
        }, 100);
        */
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
    	error_reporting(E_ALL);
    	ini_set('display_errors', true);
    	
    	$services = $event->getApplication()->getServiceManager();
    	$auth = $services->get('auth');
    	
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
    	
    	print ' role ' . $role . '<br />';
    	print ' resource ' . $resource . '<br />';
    	print ' action ' . $action . '<br />';
    	
    	try {
    		if($acl->isAllowed($role, $resource, $action)) {
    			if ($action == 'denied')
    			{
    				return;
    			}
    			if (!$auth->hasIdentity()) {
    				// Set the response code to HTTP 401: Auth Required
    				$response = $event->getResponse();
    				$response->setStatusCode(401);
    			
    				$match->setParam('controller', 'Admin\Controller\Users');
    				$match->setParam('action', 'login');
    			}
    			
    			return;
    		}
    	} catch(AclException $ex) {
    		print 'ninja';die;
    	}
    	
    	//var_dump($controller); die;
    	//$controller->layout('admin/layout');
    	
    	$response = $event->getResponse();
    	$response->setStatusCode(403);
    	
    	$match->setParam('controller', 'Admin\Controller\Users');
    	$match->setParam('action', 'login');
    	
    	
    	
    }
}
