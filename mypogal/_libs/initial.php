<?php
/**********************************************************************************************************************************
 * MyPogal
 * 마이포겔은 아이로소프트 사이데미(cydemy.com)에서 개발한 웹클라이언트 개발자 과정
 * 학습자를 위한 개인 포트폴리오 갤러리 웹사이트 콘텐츠 관리 시스템입니다.
 * Copyright (c) 2016 iroSOFT
 * -------------------------------------------------------------------
 * 버전: 2.0.2-2016.11.04
 * 배포: www.cydemy.com
 * 피드백: master@cydemy.com
 * 라이센스: 다음 아래의 조항(Cydemy Licence)을 따릅니다.
 * (1) Cydemy.com 회원이면 누구나 무료로 다운로드 받아 설치를 하실 수 있습니다.
 * (2) 하나의 설치 파일당 신청시 등록한 도메인에서만 사용이 가능합니다. 단 다음 사항을 준수하는 범위 내에서 설치 도메인 갯수를 제한하지 않습니다.
 * 	- 두 개 이상의 도메인에 설치하는 경우에는 각각 별도로 다운로드 신청을 해야합니다.
 * 	- 상업용으로 절대 사용을 불허하며 학습용이거나 포트폴리오 갤러리 웹사이트 형식이어야 합니다. 포트폴리오 갤러리 웹사이트가 아닌 경우에는 학습용도로 간주합니다.
 * 	- 포트폴리오 갤러리 웹사이트가 아닌 경우에도 학습용도로 설치가 가능하나  상업적인 용도로 변경을 불허합니다.
 * 	- 학습용을 포함, 프리랜서 및 취업용으로 자신의 포트폴리오 갤러리 웹사이트에 설치하여 사용(유지)하는 경우에는 무료 사용권한을 계속 유지할 수 있습니다.
 * (3) 소스코드를 수정하거나 재배포를 금합니다.
 * (4) 위에 명시된 조건을 갖추는 경우에 소프트웨어 사용권을 가지나 소프트웨어 사용으로 인해 발생하는 피해와 오류 발생시 유지보수 책임을 지지 않습니다.
 * (5) 위의 명시된 용도 이외나 상업적 용도로 사용하시고자 하는 경우에는 별도의 라이센스를 허락받아야 합니다. 
 * <설치 환경>
 * PHP 5.3.x 이상
 * MySQL 5.5.x 이상
 * UTF-8 환경
 */

//error_reporting(E_ALL);
error_reporting(E_ALL ^ E_DEPRECATED);
//ini_set("display_errors", 1);
ini_set("display_errors", 0);

date_default_timezone_set("Asia/Seoul");

$aTmp = explode("/", $_SERVER['SCRIPT_FILENAME']);
$_SERVER['DOCUMENT_ROOT'] = "/".$aTmp[1]."/".$aTmp[2]."/".$aTmp[3];


$GLOBALS['mypogal-path'] = $_SERVER['DOCUMENT_ROOT'].'/mypogal/';
require_once $GLOBALS['mypogal-path'].'config.php';


function __loadclass($class) {
	$path = str_replace("_", DIRECTORY_SEPARATOR, strtolower($class)).".class.php";
	$fullPath = $GLOBALS['mypogal-path'].'_libs/'.$path;
	if (file_exists($fullPath)) {
		require_once $fullPath;
	} else {
		throw new Exception($class.'를 로드할 수 없습니다.');
	}	
}

// 현재 클래스 로드 
spl_autoload_register("__loadclass");


$oSes = new net_irosoft_mypogal_Session();
?>