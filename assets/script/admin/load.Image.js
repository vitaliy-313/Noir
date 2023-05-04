let avatar = document.getElementById("image");
let image = document.getElementById("loadedImage");
avatar.addEventListener("change", (event) =>{
    let file = event.target.files[0];
    image.src = URL.createObjectURL(file);
})