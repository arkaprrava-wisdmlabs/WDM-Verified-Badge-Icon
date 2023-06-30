<?php
if(!class_exists('WDM_Verified_Badge_Icon_Admin')){
    class WDM_Verified_Badge_Icon_Admin{
        /**
         * defines plugin directory url of the plugin
         *
         * @var [String]
         */
        protected $plugin_name;
        /**
         * defines class variables
         *
         * @param [String] $plugin_dir_url
         */
        public function __construct($plugin_name){
            $this->$plugin_name = $plugin_name;
        }
    }
}