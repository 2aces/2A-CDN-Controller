<?php
/**
 * 2Aces CDN Controller Uninstall
 *
 * @author      2Aces Conte&uacute;do e Estrat&eacute;gia
 * @package     CDN77 Controller
 * @version     0.1.1.7
 */

if( !defined( 'ABSPATH') && !defined('WP_UNINSTALL_PLUGIN') )
    exit();

foreach ( array('aa_cdnc_cdn77_id', 'aa_cdnc_cdn77_login', 'aa_cdnc_cdn77_pwd') as $option) {
    delete_option( $option );
}

?>