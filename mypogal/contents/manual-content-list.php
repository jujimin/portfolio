<?php 
include_once '../_libs/initial.php';
?>

<h1>목록 출력</h1>

<ol>
	<li><h3>콘텐츠 목록 출력</h3>
		<h4>콘텐츠 목록 출력 디자인 코드에 사용되는 치환 코드</h4>
		<ol>
			<li>{{cno}} : 글 번호</li>
			<li>{{cgroup}} : 콘텐츠 그룹 코드</li>
			<li>{{category}} : 글 분류 코드</li>
			<li>{{categoryname}} : 글 분류 명</li>
			<li>{{title}} : 글 제목</li>
			<li>{{thumbnail}} : 셈네일 URL</li>
			<li>{{registered}} : 글 등록일시</li>
			<li>{{updated}} : 글 수정일시</li>
			<li>{{hits}} : 조회수</li>
			<li>{{직접 등록된 메타 코드}}</li>
		</ol>
		<h4>콘텐츠 제목 출력시 문자열 길이 자름 처리</h4>
		<p>목록 출력시 경우에 따라서 문자열의 길이를 제한 필요가 있을 경우 아래와 같이 치환코드가 필터 적용을 한다.</p>
		<p>제목 길이를 70자 이내로 출력하고자 하는 경우: {{title#70}}</p>
		<h4>콘텐츠 목록 출력 치환 코드 필터 적용</h4>
		<ul>
			<li>
				<h5>날짜 출력 포맷</h5>
				<ul>
					<li>2016-05-01 방식으로 출력시: {{registered#Y-m-d}}</li>
					<li>16-05-01 방식으로 출력시: {{registered#y-m-d}}</li>
					<li>16-5-1 방식으로 출력시: {{registered#y-n-j}}</li>
					<li>16-05-01 22시 방식으로 출력시: {{registered#y-m-d H:i}}</li>
					<li>16-05-01 22:07 방식으로 출력시: {{registered#y-m-d H:i}}</li>
					<li>16년 05월 01일 22시 07분 방식으로 출력시: {{registered#y년 m월 d일 H시 i분}}</li>
				</ul>
		</ul>
		<h4>콘텐츠 목록 하단 페이징 출력 디자인 코드에 사용되는 치환 코드</h4>
		<ul>
			<li>{{paging}} : 페이지 네비게이터가 자동으로 생성된다.</li>
		</ul>
	</li>
	<li>
		<h3>콘텐츠 목록 출력 PHP Code </h3>
		<h4>콘텐츠 그룹 명 출력</h4>
		<ul>
			<li><h4>mypogal::content_group_name([콘텐츠 그룹코드])</h4>
				<ol>
					<li>콘텐츠 그룹 코드(선택): 콘텐츠 그룹 코드를 콘텐츠 관리를 참고하여 작성하거나 $_GET['cgroup']이 존재한다면 생략 가능</li>
				</ol>
			</li>
			<li>
				<h4>샘플 코드</h4>
				<p>
				<span style="color: red;">&lt;?php</span><br />
				<span style="font-weight: bold; color: #000;">include_once</span>&nbsp;$_SERVER['DOCUMENT_ROOT']."/mypogal/_libs/initial.php";<br />
				<span style="font-weight: bold; color: #000;">mypogal::content_group_name(</span><span style="font-weight: bold; color: #000;">);</span><br />
				<span style="color: red;">?&gt;</span>
				</p>
			</li>
		</ul>
		
		<h4>콘텐츠 분류명 출력</h4>
		<ul>
			<li><h4>mypogal::category_name([콘텐츠 그룹코드][,분류 코드])</h4>
				<ol>
					<li>콘텐츠 그룹 코드(선택): 콘텐츠 그룹 코드를 콘텐츠 관리를 참고하여 작성하거나 $_GET['cgroup']이 존재한다면 생략 가능</li>
					<li>콘텐츠 분류 코드(선택): 콘텐츠 그룹 코드를 콘텐츠 관리를 참고하여 작성하거나 $_GET['category']이 존재한다면 생략 가능</li>
				</ol>
			</li>
			<li>
				<h4>샘플 코드</h4>
				<p>
				<span style="color: red;">&lt;?php</span><br />
				<span style="font-weight: bold; color: #000;">include_once</span>&nbsp;$_SERVER['DOCUMENT_ROOT']."/mypogal/_libs/initial.php";<br />
				<span style="font-weight: bold; color: #000;">mypogal::category_name(</span><span style="font-weight: bold; color: #000;">);</span><br />
				<span style="color: red;">?&gt;</span>
				</p>
			</li>
		</ul>
		
		<h4>목록 출력</h4>
		<ul>
			<li><h4>mypogal::catalog(콘텐츠 그룹코드, 목록 디자인 코드 경로[, 출력 목록 갯수][, 페이징 디자인 코드 경로][,분류 코드])</h4>
				<ol>
					<li>콘텐츠 그룹 코드(필수): 콘텐츠 그룹 코드를 콘텐츠 관리를 참고하여 작성한다.</li>
					<li>목록 디자인 코드 경로(필수): 목록 출력시 반복되어 사용되는 디자인 코드가 작성되어 있는 외부 경로를 지정한다.</li>
					<li>출력 목록 갯수(옵션): 목록 출력 갯수를 숫자로 지정한다. 페이징을 적용시 설정하지 않으면 기본 값은 10이다.</li>
					<li>페이징 디자인 코드 경로(옵션)
						<ul>
							<li>현재 목록 스킨 코드 끝쪽에 페이징 처리를 하고자 할때 페이징 적용 디자인 코드의 외부 경로를 문자열로 지정한다.</li>
							<li>현재 목록 스킨 코드 내부가 아닌 독립적인 영역에 페이징 처리를 하고자 할 경우에는 Boolean 타입의 true 값을 설정한다. 이 경우에는 아래의 분리 페이징 출력 메뉴얼을 참고한다.</li>
						</ul>
					</li>
					<li>분류 코드(옵션): 특정 분류별 목록 출력시 지정한다. $_GET['category']가 존재한다면 자동으로 분류 처리한다.</li>
				</ol>
			</li>
			<li>
				<h4>샘플 코드</h4>
				<p>
				<span style="color: red;">&lt;?php</span><br />
				<span style="font-weight: bold; color: #000;">include_once</span>&nbsp;$_SERVER['DOCUMENT_ROOT']."/mypogal/_libs/initial.php";<br />
				<span style="font-weight: bold; color: #000;">mypogal::catalog(</span><span style="color: blue;">$_GET['cgroup'], "./skin.html", 20, "./paging.html"</span><span style="font-weight: bold; color: #000;">);</span><br />
				<span style="color: red;">?&gt;</span>
				</p>
			</li>
		</ul>
		
		<h4>분리 페이징 출력</h4>
		<ul>
			<li><h4>mypogal::paging(페이징 디자인 코드 경로)</h4>
				<ul>
					<li>페이징 디자인 코드 경로</li>
				</ul>
			</li>
			<li>
				<h4>샘플 코드</h4>
				<p>
				<span style="color: red;">&lt;?php</span><br />
				<span style="font-weight: bold; color: #000;">include_once</span>&nbsp;$_SERVER['DOCUMENT_ROOT']."/mypogal/_libs/initial.php";<br />
				<span style="font-weight: bold; color: #000;">mypogal::paging(</span><span style="color: blue;">"./paging.html"</span><span style="font-weight: bold; color: #000;">);</span><br />
				<span style="color: red;">?&gt;</span>
				</p>
			</li>
		</ul>
	</li>
	<li>
		<h3>최근 콘텐츠 출력 PHP Code </h3>
		<h4>콘텐츠 그룹 명 출력</h4>
		<ul>
			<li><h4>mypogal::content_group_name(콘텐츠 그룹코드)</h4>
				<ol>
					<li>콘텐츠 그룹 코드(필수): 콘텐츠 그룹 코드를 콘텐츠 관리를 참고하여 작성한다.</li>
				</ol>
			</li>
			<li>
				<h4>샘플 코드</h4>
				<p>
				<span style="color: red;">&lt;?php</span><br />
				<span style="font-weight: bold; color: #000;">include_once</span>&nbsp;$_SERVER['DOCUMENT_ROOT']."/mypogal/_libs/initial.php";<br />
				<span style="font-weight: bold; color: #000;">mypogal::content_group_name(</span><span style="color: blue;">1</span><span style="font-weight: bold; color: #000;">);</span><br />
				<span style="color: red;">?&gt;</span>
				</p>
			</li>
		</ul>
		
		<h4>최근 콘텐츠 출력</h4>
		<ul>
			<li><h4>mypogal::latest(콘텐츠 그룹코드, 목록 디자인 코드 경로 , 출력 목록 갯수[, 분류코드])</h4>
				<ol>
					<li>콘텐츠 그룹 코드(필수): 콘텐츠 그룹 코드를 콘텐츠 관리를 참고하여 작성한다.</li>
					<li>목록 디자인 코드 경로(필수): 목록 출력시 반복되어 사용되는 디자인 코드가 작성되어 있는 외부 경로를 지정한다.</li>
					<li>출력 목록 갯수(필수): 목록 출력 갯수를 숫자로 지정한다.</li>
					<li>분류코드(선택): 목록의 분류코드를 지정한다. $_GET['category']가 존재한다면 적용되지 않는다.</li>
				</ol>
			</li>
			<li>
				<h4>샘플 코드</h4>
				<p>
				<span style="color: red;">&lt;?php</span><br />
				<span style="font-weight: bold; color: #000;">include_once</span>&nbsp;$_SERVER['DOCUMENT_ROOT']."/mypogal/_libs/initial.php";<br />
				<span style="font-weight: bold; color: #000;">mypogal::latest(</span><span style="color: blue;">1, "./skin.html", 10</span><span style="font-weight: bold; color: #000;">);</span><br />
				<span style="color: red;">?&gt;</span>
				</p>
			</li>
		</ul>
	</li>
	<li>
		<h3>페이지 네비게이션 CSS Theming</h3>
		<ul>
			<li>현재 페이지 번호: .mypogal-ui-paging-currentpage</li>
			<li>페이지 번호: .mypogal-ui-paging-page</li>
			<li>페이지 번호 링크: .mypogal-ui-paging-page &gt; a</li>
			<li>이전 페이지 그룹: .mypogal-ui-paging-prev</li>
			<li>다음 페이지 그룹: .mypogal-ui-paging-next</li>
		</ul>
	</li>
</ol>




