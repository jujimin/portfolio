<?php 
include_once '../_libs/initial.php';
?>

<div class="body-content">
	<ul class="body-board-sidebar">
		<li class="select" data-page="news"><a href="#">새로운 소식</a></li>
		<li data-page="users"><a href="#">사용자 현황</a></li>
	</ul>
	<div class="body-board-main">

	</div>
</div>

<script type="text/javascript">
$(function() {
	$(".body-board-sidebar > li[data-page='news']").trigger("click");
	$(document).one("click", ".menu-update", function() {
			$.cookie("updatecheck", "Y", { expires: 1 });
		});

	if ($.cookie("updatequery") != "Y") {
		$.getJSON("http://api.cydemy.com/mypogal/index.php", { gettype : "update" }, function(responseJSON) {
			if (responseJSON.buildnum > parseInt(_buildnum)) {
				showUpdate();
				$.cookie("updatequery", "Y");
			}
		}).fail(Common.onAjaxFail);	
	} else {
		showUpdate();
	}

	$(window).unload(function() {
		$.doTimeout("update");
	});
});

function showUpdate() {
	$(".body-board-sidebar").append('<li class="menu-update" data-page="update"><a href="#">업데이트 알림</a></li>');
	$.doTimeout("update", 3000, function() {
		if ($.cookie("updatecheck") == "Y")	return false;
		$(".menu-update > a").effect("highlight");
		if ($.cookie("updatecheck") != "Y")	return true;
	});
}
</script>

