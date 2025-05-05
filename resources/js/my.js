const modal = document.getElementById("descriptionModal")

document.querySelectorAll(".desc").forEach((el) => {
    el.addEventListener("click", () => {
        modal.querySelector(".modal-body").innerHTML = el.dataset.description
        new bootstrap.Modal(modal).show()
    })
})
