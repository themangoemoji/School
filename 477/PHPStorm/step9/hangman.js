/**
 * Created by mhw on 4/7/16.
 */
function hangman() {

    function randomWord() {
        var words = ["moon","home","mega","blue","send","frog","book","hair","late",
            "club","bold","lion","sand","pong","army","baby","baby","bank","bird","bomb","book",
            "boss","bowl","cave","desk","drum","dung","ears","eyes","film","fire","foot","fork",
            "game","gate","girl","hose","junk","maze","meat","milk","mist","nail","navy","ring",
            "rock","roof","room","rope","salt","ship","shop","star","worm","zone","cloud",
            "water","chair","cords","final","uncle","tight","hydro","evily","gamer","juice",
            "table","media","world","magic","crust","toast","adult","album","apple",
            "bible","bible","brain","chair","chief","child","clock","clown","comet","cycle",
            "dress","drill","drink","earth","fruit","horse","knife","mouth","onion","pants",
            "plane","radar","rifle","robot","shoes","slave","snail","solid","spice","spoon",
            "sword","table","teeth","tiger","torch","train","water","woman","money","zebra",
            "pencil","school","hammer","window","banana","softly","bottle","tomato","prison",
            "loudly","guitar","soccer","racket","flying","smooth","purple","hunter","forest",
            "banana","bottle","bridge","button","carpet","carrot","chisel","church","church",
            "circle","circus","circus","coffee","eraser","family","finger","flower","fungus",
            "garden","gloves","grapes","guitar","hammer","insect","liquid","magnet","meteor",
            "needle","pebble","pepper","pillow","planet","pocket","potato","prison","record",
            "rocket","saddle","school","shower","sphere","spiral","square","toilet","tongue",
            "tunnel","vacuum","weapon","window","sausage","blubber","network","walking","musical",
            "penguin","teacher","website","awesome","attatch","zooming","falling","moniter",
            "captain","bonding","shaving","desktop","flipper","monster","comment","element",
            "airport","balloon","bathtub","compass","crystal","diamond","feather","freeway",
            "highway","kitchen","library","monster","perfume","printer","pyramid","rainbow",
            "stomach","torpedo","vampire","vulture"];

        return words[Math.floor(Math.random() * words.length)];
    }

    var stage = 0;
    var image_path = "assets/hm" + stage + ".png";

    var guess = "";



    var answer = randomWord();



    console.log("Random word: " + answer);

    var play_area = document.getElementById("play-area");

    var formHTML = '<form xmlns="http://www.w3.org/1999/html">' +

        '<img id="image" src="' + image_path + '">' +


            //    Install Label and guessing box
        '<p>' +
        '<label for="letter">Guess Letter: </label>' +
        '<input type="text" maxlength="1" minlength="1" id="letter"></p>' +

            //   Install buttons
        '<p>' +
        '<input type="submit" id="b_guess" value="Guess!">' +
        '<input type="submit" id="new_game" value="New Game">' +
        '</p>' +

            // Guess Message
        '<p id="guess"></p>' +

            // Lose Message
        '<p id="message"></p>' +

            //    Install secret word
        '<input type="hidden" id="word" value="">' +

        '</form>';

    play_area.innerHTML += formHTML;

    document.getElementById("word").innerHTML = answer;
    document.getElementById("word").value = answer;



    // Make first word
    install_word();


    /*
     * Install new_game listener
     */
    document.getElementById("new_game").onclick = function(event) {
        event.preventDefault();
        answer = randomWord();
        document.getElementById("word").value = answer;
        console.log(answer);
        new_game();
    }

    // Not really necessary
    installGuessButton();

    /*
     * Install a button listener. I assume the
     * button id is the letter we are clicking
     */
    function installGuessButton() {
        document.getElementById("b_guess").onclick = function(event) {
            event.preventDefault();
            var letter = document.getElementById("letter").value;

            update(letter);
        }
    }

    /*
     * Update the code and status paragraphs to indicate
     * the current word and lock status
     */


    function update(letter) {
        console.log(answer + " contains " + letter + "?: " + answer.indexOf(letter));

        if (letter == "") {
            document.getElementById("message").innerHTML = "You must enter a letter!";
            return;
        }

        // Wrong Letter && No Letter Conditions
        // 1. Increase the stage
        // 1. change image
        if (! contained(letter) && letter != "") {
            // Max out the stage increasing at 6
            if (stage < 6) {
                stage++;
            }
            // If we reach 6, you lose
            if (stage >= 6) {
                lose();
            }

            image_path = "assets/hm" + stage + ".png";
            document.getElementById("image").src = image_path;
        }// end if not found


        // Right Letter
        if (letter != "") {
            update_positions(letter);
        }





    }


    /*
     * Update the code and status paragraphs to indicate
     * the current word and lock status
     */
    function new_game() {
        // Reset the lose message
        document.getElementById("message").innerHTML = "";

        // Make new word
        install_word();
        document.getElementById("word").innerHTML = answer;

        // Reset the image
        update_image(0);

        console.log("New Game Pressed: " + answer);
    }

    function update_image(num) {
        stage = num;
        image_path = "assets/hm" + stage + ".png";
        document.getElementById("image").src = image_path;
    }

    function update_positions(ch) {

        for (var i = 0; i < answer.length; i++) {
            if (answer[i] === ch) {
                // var adjustment = (answer.length * 2) - 1;
                console.log("Found letter: " + ch + " in " + answer + " at " + i);

                // Write from answer to guess
                guess[i] = ch;
                write_word();

                // Answer = guess, WIN

                if (won()) {
                    console.log("WIN");
                    document.getElementById("message").innerHTML = "You Win!";
                }

            }
        }
    }


    // Re-writes the blank word
    function install_word() {
        guess.innerHTML = "";
        guess = document.getElementById("guess");
        for (var i = 0; i < answer.length; i++) {
            // Last underscore
            guess[i] = "_";
        }

        write_word();


    }

    // Re-writes the blank word
    function write_word() {
        guess.innerHTML = "";
        guess = document.getElementById("guess");
        for (var i = 0; i < answer.length; i++) {
            // Last underscore
            guess.innerHTML += guess[i];
            guess.innerHTML += " ";
        }


    }

    function won() {
        var count = 0;
        for (var i = 0; i < answer.length; i++) {
            console.log (guess[i] + " " + answer[i]);
            if (guess[i] == answer[i]) {
                count++;
            }
        }
        if (count == answer.length) {
            return true;
        }
        return false;
    }

    function lose() {
        document.getElementById("message").innerHTML = 'You guessed poorly!';
        for (var i = 0; i < answer.length; i++) {
            // Last underscore
            guess[i] = answer[i];
        }
        write_word();
    }

    function contained(letter) {
        for (var i = 0; i < answer.length; i++) {
            // Last underscore
            if (answer[i] == letter) {
                return true;
            }
        }
        return false;

    }


}

