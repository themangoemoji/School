package edu.msu.wrigh517.michaelwrightmadhatter;

import android.app.Activity;
import android.content.Intent;
import android.database.Cursor;
import android.graphics.Color;
import android.net.Uri;
import android.provider.MediaStore;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.Spinner;

public class HatterActivity extends AppCompatActivity {
    // We need a color to return from ColorSelectActivity
    private static final int GOT_COLOR = 1;

    /**
     * Request code when selecting a picture
     */
    private static final int SELECT_PICTURE = 1;

    /**
     * The hatter view object
     */
    private HatterView getHatterView() {
        return (HatterView) findViewById(R.id.hatterView);
    }

    /**
     * The color select button
     */
    private Button getColorButton() {
        return (Button)findViewById(R.id.buttonColor);
    }

    /**
     * The feather checkbox
     */
    private CheckBox getFeatherCheck() {
        return (CheckBox)findViewById(R.id.checkFeather);
    }

    /**
     * The hat choice spinner
     */
    private Spinner getSpinner() {
        return (Spinner) findViewById(R.id.spinnerHat);
    }





    // The bundle tag for params
    private static final String PARAMETERS = "parameters";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_hatter);

         /*
         * Set up the spinner
         */

        // Create an ArrayAdapter using the string array and a default spinner layout
        ArrayAdapter<CharSequence> adapter = ArrayAdapter.createFromResource(this,
                R.array.hats_spinner, android.R.layout.simple_spinner_item);

        // Specify the layout to use when the list of choices appears
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);



        // Apply the adapter to the spinner
        getSpinner().setAdapter(adapter);

        // Annonymous nested class
        getSpinner().setOnItemSelectedListener(new Spinner.OnItemSelectedListener() {

            @Override
            public void onItemSelected(AdapterView<?> arg0, View view,
                                       int pos, long id) {
                getHatterView().setHat(pos);
                Button myButton = (Button) findViewById(R.id.buttonColor);
                if (getHatterView().getHat() == HatterView.HAT_BLACK) {
                    myButton.setEnabled(false);
                }
                if (getHatterView().getHat() == HatterView.HAT_GRAY) {
                    myButton.setEnabled(false);
                }
                if (getHatterView().getHat() == HatterView.HAT_CUSTOM) {
                    myButton.setEnabled(true);
                }
            }

            @Override
            public void onNothingSelected(AdapterView<?> arg0) {
            }

        });

        /*
         * Restore any state
         */
        if(savedInstanceState != null) {
            getHatterView().getFromBundle(PARAMETERS, savedInstanceState);


            getSpinner().setSelection(getHatterView().getHat());
        }

    }

    /**
     * Handle a Picture button press
     * @param view
     */
    public void onPicture(View view) {
        // Get a picture from the gallery

        // Get an initially empty intent
        Intent intent = new Intent();
        intent.setType("image/*");
        intent.setAction(Intent.ACTION_GET_CONTENT);

        // Pass the intent and get back the request code
        startActivityForResult(Intent.createChooser(intent, "Select Picture"), SELECT_PICTURE);
    }

    /**
     * Handle a Color button press
     * @param view
     */
    public void onColor(View view) {
        // Load image of color selector
        Intent intent = new Intent(this, ColorSelectActivity.class);
        startActivityForResult(intent, GOT_COLOR);
    }




    /**
     * Handle a Picture button press
     * @param view
     */
    public void onFeather(View view) {

        //HatterView.setDrawtheFeather(!featherVal);
        getHatterView().setDrawtheFeather( ! getHatterView().getDrawtheFeather() );

    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        if(requestCode == SELECT_PICTURE && resultCode == Activity.RESULT_OK) {
            /* Response from the picture selection activity */
            Uri imageUri = data.getData();

            // We have to query the database to determine the document ID for the image
            Cursor cursor = getContentResolver().query(imageUri, null, null, null, null);
            cursor.moveToFirst();
            String document_id = cursor.getString(0);
            document_id = document_id.substring(document_id.lastIndexOf(":")+1);
            cursor.close();

            // Next, we query the content provider to find the path for this
            // document id.
            cursor = getContentResolver().query(
                    android.provider.MediaStore.Images.Media.EXTERNAL_CONTENT_URI,
                    null, MediaStore.Images.Media._ID + " = ? ", new String[]{document_id}, null);
            cursor.moveToFirst();
            String path = cursor.getString(cursor.getColumnIndex(MediaStore.Images.Media.DATA));
            cursor.close();

            if(path != null) {
                Log.i("Path", path);
                getHatterView().setImagePath(path);
            }

            //if(requestCode == GOT_COLOR && resultCode == Activity.RESULT_OK) {
            if(resultCode == Activity.RESULT_OK) {
                // This is a color response
                int color = data.getIntExtra("colorString", Color.BLACK);
                getHatterView().setColor(color);
            }

        }
    }

    @Override
    protected void onSaveInstanceState(Bundle outState) {
        super.onSaveInstanceState(outState);

        getHatterView().putToBundle(PARAMETERS, outState);
    }





}
