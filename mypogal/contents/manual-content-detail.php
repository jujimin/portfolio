<?php 
include_once '../_libs/initial.php';
?>

<h1>상세 출력</h1>
<h2>공통</h2>
<ul>
	<li><h4>mypogal::detail(콘텐츠 번호)</h4>
		<ol>
			<li>콘텐츠 번호(필수): 콘텐츠 번호를 GET 데이터 방식으로 전달받아 설정한다.</li>
		</ol>
	</li>
	<li>
		<h4>샘플 코드</h4>
		<h5>페이지 상단에 다음 코드를 생성</h5>
		<p>
			<span style="color: red;">&lt;?php</span><br />
			<span style="font-weight: bold; color: #000;">include_once</span>&nbsp;$_SERVER['DOCUMENT_ROOT']."/mypogal/_libs/initial.php";<br />
			<span style="font-weight: bold; color: brown;">$detail</span> = <span style="font-weight: bold; color: #000;">mypogal::detail(</span><span style="color: blue;">$_GET['cno']</span><span style="font-weight: bold; color: #000;">);</span><br />
			<span style="color: red;">?&gt;</span>
		</p>
	</li>
	<li>	
		<h4>콘텐츠 그룹 정보 출력</h4>
		<h5>콘텐츠 그룹 명 출력</h5>
		<ul>
			<li><h5>mypogal::content_group_name()</h5></li>
			<li>
				<h5>샘플 코드</h5>
				<p>
				<span style="color: red;">&lt;?php</span><br />
				<span style="font-weight: bold; color: #000;">mypogal::content_group_name(</span><span style="font-weight: bold; color: #000;">);</span><br />
				<span style="color: red;">?&gt;</span>
				</p>
			</li>
		</ul>
		
		<h5>콘텐츠 그룹 요약 출력</h5>
		<ul>
			<li><h5>mypogal::content_group_summary()</h5></li>
			<li>
				<h5>샘플 코드</h5>
				<p>
				<span style="color: red;">&lt;?php</span><br />
				<span style="font-weight: bold; color: #000;">mypogal::content_group_summary(</span><span style="font-weight: bold; color: #000;">);</span><br />
				<span style="color: red;">?&gt;</span>
				</p>
			</li>
		</ul>
	</li>
</ul>

<h2>스킨 방식</h2>
<ol>
	<li><h3>콘텐츠 상세 출력에 사용되는 치환코드</h3>
		<ol>
			<li>{{title}} : 콘텐츠 제목</li>
			<li>{{categoryname}} : 분류명</li>
			<li>{{content}} : 콘텐츠 본문</li>
			<li>{{thumbnail}} : 셈네일 경로</li>
			<li>{{registered}} : 등록 일시</li>
			<li>{{updated}} : 업데이트 일시</li>
			<li>{{hits}} : 조회수</li>
			<li>직접 등록한 메타 코드</li>
		</ol>
	</li>
	<li><h3>스킨 방식을 이용한 콘텐츠 상세 출력 PHP Code </h3>
		<ul>
			<li><h4>mypogal::output(상세 출력 스킨 경로)</h4>
				<ol>
					<li>상세 출력 스킨 경로(필수): 치환 코드가 포함된 상세 내용을 출력할 디자인 코드의 경로 설정</li>
				</ol>
			</li>
			<li>
				<h4>샘플 코드</h4>
				<h5>상세를 출력할 위치에 다음 코드를 생성</h5>
				<p>
					<span style="color: red;">&lt;?php</span><br />
					<span style="font-weight: bold; color: #000;">mypogal::output(</span><span style="color: blue;">"skin.html"</span><span style="font-weight: bold; color: #000;">);</span><br />
					<span style="color: red;">?&gt;</span>
				</p>
			</li>
		</ul>
	</li>
	<li>
		<h3>콘텐츠 상세 출력 치환 코드 필터 적용</h3>
		<ul>
			<li>
				<h4>날짜 출력 포맷</h4>
				<ul>
					<li>2016-05-01 방식으로 출력시: {{registered#Y-m-d}}</li>
					<li>16-05-01 방식으로 출력시: {{registered#y-m-d}}</li>
					<li>16-5-1 방식으로 출력시: {{registered#y-n-j}}</li>
					<li>16-05-01 22시 방식으로 출력시: {{registered#y-m-d H:i}}</li>
					<li>16-05-01 22:07 방식으로 출력시: {{registered#y-m-d H:i}}</li>
					<li>16년 05월 01일 22시 07분 방식으로 출력시: {{registered#y년 m월 d일 H시 i분}}</li>
				</ul>
			</li>
		</ul>
	</li>
</ol>

<h2>비스킨 방식</h2>
<ol>
	<li><h3>콘텐츠 상세 출력에 사용되는 필드 코드</h3>
		<ol>
			<li>cgroup['name'] : 콘텐츠 그룹 명</li>
			<li>cgroup['summary'] : 콘텐츠 그룹 요약</li>
			<li>title : 콘텐츠 제목</li>
			<li>categoryname : 분류명</li>
			<li>content : 콘텐츠 본문</li>
			<li>thumbnail : 셈네일 경로</li>
			<li>registered : 등록 일시</li>
			<li>updated : 업데이트 일시</li>
			<li>hits : 조회수</li>
			<li>직접 등록한 메타 코드</li>
		</ol>
	</li>
	<li><h3>콘텐츠 상세 출력 PHP Code </h3>
		<ul>
			<li>
				<h4>샘플 코드</h4>
				<h5>콘텐츠 그룹 정보 출력</h5>
				<p>
					<ul>
						<li>콘텐츠 그룹명
							<span style="color: red;">&lt;?=</span><span style="font-weight: bold; color: #000;">$detail-></span><span style="color: blue;">cgroup['name']</span>;
							<span style="color: red;">?&gt;</span>
						</li>
						<li>콘텐츠 요약
							<span style="color: red;">&lt;?=</span><span style="font-weight: bold; color: #000;">$detail-></span><span style="color: blue;">cgroup['summary']</span>;
							<span style="color: red;">?&gt;</span>
						</li>
					</ul>
				</p>
				<h5>출력을 원하는 위치에 아래 코드를 적용</h5>
				<p>
					<span style="color: red;">&lt;?=</span><span style="font-weight: bold; color: #000;">$detail-></span><span style="color: blue;">필드 코드</span>;
					<span style="color: red;">?&gt;</span>
				</p>
			</li>
		</ul>
	</li>
	<li>
		<h3>날짜 포맷 출력</h3>
		<p>
			<span style="color: red;">&lt;?php</span><br />
			<span style="font-weight: bold; color: #000;">mypogal::date(</span><span style="color: blue;">날짜[, 날짜 포맷]</span><span style="font-weight: bold; color: #000;">);</span><br />
			<span style="color: red;">?&gt;</span>
		</p>
		<h4>날짜 포맷</h4>
		<ul>
			<li>16년 06월 04일 : "y년 m월 d일"</li>
			<li>16년 6월 4일 : "y년 n월 j일"</li>
		</ul>
	</li>
</ol>




