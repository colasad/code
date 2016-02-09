package com.example.admin.crud;

import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

/**
 * Created by Admin on 12/4/14.
 */
public class OnLongClickListenerStudentRecord implements View.OnLongClickListener {

    private static final int EDIT = 0;
    private static final int DELETE = 1;

    Context context;
    String id;

    @Override
    public boolean onLongClick(View view) {

        context = view.getContext();
        id = view.getTag().toString();

        final CharSequence[] items = { "Edit", "Delete" };

        new AlertDialog.Builder(context).setTitle("Student Record")
                .setItems(items, new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int item) {


                        if (item == EDIT) {
                            editRecord(Integer.parseInt(id));
                        }
                        if (item == DELETE) {

                            deleteRecord(Integer.parseInt(id));

                            //Toast.makeText(context, "Delete student record disabled", Toast.LENGTH_SHORT).show();

                        }
                        dialog.dismiss();

                    }
                }).show();



        return false;
    }

    public void editRecord(final int studentId) {

        final TableControllerStudent tableControllerStudent = new TableControllerStudent(context);
        ObjectStudent objectStudent = tableControllerStudent.readSingleRecord(studentId);

        LayoutInflater inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        final View formElementsView = inflater.inflate(R.layout.student_input_form, null, false);

        final EditText editTextStudentFirstname = (EditText) formElementsView.findViewById(R.id.editTextStudentFirstname);
        final EditText editTextStudentEmail = (EditText) formElementsView.findViewById(R.id.editTextStudentEmail);

        editTextStudentFirstname.setText(objectStudent.firstname);
        editTextStudentEmail.setText(objectStudent.email);

        new AlertDialog.Builder(context)
                .setView(formElementsView)
                .setTitle("Edit Record")
                .setPositiveButton("Save Changes",
                        new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int id) {

                                ObjectStudent objectStudent = new ObjectStudent();
                                objectStudent.id = studentId;
                                objectStudent.firstname = editTextStudentFirstname.getText().toString();
                                objectStudent.email = editTextStudentEmail.getText().toString();


                                boolean updateSuccessful = tableControllerStudent.update(objectStudent);

                                if(updateSuccessful){
                                    Toast.makeText(context, "Student record was updated.", Toast.LENGTH_SHORT).show();
                                }else{
                                    Toast.makeText(context, "Unable to update student record.", Toast.LENGTH_SHORT).show();
                                }

                                ((MainActivity) context).countRecords();
                                ((MainActivity) context).readRecords();

                                dialog.cancel();
                            }

                        }).show();


    }

    public void deleteRecord(final int studentId) {

        final TableControllerStudent tableControllerStudent = new TableControllerStudent(context);
        ObjectStudent objectStudent = tableControllerStudent.readSingleRecord(studentId);

        LayoutInflater inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        final View formElementsView = inflater.inflate(R.layout.student_delete_form, null, false);

        final TextView displayTextStudentFirstname = (TextView ) formElementsView.findViewById(R.id.displayTextStudentFirstname);
        final TextView  displayTextStudentEmail = (TextView ) formElementsView.findViewById(R.id.displayTextStudentEmail);

        displayTextStudentFirstname.setText(objectStudent.firstname);
        displayTextStudentEmail.setText(objectStudent.email);

        new AlertDialog.Builder(context)
                .setView(formElementsView)
                .setTitle("Delete Record")
                .setPositiveButton("Delete",
                        new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int id) {

                                ObjectStudent objectStudent = new ObjectStudent();
                                objectStudent.id = studentId;
                                objectStudent.firstname = displayTextStudentFirstname.getText().toString();
                                objectStudent.email = displayTextStudentEmail.getText().toString();


                                boolean deleteSuccessful = tableControllerStudent.delete(objectStudent.id);

                                if(deleteSuccessful){
                                    Toast.makeText(context, "Student record was deleted.", Toast.LENGTH_SHORT).show();
                                }else{
                                    Toast.makeText(context, "Unable to delete student record.", Toast.LENGTH_SHORT).show();
                                }

                                ((MainActivity) context).countRecords();
                                ((MainActivity) context).readRecords();

                                dialog.cancel();
                            }

                        }).show();


    }


}
