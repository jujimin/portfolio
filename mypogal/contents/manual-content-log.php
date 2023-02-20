<?php 
include_once '../_libs/initial.php';
?>

<h1>로그 관리</h1>

<ol>
	<li><h3>로그 저장을 위한 처리</h3>
		<p>공통으로 불러오는 페이지에 다음 아래의 코드를 추가한다.</p>
		<p>
		<span style="color: red;">&lt;?php</span><br />
		<span style="font-weight: bold; color: #000;">include_once</span>&nbsp;$_SERVER['DOCUMENT_ROOT']."/mypogal/_libs/initial.php";<br />
		<span style="font-weight: bold; color: #000;">mypogal::log();</span><br />
		<span style="color: red;">?&gt;</span>
		</p>
	</li>
	<li><h3>카운터 출력</h3>
		<h4>카운터 출력 디자인 코드에 사용되는 치환 코드</h4>
		<ol>
			<li>{{today}} : 오늘 방문자 수</li>
			<li>{{yesterday}} : 어제 방문자 수</li>
			<li>{{total}} : 총 방문자 수</li>
		</ol>
	</li>
	<li><h3>카운터 출력 PHP Code </h3>
		<ul>
			<li><h4>mypogal::counter("카운터 스킨 경로")</h4>
				<ol>
					<li>카운터 스킨 경로(필수): 치환 코드를 확인하고 스킨 코드를 작성한다.</li>
				</ol>
			</li>
			<li>
				<h4>샘플 코드</h4>
				<h5>출력을 원하는 위치에 아래 코드를 적용</h5>
				<p>
				<span style="color: red;">&lt;?php</span><br />
				<span style="font-weight: bold; color: #000;">include_once</span>&nbsp;$_SERVER['DOCUMENT_ROOT']."/mypogal/_libs/initial.php";<br />
				<span style="font-weight: bold; color: #000;">mypogal::counter(</span><span style="color: blue;">"./skin.html"</span><span style="font-weight: bold; color: #000;">);</span><br />
				<span style="color: red;">?&gt;</span>
				</p>
			</li>
		</ul>
	</li>
</ol>




