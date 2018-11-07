<?php

session_start();
//error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['tlogin']) == 0) {
    header("Location: tindex.php"); //
} else {
    require 'pdf/fpdf.php';

    class PDF extends FPDF {

        function header() {
            //Insert image
            $this->Image('pdf/donor.png', 10, 6);
            // Select Arial bold 15
            $this->SetFont('Arial', 'B', 17);
            // Move to the right
            $this->Cell(400, 5, 'DONOR LIST', 0, 0, 'C');

            $this->Ln();
            // Line break
            $this->Ln(20);
        }

        function footer() {
            // Go to 1.5 cm from bottom
            $this->SetY(-15);
            // Select Arial italic 8
            $this->SetFont('Arial', 'I', 8);
            // Print current and total page numbers
            $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        }

        function headerTable() {
            $this->SetFont('Arial', 'I', 20);
            $this->Cell(15, 15, 'No.', 1, 0, 'C');
            $this->Cell(60, 15, 'Full Name', 1, 0, 'C');
            $this->Cell(40, 15, 'Passport', 1, 0, 'C');

            $this->Cell(35, 15, 'Mobile No.', 1, 0, 'C');
            $this->Cell(60, 15, 'Email', 1, 0, 'C');
            $this->Cell(25, 15, 'State', 1, 0, 'C');
            $this->Cell(25, 15, 'Gender', 1, 0, 'C');

            $this->Cell(25, 15, 'DOB', 1, 0, 'C');
            $this->Cell(20, 15, 'Blood', 1, 0, 'C');
            $this->Cell(65, 15, 'Organ Donated', 1, 0, 'C');

            $this->Ln();
        }

        function viewTable($dbh) {
            $this->SetFont('Times', '', 12);
            $sql = "SELECT * from  tableorgandonors ";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            $cnt = 1;
            if ($query->rowCount() > 0) {
                foreach ($results as $result) {
                    $this->Cell(15, 10, htmlentities($cnt), 1, 0, 'C');
                    $this->Cell(60, 10, $result->FullName, 1, 0, 'C');
                    $this->Cell(40, 10, $result->Passport, 1, 0, 'C');

                    $this->Cell(35, 10, $result->MobileNumber, 1, 0, 'C');
                    $this->Cell(60, 10, $result->Email, 1, 0, 'C');
                    $this->Cell(25, 10, $result->State, 1, 0, 'C');
                    $this->Cell(25, 10, $result->Gender, 1, 0, 'C');

                    $this->Cell(25, 10, $result->DateOfBirth, 1, 0, 'C');
                    $this->Cell(20, 10, $result->BloodType, 1, 0, 'C');
                    $this->Cell(65, 10, "$result->OrganDonated $result->OrganDonated2 $result->OrganDonated3 $result->OrganDonated4 $result->OrganDonated5", 1, 0, 'C');

                    $this->Ln();
                    $cnt = $cnt + 1;
                }
            }
        }
    }
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('L', 'A3', 0);
    $pdf->headerTable();
    $pdf->viewTable($dbh);
    $pdf->Output();
}
?>
