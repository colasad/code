package com.example.admin.crud;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import java.util.List;


public class MainActivity extends Activity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        Button buttonCreateLocation = (Button) findViewById(R.id.buttonCreateStudent);
        buttonCreateLocation.setOnClickListener(new OnClickListenerCreateStudent());

        countRecords();
        readRecords();


    }

    public class OnClickListenerCreateStudent implements View.OnClickListener {

        @Override
        public void onClick(View view) {

            final Context context = view.getContext();

            LayoutInflater inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            final View formElementsView = inflater.inflate(R.layout.student_input_form, null, false);

            final EditText editTextStudentFirstname = (EditText) formElementsView.findViewById(R.id.editTextStudentFirstname);
            final EditText editTextStudentEmail = (EditText) formElementsView.findViewById(R.id.editTextStudentEmail);

            new AlertDialog.Builder(context)
                    .setView(formElementsView)
                    .setTitle("Create Student")
                    .setPositiveButton("Add",
                            new DialogInterface.OnClickListener() {
                                public void onClick(DialogInterface dialog, int id) {

                                    String studentFirstname = editTextStudentFirstname.getText().toString();
                                    String studentEmail = editTextStudentEmail.getText().toString();

                                    ObjectStudent objectStudent = new ObjectStudent();
                                    objectStudent.firstname = studentFirstname;
                                    objectStudent.email = studentEmail;

                                    boolean createSuccessful = new TableControllerStudent(context).create(objectStudent);

                                    if (createSuccessful) {
                                        Toast.makeText(context, "Student information was saved.", Toast.LENGTH_SHORT).show();
                                    } else {
                                        Toast.makeText(context, "Unable to save student information.", Toast.LENGTH_SHORT).show();
                                    }

                                    countRecords();
                                    ((MainActivity) context).readRecords();

                                    dialog.cancel();
                                }

                            }).show();

        }
    }


    // Display Record Count
    //
    public void countRecords() {
        int recordCount = new TableControllerStudent(this).count();
        TextView textViewRecordCount = (TextView) findViewById(R.id.textViewRecordCount);
        textViewRecordCount.setText(recordCount + " records found.");


    }

    // Read and Display Records
    //
    public void readRecords() {

        LinearLayout linearLayoutRecords = (LinearLayout) findViewById(R.id.linearLayoutRecords);
        linearLayoutRecords.removeAllViews();

        List<ObjectStudent> students = new TableControllerStudent(this).read();

        if (students.size() > 0) {

            for (ObjectStudent obj : students) {

                int id = obj.id;
                String studentFirstname = obj.firstname;
                String studentEmail = obj.email;

                String textViewContents = studentFirstname + " - " + studentEmail;

                TextView textViewLocationItem = new TextView(this);
                textViewLocationItem.setPadding(0, 10, 0, 10);
                textViewLocationItem.setText(textViewContents);
                textViewLocationItem.setTag(Integer.toString(id));

                linearLayoutRecords.addView(textViewLocationItem);

                textViewLocationItem.setOnLongClickListener(new OnLongClickListenerStudentRecord());
            }

        }

        else {

            TextView locationItem = new TextView(this);
            locationItem.setPadding(8, 8, 8, 8);
            locationItem.setText("No records yet.");

            linearLayoutRecords.addView(locationItem);
        }

    }


}
