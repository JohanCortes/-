let code = (
  "00" +
  (new Date().getMilliseconds() * Math.ceil(Math.random() * 100)).toString()
).slice(-5);

document.getElementById("btn-ver").addEventListener("click", (e) => {
  let email = e.target.previousElementSibling.value,
    reg = new RegExp(
      "^[a-z0-9]+(\\.[_a-z0-9]+)*@[a-z0-9-]+(\\.[a-z0-9-]+)*(\\.[a-z]{2,15})$"
    ),
    $user = e.target.closest("form").user;
  if ($user.value !== "") {
    if (reg.test(email)) {
      fetch("verify.php", {
        method: "POST",
        body: JSON.stringify({
          code,
          email,
          user: $user.value,
        }),
      })
        .then((res) => res.text())
        .then((text) => {
          console.log(text);
        });
    } else {
      e.target.previousElementSibling.classList.add("input-error");
      e.target.previousElementSibling.addEventListener("focus", (e) => {
        e.target.classList.remove("input-error");
      });
    }
  } else {
    $user.classList.add("input-error");
    $user.addEventListener("focus", (e) => {
      e.target.classList.remove("input-error");
    });
  }
});

document.addEventListener("submit", (e) => {
  e.preventDefault();
  if (e.target.pass.value === e.target.conf.value) {
    if (e.target.verify.value === code) {
      e.target.q.value = CryptoJS.SHA256(e.target.pass.value).toString();
      e.target.submit();
    } else {
      e.target.verify.classList.add("input-error");
      e.target.verify.addEventListener("focus", (e) => {
        e.target.classList.remove("input-error");
      });
    }
  } else {
    e.target.pass.classList.add("input-error");
    e.target.conf.classList.add("input-error");
    e.target.pass.addEventListener("focus", (e) => {
      e.target.classList.remove("input-error");
    });
    e.target.conf.addEventListener("focus", (e) => {
      e.target.classList.remove("input-error");
    });
  }
});
