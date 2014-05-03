<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'adminHome' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/admin',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'adminApplication' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => 'Admin\Controller\IndexController'
        ),
    ),
   'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'admin/layout'           => __DIR__ . '/../view/layout/adminlayout.phtml',
            'admin/index/index' => __DIR__ . '/../view/admin/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    'controllers' => array(
    		'invokables' => array(
    				'Admin\Controller\Index' => 'Admin\Controller\IndexController',
    				'Admin\Controller\Users' => 'Admin\Controller\UsersController'
    		),
    ),
    'acl' => array(
    		'role' => array (
    				// role -> multiple parents
    				'guest'   => null,
    				'member'  => array('guest'),
    				'admin'   => null,
    		),
    		'resource' => array (
    				// resource -> single parent
    				'account' => null,
    				'users'     => null,
    				'admin' => null
    		),
    		'allow' => array (
    				// array('role', 'resource', array('permission-1', 'permission-2', ...)),
    				array('guest', 'users', 'login'),
    				array('guest', 'account', 'register'),
    				array('member', 'account', array('me')), // the member can only see his account
    				array('member', 'users', 'logout'), // the member can log out
    				array('admin', null, null), // the admin can do anything with the accounts
    		),
    		'deny'  => array (
    				array('guest', null, 'delete') // null as second parameter means
    				// all resources
    
    		),
    		'defaults' => array (
    				'guest_role' => 'guest',
    				'member_role' => 'member',
    		),
    		'resource_aliases' => array (
    				'Application\Controller\Users' => 'users',
    		),
    
    		// List of modules to apply the ACL. This is how we can specify if we have to protect the pages in our current module.
    		'modules' => array (
    				'Application',
    				'Admin'
    		),
    )
);
