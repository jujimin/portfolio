<div class="contact">
  <div class="contact-post-stamp"><?php include "../images/contact_stamp_3.php";?></div>
  <form id="fContact" name="fContact" class="contact-content">
      <input type="hidden" name="process" value="contact" />
			<input type="hidden" name="act" value="receipt" />
      <div class="contact-content-message">
        <h2>Contact</h2>
        <textarea id="content" name="content" required placeholder="내용을 작성하세요."></textarea>
      </div>
      <div class="contact-content-client">
        <input type="text" id="subject" name="subject" required placeholder="문의 제목" />
        <input type="text" id="writer" name="writer" required placeholder="성함" /><span></span>
        <input type="email" id="email" name="email" required placeholder="이메일" /><span></span>
        <div id="commandbar"><button type="submit" id="btnSend">보내기</button></div>
      </div>
  </form>
</div>