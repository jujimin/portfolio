<?php 
include_once '../_libs/initial.php';
?>

<div class="body-content">
	<ul class="body-content-sidebar">
	</ul>
	<div class="body-content-main">
		<h1>피드백 관리</h1>
		<table class="manage-content-list manage-contact-list">
		<caption>
		
		</caption>
		<?php 
		$oContact = new net_irosoft_mypogal_Contact();
		$oContact->mysql_query(net_irosoft_mypogal_Contact::TB_CONTACT, "no");
		$total = $oContact->mysql_num_rows;
		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : null;
		$oPage = new net_irosoft_Paging(10, $total, $page);
		
		if ($total) {
			echo '
			<thead>
				<tr>
					<th>NO</th><th>제목</th><th>작성자</th><th>작성일</th><th>상태</th><th>관리</th>
				</tr>
			</thead>
			<tbody>';
			
			$oContact->mysql_query(net_irosoft_mypogal_Contact::TB_CONTACT, array("no","subject", "writer", "confirmed", "registered", "state"), "ORDER BY no DESC LIMIT {$oPage->start}, {$oPage->scale}");
			for ($i = 0; $rec = $oContact->mysql_result(); $i++) {
				$no = $oPage->getListNo($i);
				$stateText = (int)$rec['state'] === 0 ? "<span class=\"manage-contact-list-state-new\">새문의</span>" : "<span class=\"manage-contact-list-ok\">확인됨</span>";
				
				echo "<tr>
						<td class=\"manage-contact-list-no\">{$no}</td>
						<td class=\"manage-contact-list-subject\"><h3>{$rec['subject']}</h3></td>
						<td class=\"manage-contact-list-writer\">{$rec['writer']}</td>
						<td class=\"manage-contact-list-registered\">{$rec['registered']}</td>
						<td class=\"manage-contact-list-state\">{$stateText}</td>
						<td class=\"manage-contact-list-command\">
							<button type=\"button\" class=\"btn-contact-del\" data-no=\"{$rec['no']}\"><h4>삭제</h4></button>
							<button type=\"button\" class=\"btn-contact-open\" data-no=\"{$rec['no']}\"><h4>관리</h4></button>
						</td>
					</tr>";
			}
			
			echo "<tfoot><tr><td colspan=\"6\">".$oPage->generation('Contact.loadList')."</td></tr></tfoot>";
		} else {
			echo '<tr><td class="manage-content-empty"><h2>등록된 문의가 없습니다.</h2></td></tr>';
		}
		?>		
		</tbody>
		</table>
	</div>
</div>



