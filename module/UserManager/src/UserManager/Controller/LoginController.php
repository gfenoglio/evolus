<?php

namespace UserManager\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use UserManager\Form\LoginForm;
use UserManager\Form\Login2Form;
use Zend\Soap\Client;
use Zend\Session\Container;

class LoginController extends AbstractActionController
{    
    public function login2stepAction() {
        
        $form = new Login2Form();
        $errmsg = '';

        $form->get('submit')->setValue('VERIFICA');

        $request = $this->getRequest();
        
        if($request->isPost()) {
            // prendo le credenziali per soap
            
            $cookie = new Container('soap');
            $soap_user = $cookie->soap_user;
            $soap_psw = $cookie->soap_psw;
            $soap_company = $cookie->soap_comp;
            
            // prendo il cookie
            $cookie = new Container('dati_login');
            
            $client = new Client('http://172.30.11.154:8080/EVOLUS/servlet/siev_fcheck_user?wsdl',
                                 array('soap_version'=>'1.0')
                                );
            
            $resp = $client->siev_fcheck_user_Run( array(
                                    'm_UserName' => $soap_user,
                                    'm_Password' => $soap_psw,
                                    'm_Company' => $soap_company,
                                    'pTIPO' => '2',
                                    'pPIN' => $cookie->pin,
                                    'pPASSWD' => $cookie->password,
                                    'pCODFIS' => $request->getPost('codfis'),
                                ));
            
            $res = (int) json_decode($resp->return);

            if($res == 1) {
                $cookie->codfis = $request->getPost('codfis');
                return $this->redirect()->toRoute('Profile', array('profile'));
            } else {
                $errmsg = 'Attenzione, codice fiscale non valido';
            }
        }
        return array('form' => $form, 'errmsg' => $errmsg);
    }
    
    public function loginAction() {
        //getSoapAuth();
        
        $form = new LoginForm();
        $errmsg = '';
        
        $form->get('submit')->setValue('LOGIN');

        $request = $this->getRequest();
        if($request->isPost()) {
            
            // prendo le credenziali per soap
            
            $cookie = new Container('soap');
            $soap_user = $cookie->soap_user;
            $soap_psw = $cookie->soap_psw;
            $soap_company = $cookie->soap_comp;
                        
            $client = new Client('http://172.30.11.154:8080/EVOLUS/servlet/siev_fcheck_user?wsdl',
                                 array('soap_version'=>'1.0')
                                );
            
            $resp = $client->siev_fcheck_user_Run( array(
                                    'm_UserName' => $soap_user,
                                    'm_Password' => $soap_psw,
                                    'm_Company' => $soap_company,
                                    'pTIPO' => '1',
                                    'pPIN' => $request->getPost('pin'),
                                    'pPASSWD' => $request->getPost('password'),
                                    'pCODFIS' => '',
                                    
                                ));
            
            
            /*$resp = $client->siev_fcheck_user_Run( array(
                                    'm_UserName' => 'soap',
                                    'm_Password' => 'Sinfo957',
                                    'm_Company' => '001',
                                    'pTIPO' => '1',
                                    'pPIN' => $request->getPost('pin'),
                                    'pPASSWD' => $request->getPost('password'),
                                    'pCODFIS' => '',
                                    
                                ));*/
            
            $res = (int) json_decode($resp->return);
            if($res == 1) {
                $cookie = new Container('dati_login');
                $cookie->pin = $request->getPost('pin');
                $cookie->password = $request->getPost('password');
                return $this->redirect()->toRoute('login2step');
            } else {
                $errmsg = 'Attenzione, credenziali non valide';
            }
        }
        return array('form' => $form, 'errmsg' => $errmsg);
    }
}