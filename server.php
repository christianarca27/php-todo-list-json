<?php

if (isset($_POST['newTodoText'])) {

    // Prelevo i dati dal file json
    $todosJSON = file_get_contents('./todo-list.json');

    // Decodifico i dati in un formato utilizzabile da php (per eventuali modifiche)
    $todos = json_decode($todosJSON);

    $newTodo = [
        'text' => $_POST['newTodoText'],
        'done' => false,
    ];

    // Accodo il nuovo todo nella todo list prelevata dal file json
    $todos[] = $newTodo;

    // Codifico la nuova todo list nel formato json
    $todosJSON = json_encode($todos);

    // Scrivo nel file json la nuova todo list
    file_put_contents('./todo-list.json', $todosJSON);

} elseif (isset($_POST['toggleDoneIndex'])) {

    // Prelevo i dati dal file json
    $todosJSON = file_get_contents('./todo-list.json');

    // Decodifico i dati in un formato utilizzabile da php (per eventuali modifiche)
    $todos = json_decode($todosJSON);

    // Salvo l'indice del todo da modificare
    $toggleDoneIndex = $_POST['toggleDoneIndex'];
    // Toggle del campo 'done' dell'oggetto toggleDoneIndex-esimo
    $todos[$toggleDoneIndex]->done = !($todos[$toggleDoneIndex]->done);

    // Codifico la nuova todo list nel formato json
    $todosJSON = json_encode($todos);

    // Scrivo nel file json la nuova todo list
    file_put_contents('./todo-list.json', $todosJSON);

} elseif (isset($_POST['deletedIndex'])) {

    // Prelevo i dati dal file json
    $todosJSON = file_get_contents('./todo-list.json');

    // Decodifico i dati in un formato utilizzabile da php (per eventuali modifiche)
    $todos = json_decode($todosJSON);

    // Salvo l'indice del todo da eliminare
    $deletedIndex = $_POST['deletedIndex'];
    // Rimuovo l'elemento con indice '$deleteIndex'
    array_splice($todos, $deletedIndex, 1);

    // Codifico la nuova todo list nel formato json
    $todosJSON = json_encode($todos);

    // Scrivo nel file json la nuova todo list
    file_put_contents('./todo-list.json', $todosJSON);

} else {

    // Prelevo i dati dal file json
    $todosJSON = file_get_contents('./todo-list.json');

    // Decodifico i dati in un formato utilizzabile da php (per eventuali modifiche)
    $todos = json_decode($todosJSON);

    // Trasformo la visualizzazione in json
    header('Content-type: application/json');

    // Stampo i dati che voglio fornire alla chiamata del file
    echo $todosJSON;

}