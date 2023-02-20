<?php 
include_once '../_libs/initial.php';
?>

<h1>분류 출력</h1>

<ol>
	<li><h3>콘텐츠 분류 출력 디자인 코드에 사용되는 치환 코드</h3>
		<ol>
			<li>{{cgroup}} : 콘텐츠 그룹 코드</li>
			<li>{{category}} : 글 분류 코드</li>
			<li>{{categoryname}} : 글 분류 명</li>
		</ol>
	</li>
	<li><h3>콘텐츠 분류 출력 PHP Code </h3>
		<ul>
			<li><h4>mypogal::categories(콘텐츠 그룹코드, 분류 디자인 코드 경로)</h4>
				<ol>
					<li>콘텐츠 그룹 코드(필수): 콘텐츠 그룹 코드를 콘텐츠 관리를 참고하여 작성한다.</li>
					<li>분류 디자인 코드 경로(필수): 분류 출력시 반복되어 사용되는 디자인 코드가 작성되어 있는 외부 경로를 지정한다.</li>
				</ol>
			</li>
			<li>
				<h4>샘플 코드</h4>
				<p>
				<span style="color: red;">&lt;?php</span><br />
				<span style="font-weight: bold; color: #000;">include_once</span>&nbsp;$_SERVER['DOCUMENT_ROOT']."/mypogal/_libs/initial.php";<br />
				<span style="font-weight: bold; color: #000;">mypogal::categories(</span><span style="color: blue;">$_GET['cgroup'], "./skin.html"</span><span style="font-weight: bold; color: #000;">);</span><br />
				<span style="color: red;">?&gt;</span>
				</p>
			</li>
		</ul>
	</li>
</ol>




