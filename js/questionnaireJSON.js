/*        Javascript Fetch API request look like this              */

const data = {
    argument: 'questionnaire',
    action: 'editName',
    idQuestionnaire: id,
    Name: ''
}
const request = new Request ('../Controller/RequestC.php', {
    method: 'POST',
    body: JSON.stringify(data),
    headers: new Headers({
        'Content-Type': 'application/JSON',
        'Accept': 'application/json'
    })
})
fetch (request)
//.then(res => res.json())
.then(res => console.log(res))
.catch(err => console.error('Error:', err));


// this should do the trick (normally)










/*         Shared Functions              */

    // Removes focus when Enter or another key is pressed
    // When input is out of focus it calls another function
    function EnterPressed(key, Input) {
        // Enter keycode is 13
        if (key.which == 13) {
            Input.blur();
        }
    }

    // Check if an element is empty and calls another function      //
    function isEmptyTitle (id, arg) {
        Title = document.getElementById(id);

        if (!Title.innerHTML || Title.innerHTML=="  ") {
            switch (arg) {
                case 1:
                    ActivateTitleInput (1);
                break;

                case 2:
                    ActivateQuestionNameInput (Title, 1);
                break;

                case 3:
                    ActivateAnswerNameInput (Title, 1);
                break;
            }
        }
    }

    // Because some stuff couldn't work with the first one I had to do another
    // The 0/1 indicates if an input should be focused, and because it ain't supposed to be onLoad, some elements required it be because i don't remember why but it needed i swear
    function isEmptyTitleAlt(Title, arg) {
        switch (arg) {
            case 1:
                ActivateQuestionNameInput(Title, 0);
                break;

            case 2:
                ActivateAnswerNameInput(Title, 0);
                break;
        }
    }



