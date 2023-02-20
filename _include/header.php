<div class="header">
  <h2 class="works-title"><a href="/?sub=works&cgroup=<?=$_GET['cgroup']?>">works</a></h2>
  <ul class="works-categories">
    <li data-category="0"><a href="/?sub=works&cgroup=<?=$_GET['cgroup']?>">all</a></li>
    <?php
    include_once $_SERVER['DOCUMENT_ROOT']."/mypogal/_libs/initial.php";
    mypogal::categories($_GET['cgroup'], "./skins/category.html");
    ?>
  </ul>

  <!-- 홈버튼 -->
  <div id="home-btn" class="home-btn">
    <div class="home-btn-close"><a href="/"><?php include_once "./images/home-btn-door-close.php";?></a></div>
    <div class="home-btn-open"><a href="/"><?php include_once "./images/home-btn-door-open.php";?></a></div>
  </div>
</div>

<script type="text/javascript" src="/src/header.js?<?=time()?>"></script>