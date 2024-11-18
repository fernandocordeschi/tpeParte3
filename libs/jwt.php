<?php
    function createJWT($payload) {
        // Header
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        // Payload
        $payload = json_encode($payload);

        // Base64Url
        $header = base64_encode($header);
        $header = str_replace(['+', '/', '='], ['-', '_', ''], $header);
        $payload = base64_encode($payload);
        $payload = str_replace(['+', '/', '='], ['-', '_', ''], $payload);

        // Firma
        $signature = hash_hmac('sha256', $header . "." . $payload, 'mi1secreto', true);
        $signature = base64_encode($signature);
        $signature = str_replace(['+', '/', '='], ['-', '_', ''], $signature);

        // JWT
        $jwt = $header . "." . $payload . "." . $signature;
        return $jwt;
    }

    function validateJWT($jwt) {
        $jwt = explode('.', $jwt);  // Separa el token JWT en 3 partes (header, payload, signature)
        if(count($jwt) != 3) {      // Si no son 3 partes, el JWT es inválido
            return null;
        }
        $header = $jwt[0];          // Asigna la primera parte (header) del JWT
        $payload = $jwt[1];         // Asigna la segunda parte (payload) del JWT
        $signature = $jwt[2];       // Asigna la tercera parte (signature) del JWT

        $valid_signature = hash_hmac('sha256', $header . "." . $payload, 'mi1secreto', true);// Calcula la firma esperada usando el header y payload con un secreto
        $valid_signature = base64_encode($valid_signature); // Codifica la firma calculada en base64
        $valid_signature = str_replace(['+', '/', '='], ['-', '_', ''], $valid_signature); // Ajusta la base64 para el formato URL-safe

        if($signature != $valid_signature) { // Si la firma calculada no coincide con la firma del JWT, es inválido
            return null;
        }

        $payload = base64_decode($payload);  // Decodifica el payload del JWT de base64 a string
        $payload = json_decode($payload);   // Convierte el string JSON en un objeto PHP
        
        if($payload->exp < time()) { // Si la fecha de expiración del JWT ha pasado, es inválido
            return null;
        }

        return $payload; // Si todo es válido, retorna el payload decodificado (que contiene los datos del usuario)
    }