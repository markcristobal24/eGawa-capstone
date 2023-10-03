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
        // fetch_messages(convoId);
        let info = response_data;
        document.getElementById('btn_sendMessage').value = convoId;
        document.getElementById('chat_image').src = `https://res.cloudinary.com/dm6aymlzm/image/upload/c_fill,g_face,h_300,w_300/f_png/r_max/${info.imageProfile}`;
        document.getElementById('fullname').innerHTML = `${info.fullname}`;
        document.getElementById('profile_image').src = `https://res.cloudinary.com/dm6aymlzm/image/upload/c_fill,g_face,h_300,w_300/f_png/r_max/${info.imageProfile}`;
        document.getElementById('profile_name').innerHTML = `${info.fullname}`;
        document.getElementById('profile_email').innerHTML = `${info.email}`;
        document.getElementById('profile_address').innerHTML = `${info.address}`;

        setInterval(() => {
            fetch_messages(convoId);
        }, 1000);
    });
}

function displayMessage(messageData) {
    const chatbox = document.getElementById('chatbox');
    const messageDiv = document.createElement('div');
    messageDiv.className = (messageData.sender === 'self' ? 'freelance-chat' : 'user-chat');
    messageDiv.textContent = messageData.message;
    chatbox.append(messageDiv);
    // var chatbox = document.getElementById('chatbox');
    chatbox.scrollTop = chatbox.scrollHeight;
}

function fetch_messages(convoId) {
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
        const chatbox = document.getElementById('chatbox');
        chatbox.innerHTML = '';
        if (Array.isArray(messages)) {
            messages.forEach((messageData) => {
                displayMessage(messageData);
            });
        }
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


// function fetch_messages(convoId) {
//     console.log(convoId);
//     const xhr = new XMLHttpRequest();
//     xhr.open('GET', `../controller/c_message.php?convo_id=${convoId}`, true);
//     xhr.onreadystatechange = function () {
//         if (xhr.readyState === 4 && xhr.status === 200) {
//             const messages = JSON.parse(xhr.responseText);
//             console.log(messages);
//             messages.forEach(messageData => {
//                 displayMessage(messageData);
//             });
//         }
//     };
//     xhr.send();
// }