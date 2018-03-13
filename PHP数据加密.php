<?php
/* 
签名数据： 
data：utf-8编码的订单原文， 
privatekeyFile：私钥路径 
passphrase：私钥密码 
返回：base64转码的签名数据 
*/  
function sign($data, $privatekeyFile,$passphrase)  
{   
  $signature = '';  
    $privatekey = openssl_pkey_get_private(file_get_contents($privatekeyFile), $passphrase);  
  $res=openssl_get_privatekey($privatekey);  
  openssl_sign($data, $signature, $res);  
  openssl_free_key($res);    
  
  return base64_encode($signature);  
}  
  
/* 
验证签名： 
data：原文 
signature：签名 
publicKeyPath：公钥路径 
返回：签名结果，true为验签成功，false为验签失败 
*/  
function verity($data, $signature, $publicKeyPath)  
{  
    $pubKey = file_get_contents('D:/certs/test.pem');  
    $res = openssl_get_publickey($pubKey);  
    $result = (bool)openssl_verify($data, base64_decode($signature), $res);  
    openssl_free_key($res);  
  
    return $result;  
}  