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

namespace BorlabsCookie\Cookie\Frontend\ContentBlocker;

use BorlabsCookie\Cookie\Frontend\ContentBlocker;

class Twitter
{
    private static $instance;

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
     * getDefault function.
     *
     * @access public
     * @return void
     */
    public function getDefault()
    {
        $data = [
            'contentBlockerId' => 'twitter',
            'name' => 'Twitter',
            'description' => '',
            'privacyPolicyURL' => _x('https://twitter.com/privacy', 'Frontend / Content Blocker / Twitter / URL', 'borlabs-cookie'),
            'hosts' => [
                'twitter.com',
                't.co',
            ],
            'previewHTML' => '<div class="_brlbs-content-blocker">
	<div class="_brlbs-embed _brlbs-twitter">
    	<img class="_brlbs-thumbnail" src="%%thumbnail%%" alt="%%name%%">
		<div class="_brlbs-caption">
			<p>' . _x("By loading the tweet, you agree to Twitter's privacy policy.", 'Frontend / Content Blocker / Twitter / Text', 'borlabs-cookie') .'<br><a href="%%privacy_policy_url%%" target="_blank" rel="nofollow noopener noreferrer">' . _x('Learn more', 'Frontend / Content Blocker / Twitter / Text', 'borlabs-cookie') . '</a></p>
			<p><a class="_brlbs-btn" href="#" data-borlabs-cookie-unblock role="button">' . _x('Load tweet', 'Frontend / Content Blocker / Twitter / Text', 'borlabs-cookie') . '</a></p>
			<p><label><input type="checkbox" name="unblockAll" value="1" checked> <small>' . _x('Always unblock Twitter Tweets', 'Frontend / Content Blocker / Twitter / Text', 'borlabs-cookie') . '</small></label></p>
		</div>
	</div>
</div>',
            'previewCSS' => '.BorlabsCookie ._brlbs-twitter {
    border: 1px solid #e1e8ed;
    border-radius: 3px;
	max-width: 516px;
}

.BorlabsCookie ._brlbs-twitter a._brlbs-btn {
	background: #1da1f2;
	border-radius: 0;
}

.BorlabsCookie ._brlbs-twitter a._brlbs-btn:hover {
	background: #fff;
	color: #1da1f2;
}
',
            'globalJS' => '',
            'initJS' => '',
            'settings' => [
                'executeGlobalCodeBeforeUnblocking' => false,
            ],
            'status' => true,
            'undeletable' => true,
        ];

        return $data;
    }

    /**
     * modify function.
     *
     * @access public
     * @param mixed $content
     * @return void
     */
    public function modify($content)
    {
        // Get settings of the Content Blocker
        $contentBlockerData = ContentBlocker::getInstance()->getContentBlockerData('twitter');

        // Default thumbnail
        $thumbnail = BORLABS_COOKIE_PLUGIN_URL . 'images/cb-twitter.png';

        // Get the title which was maybe set via title-attribute in a shortcode
        $title = ContentBlocker::getInstance()->getCurrentTitle();

        // If no title was set use the Content Blocker name as title
        if (empty($title)) {
            $title = $contentBlockerData['name'];
        }

        // Replace text variables
        $contentBlockerData['previewHTML'] = str_replace(
            [
                '%%name%%',
                '%%thumbnail%%',
                '%%privacy_policy_url%%',
            ],
            [
                $title,
                $thumbnail,
                $contentBlockerData['privacyPolicyURL'],
            ],
            $contentBlockerData['previewHTML']
        );

        return $contentBlockerData['previewHTML'];
    }
}
