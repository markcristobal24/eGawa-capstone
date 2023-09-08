function displayMessage(messageData) {
    const chatbox = document.getElementById('chatbox');
    const messageDiv = document.createElement('div');
    messageDiv.className = 'message' + messageData.sender;
    messageDiv.textContent = messageData.message;
    chatbox.appendChild(messageDiv);
    chatbox.scrollTop = chatbox.scrollHeight;
}

function fetchMessages() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'messages.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const messages = JSON.parse(xhr.responseText);
            messages.forEach(messageData => {
                displayMessage(messageData);
            });
        }
    };
    xhr.send();
}

function sendMessage() {
    const messageInput = document.getElementById('message');
    const message = messageInput.value;
    if (message.trim() !== '') {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'messages.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                fetchMessages();
                messageInput.value = '';
            }
        };
        xhr.send('message=' + encodeURIComponent(message));
    }
}

fetchMessages();
setInterval(fetchMessages, 3000);