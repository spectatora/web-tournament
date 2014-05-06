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
use Application\Form\RegisterParticipant as RegisterParticipantForm;
use DoctrineORMModule\Form\Annotation\AnnotationBuilder;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	error_reporting(E_ALL);
    	ini_set('display_errors', true);
    	
    	$contactData = array(
    		"address" => 'гр. Велико Търново, ул. "Арх. Георги Козаров" № 3',
    		"phones" => array(
    			0 => array(
    				"phoneHolder" => 'Факултет “Математика и информатика”',
    			    "phoneNumber" => '062/ 600 461'
    			),
    				1 => array(
    						"phoneHolder" => 'Организационен комитет',
    						"phoneNumber" => '0887726163'
    				),
    				2 => array(
    						"phoneHolder" => 'Организационен комитет',
    						"phoneNumber" => '0887718784'
    				)
    		),
    	   "emails" => array(
    	   		"math@dev-vt.net",
    	   		"mat_turnir@uni-vt.bg"
    		)
    	);
    	
    	
    
    	$entityManager = $this->serviceLocator->get('entity-manager');
    	
    	
    	$form = new RegisterParticipantForm($entityManager);
    	
    	 
    	
    	//$userEntityClassName = get_class($this->serviceLocator->get('user-entity'));
    	$optionsEntityClassName = get_class($this->serviceLocator->get('options-entity'));
    	
    	$repository = $entityManager->getRepository($optionsEntityClassName);
    	//$users = $repository->findBy(array('optionName' => 'contactData'));
    	
    	$contactData = $repository->findOneBy(array('optionName' => 'contactData'));
    	
    	return new ViewModel(array('contactData' => $contactData, 'form' => $form));
    }
}
