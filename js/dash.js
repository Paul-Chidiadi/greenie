const lists = document.querySelectorAll(".list");
const loader = document.querySelector("#loader");

//WEB preloader
window.onload = () => {
  loader.style.display = "none";
};

//Toggle for sidebar menus
lists.forEach((item) => {
  item.addEventListener("click", function () {
    lists.forEach((item) => {
      item.classList.remove("active");
      this.classList.add("active");
    });
  });
});

//SIDEBAR SELCTORS
const profile = document.querySelector("#pr");
const uploads = document.querySelector("#up");
const meet = document.querySelector("#me");
const trees = document.querySelector("#tr");
const paymethod = document.querySelector("#pa");
const donate = document.querySelector("#do");
const logout = document.querySelector("ul :nth-child(7)");
//THE MENU LAYOUTS
const profileLayout = document.querySelector("#profile");
const uploadsLayout = document.querySelector("#upload");
const meetLayout = document.querySelector("#meet");
const treesLayout = document.querySelector("#trees");
const paymethodLayout = document.querySelector("#paymethod");
const donateLayout = document.querySelector("#donate");
const logoutLayout = document.querySelector("#logout");

logout.onclick = () => {
  logoutLayout.classList.toggle("active");
};
profile.onclick = () => {
  profileLayout.classList.add("active");
  uploadsLayout.classList.remove("active");
  meetLayout.classList.remove("active");
  treesLayout.classList.remove("active");
  paymethodLayout.classList.remove("active");
  donateLayout.classList.remove("active");
  console.log("good");
};
uploads.onclick = () => {
  profileLayout.classList.remove("active");
  uploadsLayout.classList.add("active");
  meetLayout.classList.remove("active");
  treesLayout.classList.remove("active");
  paymethodLayout.classList.remove("active");
  donateLayout.classList.remove("active");
  console.log("good");
};
meet.onclick = () => {
  profileLayout.classList.remove("active");
  uploadsLayout.classList.remove("active");
  meetLayout.classList.add("active");
  treesLayout.classList.remove("active");
  paymethodLayout.classList.remove("active");
  donateLayout.classList.remove("active");
  console.log("good");
};
trees.onclick = () => {
  profileLayout.classList.remove("active");
  uploadsLayout.classList.remove("active");
  meetLayout.classList.remove("active");
  treesLayout.classList.add("active");
  paymethodLayout.classList.remove("active");
  donateLayout.classList.remove("active");
  console.log("good");
};
paymethod.onclick = () => {
  profileLayout.classList.remove("active");
  uploadsLayout.classList.remove("active");
  meetLayout.classList.remove("active");
  treesLayout.classList.remove("active");
  paymethodLayout.classList.add("active");
  donateLayout.classList.remove("active");
  console.log("good");
};
donate.onclick = () => {
  profileLayout.classList.remove("active");
  uploadsLayout.classList.remove("active");
  meetLayout.classList.remove("active");
  treesLayout.classList.remove("active");
  paymethodLayout.classList.remove("active");
  donateLayout.classList.add("active");
  console.log("good");
};

//COUNTRY CODE PICKER
const phoneInputField = document.querySelector("#phone");
const phoneInput = window.intlTelInput(phoneInputField, {
  utilsScript:
    "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
});
//TOGGLE PASSWORD VIEW
const pwdField = document.querySelector("form .path input[type='password']");
const show = document.querySelector(".bxs-show");
const hide = document.querySelector(".bxs-hide");
const toggle = document.querySelector("#toggle");

toggle.onclick = () => {
  if (pwdField.type == "password") {
    pwdField.type = "text";
    show.style.display = "block";
    hide.style.display = "none";
  } else {
    pwdField.type = "password";
    show.style.display = "none";
    hide.style.display = "block";
  }
};

//COPY LINK TO CLIPBOARD
const link = document.querySelector("#link");
const copyBtn = document.querySelector("#copybtn");
const reply = document.querySelector(".reply");
copyBtn.onclick = () => {
  navigator.clipboard.writeText(link.textContent);
  reply.style.display = "block";
  setInterval(() => {
    reply.style.display = "none";
  }, 3200);
};
