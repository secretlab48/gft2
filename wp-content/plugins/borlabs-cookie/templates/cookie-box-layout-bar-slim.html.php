<div id="BorlabsCookieBox" class="BorlabsCookie">
    <div class="<?php echo $cookieBoxPosition; ?>" style="display: none;">
        <div class="_brlbs-bar-wrap">
            <div class="_brlbs-bar _brlbs-bar-slim">
                <div class="cookie-box">
                    <div class="container">
                        <div class="row align-items-center">
                            <?php
                            if ($cookieBoxShowLogo) {
                            ?>
                                <div class="col-2 col-sm-1 text-center _brlbs-no-padding-right">
                                    <img class="cookie-logo" src="<?php echo $cookieBoxLogo; ?>" srcset="<?php echo implode(', ', $cookieBoxLogoSrcSet); ?>" alt="<?php echo esc_attr($cookieBoxTextHeadline); ?>">
                                </div>
                            <?php
                            }
                            ?>
                            <div class="<?php echo $cookieBoxShowLogo ? 'col-10 col-sm-8' : 'col-12 col-sm-9' ?>">
                                <p><?php echo $cookieBoxTextDescription; ?></p>
                                <p class="_brlbs-actions">
                                <span class="_brlbs-manage"><a class="cursor" data-cookie-individual><?php echo $cookieBoxTextManageLink; ?></a></span><?php
                                if ($cookieBoxHideRefuseOption === false) {
                                    ?><span class="_brlbs-refuse"><span class="_brlbs-separator"></span><a class="cursor" data-cookie-refuse><?php echo $cookieBoxTextRefuseLink; ?></a></span><?php
                                }
                                ?></span>
                                </p>
                            </div>
                            <div class="col-12 col-sm-3">
                                <p class="_brlbs-actions-mobile">
                                <span class="_brlbs-manage"><a class="cursor" data-cookie-individual><?php echo $cookieBoxTextManageLink; ?></a></span><?php
                                if ($cookieBoxHideRefuseOption === false) {
                                    ?><span class="_brlbs-refuse"><span class="_brlbs-separator"></span><a class="cursor" data-cookie-refuse><?php echo $cookieBoxTextRefuseLink; ?></a></span><?php
                                }
                                ?></span>
                                </p>
                                <p class="_brlbs-accept"><a class="_brlbs-btn<?php echo $cookieBoxShowAcceptAllButton ? ' _brlbs-btn-accept-all' : ''; ?> cursor" data-cookie-accept><?php echo $cookieBoxTextAcceptButton; ?></a></p>
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