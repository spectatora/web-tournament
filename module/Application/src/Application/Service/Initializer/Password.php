<?php
namespace Application\Service\Initializer;

use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Model\PasswordAwareInterface;

class Password implements InitializerInterface
{
    /* (non-PHPdoc)
     * @see \Zend\ServiceManager\InitializerInterface::initialize()
     */
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if($instance instanceof PasswordAwareInterface) {
            $instance->setPasswordAdapter($serviceLocator->get('password-adapter'));
        }
    }
}
