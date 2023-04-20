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
    },

    mounted() {
        this.getTodos();
    },
}).mount('#app')