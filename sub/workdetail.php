<?php
include_once $_SERVER['DOCUMENT_ROOT']."/mypogal/_libs/initial.php";
$detail = mypogal::detail($_GET['cno']);
?>



<!-- works 상세 -->

<div class="workdetail-wrapper">

  <section class="workdetail-content-wrapper">
    <h2 class="workdetail-title"><?=$detail->title; ?></h2>
    <div class="workdetail-content"><?=$detail->content; ?></div>
    <ul class="workdetail-info">
      <li><span>client</span><span><?=$detail->client; ?></span></li>
      <li><span>web development</span><span><?=$detail->credit1; ?></span></li>
      <li><span>graphic design</span><span><?=$detail->credit2; ?></span></li>
      <li><span>year</span><span><?=$detail->year; ?></span></li>
    </ul>
    <div class="workdetail-command">
      <button type="button" id="btn-back">< Back</button>
    </div>
  </section>

  <section class="workdetail-image-wrapper">
    <div><img src="<?=$detail->image1; ?>"/></div>
    <div><img src="<?=$detail->image2; ?>"/></div>
    <div><img src="<?=$detail->image3; ?>"/></div>
    <div><img src="<?=$detail->image4; ?>"/></div>
  </section>

  <div class="modal">
    <div class="modal-image-wrapper"></div>
  </div>
</div>

<script type="text/javascript" src="/src/sub-workdetail.js?<?=time()?>"></script>
<script type="text/javascript" src="/src/darkmode.js?<?=time()?>"></script>