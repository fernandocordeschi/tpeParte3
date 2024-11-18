<?php
    class JWTAuthMiddleware {
        public function run($req, $res) {
            $auth_header = $_SERVER['HTTP_AUTHORIZATION']; // "Bearer . token . firma", Obtiene el valor del encabezado Authorization 
            // de la solicitud HTTP. Se espera que tenga el formato "Bearer <token>"
            $auth_header = explode(' ', $auth_header); // Separa el valor del encabezado en un arreglo usando el espacio como delimitador. 
            // El resultado será un array de dos elementos: el primero será "Bearer", y el segundo será el token JWT. 
            if(count($auth_header) != 2) { // Verifica que tenga exacatmente 2 partes.
                return;
            }
            if($auth_header[0] != 'Bearer') { // Comprueba que la primera parte del encabezado sea "Bearer".
                return;
            }
            $jwt = $auth_header[1]; // Si las verificaciones anteriores son correctas, asigna el token JWT (segunda parte) a la variable $jwt
            $res->user = validateJWT($jwt);// Llama a la función validateJWT para validar el token JWT. El resultado (probablemente un objeto
            // o datos del usuario) se asigna a la propiedad user de la respuesta ($res).
        }
    }