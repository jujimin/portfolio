<?php
include_once $_SERVER['DOCUMENT_ROOT']."/mypogal/_libs/initial.php";
$detail = mypogal::detail($_GET['cno']);
?>

<!-- blog 상세 -->

<div class="workdetail-wrapper">

  <section class="workdetail-content-wrapper">
    <h2 class="workdetail-title"><?=$detail->title; ?></h2>
    
    <ul class="workdetail-info">
      <li><span>작성일시</span><span><?=mypogal::date($detail->registered, "y년 n월 j일"); ?></span></li>
      <li><span>조회수</span><span><?=$detail->hits; ?></span></li>
    </ul>
    <div class="workdetail-command">
      <button type="button" id="btn-back">< Back</button>
    </div>
  </section>

  <section class="workdetail-image-wrapper">
    <div class="workdetail-content"><?=$detail->content; ?></div>
    <div><img src="<?=$detail->image1; ?>"/></div>
    <div><img src="<?=$detail->image2; ?>"/></div>
    <div><img src="<?=$detail->image3; ?>"/></div>
  </section>

  <div class="modal">
    <div class="modal-image-wrapper"></div>
  </div>
</div>

<script type="text/javascript" src="/src/sub-workdetail.js?<?=time()?>"></script>
<script type="text/javascript" src="/src/darkmode.js?<?=time()?>"></script>