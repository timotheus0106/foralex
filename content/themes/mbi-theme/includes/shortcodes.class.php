<?php

Class Shortcodes {

    public function __construct() {

        /**
         * register your shortcodes here
         **/
        add_shortcode('say_hello',  array($this, 'sayHelloShortcode'));

    }

    public function sayHelloShortcode($atts, $content = null) {
        return 'I am happy to say hello!';
    }

}

$MbiShortcodes = new Mbi_Shortcodes(); ?>
