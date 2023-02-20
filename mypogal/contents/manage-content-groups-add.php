<?php
include_once '../_libs/initial.php';
?>

<h1>콘텐츠 그룹 추가</h1>

<form id="fAddGroup">
	<dl>
		<dt>그룹명</dt>
		<dd><input type="text" id="groupname" name="groupname" class="required" title="그룹명을 입력하세요." /></dd>
		<dt>설명</dt>
		<dd><textarea rows="3" cols="60" id="groupsummary" name="groupsummary"></textarea>
	</dl>
</form>