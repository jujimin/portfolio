<?php
/**
 * Source Version 1.0.1
 * - v1.0.1 16/08/26 Added.
 */
include_once '../_libs/initial.php';
?>

<h1>콘텐츠 그룹 관리</h1>

<table class="manage-list manage-content-groups-list">
<caption>
	<button type="button" id="btnAddGroup"><h3>그룹 추가</h3></button>
</caption>
<tbody>
<?php 
$oContent = new net_irosoft_mypogal_Content();
$oContentGroup = new net_irosoft_mypogal_content_Group();
$oContentGroup->mysql_query(net_irosoft_mypogal_Content::TB_CONTENT_GROUPS, "cgroup");

if ($oContentGroup->mysql_num_rows) {
	$oContentGroup->mysql_query(net_irosoft_mypogal_Content::TB_CONTENT_GROUPS, null, "ORDER BY cgroup DESC");
	while ($rec = $oContentGroup->mysql_result()) {
		
		$oContent->mysql_query(net_irosoft_mypogal_Content::TB_CONTENTS, "cno", "cgroup = {$rec['cgroup']}");
		$contentCount = $oContent->mysql_num_rows;
		
		$oContent->mysql_query(net_irosoft_mypogal_Content::TB_CONTENT_CATEGORIES, "category", "cgroup = {$rec['cgroup']}");
		$categoryCount = $oContent->mysql_num_rows;
		
		$oContent->mysql_query(net_irosoft_mypogal_Content::TB_CONTENT_META, "cgroup", "cgroup = {$rec['cgroup']}");
		$metaCount = $oContent->mysql_num_rows;
		
		$oContent->mysql_query(net_irosoft_mypogal_Content::TB_CONTENT_METADATA, "cno", "cgroup = {$rec['cgroup']}");
		$metadataCount = $oContent->mysql_num_rows;
		
		if (!$contentCount && !$categoryCount && !$metaCount && !$metadataCount) {
			$delBtn = "<button type=\"button\" class=\"btn-group-del\" data-cgroup=\"{$rec['cgroup']}\"><h3>삭제</h3></button>";
		} else {
			$delBtn = null;
		}
		
		
		echo "<tr>
				<th><span>CGROUP</span>{$rec['cgroup']}</th>
				<td><h3>{$rec['name']}</h3></td>
				<td>{$rec['summary']}</td>
				<td>
					<button type=\"button\" class=\"btn-open-categories\" data-cgroup=\"{$rec['cgroup']}\"><h3>분류 관리</h3></button>
					<button type=\"button\" class=\"btn-open-meta\" data-cgroup=\"{$rec['cgroup']}\"><h3>메타 데이터 필드 관리</h3></button>
					{$delBtn}
				</td>
			</tr>";
	}
} else {
	echo '<tr><td class="manage-content-empty"><h2>등록된 콘텐츠 그룹이 없습니다.</h2></td></tr>';
}
?>
</tbody>
</table>