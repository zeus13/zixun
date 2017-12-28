<?php
/**
 * Demo of Tongji API
 * set your information such as USERNAME, PASSWORD ... before use
 */

//*
//preLogin,doLogin URL
define('LOGIN_URL', 'https://api.baidu.com/sem/common/HolmesLoginService');

//Tongji API URL
define('API_URL', 'https://api.baidu.com/json/tongji/v1/ReportService');

//USERNAME
define('USERNAME', 'afxeon');

//PASSWORD
define('PASSWORD', '5329970');

//TOKEN
define('TOKEN', '6a5509befc11cd9c600d39dfbba05d1e');

//UUID, used to identify your device, for instance: MAC address
define('UUID', '123');

//ACCOUNT_TYPE
define('ACCOUNT_TYPE', 1); //ZhanZhang:1,FengChao:2,Union:3,Columbus:4
//*/

/* Debug info
define('LOGIN_URL', 'http://10.48.55.235:8443/sem/common/HolmesLoginService');
define('API_URL', 'http://10.95.130.245:8843/gateway/json/tongji/v1/ReportService');
define('USERNAME', 'nscl');
define('PASSWORD', 'Asd123');
define('TOKEN', '09bfeb6f1811a6ec62ed1da7868fcb45');
define('UUID', '123');
define('ACCOUNT_TYPE', 1);
//*/