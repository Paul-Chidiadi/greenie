const menuBtn = document.querySelector("#menubtn");
const menu = document.querySelector("#menu");

// toggling menu btn
menuBtn.addEventListener("click", () => {
  menuBtn.classList.toggle("active");
  menu.classList.toggle("active");
});
