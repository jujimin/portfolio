<?php
$oContent = new net_irosoft_mypogal_Content();
$oContent->mysql_query(net_irosoft_mypogal_Content::TB_CONTENT_META, array("meta", "type","summary"), "cgroup = {$_GET['cgroup']}");


if (!empty($_GET['cno']) && !empty($_GET['cgroup'])) {
	$oContentOutput = new net_irosoft_mypogal_content_Output($_GET['cno'], null, $_GET['cgroup']);
} else {
	$oContentOutput = new net_irosoft_mypogal_content_Output();
}

$array = array();
if ($oContent->mysql_num_rows) {
	while ($rec = $oContent->mysql_result()) {
		$aPush = array('meta' => $rec['meta'],'type' => $rec['type'],'summary' => $rec['summary']);
		if ($oContentOutput->{$rec['meta']} != null) {
			$aPush = array_merge($aPush, array('value' => $oContentOutput->{$rec['meta']}));
		}
		array_push($array, $aPush);
	}
} 
echo json_encode($array);
?>