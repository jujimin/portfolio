<!-- blog 리스트 -->
<ul class="blog-list">
  <?php
  include_once $_SERVER['DOCUMENT_ROOT']."/mypogal/_libs/initial.php";
  mypogal::catalog($_GET['cgroup'], "./skins/blog.html", 10, true);
  ?>
</ul>

<!-- 페이지넘버 -->
<div class="paging">
  <?php
  include_once $_SERVER['DOCUMENT_ROOT']."/mypogal/_libs/initial.php";
  mypogal::paging("./skins/paging.html");
  ?>  
</div>



<script type="text/javascript">
  window.addEventListener("load", () => {
    // 블로그 리스트 마우스오버시 요약 노출
    const aElBlogList = document.querySelectorAll(".blog-list-item");
    
    aElBlogList.forEach(el => {
      el.addEventListener("mouseover", e => {
        e.currentTarget.lastElementChild.style.maxHeight = "200px";
      });
      el.addEventListener("mouseout", e => {
        e.currentTarget.lastElementChild.style.maxHeight = "0px";
      });
    });
  });

</script>

<script type="text/javascript" src="/src/darkmode.js?<?=time()?>"></script>