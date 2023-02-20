<div  class="setup-title">
	<h1>MyPoGal을 설치합니다.</h1>
	<p>&copy; 2016 iroSOFT</p>
</div>

<form id="fSetup" class="setup-form">
	<ul class="setup-header">
		<li>MyPoGal(마이포겔)은 웹클라이언트 개발자 과정을 공부하시는 분들을 위해 동적 콘텐츠를 관리할 수 있도록 하는 목적에서 개발되었으므로 이외의 용도로 사용되는 것을 엄격히 금합니다.</li> 
		<li>이 프로그램은 정해진 배포 방식이외에 무단 재배포할 수 없습니다.</li>
		<li>이 프로그램을 사용시 발생할 수 있는 문제에 대해서는 책임을 지지 않습니다.</li>
	</ul>
	<p>
		<input type="checkbox" id="accept" name="accept" value="yes" />
		<label for="accept">위의 내용에 동의합니다.</label>
	</p>
	<dl class="setup-fields">
		<dt>관리자 아이디</dt>
		<dd><input type="text" id="admin_uid" name="admin_uid" class="required" title="사용할 관리자 아이디를 입력하세요." /></dd>
		<dt>관리자 닉네임</dt>
		<dd><input type="text" id="admin_nickname" name="admin_nickname" class="required" title="사용할 관리자 닉네임을 입력하세요." /></dd>
		<dt>관리자 비밀번호</dt>
		<dd>
			<input type="password" id="admin_pwd" name="admin_pwd" class="required" title="사용할 비밀번호를 입력하세요." />
			<span>확인입력</span>
			<input type="password" id="admin_pwd_confirm" name="admin_pwd_confirm" class="required" title="비밀번호를 확인 입력하세요." />
		</dd>
		<dt>관리자 이메일</dt>
		<dd><input type="text" id="admin_email" name="admin_email" class="required" title="이메일을 입력하세요." /></dd>
	</dl>
	<p>
		<button type="button" id="btnSetup">설치하기</button>
	</p>
</form>

<script type="text/javascript">
$(function() {
	$("#btnSetup").click(function() {
		$("#fSetup").ajaxSubmit({
				url: "./_process/index.php", type: "post",
				data: { process: "setup" },
				beforeSubmit: function() {
					var valid =  true;

					// 동의사항 체크
					if (!$("#accept").is(":checked")) {
						$("#accept").parent().prev().andSelf().effect("highlight");
						return false;
					}

					$(".required", "#fSetup").each(function() {
							var $this = $(this);
							if (!$this.val()) {
								$this.effect("highlight");
								valid = false;
								return false;
							}
						});

					// 비밀번호 확인 입력 검증
					if ($("#admin_pwd").val() != $("#admin_pwd_confirm").val()) {
						$("#admin_pwd_confirm").effect("highlight", function() {
							$(this).focus();
						})
						valid = false;
					}

					// 이메일 유효성 검증
					var emailRegexp = /[0-9a-zA-Z][_0-9a-zA-Z-]*@[_0-9a-zA-Z-]+(\.[_0-9a-zA-Z-]+){1,2}$/;	
					var adminemail = $("#admin_email").val();
					if (valid && !adminemail.match(emailRegexp)) {
						$("#admin_email").effect("highlight", function() {
							$(this).focus();
						});
						valid = false;
					}					

					if (valid) $("#btnSetup").text("설치중..").attr("disabled", true);
					
					return valid;
				},
				success: function(response) {
					if (response == "OK") {
						setup.showComplete();
					} else {
						setup.showError();
						$("#btnSetup").text("설치하기").attr("disabled", false);
					}
				}
			});
	});	
});

var setup = {
		_init: function() {
			if (!$("#dialog").length) $("#fSetup").append("<div id='dialog'>");
		},
		showComplete: function() {
			setup._init();
			$("#dialog").dialog({
				width: 500, height: 400, modal: true, dialogClass: "jquidialog-hide-titlebar",
				open: function() {
					//$("#fSetup").find(".ui-dialog-titlebar").hide();
					$(this).load("./contents/setup-complete.php");
				}
			});
		},
		showError: function() {
			setup._init();
			$("#dialog").dialog({
				width: 500, height: 400, modal: true, dialogClass: "jquidialog-hide-titlebar",
				open: function() {
					$(this).load("./contents/setup-error.php");
				}
			});

		}
}
</script>