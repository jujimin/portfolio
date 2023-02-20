<?php
$oContent = new net_irosoft_mypogal_Content();
$oContent->mysql_query(net_irosoft_mypogal_Content::TB_CONTENT_CATEGORIES, array("category", "name"), "WHERE cgroup = {$_GET['cgroup']} ORDER BY orderno ASC");

$array = array();
if ($oContent->mysql_num_rows) {
	while ($rec = $oContent->mysql_result()) {
		array_push($array, array('category' => $rec['category'],'name' => $rec['name']));
	}
} 
echo json_encode($array);
?>