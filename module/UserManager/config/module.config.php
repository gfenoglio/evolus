<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'UserManager\Controller\Login' => 'UserManager\Controller\LoginController',
            'UserManager\Controller\Profile' => 'UserManager\Controller\ProfileController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
             __DIR__ . '/../view'
        ),

    ),
    'router' => array(
        'routes' => array(
            
            'Login' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/login',
                    'defaults' => array(
                        '__NAMESPACE__' => 'UserManager\Controller',
                        'controller'    => 'Login',
                        'action'        => 'login',
                    ),
                ),
                'may_terminate' => true,
            ),
            'login2step'  => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/login2step',
                    'defaults' => array(
                        '__NAMESPACE__' => 'UserManager\Controller',
                        'controller' => 'Login',
                        'action'     => 'login2step',
                    )
                )
            ),
            'Profile' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/profile',
                    'defaults' => array(
                        '__NAMESPACE__' => 'UserManager\Controller',
                        'controller'    => 'Profile',
                        'action'        => 'profile',
                    ),
                ),
                'may_terminate' => true,
            )
        )
    )
);