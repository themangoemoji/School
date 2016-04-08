# Quizzes

## Q1

```php
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Welcome to Loop Land!</title>
<link rel="stylesheet" href="jsloop/loopland.css" />


<script>

var str = "<table>";
str += "<tbody>";

// Loop over rows, <tr><td></td></tr>
for(var r=1; r<=5; r++) {
  str += "<tr>";

  for(var c=1; c<=5;  c++) {
    str += "<td>";
    str += r * c;
    str += "</td>";
  }

  str += "</tr>"
}
str += "</tbody>"
str += "</table>"
console.log(str);

</script>


</head>
<body>
<header><h1>Welcome to Loop Land</h1></header>

<div id="result"></div>

<script>
document.getElementById("result").innerHTML = str;
</script>

<footer><p>Loop Land!</p></footer>
</body>
</html>

```

## Quadratic Exercise

```javascript
function stripOne(letter) {
  if (letter == 1) {
    letter = "";
  }
  if (letter == -1) {
    letter = "-";
  }

  return letter;
}

function displayQuadratic(id, a, b, c) {

  a = stripOne(a);
  b = stripOne(b);

  var html = "<p>" + a + "x<sup>2</sup> + " +
    b + "x + " + c + "</p>";

  document.getElementById(id).innerHTML = html;
}

```


## Quiz 2

**page.php**

```php
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Welcome to Loop Land!</title>
<link rel="stylesheet" href="jsloop/loopland.css" />    
</head>
<body>
<header><h1>Welcome to Loop Land</h1></header>

<div id="result"></div>


<script>
displayMultTable("result");
</script>

<footer><p>Loop Land!</p></footer>
</body>
</html>
```


**page.js**


```js
function displayMultTable(id) {

  var str = "<table>";
  str += "<tbody>";

  // Loop over rows, <tr><td></td></tr>
  for(var r=1; r<=5; r++) {
    str += "<tr>";

    for(var c=1; c<=5;  c++) {
      str += "<td>";
      str += r * c;
      str += "</td>";
    }

    str += "</tr>"
  }
  str += "</tbody>"
    str += "</table>"
    console.log(str);

  document.getElementById(id).innerHTML = str;
}
```

## Clicker Exercise

```php
b1.onclick = function() {
  if(b1.innerHTML === "Press Me") {
    b1.innerHTML = "&nbsp;";
    b2.innerHTML = "No, Me";
  }
}
b2.onclick = function() {
  if(b2.innerHTML === "No, Me") {
    b2.innerHTML = "&nbsp;";
    b3.innerHTML = "Try Again";
  }
}
b3.onclick = function() {
  if(b3.innerHTML === "Try Again") {
    b3.innerHTML = "&nbsp;";
    b1.innerHTML = "Press Me";
  }
}
```

## Quiz 3

**page.php**

```php
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<body>

<p id="message">Right Side Up</p>
<button onclick=flip() id="bflip">Flip Me</button>
</body>
</html>
```

**page.js**

```js
function flip() {
  message = document.getElementById("message");
  if (message.innerHTML === "Right Side Up") {
    message.style.transform = "rotate(180deg)"; 
    message.innerHTML = "Upside Down";
    message.style.textAlign = "right";
  }
  else {
    message.style.transform = "rotate(0deg)";
    message.innerHTML = "Right Side Up";
    message.style.textAlign = "left";
  }
}
```



## Quiz 4

**page.php**

```php
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>


</head>
<body>

<p><a onclick=accordion() id="expand"><img id="image" src="plus.png" width="16" height="16"> 
Expand to read script</a></p>
<div id="region">
<hr>
<p>Dr. Phibes: I will have killed nine times in my life, Dr. Vesalius; 
how many murders can be attributed to you?</p>
<p>Dr. Vesalius: None, for I did not kill your wife!</p>
<p>Dr. Phibes: No?</p>
<p>Dr. Vesalius: I tried to save her...</p>
<p>Dr. Phibes: With a knife in your hands? </p>
<hr>
</div>

</body>
</html>
```

**page.js**

