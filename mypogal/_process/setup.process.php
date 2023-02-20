<?php
$oSetup = new net_irosoft_mypogal_Setup();
if ($oSetup->setup()) {
	echo 'OK';
} else {
	echo 'FAILURE';
}
?>