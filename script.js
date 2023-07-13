// Retrieve the todo input and todo list element from the HTML
const todoInput = document.getElementById('todoInput');
const todoList = document.getElementById('todoList');

// Function to create a new todo item
function createTodoItem(todoText) {
    const li = document.createElement('li');
    li.textContent = todoText;

    const deleteButton = document.createElement('button');
    deleteButton.textContent = 'Delete';
    deleteButton.className = 'btn btn-danger btn-sm ml-2';

    deleteButton.addEventListener('click', function() {
        li.remove();
    });

    li.appendChild(deleteButton);
    todoList.appendChild(li);
}

// Add event listener to the form to handle the submission of new todos
document.getElementById('addTodoForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission

    const todoText = todoInput.value.trim();
    if (todoText !== '') {
        createTodoItem(todoText);
        todoInput.value = '';
    }
});
