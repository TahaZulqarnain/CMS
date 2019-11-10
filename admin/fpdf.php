<?php

include '../db.php';
require("fpdf/fpdf.php");

$c_title="";
$c_description="";
$c_image_path="";
$c_image="";
$c_category="";
$c_sub_category="";
$c_status="";
$c_date="";
$c_author="";
if(isset($_GET['view_id']))
{
	$sql="select * from post where id = '$_GET[view_id]' ";
	$run = mysqli_query($conn,$sql);
	while($rows = mysqli_fetch_assoc($run))
	{
	
    $title=$rows['title'] ;
	$description=$rows['description'];
	$image_path= '../'.$rows['image'].'';
	$image=$rows['image'];
	$category=$rows['category'];
    $sub_category=$rows['sub_category'];
$status=$rows['status'];
$date=$rows['date'];
$author=$rows['author'];




$c_title=$c_title.$title."\n";
$c_description=$c_description.$description."\n";
$c_image_path=$c_image_path.$image_path."\n";
$c_image=$c_image.$image."\n";
$c_category=$c_category.$category."\n";
$c_sub_category=$c_sub_category.$sub_category."\n";
$c_status=$c_status.$status."\n";
$c_date=$c_date.$date."\n";
$c_author=$c_author.$author."\n";
	}
	

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,"Title:",0,1,'L');

$pdf->SetFont('Arial','I',12);
$pdf->Cell(0,10,"$c_title",0,1,'L');


$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,"Description:",0,1,'L');

$pdf->SetFont('Arial','I',12);
$pdf->MultiCell(0,10,"$c_description");

$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,"Image:",0,1,'L');

if($image == '')
{
	$pdf->SetFont('Arial','I',12);
	$pdf->Cell(0,10,"No Image",0,1,'L');
}
else{
//$pdf->Image('../images/img1.jpg',10,10,-300);
$pdf->Cell( 40, 40, $pdf->Image($image_path, $pdf->GetX(), $pdf->GetY(), 53.78), 0, 20, 'L', false );


}
//$pdf->Image('$c_image',20,60,180,20,'jpeg');

$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,"Category:",0,1,'L');


$pdf->SetFont('Arial','I',12);
//The method used to print the paragraphs is MultiCell(). Each time a line reaches the right extremity of the cell or a carriage return character is met, a line break is issued and a
// new cell automatically created under the current one. Text is justified by default. 
$pdf->Cell(0,10,"$c_category",0,1,'l');
$pdf->ln();

$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,"Sub Category:",0,1,'L');

$pdf->SetFont('Arial','I',12);
$pdf->Cell(0,10,"$c_sub_category",0,1,'L');


$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,"Status:",0,1,'L');

$pdf->SetFont('Arial','I',12);
$pdf->Cell(0,10,"$c_status",0,1,'L');

	$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,"Date:",0,1,'L');

$pdf->SetFont('Arial','I',12);
$pdf->Cell(0,10,"$c_date",0,1,'L');

$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,"Author:",0,1,'L');

$pdf->SetFont('Arial','I',12);
$pdf->Cell(0,10,"$c_author",0,1,'L');




	
}
$pdf->Output();
?>