/*         Questionnaire Title Functions              */

    // Disable the Title and Show the input to enter a new one
    // Put the input onfocus (unless the function is called onload())
    function ActivateTitleInput(OnLoad) {
        var Input = document.getElementById('TitleEdit');
        var Title = document.getElementById('TitlenomQuestionnaire');

        Title.hidden = "hidden";

        if (!Title.innerHTML || Title.innerHTML == "  ") {
            Input.value = "Votre Questionnaire ...";
        }
        else {
            Input.value = Title.innerHTML;
        }

        Input.type = "text";
        if (!OnLoad) {
            Input.focus();
        }
    }

    // Gets called when the input is out of focus
    // Calls a php Title through an XML request to change the name in the database
    // Once the name is changed it is put back as the value of the title
    function changeTitleName(id, Input) {
        var Title = document.getElementById('TitlenomQuestionnaire');

        if (!Input.value) {
            $.ajax({
                type: "POST",
                url: "../Controller/RequestC.php",
                data: ({
                    argument: 'questionnaire',
                    action: 'editName',
                    idQuestionnaire: id,
                    Name: ''
                }),
                cache: false,
                success: function (data) {
                    Title.innerHTML = data;
                    popupCaller ("Questionnaire's title was set to default");
                }
            });

            const data = {
                argument: 'questionnaire',
                action: 'editName',
                idQuestionnaire: id,
                Name: ''
            }
            const request = new Request ('../Controller/RequestC.php', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: new Headers({
                    'Content-Type': 'application/JSON',
                    'Accept': 'application/json'
                })
            })
            fetch (request)
            //.then(res => res.json())
            .then(res => console.log(res))
            .catch(err => console.error('Error:', err));

            Input.value = "Votre Questionnaire ...";
            Title.innerHTML = "Votre Questionnaire ...";
        }
        else if (Title.innerHTML != Input.value && Input.value != "Votre Questionnaire ...") {
            $.ajax({
                type: "POST",
                url: "../Controller/RequestC.php",
                data: ({
                    argument: 'questionnaire',
                    action: 'editName',
                    idQuestionnaire: id,
                    Name: Input.value
                }),
                cache: false,
                success: function (data) {
                    Title.innerHTML = data;
                    popupCaller ("Questionnaire's title successfully updated");
                }
            });

            Input.value = "";
            Input.type = "hidden";
            Title.hidden = "";
        }
        else if (Input.value != "Votre Questionnaire ...") {
            Input.value = "";
            Input.type = "hidden";
            Title.hidden = "";
        }
    }

    // Activates the hidden input to put the link of the background image
    function ActivateImageInput() {
        var Input = document.getElementById('ImageEdit');
        var Background = document.getElementById('background-questionnaire');
        ImageURL = Background.style.backgroundImage.slice(5, -2);

        if (!ImageURL || ImageURL == "  ") {
            Input.value = "Files/img/undefined.png";
        }
        else {
            Input.value = ImageURL;
        }

        Input.type = "text";
        Input.focus();
        Input.classList.add('dim-page');
    }

    // Changes the epic background picture
    // Only links for the moment because uploading files is too much of a headache (totally doable tho)
    function changeImage(id, Input) {
        var Background = document.getElementById('background-questionnaire');
        var Images = document.getElementById('img-IhateMyLife');
        ImageURL = Background.style.backgroundImage.slice(5, -2);

        if (!Input.value) {
            Input.value = 'Files/img/undefined.png';
            $.ajax({
                type: "POST",
                url: "../Controller/RequestC.php",
                data: ({
                    argument: 'questionnaire',
                    action: 'editImage',
                    idQuestionnaire: id,
                    Image: Input.value
                }),
                cache: false,
                success: function (data) {
                    Background.style.backgroundImage = 'url("' + data + '")';
                    Images.src = data;
                    popupCaller ('Background image has been set to default');
                }
            });
        }
        else if (ImageURL != Input.value && Input.value != "Files/img/undefined.png") {
            $.ajax({
                type: "POST",
                url: "../Controller/RequestC.php",
                data: ({
                    argument: 'questionnaire',
                    action: 'editImage',
                    idQuestionnaire: id,
                    Image: Input.value
                }),
                cache: false,
                success: function (data) {
                    Background.style.backgroundImage = 'url("' + data + '")';
                    Images.src = data;
                    popupCaller ('Background image successfully updated');
                }
            });
        }

        Input.value = "";
        Input.type = "hidden";
        Input.classList.remove('dim-page');
    }

    function imageNotFound(Images, id) {
        var Input = document.getElementById('ImageEdit');
        var Background = document.getElementById('background-questionnaire');

        Images.src = 'Files/img/undefined.png';
        Input.value = 'Files/img/undefined.png';
        //XMLRequestImage (Background, Input, id, "../Controller/editQuestionnaireImage.php?Questionnaire=", "&Image=");
        $.ajax({
            type: "POST",
            url: "../Controller/RequestC.php",
            data: ({
                argument: 'questionnaire',
                action: 'editImage',
                idQuestionnaire: id,
                Image: Input.value
            }),
            cache: false,
            success: function (data) {
                Background.style.backgroundImage = 'url("' + data + '")';
                Images.src = data;
                popupCaller ('Background image could not be found and has been set to default');
            }
        });
    }


    // No questionnaires, all my homies hate questionnaires
    function deleteQuestionnaire (Button) {
        // ID of button is btn-modifier-ID
        var idQuestionnaire = Button.id.slice(13);
        $.ajax({
            type: "POST",
            url: "../Controller/RequestC.php",
            data: ({
                argument: 'questionnaire',
                action: 'delete',
                idQuestionnaire: idQuestionnaire
            }),
            cache: false,
            success: function () {
                $("#div-questionnaire-" + idQuestionnaire).fadeOut('slow', function () {
                    $("#div-questionnaire-" + idQuestionnaire).remove(); 
                });
                popupCaller ('Questionnaire has been sent to Oblivion');
            }
        });
     }



