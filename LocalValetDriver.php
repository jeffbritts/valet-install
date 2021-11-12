<?php

class LocalValetDriver extends Magento2ValetDriver
{
    /**
     * Get the fully resolved path to the application's front controller.
     *
     * @param  string $sitePath
     * @param  string $siteName
     * @param  string $uri
     * @return string
     */
    public function frontControllerPath($sitePath, $siteName, $uri)
    {
        $this->loadServerEnvironmentVariables($sitePath, $siteName);
        $_SERVER['SERVER_NAME'] = $_SERVER['HTTP_HOST'];


        $allowedSiteCodes = ['fresh','auto','b2b','b2c','sitea','siteb','luma','venia','brentmill','healthbeauty'];

        if(isset($_SERVER['HTTP_HOST'])){
            $subDomain = explode('.', $_SERVER['HTTP_HOST']);
            if(isset($subDomain[0])){
                if (in_array($subDomain[0], $allowedSiteCodes)) {
                    $_SERVER["MAGE_RUN_TYPE"] = 'website';
                    $_SERVER["MAGE_RUN_CODE"] = $subDomain[0];
                }
            }
        }


        //if ($_SERVER['HTTP_HOST'] === 'venia.jeff-si-dev.test') {
        //    $_SERVER['MAGE_RUN_CODE'] = 'venia';
        //    $_SERVER['MAGE_RUN_TYPE'] = 'website';
        //}
        

        if (isset($_GET['profile'])) {
            $_SERVER['MAGE_PROFILER'] = 'html';
        }
        
        if (strpos($uri, '/errors') === 0) {
            $file = $sitePath . '/pub' . $uri;
            if (file_exists($file)) {
                return $file;
            }
            return $sitePath . '/pub/errors/404.php';
        }

        if ($uri === '/setup') {
            Header('HTTP/1.1 301 Moved Permanently');
            Header('Location: http://' . $_SERVER['HTTP_HOST'] . $uri . '/');
            die;
        }

        if (strpos($uri, '/setup') === 0) {
            $_SERVER['SCRIPT_FILENAME'] = $sitePath.'/setup/index.php';
            $_SERVER['SCRIPT_NAME'] = '/index.php';
            $_SERVER['DOCUMENT_ROOT'] = $sitePath.'/setup/';
            $_SERVER['REQUEST_URI'] = str_replace('/setup', '', $_SERVER['REQUEST_URI']);

            if ($_SERVER['REQUEST_URI'] === '') {
                $_SERVER['REQUEST_URI'] = '/';
            }
            return $sitePath.'/setup/index.php';
        }

        if (!$this->installed($sitePath)) {
            http_response_code(404);
            require __DIR__.'/../templates/magento2.php';
            exit;
        }

        if (strpos($uri, '/dev/tests/acceptance/utils/command.php') !== false) {
            return $sitePath . '/dev/tests/acceptance/utils/command.php';
        }

        $_SERVER['DOCUMENT_ROOT'] = $sitePath;

        return $sitePath . '/pub/index.php';
    }
}
