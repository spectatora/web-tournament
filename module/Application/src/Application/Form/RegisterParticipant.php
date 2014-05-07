<?php
namespace Application\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Form;
use Zend\Form\Element;

class RegisterParticipant extends Form implements ObjectManagerAwareInterface
{
	protected $objectManager;
	
	public function __construct(ObjectManager $objectManager)
	{
		$this->setObjectManager($objectManager);
	
		parent::__construct('register-participant-form');
	
		
		
		//$this->setAction($this->url(array(), 'default'));
		//$this->setMethod('post');
		
		$this->add(array(
				'name' => 'names',
				'options' => array(
						'label' => 'Име, презиме, фамилия',
				),
				'attributes' => array(
						'type'  => 'text',
				),
		));
		
		$this->add(array(
				'type'    => 'DoctrineModule\Form\Element\ObjectSelect',
				'name'    => 'area',
				'options' => array(
						'label'          => 'Област',
						'object_manager' => $this->getObjectManager(),
						'target_class'   => 'Application\Model\Entity\Areas',
						'property'       => 'areaname',
						'empty_option'   => 'Изберете област'
				),
		));
		
		$this->add(array(
				'type' => 'Zend\Form\Element\Select',
				'name' => 'city',
				'options' => array(
						'label' => 'Населено място',
						'value_options' => array(
								'0' => 'Изберете населено място'
						),
				)
		)); 
		
		$this->add(array(
				'type' => 'Zend\Form\Element\Checkbox',
				'name' => 'anothercity',
				'options' => array(
						'label' => 'Друго населено място',
						'use_hidden_element' => true,
						'checked_value' => 'good',
						'unchecked_value' => 'bad'
				)
		));
		
		$this->add(array(
				'type' => 'Zend\Form\Element\Select',
				'name' => 'school',
				'options' => array(
						'label' => 'Училище',
						'value_options' => array(
								'0' => 'Изберете училище'
						),
				)
		));
		
		$this->add(array(
				'type' => 'Zend\Form\Element\Checkbox',
				'name' => 'another',
				'options' => array(
						'label' => 'Друго училище',
						'use_hidden_element' => true,
						'checked_value' => 'good',
						'unchecked_value' => 'bad'
				)
		));
		
		$this->add(array(
				'type' => 'Zend\Form\Element\Select',
				'name' => 'grade',
				'options' => array(
						'label' => 'Клас',
						'value_options' => array(
								'11'=>'11',
								'12'=>'12'
						),
				)
		));
		
		$this->add(array(
				'name' => 'address',
				'options' => array(
						'label' => 'Адрес',
				),
				'attributes' => array(
						'type'  => 'text',
				),
		));
		
		$this->add(array(
				'type' => 'Zend\Form\Element\Email',
				'name' => 'email',
				'options' => array(
						'label' => 'Email Address'
				),
		));
		
		$this->add(array(
				'name' => 'phone',
				'options' => array(
						'label' => 'Телефон',
				),
				'attributes' => array(
						'type'  => 'text',
				),
		));
		
		$this->add(array(
				'name' => 'teacher',
				'options' => array(
						'label' => 'Преподавател по математика (име, фамилия)',
				),
				'attributes' => array(
						'type'  => 'text',
				),
		));
		
		/*
		$this->add(array(
				'type' => 'Zend\Form\Element\Captcha',
				'name' => 'captcha',
				'options' => array(
						'label' => 'Please verify you are human',
				),
		));
		*/
		
		$this->add(new Element\Csrf('security'));
		
		$this->add(array(
            'name' => 'submitParticipant',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Регистрирай',
                'id' => 'submitbutton',
            ),
        ));
	}
	
	public function setObjectManager(ObjectManager $objectManager)
	{
		$this->objectManager = $objectManager;
	
		return $this;
	}
	
	public function getObjectManager()
	{
		return $this->objectManager;
	}
}