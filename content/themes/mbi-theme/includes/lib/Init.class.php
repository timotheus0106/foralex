<?php

/**
 * Init
 *
 * @version 0.1.0
 */
Class Init {

    public $settings;

    public function __construct(Settings $_settings) {

        // Dependency Injection of Settings
        $this->settings = $_settings;

        // init setup on init of wordpress theme
        add_action('init', array($this, 'initialize'));

    }

    /**
     * [initialize description]
     * @param  [type] $_settings [description]
     * @return [type]            [description]
     */
    public function initialize($_settings) {

        foreach($this->settings->get_option('artdirected') as $name => $options) {

            foreach($options as $size => $option) {

                $stage = $name.'_'.$size;

                $add = Images::prepare_size($option[0], $option[1], $option[2], $stage, 'artdirected', $option[3]); // $width, $x, $y, $name, $group, $query

                Images::add_size($add);

            }

        }

        foreach($this->settings->get_option('image') as $name => $options) {

            foreach($options as $size => $option) {

                $stage = $name.'_'.$size;

                $add = Images::prepare_size($option[0], $option[1], $option[2], $stage, 'image', $option[3]); // $width, $x, $y, $name, $group, $query

                $size == 'preview' ? $retina = false : $retina = true;
                Images::add_size($add, $retina);

            }

        }

    }

    /**
     * [get_require_paths description]
     * @return [type] [description]
     */
	public static function get_require_paths() {

		$content = file_get_contents(get_template_directory_uri(). '/assets/conf/build.js');

		$json = substr($content, 15, -2);

    	$data = json_decode($json, TRUE);

    	$require = (array)$data['paths'];

    	unset($require['jquery']); // äh... geht das nicht automatisiert bitte? ;)

    	foreach($require as &$path) {

    		$path = get_template_directory_uri(). '/assets/build/js/'.$path;

    	}

		return $require;

	}

}

$init = new Init($settings);