/*         Questions functions              */

    // Show the hidden input besides the question's name and hide the actual question's name
    function ActivateQuestionNameInput(Title, OnLoad) {
        var Input = document.getElementById("input-"+Title.id);

        Title.hidden = "hidden";

        if (!Title.innerHTML || Title.innerHTML == "  ") {
            Input.value = "Question ...";
        }
        else {
            Input.value = Title.innerHTML;
        }

        Input.type = "text";
        if (!OnLoad) {
            Input.focus();
        }
    }

    // Change the question name, i know, who would have thought
    function changeQuestionName(Input) {
        // Input ID is "input-"+Title.id ---- Title.id is question-$id
        // And Title.id contains the ID of the question at the end
        // Therefore to get both IDs, we split with '-' and get the first and last string

        var InputId = Input.id.split ("-");
        var idTitle = InputId[1] + '-' + InputId[2];
        var idQuestion = InputId[2];
        var Title = document.getElementById(idTitle);

        if (!Input.value) {
            XMLRequest (Title, Input, idQuestion, "../Controller/editQuestionName.php?Question=", "&Name=");
            $.ajax({
                type: "POST",
                url: "../Controller/RequestC.php",
                data: ({
                    argument: 'question',
                    action: 'edit',
                    idQuestion: idQuestion,
                    Name: Input.value
                }),
                cache: false,
                success: function (data) {
                    Title.innerHTML = data;
                    popupCaller ('Question title was set to default');
                }
            });

            Input.value = "Question ...";
            Title.innerHTML = "Question ...";
        }
        else if (Title.innerHTML != Input.value && Input.value != "Question ...") {
            $.ajax({
                type: "POST",
                url: "../Controller/RequestC.php",
                data: ({
                    argument: 'question',
                    action: 'edit',
                    idQuestion: idQuestion,
                    Name: Input.value
                }),
                cache: false,
                success: function (data) {
                    Title.innerHTML = data;
                    popupCaller ("Question's title successfully updated");
                }
            });

            Input.value = "";
            Input.type = "hidden";
            Title.hidden = "";
        }
        else if (Input.value != "Question ...") {
            Input.value = "";
            Input.type = "hidden";
            Title.hidden = "";
        }
    }

    // Adds a new question
    function addQuestion (idQuestionnaire) {
        // Epic <div> Epic <div> Epic <div> But never forgot Epic </div>
        document.getElementById ("div-questionnaire").innerHTML += 
        '<div id="div-question-" class="col-md-9"><div class="div-question"><div class="div-title-wrapper2"><h4 id="question-" class="title-questions" onclick="ActivateQuestionNameInput(this, 0)"></h4><input id="input-question-" class="input-newQuestion no-border no-outline" type="hidden" value="" onclick="focus()" onfocusout="changeQuestionName(this)" onkeydown="EnterPressed(event, this)"></div><div class="div-title-wrapper left-margin"><button id="btn-question-" class="btn-del-question" type="button" onclick="deleteQuestion (this)"> <img id="img-question-" class="img-del-question" onload="isEmptyTitle(this.id.slice(4), 2)" src="Files/img/mark.png"> </button></div></div><div id="answer-container-"></div><button id="newAnswer-question-" class="e-btn e-btn-border btn-noborder medium-btn" type="button" onclick="addAnswer(this.id.slice(19))">add answer</button></div>'
        ;
    
        Div = document.getElementById ("div-question-");
        AnswerContainer = document.getElementById ("answer-container-");
        Title = document.getElementById ("question-");
        Input = document.getElementById ("input-question-");
        Button = document.getElementById ("btn-question-");
        Button2 = document.getElementById ("newAnswer-question-");
        Images = document.getElementById ("img-question-");

        $.ajax({
            type: "POST",
            url: "../Controller/RequestC.php",
            data: ({
                argument: 'question',
                action: 'add',
                idQuestionnaire: idQuestionnaire
            }),
            cache: false,
            success: function (data) {
                Div.id += data;
                AnswerContainer.id += data;
                Title.id += data;
                Input.id += data;
                Button.id += data;
                Button2.id += data;
                Images.id += data;
                popupCaller ('Question successfully added');
            }
        });
    
        isEmptyTitleAlt (Title, 1);
    }
    
    // Question is thrown into oblivion
    function deleteQuestion (Button) {
        // ID of button is btn-question-ID
        var idQuestion = Button.id.slice(13);
        $.ajax({
            type: "POST",
            url: "../Controller/RequestC.php",
            data: ({
                argument: 'question',
                action: 'delete',
                idQuestion: idQuestion
            }),
            cache: false,
            success: function () {
                $("#div-question-" + idQuestion).fadeOut('slow', function () {
                    $("#div-question-" + idQuestion).remove(); 
                });
                popupCaller ('Question met its doom');
            }
        });
    
    }



