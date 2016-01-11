package edu.msu.wrigh517.cloudhatter;

import android.annotation.SuppressLint;
import android.app.AlertDialog;
import android.app.Dialog;
import android.app.DialogFragment;
import android.content.DialogInterface;
import android.os.Bundle;
import android.os.Looper;
import android.util.Xml;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import org.xmlpull.v1.XmlPullParser;
import org.xmlpull.v1.XmlPullParserException;

import java.io.IOException;
import java.io.InputStream;

/**
 * Created by mhw on 11/1/15.
 */
public class SaveDlg extends DialogFragment {
    private AlertDialog dlg;

    @Override
    public Dialog onCreateDialog(Bundle savedInstanceState) {
        AlertDialog.Builder builder = new AlertDialog.Builder(getActivity());
        // Create the dialog box



        // Set the title
        builder.setTitle(R.string.save_fm_title);

        // Get the layout inflater
        LayoutInflater inflater = getActivity().getLayoutInflater();

        // Pass null as the parent view because its going in the dialog layout
        @SuppressLint("InflateParams")
        View view = inflater.inflate(R.layout.name_save, null);
        builder.setView(view);

        builder.setPositiveButton(android.R.string.ok, new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int id) {
                EditText editName = (EditText) dlg.findViewById(R.id.editName);
                save(editName.getText().toString());
            }
        });

        // Add a cancel button
        builder.setNegativeButton(android.R.string.cancel, new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int id) {
                // Cancel just closes the dialog box
            }
        });

        dlg = builder.create();





        return dlg;

    }

    /**
     * Actually save the hatting
     * @param name name to save it under
     */
    private void save(final String name) {
        if (!(getActivity() instanceof HatterActivity)) {
            return;
        }
        final HatterActivity activity = (HatterActivity) getActivity();
        final HatterView view = (HatterView) activity.findViewById(R.id.hatterView);
        new Thread(new Runnable() {

            @Override
            public void run() {
                Cloud cloud = new Cloud();
                final boolean ok = cloud.saveToCloud(name, view);
                if(!ok) {
                    /*
                     * If we fail to save, display a toast
                     */
                    // Please fill this in...
                    Looper.prepare();
                    Toast.makeText(view.getContext(),
                            R.string.save_fail,
                            Toast.LENGTH_LONG).show();

                }
            }
        }).start();

    }
}
