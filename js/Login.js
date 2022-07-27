document.getElementById("signup").addEventListener("dblclick", (e) => {
  window.open("Signup.php", "_self");
});

document.addEventListener("submit", (e) => {
  e.preventDefault();
  e.target.q.value = CryptoJS.SHA256(e.target.pass.value).toString();
  e.target.submit();
});