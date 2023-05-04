let selectStatus = document.querySelector("[name = btn-cancel]");
let btn = document.querySelector("[name = btn]");

document.querySelector(".order-confirm").addEventListener("input",()=>{
    document.querySelector(".reason_cancel").classList.toggle('reason_cancel');
} )

selectStatus.onclick = function() {
    document.querySelector(".div-reason").classList.toggle('div-reason-visible');
}
document.querySelector("#reason_cancel").addEventListener("input", () => {
btn.disabled = false;

});

