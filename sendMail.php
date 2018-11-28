<?php
session_start();
include 'connect.php';
require("PHPMailer/class.phpmailer.php");
$GebruikerId= $_SESSION['GebruikerId'];
$sql = "SELECT * FROM tblgebruikers WHERE GebruikerId = '".$GebruikerId."'";
$result = $conn->query($sql)->fetch_assoc();
$GebruikerEmail= $result['GebruikerEmail'];   
$conn->close();
$bericht = $_POST['message'];
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.gmail.com";
$mail->Port = 465;
$mail->Username = 'sudokugip@gmail.com';
$mail->Password = 'azertysudoku';
$mail->setFrom('sudoku@gmail.com');
$mail->addAddress($GebruikerEmail);
$mail->Subject = $_POST['subject'];
$mail->Body = $bericht;
$mail->WordWrap = 10000;
if(!$mail->Send()){
    print'<h3>Bericht niet verzonden</h3><br>';
    print'<p>Gelieven een mail te sturen met de errorcode naar volgend email adres.<br>
    <div class="mail">
    <input type="text" value="Nicolaas.arys@gmail.com" id="mail" readonly="readonly" style="max-width: 300px;">
    <button onclick="copyButton()" style="border: none;border-radius: 2px;font-size: 31px; transform: translateY(7px);">Kopieer adres</button>
    </div></p><br>';
    echo '<h4>Error:</h4><input type="text" value="' . $mail->ErrorInfo.'" id="mail" readonly="readonly" style="max-width: 100%;resize: none;">';
    } else {
    header('location: index.php');
}
?>