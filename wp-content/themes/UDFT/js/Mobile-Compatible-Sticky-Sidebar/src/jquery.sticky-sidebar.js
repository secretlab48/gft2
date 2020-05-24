(($) => {
    $.fn.stickySidebar = function stickySidebar(settings) {
        // Cache the element
        const $elem = this;

        // Cache the container height
        let $containerHeight = $(settings.container).height();

        // If the element exists on page
        if ($elem.length) {
            const defaults = {
                container: '.container',
                side: 'left',
                topSpacing: 30,
                disableAt: 785,
                callback: () => {}
            };
            const options = Object.assign({}, defaults, settings);

            const applyFixed = function applyFixed(containerLeftPos, sidebarWidth, sidebarHeight) {
                // Apply fixed to sidebar
                console.log('APPLY');
                $elem.addClass('is-fixed');
                $elem.removeClass('stick-footer');

                $elem.css({
                    position: 'relative'
                });

                // On window resize get sidebar (parent) width
                if (sidebarWidth !== $elem.width()) sidebarWidth = $elem.width();

                // Apply styles to this div
                $(options.sidebarInner).css({
                    position: 'fixed',
                    top: `${options.topSpacing}px`,
                    width: sidebarWidth,
                    height: sidebarHeight,
                    display: 'inline-table'
                });

                // If the sidebar is on the right
                if (options.side === 'right') {
                    $(options.sidebarInner).css({ right: containerLeftPos, left: 'initial' });
                } else {
                    $(options.sidebarInner).css({ left: containerLeftPos });
                }

                // Fire callback
                options.callback();
            };

            const distanceCheck = function distanceCheck(resize) {
                // Distance scrolled from top of screen
                const distanceFromTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;

                // Container height
                const containerHeight = $(options.container).height();

                // Container distance from left
                const containerLeftPos = document.querySelector(options.container).offsetLeft;

                // Container distance from top
                const containerTopPos = document.querySelector(options.container).offsetTop;

                // Container bottom
                const containerBottomPos = containerHeight + containerTopPos;

                // Sidebar height & width
                const sidebarHeight = $(options.sidebarInner).outerHeight();
                const sidebarWidth = $(options.sidebarInner).outerWidth();

                // Stop position
                const stopPos = containerBottomPos - sidebarHeight;

                /**
                 * On window resize run applyFixed
                 */
                if (resize) {
                    applyFixed(containerLeftPos, sidebarWidth, sidebarHeight);
                }

                /**
                 * Scroll past
                 */
                if ((distanceFromTop + options.topSpacing) > containerTopPos && (distanceFromTop + options.topSpacing) < stopPos) {
                    if (!$elem.hasClass('is-fixed')) {
                        console.log('ADD STICK');
                        applyFixed(containerLeftPos, sidebarWidth, sidebarHeight);
                    }
                }

                /**
                 * Scrolled back to header
                 */
                if ((distanceFromTop + options.topSpacing) < containerTopPos) {
                    if ($elem.hasClass('is-fixed')) {
                        console.log('REMOVE STICK');
                        $elem.removeClass('is-fixed');
                        // Remove inline styles
                        $elem.attr('style', '');
                        $(options.sidebarInner).attr('style', '');
                    }
                }

                /**
                 * On container height resize
                 */
                if ($containerHeight === $(options.container).height()) {
                    /**
                     * Scrolled passed container
                     */
                    if ((distanceFromTop + options.topSpacing) > stopPos) {
                        if (!$elem.hasClass('stick-footer')) {
                            // Make sidebar fixed to bottom of container
                            console.log('STICK FOOTER');
                            $elem.removeClass('is-fixed');
                            $elem.addClass('stick-footer');
                            $(options.sidebarInner).css({
                                position: 'relative',
                                top: containerHeight - sidebarHeight,
                                left: 0,
                                width: '100%',
                                height: sidebarHeight
                            });
                        }
                    }
                } else {
                    /**
                     * Container height has changed, reset cached height
                     */
                    $containerHeight = $(options.container).height();

                    // Remove stick
                    $elem.removeClass('is-fixed');
                    $elem.attr('style', '');
                    $(options.sidebarInner).attr('style', '');
                }
            };

            // Trigger on scroll
            $(window).on('scroll', () => {
                if (window.innerWidth > options.disableAt) {
                    distanceCheck();
                }
            });

            // Trigger on resize
            $(window).on('resize', () => {
                if (window.innerWidth > options.disableAt) {
                    distanceCheck(true);
                } else {
                    // Remove stick
                    $elem.removeClass('is-fixed');
                    $elem.attr('style', '');
                    $(options.sidebarInner).attr('style', '');
                }
            });

            // Trigger on load
            if (window.innerWidth > options.disableAt) {
                setTimeout(() => {
                    distanceCheck();
                }, 0);
            }
        }
        return this;
    };
})(jQuery);
