<?php
include_once '../_libs/initial.php';
?>

<h1 id="mypogaltitle">마이포겔 사용자 현황<span></span></h1>

<table class="manage-list board-users-list">
<caption>
</caption>
<tbody>

</tbody>
</table>

<script type="text/javascript">
var no = 0;
var total;
var start = 0;
var scale = 20;
var lastScrollTop;

$(function() {
	getUsers();

	$(window).bind("scroll", function() {
		console.log($(window).scrollTop());
		console.log($(document).height());
		var scrollTop = $(window).scrollTop();
		if (scrollTop > lastScrollTop && scrollTop + $(window).height() > $(document).height() - 20) {
			getUsers();
		}
		lastScrollTop = scrollTop;
	});	
});

function getUsers() {
	$(".board-users-list > tbody").append('<tr class="board-users-list-loading"></td colspan="4"><h3>가져오는 중..</h4></td></tr>');
	
	$.getJSON("http://api.cydemy.com/mypogal/index.php", { gettype : "users", start: start, scale: scale }, function(responseJSON) {
		var html, readed;
		if (responseJSON.data.length) {
			total = responseJSON.total;
			for(var i = 0; i < responseJSON.data.length; i++) {
				no++;
				html += '<tr>';
				html += '<th class="board-news-list-no">' + no + '</th>';
				html += '<th class="board-news-list-type">' + responseJSON.data[i].type + '</th>';
				html += '<td class="board-news-list-domain board-news-list-title"><a href="http://' + responseJSON.data[i].apply_domain + '" target="_blank"><h4>' + responseJSON.data[i].apply_domain + '</h4></a></td>';
				html += '<td class="board-news-list-date board-news-list-rdate">' + responseJSON.data[i].apply_date + '</td>';
				html += '</tr>';
			}
		} else {
			html += '<tr><td><h3>현재 사용자가 없습니다.</h3></td></tr>';
		}

		$("#mypogaltitle > span").html("현재 총 " + total + "개의 웹사이트에 설치되었습니다.").css({ fontSize: "16px", color: "#ffaa00", marginLeft: "20px" });
		
		if (start < total)	$(".board-users-list > tbody").append(html);

		start += scale;

		$(".board-users-list-loading").remove();
		
	}).fail(Common.onAjaxFail);;
	
}
</script>