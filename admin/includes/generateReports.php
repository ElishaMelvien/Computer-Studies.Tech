<?php
require '../../vendor/autoload.php';
use TCPDF as TCPDF;

include 'config.php';

// Fetch counts from the database
// ... (unchanged)

// Create a new TCPDF object
$pdf = new TCPDF();
$pdf->SetAutoPageBreak(true, 10);

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', 'B', 14);

// Add a logo

$pdf->Image($logoPath, 10, 10, 40, '', 'PNG');

// Move the cursor to below the logo
$pdf->SetY(60); // Adjust this value based on your logo height

// Set title color
$pdf->SetTextColor(255, 0, 0); // Red

// Title
$pdf->Cell(0, 10, 'REPORTS', 0, 1, 'C');

// Set font for the rest of the document
$pdf->SetFont('helvetica', '', 12);

// Reset text color to black
$pdf->SetTextColor(0, 0, 0); // Black

// Calculate the center of the page for the table
$tableWidth = 120; // Adjust this value based on your table width
$centerX = ($pdf->getPageWidth() - $tableWidth) / 2;

// Move to the center before drawing the table
$pdf->SetX($centerX);

// Table headers
$pdf->SetFillColor(200, 220, 255); // Light blue background for headers
$pdf->Cell(60, 10, 'Category', 1, 0, 'C', 1);
$pdf->Cell(60, 10, 'Count', 1, 1, 'C', 1);

// Table data
$data = [
    ['Users', $userCount],
    ['Admins', $adminCount],
    ['Past Papers', $papersCount],
    ['Books', $booksCount],
    ['Courses', $coursesCount],
    ['Contact', $contactCount],
];

// Set alternating row colors
$alternateColor = false;

foreach ($data as $row) {
    $pdf->SetFillColor($alternateColor ? 255 : 245, $alternateColor ? 255 : 245, $alternateColor ? 255 : 245);
    $pdf->Cell(60, 10, $row[0], 1, 0, 'L', 1);
    $pdf->Cell(60, 10, $row[1], 1, 1, 'C', 1);
    
    $alternateColor = !$alternateColor; // Toggle the color
}

// Output the PDF to the browser (inline display)
$pdf->Output('report.pdf', 'I');
