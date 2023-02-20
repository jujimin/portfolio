<div  class="setup-title">
	<h1>MyPoGal 업데이트를 설치합니다.</h1>
	<p>&copy; 2016 iroSOFT</p>
</div>

<div class="update-body">
	<h2>이제 새로운 버전으로 마이포겔을 업데이트합니다.</h2>
	<p>업데이트를 하더라도 사용자의 데이터는 안전하게 유지됩니다.</p>
	<p>계속하려면 아래의 업데이트 버튼을 눌러주십시오.</p>
	<p class="commandbar">
		<button type="button" id="btnUpdate"><h3>업데이트 시작</h3></button>
	</p>
</div>


<script type="text/javascript">
$(function() {
	$("#btnUpdate").click(function() {
		$(this).children("h3").html("업데이트 중...").attr("disabled", true);
		$.post("./_process/index.php", {
				process: "update"
			},	function(response) {
					if (response == "OK") {
						update.showComplete();
						$(this).children("h3").html("업데이트 완료").attr("disabled", true);
					} else {
						update.showError();
						$(this).children("h3").html("업데이트 시작").attr("disabled", false);
					}
				});
	});
});

var update = {
	_init: function() {
		if (!$("#dialog").length) $(".update-body").append("<div id='dialog'>");
	},
	showComplete: function() {
		update._init();
		$("#dialog").dialog({
			width: 600, height: 400, modal: true, dialogClass: "jquidialog-hide-titlebar",
			open: function() {
				//$("#fSetup").find(".ui-dialog-titlebar").hide();
				$(this).load("./contents/update-complete.php");
			}
		});
	},
	showError: function() {
		update._init();
		$("#dialog").dialog({
			width: 600, height: 400, modal: true, dialogClass: "jquidialog-hide-titlebar",
			open: function() {
				$(this).load("./contents/update-error.php");
			}
		});

	}
}
</script>