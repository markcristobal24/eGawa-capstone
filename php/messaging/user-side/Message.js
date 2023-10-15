let messageFetchIntervalId;
// let lastMessage = 0;
let isFirstUpdate = true;

function clickConvo(convoId) {
    let form_data = new FormData();
    form_data.append('fetch_info_convo', 'fetch_info_convo');
    form_data.append('convoId', convoId);
    fetch('../php/messaging/user-side/message.php', {
        method: "POST",
        body: form_data
    }).then((response) => {
        return response.json();
    }).then((response_data) => {
        console.log(response_data);

        clearInterval(messageFetchIntervalId);
        fetch_messages(convoId);

        let info = response_data;

        document.getElementById('btn_sendMessage').value = convoId;
        document.getElementById('chat_image').src = `../img/uploads/freelancer/${info.imageProfile}`;
        document.getElementById('fullname').innerHTML = `${info.fullname}`;
        document.getElementById('profile_image').src = `../img/uploads/freelancer/${info.imageProfile}`;
        document.getElementById('profile_name').innerHTML = `${info.fullname}`;
        document.getElementById('profile_email').innerHTML = `${info.email}`;
        document.getElementById('profile_address').innerHTML = `${info.address}`;
        document.getElementById('btn_viewProfile').style.display = 'block';
        document.getElementById('btn_viewProfile').value = info.freelance_id;

        messageFetchIntervalId = setInterval(() => {
            fetch_messages(convoId);
        }, 5000);
    });
}

function displayMessage(messageData) {
    console.log('Received message for convoId:', messageData.convoId);
    const chatbox = document.getElementById('chatbox');
    const messageDiv = document.createElement('div');
    messageDiv.className = (messageData.sender === 'self' ? 'freelance-chat' : 'user-chat');
    messageDiv.textContent = messageData.message;
    chatbox.append(messageDiv);
    // var chatbox = document.getElementById('chatbox');
    chatbox.scrollTop = chatbox.scrollHeight;
}



function fetch_messages(convoId) {
    const chatbox = document.getElementById('chatbox');
    chatbox.innerHTML = '';
    let form_data = new FormData();
    form_data.append('convoId', convoId);
    form_data.append('fetch_messages', 'fetch_messages');
    fetch('../php/messaging/user-side/message.php', {
        method: "POST",
        body: form_data
    }).then((response) => {
        return response.json();
    }).then((response_data) => {
        console.log(response_data);
        const messages = response_data.messages;

        // chatbox.innerHTML = '';

        if (Array.isArray(messages)) {
            if (isFirstUpdate) {
                const chatbox = document.getElementById('chatbox');
                chatbox.innerHTML = '';  // Clear chatbox for the first update
                isFirstUpdate = false;
            }
            messages.forEach((messageData) => {
                displayMessage(messageData);
            });
        }
        // const channel = pusher.subscribe('my-channel');
        // channel.bind('new-message', function (data) {
        //     // Update your chat interface with the new messages
        //     const newMessages = data.messages;
        //     if (Array.isArray(newMessages)) {
        //         newMessages.forEach((messageData) => {
        //             displayMessage(messageData);
        //         });
        //     }
        // });
    });
}

function send_message(convoId) {
    let form_data = new FormData(document.getElementById('message_box'));
    form_data.append('send_message', 'send_message');
    form_data.append('convoId', convoId);
    fetch('../php/messaging/user-side/message.php', {
        method: "POST",
        body: form_data
    }).then((response) => {
        return response.json();
    }).then((response_data) => {
        console.log(response_data);

        if (response_data.success) {

            fetch_messages(convoId);
            document.getElementById('inputTextarea').value = '';
        }
    });
}

function formatTimestamp(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    const seconds = String(date.getSeconds()).padStart(2, '0');

    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
}

function view_profile(freelance_id) {
    window.location.href = `view_freelance_profile.php?freelance_id=${freelance_id}`;
}