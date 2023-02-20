<?php
include_once '../_libs/initial.php';
?>

<table class="manage-list manage-content-categories-list">
<caption>
	<input type="text" id="categoryname" name="category_name" />
	<button type="button" id="btnAddCategory" data-cgroup="<?=$_POST['cgroup']?>"><h4>분류 추가</h4></button>
</caption>
<tbody></tbody>
</table>

<script type="text/javascript">
$(function() {
	Category.load('<?=$_POST['cgroup']?>');	
	$(".manage-content-categories-list > tbody").sortable({
		placeholder: "ui-state-highlight",
		update: Category.sorting
	});
});
</script>