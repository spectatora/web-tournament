<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
    	$objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    	$repository = $objectManager->getRepository('Application\Entity\Areas');
    	
    	$areas = $repository->findAll();
    	
    	print '<pre>';
    	print_r($areas); die;
    	        return new ViewModel();
    }
}
