export const tasks = {

    /* propriété de mon module */
    ulElement: null,

    /**
     * Fonction pour récupérer les tasks
     */
    getTasksFromBackend: async function() {
        try {
            const response = await fetch('http://localhost:8000/api/tasks');
            const tasksData = await response.json();
            for(const taskData of tasksData) {
                tasks.createLiElement(taskData.id, taskData.title);
            }
        } catch(error) {
            console.log(error);
        }
    },

    /**
     * Fonction qui créer une tâche pour l'ajouter à mon DOM
     * @param {string} pId - l'id de la tâche
     * @param {string} $pContent - le contenu de la tâche
     */
    createLiElement: function(pId, pContent) {
        const templateLiElement = document.getElementById('template-li');
        const newTaskLiElement = templateLiElement.content.cloneNode(true)

        // personnalisation du dataset
        newTaskLiElement.querySelector('li').dataset.id = pId;
        // personnalisation du texte
        newTaskLiElement.querySelector('p').textContent = pContent;

        // rajout de l'élement à l'élement UL
        tasks.ulElement.appendChild(newTaskLiElement);
    },

    /**
     * Fonction qui supprime la liste des tâches existantes dans le DOM
     */
    deleteTasks: function() {
        tasks.ulElement.innerHTML = "";
    },

    /**
     * Fonction init du code
     */
    init: function() {
        console.log('tasks.init');
        tasks.ulElement = document.querySelector('ul.tasklist');
        tasks.deleteTasks();
        tasks.getTasksFromBackend();
    },

}

// Ajouter un event click sur chaque bouton "poubelle"

const trash = document.querySelector(".delete")

document.addEventListener('click', function(event){
    liElement.querySelector(".delete").addEventListener('click', app.handleDeleteTask);


domRemoveTask(event.target)})