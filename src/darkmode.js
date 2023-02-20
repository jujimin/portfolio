// 다크모드 ////////////////////////////////////////////
window.addEventListener("load", function(){
  // 세션스토리지에 저장된 값 확인
  var isDarkmode = window.sessionStorage.getItem("darkmode");
  // 값이 있다면 다크모드 클래스 추가, 아니라면 클래스 제거
  if(isDarkmode) {
    document.body.classList.add("darkmode");
  } else {
    document.body.classList.remove("darkmode");
  }
});