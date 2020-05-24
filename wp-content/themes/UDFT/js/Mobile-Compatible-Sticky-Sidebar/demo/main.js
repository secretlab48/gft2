jQuery(document).ready(function($){
    $('.sidebar').stickySidebar({
        topSpacing: 30,
        container: '.container',
        sidebarInner: '.sidebar-inner',
        callback: function() {
            console.log('Sticky sidebar fired!');
        }
    });
});