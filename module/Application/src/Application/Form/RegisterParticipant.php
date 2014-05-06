<?php
namespace Application\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Form;

class RegisterParticipant extends Form implements ObjectManagerAwareInterface
{
	protected $objectManager;
	
	public function __construct(ObjectManager $objectManager)
	{
		$this->setObjectManager($objectManager);
	
		parent::__construct('db-adapter-form');
	
		$this->add(array(
				'type'    => 'DoctrineModule\Form\Element\ObjectSelect',
				'name'    => 'name',
				'options' => array(
						'label'          => 'Dynamic ObjectManager Select',
						'object_manager' => $this->getObjectManager(),
						'target_class'   => 'Application\Model\Entity\Areas',
						'property'       => 'areaname',
						'empty_option'   => '--- please choose ---'
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