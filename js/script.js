function newInput(i) {
    var form = document.getElementById("createTest");

    var input = document.createElement("input");
    input.setAttribute('type', "textarea");
    input.setAttribute('placeholder', "Podaj pytanie");
    input.setAttribute('name', "question"+i); // Ważna rzecz!

    //form.appendChild(input);
    form.insertBefore(input, document.getElementById("addQuestion"));
}

function createTestSheet() {
    //create form
    var f = document.createElement("form");
    f.setAttribute('id', "createTest")
    f.setAttribute('method', "post");
    f.setAttribute('action', "testCreator.php");

    var title = document.createElement("input");
    title.setAttribute('type', "text");
    title.setAttribute('placeholder', "Podaj tytuł testu");
    title.setAttribute('name', "title");
    f.appendChild(title);

    var addQuestion = document.createElement("input");
    addQuestion.setAttribute('id', "addQuestion");
    addQuestion.setAttribute('type', "button");
    addQuestion.setAttribute('value', "Dodaj pytanie");

    // Tutaj przypisujemy funkcję do wykonania po
    // kliknięciu w „Dodaj pytanie”.
    var i = 0;
    addQuestion.addEventListener("click",function(e){
        newInput(++i);
    },false);

    f.insertBefore(addQuestion, document.getElementById("accept"));

    document.getElementsByTagName('body')[0].appendChild(f);

    newInput(0);

    var s = document.createElement("input");
    s.setAttribute('id', "accept");
    s.setAttribute('type', "submit");
    s.setAttribute('value', "Zatwierdź");
    document.getElementById("createTest").appendChild(s);
}



//
// function createTestSheet() {
//     //create form
//     var f = document.createElement("form");
//     f.setAttribute('id', "createTest")
//     f.setAttribute('method', "post");
//     f.setAttribute('action', "testCreator.php");
//
//     var title = document.createElement("input");
//     title.setAttribute('type', "text");
//     title.setAttribute('placeholder', "Podaj tytuł testu");
//     title.setAttribute('name', "title");
//     f.appendChild(title);
//
//     newInput(f);
//     // do {
//     //     newInput(f);
//     // }while();
//
//     var addQuestion = document.createElement("button");
//     addQuestion.setAttribute('id', "addQuestion");
//     addQuestion.setAttribute('onclick', "addQuestion()");
//     addQuestion.setAttribute('value', "Dodaj pytnaie");
//     f.appendChild(addQuestion);
//
//     var s = document.createElement("input");
//     s.setAttribute('type', "submit");
//     s.setAttribute('value', "Zatwierdź");
//     f.appendChild(s);
//
//     document.getElementsByTagName('body')[0].appendChild(f);
// }
//
// function newInput(f) {
//
//     var input = document.createElement("input");
//     input.setAttribute('type', "text");
//     input.setAttribute('placeholder', "Podaj pytanie");
//     input.setAttribute('name', "question");
//     f.appendChild(input);
// }
//
// function addQuestion(f) {
//
//     var input = document.createElement("input");
//     input.setAttribute('type', "text");
//     input.setAttribute('placeholder', "Podaj pytanie");
//     input.setAttribute('name', "question");
//     f.appendChild(input);
// }

