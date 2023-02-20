<?php
include_once '../_libs/initial.php';
?>

<h1 id="mypogaltitle">마이포겔 업데이트 알림<span></span></h1>
<a id="btnShowUpdate" target="_blank">업데이트 보기</a>



<script type="text/javascript">
$(function() {
	$("#btnShowUpdate").hide();
	
	$.getJSON("http://api.cydemy.com/mypogal/index.php", { gettype : "update" }, function(responseJSON) {
		if (responseJSON.buildnum > parseInt(_buildnum)) {
			$("#mypogaltitle").after('<h3>새로운 버전이 출시되었습니다.</h3>');
			$("#btnShowUpdate").attr("href", responseJSON.url).show().css({
					border: "1px solid #CCC", display: "inline-block", padding: "10px", textDecoration: "none", color: "#000"
				});
		}

	}).fail(Common.onAjaxFail);;	
});
</script>