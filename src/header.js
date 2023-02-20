window.addEventListener("load", () => {
  const homeBtn = document.getElementById("home-btn");
  const homeBtnClose = document.querySelector(".home-btn-close");
  const homeBtnOpen = document.querySelector(".home-btn-open");

  homeBtn.addEventListener("mouseover", () => {
    homeBtnClose.style.display = "none";
    homeBtnOpen.style.display = "block";
  });

  homeBtn.addEventListener("mouseout", () => {
    homeBtnClose.style.display = "block";
    homeBtnOpen.style.display = "none";
  });

});