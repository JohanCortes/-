document.addEventListener("submit", (e) => {
  //e.preventDefault();
  e.target.user.value = document.getElementById("user").dataset.id;
  e.target.emails.value += document.getElementById("user").dataset.email;
  let data = new FormData(e.target);
  console.log(data);
  fetch(e.target.action, {
    method: "POST",
    body: data,
  })
    .then((res) => res.text())
    .then((text) => {
      console.log(text, Date.now(), e.target);
    })
    .catch((err) => {
      console.log(err);
    })
    .finally(() => {
      e.target.reset();
    });
});

document.addEventListener("click", (e) => {
  if (e.target.matches("#btn-add")) {
    let $prev = e.target.previousElementSibling,
      $next = e.target.nextElementSibling,
      reg = new RegExp(
        "^[a-z0-9]+(\\.[_a-z0-9]+)*@[a-z0-9-]+(\\.[a-z0-9-]+)*(\\.[a-z]{2,15})$"
      );
    $prev.value && reg.test($prev.value) && ($next.value += $prev.value + ";");
    $prev.value = "";
  }
});

document.getElementById("user").addEventListener("dblclick", (e) => {
  window.open("logout.php", "_self");
});