<?php
use Application\Authentication\Adapter;
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
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'deniedLogin' => array(
            		'type' => 'Zend\Mvc\Router\Http\Literal',
            		'options' => array(
            				'route'    => '/deniedLogin',
            				'defaults' => array(
            						'controller' => 'Application\Controller\Account',
            						'action'     => 'denied',
            				),
            		),
             ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
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
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
        'factories' => array(
        	'auth' 	       => 'Application\Service\Factory\Authentication',
        	'password-adapter' => 'Application\Service\Factory\PasswordAdapter',
        	'entity-manager'   => 'Application\Service\Factory\EntityManager',
        	'acl' => 'Application\Service\Factory\Acl',
        	'user'	       => 'Application\Service\Factory\User',
        ),
        'initializers' => array (
        		'Application\Service\Initializer\Password'
        ),
        'invokables' => array(
        	'auth-adapter' 	=> 'Application\Authentication\Adapter',
        	'user-entity'       => 'Application\Model\Entity\User',
        ),
        'shared' => array(
        		'user-entity' => false,
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
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Users' => 'Application\Controller\UsersController',
            'Application\Controller\Account' => 'Application\Controller\AccountController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
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
    'doctrine' => array(
    		'entity_path' => array (
	                __DIR__ . '/../src/Application/Model/Entity/',
	        ),
	        'initializers' => array(
	        		'Application\Service\Initializer\Password'
	        ),
    ),
    'db' => array(
    		'driver' => 'Mysqli', //The database driver. Mysqli, Sqlsrv, Pdo_Sqlite, Pdo_Mysql, Pdo=OtherPdoDriver
    		'database' => 'sampleProject', // 	generally required 	the name of the database (schema)
    		'username' => 'root', // generally required 	the connection username
    		'password' => '', // 	generally required 	the connection password
    		'hostname' => 'localhost', // not generally required 	the IP address or hostname to connect to
    		// 'port' => 1234,  	// not generally required 	the port to connect to (if applicable)
    		'charset' => 'utf8',  //	not generally required 	the character set to use
    		'options' => array (
    				'buffer_results' => 0
    		)
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
    		),
    )
);
