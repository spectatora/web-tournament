<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Form\Contact as ContactForm;

class ContactController extends AbstractActionController
{
    public function indexAction()
    {
    	$entityManager = $this->serviceLocator->get('entity-manager');
    	$optionsEntityClassName = get_class($this->serviceLocator->get('options-entity'));
    	$repository = $entityManager->getRepository($optionsEntityClassName);
    	$contactData = $repository->findOneBy(array('optionName' => 'contactData'));
    	
    	$contactForm = new ContactForm();
    	
    	
        return array("contactData" => $contactData, "contactForm" => $contactForm);
    }

    public function sendQuestionAction()
    {
        return array();
    }
}
