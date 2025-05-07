const modal = document.getElementById("descriptionModal")

document.querySelectorAll(".desc").forEach((el) => {
    el.addEventListener("click", () => {
        modal.querySelector(".modal-body").innerHTML = el.dataset.description
        new bootstrap.Modal(modal).show()
    })
})

const ratingModal = document.getElementById("ratingModal")

document.querySelectorAll(".rate").forEach((el) => {
    el.addEventListener("click", () => {
        ratingModal.querySelector("#task_id").value = el.dataset.task_id;
        ratingModal.querySelector("#rated_user_id").value = el.dataset.rated_user_id;
        new bootstrap.Modal(ratingModal).show()
    })
})

document.querySelectorAll('.chat').forEach(btn => {
    btn.addEventListener('click', function () {
        const taskId = this.dataset.task_id;
        const userId = this.dataset.current_user_id;
        const workerId = this.dataset.task_worker_id;
        const taskOwner = this.dataset.task_owner_id;
        const chatBox = document.querySelector('#chat');
        chatBox.innerHTML = '<p>Loading messages...</p>';

        fetch(`/task/${taskId}/messages`)
            .then(res => res.json())
            .then(messages => {
                chatBox.innerHTML = '';
                
                messages.forEach(msg => {
                    const isOwner = msg.task_owner_id === userId;
                    const div = document.createElement('div');
                    div.className = 'd-flex ' + (isOwner ? ' flex-row-reverse' : '');
                    div.style = "background-color: ${isOwner ? '#d1e7dd' : '#f8d7da'};";
                    div.innerHTML = `
                        <div class="p-3 m-3 bg-light text-dark rounded-3">${msg.message}</div>
                    `;
                    chatBox.appendChild(div);
                });

                // Show the modal
                document.getElementById('task_worker_id').value = workerId;
                document.getElementById('task_id').value = taskId;
                const modal = new bootstrap.Modal(document.getElementById('chatModal'));
                modal.show();
            });
    });
});
