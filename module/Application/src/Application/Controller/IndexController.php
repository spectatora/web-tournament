<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Crypt\Password\Bcrypt;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DoctrineORMModule\Form\Annotation\AnnotationBuilder;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	error_reporting(E_ALL);
    	ini_set('display_errors', true);
    	
    	
    	$entityManager = $this->serviceLocator->get('entity-manager');
    	$userEntityClassName = get_class($this->serviceLocator->get('user-entity'));
    	$repository = $entityManager->getRepository($userEntityClassName);
    	 
    	$areas = $repository->findAll();
    	
    	print ' in here';
    	var_dump($areas);
    	
    	die;
    	$entityManager = $this->serviceLocator->get('Doctrine\ORM\EntityManager');
    	$userEntityClassName = get_class($this->serviceLocator->get('user-entity'));
    	
    	$userRepository = $entityManager->getRepository($userEntityClassName);
    	print_r($userRepository); die;
    	
    	
    	
    	$entityManager = $this->serviceLocator->get('Doctrine\ORM\EntityManager');
    	$userEntity = $this->serviceLocator->get('user-entity');
    	
    	$userEntity->setEmail("admin@tournament.bg");
    	$userEntity->setPassword("123456");
    	$userEntity->setRole("admin");
    	
    	//$entityManager->persist($userEntity);
    	//$entityManager->flush();
    	
    	var_dump($userEntity);die;
    	
    	
    	$bcrypt = new Bcrypt(array(
	
'salt' => '1234567890123456',
	
'cost' => 16
));
$start = microtime(true);
$password = $bcrypt->create('password');
$end = microtime(true);
printf ("Password : %s\n", $password);
printf ("Exec. time: %.2f\n", $end-$start); die;
    	
    	
    	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    	$repository = $objectManager->getRepository('Application\Entity\Areas');
    	
    	$areas = $repository->findAll();
    	
    	
    	
    	$areasEntity = new \Application\Entity\Areas();
    	
    	$anotationBuilder = new AnnotationBuilder($objectManager);
    	$form  = $anotationBuilder->createForm($areasEntity);
    	
    	
    	
    	//print '<pre>';
    	//print_r($areas);
    	        return new ViewModel(array('form' => $form));
    }
}
