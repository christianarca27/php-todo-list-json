const { createApp } = Vue

createApp({
    data() {
        return {
            todos: [],
            newTodoText: "",
        }
    },

    methods: {
        getTodos() {
            // Prendo i dati restituiti dalla API server.php e li salvo in un array di oggetti in memoria
            axios.get('./server.php')
                .then(res => {
                    this.todos = res.data;
                });
        },

        addTodo() {
            // Prelevo il testo inserito dall'utente
            const postData = {
                newTodoText: this.newTodoText,
            }
            // Svuoto la barra di input
            this.newTodoText = "";
            // Invio a server.php una richiesta POST per l'aggiunta del nuovo elemento
            axios.post('./server.php', postData, { headers: { 'Content-Type': 'multipart/form-data' } })
                .then(res => {
                    // Al termine della richiesta POST aggiorno i dati prelevati
                    this.getTodos();
                });
        },

        toggleTaskDone(index) {
            // Prelevo il testo inserito dall'utente
            const postData = {
                toggleDoneIndex: index,
            }
            // Invio a server.php una richiesta POST per la modifica dell'elemento con indice 'toggleDoneIndex'
            axios.post('./server.php', postData, { headers: { 'Content-Type': 'multipart/form-data' } })
                .then(res => {
                    // Al termine della richiesta POST aggiorno i dati prelevati
                    this.getTodos();
                });
        },

        deleteTodo(index) {
            // Prelevo il testo inserito dall'utente
            const postData = {
                deletedIndex: index,
            }
            // Invio a server.php una richiesta POST per la rimozione dell'elemento con indice 'deletedIndex'
            axios.post('./server.php', postData, { headers: { 'Content-Type': 'multipart/form-data' } })
                .then(res => {
                    // Al termine della richiesta POST aggiorno i dati prelevati
                    this.getTodos();
                });
        },
    },

    mounted() {
        this.getTodos();
    },
}).mount('#app')