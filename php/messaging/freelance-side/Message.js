let messageFetchIntervalId;

function clickConvo(convoId) {
    let form_data = new FormData();
    form_data.append('fetch_info_convo', 'fetch_info_convo');
    form_data.append('convoId', convoId);
    fetch('../php/messaging/freelance-side/message.php', {
        method: "POST",
        body: form_data
    }).then((response) => {
        return response.json();
    }).then((response_data) => {
        console.log(response_data);

        // clearInterval(messageFetchIntervalId);
        fetch_messages(convoId);
        let info = response_data;
        document.getElementById('btn_sendMessage').value = convoId;
        document.getElementById('chat_image').src = `../img/uploads/company/${info.imageProfile}`;
        document.getElementById('fullname').innerHTML = `${info.fullname}`;
        document.getElementById('profile_image').src = `../img/uploads/company/${info.imageProfile}`;
        document.getElementById('profile_name').innerHTML = `${info.fullname}`;
        document.getElementById('profile_email').innerHTML = `${info.email}`;
        document.getElementById('profile_address').innerHTML = `${info.barangay}, ${info.municipality}, ${info.province}`;
        companyId = info.user_id;
        freelanceId = info.freelance_id;
        Pusher.logToConsole = true;
        const pusher = new Pusher("7717fc588fb67a40c2c6", {
            cluster: "ap1",
            encrypted: true,
        });
        channel = pusher.subscribe(`message-channel-${companyId}-${freelanceId}`);
        channel.bind("message-event", function (data) {
            console.log("connected");
            console.log(companyId);
            const chatbox = document.getElementById("chatbox");
            const messageDiv = document.createElement("div");
            messageDiv.className =
                data.sender === "self" ? "freelance-chat" : "user-chat";
            messageDiv.textContent = data.message;
            chatbox.append(messageDiv);
            // var chatbox = document.getElementById('chatbox');
            chatbox.scrollTop = chatbox.scrollHeight;
        });
        // messageFetchIntervalId = setInterval(() => {
        //     fetch_messages(convoId);
        // }, 5000);
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
    const chatbox = document.getElementById('chatbox');
    chatbox.innerHTML = '';
    form_data.append('convoId', convoId);
    form_data.append('fetch_messages', 'fetch_messages');
    fetch('../php/messaging/freelance-side/message.php', {
        method: "POST",
        body: form_data
    }).then((response) => {
        return response.json();
    }).then((response_data) => {
        console.log(response_data);
        const messages = response_data.messages;

        // chatbox.innerHTML = '';
        if (Array.isArray(messages)) {
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
    fetch('../php/messaging/freelance-side/message.php', {
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