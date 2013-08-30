<?php
/*
Plugin Name: CDN77 Controller
Plugin URI: http://www.2aces.com.br/wordpress/cnd-77-controler/
Description: A single plugin to control CDN77 cache
Version: 0.1.0.1
Author: 2Aces - Conte&uacute;do e Estrat&eacute;gia
Author URI: http://www.2aces.com.br
License: PL2
*/
/*function aa_cdn77_controller_install(){
    add_settings_field( 'aa-cdn77-controller-cdn-id', 'CDN ID', $callback, $page, $section = 'default', $args = array() );
}
register_activation_hook(__FILE__,'aa_cdn77_controller_install');*/

add_action( 'admin_menu', 'aa_cdn77_controller_menu' );

/** Step 1. */
function aa_cdn77_controller_menu() {
    add_options_page( 'CDN77 Controller Options', 'CDN77 Controller', 'manage_options', 'aa-cdn77-controller', 'aa_cdn77_controller_options' );
}

function aa_cdn77_controller_options() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
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
        echo '<div class="updated"><p><strong>Settings Updated</strong></p></div>';
    }
?>
<style>
.row {
    margin:10px 5%;
    width:90%
}
.span3 {
    margin:2.5%;
    width:20%;
}
</style>
<div class="wrap aa-plugin aa-cdn77-controller">
    <img src="<?php echo plugin_dir_url( __FILE__ ) . 'img/2aces-logo.png';  ?>" alt="2Aces Conte&uacute;do e Estrat&eacute;gia" title="2Aces Conte&uacute;do e Estrat&eacute;gia" />
    <h2>CDN77 Controller 1</h2>
    <h4>Created by Celso Bessa for 2Aces - Conte&uacute;do e Estrat&eacute;gia</h4>
    <p>Just a simple plugin to purge the files on your CDN77's resource. Insert you CDN resource settings in the fields below and hit the save button.</p>
    <p>After the set up, hit the Purge All button whenever you REALLY need to flush all your CDN cache. e.g. when your change all your blog image sizes, theme or when you're using W3TC Generic Mirror feature with a CDN77 CDN.</p>
    <div class="row" id="aa-cdn77-controller-controls">
        <form action="https://client.cdn77.com/api/purge-all" method="post">
            <input type="hidden" name="id" value="<?php echo $aa_cdn77_controller_id; ?>"/>
            <input type="hidden" name="login" value="<?php echo $aa_cdn77_controller_login; ?>"/>
            <input type="hidden" name="passwd" value="<?php echo $aa_cdn77_controller_pwd; ?>"/>
            <input type="submit" class="button-primary" id="aa-cdn77-cdn-purge-all" value="Purge All" />
        </form>
    </div>
    <div class="row" id="aa-cdn77-controller-cdn">
        <h4>Your CDN Settings</h4>
        <form action="" method="post">
            <input type="hidden" name="aa_cdn77_controller_hidden" value="Y"/>
            <div class="span3">
                <label for="aa-cdn77-controller-cdn-id">CDN ID</label><br />
                <input type="text" name="aa_cdn77_controller_id" id="aa-cdn77-controller-cdn-id" value="<?php echo $aa_cdn77_controller_id; ?>" />
            </div>
            <div class="span3">
                <label for="aa-cdn77-controller-cdn-login">Login</label><br />
                <input type="text" name="aa_cdn77_controller_login" id="aa-cdn77-controller-cdn-login" value="<?php echo $aa_cdn77_controller_login; ?>" />
            </div>
            <div class="span3">
                <label for="aa-cdn77-controller-cdn-pwd">API Password</label><br />
                <input type="password" name="aa_cdn77_controller_pwd" id="aa-cdn77-controller-cdn-pwd" value="<?php echo $aa_cdn77_controller_pwd; ?>" />
            </div>
            <div class="span3">
                <input type="submit" class="button-primary" id="aa-cdn77-controller-cdn-submit" value="Update Settings" />&nbsp;<a href="https://client.cdn77.com/help/purge-all" title="CDN77's API FAQ" rel="nofollow">find your settings</a>
            </div>
        </form>
    </div>
    <p>You can find your ID, login and API password information on <a href="https://client.cdn77.com/help/purge-all" title="CDN77's API FAQ" rel="nofollow">https://client.cdn77.com/help/purge-all</a></p>
    <p>You need to click on &quot;<em>List of CDN IDs</em>&quot; and on &quot;<em>Show API password</em>&quot;</p>
    <img src="<?php include ( plugin_dir_path( __FILE__ ) . 'img/cdn77-api-purge-all.png');  ?>" alt="CDN77's API Help Page - Purge All" title="CDN77's API Help Page - Purge All" />
    <div class="row notice" id="aa-cdn77-controller-cdn">
        <p>If this plugin is useful to you, considerate telling the world about it. Just publish a post, a tweet or status update pointing to <a href="http://www.2aces.com.br/wordpress/cnd-77-controler/">www.2aces.com.br/wordpress/cnd-77-controler/</a></p>  
    </div>
</div>

<?php
}
?>
<?php
/*function aa_cdn77_controller_scripts(){
    wp_register_script('aa_cdn77_controller_script',plugin_dir_url( __FILE__ ).'js/super-plugin.js');
    wp_enqueue_script('aa_cdn77_controller_script');
}
add_action('wp_enqueue_scripts','aa_cdn77_controller_scripts')*/
?>