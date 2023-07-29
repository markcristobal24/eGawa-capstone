class Notification {

    create_notification(message, type) {
        let create_toast_notif_dialog = document.createElement("div");

        let id = Math.random().toString(36).substr(2, 10);
        create_toast_notif_dialog.setAttribute("id", id);
        create_toast_notif_dialog.classList.add("toast_notif_dialog", type);
        create_toast_notif_dialog.innerText = message;
        document.getElementById("toast_notif").appendChild(create_toast_notif_dialog);

        let toast_notif_dialog = document.querySelector(".toast_notif").getElementsByClassName("toast_notif_dialog");
        let toast_notif_close = document.createElement("div");
        toast_notif_close.classList.add("toast_notif_close");
        toast_notif_close.innerHTML = '<i class="fas fa-times"></i>';
        create_toast_notif_dialog.appendChild(toast_notif_close);

        toast_notif_close.onclick = function (e) {
            create_toast_notif_dialog.remove();
        }
        setTimeout(() => {
            for (let i = 0; i < toast_notif_dialog.length; i++) {
                if (toast_notif_dialog[i].getAttribute("id") == id) {
                    toast_notif_dialog[i].remove();
                    break;
                }
            }
        }, 5000);
    }

    showNotification(message, header) {
        const customNotification = new Notification();
        customNotification.create_notification(message, header);
    }
}