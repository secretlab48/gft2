<?php
/*
 * ----------------------------------------------------------------------
 *
 *                          Borlabs Cookie
 *                      developed by Borlabs
 *
 * ----------------------------------------------------------------------
 *
 * Copyright 2018-2020 Borlabs - Benjamin A. Bornschein. All rights reserved.
 * This file may not be redistributed in whole or significant part.
 * Content of this file is protected by international copyright laws.
 *
 * ----------------- Borlabs Cookie IS NOT FREE SOFTWARE -----------------
 *
 * @copyright Borlabs - Benjamin A. Bornschein, https://borlabs.io
 * @author Benjamin A. Bornschein, Borlabs ben@borlabs.io
 *
 */

namespace BorlabsCookie\Cookie\Frontend;

use BorlabsCookie\Cookie\Config;
use BorlabsCookie\Cookie\Multilanguage;
use BorlabsCookie\Cookie\Tools;

class JavaScript
{
    private static $instance;

    /**
     * contentBlocker
     *
     * (default value: [])
     *
     * @var mixed
     * @access private
     */
    private $contentBlocker = [];

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    protected function __construct()
    {
    }

    /**
     * addContentBlocker function.
     *
     * @access public
     * @param mixed $contentBlockerId
     * @param string $globalJS (default: '')
     * @param string $initJS (default: '')
     * @param mixed $settings (default: [])
     * @return void
     */
    public function addContentBlocker($contentBlockerId, $globalJS = '', $initJS = '', $settings = [])
    {
        $settings = apply_filters('borlabsCookie/contentBlocker/modify/settings/'.$contentBlockerId, $settings);

        $this->contentBlocker[$contentBlockerId] = [
            'contentBlockerId' => $contentBlockerId,
            'global' => $globalJS,
            'init' => $initJS,
            'settings' => $settings,
        ];

        return true;
    }

    /**
     * getContentBlockerScriptsData function.
     *
     * @access public
     * @return void
     */
    public function getContentBlockerScriptsData()
    {
        $js = 'var borlabsCookieContentBlocker = {';

        if (!empty($this->contentBlocker)) {

            foreach ($this->contentBlocker as $contentBlockerId => $data) {

                $js .= '"' . $contentBlockerId . '": {';
                $js .= '"id": "' . $contentBlockerId . '",';
                $js .= '"global": function (contentBlockerData) { ' . $data['global'] . ' },';
                $js .= '"init": function (el, contentBlockerData) { ' . $data['init'] . ' },';
                $js .= '"settings": '.json_encode($data['settings']);
                $js .= '},';
            }

            $js = substr($js, 0, -1);
        }

        $js .= '};';

        return $js;
    }

