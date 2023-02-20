window.addEventListener("load", function() {
  // 뒤로가기 버튼
  const elBtnBack = document.querySelector("#btn-back");
  elBtnBack.addEventListener("click", function() {
    history.go(-1);
  });

  // 이미지 클릭시 원본이미지
  const aElImg = document.querySelectorAll(".workdetail-image-wrapper img");
  const modal = document.querySelector(".modal");
  const modalImage = document.querySelector(".modal-image-wrapper");

  aElImg.forEach(elImg => {
    elImg.onclick = e => {
      const elCopyImg = e.currentTarget.cloneNode();
      modalImage.appendChild(elCopyImg);
      modal.style.display = "block"

      elCopyImg.onclick = e => {
        e.currentTarget.remove();
        modal.style.display = "none";
      } 
    };
	});



  // 상세내용 고정
  const elWorkDetailWrapper = document.querySelector(".workdetail-wrapper");
  const elWorkDetailContent = document.querySelector(".workdetail-content-wrapper");
  const elWorkDetailImage = document.querySelector(".workdetail-image-wrapper");
  let workDetailWrapperTop;
  let workDetailWrapperWidth;
  let workDetailContentWidth;
  let workDetailContentHeight = elWorkDetailContent.getBoundingClientRect().height;
  
  // 리사이즈될 때 wrapper width 구하기
  // content-wrapper width = wrapper width의 30%. fixed 주기
  // image-wrapper margin-left = content-wraper width + a 넣기
  let useInitGap = false;
  window.addEventListener("resize", function() {
    workDetailWrapperWidth = elWorkDetailWrapper.getBoundingClientRect().width;
    workDetailContentWidth = elWorkDetailContent.getBoundingClientRect().width;

    // marginLeft 값 오류 트릭
    if(!useInitGap) {
      workDetailContentWidth += 12;
      useInitGap = true;
    }

    if(innerWidth > 600) {
      elWorkDetailContent.style.width = workDetailWrapperWidth * 0.3 + "px";
      elWorkDetailImage.style.marginLeft = workDetailContentWidth + 20 + "px";
    } else if(innerWidth <= 600) {
      elWorkDetailContent.style.width = "100%";
      elWorkDetailImage.style.marginLeft = "0px";
      elWorkDetailContent.style.position = "static";
    }
  });
  // 이벤트 트리거
  window.dispatchEvent(new Event("resize"));


  window.addEventListener("scroll", function() {
    workDetailWrapperTop = elWorkDetailWrapper.getBoundingClientRect().top;

    if(innerWidth > 600 && workDetailWrapperTop <= 40) {
      // 콘텐츠 없는 경우 오류 방지 minheight
      elWorkDetailImage.style.minHeight = workDetailContentHeight - 70 + "px";
      elWorkDetailContent.style.position = "fixed";
      elWorkDetailContent.style.top = "40px";
    } else if(innerWidth > 600 && workDetailWrapperTop > 40) {
      elWorkDetailContent.style.position = "static";
    }
  });
});

