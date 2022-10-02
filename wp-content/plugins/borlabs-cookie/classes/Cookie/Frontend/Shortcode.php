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
use BorlabsCookie\Cookie\Tools;

class Shortcode
{
    private static $instance;

    private $wrapperStart = '';
    private $wrapperEnd = '';

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function __construct()
    {
        if (Config::getInstance()->get('cookieBoxIntegration') === 'javascript') {
            $this->wrapperStart = '<script type="text/template">';
            $this->wrapperEnd = '</script>';
        }
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    /**
     * handleShortcode function.
     *
     * @access public
     * @param mixed $atts
     * @param mixed $content (default: null)
     * @return void
     */
    public function handleShortcode($atts, $content = null)
    {
        if (!empty($atts['type'])) {
            if ($atts['type'] === "cookie-group") {
                $content = $this->handleTypeCookieGroup($atts, $content);
            } elseif ($atts['type'] === "cookie") {
                $content = $this->handleTypeCookie($atts, $content);
            } elseif ($atts['type'] === "content-blocker") {
                $content = $this->handleTypeContentBlocker($atts, $content);
            } elseif ($atts['type'] === "consent-history") {
                $content = $this->handleTypeConsentHistory($atts, $content);
            } elseif ($atts['type'] === "uid") {
                $content = $this->handleTypeUID($atts, $content);
            } elseif ($atts['type'] === "btn-cookie-preference") {
                $content = $this->handleTypeBtnCookiePreference($atts, $content);
            } elseif ($atts['type'] === "btn-switch-consent") {
                $content = $this->handleTypeBtnSwitchConsent($atts, $content);
            } elseif ($atts['type'] === "cookie-list") {
                $content = $this->handleTypeCookieList($atts, $content);
            }
        }

        if (function_exists('is_feed') && is_feed() && Config::getInstance()->get('removeIframesInFeeds') == true) {
               $content = '';
        }

        if (Config::getInstance()->get('testEnvironment') === true) {
            $content .= "<span style=\"display: block !important;background:#fff;color:#f00;text-align: center;\">"._x('Borlabs Cookie - Test Environment active!', 'Frontend / Global / Alert Message', 'borlabs-cookie')."</span>";
        }

        return $content;
    }

    /**
     * handleTypeBtnCookiePreference function.
     *
     * @access public
     * @param mixed $atts
     * @param mixed $content
     * @return void
     */
    public function handleTypeBtnCookiePreference($atts, $content)
    {
        $title = _x('Open Cookie Preference', 'Frontend / Cookie Box / Button Title', 'borlabs-cookie');

        if (!empty($atts['title'])) {
            $title = $atts['title'];
        }

        if (!empty($atts['element']) && $atts['element'] === 'link') {
            $content = '<a href="#" class="borlabs-cookie-preference">'.$title.'</a>';
        } else {
            $content = '<a href="#" class="_brlbs-btn-cookie-preference borlabs-cookie-preference">'.$title.'</a>';
        }

        return $content;
    }

    /**
     * handleTypeBtnSwitchConsent function.
     *
     * @access public
     * @param mixed $atts
     * @param mixed $content
     * @return void
     */
    public function handleTypeBtnSwitchConsent($atts, $content)
    {
        if (!empty($atts['id'])) {

            $cookieData = Cookies::getInstance()->getCookieData($atts['id']);

            if (!empty($cookieData)) {

                $title = $cookieData->name;

                if (!empty($atts['title'])) {
                    $title = sprintf($atts['title'], $title);
                }

                $cookieBoxPreferenceTextSwitchStatusActive      = esc_html(Config::getInstance()->get('cookieBoxPreferenceTextSwitchStatusActive'));
                $cookieBoxPreferenceTextSwitchStatusInactive    = esc_html(Config::getInstance()->get('cookieBoxPreferenceTextSwitchStatusInactive'));

                $content = '<div class="BorlabsCookie _brlbs-switch-consent">';
                $content .= '<label class="_brlbs-btn-switch"><input type="checkbox" data-cookie-group="'.esc_attr($cookieData->group_id).'" name="borlabsCookie['.esc_attr($cookieData->group_id).'][]" value="'.esc_attr($atts['id']).'" data-borlabs-cookie-switch><span class="_brlbs-slider"></span></label>';
                $content .= '<span class="_brlbs-btn-switch-status"><span>'.$cookieBoxPreferenceTextSwitchStatusActive.'</span><span>'.$cookieBoxPreferenceTextSwitchStatusInactive.'</span></span>';
                $content .= '<span class="_brlbs-title">'.esc_html($title).'</span>';
                $content .= '</div>';
            }
        }

        return $content;
    }

    /**
     * handleTypeCookie function.
     *
     * @access public
     * @param mixed $atts
     * @param mixed $content
     * @return void
     */
    public function handleTypeCookie($atts, $content)
    {
        $content = '<div class="borlabs-hide" data-borlabs-cookie-type="' . $atts['type'] . '" data-borlabs-cookie-id="' . $atts['id'] . '">' . $this->wrapperStart . base64_encode(do_shortcode($content)) . $this->wrapperEnd . '</div>';

        return $content;
    }

    /**
     * handleTypeCookieGroup function.
     *
     * @access public
     * @param mixed $atts
     * @param mixed $content
     * @return void
     */
    public function handleTypeCookieGroup($atts, $content)
    {
        $content = '<div class="borlabs-hide" data-borlabs-cookie-type="' . $atts['type'] . '" data-borlabs-cookie-id="' . $atts['id'] . '">' . $this->wrapperStart . base64_encode(do_shortcode($content)) . $this->wrapperEnd . '</div>';

        return $content;
    }

    /**
     * handleTypeCookieList function.
     *
     * @access public
     * @param mixed $atts
     * @param mixed $content
     * @return void
     */
    public function handleTypeCookieList($atts, $content)
    {
        $allCookies = Cookies::getInstance()->getAllCookieGroups();

        if (!empty($allCookies)) {

            $content = '<div class="BorlabsCookie">';

            foreach ($allCookies as $cookieGroupData) {

                $content .= "<h3 class=\"_brlbs _brlbs-cg-".esc_attr($cookieGroupData->group_id)."\">".esc_html($cookieGroupData->name)."</h3>";
                $content .= "<p class=\"_brlbs _brlbs-cg-".esc_attr($cookieGroupData->group_id)."\">".esc_html($cookieGroupData->description)."</p>";

                if (!empty($cookieGroupData->cookies)) {

                    foreach ($cookieGroupData->cookies as $cookieData) {

                        $content .= "<h4 class=\"_brlbs _brlbs-c-".esc_attr($cookieData->cookie_id)."\">".esc_html($cookieData->name)."</h4>";
                        $content .= "<div class=\"_brlbs-responsive-table\"><table class=\"_brlbs _brlbs-c-".esc_attr($cookieData->cookie_id)."\">";

                        $content .= "<tr>";
                        $content .= "<th>"._x('Name', 'Frontend / Cookie List / Table Headline', 'borlabs-cookie')."</th>";
                        $content .= "<td>".esc_html($cookieData->name)."</td>";
                        $content .= "</tr>";

                        $content .= "<tr>";
                        $content .= "<th>"._x('Provider', 'Frontend / Cookie List / Table Headline', 'borlabs-cookie')."</th>";
                        $content .= "<td>".esc_html($cookieData->provider)."</td>";
                        $content .= "</tr>";

                        if (!empty($cookieData->purpose)) {
                            $content .= "<tr>";
                            $content .= "<th>"._x('Purpose', 'Frontend / Cookie List / Table Headline', 'borlabs-cookie')."</th>";
                            $content .= "<td>".esc_html($cookieData->purpose)."</td>";
                            $content .= "</tr>";
                        }

                        if (!empty($cookieData->privacy_policy_url)) {
                            $content .= "<tr>";
                            $content .= "<th>"._x('Privacy Policy', 'Frontend / Cookie List / Table Headline', 'borlabs-cookie')."</th>";
                            $content .= "<td><a href=\"".esc_url($cookieData->privacy_policy_url)."\" target=\"_blank\" rel=\"nofollow noopener noreferrer\">".esc_url($cookieData->privacy_policy_url)."</a></td>";
                            $content .= "</tr>";
                        }

                        if (!empty($cookieData->hosts)) {
                            $content .= "<tr>";
                            $content .= "<th>"._x('Host(s)', 'Frontend / Cookie List / Table Headline', 'borlabs-cookie')."</th>";
                            $content .= "<td>".implode(', ', $cookieData->hosts)."</td>";
                            $content .= "</tr>";
                        }

                        if (!empty($cookieData->cookie_name)) {
                            $content .= "<tr>";
                            $content .= "<th>"._x('Cookie Name', 'Frontend / Cookie List / Table Headline', 'borlabs-cookie')."</th>";
                            $content .= "<td>".esc_html($cookieData->cookie_name)."</td>";
                            $content .= "</tr>";
                        }

                        if (!empty($cookieData->cookie_expiry)) {
                            $content .= "<tr>";
                            $content .= "<th>"._x('Cookie Expiry', 'Frontend / Cookie List / Table Headline', 'borlabs-cookie')."</th>";
                            $content .= "<td>".esc_html($cookieData->cookie_expiry)."</td>";
                            $content .= "</tr>";
                        }

                        $content .= "</table></div>";
                    }
                }
            }

            $content .= "</div>";
        }

        return $content;
    }

    /**
     * handleTypeContentBlocker function.
     *
     * @access public
     * @param mixed $atts
     * @param mixed $content
     * @return void
     */
    public function handleTypeContentBlocker($atts, $content)
    {
        $url = '';
        $contentBlockerId = '';
        $title = '';

        if (!empty($atts['id'])) {
            $contentBlockerId = $atts['id'];
        }

        if (!empty($atts['title'])) {
            $title = $atts['title'];
        }

        // Check if blocked content is just an URL or an iframe
        if (filter_var(trim($content), FILTER_VALIDATE_URL) !== false) {
            $url = $content;
            $content = wp_oembed_get($content);
        } else {
            $content = do_shortcode($content);

            // Try to detect iframe
            $iframeMatch = [];

            preg_match('/<iframe.*<\/iframe>/i', $content, $iframeMatch);

            if (!empty($iframeMatch[0])) {
                // Detect host

                $srcMatch = [];

                preg_match('/src=("|\')([^"\']{1,})(\1)/i', $iframeMatch[0], $srcMatch);

                if (!empty($srcMatch[2]) && $srcMatch[2] !== 'about:blank') {
                    $url = $srcMatch[2];
                }
            }
        }

        $content = ContentBlocker::getInstance()->handleContentBlocking($content, $url, $contentBlockerId, $title);

        return $content;
    }

    /**
     * handleTypeConsentHistory function.
     *
     * @access public
     * @param mixed $atts
     * @param mixed $content
     * @return void
     */
    public function handleTypeConsentHistory($atts, $content)
    {
        $content = '<div class="BorlabsCookie" data-borlabs-cookie-consent-history><div class="_brlbs-responsive-table"><table class="_brlbs-table"><thead><tr><th class="_brlbs-table-date">'._x('Date', 'Frontend / Consent History / Table Headline', 'borlabs-cookie').'</th><th class="_brlbs-table-version">'._x('Version', 'Frontend / Consent History / Table Headline', 'borlabs-cookie').'</th><th class="_brlbs-table-consents">'._x('Consents', 'Frontend / Consent History / Table Headline', 'borlabs-cookie').'</th></tr></thead></table></div></div>';

        return $content;
    }

    /**
     * handleTypeUID function.
     *
     * @access public
     * @param mixed $atts
     * @param mixed $content
     * @return void
     */
    public function handleTypeUID($atts, $content)
    {
        $content = '<span data-borlabs-cookie-uid></span>';

        return $content;
    }
}