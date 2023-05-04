//показать/скрыть поля для цены
document.querySelectorAll("[type='checkbox']").forEach((chek) => {
  chek.addEventListener("click", (event) => {
    // если флажок включен
    if (event.target.checked) {
      document.querySelectorAll("[type='number']").forEach((number) => {
        if (number.id == event.target.value) {
            // то оказываем поле
          number.disabled = false;
          number.hidden = false;
        }
      });
    }
    // если флажок выключен
    if (!event.target.checked) {
        document.querySelectorAll("[type='number']").forEach((number) => {
          if (number.id == event.target.value) {
              // то скрываем поле
            number.disabled = true;
            number.hidden = true;
          }
        });
      }
  });
  
});
