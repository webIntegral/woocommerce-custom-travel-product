<?php
/**
 * Plugin Name: WooCommerce Custom Travel Product
 * Description: This plugin creates a custom product for travel products.
 * Version: 1.0.0
 * Author: Web Integral
 * Text Domain: woocommerce-custom-travel-product
 * Author URI: http://webintegral.com.co
 * License: GPL2
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A
 * PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
 * CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE
 * OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

// Disallow direct use of class
if ( !defined( 'ABSPATH' )) {
    exit;
}

// Check if class already exists
if ( ! class_exists( 'WC_Custom_Travel_Product' ) ) {
    
    /**
     * WC_Custom_Travel_Product
     */
    class WC_Custom_Travel_Product {
        
        /**
         * Plugin version
         * 
         * @var string
         * @since 1.0.0
         */
        const VERSION = '1.0.0';
        
        /**
         * Instance of this class
         *
         * @var     object
         * @since   1.0.0
         *
         */
        protected static $instance = null;
        
        /**
         * Translation handle
         *
         * @var     string
         * @since   1.0.0
         */
        public $plugin_slug = 'woocommerce-custom-travel-product';
        
        private function __construct() {
            // Load plugin text domain
            add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
            
            // Checks with WooCommerce is installed.
            if ( class_exists( 'WC_Integration' ) && defined( 'WOOCOMMERCE_VERSION' ) && version_compare( WOOCOMMERCE_VERSION, '2.1-beta-1', '>=' ) ) {
                // require_once( plugin_dir_path( __FILE__ ) . 'class-web-integral-turistica.php' );
                // require_once( plugin_dir_path(__FILE__) . 'includes/class-wit-custom-product.php' );
                // require_once( plugin_dir_path(__FILE__) . 'includes/class-wit-conversion-form.php' );
                // require_once( plugin_dir_path(__FILE__) . 'includes/class-wit-email-template.php' );
                
            } else {
                add_action( 'admin_notices', array( $this, 'woocommerce_missing_notice' ) );
            }
        } //__construct
        
        /**
         * Return an instance of this class
         *
         * @return  object      A single instance of this class
         * @since   0.0.1
         * @version 0.0.1
         *
         */
        public static function get_instance() {
        
            // If the single instance hasn't been set, set it now.
            if ( null == self::$instance) {
                self::$instance = new self;
            }
        
            return self::$instance;
        }
        
        /**
         * Load the plugin text domain for translation.
         *
         * @return void
         * @since   1.0.0
         * @version 1.0.0
         * 
         */
        public function load_plugin_textdomain() {
    		$locale = apply_filters( 'plugin_locale', get_locale(), $this->plugin_slug );
    		load_textdomain( $this->plugin_slug, trailingslashit( WP_LANG_DIR ) . $this->plugin_slug . '/' . $this->plugin_slug . '-' . $locale . '.mo' );
    		load_plugin_textdomain( $this->plugin_slug, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
        }
        
        /**
         * WooCommerce fallback notice.
         *
         * @return string
         * @since   1.0.0
         * @version 1.0.0
         * 
         */
        public function woocommerce_missing_notice() {
            echo '<div class="error"><p>' . sprintf( __( 'WooCommerce Custom Travel Product depends on the last version of %s to work!', $this->plugin_slug ), '<a href="http://www.woothemes.com/woocommerce/" target="_blank">WooCommerce</a>' ) . '</p></div>';
        }
        
    } //class
    
    // Init Plugin
    add_action( 'plugins_loaded', array( 'WC_Custom_Travel_Product', 'get_instance' ), 0 );
    
} //if