<?php 
include_once '../_libs/initial.php';
?>

<h1>Contact</h1>

<ol>
	<li><h3>전송 필드 명</h3>
		<ul>
			<li>process : &lt;input type="hidden" name="process" value="contact" /&gt; 으로 반드시 'contact' 값을 전송</li>
			<li>act : &lt;input type="hidden" name="act" value="receipt" /&gt; 으로 반드시 'receipt' 값을 전송</li>
			<li>subject : 필수, 영문 기준 255자 이내</li>
			<li>writer : 필수, 영문 기준 50자 이내</li>
			<li>email : 선택, 영문 기준 50자 이내</li>
			<li>phonenumber1 : 선택, 숫자, 4자 이내</li>
			<li>phonenumber2 : 선택, 숫자, 4자 이내</li>
			<li>phonenumber3 : 선택, 숫자, 4자 이내</li>
			<li>content : 필수</li>
		</ul>
	</li>
	<li><h3>전송 규약</h3>
		<ul>
			<li>전송 URL : /mypogal/_process/index.php</li>
			<li>전송 방식 : POST</li>
		</ul>
	</li>
	<li><h3>Form 샘플 코드</h3>
	<xmp>
		<form id="fContact" name="fContact">
			<input type="hidden" name="process" value="contact" />
			<input type="hidden" name="act" value="receipt" />
		    <dl>
		        <dt>제목</dt>
		        <dd>
		            <input type="text" id="subject" name="subject" class="required" title="문의하실 제목을 입력하세요." />
		        </dd>
		        <dt>고객명</dt>
		        <dd>
		            <input type="text" id="writer" name="writer" class="required" title="고객명을 입력하세요." />
		        </dd>
		        <dt>이메일</dt>
		        <dd>
		            <input type="text" id="email" name="email" class="required" title="이메일을 입력하세요." />
		        </dd>        
		        <dt>연락처</dt>
		        <dd>
		            <input type="text" id="phonenumber1" name="phonenumber1" class="required" size="4" maxlength="4" title="연락 가능한 전화번호를 입력하세요." /> -
					<input type="text" id="phonenumber2" name="phonenumber2" class="required" size="4" maxlength="4" title="연락 가능한 전화번호를 입력하세요." /> -
					<input type="text" id="phonenumber3" name="phonenumber3" class="required" size="4" maxlength="4" title="연락 가능한 전화번호를 입력하세요." />
		        </dd>   
				<dt>보내실 내용</dt>
				<dd><textarea id="content" name="content" class="required" title="보내실 내용을 작성해 주십시오."></textarea></dd>
		    </dl>
		    <div id="commandbar">
		        <button type="button" id="btnSend">문의하기</button>
		    </div>    
		</form>	
	</xmp>
	</li>
</ol>




