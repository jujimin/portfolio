<?php
include_once '../_libs/initial.php';
?>

<h1>새로운 소식</h1>

<table class="manage-list board-news-list">
<caption>
</caption>
<tbody>

</tbody>
</table>

<script type="text/javascript">
$(function() {
	$.getJSON("http://api.cydemy.com/mypogal/index.php", { gettype : "news" }, function(responseJSON) {
		var html, readed;
		if (responseJSON.data.length) {
				for(var i = 0; i < responseJSON.data.length; i++) {
					readed = responseJSON.data[i].readed != undefined ? responseJSON.data[i].readed + "(읽음)" : "";
					
					html += '<tr>';
					html += '<th class="board-news-list-type">' + responseJSON.data[i].type + '</th>';
					html += '<td class="board-news-list-title"><a href="' + responseJSON.data[i].url + '" target="_blank"><h4>' + responseJSON.data[i].title + '</h4></a></td>';
					html += '<td class="board-news-list-rdate">' + responseJSON.data[i].rdate + '</td>';
					html += '<td class="board-news-list-readed">' + readed + '</td>';
					html += '</tr>';
				}
		} else {
			html += '<tr><td><h3>새로운 소식이 없습니다.</h3></td></tr>';
		}

		$(".board-news-list > tbody").append(html);
	}).fail(Common.onAjaxFail);;
	
});
</script>