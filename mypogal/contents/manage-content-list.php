<?php
include_once '../_libs/initial.php';
?>

<h1>콘텐츠 목록</h1>

<table class="manage-content-list">
<caption>

</caption>
<?php 
$oContent = new net_irosoft_mypogal_Content();
$oContent->mysql_query(net_irosoft_mypogal_Content::TB_CONTENTS, "cno");
$total = $oContent->mysql_num_rows;
$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : null;
$oPage = new net_irosoft_Paging(10, $total, $page);

if ($total) {
	echo "<thead>
			<tr>
				<th>Thumb</th><th>제목</th><th>그룹</th><th>분류</th><th>작성일시</th><th>수정일시</th><th>조회수</th><th>관리</th>
			</tr>
		</thead>
		<tbody>";
	$oContent->mysql_query(net_irosoft_mypogal_Content::TB_CONTENTS, array("cno","title", "category", "cgroup", "thumbnail", "hits", "registered","updated"), "ORDER BY cno DESC LIMIT {$oPage->start}, {$oPage->scale}");
	for ($i = 0; $rec = $oContent->mysql_result(); $i++) {
		$oContent->setContentGroup($rec['cgroup']);
		$oContent->setCategory($rec['category']);
		$groupname = $oContent->getContentGroupName();
		$categoryName = $oContent->getCategoryName();
		if ($rec['thumbnail']) {
			$thumbnailurl = $oContent->getThumbnailDirUrl().'/'.$rec['thumbnail'];
			$thumbnail = "<div style=\"background: url('{$thumbnailurl}') no-repeat 50% 50%;\"></div>";
		} else {
			$thumbnailurl = "";
			$thumbnail = null;
		}
		$hits = number_format($rec['hits']);
		
		echo "<tr>
				<td class=\"manage-content-list-thumbnail\" data-thumb=\"{$thumbnailurl}\">{$thumbnail}</td>
				<td class=\"manage-content-list-title\"><h3>{$rec['title']}&nbsp;&nbsp;<span class=\"manage-content-list-title-cno\">CNO</span><span>{$rec['cno']}</span></h3></td>
				<td class=\"manage-content-list-group\">{$groupname}</td>
				<td class=\"manage-content-list-category\">{$categoryName}</td>
				<td class=\"manage-content-list-registered\">{$rec['registered']}</td>
				<td class=\"manage-content-list-registered\">{$rec['updated']}</td>
				<td class=\"manage-content-list-hits\">{$hits}</td>
				<td class=\"manage-content-list-command\">
					<button type=\"button\" class=\"btn-content-del\" data-cgroup=\"{$rec['cgroup']}\" data-cno=\"{$rec['cno']}\"><h4>삭제</h4></button>
					<button type=\"button\" class=\"btn-content-edit\" data-mode=\"edit\" data-cgroup=\"{$rec['cgroup']}\" data-cno=\"{$rec['cno']}\" data-title=\"{$rec['title']}\"><h4>수정</h4></button>
				</td>
			</tr>";
	}
	echo "</tbody>";
	echo "<tfoot><tr><td colspan=\"8\">".$oPage->generation('Content.loadList')."</td></tr></tfoot>";
} else {
	echo '<tbody><tr><td class="manage-content-empty"><h2>등록된 콘텐츠가 없습니다.</h2></td></tr></tbody>';
}
?>
</table>


<script type="text/javascript">
$(function() {
	$(".manage-content-list-thumbnail").tooltip({
			items: "[data-thumb]",
			content: function() {
				var $el = $(this);
				var thumbUrl = $el.attr("data-thumb");
				if (thumbUrl) {
					return '<img src="' + thumbUrl + '" />';
				} else {
					return '<h4>셈네일이 없습니다.</h4>';
				}
			},
			position: {
				my: "left top", at: "right+10"
			},
			tooltipClass : "custom-tooltip"
		});
});
</script>