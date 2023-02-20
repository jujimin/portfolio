<?php
switch ($_REQUEST['act']) {
	case "login" :
		$userid = $_POST['userid'];
		$passwd = sha1($_POST['passwd']);
		
		$oSes->mysql_query(net_irosoft_mypogal_Configs::TB_MEMBERS, "no", "userid = '{$userid}'");
		if ($oSes->mysql_num_rows) {
			$oSes->mysql_query(net_irosoft_mypogal_Configs::TB_MEMBERS, "no", "userid = '{$userid}' AND passwd = '{$passwd}'");
			if ($oSes->mysql_num_rows) {
				$oSes->register($userid);
				
				echo "COMPLETION";
			} else {
				echo "INVALID_PWD";
			}
		} else {
			echo "INVALID_ID";
		}
		break;
		
	case "logout":
		$oSes->unregister();
		break;
}
?>