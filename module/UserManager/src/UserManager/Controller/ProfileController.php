<?php

namespace UserManager\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Soap;
use Zend\Session\Container;

class ProfileController extends AbstractActionController
{
    public function profileAction() {
        $cookie = new Container('soap');
        $soap_user = $cookie->soap_user;
        $soap_psw = $cookie->soap_psw;
        $soap_company = $cookie->soap_comp;
        $action = filter_input(INPUT_GET, 'action');
        
        $client = new \SoapClient('http://172.30.11.154:8080/EVOLUS/servlet/siev_fgetdatipaz?wsdl',  array('soap_version'=>'1.0'));
        $cookie = new Container('dati_login');
        $pin = $cookie->pin;

        $resp = $client->siev_fgetdatipaz_Run( array(
                                'm_UserName' => $soap_user,
                                'm_Password' => $soap_psw,
                                'm_Company' => $soap_company,
                                'pPIN' => $pin
                            ));
        $view = new ViewModel();
        $view->paziente = json_decode($resp->return)->paziente;
        
        switch ($action) {
            case 'anagrafica':
                $view->color = '#00445e';
                $view->content = 'anagrafica';
                $view->img_index = 3;
                break;
            case 'esenzioni':
                $view->color = '#afeed8';
                $view->content = 'esenzioni';
                $view->img_index = 5;
                break;
            case 'riassunto':
                $view->color = '#008fb1';
                $view->content = 'riassunto';
                $view->img_index = 1;
                break;
            case 'allergie':
                $view->color = '#f14545';
                $view->content = 'allergie';
                $view->img_index = 6;
                break;
            case 'esamiDiLaboratorio':
                $view->color = '#31b16e';
                $view->content = 'esamiDiLaboratorio';
                $view->img_index = 7;
                break;
            case 'procedureDiagnostiche':
                $view->color = '#c0352d';
                $view->content = 'procedureDiagnostiche';
                $view->img_index = 8;
                break;
            default:
                case 'riassunto':
                $view->color = '#008fb1';
                $view->content = 'riassunto';
                $view->img_index = 1;
                break; 
        }
        
        return $view;
    }
}