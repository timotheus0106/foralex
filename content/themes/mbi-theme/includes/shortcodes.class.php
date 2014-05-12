<?php
class Mbi_Shortcodes {
    function __construct() {
        /**
         * register your shortcodes here
         **/
        add_shortcode('say_hello',  array($this, 'sayHelloShortcode'));
    }

    function sayHelloShortcode($atts, $content = null) {
        return 'I am happy to say hello!';
    }
}

$MbiShortcodes = new Mbi_Shortcodes(); ?>
