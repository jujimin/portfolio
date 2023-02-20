<?php
$aTmp = explode("/", $_SERVER['SCRIPT_FILENAME']);
$_SERVER['DOCUMENT_ROOT'] = "/".$aTmp[1]."/".$aTmp[2]."/".$aTmp[3];
?>

<!DOCTYPE html>
<html>
<head>
<title>Ju Jimin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
<link rel="shortcut icon" href="/images/favicon.ico" />

<!-- Global CSS -->
<!-- 구글 아이콘 사용 -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
<!-- 개발 단계에서의 캐쉬 자동 업데이트. 이후에 삭제 -->
<link href="/src/default.css" type="text/css" rel="stylesheet" />
<link href="/src/layout-narrow.css" media="screen and (max-width: 600px)" type="text/css" rel="stylesheet"/>
<link href="/src/layout-wide.css" media="screen and (min-width: 601px)" type="text/css" rel="stylesheet"/>
<!-- /Global CSS -->
<?php if (isset($_GET['sub'])) {?>
<link href="/src/content-sub.css" type="text/css" rel="stylesheet"/>
<link href="/src/content-sub-narrow.css" media="screen and (max-width: 600px)" type="text/css" rel="stylesheet"/>
<link href="/src/content-sub-wide.css" media="screen and (min-width: 601px)" type="text/css" rel="stylesheet"/>
<?php } else { ?>
<link href="/src/content-main.css" type="text/css" rel="stylesheet"/>
<link href="/src/content-main-narrow.css" media="screen and (max-width: 600px)" type="text/css" rel="stylesheet"/>
<link href="/src/content-main-wide.css" media="screen and (min-width: 601px)" type="text/css" rel="stylesheet"/>
<?php } ?>

</head>

<body>
<!-- 헤더 -->
<header class="header-wrapper">
  <?php
  if(isset($_GET['sub'])) {
    $headerFileNameFlag = preg_match("/blog/", $_GET['sub']) ? "-blog" : "";
    include "./_include/header{$headerFileNameFlag}.php";
  }
  ?>
</header>
 
<!-- 콘텐츠 영역 -->
<main class="main-wrapper">
  <div class="main">
    <?php
    if (isset($_GET['sub'])) {
      include "./sub/{$_GET['sub']}.php";
    } else {
      include "./main.php";
    }
    ?>
  </div>
</main>
<!-- /콘텐츠 영역 -->

<!-- 하단 영역 -->
<footer class="footer-wrapper">
  <?php include "./_include/footer.php" ?>
</footer>
<!-- /하단 영역 -->
</body>
</html>

<?php
include_once $_SERVER['DOCUMENT_ROOT']."/mypogal/_libs/initial.php";
mypogal::log();
?>