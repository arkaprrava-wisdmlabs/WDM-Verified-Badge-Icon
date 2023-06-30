<?php
if(!class_exists('WDM_Verified_Badge_Icon_Public')){
    class WDM_Verified_Badge_Icon_Public{
        /**
         * defines plugin directory path of the plugin
         *
         * @var [String]
         */
        protected $plugin_dir_path;
        /**
         * defines class variables
         *
         * @param [String] $plugin_dir_path
         */
        protected $users;
        public function __construct($plugin_dir_path){
            $this->plugin_dir_path = $plugin_dir_path;
        }
        public function wdm_enqueue_styles() {
            wp_enqueue_style( 'font-css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css',array(), time(), 'all');
        }
        public function wdm_add_verification_bagdge_to_comments_authors($display_name, $order_id) {
            $query = new WP_Query(array(
                'post_type' => 'wc_user_membership',
                'post_status' => 'wcm-active',
                'post_parent' => 62
            ));
            $this->users = array();
            while($query->have_posts()){
                $query->the_post();
                $author = get_the_author();
                array_push($this->users,$author);
            }
            
            wp_reset_query();
            if(in_array($display_name,$this->users)){
                $result = sprintf('%s <i title="%s" class="fa-solid fa-user"></i>',
                    $display_name,
                    __('This is a Verified Author', 'wdm-gsm')
                );
                return $result;
            }
            return $display_name;
        }
        public function wdm_override_woocommerce_template( $template, $template_name, $template_path ) {
            if ( $template_name === 'myaccount/dashboard.php' ) {
                $template = $this->plugin_dir_path . 'templates/dashboard.php';
            }
            return $template;
        }
    }
}