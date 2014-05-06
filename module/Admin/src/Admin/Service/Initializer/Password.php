<?php
namespace Admin\Service\Initializer;

use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Admin\Model\PasswordAwareInterface;

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
