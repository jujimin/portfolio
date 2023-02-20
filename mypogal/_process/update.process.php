<?php 
$oUpdate = new net_irosoft_mypogal_setup_Update();
if ($oUpdate->update()) {
	die("OK");
} else {
	die("FAILURE");
}
?>