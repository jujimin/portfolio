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

jQuery.ajax({
	timeout: 8000,
	error: function(objRequest, errortype) {
		if (errortype == "timeout") Common.showMsg("서버와의 통신이 불안정합니다.");
	}
});


$(function() {
	
	$("#btnLogout").click(function() {
		$.post("./_process/index.php", {
			process: "permission", act: "logout"
		}, function() {
			location.reload();
		});
	});
	
	
	Manage.loadContentMain();
	
	$(".header-menubar li").click(Manage.onMenuClick);
	$(document).on("click", ".body-content-sidebar li", Manage.onContentSidebarMenuClick);
	$(document).on("click", ".body-manual-sidebar li", Manage.onManualSidebarMenuClick);
	$(document).on("click", ".body-board-sidebar li", Manage.onBoardSidebarMenuClick);
	$(document).on("click", "#btnAddGroup", CGroups.add);
	$(document).on("click", ".btn-open-categories", Category.open);
	$(document).on("click", ".btn-open-meta", Meta.open);
	$(document).on("click", ".btn-group-del", CGroups.del);
	$(document).on("click", "#btnAddCategory", Category.add);
	$(document).on("click", "#btnAddMeta", Meta.add);
	$(document).on("click", ".btn-del-category", Category.del);
	$(document).on("click", ".btn-del-meta", Meta.del);
	$(document).on("click", "#btnAddPost", Content.openEditor);
	$(document).on("click", ".btn-content-edit", Content.openEditor);
	$(document).on("click", ".btn-content-del", Content.del);
	$(document).on("click", ".btn-contact-open", Contact.open);
	$(document).on("click", ".btn-contact-del", Contact.del);
	//$(document).on("click", "#btnPost", Content.post);
	
	$(".common-sidebar > li").tooltip({
		position: {
			my: "left", at: "right+10"
		}
	});
	
	
	$.getJSON("http://api.cydemy.com/mypogal/index.php", { gettype : "update" }, function(responseJSON) {
		if (responseJSON.buildnum > parseInt(_buildnum)) {
			$(".header-logo").append('<span>새로운 버전이 출시되었습니다. "알림판&gt;업데이트 알림" 메뉴를 보세요.</span>').find('span').css({
				fontSize: "12px", marginLeft: "20px", color: "orange"
			});
		}
	}).fail(Common.onAjaxFail);;	
});

