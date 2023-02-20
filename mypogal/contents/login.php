<div class="setup-title">
	<h1>마이포겔(MyPoGal) 로그인</h1>
</div>

<form id="fLogin">
	<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th>관리자 아이디</th>
			<td><input type="text" id="adminid" name="adminid" title="관리자 아이디를 입력하세요" /></td>
		</tr>
		<tr>
			<th>비밀번호</th>
			<td><input type="password" id="adminpwd" name="adminpwd" title="관리자 비밀번호를 입력하세요" /></td>
		</tr>
		
		<tr>
			<td colspan="2" id="message"></td>
		</tr>
		
		<tr>
			<td colspan="2" align="right">
				<button type="button" id="btnLogin">로그인</button>
			</td>
		</tr>
	</table>
</form>

<script type="text/javascript">
$(function() {
	$("#adminid").focus();
    $("#btnLogin").click(Login.execute);
    $("#adminid").bind("keyup", Login.enterUserid).
        bind("keydown", Login.init);
    $("#adminpwd").bind("keyup", Login.enterPasswd).
        bind("keydown", Login.init);    
});


var Login = {
    init : function(event) {
        $(event.target).css({
            borderColor : "#CCCCCC"
        });
    },
    
    enterUserid : function(event) {
        var el = event.target;
        if (event.keyCode == 13) {
            if (!$(el).val()) {
                $(el).css({
                    borderColor : "red" 
                });
                $(el).focus();
                return false;
            }
            
            if (!$("#adminpwd").val()) {
                $("#adminpwd").focus();
            } else {
                Login.execute();
            }
        } 
    },
    
    enterPasswd : function(event) {
        var el = event.target;
        if (event.keyCode == 13) {
            if (!$(el).val()) {
                $(el).css({
                    borderColor : "red"
                });
                $(el).focus();
                return false;
            }
            
            if (!$("#adminid").val()) {
                $("#adminid").focus();
            } else {
                Login.execute();
            }
        }
    },
    
    execute : function(event) {
        if (!$("#adminid").val()) {
            $("#adminid").css({borderColor : "red"});
            $("#adminid").focus();
            return false;
        }
        
        if (!$("#adminpwd").val()) {
            $("#adminpwd").css({borderColor : "red"});
            $("#adminpwd").focus();
            return false;
        }
        
        $.post("./_process/index.php", {
            process : "permission",
            act : "login",
            userid : $("#adminid").val(),
            passwd : $("#adminpwd").val()
        }, function(responseText) {
            switch (responseText) {
                case "INVALID_ID" :
                    $("#message").html("잘못된 아이디입니다.").doTimeout(1000, function() {
                            $(this).html("");
                        });
                    $("#adminid").focus();            
                    break;
                case "INVALID_PWD" :
                    $("#message").html("비밀번호가 맞지않습니다.").doTimeout(1000, function() {
                            $(this).html("");                        
                        });
                    $("#passwd").focus();            
                    break;
                    
                case "COMPLETION" :
                    location.reload();
                    break;
                    
                default :
                    alert("[오류]\n" + responseText);
                    break;
            }
        });
    }
};

</script>