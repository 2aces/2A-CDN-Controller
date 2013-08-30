<?php
/**
 * CDN77 Controller Admin page
 *
 * @author      2Aces Conte&uacute;do e Estrat&eacute;gia
 * @package     CDN77 Controller
 * @version     0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if(isset($_POST['id']))     $id   = $_POST['id'];
if(isset($_POST['login']))   $login   = $_POST['login'];
if(isset($_POST['passwd']))   $passwd= $_POST['passwd'];

/* gets the data from a URL */
function get_data('https://client.cdn77.com/api/purge-all') {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, FALSE);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "id=$id&login=$login&passwd=$passwd");
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
    //header("Location:http://www.2aces.com.br/wp-admin/options-general.php?page=aa-cdn77-controller&message=purgedall");
}
?>