```js
function accordion() {


  var expand = document.getElementById("expand");
  var hide = document.getElementById("region");
  image = document.getElementById("image");


  if (image.src === "https://webdev.cse.msu.edu/~cse477/playground/load/plus.png") {
    region.style.display = "none";
    image.src = image.src.replace("plus", "minus");
  }
  else {
    region.style.display = "block";
    image.src = image.src.replace("minus", "plus");
  }



}
```

## Confirm Deletion Example:

When we want to delete something, we need to confirm it. We use this with an `onclick` function.

We'll put this in our php:

**page.php**

```php
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<body>

<form method="post" action="post.php">
<input onclick="confirmDelete(event)" type="submit" value="Delete!">


</form>

</body>
</html>
```

And to see the effect, we'll put something simple in our post.php:

**post.php**

```php
<?php
echo "Deleted!";
```

And finally, here's what we have in our javascript:

**page.js**

```php
function confirmDelete(event) {
  if(!confirm('Are you sure?')) {
    event.preventDefault();
  }
}
```

The `preventDefault()` prevents the default behaviour of redirecting to the post page.


## Quiz 5 - Form Guessing Game

**page.js**

```php

function generateNewRandom(known) {
  if (known != -1) {
    console.log("known: " + known);
    return known;
  }        
  return Math.floor(Math.random() * 100) + 1;   

}


function guessNum(event) {

  event.preventDefault();            
  var guess = document.getElementById("guess").value;    
  var result = document.getElementById("result");
  var hidden_answer = document.getElementById("answer");
  //hidden_answer.style.visibility = "hidden";
  var answer;                          

  if ( guess === "" ) {

    console.log("hidden_answer: " + hidden_answer.innerHTML);        

    // If no random has been generated yet    
    if ( hidden_answer.innerHTML === "" ) {
      var answer = generateNewRandom(-1);
      console.log("first random gen: " + answer);
      hidden_answer.innerHTML = answer;
    }

    else {
      console.log("Answer has been set already to: " + answer);
      result.innerHTML = "Silly you, enter a number!";
    }

  }

  answer = generateNewRandom(answer);

  else {

    console.log(guess);
    console.log(answer);

    if (guess > answer) {
      result.innerHTML = "Too high!";
    }

    if (guess < answer) {
      result.innerHTML = "Too low!";
    }
  }

}

```

**page.php**

```php
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>

<script>
window.onload = guessNum;
</script>

</head>
<body>


<form method="post" action="post.php">

<p><label for="guess">Guess: </label><input type="text" id="guess"></p>
<p><input onclick="guessNum(event)" type="submit"> <a href="" id="giveup">I give up!</a></p>
<p id="result">&nbsp;</p>
<p id="answer" style></p>
<input onclick="guessNum(event)" type="submit" value="Submit">


</form>

</body>
</html>
```

## Combination Lock Example

**page.php**

```php
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Combination Lock</title>
<script>
window.onload = combi;
</script>
<style>
input[type="submit"] {
width: 5em;
margin: 0.5em;
}

p {
  text-align: center;
}
</style>
</head>
<body>

<div id="lock"></div>

</body>
</html>
```

**page.js**

```js 
function combi() {
  // The current combination as entered
  var code = "";

  // The secret code we are looking for
  var secret = "CABB";

  /*
   * Create the HTML and put it into the div
   */
  var lock = document.getElementById("lock");

  var html = '<form>' + 
    '<p id="code">&nbsp;</p>' +
    '<p>' +
    '<input type="submit" id="A" value="A">' +
    '<input type="submit" id="B" value="B">' +
    '<input type="submit" id="C" value="C">' +
    '<input type="submit" id="D" value="D">' +
    '<input type="submit" id="clear" value="Clear"></p>' +
    '<p id="status">Closed</p></form>';

  lock.innerHTML = html;

  /*
   * Install clear listener
   */
  document.getElementById("clear").onclick = function(event) {
    event.preventDefault();
    code = "";
    update();
  }

  /*
   * Install button listeners
   */
  installListener("A");
  installListener("B");
  installListener("C");
  installListener("D");


  /*
   * Install a button listener. I assume the 
   * button id is the letter we are clicking 
   */
  function installListener(letter) {
document.getElementById(letter).onclick = function(event) {
            event.preventDefault();


