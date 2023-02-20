<?php
include_once '../_libs/initial.php';
?>

<table class="manage-list manage-content-meta-list">
<caption>
	<select id="type" name="type">
		<option value="strings">문자타입</option>
		<option value="integer">숫자타입</option>
	</select>
	<input type="text" id="metaname" name="metaname" placeholder="메타(영문, 숫자조합 20자이내, 숫자 맨앞 금지, 공백없이 작성)" />
	<input type="text" id="metasummary" name="metasummary" placeholder="메타 설명(255자 이내)" />
	<button type="button" id="btnAddMeta" data-cgroup="<?=$_POST['cgroup']?>"><h4>메타 추가</h4></button>
</caption>
<tbody></tbody>
</table>

<script type="text/javascript">
$(function() {
	$("#type").selectmenu({
			width: 150
		});
	Meta.load('<?=$_POST['cgroup']?>');	
});
</script>