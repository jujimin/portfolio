<?php
include_once '../_libs/initial.php';

if (!empty($_POST['mode']) && $_POST['mode'] == "edit" && !empty($_POST['cno'])) {
	$oContentOutput = new net_irosoft_mypogal_content_Output($_POST['cno'], null, $_POST['cgroup']);
} else {
	$oContentOutput = new net_irosoft_mypogal_content_Output();
}
?>
<form id="fContentRegister">
	<?php if (!empty($_POST['cgroup'])) { ?>
	<input type="hidden" id="cgroup" name="cgroup" value="<?=$_POST['cgroup']?>" />
	<?php } ?>
	<?php if (!empty($_POST['cno'])) { ?>
	<input type="hidden" id="act" name="act" value="update" />
	<input type="hidden" id="cno" name="cno" value="<?=$_POST['cno']?>" />
	<?php } else { ?>
	<input type="hidden" id="act" name="act" value="add" />
	<?php } ?>
	<dl>
		<dt>분류 설정</dt>
		<dd><select id="category" name="category"><option>분류를 선택</option></select></dd>
		<dt>콘텐츠 제목</dt>
		<dd><input type="text" id="title" name="title" class="required full" value="<?=htmlspecialchars($oContentOutput->title)?>" title="콘텐츠 제목을 입력하세요." /></dd>
		<dt>내용</dt>
		<dd><textarea id="content" name="content"><?=$oContentOutput->content?></textarea></dd>
		<dt>셈네일(가로세로의 크기가 300픽셀을 이하만 가능)</dt>
		<dd><input type="file" id="thumbnail" name="thumbnail" /></dd>
		<dd id="curthumbanil">
		<?php 
		if ($oContentOutput->thumbnail) {
			echo "<img src=\"{$oContentOutput->getThumbnailUrl()}\" />";
		}
		?>
		</dd>
	</dl>
	<dl id="metafields"></dl>
	<p class="postresult"></p>
</form>

<script type="text/javascript" src="/mypogal/_libs/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
$(function() {
	$("#category", "#fContentRegister").selectmenu({
			width: 300
		});

	<?php if (!empty($_POST['cno']) && !empty($_POST['cgroup'])) { ?>
	getCategories($("#cgroup").val(), $("#cno").val());
	getMeta($("#cgroup").val(), $("#cno").val());
	<?php } else { ?>
	getCategories($("#cgroup").val());
	getMeta($("#cgroup").val());
	<?php } ?>


	CKEDITOR.replace("content", {
		width: 800,
		filebrowserUploadUrl : '/mypogal/_process/index.php?process=ckeditor-upload'
	});
});


function getCategories(cgroup, cno) {
	$("#category").parent().prev().append("<span style=\"color: red; margin-left: 10px; font-style: italic;\">분류를 가져오고 있습니다. 기다리세요..</span>");
	
	$.getJSON("./_process/index.php", {
		process: "content-category-list", cgroup: cgroup, cno: cno
	}, function(responseJSON) {
		if (responseJSON.length) {
			var html = "";
			for(var i = 0; i < responseJSON.length; i++) {
				$("#category", "#fContentRegister").append('<option value="' + responseJSON[i].category + '">' + responseJSON[i].name + '</option>');
			}
			$("#category").parent().prev().children("span").remove();
			<?php
			if (!empty($_POST['cno']) && !empty($_POST['cgroup'])) {
				if ($oContentOutput->category) {
					echo '$("#category", "#fContentRegister").val('.$oContentOutput->category.').selectmenu("refresh");';
				}
			} ?>
		} else {
			$("#category").parent().prev().children("span").remove();
		}
	}).fail(function() {
		$("#category").parent().prev().children("span").remove();
		Common.showMsg("분류를 준비하는데 실패했습니다.<br />창을 편집창을 닫으시고 다시 시도하십시오.");
	});	
}

function getMeta(cgroup, cno) {
	$("#metafields").append("<dt style=\"color: red; font-style: italic;\">메타 필드를 준비하고 있습니다. 기다리세요..</dt>");
	
	// 메타 필드
	$.getJSON("./_process/index.php", {
		process: "content-meta-list", cgroup: cgroup, cno: cno
	}, function(responseJSON) {
		if (responseJSON.length) {
			var html = "";
			for(var i = 0; i < responseJSON.length; i++) {
				html += '<dt>' + responseJSON[i].summary + '</dt>';
				html += '<dd><input type="text" id="meta-' + responseJSON[i].meta + '" name="meta-' + responseJSON[i].meta + '" class="full"';
				if (responseJSON[i].value != undefined) {
					html += ' value="' + responseJSON[i].value + '"';
				}
				html += ' /></dd>';
			}
			
			$("#metafields").children().remove();
			$("#metafields").append(html);
		} else {
			$("#metafields").children().remove();
		}
		
		//Manage.init();		
	}).fail(function() {
		$("#metafields").children().remove();
		Common.showMsg("메타 필드를 준비하는데 실패했습니다.<br />창을 편집창을 닫으시고 다시 시도하십시오.");
	});	
}

</script>