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
        public function __construct($plugin_dir_path){
            $this->plugin_dir_path = $plugin_dir_path;
        }
        /**
         * enqueue styles to frontend
         *
         * @return void
         */
        public function wdm_enqueue_styles() {
            wp_enqueue_style( 'font-css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css',array(), time(), 'all');
        }
        /**
         * adds verification badge to the comment author in both frontend and admin area
         *
         * @param [String] $display_name
         * @param [Integer] $comment_id
         * @return void
         */
        public function wdm_add_verification_bagdge_to_comments_authors($display_name, $comment_id) {
            $query = new WP_Query(array(
                'post_type' => 'wc_user_membership',
                'post_status' => 'wcm-active',
                'post_parent' => 62
            ));
            $users = array();
            while($query->have_posts()){
                $query->the_post();
                $author = get_the_author();
                array_push($users,$author);
            }
            
            wp_reset_query();
            if(in_array($display_name,$users)){
                $result = sprintf('%s <i title="%s" class="fa-solid fa-user"></i>',
                    $display_name,
                    __('This is a Verified Author', 'wdm-gsm')
                );
                return $result;
            }
            return $display_name;
        }
        /**
         * overrides the woocommerce my account dashboard page with it's own template
         *
         * @param [String] $template
         * @param [String] $template_name
         * @param [String] $template_path
         * @return void
         */
        public function wdm_override_woocommerce_template( $template, $template_name, $template_path ) {
            if ( $template_name === 'myaccount/dashboard.php' ) {
                $template = $this->plugin_dir_path . 'templates/dashboard.php';
            }
            return $template;
        }
        /**
         * add verified icon to forum comment authors
         *
         * @param [Array] $author_links
         * @param [Array] $r
         * @param [Array] $args
         * @return void
         */
        public function wdm_bb_comment_author_badge($author_links, $r, $args){
            if(isset($author_links[1])){
                $query = new WP_Query(array(
                    'post_type' => 'wc_user_membership',
                    'post_status' => 'wcm-active',
                    'post_parent' => 62
                ));
                $users = array();
                while($query->have_posts()){
                    $query->the_post();
                    $author = get_the_author();
                    array_push($this->users,$author);
                }
                
                wp_reset_query();
                $start = strpos($author_links[1],'>')+1;
                $end = strpos($author_links[1],'</',$start);
                $length = $end - $start;
                $name = trim(substr($author_links[1],$start, $length));
                if(in_array($name, $users)){
                    $new_name = sprintf('%s <i title="%s" class="fa-solid fa-user"></i>',
                        $name,
                        __('This is a Verified Author', 'wdm-gsm')
                    );
                    $author_links[1] = substr_replace($author_links[1],$new_name, $start, $length);
                }
            }
            return $author_links;
        }
    }
}