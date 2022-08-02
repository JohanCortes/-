let key = CryptoJS.SHA256(document.body.dataset.key).toString();
fetch("Validator.php", {
  method: "POST",
  body: JSON.stringify({
    key,
  }),
});
