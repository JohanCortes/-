document.addEventListener("submit", (e) => {
  e.preventDefault();
  e.target.clave.value = CryptoJS.SHA256(e.target.clave.value).toString();
  e.target.fecha.value = new Date()
    .toISOString()
    .replace("T", " ")
    .replace("Z", "");
  e.target.user.value = document.getElementById("user").dataset.id;
  console.log(e.target.clave.value, e.target.fecha.value);
  fetch(e.target.action, {
    method: "POST",
    body: new FormData(e.target),
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
      $next = e.target.nextElementSibling;
    $prev.value && ($next.value += $prev.value + ";");
    $prev.value = "";
  }
});
