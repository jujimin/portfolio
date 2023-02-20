window.addEventListener("load", () => {
  var isShownAllTooltips = false;
  var tooltipCount = 0;
  var aElTooltip = [];

  // 다크모드 //////////////////////////////////////////////////

  const elLight = document.getElementById("light");

  // 메인 돌아왔을 시 세션스토리지 확인하여 다크모드 적용
  var isDarkmode = window.sessionStorage.getItem("darkmode");
  if(isDarkmode) {
    document.body.classList.add("darkmode");
  } else {
    document.body.classList.remove("darkmode");
  }

  // 메인아트워크 뷰포트 사이즈 줄었을 때 센터 풀기
  const elSvgWrapper = document.querySelector(".main-svg");
  window.addEventListener("resize", setPositionToSVG);
  window.dispatchEvent(new Event("resize"));
  
  function setPositionToSVG() {    
    let svgHeight = elSvgWrapper.getBoundingClientRect().height;
    if(Math.floor(svgHeight) >= window.innerHeight) {
      elSvgWrapper.classList.remove("main-svgheight-center");
    } else {
      elSvgWrapper.classList.add("main-svgheight-center");
    }
  }
  
  // 메뉴용 오브젝트
  const elDialogMenu = document.querySelectorAll(".dialog-menu");
  var elPopup = document.querySelector(".popup");
  var elPopupContent = elPopup.children[1];
  const elCloseBtn = document.querySelector("#popup-close-btn");

  elDialogMenu.forEach(item => {
    let sub = item.dataset.sub;
    if(sub == "about" || sub == "contact"){
      item.addEventListener("click", showDialog);
    }
    item.addEventListener("mouseenter", showToolTip);
    item.addEventListener("mouseleave", hideToolTip);
    
    // 툴팁 전체 띄우기용 이벤트트리거
    let evtMouseover = new Event("mouseenter");
    item.dispatchEvent(evtMouseover);
  });


  //////////////////////////// 툴팁 ////////////////////////////
  
  function showToolTip(e) {
    let label = e.currentTarget.dataset.sub;
    
    if(tooltipCount < 5) {
      // 툴팁요소 만들기
      let elMenuWrap = document.createElement("div");
      elMenuWrap.classList.add("menu-help-wrap");
      elMenuWrap.classList.add("menu-help");
      // 연관배열에 넣기
      aElTooltip[label] = elMenuWrap;
      // 툴팁개수변수 ++
      tooltipCount++;
    }
    
    // 로드된 후 툴팁 사라지게
    // isShownAllTooltips = false
    if(!isShownAllTooltips) {
      window.setTimeout(hideToolTip, 2000);
    }

    // 툴팁요소 위치 지정
    let left = e.currentTarget.getBoundingClientRect().left;
    let top = e.currentTarget.getBoundingClientRect().top;
    let width;
  
    switch(label) {
      case "about":
        left -= 30;
        top -= 40;
        width = 70;
        break;
      case "works":
        left += 50;
        top -= 38;
        width = 70;
        break;
      case "blog":
        left -= 25;
        top -= 35;
        width = 70;
        break;
      case "contact":
        left += 10;
        top -= 35;
        width = 80;
        break;
      case "darkmode":
        left -= 13;
        top -= 40;
        width = 93;
        break;
    } 
    aElTooltip[label].style.width = width + "px";
    aElTooltip[label].style.left = left + "px";
    aElTooltip[label].style.top = top + "px";

    // 툴팁에 텍스트 넣기
    aElTooltip[label].setAttribute("data-label", label);
    // 바디에 추가
    document.body.append(aElTooltip[label]);
    // 트랜지션을 위한 지연주기
    window.setTimeout(() => aElTooltip[label].style.opacity = 1, 100);    
  }

  function hideToolTip() {
    for(let sub in aElTooltip) {
      aElTooltip[sub].style.opacity = 0;
    }
    // 로드된 툴팁 사라진 후 true 처리
    isShownAllTooltips = true;
  }

  // 리사이즈될 때 툴팁 사라지기
  window.addEventListener("resize", hideToolTip);
  
  //////////////////////////// 팝업창 열기 ////////////////////////////
  // 명함 - about, 편지 - contact
  let sub;
  function showDialog(e) {
    //console.log(e.type);

    // about과 contact 구분
    // >> dataset으로 사용자정의 attribute 값 조회
    sub = e.currentTarget.dataset.sub;
    let elMenuBaseX,
        elDialogBaseX;
    console.log(`sub= ${sub}`);
    let elMenu = document.querySelector(`#${sub}`);
    let elMenuTop = elMenu.getBoundingClientRect().top;

    let elDialogTop = elPopup.getBoundingClientRect().top;
    let elMenuWidth = elMenu.getBoundingClientRect().width;
    let elMenuHeight = elMenu.getBoundingClientRect().height;    

    // 콘텐츠 로드될 때 기존 콘텐츠 보이지 않도록 로딩페이지 처리
    elPopupContent.innerHTML = '<div class="load"></div>';

    // about
    if (sub == "about") {
      // 명함 요소 위치에서 팝업창 열리기
      // >> 요소와 팝업창 위치값 조회하여 팝업창 열리는 위치값 지정
      elMenu = document.querySelector(`#${sub}`);
      elMenuBaseX = elMenu.getBoundingClientRect().left;
      elDialogBaseX = elPopup.getBoundingClientRect().left;

      elPopup.style.transformOrigin =
        `-${elDialogBaseX - elMenuBaseX - (elMenuWidth / 2)}px
          ${elDialogTop - elMenuTop - (elMenuHeight / 2)}px`;

    // contact
    } else if (sub == "contact") {
      // 편지 요소 위치에서 팝업창 열리기
      elMenu = document.querySelector(`#${sub}`);
      elMenuBaseX = elMenu.getBoundingClientRect().right;
      elDialogBaseX = elPopup.getBoundingClientRect().right;
      
      elPopup.style.transformOrigin =
      `${elMenuBaseX - elDialogBaseX - (elMenuWidth / 2)}px
      -${elDialogTop - elMenuTop - (elMenuHeight / 2)}px`;
    }

    // 팝업창 클래스 추가
    elPopup.classList.add(`popup-${sub}-show`);
    
    elPopup.addEventListener("transitionend", function() {
      loadContent(sub);
    }, { once: true });

    function loadContent(sub) {
      window.fetch(`/sub/${sub}.php`)
        .then(response => {
          if(!response.ok) {
            elPopupContent.innerHTML = "<h2>Failure to loading.</h2>";  
          }
          return response.text();
        })
        .then(content => {
          elPopupContent.innerHTML = content;

          /////////////////////////////// contact /////////////////////////////////

          const elFormContact = document.getElementById("fContact");

          if(elFormContact) {
            // submit 버튼 누를 때 submit 이벤트 발생하므로 함수 실행
            elFormContact.addEventListener("submit", e => {
            // 기존 이벤트 제거
             e.preventDefault();
             // 유효성검사 조건 충족한 경우 true 반환
             // console.log(e.currentTarget.checkValidity());
             if(e.currentTarget.checkValidity()) {
              // formData 객체에는 FormData 생성자함수 가지고 있음. 이 생성자함수를 통해 인스턴스 생성
              // 인수로 전송할 폼 요소를 지정하여 그것으로 인스턴스 생성 후 바디로 지정
              let formData = new FormData(e.currentTarget);
              // fetch 메소드는 promise 객체를 반환. 
              window.fetch("/mypogal/_process/index.php", {
                method: "POST",
                body: formData
              })
              // promise의 then 메소드는 response객체로 응답받음
              // response 객체는 분석메소드를 가지고 있음. text 메소드로 텍스트로 분석하여 반환
              .then(response => response.text())
              // 반환된 것을 메세지 값에 따라 사후 처리
              .then(msg => {
                // string을 toUpperCase 메소드를 써서 대문자로 만들어 반환
                if(msg.toUpperCase() == "OK") {
                  window.alert("전송되었습니다.");
                  // 전송 완료 페이지 이동하는 경우
                  // location.href = "/?sub=contact-result";
                } else {
                  window.alert("네트워크 사정으로 전송에 실패했습니다.");
                }
              });
             }
          });
          }
        });
    }    
  }

  // 팝업창 닫기
  elCloseBtn.addEventListener("click", closeDialog);

  function closeDialog(e) {
    var elDialog = e.currentTarget.parentElement;
    let attrClassList = elDialog.classList;

    elDialog.classList.add("popup-close");

    window.setTimeout(() => {
      attrClassList.remove(`popup-${sub}-show`);
      attrClassList.remove("popup-close");
      elPopup.style.transformOrigin = "0% 0%";
    }, 500);
  }
  
  
  // 노트북 - works (페이지 이동)
  const elLaptop = document.querySelector("#laptop");
  elLaptop.addEventListener("click", function() {
    location.href = "/?sub=works&cgroup=2";
  });

  // 메모 - blog (페이지 이동)
  const elMemo = document.querySelector("#memo");
  elMemo.addEventListener("click", function() {
    location.href = "/?sub=blog&cgroup=3";
  });




  
  // 클릭시 세션스토리지에 값 저장
  elLight.addEventListener("click", () => {
    isDarkmode = window.sessionStorage.getItem("darkmode");
    
    if(isDarkmode) {
      window.sessionStorage.removeItem("darkmode");
      document.body.classList.remove("darkmode");
    } else {
      window.sessionStorage.setItem("darkmode", "on");
      document.body.classList.add("darkmode");
    }
  });

});