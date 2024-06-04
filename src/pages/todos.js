import Auth from "../services/auth.js";
import location from "../services/location.js";
import loading from "../services/loading.js";
import Todos from "../services/todos.js";
import Form from "../components/form.js";

const init = async () => {
    const { ok: isLogged } = await Auth.me()

    if (!isLogged) {
        return location.login()
    } else {
        loading.stop()
    }

    const formEl = document.getElementById('todo-form');
    new Form(formEl, {
        'description': () => false,
    }, (values) => {
        addTodo(values.description);
    })

    // create POST /todo { description: string }
    function createTodo(todo) {
        const todoHTML = document.createElement('div');
        const todoCheckbox = document.createElement('input');
        const todoDescription = document.createElement('span');
        const todoRemoveButton = document.createElement('button');

        todoHTML.classList.add('todo');
        todoCheckbox.setAttribute('type', 'checkbox');
        todoCheckbox.classList.add('todo__checkbox');
        todoCheckbox.checked = todo.completed;
        todoCheckbox.onchange = async function(event) {
            loading.start();
            const checkboxValue = event.target.checked;
            event.target.checked = !event.target.checked;
            const response = await Todos.updateStatusById(todo.id, checkboxValue);
            loading.stop();
            if (response) {
                event.target.checked = !event.target.checked;
            } else {
                alert('Ошибка при отправке запроса на сервер.');
            }
        }
        todoDescription.classList.add('todo__description');
        todoDescription.innerText = todo.description;
        todoRemoveButton.classList.add('todo__remove');
        todoRemoveButton.innerText = 'Удалить';
        todoRemoveButton.onclick = async function(event) {
            const response = confirm('Вы уверены?');
            if (response) {
                loading.start();
                await Todos.deleteById(todo.id);
                await createTodoList();
            }
        }

        todoHTML.appendChild(todoCheckbox);
        todoHTML.appendChild(todoDescription);
        todoHTML.appendChild(todoRemoveButton);

        return todoHTML;
    }
    const createTodoList = async () => {
        const todos = await Todos.getAll();
        document.querySelector('.todo-list').innerHTML = '';
        loading.stop();
        todos.forEach(todo => {
            const todoHTML = createTodo(todo);
            document.querySelector('.todo-list')
                .appendChild(todoHTML);
        });
    }

    const addTodo = async (description) => {
        loading.start();
        const response = await Todos.create(description);
        //console.log(response);
        if(response.ok) {
            await createTodoList();
        } else {
            console.log('Ошибка добавления Todo');
        }
    }

    await createTodoList();
}
    // get get /todo/1 - 1 это id
    // getAll get /todo
    // update put /todo/1 - 1 это id { description: string }
    // delete delete /todo/1 - 1 это id

if (document.readyState === 'loading') {
    document.addEventListener("DOMContentLoaded", init)
} else {
    init()
}

