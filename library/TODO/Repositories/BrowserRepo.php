<?php


namespace TODO\Repositories;


class BrowserRepo {

    const CLASS_NAME = 'TODO\Repositories\BrowserRepo';


    public function __construct() {

    }

    /**
     * @return array
     *
     * @author Robin Saar <robin.saar@erply.com>
     */
    public function getBrowserInfo() {

        $browserData = '';
        $browser = array(
            'version'   => '0.0.0',
            'majorver'  => 0,
            'minorver'  => 0,
            'build'     => 0,
            'name'      => 'unknown',
            'useragent' => ''
        );

        $browsers = array(
            'firefox', 'msie', 'opera', 'chrome', 'safari', 'mozilla', 'seamonkey', 'konqueror', 'netscape',
            'gecko', 'navigator', 'mosaic', 'lynx', 'amaya', 'omniweb', 'avant', 'camino', 'flock', 'aol'
        );

        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $browser['useragent'] = $_SERVER['HTTP_USER_AGENT'];
            $user_agent = strtolower($browser['useragent']);
            foreach ($browsers as $_browser) {
                if (preg_match("/($_browser)[\/ ]?([0-9.]*)/", $user_agent, $match)) {
                    $browser['name'] = $match[1];
                    $browserData = '' . $match[1] . '';
                    break;
                }
            }
        }
        return $browserData;
    }
}