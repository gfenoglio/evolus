<?php

namespace UserManager\Form;

 use Zend\Form\Form;

 class LoginForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('login');

         $this->add(array(
             'name' => 'pin',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Utente',
             ),
             'attributes' => array(
                'class' => 'form-control' 
            )
         ));
         $this->add(array(
             'name' => 'password',
             'type' => 'Password',
             'options' => array(
                 'label' => 'Password',
             ),
             'attributes' => array(
                'class' => 'form-control' 
            )
         ));
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Login',
                 'id' => 'submitbutton',
             ),
             'attributes' => array(
                'class' => 'btn btn-default' 
            )
         ));
     }
 }