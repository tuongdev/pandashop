<?php
use Firebase\JWT\JWT;
class Auth {
    protected $secretKey = 'My Secret';
    function createToken($key, $value) {
        $payload = array(
            $key => $value
            );
        $token = JWT::encode($payload, $this->secretKey);
        return $token;
    }
    
    function verifyToken($token) {
        $msg = JWT::decode($token, $this->secretKey, array('HS256'));
        return $msg;
    }
}
?>