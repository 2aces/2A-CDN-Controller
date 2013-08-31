<?php
/*
Plugin Name: 2Ace's CDN77 Controller
Plugin URI: http://www.2aces.com.br/wordpress/cnd-77-controler/
Description: A simple plugin to control CDN77 cache and help to show your web optimizations to the world
Version: 0.1.1.5
Author: 2Aces - Conte&uacute;do e Estrat&eacute;gia
Author URI: http://www.2aces.com.br
License: PL2
*/
// Add Plugin Text Domain
function aa_cdn77_controller_textdomain() {
    load_plugin_textdomain( 'aa-cdn77-controller', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_filter( 'wp_loaded', 'aa_cdn77_controller_textdomain' );

// Add Plugin Menu
add_action( 'admin_menu', 'aa_cdn77_controller_menu' );
function aa_cdn77_controller_menu() {
    add_options_page( __('CDN77 Controller Options','aa-cdn77-controller'), __('CDN77 Controller','aa-cdn77-controller'), 'manage_options', 'aa-cdn77-controller', 'aa_cdn77_controller_options' );
}

// Clean options on Plugin Uninstall
function aa_cdn77_controller_on_deactivate() {
    if ( !current_user_can( 'activate_plugins' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.','aa-cdn77-controller') );
    }
    $options = get_option('myplugin_used_option');

    if ( true === $options['do_uninstall'] ) {
        delete_option('myplugin_used_option');
    }
}
register_deactivation_hook(__FILE__, 'aa_cdn77_controller_on_deactivate');

// Create Settings and Plugin Page
function aa_cdn77_controller_options() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.','aa-cdn77-controller') );
    }
    //include ( plugin_dir_path( __FILE__ ) . 'includes/aa-cdn77-controller-admin.php');

    // variables for the field and option names 
    $aa_cdn77_controller_id = 'e.g. 0987654';
    $aa_cdn77_controller_login = 'e.g. youremail@example.com';
    $aa_cdn77_controller_pwd = '';
    $aa_cdn77_controller_hidden = 'aa_cdn77_controller_hidden';

    // Read in existing option value from database
    $aa_cdn77_controller_id = get_option( 'aa_cdn77_controller_id' );
    $aa_cdn77_controller_login = get_option( 'aa_cdn77_controller_login' );
    $aa_cdn77_controller_pwd = get_option( 'aa_cdn77_controller_pwd' );

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( isset($_POST[ $aa_cdn77_controller_hidden ]) && $_POST[ $aa_cdn77_controller_hidden ] == 'Y' ) {
        // Read their posted value
        $aa_cdn77_controller_id = $_POST[ 'aa_cdn77_controller_id' ];
        $aa_cdn77_controller_login = $_POST[ 'aa_cdn77_controller_login' ];
        $aa_cdn77_controller_pwd = $_POST[ 'aa_cdn77_controller_pwd' ];

        // Save the posted value in the database
        update_option( 'aa_cdn77_controller_id', $aa_cdn77_controller_id );
        update_option( 'aa_cdn77_controller_login', $aa_cdn77_controller_login );
        update_option( 'aa_cdn77_controller_pwd', $aa_cdn77_controller_pwd );

        // Put an settings updated message on the screen
        echo '<div class="updated"><p><em>' . __('Settings Updated','aa-cdn77-controller') . '</em></p></div>';
    }
    if ($_GET["aa-message"] == 'purgedall') {
        echo '<div class="updated"><p><em>' . __('Your CDN purge was initiated. It may take a few minutes to complete.','aa-cdn77-controller') . '</em></p></div>';
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
<div class="wrap aa-plugin aa-cdn77-controller">
    <h2><?php echo __('2Aces CDN77 Controller','aa-cdn77-controller'); ?></h2>
    <p><?php echo __('Just a simple plugin to purge the files on your CDN77\'s resource.','aa-cdn77-controller'); ?></p>
    <li><?php echo __('Insert you CDN resource settings in the fields below and hit the save button.','aa-cdn77-controller'); ?></li>
    <li><?php echo __('After the set up, hit the Purge All button whenever you REALLY need to flush all your CDN cache.','aa-cdn77-controller'); ?><br />
        <?php echo __('<em>(e.g. when your change all your blog image sizes, theme or when you are using W3TC Generic Mirror feature with a CDN77 CDN)</em>','aa-cdn77-controller'); ?></p>
    <div class="metabox-holder">
        <div class="postbox" id="aa-cdn77-controller-controls">
            <div class="handlediv" title="Click to toggle"><br></div>
            <h3 class="hndle"><?php echo __('CDN77 Controls','aa-cdn77-controller'); ?></h3>
            <div class="inside">
                <form action="<?php echo plugin_dir_url( __FILE__ ) . 'includes/aa-cdn77-controller-functions.php';  ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $aa_cdn77_controller_id; ?>"/>
                    <input type="hidden" name="login" value="<?php echo $aa_cdn77_controller_login; ?>"/>
                    <input type="hidden" name="passwd" value="<?php echo $aa_cdn77_controller_pwd; ?>"/>
                    <input type="submit" class="button-primary" id="aa-cdn77-cdn-purge-all" value="<?php echo __('Purge All','aa-cdn77-controller'); ?>" />
                </form>
            </div>
        </div>
        <div class="postbox" id="aa-cdn77-controller-cdn">
            <div class="handlediv" title="Click to toggle"><br></div>
            <h3 class="hndle"><?php echo __('Your CDN Settings','aa-cdn77-controller'); ?></h3>
            <div class="inside">
                <form action="" method="post">
                    <input type="hidden" name="aa_cdn77_controller_hidden" value="Y"/>
                    <div class="span4">
                        <label for="aa-cdn77-controller-cdn-id"><?php echo __('CDN ID','aa-cdn77-controller'); ?></label><br />
                        <input type="text" name="aa_cdn77_controller_id" id="aa-cdn77-controller-cdn-id" value="<?php echo $aa_cdn77_controller_id; ?>" />
                    </div>
                    <div class="span4">
                        <label for="aa-cdn77-controller-cdn-login"><?php echo __('Your Login','aa-cdn77-controller'); ?></label><br />
                        <input type="text" name="aa_cdn77_controller_login" id="aa-cdn77-controller-cdn-login" value="<?php echo $aa_cdn77_controller_login; ?>" />
                    </div>
                    <div class="span4">
                        <label for="aa-cdn77-controller-cdn-pwd"><?php echo __('API Password','aa-cdn77-controller'); ?></label><br />
                        <input type="password" name="aa_cdn77_controller_pwd" id="aa-cdn77-controller-cdn-pwd" value="<?php echo $aa_cdn77_controller_pwd; ?>" />
                    </div>
                    <div class="clear">
                        <br>
                        <input type="submit" class="button-primary" id="aa-cdn77-controller-cdn-submit" value="<?php echo __('Update Settings','aa-cdn77-controller'); ?>" />
                        <br>
                    </div>
                </form>
                <hr>
                <p><?php echo __('You can find your ID, login and API password information on CDN77\'s API Help Page','aa-cdn77-controller'); ?> (<a href="https://client.cdn77.com/help/purge-all" title="CDN77's API FAQ" rel="nofollow">https://client.cdn77.com/help/purge-all</a>)</p>
                <p><?php echo __('In that page, you need to click on &quot;<em>List of CDN IDs</em>&quot; and on &quot;<em>Show API password</em>&quot;','aa-cdn77-controller'); ?></p>
                <img src="<?php echo plugin_dir_url( __FILE__ ) . 'img/cdn77-api-purge-all.jpg';  ?>" alt="CDN77's API Help Page - Purge All" title="CDN77's API Help Page - Purge All" />
            </div>
        </div>
        <div class="row notice" id="aa-cdn77-controller-cdn">
            <h3><?php echo __('Thanks and Important notes','aa-cdn77-controller'); ?></h3>
            <p><?php echo __('Thanks for using this plugin!','aa-cdn77-controller'); ?></p>
            <p><?php echo __('We would like to make some important notes:','aa-cdn77-controller'); ?></p>
            <p><?php echo __('<strong>This is an experimental plugin</strong> and depends on third parties services. <strong>It&quot;s free to use, <em>as is</em></strong> and this means that you we do not provide specific support, although we try to do our best on Wordpress Community Support Forum, and <strong>we are not responsible for any damage to your site</strong>','aa-cdn77-controller'); ?></p>
            <p><?php echo __('Yet, if it&quots being useful to you, considerate telling the world about it. Just publish a post, a tweet or status update pointing to','aa-cdn77-controller'); ?> <a href="http://www.2aces.com.br/wordpress/cnd-77-controler/">www.2aces.com.br/wordpress/cnd-77-controler/</a></p>
            <p><?php echo __('By the way, 2Aces is a brazilian digital content and strategy company and we provide <em>Inbound Marketing</em> and <strong>optimization</strong> services. You can learn more about us on','aa-cdn77-controller'); ?> <a href="http://www.2aces.com.br/">www.2aces.com.br</a></p>  
        </div>
    </div>
</div>
<?php
}
?>