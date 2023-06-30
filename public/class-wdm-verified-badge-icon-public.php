<?php
if(!class_exists('WDM_Verified_Badge_Icon_Public')){
    class WDM_Verified_Badge_Icon_Public{
        /**
         * defines plugin directory url of the plugin
         *
         * @var [String]
         */
        protected $plugin_dir_url;
        /**
         * defines class variables
         *
         * @param [String] $plugin_dir_url
         */
        public function __construct($plugin_dir_url){
            $this->$plugin_dir_url = $plugin_dir_url;
        }
    }
}