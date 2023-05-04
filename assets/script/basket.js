document.addEventListener("DOMContentLoaded", async () => {
  document.addEventListener("click", async (event) => {
    if (event.target.classList.contains("btn-basket-plus")) {
      outOnBasketPage(event.target.dataset.productId, "add");

    }
    if (event.target.classList.contains("syrup")) {
      outOnBasketPage(
        event.target.dataset.productId,
        "addSyrup",
        event.target.value
      );

    }
    if (event.target.classList.contains("btn-basket-minus")) {
      outOnBasketPage(event.target.dataset.productId, "dec");
    }
    if (event.target.classList.contains("btn-basket-delete")) {
      outOnBasketPage(event.target.dataset.productId, "delete");
      event.target.closest(".card").remove();
    }
    if (event.target.classList.contains("clear")) {
      outOnBasketPage(event.target.dataset.productId, "clear");
      document.querySelector(".totalPrice").style.display = "none";
      document.querySelector(".totalCount").style.display = "none";
      document.querySelector(".message").textContent = "Корзина пустая";
      document
        .querySelectorAll(".basket-position")
        .forEach((item) => item.remove());
    }
  });
  if (document.querySelectorAll(".basket-position").length == 0) {
    document.querySelector(".totalPrice").style.display = "none";
    document.querySelector(".totalCount").style.display = "none";
    document.querySelector(".message").textContent = "Корзина пустая";
  }

  async function outOnBasketPage(
    product_id,
    action,
    syrup_id = 1,
    volume_id = 1
  ) {
    let { basketProduct, totalPrice, totalCount } = await postJSON(
      "/app/tables/basket/save.basket.php",
      { product_id, volume_id, syrup_id },
      action
    );

    if (basketProduct != "delete") {
      document.querySelector(`[data-count = "${product_id}"]`).textContent =
        basketProduct.count;

      document.querySelector(
        `[data-price-position = "${product_id}"]`
      ).textContent = basketProduct.price * basketProduct.count + "₽";
    }

    document.querySelector(`.totalPrice`).textContent = `итог: ${totalPrice}₽`;
    document.querySelector(
      ".totalCount"
    ).textContent = `итоговое количество: ${totalCount}/шт.`;
  }

  let volumeBtns = document.querySelectorAll(".card-checked");
  let product = document.querySelector(".card-title");
  let cardPrice = document.querySelector(".card-price");
  // let product_id = product.dataset.productId;
  let volume_id = false;
  volumeBtns.forEach((btn) => {
    btn.addEventListener("click", async (e) => {
      let volume_id = e.target.dataset.volumeId;
      let product_id = e.target.dataset.productId

      const param = new URLSearchParams();
      param.append("volume_id", volume_id);
      param.append("product_id", product_id);

      outOnBasketPage(
        product_id,
        "changeVolume",
        document.querySelector(`.syrup[data-product-id='${product_id}']`).value,
        volume_id
      );
      let price = await getData("/app/tables/products/search.price.php", param);

      cardPrice.textContent = price + "₽";
    });
  });
});
