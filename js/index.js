const menuBtn = document.querySelector("#menubtn");
const menu = document.querySelector("#menu");

// toggling menu btn
menuBtn.addEventListener("click", () => {
  menuBtn.classList.toggle("active");
  menu.classList.toggle("active");
});

//scroll reveal script
ScrollReveal({
  //reset: true,
  distance: "50px",
  duration: 2500,
  delay: 400,
});
ScrollReveal().reveal(
  " .intro-body-text, .comm-body-text, .earn-body-text, .store h1, .don-top h1, .contact h1, .don-btn, .comm-body, .learn-body",
  {
    delay: 400,
    origin: "left",
  }
);
ScrollReveal().reveal(".intro .images div, .form input, .form textarea", {
  delay: 400,
  origin: "bottom",
  interval: 200,
});
ScrollReveal().reveal(".info .good, .grid div, .star i, .img-align div", {
  delay: 400,
  origin: "left",
  interval: 200,
});
ScrollReveal().reveal(
  ".top-body, .intro-body p, .comm-body p, .earn-body p, .store p, .don p, .star small",
  {
    delay: 400,
    origin: "bottom",
  }
);
ScrollReveal().reveal(".comm img, .logo img, .don-top img", {
  delay: 400,
  origin: "right",
});
