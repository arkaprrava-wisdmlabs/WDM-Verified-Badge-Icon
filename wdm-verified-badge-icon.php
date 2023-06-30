<?php
/**
 * @wordpress-plugin
 * Plugin Name:       WDM WooCommerce Membership Verified Badges
 * Plugin URI:        https://github.com/arkaprrava-wisdmlabs/WDM-Verified-Badge-Icon.git
 * Description:       This is Plugin adds verified badge to the pro members 
 * Version:           1.0.0
 * Author:            Arkaprava
 * Author URI:        https://arkaprava.wisdmlabs.net/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wdm-gsm
 */
if( !class_exists('WDM_Verified_Badge_Icon')){
    class WDM_Verified_Badge_Icon{
        public function __construct(){
            $this->define_admin_hooks();
            $this->define_public_hooks();
        }
        public function define_admin_hooks(){
            require_once plugin_dir_path( __FILE__ ).'admin/class-wdm-verified-badge-icon-admin.php';
            $admin = new WDM_Verified_Badge_Icon_Admin(plugin_basename( __FILE__ ));
        }
        public function define_public_hooks(){
            require_once plugin_dir_path( __FILE__ ).'public/class-wdm-verified-badge-icon-public.php';
            $public = new WDM_Verified_Badge_Icon_Public(plugin_dir_url( __FILE__ ));
        }
    }
}
new WDM_Verified_Badge_Icon();