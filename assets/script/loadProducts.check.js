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

    //2 способ
    // const param =new URLSearchParams({
    //     category:JSON.stringify(categories)
    // })

    
    products = await getData("/app/tables/products/search.check.php", param);
    //выведем полученные данные на страницу
    outOnPage(products);
  }
  function outOnPage(products) {
    productContainer.innerHTML = "";
    products.forEach((item) => {
      productContainer.insertAdjacentHTML("beforeend", createCard(item));
    });
    countProducts.textContent = `Найдено ${products.length} ш.`;
  }
  function createCard({ id, name, price, image }) {
    return ` 
            <div class="col">
                <div class="card">
                    <img src="/upload/${image} " class="card-img-top card-upload" alt="${image}">
                    <div class="card-body">
                        <h5 class="card-title">${name}</h5>
                        <p class="card-text">${price}</p>
                        <a href="/app/tables/products/show.php?id=${id}" class="btn btn-primary">Подробно</a>
                        <button id="btn-${id}" data-btn-id="${id}" class="btn-basket">В корзину</button>
                    </div>
                </div>
            </div>`;
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
    if (event.target.classList.contains("btn-basket")) {
      let id = event.target.dataset.btnId;

      let res =await postJSON("/app/tables/basket/save.basket.php", id, "add");

    }
  });
});
