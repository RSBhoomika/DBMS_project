<!DOCTYPE HTML>
<html>
<title>Report</title>
<body>
<p><h1><b>RTO Karnataka: Report</b></h1></p>
<p><a href="rto_admin.php"><font color="blue" size="5"><b>Back</b></font></a>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;

<?php

				session_start();
				$username = $_SESSION['username'];
				$conn = mysqli_connect("localhost","root","");
				if (mysqli_connect_errno())
				{
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
				}

				mysqli_select_db($conn,"dbms_p1");
				

$sql1 = "SELECT dl.name,dl.dl_id,dl.aadhar,license.license_no,license.cov,citizen.mail_id,citizen.phone_no
FROM dl,license,citizen
WHERE dl.aadhar=license.aadhar
AND license.aadhar= citizen.aadhar";

$result1 = $conn->query($sql1);

$body="body";
$subject="Report";

if($result1){
echo '<div align="center"><table align="left" border="2"
cellspacing="2" cellpadding="10">

<tr>
<td align="left"><b>DL ID</b></td>
<td align="left"><b>Aadhaar NO</b></td>
<td align="left"><b>Name</b></td>
<td align="left"><b>COV</b></td>
<td align="left"><b>LICENSE NO</b></td>
<td align="left"><b>PHONE NO</b></td>
<td align="left"><b>EMAIL</b></td>
</tr></div>';

while($row = mysqli_fetch_array($result1)){
$link=$row['mail_id'];
echo '<div align="center"><tr><td align="left">' . 
$row['dl_id'] . '</td><td align="left">' . 
$row['aadhar'] . '</td><td align="left">' .
$row['name'] . '</td><td align="left">' . 
$row['cov'] . '</td><td align="left">' .
$row['license_no'] . '</td><td align="left">' . 
$row['phone_no'] . '</td><td align="left">' . 
'<a href="mailto:'.$row['mail_id'].'?subject='.$subject.'&body='.$body.'">'.$row['mail_id'].'</a>'.'</td><td align="left"></td></tr></div>';
//echo '</tr>';
}

echo '</table>;<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';

} else {

							echo ("<SCRIPT LANGUAGE='JavaScript'>
							window.alert('Couldn't fetch the data')
							window.location.href='rto_admin.php'
							</SCRIPT>");

}

$sql2 = "SELECT reg.cov, COUNT(reg.r_id) FROM reg GROUP BY reg.cov";

$result2 = $conn->query($sql2);

$body="body";
$subject="Report";

if($result2){
echo '<div align="center"><table align="left" border="2"
cellspacing="2" cellpadding="10">

<tr>
<td align="left"><b>COV</b></td>
<td align="left"><b>NO_OF_VEHICLES_REGISTERED</b></td>
</tr></div>';

while($row = mysqli_fetch_array($result2)){
echo '<div align="center"><tr><td align="left">' . 
$row['cov'] . '</td><td align="left">' . 
$row['COUNT(reg.r_id)'] . '</td><td align="left">' ;
}

echo '</table>;<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';

} else {

							echo ("<SCRIPT LANGUAGE='JavaScript'>
							window.alert('Couldn't fetch the data')
							window.location.href='rto_admin.php'
							</SCRIPT>");

}



mysqli_close($conn);
?>
<br>

</body>
</html>