/*         Answers functions              */

    // Same function as the one for the question but some things changed because idk man i had to
    function ActivateAnswerNameInput(Title, OnLoad) {
        var Input = document.getElementById("input-"+Title.id);
        Title.hidden = "hidden";

        if (!Title.innerHTML || Title.innerHTML == "  ") {
            Input.value = "Option ...";
        }
        else {
            Input.value = Title.innerHTML;
        }

        Input.type = "text";
        if (!OnLoad) {
            Input.focus();
        }
    }

    // Changes the answers' name, like, not so obvious title ngl
    function changeAnswerName(Input) {
        // Input ID is "input-"+Title.id ---- Title.id is question-$id
        // And Title.id contains the ID of the question at the end
        // Therefore to get both IDs, we split with '-' and get the first and last string

        var InputId = Input.id.split ("-");
        var idTitle = InputId[1] + '-' + InputId[2];
        var idAnswer = InputId[2];
        var Title = document.getElementById(idTitle);

        if (!Input.value) {
            // XMLRequest (Title, Input, idAnswer, "../Controller/editReponseName.php?Reponse=", "&Name=");
            $.ajax({
                type: "POST",
                url: "../Controller/RequestC.php",
                data: ({
                    argument: 'reponse',
                    action: 'editName',
                    idReponse: idReponse,
                    Name: Input.value
                }),
                cache: false,
                success: function (data) {
                    Title.innerHTML = data;
                    popupCaller ('Answer was set to default');
                }
            });

            Input.value = "Option ...";
            Title.innerHTML = "Option ...";
        }
        else if (Title.innerHTML != Input.value && Input.value != "Option ...") {
            //XMLRequest (Title, Input, idAnswer, "../Controller/editReponseName.php?Reponse=", "&Name=");
            $.ajax({
                type: "POST",
                url: "../Controller/RequestC.php",
                data: ({
                    argument: 'reponse',
                    action: 'editName',
                    idReponse: idReponse,
                    Name: Input.value
                }),
                cache: false,
                success: function (data) {
                    Title.innerHTML = data;
                    popupCaller ('Answer successfully modified');
                }
            });

            Input.value = "";
            Input.type = "hidden";
            Title.hidden = "";
        }
        else if (Input.value != "Option ...") {
            Input.value = "";
            Input.type = "hidden";
            Title.hidden = "";
        }
    }

    // Never gonna guess, this function right down there, it can cook a chicken with 491,000 Slaps
    function addAnswer (idQuestion) {
        // I had to change some data in that huge ass line haha good times                                                                                                                                                                                                                                                      may someone end my life right here right now
        document.getElementById ("answer-container-" + idQuestion).innerHTML += 
        '<div id="div-reponse-" class="question-answer"><div class="div-title-wrapper"><input id="reponse-" disabled="true" class="input-reponses" type="checkbox" value="1" name="reponse-" ></div><div class="div-title-wrapper smol-width"><label id="reponselabel-" class="label-reponses" onclick="ActivateAnswerNameInput(this, 0)"></label><input id="input-reponselabel-" class="input-newReponse no-border no-outline" type="hidden" value="" onclick="focus()" onfocusout="changeAnswerName(this)" onkeydown="EnterPressed(event, this)"></div><div class="div-title-wrapper left-margin"><button id="btn-reponse-" class="btn-del-answer" type="button" onclick="deleteAnswer (this)"> <img id="del-reponselabel-" class="img-del-answer" onload="isEmptyTitle(this.id.slice(4), 3)" src="Files/img/mark.png"></button></div></div>'
        ;
    
        Div = document.getElementById ("div-reponse-");
        Title = document.getElementById ("reponselabel-");
        Input = document.getElementById ("reponse-");
        Input2 = document.getElementById ("input-reponselabel-");
        Button = document.getElementById ("btn-reponse-");
        Images = document.getElementById ("del-reponselabel-");

        $.ajax({
            type: "POST",
            url: "../Controller/RequestC.php",
            data: ({
                argument: 'reponse',
                action: 'add',
                idQuestion: idQuestion
            }),
            cache: false,
            success: function (data) {
                Div.id += data;
                Title.id += data;
                Input.id += data;
                Input.name += data;
                Input2.id += data;
                Button.id += data;
                Images.id += data;
                popupCaller ('Answer successfully added');
            }
        });
    
        isEmptyTitleAlt (Title, 2);
    }
    
    // Fuck you answer
    function deleteAnswer (Button) {
        // ID of button is btn-reponse-ID
        var idReponse = Button.id.slice(12);
        $.ajax({
            type: "POST",
            url: "../Controller/RequestC.php",
            data: ({
                argument: 'reponse',
                action: 'delete',
                idReponse: idReponse
            }),
            cache: false,
            success: function () {
                $("#div-reponse-" + idReponse).fadeOut('slow', function () {
                    $("#div-reponse-" + idReponse).remove(); 
                });
                popupCaller ('Answer successfully deleted');
            }
        });
    }



