document.addEventListener("DOMContentLoaded", () => {
  let productContainer = document.querySelector(".product-container");
  let categoryElements = document.querySelectorAll("[name = 'category']");
  let countProducts = document.querySelector(".count-product");
  let sortSelect = document.querySelector("#sort");
  let products = [];
  //загрузила все карточки с товарами
  getProducts("all");

  //при выборе категории будем подгружать её товары
  categoryElements.forEach((item) => {
    item.addEventListener("change", async (event) => {
      //В коллекцию флажков преобразовали массив , затем нашли только включеный и достали значения включеных
      let checkedCategories = [...categoryElements]
        .filter((item) => item.checked)
        .map((item) => item.value);

      await getProducts(checkedCategories);
    });
  });
  //создаем ф-ию для загрузки данных

  async function getProducts(categories) {
    //формируем параметры
    const param = new URLSearchParams();
    param.append("category", JSON.stringify(categories));
    products = await getData("/app/tables/products/search.check.php", param);
    //выведем полученные данные на страницу
    outOnPage(products);
  }
  function outOnPage(products) {
    productContainer.innerHTML = "";
    products.forEach((item) => {
      productContainer.insertAdjacentHTML("beforeend", createCard(item));
    });
  }
  function createCard({
    id,
    name,
    price,
    count,
    release_year,
    color,
    country,
    category,
  }) {
    return `<tr class="product-position">
              <th>${id}</th>
              <th>${name}</th>
              <th>${price}</th>
              <th>${count}</th>
              <th>${release_year}</th>
              <th>${color}</th>
              <th>${country}</th>
              <th>${category}</th>
              <th><a href="/app/tables/products/show.php?id=${id}" class="btn btn-success btn-biggest">Подробно</a></th>
              <th><a href="/app/admin/product/update.php?id=${id}" class="btn btn-primary btn-change">Изменить</a></th>
              <th><button class="btn btn-primary btn-delete" data-product-id="${id}">Удалить</button></th>
            </tr>
`
  }

  sortSelect.addEventListener("change", () => {
    if (sortSelect.value == "DESC") {
      products.sort((a, b) => b.price - a.price);
    } else if (sortSelect.value == "ASC") {
      products.sort((a, b) => a.price - b.price);
    } else if (sortSelect.value == "startName") {
      products.sort((a, b) => a.name.localeCompare(b.name));
    } else if (sortSelect.value == "endName") {
      products.sort((a, b) => b.name.localeCompare(a.name));
    } else if (sortSelect.value == "endCountry") {
      products.sort((a, b) => a.country.localeCompare(b.country));
    } else if (sortSelect.value == "startCountry") {
      products.sort((a, b) => b.country.localeCompare(a.country));
    }
    outOnPage(products);
  });
  document.addEventListener("click", async (event) => {
    if (event.target.classList.contains("btn-delete")) {
      let res = await outOnProductPage(event.target.dataset.productId, "delete");
      event.target.closest(".product-position").remove();
    }
  });
  async function outOnProductPage(productId, action) {
    let Product = await postJSON("/app/admin/product/save.Product.php",
      productId,
      action
    );
    
  }

});
