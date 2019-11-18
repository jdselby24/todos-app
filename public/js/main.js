const API_PATH = "http://localhost:8080/";
let todo_list = document.getElementById("todo-container");

function getTodos() {
  fetch(API_PATH + "get", {
    method: "get"
  })
    .then(response => response.json())
    .then(response => {
      let todos = response.data.data_todos;
      todos.forEach(todo => {
        if (todo.deleted != 1) {
          todo_list.innerHTML += formGenerator(todo);
        }

        let h3s = document.querySelectorAll(".title-content h3");
        h3s.forEach(function(h3) {
          h3.addEventListener("click", function(e) {
            h3totextBox(e);
          });
        });

        let nameForms = document.querySelectorAll(".name-form textarea");
        nameForms.forEach(function(form) {
          form.addEventListener("keypress", function(e) {
            if (e.code == "Enter") {
              nameChanger(e);
            }
          });
        });

        let checkboxes = document.querySelectorAll(".completed-box");
        checkboxes.forEach(function(checbox) {
          checbox.addEventListener("click", function(e) {
            completer(e);
          });
        });

        let deleteButtons = document.querySelectorAll(".delete-box");
        deleteButtons.forEach(function(deleteButton) {
          deleteButton.addEventListener("click", function(e) {
            deleter(e);
          });
        });
      });
    });
}

getTodos();
newToDoHandler();

function formGenerator(todo) {
  let html = "";
  html += "<div class='todo box' id=" + todo.id + ">";
  if (todo.completed == 1) {
    html += "<form class='completed-form' id=" + todo.id + ">";
    html +=
      "<input class='completed-box' type='checkbox' data-id='" +
      todo.id +
      "' checked/>";
    html += "</form>";
  } else {
    html += "<form class='completed-form' id=" + todo.id + ">";
    html +=
      "<input class='completed-box' type='checkbox' data-id='" +
      todo.id +
      "'/>";
    html += "</form>";
  }
  html += "<form class='name-form' id=" + todo.id + ">";
  html += "<div class='title-content' id='" + todo.id + "'>";
  html +=
    "<textarea style='display: none;' name='todo_name' data-id='" +
    todo.id +
    "'></textarea>";
  html += "<h3 data-id='" + todo.id + "'>" + todo.name + "</h3>";
  html + "</div>";
  html += "</form>";
  html += "<form class='deleted-form' id=" + todo.id + ">";
  html +=
    "<input class='delete-box' type='submit' value='Delete' data-id='" +
    todo.id +
    "'/>";
  html + "</div>";
  return html;
}

function h3totextBox(e) {
  let id = e.target.dataset.id;
  let textarea = document.querySelector("textarea[data-id='" + id + "']");
  e.target.style.display = "none";
  textarea.style.display = "inline-block";
  textarea.value = e.target.innerHTML;
  textarea.setAttribute("autofocus", true);
}

function nameChanger(e) {
  e.preventDefault;
  id = e.target.dataset.id;
  name = e.target.value;

  console.log(id);

  request = {
    todo_name: name,
    todo_id: id
  };

  fetch(API_PATH + "update", {
    method: "PUT",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify(request)
  })
    .then(response => response.json())
    .then((todo_list.innerHTML = ""))
    .then(getTodos());
}

function completer(e) {
  id = e.target.dataset.id;

  request = {
    todo_id: id
  };

  fetch(API_PATH + "complete", {
    method: "PUT",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify(request)
  })
    .then(response => response.json())
    .then(() => {
      todo_list.innerHTML = "";
      getTodos();
    });
}

function deleter(e) {
  id = e.target.dataset.id;

  request = {
    todo_id: id
  };

  fetch(API_PATH + "delete", {
    method: "PUT",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify(request)
  })
    .then(response => response.json())
    .then(() => {
      todo_list.innerHTML = "";
      getTodos();
    });
}

function newToDoHandler() {
  let newTodoForm = document.getElementById("addToDo");
  let newTodoName = document.getElementById("todo_name");
  newTodoForm.addEventListener("submit", function(e) {
    let newName = newTodoName.value;

    request = {
      todo_name: newName
    };

    fetch(API_PATH + "add", {
      method: "POST", // your method
      headers: {
        "Content-Type": "application/json" //REQUIRED
      },
      body: JSON.stringify(request) // YOUR DATA
    }).then(getTodos());
  });
}
