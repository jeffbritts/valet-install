<?php

use \Magento\Store\Model\StoreManager;

$serverName = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : null;
$allowedSiteCodes = ['fresh','auto','b2b','b2c','sitea','siteb','sitec','sited','sitee','luma','venia','brentmill','healthbeauty','wknd','wecafe'];
$runCode = '';
$runType = 'website';
if($serverName){
    $subdomain = explode('.',$serverName);
} else {
    return;
}


if(count($subdomain)<3){
    return;
}

foreach($allowedSiteCodes as $siteCode){
    if($siteCode == $subdomain[0]){
        $runCode = $siteCode;
        break;
    }
}

if ((!isset($_SERVER[StoreManager::PARAM_RUN_TYPE])
        || !$_SERVER[StoreManager::PARAM_RUN_TYPE])
    && (!isset($_SERVER[StoreManager::PARAM_RUN_CODE])
        || !$_SERVER[StoreManager::PARAM_RUN_CODE])
) {
    $_SERVER[StoreManager::PARAM_RUN_CODE] = $runCode;
    $_SERVER[StoreManager::PARAM_RUN_TYPE] = $runType;
}