/*         Checkboxes / AnswersValidity Functions              */

    // Making a separate function is somewhat mandatory if we want the variable (idReponse in this case) to stay the same during the execution
    // The variable might change before the request ends, therefor we instead set it when calling it through a function
    function DisableCheckboxCall(idReponse) {
        $.ajax({
            type: "POST",
            url: "../Controller/RequestC.php",
            data: ({
                argument: 'reponse',
                action: 'fetchValidity',
                idReponse: idReponse
            }),
            cache: false,

            success: function (data) {
                console.log(idReponse, '#reponse-'+idReponse);
                if (parseInt(data)) {
                    $('#reponse-' + idReponse).prop("checked", true);
                }
                else {
                    $('#reponse-' + idReponse).prop("checked", false);
                }
            },
        })
    }

    // Just guess the functions function i'm tired of this
    function DisableCheckbox() {
        Answers = document.getElementsByClassName("input-reponses");
        

        for (i = 0; i < Answers.length; i++) {
            idReponse = Answers[i].id.slice(8);
            DisableCheckboxCall(idReponse);
            Answers[i].disabled = true;
        }
    }

    function ActivateCheckbox (ButtonSet) {
        Answers = document.getElementsByClassName("input-reponses");
        ButtonConfirm = document.getElementById("confirm-key");

        ButtonSet.hidden = "hidden";
        ButtonConfirm.hidden = "";

        for (i=0; i < Answers.length; i++) {
            Answers[i].disabled = false;
        }
    }

    function setAnswersKey(ButtonConfirm) {
        Answers = document.getElementsByClassName("input-reponses");
        ButtonSet = document.getElementById("answer-key");

        for (i = 0; i < Answers.length; i++) {
            // Calls a .php file to send the "validite" attribute to the database and get it back
            // Checked cases    --> validite = 1
            // UnChecked cases  --> validite = 0
            idReponse = Answers[i].id.slice(8);
            
            // Use this to send both the ID and the Input at the same time
            if (Answers[i].checked) {
                $.ajax({
                    type: "POST",
                    url: "../Controller/RequestC.php",
                    data: ({
                        argument: 'reponse',
                        action: 'editValidity',
                        idReponse: idReponse,
                        Validity: 1
                    }),
                    cache: false,
                    success: function (data) {
                    }
                })
                //Answers[i].setAttribute("checked", "");
            }
            else {
                $.ajax({
                    type: "POST",
                    url: "../Controller/RequestC.php",
                    data: ({
                        argument: 'reponse',
                        action: 'editValidity',
                        idReponse: idReponse,
                        Validity: 0
                    }),
                    cache: false,
                    success: function (data) {
                    },
                })
                //Answers[i].removeAttribute("checked");
            }
        }

        DisableCheckbox();
        popupCaller ('Key Answers correctly set');
        ButtonSet.hidden = "";
        ButtonConfirm.hidden = "hidden";
    }



/*        PoPuP stuff functions and all that        */

    var active = 0;

    function popupDefiner (content, idPopup) {
        // Create a new popup with some stuff written inside
        $('<div id="' + idPopup + '" class="popup"><p class="popup-text">' + content + '</p></div>').appendTo('#popupContainer');

        // Remove the added popup after some time (1 second by default)
        setTimeout (
            function () {
                $('#'+ idPopup).fadeOut('slow', function() {
                    $('#' + idPopup).remove(); 
                    
                })
            },
            1000
        );
    }

    function popupCaller (content) {
        idPopup = 'popup' + active;
        active++;
        popupDefiner (content, idPopup);
    }







/*          Set the timer value and the confirmation boxes or something     */

function forceValue(Input) {
    if (Input.value > 1000) {
       Input.value = 1000;
    }
    else if (Input.value < 5) {
       Input.value = 5;
    }

    $.ajax({
        type: "POST",
        url: "../Controller/RequestC.php",
        data: ({
            argument: 'questionnaire',
            action: 'editTimer',
            idQuestionnaire: Input.id.slice(6),
            timer: Input.value
        }),
        cache: false,
        success: function () {
            popupCaller ('Timer correctly set');
        },
    });

 }