if (!window.WebSocket) {
    alert("Ваш браузер неподдерживает веб-сокеты!");
}

// создаем соедиение с вебсокетом для нашего чата, параметр таск передается из скрипта во вьюхе
var webSocket = new WebSocket("ws://front.yii2:8080?task=" + task);

// подписываемся на событие отправки сообщения из формы чата
document.getElementById("task_chat_form")
    .addEventListener('submit', function (event) {
        // var textMessage = '{"message": "' + this.message.value + '", "user": "' + this.dataset.userid
        //     + '", "task": "' + this.dataset.taskid + '"}';
        // webSocket.send(textMessage);
        var data = {
            message: this.message.value,
            user: this.userid.value,
            task: this.taskid.value
        };
        webSocket.send(JSON.stringify(data));
        event.preventDefault();
        return false;
    });

// при получении сообщения будет выполняться следующая функция
webSocket.onmessage = function (event) {
    // сохраняем полученную строку в переменную
    var data = event.data;
    var messageContainer = document.createElement('div');
    var textNode = document.createTextNode(data);
    messageContainer.appendChild(textNode);
    document.getElementById("root_task_chat")
        .appendChild(messageContainer);
};