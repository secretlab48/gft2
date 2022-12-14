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

namespace BorlabsCookie\Cookie;

class Upgrade
{

    private static $instance;

    private $versionUpgrades = [
        'upgradeVersion_2_0_2' => '2.0.2',
        'upgradeVersion_2_0_3' => '2.0.3',
        'upgradeVersion_2_0_4' => '2.0.4',
        'upgradeVersion_2_0_5' => '2.0.5',
        'upgradeVersion_2_0_6' => '2.0.6',
        'upgradeVersion_2_1_0' => '2.1.0',
        'upgradeVersion_2_1_1' => '2.1.1',
        'upgradeVersion_2_1_1_1' => '2.1.1.1',
        'upgradeVersion_2_1_2' => '2.1.2',
        'upgradeVersion_2_1_3' => '2.1.3',
        'upgradeVersion_2_1_4' => '2.1.4',
        'upgradeVersion_2_1_5' => '2.1.5',
        'upgradeVersion_2_1_6' => '2.1.6',
        'upgradeVersion_2_1_7' => '2.1.7',
        'upgradeVersion_2_1_8' => '2.1.8',
        'upgradeVersion_2_1_9' => '2.1.9',
        'upgradeVersion_2_1_10' => '2.1.10',
        'upgradeVersion_2_1_10_1' => '2.1.10_1',
        'upgradeVersion_2_1_11' => '2.1.11',
        'upgradeVersion_2_1_12' => '2.1.12',
        'upgradeVersion_2_1_13' => '2.1.13',
        'upgradeVersion_2_1_14' => '2.1.14',
        'upgradeVersion_2_1_15' => '2.1.15',
    ];

    private $currentBlogId = '';

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

    public function __construct()
    {
    }

    /**
     * getVersionUpgrades function.
     *
     * @access public
     * @return void
     */
    public function getVersionUpgrades()
    {
        return $this->versionUpgrades;
    }

    public function upgradeVersion_2_0_2()
    {
        update_option('BorlabsCookieVersion', '2.0.2', 'no');
    }

    public function upgradeVersion_2_0_3()
    {
        update_option('BorlabsCookieVersion', '2.0.3', 'no');
    }

    public function upgradeVersion_2_0_4()
    {
        update_option('BorlabsCookieVersion', '2.0.4', 'no');
    }

    public function upgradeVersion_2_0_5()
    {
        update_option('BorlabsCookieVersion', '2.0.5', 'no');
    }

    public function upgradeVersion_2_0_6()
    {
        update_option('BorlabsCookieVersion', '2.0.6', 'no');
    }

    public function upgradeVersion_2_1_0()
    {
        global $wpdb;

        // Update tables
        $tableNameCookies = $wpdb->prefix.'borlabs_cookie_cookies';
        $tableNameCookieGroups = $wpdb->prefix.'borlabs_cookie_groups'; // ->prefix contains base_prefix + blog id
        $tableNameContentBlocker = $wpdb->prefix.'borlabs_cookie_content_blocker'; // ->prefix contains base_prefix + blog id

        $wpdb->query("ALTER TABLE ".$tableNameCookies." MODIFY `language` varchar(16);");
        $wpdb->query("ALTER TABLE ".$tableNameCookieGroups." MODIFY `language` varchar(16);");
        $wpdb->query("ALTER TABLE ".$tableNameContentBlocker." MODIFY `language` varchar(16);");

        // Add new table
        $charsetCollate = $wpdb->get_charset_collate();
        $tableNameScriptBlocker = $wpdb->prefix.'borlabs_cookie_script_blocker'; // ->prefix contains base_prefix + blog id

        $sqlCreateTableScriptBlocker = \BorlabsCookie\Cookie\Install::getInstance()->getCreateTableStatementScriptBlocker($tableNameScriptBlocker, $charsetCollate);

        $wpdb->query($sqlCreateTableScriptBlocker);

        // Add user capabilities
        \BorlabsCookie\Cookie\Install::getInstance()->addUserCapabilities();

        update_option('BorlabsCookieVersion', '2.1.0', 'no');
    }

    public function upgradeVersion_2_1_1()
    {
        update_option('BorlabsCookieVersion', '2.1.1', 'no');
    }

    public function upgradeVersion_2_1_1_1()
    {
        update_option('BorlabsCookieVersion', '2.1.1.1', 'no');
    }

    public function upgradeVersion_2_1_2()
    {
        update_option('BorlabsCookieVersion', '2.1.2', 'no');
    }

    public function upgradeVersion_2_1_3()
    {
        update_option('BorlabsCookieVersion', '2.1.3', 'no');
    }

    public function upgradeVersion_2_1_4()
    {
        update_option('BorlabsCookieVersion', '2.1.4', 'no');
    }

    public function upgradeVersion_2_1_5()
    {
        update_option('BorlabsCookieVersion', '2.1.5', 'no');
    }

    public function upgradeVersion_2_1_6()
    {
        update_option('BorlabsCookieVersion', '2.1.6', 'no');
    }

    public function upgradeVersion_2_1_7()
    {
        update_option('BorlabsCookieVersion', '2.1.7', 'no');
    }

