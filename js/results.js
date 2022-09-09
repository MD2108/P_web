/*         Test Verifications/Timer Functions              */

function setScore (arg) {
    var questions = document.getElementsByClassName ('title-questions');
    var answers;

    var answer;
    var Answered = [];

    var score = 0;
    
    // arg determines the type of the Quizz (mainly how the score is calculated)
    // As of now it's : 
    // 0 - European Quizz
    // 1 - European Quizz but different I guess
    // 2 - American Quizz
    // 3 - Q.C.U
    switch (arg) {
        case 0:
            // European Quizz
            // 1 point per good answer, no point if one bad answer in the question
            for (i = 0; i < questions.length; i++) {
                answers = document.getElementsByClassName ('input-questions ' + questions[i].id);
                answer = null;

                for (j = 0; j < answers.length; j++) {
                    // Good Answer
                    if (answers[j].checked && parseInt(answers[j].value)) {
                        if (answer != 0) {
                            answer++;
                        }
                        Answered.push(answers[j].id + '-1');
                    }
                    // Bad Answer
                    if (answers[j].checked && !parseInt(answers[j].value)) {
                        answer = 0;
                        Answered.push(answers[j].id + '-0');
                    }
                    // If a previous answer was bad, all the others will be counted as "bad" but the input will not be registrered
                    else if (answer == 0) {
                        answer = 0;
                    }

                    if (!answers[j].checked) {
                        Answered.push(answers[j].id + '-');
                    }
                }
                score += answer;
            }
        break;

        case 1:
            // Standard European Quizz
            // 1 point per question, all answers in the question must be right, no point if one bad answer in the question
            for (i = 0; i < questions.length; i++) {
                answers = document.getElementsByClassName ('input-questions ' + questions[i].id);
                answer = null;
                count = 0;

                for (j = 0; j < answers.length; j++) {
                    // Count the number of right answers
                    if (parseInt(answers[j].value)) {
                        count++;
                    }
                    // Good Answer
                    if (answers[j].checked && parseInt(answers[j].value)) {
                        if (answer != 0) {
                            answer++;
                        }
                        Answered.push(answers[j].id + '-1');
                    }
                    // Bad Answer
                    if (answers[j].checked && !parseInt(answers[j].value)) {
                        answer = 0;
                        Answered.push(answers[j].id + '-0');
                    }
                    // If a previous answer was bad, all the others will be counted as "bad" but the input will not be registrered
                    else if (answer == 0) {
                        answer = 0;
                    }

                    if (!answers[j].checked) {
                        Answered.push(answers[j].id + '-');
                    }
                }
                if (count > 0 && answer == count) {
                    score++;
                }
            }
        break;

        case 2:
            // Standard American Quizz
            // one point per good answer, one loss per bad answer
            answers = document.getElementsByClassName ('input-questions');

            for (i = 0; i < answers.length; i++) {
                // This conditions makes it so that everytime a good answer is checked, the user gains score
                // This doesn't "remove" points if a bad answer is selected in the same answer
                if (answers[i].checked && parseInt(answers[i].value)) {
                    score++;
                    Answered.push (answers[j].id + '-1');
                }

                // This conditions makes it so that everytime a bad answer is checked, the user looses score
                // Many bad answer in the same answer will make you loose many points
                else if (answers[i].checked && !parseInt(answers[i].value)) {
                    score--;
                    Answered.push (answers[i].id + '-0');
                }

                if (!answers[j].checked) {
                    Answered.push(answers[j].id + '-');
                }
            }
        break;

        case 3:
            // idk name of this one in english and i'm too lazy to check
            // Basically you can have only one answer per question, and one point per question. If the answer is wrong you don't loose points
            for (i = 0; i < questions.length; i++) {
                answers = document.getElementsByClassName ('input-questions ' + questions[i].id);

                for (j = 0; j < answers.length; j++) {
                    // Good Answer
                    if (answers[j].checked && parseInt(answers[j].value)) {
                        score++;
                        Answered.push(answers[j].id + '-1');
                        break;
                    }
                    // Bad Answer
                    if (answers[j].checked && !parseInt(answers[j].value)) {
                        Answered.push(answers[j].id + '-0');
                        break;
                    }

                    if (!answers[j].checked) {
                        Answered.push(answers[j].id + '-');
                    }
                }
            }

        break;
    }

    // Answered contains all the answers from the user
    // The last element of Answered (Answered[Answered.length - 1]) is the final score
    
    Answered.push (score);

    document.getElementById ('confirm-finish-data').value = Answered;

}

function submitScore (arg, idForm) {
    setScore (arg);
    document.getElementById(idForm).submit();
}


function setTimer (Timer) {
    const count = document.getElementById('timer-test');

    // Timer : h:i:s || hours:minutes:seconds
    Timer = Timer.split(':');
    var time = parseInt(Timer[0])*3600 + parseInt(Timer[1])*60 + parseInt(Timer[2]);

    // for testing
    // Timer = 0.1;

    var timerCall = setInterval (function () {
        if (time >= 0) {
            time = updateTimer(time, count);
        }
        else {
            clearInterval(timerCall);
            submitScore(1, 'test-form');
        }
    }, 1000);
}

function updateTimer (time, count) {
    const hours = Math.floor(time / 3600);
    var minutes = Math.floor(time / 60) % 60;
    var seconds = time % 60;

    if (seconds < 10) {
        seconds = '0' + seconds;
    }
    if (hours && minutes < 10) {
        minutes = '0' + minutes;
    }

    if (hours) {
        count.innerHTML = `${hours}:${minutes}:${seconds}`;
    }
    else {
        count.innerHTML = `${minutes}:${seconds}`;
    }

    return --time;
}