function fetchMessages() {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", 'fetch_messages.php?tid=' + tid, true);
    xhr.onload = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let response = xhr.responseText;
                let chatBox = document.querySelector('.chat-box');
                chatBox.innerHTML = response;

                chatBox.scrollTop = chatBox.scrollHeight;
            }
        }
    };
    xhr.send();
}

function sendMessage(message) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", 'msg.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                
            } else {
                console.error("Error sending message:", xhr.responseText);
            }
        }
    };

    let params = "tid=" + tid + "&incoming_id=" + incoming_id + "&message=" + message;
    xhr.send(params);
}


fetchMessages();

setInterval(fetchMessages, 5000);

document.querySelector('.typing-area').addEventListener('submit', function (e) {
    e.preventDefault();
    let messageInput = document.querySelector('.input-field');
    let message = messageInput.value.trim();

    if (message !== '') {
        sendMessage(message);
        messageInput.value = ''; 
    }
});
