<?php
    
    require_once 'libs/router.php';
    require_once 'app/controllers/owner.api.controller.php';
    require_once 'app/controllers/auth.controller.php';
    require_once 'app/middlewares/jwt.auth.middleware.php';

    $router = new Router();

    $router->addMiddleware(new JWTAuthMiddleware());

    #      ENDPOINT                                  VERBO          CONTROLLER               METODO
    $router->addRoute('owner'          ,            'GET'    ,     'OwnerApiController' ,   'getAll');
    $router->addRoute('owner/:id'      ,            'GET'    ,     'OwnerApiController' ,   'get'   );
   // $router->addRoute('owner/:id'      ,            'DELETE' ,     'OwnerApiController' ,   'delete');
    $router->addRoute('owner'          ,            'POST'   ,     'OwnerApiController' ,   'created');
    $router->addRoute('owner/:id'      ,            'PUT'    ,     'OwnerApiController' ,   'updateOwner');    
    $router->addRoute('usuarios/token' ,            'GET'    ,     'UserApiController'  ,   'getToken');

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);