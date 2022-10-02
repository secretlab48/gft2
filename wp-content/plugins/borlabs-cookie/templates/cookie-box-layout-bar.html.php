<div id="BorlabsCookieBox" class="BorlabsCookie">
    <div class="<?php echo $cookieBoxPosition; ?>" style="display: none;">
        <div class="_brlbs-bar-wrap">
            <div class="_brlbs-bar">
                <div class="cookie-box">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-12 col-sm-9">
                                <div class="row">
                                    <?php
                                    if ($cookieBoxShowLogo) {
                                    ?>
                                    <div class="col-2 text-center _brlbs-no-padding-right"><img class="cookie-logo" src="<?php echo $cookieBoxLogo; ?>" srcset="<?php echo implode(', ', $cookieBoxLogoSrcSet); ?>" alt="<?php echo esc_attr($cookieBoxTextHeadline); ?>"></div>
                                    <?php
                                    }
                                    ?>
                                    <div class="<?php echo $cookieBoxShowLogo ? 'col-10' : 'col-12'; ?>">
                                        <h3><?php echo $cookieBoxTextHeadline; ?></h3>
                                        <p><?php echo $cookieBoxTextDescription; ?></p>
                                    </div>
                                </div>
                                <?php
                                if (!empty($cookieGroups)) {
                                    ?><ul<?php echo $cookieBoxShowLogo ? ' class="show-cookie-logo"' : '';?>><?php
                                    foreach ($cookieGroups as $groupData) {
                                        if (!empty($groupData->hasCookies)) {
                                            ?><li<?php echo $groupData->displayCookieGroup === false ? ' class="borlabs-hide"' : ''; ?> data-borlabs-cookie-group="<?php echo $groupData->group_id; ?>"><?php echo $groupData->name; ?></li><?php
                                        }
                                    }
                                    ?></ul><?php
                                }
                                ?>
                            </div>
                            <div class="col-12 col-sm-3">
                                <p class="_brlbs-accept"><a class="_brlbs-btn<?php echo $cookieBoxShowAcceptAllButton ? ' _brlbs-btn-accept-all' : ''; ?> cursor" data-cookie-accept><?php echo $cookieBoxTextAcceptButton; ?></a></p>
                                <?php
                                if ($cookieBoxHideRefuseOption === false) {
                                    ?><p class="<?php echo $cookieBoxRefuseOptionType === 'link' ? '_brlbs-refuse' : '_brlbs-refuse-btn'; ?>"><a class="<?php echo $cookieBoxRefuseOptionType === 'button' ? '_brlbs-btn ' : ''; ?>cursor" data-cookie-refuse><?php echo $cookieBoxTextRefuseLink; ?></a></p><?php
                                }
                                ?>
                                <p class="_brlbs-manage"><a class="cursor" data-cookie-individual><?php echo $cookieBoxTextManageLink; ?></a></p>
                                <p class="_brlbs-legal">
                                    <a class="cursor" data-cookie-individual><?php echo $cookieBoxTextCookieDetailsLink; ?></a><?php
                                    if (!empty($cookieBoxPrivacyLink)) {
                                    ?><span class="_brlbs-separator"></span><a href="<?php echo $cookieBoxPrivacyLink; ?>"><?php echo $cookieBoxTextPrivacyLink; ?></a><?php
                                    }

                                    if (!empty($cookieBoxImprintLink)) {
                                    ?><span class="_brlbs-separator"></span><a href="<?php echo $cookieBoxImprintLink; ?>"><?php echo $cookieBoxTextImprintLink; ?></a><?php
                                    }
                                    ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if (!empty($cookiePreferenceTemplateFile)) {
                    include $cookiePreferenceTemplateFile;
                }
                ?>
            </div>
        </div>
    </div>
</div>