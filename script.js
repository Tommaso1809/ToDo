      function addTask() {
    var task = document.getElementById("new");
    task.style.display = "block";
}

    function closeTask() { 
        var task = document.getElementById("new");
        task.style.display = "none";
    }

    function closeInspection(){

        var note = document.getElementById("inspect");
        note.style.display="none";

        var inspect = document.getElementById("up");
        inspect.style.display = "block";


    }

   
    function openUpcoming(){
        var upcoming = document.getElementById("up");
        upcoming.style.display="block";

        var today = document.getElementById("to");
        today.style.display = "none";
    }

    function openToday(){
        var upcoming = document.getElementById("up");
        upcoming.style.display="none";

        var today = document.getElementById("to");
        today.style.display = "block";
    }
         
        function updateCheckboxStatus() {
            var checkboxes = document.querySelectorAll('.task-checkbox');
            var checkedTasks = [];
            var uncheckedTasks = [];

            checkboxes.forEach(function(checkbox) {
                var label = checkbox.nextElementSibling; 
                if (checkbox.checked) {
                    checkedTasks.push(checkbox.id); 
                    label.style.color = "#A9ACAC";
                } else {
                    uncheckedTasks.push(checkbox.id); 
                    label.style.color = "black";
                }
            });

        }

        
        var checkboxes = document.querySelectorAll('.task-checkbox');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', updateCheckboxStatus);

           
        });


        updateCheckboxStatus();

    function inspectTask(taskId) {
        var inspect = document.getElementById("up");
        inspect.style.display = "none";
        var today = document.getElementById("to");
        today.style.display = "none";
        
        var task = document.getElementById("new");
        task.style.display = "none";

        var note = document.getElementById("inspect");
        note.style.display = "block";

        var xhr = new XMLHttpRequest();
        xhr.open("GET", "https://tasktodo.netsons.org/get_task_details.php?id=" + taskId, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var taskDetails = JSON.parse(xhr.responseText);
                document.getElementById("task-name").innerText = taskDetails.taskName;
                document.getElementById("task-description").innerText = taskDetails.description;
                document.getElementById("task-date").innerText = taskDetails.dateTime;
                document.getElementById("task-link").innerText = taskDetails.link;
                document.getElementById("task-tag").innerText = taskDetails.tag;


            }
        };
        xhr.send();
    }

    
    function requestNotificationPermission() {
        if (Notification.permission === 'granted') {
            return true;
        } else if (Notification.permission !== 'denied') {
            return Notification.requestPermission().then(permission => {
                return permission === 'granted';
            });
        }
        return false;
    }

    function showNotification(task) {
        if (requestNotificationPermission()) {
            const notification = new Notification(`Task in scadenza: ${task.taskName}`, {
                body: `Scadenza: ${task.dateTime}`,
            });

            notification.onclick = function () {
                window.focus();
                this.close();
            };
        }
    }

    function getDueTasksFromPHP() {
    fetch('https://tasktodo.netsons.org/tue_task.php')
        .then(response => {
            console.log('Response received:', response); // Log response
            return response.json();
        })
        .then(data => {
            if (data.length > 0) {
                data.forEach(task => {
                    showNotification(task);
                });
            } else {
                console.log('Nessuna task in scadenza domani.'); // Log if no tasks
            }
        })
        .catch(error => console.error('Errore:', error));
    }

    // Richiama la funzione per recuperare le task al caricamento della pagina
    window.onload = function() {
    getDueTasksFromPHP();
    };

