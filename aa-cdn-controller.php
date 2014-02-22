<?php
/*
Plugin Name: 2Ace's CDN77 Controller
Plugin URI: http://www.2aces.com.br/wordpress/cnd-77-controler/
Description: A simple plugin to control CDN resources. The first release supports CDN77, with other CDN providers support coming soon.
Version: 0.1.3.11
Author: 2Aces - Conte&uacute;do e Estrat&eacute;gia
Author URI: http://www.2aces.com.br
License: GPL2
*/
/**
 * CDN77 Controller Plugin
 *
 * @author      2Aces Conte&uacute;do e Estrat&eacute;gia
 * @package     2Aces CDN Controller
 * @version     0.1.1.9
 */
// Add Plugin Text Domain
function aa_cdnc_textdomain() {
    load_plugin_textdomain( 'aa-cdnc', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_filter( 'wp_loaded', 'aa_cdnc_textdomain' );

// Add Plugin Menu
add_action( 'admin_menu', 'aa_cdnc_menu' );
function aa_cdnc_menu() {
    add_options_page( __('CDN77 Controller Options','aa-cdnc'), __('CDN77 Controller','aa-cdnc'), 'manage_options', 'aa-cdnc', 'aa_cdnc_options' );
}

// Create Settings and Plugin Page
function aa_cdnc_options() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.','aa-cdnc') );
    }
    //include ( plugin_dir_path( __FILE__ ) . 'includes/aa-cdn-controller-admin.php');

    // variables for the field and option names 
    $aa_cdnc_cdn77_id = '';
    $aa_cdnc_cdn77_login = '';
    $aa_cdnc_cdn77_pwd = '';

    // Read in existing option value from database
    $aa_cdnc_cdn77_id = get_option( 'aa_cdnc_cdn77_id' );
    $aa_cdnc_cdn77_login = get_option( 'aa_cdnc_cdn77_login' );
    $aa_cdnc_cdn77_pwd = get_option( 'aa_cdnc_cdn77_pwd' );

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( isset($_POST[ $aa_cdnc_hidden ]) && $_POST[ $aa_cdnc_hidden ] == 'Y' ) {
        // Read their posted value
        $aa_cdnc__cdn77id = $_POST[ 'aa_cdnc_cdn77_id' ];
        $aa_cdnc__cdn77_login = $_POST[ 'aa_cdnc_cdn77_login' ];
        $aa_cdnc__cdn77pwd = $_POST[ 'aa_cdnc_cdn77_pwd' ];

        // Save the posted value in the database
        update_option( 'aa_cdnc_cdn77_id', $aa_cdnc_cdn77_id );
        update_option( 'aa_cdnc_cdn77_login', $aa_cdnc_cdn77_login );
        update_option( 'aa_cdnc_cdn77_pwd', $aa_cdnc_cdn77_pwd );

        // Put an settings updated message on the screen
        echo '<div class="updated"><p><em>' . __('Settings Updated','aa-cdnc') . '</em></p></div>';
    }
    if ($_GET["message"] == 'purgedall') {
        echo '<div class="updated"><p><em>' . __('Your CDN purge was initiated. It may take a few minutes to complete.','aa-cdnc') . '</em></p></div>';
    }
?>
<style>
.row {
    margin:10px 2.5%;
    width:95%
}
.span4 {
    float:left;
    margin:0 1.5% 0 0;
    width:30%;
}
.postbox .hndle {
cursor: auto;
}
</style>
<div class="wrap aa-plugin aa-cdnc">
    <h2><?php echo __('2Ace\'s CDN Controller','aa-cdnc'); ?></h2>
    <p><?php echo __('Just a simple plugin to purge the files on your CDN resource. Initially, it supports only CDN77 but more CDN providers will be supported soon. Stay tuned to <a href="http://www.2aces.com.br/wordpress/cnd-77-controler/">plugin home</a> on our blog.','aa-cdnc'); ?></p>
    <p><?php echo __('After the set up, hit the <em>Purge All</em> button when you REALLY need to flush all your CDN cache.','aa-cdnc'); ?><br />
        <?php echo __('<em>(e.g. when your change all your blog image sizes, theme or when you are using W3TC Generic Mirror feature with a CDN77 CDN)</em>','aa-cdnc'); ?></p>
    <div class="metabox-holder">
        <div class="postbox" id="aa-cdnc-controls">
            <div class="handlediv" title="Click to toggle"><br></div>
            <h3 class="hndle"><?php echo __('CDN77 Controls','aa-cdnc'); ?></h3>
            <div class="inside">
                <form action="<?php echo plugin_dir_url( __FILE__ ) . 'includes/aa-cdn-controller-functions.php';  ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $aa_cdnc_cdn77_id; ?>"/>
                    <input type="hidden" name="login" value="<?php echo $aa_cdnc_cdn77_login; ?>"/>
                    <input type="hidden" name="passwd" value="<?php echo $aa_cdnc_cdn77_pwd; ?>"/>
                    <input type="submit" class="button-primary" id="aa-cdn77-cdn-purge-all" value="<?php echo __('Purge All','aa-cdnc'); ?>" />
                </form>
            </div>
        </div>
        <div class="postbox" id="aa-cdnc-settings">
            <div class="handlediv" title="Click to toggle"><br></div>
            <h3 class="hndle"><?php echo __('Your CDN Settings','aa-cdnc'); ?></h3>
    <p><?php echo __('Insert you CDN resource settings in the fields below and hit the <em>Update Settings<em> button.','aa-cdnc'); ?></p>
            <div class="inside">
                <form action="" method="post">
                    <input type="hidden" name="aa_cdnc_hidden" value="Y"/>
                    <div class="span4">
                        <label for="aa-cdnc-cdn77-id"><?php echo __('CDN77 Resource ID','aa-cdnc'); ?></label><br />
                        <input type="text" name="aa_cdnc_cdn77_id" id="aa-cdnc-cdn77-id" value="<?php echo $aa_cdnc_cdn77_id; ?>" />
                    </div>
                    <div class="span4">
                        <label for="aa-cdnc-cdn77-login"><?php echo __('Your CDN77\'s Login','aa-cdnc'); ?></label><br />
                        <input type="text" name="aa_cdnc_cdn77_login" id="aa-cdnc-cdn77-login" value="<?php echo $aa_cdnc_cdn77_login; ?>" />
                    </div>
                    <div class="span4">
                        <label for="aa-cdnc-cdn77-pwd"><?php echo __('Your CDN77\'s API Password','aa-cdnc'); ?></label><br />
                        <input type="password" name="aa_cdnc_cdn77_pwd" id="aa-cdnc-cdn77-pwd" value="<?php echo $aa_cdnc_cdn77_pwd; ?>" />
                    </div>
                    <div class="clear">
                        <br>
                        <input type="submit" class="button-primary" id="aa-cdnc-cdn-submit" value="<?php echo __('Update Settings','aa-cdnc'); ?>" />
                        <br>
                    </div>
                </form>
                <hr>
                <p><?php echo __('You can find your ID, login and API password information on CDN77\'s API Help Page','aa-cdnc'); ?> (<a href="https://client.cdn77.com/help/purge-all" title="CDN77's API FAQ" rel="nofollow">https://client.cdn77.com/help/purge-all</a>)</p>
                <p><?php echo __('In that page, you need to click on &quot;<em>List of CDN IDs</em>&quot; and on &quot;<em>Show API password</em>&quot;','aa-cdnc'); ?></p>
                <img src="<?php echo plugin_dir_url( __FILE__ ) . 'img/cdn77-api-purge-all.jpg';  ?>" alt="CDN77's API Help Page - Purge All" title="CDN77's API Help Page - Purge All" />
            </div>
        </div>
        <div class="row notice" id="aa-cdnc-notice">
            <h3><?php echo __('Thanks and Important notes','aa-cdnc'); ?></h3>
            <p><?php echo __('Thanks for using this plugin!','aa-cdnc'); ?></p>
            <p><?php echo __('We would like to make some important notes:','aa-cdnc'); ?></p>
            <p><?php echo __('<strong>This is an experimental plugin</strong> and depends on third parties services. <strong>It&quot;s free to use, <em>as is</em></strong> and this means that you we do not provide specific support, although we try to do our best on Wordpress Community Support Forum, and <strong>we are not responsible for any damage to your site</strong>','aa-cdnc'); ?></p>
            <p><?php echo __('Yet, if it&quot;s being useful to you, considerate telling the world about it. Just publish a post, a tweet or status update pointing to','aa-cdnc'); ?> <a href="http://www.2aces.com.br/wordpress/2aces-cdn-controler/">www.2aces.com.br/wordpress/2aces-cdn-controler/</a></p>
            <p><?php echo __('By the way, 2Aces is a brazilian digital content and strategy company and we provide <em>Inbound Marketing</em> and <strong>optimization</strong> services. You can learn more about us on','aa-cdnc'); ?> <a href="http://www.2aces.com.br/">www.2aces.com.br</a></p>  
        </div>
    </div>
</div>
<?php
}
?>