    /**
     * register function.
     *
     * @access public
     * @return void
     */
    public function register()
    {
        wp_enqueue_script(
            'borlabs-cookie', BORLABS_COOKIE_PLUGIN_URL.'javascript/borlabs-cookie.min.js',
            [
                Config::getInstance()->get('jQueryHandle'),
            ],
            BORLABS_COOKIE_VERSION
        );

        // Domain information for javascript cookie
        $siteURL = get_home_url();
        $siteURLInfo = parse_url($siteURL);
        $cookiePath = !empty($siteURLInfo['path']) ? $siteURLInfo['path'] : "/";

        if (Config::getInstance()->get('automaticCookieDomainAndPath') === false) {
            $cookiePath = Config::getInstance()->get('cookiePath');
        }

        $cookieVersion = intval(get_site_option('BorlabsCookieCookieVersion', 1));

        $jsConfig = [
            'ajaxURL' => admin_url('admin-ajax.php'),
            'language' => Multilanguage::getInstance()->getCurrentLanguageCode(),

            'animation' => Config::getInstance()->get('cookieBoxAnimation'),
            'animationDelay' => Config::getInstance()->get('cookieBoxAnimationDelay'),
            'animationIn' => Config::getInstance()->get('cookieBoxAnimationIn'),
            'animationOut' => Config::getInstance()->get('cookieBoxAnimationOut'),
            'blockContent' => Config::getInstance()->get('cookieBoxBlocksContent'),
            'boxLayout' => str_replace(['-slim', '-advanced'], '', Config::getInstance()->get('cookieBoxLayout')),
            'boxLayoutAdvanced' => strpos(Config::getInstance()->get('cookieBoxLayout'), '-advanced') !== false ? true : false,

            'automaticCookieDomainAndPath' => Config::getInstance()->get('automaticCookieDomainAndPath'),
            'cookieDomain' => Config::getInstance()->get('cookieDomain'),
            'cookiePath' => $cookiePath,
            'cookieLifetime' => Config::getInstance()->get('cookieLifetime'),
            'crossDomainCookie' => Config::getInstance()->get('crossDomainCookie'),

            'cookieBeforeConsent' => Config::getInstance()->get('cookieBeforeConsent'),
            'cookiesForBots' => Config::getInstance()->get('cookiesForBots'),
            'cookieVersion' => $cookieVersion,
            'hideCookieBoxOnPages' => Config::getInstance()->get('hideCookieBoxOnPages'),
            'respectDoNotTrack' => Config::getInstance()->get('respectDoNotTrack'),
            'reloadAfterConsent' => Config::getInstance()->get('reloadAfterConsent'),
            'showCookieBox' => Config::getInstance()->get('showCookieBox'),
            'cookieBoxIntegration' => Config::getInstance()->get('cookieBoxIntegration'),

            'ignorePreSelectStatus' => Config::getInstance()->get('cookieBoxIgnorePreSelectStatus'),

            'cookies' => [],
        ];

        $allCookies = Cookies::getInstance()->getAllCookieGroups();
        $cookies = [];
        $fallbackCode = [];

        if (!empty($allCookies)) {
            foreach ($allCookies as $cookieGroupData) {

                // Add all cookie groups to the array which are needed by the JavaScript class
                $jsConfig['cookies'][$cookieGroupData->group_id] = [];

                if (!empty($cookieGroupData->cookies)) {

                    foreach ($cookieGroupData->cookies as $cookieData) {

                        // Add all cookies to the array which are needed by the JavaScript class
                        $jsConfig['cookies'][$cookieGroupData->group_id][] = $cookieData->cookie_id;

                        $cookieData = apply_filters('borlabsCookie/cookie/modify/code/'.$cookieData->cookie_id, $cookieData);

                        $cookies[$cookieGroupData->group_id][$cookieData->cookie_id] = [
                            'cookieNameList' => CookieBlocker::getInstance()->prepareCookieNamesList($cookieData->cookie_name),
                            'settings' => $cookieData->settings,
                        ];

                        if (!empty($cookieData->opt_in_js) || !empty($cookieData->opt_out_js) || !empty($cookieData->fallback_js)) {
                            $cookies[$cookieGroupData->group_id][$cookieData->cookie_id] = [
                                'optInJS' => base64_encode(do_shortcode($cookieData->opt_in_js)),
                                'optOutJS' => base64_encode(do_shortcode($cookieData->opt_out_js)),
                            ];

                            $fallbackCode[$cookieGroupData->group_id][$cookieData->cookie_id] = do_shortcode($cookieData->fallback_js);
                        }
                    }
                }
            }
        }

        $jsConfig = apply_filters('borlabsCookie/settings', $jsConfig);

        wp_localize_script('borlabs-cookie', 'borlabsCookieConfig', $jsConfig);
        wp_localize_script('borlabs-cookie', 'borlabsCookieCookies', $cookies);

        $jsCode = 'jQuery(document).ready(function() {';
        $jsCode .= "\n".$this->getContentBlockerScriptsData()."\n";
        $jsCode .= '(function () { ';
        $jsCode .= 'var borlabsCookieLoaded = null;';
        $jsCode .= 'var borlabsCookieInit = false;';
        $jsCode .= 'var borlabsCookieCheck = function () { if (typeof window.BorlabsCookie === "object" && borlabsCookieInit === false) { borlabsCookieInit = true; clearInterval(borlabsCookieLoaded); window.BorlabsCookie.init(borlabsCookieConfig, borlabsCookieCookies, borlabsCookieContentBlocker); } };';
        $jsCode .= 'borlabsCookieLoaded = setInterval(borlabsCookieCheck, 50); ';
        $jsCode .= 'borlabsCookieCheck();';
        $jsCode .= '})();';
        $jsCode .= '});';

        wp_add_inline_script('borlabs-cookie', $jsCode, 'after');

        // Fallback code is always executed
        if (!empty($fallbackCode)) {
            foreach ($fallbackCode as $groupData) {
                foreach ($groupData as $cookieFallbackCode) {
                    echo $cookieFallbackCode;
                }
            }
        }
    }
}
