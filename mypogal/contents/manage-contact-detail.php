<?php
include_once '../_libs/initial.php';

$oContactOutput = new net_irosoft_mypogal_contact_Output($_POST['no']);
?>

<dl class="detail-contact-fields">
	<dt>고객명</dt>
	<dd><?=$oContactOutput->writer?></dd>
	<dt>작성일시</dt>
	<dd><?=$oContactOutput->registered?></dd>
	<dt>확인일시</dt>
	<dd><?=$oContactOutput->confirmed?></dd>
	<dt>전화번호</dt>
	<dd><?=$oContactOutput->phonenumber?></dd>
	<dt>이메일</dt>
	<dd><?=$oContactOutput->email?></dd>
	<dt>문의 내용</dt>
	<dd><?=$oContactOutput->content?></dd>
</dl>