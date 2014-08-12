<?php

Class Shortcodes {

    public function __construct() {

        /**
         * register your shortcodes here
         **/
        add_shortcode('faq',  array($this, 'faqShortcode'));

    }


    public function faqShortcode($atts, $content = null) {

        $completeContent = '<span class="link js_jobs_faq_openPopup">' . $content . '</span><div class="job__info--faq--popup--wrapper"><div class="job__info--faq--popup"><div class="job__info--faq--popup--title">' . $atts['title'] . '</div><div class="closingX js_jobs_faq_closePopup"></div><div class="job__info--faq--popup--text">' . $atts['content'] . '</div> </div></div>';



        return $completeContent;

    }

}

$shortcodes = new Shortcodes(); ?>
