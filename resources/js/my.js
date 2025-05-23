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
        const taskOwner = this.dataset.task_owner_id;
        const workerId = this.dataset.task_worker_id;
        const senderId = this.dataset.current_user_id;
        const recieverId = this.dataset.task_owner_id == senderId ? workerId : taskOwner;
        const chatBox = document.querySelector('#chat');
        chatBox.innerHTML = '<p>Loading messages...</p>';

        document.getElementById('sender_id').value = senderId;
        document.getElementById('reciever_id').value = recieverId;
        document.getElementById('task_id').value = taskId;


        fetch(`/task/${taskId}/messages`)
            .then(res => res.json())
            .then(messages => {
                chatBox.innerHTML = '';
                
                messages.forEach(msg => {
                    const isOwner = msg.sender_id == senderId;
                    const div = document.createElement('div');
                    div.className = 'd-flex ' + (isOwner ? ' flex-row-reverse' : '');
                    
                    div.innerHTML = `
                        <div class="p-2 m-1 ${isOwner ? 'bg-primary text-white' : 'bg-secondary text-white'} rounded-3">${msg.message}</div>
                    `;
                    chatBox.appendChild(div);
                });
                const modal = new bootstrap.Modal(document.getElementById('chatModal'));
                modal.show();
            });
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const ratingModal2 = document.getElementById("ratingModal2");
    
    document.querySelectorAll(".rate2").forEach((el) => {
        el.addEventListener("click", () => {
            ratingModal2.querySelector("#task_id2").value = el.dataset.task_id;
            ratingModal2.querySelector("#rated_user_id2").value = el.dataset.rated_user_id;
            new bootstrap.Modal(ratingModal2).show()
        });
    });
});