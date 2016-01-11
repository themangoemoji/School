package edu.msu.wrigh517.hangman;

import java.util.Random;

/**
 * Simple class to generate random words
 */
public class Words {
    /**
     * Some random words in lengths 4 to 7
     */
    private String[] words = {"moon","home","mega","blue","send","frog","book","hair","late",
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
            "stomach","torpedo","vampire","vulture"
    };

    /**
     * Random number generator
     */
    private Random random = new Random();

    /**
     * Get a random word
     * @return Randomly selected word
     */
    public String word() {
        return words[random.nextInt(words.length)];
    }
}
