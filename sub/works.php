<!-- works 리스트 -->
<ul class="works-list">
  <?php
  include_once $_SERVER['DOCUMENT_ROOT']."/mypogal/_libs/initial.php";
  mypogal::catalog($_GET['cgroup'], "./skins/works.html", 3, true);
  ?>
</ul>

<!-- 페이지넘버 -->
<div class="paging">
  <?php
  include_once $_SERVER['DOCUMENT_ROOT']."/mypogal/_libs/initial.php";
  mypogal::paging("./skins/paging.html");
  ?>  
</div>


<script type="text/javascript" src="/src/sub-works.js?<?=time()?>"></script>
<script type="text/javascript" src="/src/darkmode.js?<?=time()?>"></script>