var Common = {
	dialoginit: function(title) {
		if (!$("#dialog").length) {
			$("body").append('<div id="dialog">');
		}
		
		if ($("#dialog").dialog("instance") != undefined) $("#dialog").dialog("destroy");
		$("#dialog").dialog({
			title: title, autoOpen: false, width: 800, height: 600, modal: true,
			dialogClass: "jquidialog-mypogal-titlebar",
			create: function() {
				$(".ui-dialog-title").wrap("<h2>");
			}
		});
	},
	progressShowModal: function() {
		if (!$("#progress").length) {
			$("body").append('<div id="progress">');
		}
		$("#progress").html("<h1>처리중..</h1>").css({
			position: "absolute", left: 0, top: 0, right: 0, bottom: 0, zIndex: 999999, backgroundColor: "rgba(0, 0, 0, 0.8)", color: "#FFF",
			textAlign: "center"
		});		
	},
	progressHide: function() {
		$("#progress").remove();
	},
	
	showMsg: function(msg) {
		if (!$("#msg").length) {
			$("body").append('<div id="msg">');
		}	
		if ($("#msg").dialog("instance") != undefined) $("#msg").dialog("destroy");
		$("#msg").html(msg).dialog({
			title: "안내", modal: true,
			dialogClass: "jquidialog-mypogal-titlebar",
			buttons: {
				"확인": function(){
					$(this).dialog("close");
				}
			}
		});	
	},
	confirm: function(msg, handler) {
		if (!$("#confirm").length) {
			$("body").append('<div id="confirm">');
		}	
		if ($("#confirm").dialog("instance") != undefined) $("#confirm").dialog("destroy");
		$("#confirm").html(msg).dialog({
			title: "처리전 확인", modal: true,
			dialogClass: "jquidialog-mypogal-titlebar",
			buttons: {
				"취소": function() {
					$(this).dialog("close");
				},
				"확인": handler
			},
			open: function() {
				$(this).html(msg);
			}
		});	
	},
	loading: function() {
			return '<div style="position: absolute; left: 50%; top: 50%;"><img src="/mypogal/images/wait_big.gif" /></div>';
	},
	showDialogProgress: function() {
		if ($('.ui-dialog-post-result').length) $('.ui-dialog-post-result').remove();
		$('.ui-dialog-buttonset > button:first').before('<span class="ui-dialog-post-result" style="margin-right: 30px;">처리중..</span>');
		//console.log("showDialogProgress");
	},
	hideDialogProgress: function() {
		if ($('.ui-dialog-post-result').length) $('.ui-dialog-post-result').remove();
	},
	onAjaxFail: function() {
		Common.showMsg("서버와의 연결이 원활치 않습니다.<br />다시 시도해주십시오.");
	},
	showResultDialog: function(msg) {
		var $resultDialog = $('.result-dialog');
		if (!$resultDialog.length) {
			$("body").append('<div class="result-dialog"></div>');
			$resultDialog = $('.result-dialog');
		}
		
		$resultDialog.html('<h4>' + msg + '</h4>').css({
			position: "absolute", left: "50%", top: "50%", background: "#FFF", border: "5px solid #ffe86b", zIndex: 999999, padding: "0 30px",
			transform: "translate(-50%, -50%)"
		}).fadeIn();
		
		setTimeout(function() {
			$resultDialog.fadeOut()
		}, 1000);
	}
};


var Manage = {
	init: function() {
		/*$(".body-content-sidebar").css("height", function() {
			return $(".body-content-main").height() + 300;
		});*/
	},
	loadContentMain: function() {
		$(".body").load("./contents/manage-content.php", function() {
			$(".body-content-main").html(Common.loading()).load("./contents/manage-content-list.php");
		});
	},
	loadContactMain: function() {
		if ($("#dialog").dialog("isOpen")) $("#dialog").dialog("close"); 
		$(".body").html(Common.loading()).load("./contents/manage-contact.php", {
			page: Contact.curPage
		});
	},
	loadManualMain: function() {
		if ($("#dialog").dialog("isOpen")) $("#dialog").dialog("close"); 
		$(".body").html(Common.loading()).load("./contents/manual-content.php");
	},
	loadBoardMain: function() {
		if ($("#dialog").dialog("isOpen")) $("#dialog").dialog("close"); 
		$(".body").html(Common.loading()).load("./contents/board-content.php");
	},
	onMenuClick: function(event) {
		var page = $(event.currentTarget).attr("data-page");
		
		if (page == "content") Manage.loadContentMain();
		else if (page == "contact") Manage.loadContactMain();
		else if (page == "manual") Manage.loadManualMain();
		else Manage.loadBoardMain();
		
		$(event.currentTarget).parent().children().removeClass("select");
		$(event.currentTarget).addClass("select");
	},
	onContentSidebarMenuClick: function(event) {
		//console.log("OK");
		var $el = $(event.currentTarget);
		var page = $el.attr("data-page");
		$(".body-content-main").html(Common.loading()).load("./contents/manage-content-" + page + ".php", function() {
			Manage.init();
		});
		
		$el.parent().children().removeClass("select");
		$el.addClass("select");
	},
	onManualSidebarMenuClick: function(event) {
		//console.log("OK");
		var $el = $(event.currentTarget);
		var page = $el.attr("data-page");
		$(".body-manual-main").html(Common.loading()).load("./contents/manual-content-" + page + ".php", function() {
			Manage.init();
		});
		
		$el.parent().children().removeClass("select");
		$el.addClass("select");
	},
	onBoardSidebarMenuClick: function(event) {
		//console.log("OK");
		var $el = $(event.currentTarget);
		var page = $el.attr("data-page");
		$(".body-board-main").html(Common.loading()).load("./contents/board-content-" + page + ".php", function() {
			Manage.init();
		});
		
		$el.parent().children().removeClass("select");
		$el.addClass("select");
	}
};