    public function upgradeVersion_2_1_8()
    {
        // Update Multilanguage
        $languageCodes = [];

        // Polylang
        if (defined('POLYLANG_VERSION')) {

            $polylangLanguages = get_terms('language', ['hide_empty' => false]);

            if (!empty($polylangLanguages)) {
                foreach ($polylangLanguages as $languageData) {
                    if (!empty($languageData->slug) && is_string($languageData->slug)) {
                        $languageCodes[$languageData->slug] = $languageData->slug;
                    }
                }
            }
        }

        // WPML
        if (defined('ICL_LANGUAGE_CODE')) {

            $wpmlLanguages = apply_filters('wpml_active_languages', null, []);

            if (!empty($wpmlLanguages)) {
                foreach ($wpmlLanguages as $languageData) {
                    if (!empty($languageData['code'])) {
                        $languageCodes[$languageData['code']] = $languageData['code'];
                    }
                }
            }
        }

        if (!empty($languageCodes)) {

            foreach ($languageCodes as $languageCode) {
                // Load config
                \BorlabsCookie\Cookie\Config::getInstance()->loadConfig($languageCode);

                // Save CSS
                \BorlabsCookie\Cookie\Backend\CSS::getInstance()->save($languageCode);

                // Update style version
                $styleVersion = get_option('BorlabsCookieStyleVersion_' . $languageCode, 1);
                $styleVersion = intval($styleVersion) + 1;

                update_option('BorlabsCookieStyleVersion_' . $languageCode, $styleVersion, false);
            }
        } else {
            // Load config
            \BorlabsCookie\Cookie\Config::getInstance()->loadConfig();

            // Save CSS
            \BorlabsCookie\Cookie\Backend\CSS::getInstance()->save();
        }

        update_option('BorlabsCookieVersion', '2.1.8', 'no');
    }

    public function upgradeVersion_2_1_9()
    {
        global $wpdb;

        $charsetCollate = $wpdb->get_charset_collate();
        $tableNameScriptBlocker = $wpdb->prefix.'borlabs_cookie_script_blocker'; // ->prefix contains base_prefix + blog id

        // Check if Script Blocker table is wrong schema
        $columnStatus = \BorlabsCookie\Cookie\Install::getInstance()->checkIfColumnExists($tableNameScriptBlocker, 'content_blocker_id');

        if ($columnStatus === true) {

            // Fix Script Blocker Table
            $wpdb->query('DROP TABLE IF EXISTS `'.$tableNameScriptBlocker.'`');

            $sqlCreateTableScriptBlocker = \BorlabsCookie\Cookie\Install::getInstance()->getCreateTableStatementScriptBlocker($tableNameScriptBlocker, $charsetCollate);

            $wpdb->query($sqlCreateTableScriptBlocker);
        }

        update_option('BorlabsCookieVersion', '2.1.9', 'no');
    }

    public function upgradeVersion_2_1_10()
    {
        update_option('BorlabsCookieVersion', '2.1.10', 'no');
    }

    public function upgradeVersion_2_1_10_1()
    {
        update_option('BorlabsCookieVersion', '2.1.10.1', 'no');
    }

    public function upgradeVersion_2_1_11()
    {
        update_option('BorlabsCookieVersion', '2.1.11', 'no');
    }

    public function upgradeVersion_2_1_12()
    {
        update_option('BorlabsCookieVersion', '2.1.12', 'no');
    }

    public function upgradeVersion_2_1_13()
    {
        global $wpdb;

        // Change cookie log table
        $tableName = $wpdb->prefix.'borlabs_cookie_consent_log';

        // Check if key exists
        $checkOldKey = $wpdb->query("
            SHOW
                INDEXES
            FROM
                `".$tableName."`
            WHERE
                `Key_name` = 'is_latest'
        ");

        if ($checkOldKey) {

            // Remove key
            $wpdb->query("
                ALTER TABLE
                    `".$tableName."`
                DROP INDEX
                    `is_latest`
            ");
        }

        // Add new key
        $checkNewKey = $wpdb->query("
            SHOW
                INDEXES
            FROM
                `".$tableName."`
            WHERE
                `Key_name` = 'uid'
        ");

        if (!$checkNewKey) {

            // Add key
            $wpdb->query("
                ALTER TABLE
                    `".$tableName."`
                ADD KEY
                    `uid` (`uid`, `is_latest`)
            ");
        }

        // Change column of cookie_expiry
        $tableNameCookies = $wpdb->prefix.'borlabs_cookie_cookies';

        $wpdb->query("
            ALTER TABLE
                ".$tableNameCookies."
            MODIFY
                `cookie_expiry` varchar(255) NOT NULL DEFAULT ''
        ");

        update_option('BorlabsCookieVersion', '2.1.13', 'no');
    }

    public function upgradeVersion_2_1_14()
    {
        update_option('BorlabsCookieVersion', '2.1.14', 'no');
    }

    public function upgradeVersion_2_1_15()
    {
        update_option('BorlabsCookieVersion', '2.1.15', 'no');
    }
}
