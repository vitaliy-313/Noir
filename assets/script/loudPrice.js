let volumeBtns = document.querySelectorAll("[name = 'volume']");
let product = document.querySelector(".card-title");
let cardPrice = document.querySelector(".card-price");
let productId = product.dataset.productId;
let volume_id = false;
volumeBtns.forEach((btn) => {
  btn.addEventListener("change", async (e) => {
    let volumeId = e.target.value;
    const param = new URLSearchParams();
    param.append("volume_id", volumeId);
    param.append("product_id", productId);
    let price = await getData("/app/tables/products/search.price.php", param);
    cardPrice.textContent = price + "₽";
  });
});
document.querySelector("#btnOrder").addEventListener("click", async (e) => {
  btn = document.querySelector("[name = 'volume']:checked");
  if (btn != null) {
    volume_id = btn.value;
  }
  let product_id = e.target.dataset.productId;

  let res = await postJSON(
    "/app/tables/basket/save.basket.php",
    { product_id, volume_id },
    "add"
  );
});
