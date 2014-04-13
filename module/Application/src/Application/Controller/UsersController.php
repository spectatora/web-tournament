<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\EventManager\EventManager;

class UsersController extends AbstractActionController
{

    public function logoutAction()
    {
        $auth = $this->serviceLocator->get('auth');
        $auth->clearIdentity();
        return $this->redirect()->toRoute('home');
    }

    public function loginAction()
    {
    	error_reporting(E_ALL);
    	ini_set('display_errors', true);
    	
        if (!$this->getRequest()->isPost()) {
            // just show the login form
            return array();
        }

        $username = $this->params()->fromPost('username');
        $password = $this->params()->fromPost('password');

        $auth = $this->serviceLocator->get('auth');
        $authAdapter = $auth->getAdapter();
        // below we pass the username and the password to the authentication adapter for verification
        $authAdapter->setIdentity($username);
        $authAdapter->setCredential($password);

        // here we do the actual verification
        $result = $auth->authenticate();
        $isValid = $result->isValid();
        if($isValid) {
            // upon successful validation the getIdentity method returns
            // the user entity for the provided credentials
            $user = $result->getIdentity();

            // @todo: upon successful validation store additional information about him in the auth storage

            $this->flashmessenger()->addSuccessMessage(sprintf('Welcome %s. You are now logged in.',$user->getEmail()));

            return $this->redirect()->toRoute('application', array (
                    'controller' => 'account',
                    'action'     => 'me',
            ));
        } else {
           return $this->redirect()->toRoute('deniedLogin', array (
                    'controller' => 'account',
                    'action'     => 'denied',
            ));
        }
    }
}
