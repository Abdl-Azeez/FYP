<?php
if (isset($_POST['Formsubmit']))
{
  session_start();
  require('fpdf.php');

  //Create new pdf file
  $pdf = new FPDF('P','mm','A4');

  //Disable automatic page break
  $pdf->SetAutoPageBreak(false);

  //Add first page
  $pdf->AddPage();


    //Sql select rows
  $empleave = $_POST['empleave'];
  $connection = mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
  $user=$_SESSION['username'];
  $sql1= "SELECT * FROM users WHERE username='$user' AND roles='Staff'";
  $result2= mysqli_query ($connection, $sql1) or die ("Could not execute query");
  $myrow= mysqli_fetch_row ($result2);
  $requestName=$myrow[5];
  if ($empleave!=5){
   $sql= "SELECT request.Id,request.StaffName,request.leaveType,request.StaffID,request.DateFrom,request.DateTo,request.Status,request.Remark, request.PostingDate, users.EL,users.ELtaken,users.ELbalance,users.CL,users.CLtaken,users.CLbalance,users.Annual,users.Annualtaken,users.Annualbalance,users.OL,users.OLtaken,users.OLbalance,
   request.ActionDate FROM request INNER JOIN users ON users.StaffName = request.StaffName WHERE request.StaffName='$requestName' AND users.roles='Staff' AND request.leaveType='$empleave' ORDER BY request.PostingDate desc";
  }
  else {
    $sql= "SELECT request.Id,request.StaffName,request.leaveType,request.StaffID,request.DateFrom,request.DateTo,request.Status,request.Remark, request.PostingDate, users.EL,users.ELtaken,users.ELbalance,users.CL,users.CLtaken,users.CLbalance,users.Annual,users.Annualtaken,users.Annualbalance,users.OL,users.OLtaken,users.OLbalance,
    request.ActionDate FROM request INNER JOIN users ON users.StaffName = request.StaffName WHERE request.StaffName='$requestName' AND users.roles='Staff' ORDER BY request.PostingDate desc";
   }
  $result1= mysqli_query ($connection, $sql) or die ("Could not execute query");
  $result= mysqli_query ($connection, $sql) or die ("Could not execute query");
  $row = mysqli_fetch_array($result1);
  if($row==''){
    echo "You don't have any record for the choosen leave";
  }
  else{
    //set font to arial, bold, 14pt
    $pdf->SetFont('helvetica','B',15);

    //Cell(width , height , text , border , end line , [align] )
    $pdf->Cell(70 ,5,$row['StaffName'],0,0,'R');
    $pdf->SetY(15);
    $pdf->Cell(150,5,$row['StaffID'],0,1,'C');//end of line

    $leaveType = $row['leaveType'];
    $ELbalance = $row['ELbalance'];
    $CLbalance = $row['CLbalance'];
    $Annualbalance = $row['Annualbalance'];
    $OLbalance = $row['OLbalance'];
    $ELtaken = $row['ELtaken'];
    $CLtaken = $row['CLtaken'];
    $Annualtaken = $row['Annualtaken'];
    $OLtaken = $row['OLtaken'];

    if ($leaveType==1){$leave="Emergency Leave";}
    else if ($leaveType==2){$leave="Medical Leave";}
    else if ($leaveType==3){$leave="Annual Leave";}
    else if ($leaveType==4){$leave="Replacement Leave";}

    if ($leaveType==1){$balance=$ELbalance;}
    else if ($leaveType==2){$balance=$CLbalance;}
    else if ($leaveType==3){$balance=$Annualbalance;}
    else if ($leaveType==4){$balance=$OLbalance;}

    if ($leaveType==1){$taken=$ELtaken;}
    else if ($leaveType==2){$taken=$CLtaken;}
    else if ($leaveType==3){$taken=$Annualtaken;}
    else if ($leaveType==4){$taken=$OLtaken;}

    if ($empleave!=5){
    $pdf->SetFont('Arial','',12);
    $pdf->SetY(24);
    $pdf->Cell(30 ,5,'Leave Type =',0,0);
    $pdf->Cell(40 ,5,$leave,0,0);
    $pdf->SetY(30);
    $pdf->Cell(30 ,5,'Balance =',0,0);
    $pdf->Cell(25 ,5,$balance,0,0);
    $pdf->SetY(36);
    $pdf->Cell(30 ,5,'Total Taken =',0,0);
    $pdf->Cell(25 ,5,$taken,0,0);
    }

    //set initial y axis position per page
    $y_axis_initial = 42;
    if ($empleave!=5){$x_axis=10;}
    else if ($empleave==5){$x_axis=10;}

    if ($empleave!=5){$y_axis=48;}
    else{$y_axis=24;}


    //print column titles
    $pdf->SetFillColor(232,232,232);
    $pdf->SetFont('Arial','B',12);
    $pdf->SetY($y_axis);
    $pdf->SetX($x_axis);
    if ($empleave==5){$pdf->Cell(40,6,'Leave Type',1,0,'L',1);}
    $pdf->Cell(30,6,'Date From',1,0,'L',1);
    $pdf->Cell(30,6,'Date To',1,0,'L',1);
    $pdf->Cell(40,6,'Posting Date',1,0,'L',1);
    $pdf->Cell(50,6,'Status',1,0,'L',1);
    if ($empleave!=5){$pdf->Cell(40,6,'Acknowledged by',1,0,'L',1);}


    $y_axis = $y_axis + 6;


    //initialize counter
    $i = 0;

    //Set maximum rows per page
    $max = 22;

    //Set Row Height
    $row_height = 6;
    while($row = mysqli_fetch_array($result))
    {
    	//If the current row is the last one, create new page and print column title
    	if ($i == $max)
    	{
    		$pdf->AddPage();

    		//print column titles for the current page
        $pdf->SetFillColor(232,232,232);
        $pdf->SetFont('Arial','B',12);
        $pdf->SetY(18);
        $pdf->SetX($x_axis);
        if ($empleave==5){$pdf->Cell(40,6,'Leave Type',1,0,'L',1);}
        $pdf->Cell(30,6,'Date From',1,0,'L',1);
        $pdf->Cell(30,6,'Date To',1,0,'L',1);
        $pdf->Cell(40,6,'Posting Date',1,0,'L',1);
        $pdf->Cell(50,6,'Status',1,0,'L',1);
        if ($empleave!=5){$pdf->Cell(40,6,'Acknowledged by',1,0,'L',1);}
        $y_axis=18;
    		//Go to next row
    		$y_axis = $y_axis + $row_height;

    		//Set $i variable to 0 (first row)
    		$i = 0;
    	}

      $StaffName=$row['StaffName'];
      $DateFrom = $row['DateFrom'];
      $DateTo = $row['DateTo'];
      $PostingDate = $row['PostingDate'];
      $leavestatus = $row['Status'];

      $leaveType = $row['leaveType'];
        if ($leaveType==1){$leave="Emergency Leave";}
        else if ($leaveType==2){$leave="Medical Leave";}
        else if ($leaveType==3){$leave="Annual Leave";}
        else if ($leaveType==4){$leave="Replacement Leave";}

      if ($leavestatus==0){$status="Pending";}
      else if ($leavestatus==1){$status="Approved";}
      else if ($leavestatus==2){$status="Waiting For Admin Approval";}
      else if ($leavestatus==3){$status="Not Reccomended by Superior";}
      else if ($leavestatus==4){$status="Not Approved";}

      if ($leavestatus==0){$Ack="Not Acknowledged";}
      else if (($leavestatus==2)||($leavestatus==3)){$Ack="Superior";}
      else if (($leavestatus==1)||($leavestatus==4)){$Ack="Admin";}

    	$pdf->SetY($y_axis);
    	$pdf->SetX($x_axis);
      $pdf->SetFont('Arial','',10);
      if ($empleave==5){$pdf->Cell(40,6,$leave,1,0,'L',1);}
      $pdf->Cell(30,6,$DateFrom,1,0,'L',1);
    	$pdf->Cell(30,6,$DateTo,1,0,'L',1);
    	$pdf->Cell(40,6,$PostingDate,1,0,'L',1);
      $pdf->Cell(50,6,$status,1,0,'L',1);
      if ($empleave!=5){$pdf->Cell(40,6,$Ack,1,0,'L',1);}

    	//Go to next row
    	$y_axis = $y_axis + $row_height;
    	$i = $i + 1;
    }


    //Send file
    $pdf->Output();
  }
}
?>
