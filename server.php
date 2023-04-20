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

} elseif (isset($_POST['todoIndex'])) {

    // Prelevo i dati dal file json
    $todosJSON = file_get_contents('./todo-list.json');

    // Decodifico i dati in un formato utilizzabile da php (per eventuali modifiche)
    $todos = json_decode($todosJSON);

    // Salvo l'indice del todo da modificare
    $todoIndex = $_POST['todoIndex'];
    // Toggle del campo 'done' dell'oggetto todoIndex-esimo
    $todos[$todoIndex]->done = !($todos[$todoIndex]->done);

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