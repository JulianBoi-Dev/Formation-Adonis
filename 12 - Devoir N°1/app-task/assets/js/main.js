let tasks = [
];

const taskList = document.getElementById('taskList');
const taskForm = document.getElementById('taskForm');
const taskInput = document.getElementById('taskInput');


function createTaskElement(taskText) {

    const li = document.createElement('li');
    li.className = 'task-item';
    const span = document.createElement('span');
    span.className = 'task-text';
    span.textContent = taskText;
    const deleteBtn = document.createElement('button');
    deleteBtn.className = 'delete-btn';
    deleteBtn.textContent = 'Supprimer';
    deleteBtn.addEventListener('click', function() {
        deleteTask(li, taskText);
    });
    li.appendChild(span);
    li.appendChild(deleteBtn);

    return li;
}
function deleteTask(liElement, taskText) {
    liElement.remove();
    const index = tasks.indexOf(taskText);
    if (index > -1) {
        tasks.splice(index, 1);
    }
    checkEmptyList();
}
function checkEmptyList() {
    if (tasks.length === 0) {
        const emptyMessage = document.createElement('li');
        emptyMessage.className = 'empty-message';
        emptyMessage.textContent = 'Aucune tâche pour le moment. Ajoutez-en une !';
        taskList.appendChild(emptyMessage);
    } else {
        const emptyMessage = document.querySelector('.empty-message');
        if (emptyMessage) {
            emptyMessage.remove();
        }
    }
}
function displayTasks() {
    taskList.innerHTML = '';
    tasks.forEach(function(task) {
        const li = createTaskElement(task);
        taskList.appendChild(li);
    });
    checkEmptyList();
}

function addTask(taskText) {
    tasks.push(taskText);
    const li = createTaskElement(taskText);
    const emptyMessage = document.querySelector('.empty-message');
    if (emptyMessage) {
        emptyMessage.remove();
    }
    taskList.appendChild(li);
}

taskForm.addEventListener('submit', function(event) {
    event.preventDefault();
    const newTask = taskInput.value.trim();
    if (newTask !== '') {
        addTask(newTask);
        taskForm.reset();
        taskInput.focus();
    }
});
displayTasks();
