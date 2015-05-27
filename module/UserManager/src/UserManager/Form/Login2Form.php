<?php

namespace UserManager\Form;

 use Zend\Form\Form;

 class Login2Form extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('Login');
         
         $this->add(array(
             'name' => 'codfis',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Codice Fiscale',
             ),
             'attributes' => array(
                'class' => 'form-control' 
            )
         ));
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Verifica',
                 'id' => 'submitbutton',
             ),
             'attributes' => array(
                'class' => 'btn btn-default' 
            )
         ));
     }
 }