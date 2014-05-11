<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Form\Contact as ContactForm;
use Zend\Mail;

class ContactController extends AbstractActionController
{
    public function indexAction()
    {
    	$entityManager = $this->serviceLocator->get('entity-manager');
    	$optionsEntityClassName = get_class($this->serviceLocator->get('options-entity'));
    	$repository = $entityManager->getRepository($optionsEntityClassName);
    	$contactData = $repository->findOneBy(array('optionName' => 'contactData'));
    	
    	$contactData = json_decode($contactData->getOptionValue(),true);
    	
    	$contactEmail = $contactData['emails'][0];
    	
    	$contactForm = new ContactForm();
    	
    	$request = $this->getRequest();
    	if ($request->isPost())
    	{
    		$contactForm->setData($request->getPost());
    		
    		if ($contactForm->isValid())
    		{
    			$formData = $contactForm->getData();
    			
    			$mail = new Mail\Message('UTF-8');
    			$mail->setBody($formData['message']);
    			
    			
    			
    			$mail->setFrom($formData['email'], $formData['names']);
    			$mail->addTo($contactEmail, 'Организационен комитет');
    			$mail->setSubject($formData['subject']);
    			
    			$transport = new Mail\Transport\Sendmail();
    			$transport->send($mail);
    		}
    	}
    	
        return array("contactData" => $contactData, "contactForm" => $contactForm);
    }

    public function sendQuestionAction()
    {
        return array();
    }
}
