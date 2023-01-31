<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OpenSSLDecryptController extends Controller
{
    //

    private $cipher;
    private $ivlen;
    private $iv;
    private $tag;
    private $key;

    public function __construct($_cipher="aes-128-gcm")
    {
        $this->cipher=$_cipher;
        $this->ivlen = openssl_cipher_iv_length($this->cipher);
        $this->iv = openssl_random_pseudo_bytes($this->ivlen);
        $this->key=env("CLAVE_SECRETA");
    }

    public function encriptar($datoAEncriptar)
    {
        if (in_array($this->cipher, openssl_get_cipher_methods()))
        {
            $this->ivlen = openssl_cipher_iv_length($this->cipher);
            $this->iv = openssl_random_pseudo_bytes($this->ivlen);
            $encrypt =openssl_encrypt($datoAEncriptar,$this->cipher,$this->key, $options=0, $this->iv, $tag);
            $this->tag=$tag;
            return $encrypt;
        }
    }
    
    public function desencriptar($datoADesencriptar)
    {
        if (in_array($this->cipher, openssl_get_cipher_methods()))
        {
            return openssl_decrypt($datoADesencriptar,$this->cipher,$this->key, $options=0, $this->iv, $this->tag);
        }
    }

}
