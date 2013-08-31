<?php
/**
 * 2Aces CDN Controller Uninstall
 *
 * @author      2Aces Conte&uacute;do e Estrat&eacute;gia
 * @package     CDN77 Controller
 * @version     0.1.0
 */
if(!defined(WP_UNINSTALL_PLUGIN) exit();
delete_option('aa_cdn77_controller_id');
delete_option('aa_cdn77_controller_login');
delete_option('aa_cdn77_controller_pwd');
delete_option('maa_cdn77_controller_hidden');
?>