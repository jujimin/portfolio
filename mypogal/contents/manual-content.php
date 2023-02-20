<?php 
include_once '../_libs/initial.php';
?>

<div class="body-content">
	<ul class="body-manual-sidebar">
		<li class="select" data-page="list"><a href="#">목록 출력</a></li>
		<li data-page="categories"><a href="#">분류 출력</a></li>
		<li data-page="detail"><a href="#">상세 출력</a></li>
		<li data-page="log"><a href="#">로그 관리</a></li>
		<li data-page="contact"><a href="#">고객 문의</a></li>
		<li data-page="tutorials"><a href="#">활용 강의</a></li>
	</ul>
	<div class="body-manual-main">

	</div>
</div>

<script type="text/javascript">
$(function() {
	$(".body-manual-sidebar > li[data-page='list']").trigger("click");
});
</script>

