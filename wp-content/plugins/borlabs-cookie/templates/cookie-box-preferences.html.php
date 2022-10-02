<div class="cookie-preference">
    <div class="container not-visible">
        <div class="row no-gutters">
            <div class="col-12">
                <div class="row no-gutters align-items-top">
                    <?php
                    if ($cookieBoxShowLogo) {
                    ?>
                    <div class="col-2">
                        <img class="cookie-logo" src="<?php echo $cookieBoxLogo; ?>" srcset="<?php echo implode(', ', $cookieBoxLogoSrcSet); ?>" alt="<?php echo esc_attr($cookieBoxPreferenceTextHeadline); ?>">
                    </div>
                    <?php
                    }
                    ?>
                    <div class="<?php echo $cookieBoxShowLogo ? 'col-10' : 'col-12'; ?>">
                        <h3><?php echo $cookieBoxPreferenceTextHeadline; ?></h3>
                        <p><?php echo $cookieBoxPreferenceTextDescription; ?></p>

                        <div class="row no-gutters align-items-center">
                            <div class="col-12 col-sm-7">
                                <p class="_brlbs-accept">
                                <?php
                                if ($cookieBoxShowAcceptAllButton) {
                                ?>
                                <a class="_brlbs-btn _brlbs-btn-accept-all cursor" data-cookie-accept-all><?php echo $cookieBoxPreferenceTextAcceptAllButton; ?></a>
                                <?php
                                }
                                ?>
                                <a class="_brlbs-btn cursor" data-cookie-accept><?php echo $cookieBoxPreferenceTextSaveButton; ?></a></p>
                            </div>
                            <div class="col-12 col-sm-5">
                                <p class="_brlbs-refuse">
                                    <a class="cursor" data-cookie-back><?php echo $cookieBoxPreferenceTextBackLink; ?></a><?php
                                    if ($cookieBoxHideRefuseOption === false) {
                                        ?><span class="_brlbs-separator"></span><a class="cursor" data-cookie-refuse><?php echo $cookieBoxPreferenceTextRefuseLink; ?></a><?php
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-cookie-accordion>
                <?php
                if (!empty($cookieGroups)) {
                    foreach ($cookieGroups as $groupData) {

                        if (!empty($groupData->cookies)) {
                    ?>
                    <div class="bcac-item">
                        <div class="d-flex flex-row">
                            <div class="w-75">
                                <h4><?php echo esc_html($groupData->name); ?> (<?php echo count($groupData->cookies); ?>)</h4>
                            </div>
                            <div class="w-25 text-right">
                                <?php
                                if ($groupData->group_id !== 'essential') {
                                ?>
                                <span class="_brlbs-btn-switch-status"><span><?php echo $cookieBoxPreferenceTextSwitchStatusActive; ?></span><span><?php echo $cookieBoxPreferenceTextSwitchStatusInactive; ?></span></span>
                                <label for="borlabs-cookie-group-<?php echo $groupData->group_id; ?>" class="_brlbs-btn-switch">
                                    <input id="borlabs-cookie-group-<?php echo $groupData->group_id; ?>" type="checkbox" name="cookieGroup[]" value="<?php echo $groupData->group_id; ?>"<?php echo !empty($groupData->pre_selected) ? ' checked' : ''; ?> data-borlabs-cookie-switch>
                                    <span class="_brlbs-slider"></span>
                                </label>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="d-block">
                            <p><?php echo $groupData->description; ?></p>
                            <p class="text-center">
                                <a class="cursor d-block" data-cookie-accordion-target="<?php echo $groupData->group_id; ?>">
                                    <span data-cookie-accordion-status="show"><?php echo $cookieBoxPreferenceTextShowCookieLink; ?></span>
                                    <span data-cookie-accordion-status="hide" class="borlabs-hide"><?php echo $cookieBoxPreferenceTextHideCookieLink; ?></span>
                                </a>
                            </p>
                        </div>

                        <div class="borlabs-hide" data-cookie-accordion-parent="<?php echo $groupData->group_id; ?>">
                            <?php
                            foreach ($groupData->cookies as $cookieData) {
                            ?>
                            <table>
                                <?php
                                if ($groupData->group_id !== 'essential') {
                                ?>
                                <tr>
                                    <th><?php _ex('Accept', 'Frontend / Cookie Box / Table Headline', 'borlabs-cookie'); ?></th>
                                    <td>
                                        <label for="borlabs-cookie-<?php echo $cookieData->cookie_id; ?>" class="_brlbs-btn-switch">
                                            <input id="borlabs-cookie-<?php echo $cookieData->cookie_id; ?>" type="checkbox" data-cookie-group="<?php echo $groupData->group_id; ?>" name="cookies[<?php echo $groupData->group_id; ?>][]" value="<?php echo $cookieData->cookie_id; ?>"<?php echo !empty($groupData->pre_selected) ? ' checked' : ''; ?> data-borlabs-cookie-switch>
                                            <span class="_brlbs-slider"></span>
                                        </label>
                                        <span class="_brlbs-btn-switch-status"><span><?php echo $cookieBoxPreferenceTextSwitchStatusActive; ?></span><span><?php echo $cookieBoxPreferenceTextSwitchStatusInactive; ?></span></span>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <th><?php _ex('Name', 'Frontend / Cookie Box / Table Headline', 'borlabs-cookie'); ?></th>
                                    <td><?php echo esc_html($cookieData->name); ?></td>
                                </tr>
                                <tr>
                                    <th><?php _ex('Provider', 'Frontend / Cookie Box / Table Headline', 'borlabs-cookie'); ?></th>
                                    <td><?php echo esc_html($cookieData->provider); ?></td>
                                </tr>
                                <?php if (!empty($cookieData->purpose)) { ?>
                                <tr>
                                    <th><?php _ex('Purpose', 'Frontend / Cookie Box / Table Headline', 'borlabs-cookie'); ?></th>
                                    <td><?php echo $cookieData->purpose; ?></td>
                                </tr>
                                <?php } ?>
                                <?php if (!empty($cookieData->privacy_policy_url)) { ?>
                                <tr>
                                    <th><?php _ex('Privacy Policy', 'Frontend / Cookie Box / Table Headline', 'borlabs-cookie'); ?></th>
                                    <td class="_brlbs-pp-url"><a href="<?php echo esc_url($cookieData->privacy_policy_url); ?>" target="_blank" rel="nofollow noopener noreferrer"><?php echo esc_url($cookieData->privacy_policy_url); ?></a></td>
                                </tr>
                                <?php } ?>
                                <?php if (!empty($cookieData->hosts)) { ?>
                                <tr>
                                    <th><?php _ex('Host(s)', 'Frontend / Cookie Box / Table Headline', 'borlabs-cookie'); ?></th>
                                    <td><?php echo implode(', ', $cookieData->hosts); ?></td>
                                </tr>
                                <?php } ?>
                                <?php if (!empty($cookieData->cookie_name)) { ?>
                                <tr>
                                    <th><?php _ex('Cookie Name', 'Frontend / Cookie Box / Table Headline', 'borlabs-cookie'); ?></th>
                                    <td><?php echo esc_html($cookieData->cookie_name); ?></td>
                                </tr>
                                <?php } ?>
                                <?php if (!empty($cookieData->cookie_expiry)) { ?>
                                <tr>
                                    <th><?php _ex('Cookie Expiry', 'Frontend / Cookie Box / Table Headline', 'borlabs-cookie'); ?></th>
                                    <td><?php echo esc_html($cookieData->cookie_expiry); ?></td>
                                </tr>
                                <?php } ?>
                            </table>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                        }
                    }
                }
                ?>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="_brlbs-branding flex-fill">
                        <?php
                        if ($supportBorlabsCookie) {
                        ?><a href="<?php echo esc_attr_x('https://borlabs.io/borlabs-cookie/', 'Frontend / Global / URL', 'borlabs-cookie'); ?>" target="_blank" rel="nofollow noopener noreferrer"><img src="<?php echo $supportBorlabsCookieLogo; ?>" alt="Borlabs Cookie"> <?php _ex('powered by Borlabs Cookie', 'Frontend / Global / Text', 'borlabs-cookie'); ?></a><?php
                        }
                        ?>
                    </p>
                    <p class="_brlbs-legal flex-fill"><?php
                    if (!empty($cookieBoxPrivacyLink)) {
                    ?><a href="<?php echo $cookieBoxPrivacyLink; ?>"><?php echo $cookieBoxTextPrivacyLink; ?></a><?php
                    }

                    if (!empty($cookieBoxPrivacyLink) && !empty($cookieBoxImprintLink)) {
                        ?><span class="_brlbs-separator"></span><?php
                    }

                    if (!empty($cookieBoxImprintLink)) {
                    ?><a href="<?php echo $cookieBoxImprintLink; ?>"><?php echo $cookieBoxTextImprintLink; ?></a><?php
                    }
                    ?></p>
                </div>
            </div>
        </div>
    </div>
</div>