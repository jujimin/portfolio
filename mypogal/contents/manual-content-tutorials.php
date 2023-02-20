<?php
include_once '../_libs/initial.php';
?>

<h1>사용 및 활용 강의</h1>

<table class="manage-list manual-tutorials-list">
<caption>
</caption>
<tbody>

</tbody>
</table>

<script type="text/javascript">
$(function() {
	$.getJSON("http://api.cydemy.com/mypogal/index.php", { gettype : "tutorials" }, function(responseJSON) {
		var html, readed;
		if (responseJSON.data.length) {
				for(var i = 0; i < responseJSON.data.length; i++) {
					readed = responseJSON.data[i].readed != undefined ? responseJSON.data[i].readed + "(읽음)" : "";
					
					html += '<tr>';
					html += '<td class="manual-tutorials-list-no">' + responseJSON.data[i].no + '</td>';
					html += '<td class="manual-tutorials-list-title"><a href="' + responseJSON.data[i].url + '" target="_blank"><h4>' + responseJSON.data[i].title + '</h4></a></td>';
					html += '<td class="manual-tutorials-list-rdate">' + responseJSON.data[i].rdate + '</td>';
					html += '<td class="manual-tutorials-list-readed">' + readed + '</td>';
					html += '</tr>';
				}
		} else {
			html += '<tr><td><h3>아직 준비된 강의가 없습니다.</h3></td></tr>';
		}

		$(".manual-tutorials-list > tbody").append(html);
	}).fail(Common.onAjaxFail);;
	
});
</script>