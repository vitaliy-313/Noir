document.addEventListener("DOMContentLoaded", () => {

document.addEventListener("click", async (event) => {
    if (event.target.classList.contains("btn-delete")) {
      let res = await outOnProductPage(event.target.dataset.categoryId, "delete");

      event.target.closest(".categories").remove();
    } 

  });
  async function outOnProductPage(category_id, action) {
    let Category = await postJSON("/app/admin/categories/admin.categories.php",
      category_id,
      action
    );
    
  }

}); 