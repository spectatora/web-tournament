<?php
namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class Contact extends Form
{
	
	public function __construct()
	{
	
		parent::__construct('contact-form');
		
		$this->add(array(
				'name' => 'names',
				'options' => array(
						'label' => 'Име, презиме, фамилия',
				),
				'attributes' => array(
						'type'  => 'text',
						'required' => true
				),
		));
		
		$this->add(array(
				'type' => 'Zend\Form\Element\Email',
				'name' => 'email',
				'options' => array(
						'label' => 'Email Address',
						'required' => true
				),
		));
		
		$this->add(array(
				'name' => 'subject',
				'options' => array(
						'label' => 'Относно',
				),
				'attributes' => array(
						'type'  => 'text',
						'required' => true
				),
		));
		
		$this->add(array(
				'type' => 'Zend\Form\Element\Textarea',
				'name' => 'message',
				'options' => array(
						'label' => 'Съобщение',
						'required' => true
				),
		));
		
		
		$this->add(new Element\Csrf('security'));
		
		$this->add(array(
            'name' => 'submitMessage',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Изпрати запитване',
                'id' => 'submitbutton',
            ),
        ));
	}
}