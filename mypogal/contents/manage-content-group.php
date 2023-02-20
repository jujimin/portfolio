<?php 
include_once '../_libs/initial.php';

?>	
<h1>콘텐츠 그룹을 선택하세요.</h1>

<?php if (net_irosoft_mypogal_content_Group::existContentGroup()) { ?>
<p>	
	<select id="cgroup" name="cgroup">
		<option>콘텐츠 그룹을 선택</option>
	<?php 
	$oContentGroup = new net_irosoft_mypogal_content_Group();
	$oContentGroup->mysql_query(net_irosoft_mypogal_Content::TB_CONTENT_GROUPS, "cgroup");
	
	if ($oContentGroup->mysql_num_rows) {
		$oContentGroup->mysql_query(net_irosoft_mypogal_Content::TB_CONTENT_GROUPS, null, "ORDER BY cgroup DESC");
		while ($rec = $oContentGroup->mysql_result()) {
			echo "<option value=\"{$rec['cgroup']}\">{$rec['name']}</option>";
		}
	}		
	?>
	</select>
</p>
<p>
	<button type="button" id="btnAddPost" data-mode="add"><h3>선택 그룹에서 콘텐츠 작성하기</h3></button>
</p>
<?php } else { ?>
<h2>콘텐츠 그룹을 먼저 생성하셔야 합니다.</h2>
<?php } ?>

<script type="text/javascript">
var addContentGroup;
$("#cgroup").selectmenu({
	width: 300,
	change: function(event, ui) {
		addContentGroup = ui.item.value;
		//console.log("cgroup:" + cgroup);
	}
});
</script>