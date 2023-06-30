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
         * defines plugin name
         *
         * @param [type] $plugin_name
         */
        public function __construct($plugin_name,){
            $this->plugin_name = $plugin_name;
        }
        /**
         * requires and always check for the woocommerce plugin
         *
         * @return void
         */
        public function wdm_has_dependencies() {
            if ( is_admin() && current_user_can( 'activate_plugins' ) &&  !is_plugin_active( 'woocommerce-memberships/woocommerce-memberships.php') ) {
                add_action( 'admin_notices',array( $this, 'wdm_admin_notice' ), 10, 0);

                deactivate_plugins( $this->plugin_name ); 

                if ( isset( $_GET['activate'] ) ) {
                    unset( $_GET['activate'] );
                }
            }
        }
        public function wdm_admin_notice(){
            ?><div class="error"><p><?php _e( 'Sorry, but WDM WooCommerce Membership Verified Badges Plugin requires the WooCommerce Memberships to be installed and active.' ); ?></p></div><?php
        }
    }
}