package edu.msu.wrigh517.hangman;

import android.content.Context;
import android.graphics.Canvas;
import android.graphics.Color;
import android.graphics.Paint;
import android.text.TextPaint;
import android.view.View;

/**
 * Created by mhw on 11/18/15.
 */
public class WordView extends View {

    private String word = "";

    public WordView(Context context) {
        super(context);
    }

    public void setString(String newString) {
        word = newString;
    }
    /* (non-Javadoc)
    * @see android.view.View#onDraw(android.graphics.Canvas)
    */
    @Override
    protected void onDraw(Canvas canvas) {
        // TODO Auto-generated method stub
        super.onDraw(canvas);
        canvas.save();
        TextPaint textPaint = new TextPaint();
        textPaint.setColor(Color.BLACK);
        textPaint.setTextSize(20);
        canvas.drawText(word, 0,0, textPaint);
        canvas.restore();
        // What would be the scale to draw the where it fits both
        // horizontally and vertically?


    }
}
