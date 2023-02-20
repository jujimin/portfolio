
(function() {

  // 현재 카테고리 활성화 컬러 처리 //////////////////////////////////////////
  
    // 현재 url의 카테고리 분류코드 찾기
    let urlSearchParams = new URLSearchParams(location.href);
    let curCategory = urlSearchParams.get("category");
  
    window.addEventListener("load", () => {
      // 카테고리 분류코드가 있는 경우
      // 카테고리 요소 중 현재 카테고리 분류코드인 것을 찾아 클래스 추가 함수 실행
      if(curCategory){
        applyCurCategory(curCategory);
      // 카테고리 분류코드가 없는 경우 : all인 경우
      // 분류코드 0으로 지정하여 찾아 클래스 추가 함수 실행
      } else {
        applyCurCategory("0");
      }

      // 클래스 추가 함수
      function applyCurCategory(categoryCode) {
        document.querySelector(`.works-categories > li[data-category='${categoryCode}']`).classList.add("works-apply-category");
      }
    });


  
  // works-list-info 카테고리이름 누를 시 해당 카테고리로 이동 ///////////////////
    const aElCategoryItems = document.querySelectorAll(".works-list > li");
    let baseUrl = "/?sub=works&cgroup=2";
  
    aElCategoryItems.forEach(elItem => {
      let categoryName = elItem.dataset.categoryname;
      let cateogry;
      switch(categoryName) {
        case "websites": cateogry = 2; break;
        case "illustrations": cateogry = 3; break;
        default: category = "all";
      }
  
      const elSameCategoryItem = document.querySelectorAll(`.works-list-item-${categoryName}-linker`);
      elSameCategoryItem.forEach(elItem => {
        elItem.setAttribute("href", `${baseUrl}&category=${cateogry}`);
      });
    });
})();



// works 리스트 순차적으로 나타나기 ///////////////////////////////////////////
window.addEventListener("load", function(){
  const elWorksItem = document.querySelectorAll(".works-list-item");
  let count = 0;
  elWorksItem.forEach(elItem => {
    let delay = count * 200;
    window.setTimeout(() => {
      elItem.style.opacity="1";
    }, delay);
    count++;
  });
});

// 다크모드 ////////////////////////////////////////////
window.addEventListener("load", function(){
  // 세션스토리지에 저장된 값 확인
  var isDarkmode = window.sessionStorage.getItem("darkmode");
  // 값이 on이라면 다크모드 클래스 추가, 아니라면 클래스 제거
  if(isDarkmode == "on") {
    document.body.classList.add("darkmode");
  } else {
    document.body.classList.remove("darkmode");
  }
});