<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Student;
use App\Models\BorrowRecord;

class PdfController extends Controller
{
    //Generate Pdf

    public function  generatePdf(){

      //use

    $dismissedStudents = Student::All();
   
    $pdf = Pdf::loadView('pdf.dismissed_students', compact('dismissedStudents'));
    
    return $pdf->stream('users.pdf');      //A function to Preview a PDF
   // return $pdf->download();  //A function to download PDF

    }

      /*
    |--------------------------------------------------------------------------
    | PREVIEW DISMISSED STUDENTS PDF
    |--------------------------------------------------------------------------
    */

    public function dismissedPreview()
    {
        $dismissedStudents = Student::where('status', 'dismissed')->get();

        $pdf = Pdf::loadView(
            'pdf.dissmissed_students',
            compact('dismissedStudents')
        );

        return $pdf->stream('pdf.dissmissed_students');
    }

        //A function to download a PDF
      /*
    |--------------------------------------------------------------------------
    | DOWNLOAD DISMISSED STUDENTS PDF
    |--------------------------------------------------------------------------
    */

    public function dismissedDownload()
    {
        $dismissedStudents = Student::where('status', 'dismissed')->get();

        $pdf = Pdf::loadView(
            'pdf.dismissed_students',
            compact('dismissedStudents')
        );

        return $pdf->download('dismissed-students.pdf');
    }

   //Generating a report for Borrowed Items
     /*
    |--------------------------------------------------------------------------
    | PREVIEW RETURNED ITEMS REPORT
    |--------------------------------------------------------------------------
    */

    public function returnedItemsPreview()
    {
    
      $records = BorrowRecord::with('item')
                    ->where('status', 'returned')
                    ->get();

        $pdf = Pdf::loadView(
            'pdf.returned_items',
            compact('records')
        );

        return $pdf->stream('pdf.returned_items');
    }

    /*
    |--------------------------------------------------------------------------
    | DOWNLOAD RETURNED ITEMS REPORT
    |--------------------------------------------------------------------------
    */

    public function returnedItemsDownload()
    {
        $records = BorrowRecord::with('item')
                    ->where('status', 'returned')
                    ->get();

        $pdf = Pdf::loadView(
            'pdf.returned_items',
            compact('records')
        );

        return $pdf->download('pdf.returned_items');
    }


}
