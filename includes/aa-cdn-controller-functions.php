<?php
/**
 * CDN77 Controller Functions
 *
 * @author      2Aces Conte&uacute;do e Estrat&eacute;gia
 * @package     CDN77 Controller
 * @version     0.1.0
 */

if(isset($_POST['id']))     $id   = $_POST['id'];
if(isset($_POST['login']))   $login   = $_POST['login'];
if(isset($_POST['passwd']))   $passwd= $_POST['passwd'];
$url = 'https://client.cdn77.com/api/purge-all';

/* gets the data from a URL */
    $ch = curl_init( $url );
    $timeout = 5;
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "id=$id&login=$login&passwd=$passwd");
    $data = curl_exec($ch);
    curl_close($ch);
    $data = json_decode( $data );
    if ($data->{'status'}) {
      header("Location:http://www.2aces.com.br/wp-admin/options-general.php?page=aa-cdn77-controller&message=purgedall");
    }
    else {
        var_dump($data); 
    }
    //;
?>