var Content = {
	mode: null,
	post: function() {
		//var ckeditor = CKEDITOR.instances['content'];
		//var content = ckeditor.document.getBody().getHtml();
		var content = CKEDITOR.instances.content.getData().replace(/\"/g, "&quot;");
		//console.log(content);
		$("#fContentRegister").ajaxSubmit({
			url: "./_process/index.php",
			data: {
				process: "content-post", content: content
			},
			type: "post",
			dataType: "json",
			//target: ".ui-dialog-post-result",
			beforeSubmit: function() {
				if ($("#cgroup > option").is(":selected:first-child")) {
					Common.showMsg("콘텐츠 그룹을 선택하세요.");
					return false;
				}
				
				if (!$("#title").val()) {
					Common.showMsg("콘텐츠 제목을 입력하세요.");
					$("#title").focus();
					return false;
				}
				
				return true;
			},
			success: function(response) {
				//console.log(response);
				$('.ui-dialog-post-result').html(response.msg);
				//$('.ui-dialog-post-result').remove();
				if (response.thumbnailurl) {
					if (response.thumbnailurl == "SIZE_OVER_LIMIT") {
						Common.showMsg("업로드할 셈네일 이미지의 크기는 가로와 세로가 300픽셀을 넘을수 없습니다.");
					} else {
						var thumbnail = '<img src="' + response.thumbnailurl + '" />';
						$("#curthumbanil", "#fContentRegister").html(thumbnail);
					}
				}
				
				if (Content.mode == "edit") {
					$.doTimeout(5000, Common.hideDialogProgress);
				}
				
				if (Content.mode == "add" && response.msg == "OK") {
					$("#dialog").dialog("close");
				}
				
				Common.showResultDialog(response.msg);
			},
			error: function() {
				Common.showResultDialog("서버와의 연결이 원할하지 않습니다.");
			}			
		});
	},
	openEditor: function(event) {
		var $el = $(event.currentTarget);
		Content.mode = $el.attr("data-mode");
		var title, sendData;
		if (Content.mode == "edit") {
			title = $el.attr("data-title");
			sendData = {
				mode:"edit", cgroup: $el.attr("data-cgroup"), cno: $el.attr("data-cno")
			};
		} else {
			if (!addContentGroup) {
				Common.showMsg("콘텐츠 그룹을 선택하십시오.");
				return;
			}
			
			sendData = { mode : "add", cgroup: addContentGroup, cno: null };
			title = "새로운 콘텐츠 작성";
		}
		Common.dialoginit(title);
		
		var width = $(window).width() > 1300 ? 1300 : $(window).width();
		$("#dialog").dialog("option", {
			width: width,
			height: $(window).height() - 100,
			draggable: false, resizable: false,
			position: {
				my: "left+170 top+100",
				at: "left top",
				of: window
			},
			buttons: {
				"닫기": function() {
					$(this).dialog("close");
				},
				"저장": function() {
					Common.showDialogProgress();
					
					Content.post();
				}
			},
			close: Content.onCloseEditor
		});
		$("#dialog").html(Common.loading()).dialog("option", "open", function() {
			$(this).load("./contents/manage-content-post.php", sendData);
		});
		$("#dialog").dialog("open");		
	},
	onCloseEditor: function() {
		if (Content.mode == "add") {
			addContentGroup = null;
			$(".body-content-sidebar li[data-page='list']").trigger("click");
		} else {
			$(".body-content-sidebar li[data-page='list']").trigger("click");
		}		
	},
	curPage: null,
	loadList: function(page) {
		Content.curPage = page || 1;
		$(".body-content-main").html(Common.loading()).load("./contents/manage-content-list.php", { page: page });
	},
	del: function(event) {
		var cno = $(event.currentTarget).attr("data-cno");
		Common.confirm("삭제하시겠습니까?", function() {
			$(this).dialog("close");
			$.post("./_process/index.php", {
				process: "content-post", act: "del", cno: cno
			}, function(response) {
				if (response.msg == "OK") Content.loadList(Content.curPage);
				
			}, "json")
			.fail(Common.onAjaxFail);
		});
	}
};

var CGroups = {
	add: function() {
		Common.dialoginit("콘텐츠 그룹 등록");
		
		$("#dialog").dialog("option", {
			buttons: {
				"취소": function() {
					$(this).dialog("close");	
				},
				"등록" : function() {
					$("#fAddGroup").ajaxSubmit({
						url: "./_process/index.php", type: "post",
						data: { process: "content-group", act: "add" },
						beforeSubmit: function() {
							//Common.progressShow();
							
							var valid = true;
							$(".required", "#fAddGroup").each(function() {
								if (!$(this).val()) {
									$(this).effect("highlight");
									valid = false;
									return false;
								}
							});
							
							if (valid) {
								Common.showDialogProgress();
								//Common.progressHide();
							}
							
							return valid;
						},
						success: function(response) {
							//Common.progressHide();
							if (response == "OK") {
								$("#dialog").dialog("close");
								$(".body-content-sidebar li[data-page='groups']").trigger("click");
							} else {
								Common.showMsg("처리하지 못했습니다.");
							}
							Common.hideDialogProgress();
						}
					});
				}
			}
		});
		$("#dialog").dialog("option", "open", function() {
			$(this).html(Common.loading()).load("./contents/manage-content-groups-add.php");
		});
		$("#dialog").dialog("open");
	},
	
	/**
	 * 콘텐츠 그룹 제거
	 * 16/08/26 추가.
	 * @param {Object} event
	 */
	del: function(event) {
		var cgroup = $(event.currentTarget).attr("data-cgroup");
		Common.confirm("삭제하시겠습니까?", function() {
			$(this).dialog("close");
			$.post("./_process/index.php", {
				process: "content-group", act: "del", cgroup: cgroup
			}, function(response) {
				if (response.msg == "OK") {
					$(".body-content-sidebar li[data-page='groups']").trigger("click");
				} else {
					Common.showMsg("처리하지 못했습니다.");
				}
				
			}, "json")
			.fail(Common.onAjaxFail);
		});		
	}
};

var Meta = {
	open: function(event) {
		var cgroup = $(event.currentTarget).attr("data-cgroup");
		
		Common.dialoginit("콘텐츠 메타 관리");
		$("#dialog").dialog("option", {
				buttons: {
					"닫기": function(){
						$(this).dialog("close");
						$(".body-content-sidebar li[data-page='groups']").trigger("click");
					}
				}				
			});
		$("#dialog").dialog("option", "open", function() {
			$(this).html(Common.loading()).load("./contents/manage-content-meta.php", {
				cgroup: cgroup
			}, function(responseText, statusText, xhr) {
				if (statusText == "error") Common.showMsg("페이지를 가져오는데 실패했습니다.");
			});
		});
		$("#dialog").dialog("open");			
	},
	load: function(cgroup) {
		$.getJSON("./_process/index.php", {
			process: "content-meta-list", cgroup: cgroup
		}, function(responseJSON) {
			if (responseJSON.length) {
				var html = "";
				for(var i = 0; i < responseJSON.length; i++) {
					html += '<tr>';
					html += '<td>' + responseJSON[i].type + '</td>';
					html += '<td>' + responseJSON[i].meta + '</td>';
					html += '<td>' + responseJSON[i].summary + '</td>';
					html += '<td class=\"buttons\"><button type="button" class="btn-del-meta" data-cgroup="' + cgroup + '" data-meta="' + responseJSON[i].meta + '"><h4>삭제</h4></button></td>';
					html += '</tr>';
				}
			} else {
				html += '<tr><td><h3>등록된 메타가 없습니다.</h3></td></tr>';
			}
			
			$(".manage-content-meta-list > tbody").children().remove();
			$(".manage-content-meta-list > tbody").append(html);
		}).fail(Common.onAjaxFail);
	},
	add: function(event) {
		var cgroup = $(event.currentTarget).attr("data-cgroup");
		
		var metaname = $("#metaname").val();
		if (!metaname) {
			Common.showMsg("메타 키를 입력하세요.");
			return;
		}
		
		// 공백과 첫 글자 숫자 금지 처리
		var regexp = /^[a-z]+[a-z0-9]{2,19}$/g;
		if (!metaname.match(regexp)) {
			Common.showMsg("메타 키는 영문으로 시작하여 영문+숫자 조합의 3~20자 이내이어야 합니다.");
			return;
		}
		
		// 타입 선택 결과
		var type = $("#type").val();
		
		var data = {
			process: "content-meta", act: "add", cgroup: cgroup, metaname: metaname, type: type
		};
		
		var metasummary = $("#metasummary").val();
		if (metasummary) {
			data = $.extend(data, { metasummary: metasummary });
		}
		
		var cgroup = $(event.currentTarget).attr("data-cgroup");
		$.post("./_process/index.php", data, function(response) {
			if (response == "OK") {
				Meta.load(cgroup);
				$("#metaname").val(null);
				$("#metasummary").val(null);
			} else {
				Common.showMsg("등록하지 못했습니다.");
			}
		}).fail(Common.onAjaxFail);
	},
	del: function(event) {
		var cgroup = $(event.currentTarget).attr("data-cgroup");
		var meta = $(event.currentTarget).attr("data-meta");
		Common.confirm("정말로 삭제하시겠습니까?<br />삭제하게 되면 현재 그룹에서 등록된 모든 자료의 메타 데이터가 제거됩니다. ", function() {
			$(this).dialog("close");
			$.post("./_process/index.php", {
				process: "content-meta", act: "del", cgroup: cgroup, meta: meta
			}, function(response) {
				if (response == "OK") {
					Meta.load(cgroup);
				} else {
					Common.showMsg("삭제하지 못했습니다.");
				}
			}).fail(Common.onAjaxFail);
		});
	}		
};


var Category = {
	curCgroup: null,
	open: function(event) {
		Category.curCgroup = $(event.currentTarget).attr("data-cgroup");
		
		Common.dialoginit("콘텐츠 분류 관리");
		$("#dialog").dialog("option", {
				buttons: {
					"닫기": function(){
						$(this).dialog("close");
						$(".body-content-sidebar li[data-page='groups']").trigger("click");
					}
				}				
			});
		$("#dialog").dialog("option", "open", function() {
			$(this).html(Common.loading()).load("./contents/manage-content-categories.php", {
				cgroup: Category.curCgroup
			});
		});
		$("#dialog").dialog("open");			
	},
	load: function(cgroup) {
		$.getJSON("./_process/index.php", {
			process: "content-category-list", cgroup: cgroup
		}, function(responseJSON) {
			if (responseJSON.length) {
				var html = "";
				for(var i = 0; i < responseJSON.length; i++) {
					html += '<tr data-cgroup="' + cgroup + '" data-category="' + responseJSON[i].category + '">';
					html += '<td class=\"category\">분류코드[' + responseJSON[i].category + ']</td>';
					html += '<th>' + responseJSON[i].name + '</th>';
					html += '<td class=\"buttons\"><button type="button" class="btn-del-category" data-cgroup="' + cgroup + '" data-category="' + responseJSON[i].category + '"><h4>삭제</h4></button></td>';
					html += '</tr>';
				}
			} else {
				html += '<tr><td><h3>등록된 분류가 없습니다.</h3></td></tr>';
			}
			
			$(".manage-content-categories-list > tbody").children().remove();
			$(".manage-content-categories-list > tbody").append(html);
		}).fail(Common.onAjaxFail);
	},
	add: function(event) {
		var categoryname = $("#categoryname").val();
		if (!categoryname) {
			Common.showMsg("분류명을 입력하세요.");
			return;
		}
		
		Common.showDialogProgress();
		
		var cgroup = $(event.currentTarget).attr("data-cgroup");
		$.post("./_process/index.php", {
			process: "content-category", act: "add", cgroup: cgroup, categoryname: categoryname
		}, function(response) {
			if (response == "OK") {
				Category.load(cgroup);
				$("#categoryname").val(null);
			} else {
				Common.showMsg("등록하지 못했습니다.");
			}
			
			Common.hideDialogProgress();
		}).fail(Common.onAjaxFail);
	},
	sorting: function(event, ui) {
		var aOrder = [];
		var category;
		$(ui.item).parent().children("tr").each(function() {
			category = $(this).attr("data-category");
			//console.log($(this).attr("data-category"));
			if (category != undefined) aOrder.push(category);
		});
		console.log(aOrder.join(","));
		Common.showDialogProgress();
		
		$.post("./_process/index.php", {
			process: "content-category", act: "order", orderlsit: aOrder.join(",")
		}, function(response) {
			if (response == "OK") {
				//console.log(Category.curCgroup);
				//Category.load(Category.curCgroup);
				$("#categoryname").val(null);
			} else {
				Common.showMsg("정렬하지 못했습니다.");
			}
			
			Common.hideDialogProgress();
		}).fail(Common.onAjaxFail);		
	},
	del: function(event) {
		var cgroup = $(event.currentTarget).attr("data-cgroup");
		var category = $(event.currentTarget).attr("data-category");
		Common.confirm("정말로 삭제하시겠습니까?", function() {
			Common.showDialogProgress();
			
			$(this).dialog("close");
			$.post("./_process/index.php", {
				process: "content-category", act: "del", category: category
			}, function(response) {
				if (response == "OK") {
					Category.load(cgroup);
				} else {
					Common.showMsg("삭제하지 못했습니다.");
				}
				
				Common.hideDialogProgress();
			}).fail(Common.onAjaxFail);
		});
	}
};


var Contact = {
	open: function(event) {
		var $el = $(event.currentTarget);
		var no = $el.attr("data-no");
		//console.log("no:" + no);
		Common.dialoginit($el.parent().prevAll(".manage-contact-list-subject").children('h3').html());
		
		$("#dialog").dialog("option", {
				buttons: {
					"확인": function() {
						Common.showDialogProgress();
						var $dialog = $(this);
						
						$.post("./_process/index.php", {
							process: "contact", act: "confirm", no: no
						}, function(response) {
							if (response == "OK") {
								$dialog.dialog("close");
							} else {
								Common.hideDialogProgress();
							}
						}).fail(Common.onAjaxFail);
						
						$(".header-menubar li[data-page='contact']").trigger("click");
					},
					"닫기": function(){
						$(this).dialog("close");
					}
				}			
			});
		$("#dialog").dialog("option", "open", function() {
			$(this).html(Common.loading()).load("./contents/manage-contact-detail.php", {
				no: no
			});
		});
		$("#dialog").dialog("open");		
	},
	del: function(event) {
		var no = $(event.currentTarget).attr("data-no");
		
		Common.confirm("삭제하시겠습니까?", function() {
			$(this).dialog("close");
			$.post("./_process/index.php", {
				process: "contact", act: "del", no: no
			}, function(response) {
				if (response == "OK") {
					$(".header-menubar li[data-page='contact']").trigger("click");
				} else {
					Common.showMsg("삭제하지 못했습니다.");
				}
			});
		});
	},
	curPage: null,
	loadList: function(page) {
		Contact.curPage = page || 1;
		$(".body").html(Common.loading()).load("./contents/manage-contact.php", { page: page });
	}
};
