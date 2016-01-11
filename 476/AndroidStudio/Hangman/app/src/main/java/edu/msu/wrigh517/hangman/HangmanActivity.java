package edu.msu.wrigh517.hangman;

import android.app.Activity;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;

import java.util.ArrayList;

public class HangmanActivity extends AppCompatActivity {

    static final String RANDOM_WORD = "randomWord";
    static final String COVERED_WORD = "coveredWord";
    static final String PREVIOUS_GUESSES = "previousGuesses";
    static final String MISSES = "misses";

    private char[][] letters = {{'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'},
            {'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R'},
            {'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', ' '}};


    private String randomWord;
    private String coveredWord = "";
    private int misses = 0;
    private String previousGuesses = "";


    public void drawGallows(int misses) {
        ImageView harold = (ImageView) findViewById(R.id.gallowsView);
        switch (misses) {
            case 0:
                break;
            case 1:
                harold.setImageResource(R.drawable.hm1);
                break;
            case 2:
                harold.setImageResource(R.drawable.hm2);
                break;
            case 3:
                harold.setImageResource(R.drawable.hm3);
                break;
            case 4:
                harold.setImageResource(R.drawable.hm4);
                break;
            case 5:
                harold.setImageResource(R.drawable.hm5);
                break;
            case 6:
                harold.setImageResource(R.drawable.hm6);
                coveredWord = randomWord;
                ((TextView) findViewById(R.id.textView)).setText(randomWord);
                break;
            default:
                harold.setImageResource(R.drawable.hm6);
                coveredWord = randomWord;
                ((TextView) findViewById(R.id.textView)).setText(randomWord);
                break;
        }
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_hangman);
        Words privateWord = new Words();// = Words.word();
        randomWord = privateWord.word();
        randomWord = randomWord.toUpperCase();
                ((TextView) findViewById(R.id.textView)).setText(randomWord);
        for (int mine = 0; mine < randomWord.length(); mine++) {
            coveredWord += "_";
        }
        ((TextView) findViewById(R.id.textView)).setText(coveredWord);
        Log.i("String = ", randomWord);

        if (savedInstanceState != null) {
            // Restore value of members from saved state
            misses = savedInstanceState.getInt(MISSES);
            randomWord = savedInstanceState.getString(RANDOM_WORD);
            previousGuesses = savedInstanceState.getString(PREVIOUS_GUESSES);
            coveredWord = savedInstanceState.getString(COVERED_WORD);

            drawGallows(misses);
            ((TextView) findViewById(R.id.textView)).setText(coveredWord);
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_hangman, menu);
        return true;
    }


    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    public void selectKey(int row, int column) {
        char letter = letters[row][column];
        Log.i("Letter: ", String.valueOf(letter));
        takeTurn(letter);
    }

    public void takeTurn(char guessChar) {
        // If we have already seen this before, we have to recognize that
        boolean haveseen = false;
        boolean found = false;
        for (int ch = 0; ch < previousGuesses.length(); ch++) {
            if (guessChar == previousGuesses.charAt(ch)) {
                haveseen = true;
                Log.i("HAVE SEEN", "");
            }
        }

        previousGuesses += guessChar;
        if (! haveseen) {
            String guess = null;

            Log.i("Found ", String.valueOf(guessChar));
            Log.i("In ", randomWord);
            for (int ch = 0; ch < randomWord.length(); ch++) {
                // If a char has been found
                if (randomWord.charAt(ch) == guessChar) {

                    found = true;
                    Log.i("Found ", String.valueOf(ch));
                    Log.i("In ", randomWord);
                    guess = coveredWord.substring(0, ch) + guessChar + coveredWord.substring(ch + 1);
                    coveredWord = guess;
                    ((TextView) findViewById(R.id.textView)).setText(guess);
                }
            }
        }

        if (!found || haveseen) {
            misses += 1;
            drawGallows(misses);
            Log.i("NOOOO", String.valueOf(misses));
        }
    }

    public void newGame(View view) {
        ImageView harold = (ImageView) findViewById(R.id.gallowsView);
        harold.setImageResource(R.drawable.hm0);
        Words privateWord = new Words();
        randomWord = privateWord.word();
        randomWord = randomWord.toUpperCase();
        coveredWord = "";
        previousGuesses = "";
        misses = 0;
        ((TextView) findViewById(R.id.textView)).setText(randomWord);
        for (int mine = 0; mine < randomWord.length(); mine++) {
            coveredWord += "_";
        }
        ((TextView) findViewById(R.id.textView)).setText(coveredWord);
        Log.i("String = ", randomWord);
    }

    @Override
    protected void onSaveInstanceState(Bundle bundle) {
        bundle.putString(RANDOM_WORD, randomWord);
        bundle.putString(COVERED_WORD, coveredWord);
        bundle.putString(PREVIOUS_GUESSES, previousGuesses);
        bundle.putInt(MISSES, misses);
    }

}
