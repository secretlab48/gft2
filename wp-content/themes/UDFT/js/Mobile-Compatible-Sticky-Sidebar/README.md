# Sticky Sidebar for jQuery

A jQuery plugin to make your sidebar sticky, following you seamlessly down the page as you scroll.

Demo: http://jquery-sticky-sidebar.s3-website-ap-southeast-2.amazonaws.com/demo/

## Why use jQuery Sticky Sidebar?

* Dimensions are calculated only when needed
* If the browser window resizes, re-calulating the necessary dimensions is taken care of for you
* This plugin will work for you without having "padding" and "margin" issues given you implement this plugin like the demo
* You can reload the page top, middle, or bottom and your sticky sidebar will be where it should be (duh)
* Very smooth without any lag, or jumping
* Easy to install and setup
* Zero dependencies
* Fully supported plugin


### Installing

Download the production build of this plugin (/dist/jquery.sticky-sidebar.min.js) and include it within your site.


### Usage

The HTML markup you need to use must include a container, sidebar, inner-sidebar and content area for the plugin to work. Similar to the following:
```
<div class="container">
    <div class="sidebar">
        <div class="sidebar-inner">
            <!-- Sidebar content goes here -->
        </div>
    </div>
    <div class="content">
        <!-- Page content goes here -->
    </div>
</div>
```

Once your HTML markup is structured like above, you can use this plugin with the following jQuery:
```
$('.sidebar').stickySidebar({
    container: '.container',
    sidebarInner: '.sidebar-inner'
});
```


## Options

| Option  | Type | Default | Description |
| --- | --- | --- | --- |
| container | string | null | This field is required and must be the selector of your container. Example: '.my-container'
| sidebarInner | string | null | This field is required and must be the selector of your inner sidebar. Example: '.my-sidebar-inner' |
| side | string | 'left' | This is set to 'left' by default, if your sidebar is on the right of the page, set this to 'right' |
| topSpacing | boolean | 30 | Spacing between top of screen and the sidebar when sticky |
| disableAt | boolean | 785 | Disable the sticky sidebar at a certain screen width |
| callback | function | | This callback function fires everytime the sidebar becomes sticky |


## Contributing

Contributions are welcome. When contributing to this repository, please first discuss the change you wish to make by creating an issue.


## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.