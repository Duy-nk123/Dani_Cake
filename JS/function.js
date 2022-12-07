const loginBtn = document.querySelector(".js-login-btn");
const login = document.querySelector(".login");
const container = document.querySelector(".login-container");
const closeX = document.querySelector(".login-close");
function showLogin() {
  login.classList.add("open");
}
function closeLogin() {
  login.classList.remove("open");
}
loginBtn.addEventListener("click", showLogin);
closeX.addEventListener("click", closeLogin);
login.addEventListener("click", closeLogin);
container.addEventListener("click", function (event) {
  event.stopPropagation();
});
