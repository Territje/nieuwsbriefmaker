<?php

namespace Bolt\Extension\Softer\Nieuwsbriefmaker;

use Bolt\Extension\SimpleExtension;

use PHPMailer;
use Exception;
use SMTP;

/**
 * Nieuwsbriefmaker extension class.
 *
 * @package NieuwsbriefMaker
 * @author SofTer <you@example.com>
 */
class NieuwsbriefmakerExtension extends SimpleExtension
{
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
	$vraagVanBrowser = json_decode(trim(file_get_contents("php://input")), true);
	
	$emailadresses = '';
	$kopinleiding = '';
	$inleiding = '';
	$kopinhoud = '';
	$inhoud = '';
	$titel1 = '';
	$body1 = '';
	$titel2 = '';
	$body2 = '';
	$titel3 = '';
	$body3 = '';
	$titel4 = '';
	$body4 = '';
	$titel5 = '';
	$body5 = '';
	$titel6 = '';
	$body6 = '';
	$titel7 = '';
	$body7 = '';
	$titel8 = '';
	$body8 = '';
		
	switch ($vraagVanBrowser['get']) {
		
		case 'save': {
			
			splitPhpInput($vraagVanBrowser);
			
			//saveToDb
			$db = new SQLite3('nieuwsbrieven.db');
			$db->busyTimeout(5000);
			$db->enableExceptions(true);			
			try {
				$stmt = $db->prepare (
					"INSERT INTO nieuwsbrieven
					(
						dateCreation,
						kopinleiding,
						inleiding,
						kopinhoud,
						inhoud,
						titel1,
						body1,
						titel2,
						body2,
						titel3,
						body3,
						titel4,
						body4,
						titel5,
						body5,
						titel6,
						body6,
						titel7,
						body7,
						titel8,
						body8
					)
					VALUES
					(
						:dateCreation,
						:kopinleiding,
						:inleiding,
						:kopinhoud,
						:inhoud,
						:titel1,
						:body1,
						:titel2,
						:body2,
						:titel3,
						:body3,
						:titel4,
						:body4,
						:titel5,
						:body5,
						:titel6,
						:body6,
						:titel7,
						:body7,
						:titel8,
						:body8
					);"
				);
				$stmt->bindValue(':dateCreation', date("Y-m-d H:i:s"), SQLITE3_TEXT );
				// $stmt->bindValue(':email', trim(strtolower($vraagVanBrowser['email'])), SQLITE3_TEXT);
				$stmt->bindValue(':kopinleiding', $kopinleiding, SQLITE3_TEXT);
				$stmt->bindValue(':inleiding', $inleiding, SQLITE3_TEXT);
				$stmt->bindValue(':kopinhoud', $kopinhoud, SQLITE3_TEXT);
				$stmt->bindValue(':inhoud', $inhoud, SQLITE3_TEXT);
				$stmt->bindValue(':titel1', $titel1, SQLITE3_TEXT);
				$stmt->bindValue(':body1', $body1, SQLITE3_TEXT);
				$stmt->bindValue(':titel2', $titel2, SQLITE3_TEXT);
				$stmt->bindValue(':body2', $body2, SQLITE3_TEXT);
				$stmt->bindValue(':titel3', $titel3, SQLITE3_TEXT);
				$stmt->bindValue(':body3', $body3, SQLITE3_TEXT);
				$stmt->bindValue(':titel4', $titel4, SQLITE3_TEXT);
				$stmt->bindValue(':body4', $body4, SQLITE3_TEXT);
				$stmt->bindValue(':titel5', $titel5, SQLITE3_TEXT);
				$stmt->bindValue(':body5', $body5, SQLITE3_TEXT);
				$stmt->bindValue(':titel6', $titel6, SQLITE3_TEXT);
				$stmt->bindValue(':body6', $body6, SQLITE3_TEXT);
				$stmt->bindValue(':titel7', $titel7, SQLITE3_TEXT);
				$stmt->bindValue(':body7', $body7, SQLITE3_TEXT);
				$stmt->bindValue(':titel8', $titel8, SQLITE3_TEXT);
				$stmt->bindValue(':body8', $body8, SQLITE3_TEXT);
				$stmt->execute();
				
				$newStatusId = $db->lastInsertRowID();
				$result = $newStatusId;
			}
			catch(\Exception  $e) {
				$result = $e->getMessage();
				// echo ('db not done...'.$result.'...');
			}
			$db = null;
		}
		break;			
		
		case 'save_send': {
			
			$emailadresses = trim(strtolower($vraagVanBrowser['email']));
			$kopinleiding = $vraagVanBrowser['kopinleiding'];
			$inleiding = $vraagVanBrowser['inleiding'];
			$kopinhoud = $vraagVanBrowser['kopinhoud'];
			$inhoud = $vraagVanBrowser['inhoud'];
			$titel1 = $vraagVanBrowser['titel1'];
			$body1 = $vraagVanBrowser['body1'];
			$titel2 = $vraagVanBrowser['titel2'];
			$body2 = $vraagVanBrowser['body2'];
			$titel3 = $vraagVanBrowser['titel3'];
			$body3 = $vraagVanBrowser['body3'];
			$titel4 = $vraagVanBrowser['titel4'];
			$body4 = $vraagVanBrowser['body4'];
			$titel5 = $vraagVanBrowser['titel5'];
			$body5 = $vraagVanBrowser['body5'];
			$titel6 = $vraagVanBrowser['titel6'];
			$body6 = $vraagVanBrowser['body6'];
			$titel7 = $vraagVanBrowser['titel7'];
			$body7 = $vraagVanBrowser['body7'];
			$titel8 = $vraagVanBrowser['titel8'];
			$body8 = $vraagVanBrowser['body8'];
			
			//saveToDb
			$db = new SQLite3('nieuwsbrieven.db');
			$db->busyTimeout(5000);
			$db->enableExceptions(true);			
			try {
				$stmt = $db->prepare (
					"INSERT INTO nieuwsbrieven
					(
						dateCreation,
						kopinleiding,
						inleiding,
						kopinhoud,
						inhoud,
						titel1,
						body1,
						titel2,
						body2,
						titel3,
						body3,
						titel4,
						body4,
						titel5,
						body5,
						titel6,
						body6,
						titel7,
						body7,
						titel8,
						body8
					)
					VALUES
					(
						:dateCreation,
						:kopinleiding,
						:inleiding,
						:kopinhoud,
						:inhoud,
						:titel1,
						:body1,
						:titel2,
						:body2,
						:titel3,
						:body3,
						:titel4,
						:body4,
						:titel5,
						:body5,
						:titel6,
						:body6,
						:titel7,
						:body7,
						:titel8,
						:body8
					);"
				);
				$stmt->bindValue(':dateCreation', date("Y-m-d H:i:s"), SQLITE3_TEXT );
				// $stmt->bindValue(':email', trim(strtolower($vraagVanBrowser['email'])), SQLITE3_TEXT);
				$stmt->bindValue(':kopinleiding', $kopinleiding, SQLITE3_TEXT);
				$stmt->bindValue(':inleiding', $inleiding, SQLITE3_TEXT);
				$stmt->bindValue(':kopinhoud', $kopinhoud, SQLITE3_TEXT);
				$stmt->bindValue(':inhoud', $inhoud, SQLITE3_TEXT);
				$stmt->bindValue(':titel1', $titel1, SQLITE3_TEXT);
				$stmt->bindValue(':body1', $body1, SQLITE3_TEXT);
				$stmt->bindValue(':titel2', $titel2, SQLITE3_TEXT);
				$stmt->bindValue(':body2', $body2, SQLITE3_TEXT);
				$stmt->bindValue(':titel3', $titel3, SQLITE3_TEXT);
				$stmt->bindValue(':body3', $body3, SQLITE3_TEXT);
				$stmt->bindValue(':titel4', $titel4, SQLITE3_TEXT);
				$stmt->bindValue(':body4', $body4, SQLITE3_TEXT);
				$stmt->bindValue(':titel5', $titel5, SQLITE3_TEXT);
				$stmt->bindValue(':body5', $body5, SQLITE3_TEXT);
				$stmt->bindValue(':titel6', $titel6, SQLITE3_TEXT);
				$stmt->bindValue(':body6', $body6, SQLITE3_TEXT);
				$stmt->bindValue(':titel7', $titel7, SQLITE3_TEXT);
				$stmt->bindValue(':body7', $body7, SQLITE3_TEXT);
				$stmt->bindValue(':titel8', $titel8, SQLITE3_TEXT);
				$stmt->bindValue(':body8', $body8, SQLITE3_TEXT);
				$stmt->execute();
				
				$newStatusId = $db->lastInsertRowID();
				$result = $newStatusId;
			}
			catch(\Exception  $e) {
				$result = $e->getMessage();
				// echo ('db not done...'.$result.'...');
			}
			$db = null;
		
			// prepare emails
			header("Content-Type: application/json");
			// $mailHtml = file_get_contents('email2.html'); //https://beefree.io
			// $mailHtml = file_get_contents('beefree-ohk1k8pppxe.html'); //https://beefree.io
			$mailHtml = file_get_contents('nieuwsbrief2.html'); //https://beefree.io
			$mailBlockHtml = file_get_contents('block.html');
			
			$blocks[] = ['head' => $kopinleiding, 'body' => $inleiding];
			$blocks[] = ['head' => $kopinhoud, 'body' => $inhoud];
			$blocks[] = ['head' => $titel1, 'body' => $body1];
			$blocks[] = ['head' => $titel2, 'body' => $body2];
			$blocks[] = ['head' => $titel3, 'body' => $body3];
			$blocks[] = ['head' => $titel4, 'body' => $body4];
			$blocks[] = ['head' => $titel5, 'body' => $body5];
			$blocks[] = ['head' => $titel6, 'body' => $body6];
			$blocks[] = ['head' => $titel7, 'body' => $body7];
			$blocks[] = ['head' => $titel8, 'body' => $body8];
			
			$blocksHtml="";
			foreach($blocks as $blockText){
				$blockHtml = str_replace('@@KOP@@', nl2br($blockText['head']),$mailBlockHtml);
				$blocksHtml .= str_replace('@@BODY@@', nl2br($blockText['body']),$blockHtml);
			}
			echo $blocksHtml;
			$mailHtml = str_replace('@@BLOCKS@@', $blocksHtml, $mailHtml);
			
			// send emails
			$mail = new PHPMailer(true);
			try {
				//$mail->SMTPDebug = 1;
				$mail->Encoding = 'quoted-printable';
				$mail->CharSet = 'UTF-8';
				$mail->isSMTP();
				$mail->SMTPAuth = true;

				$mail->Host = "smtp.gmail.com";
				$mail->Username = "tertje@gmail.com";
				$mail->Password = "xuqmeukhyvuurncg";

				$mail->SMTPSecure = 'ssl';
				$mail->Port = 465;
				$mail->smtpConnect(
					array(
						"ssl" => array(
								"verify_peer" => false,
								"verify_peer_name" => false,
								"allow_self_signed" => true
									)
							)
				);

				$emails = explode(";",$emailadresses);
				foreach($emails as $email)
					$mail->addBCC($email);
				
				$mail->addAddress('tertje@gmail.com', 'Terri');
				$mail->setFrom('tertje@gmail.com', 'Terri');		
				$mail->addReplyTo('tertje@gmail.com', 'Terri');
				// $mail->addAddress('info@bijenverenigingutrecht.nl', 'BVUeo');
				// $mail->setFrom('info@bijenverenigingutrecht.nl', 'BVUeo');		
				// $mail->addReplyTo('info@bijenverenigingutrecht.nl', 'BVUeo');

				$mail->isHTML(true);
				$mail->Subject = 'BVU e.o. Nieuwsbrief';
				$mail->Body = $mailHtml;
				
				if($mail->send())
					$result .= 'mail is sent';

				if(!$mail->send())
					$result .= 'sending mail failed';
			}
			catch (Exception $e) {
				$result = $e->getMessage();
			}
		
		
		}
		break;
		
		case 'getNieuwsbrieven': {	
			$db = new SQLite3('nieuwsbrieven.db');
			$db->busyTimeout(5000);
			$db->enableExceptions(true);
			try {
				// $db->enableExceptions(true);
				$stmt = $db->prepare("
					SELECT *
					FROM nieuwsbrieven n
					ORDER BY ".$vraagVanBrowser['nieuwsbrieven']['sortColumn']." ".$vraagVanBrowser['nieuwsbrieven']['sortDir'].",  dateCreation DESC
					LIMIT 300
				");					
				$qresult = $stmt->execute();
				$found = array();
				while ($row = $qresult->fetchArray(SQLITE3_ASSOC)) {
					array_push($found, $row);
				}
				$result = json_encode($found);
				// echo $result;
			}
			catch(\Exception  $e) {
				$result = $e->getMessage();
			}
			$db->close();
			// $db = null; 
			unset($db);
		}
		break;
		
		case 'openNieuwsbrief': {
			$idN = $vraagVanBrowser['id'];
			$db = new SQLite3('nieuwsbrieven.db');
			$db->busyTimeout(5000);
			$db->enableExceptions(true);
			try {
				$stmt = $db->prepare("
					SELECT *
					FROM nieuwsbrieven n
					WHERE id = :idN
				");	
				$stmt->bindValue(':idN', $idN, SQLITE3_INTEGER);				
				$qresult = $stmt->execute();
				$aresult = $qresult->fetchArray(SQLITE3_ASSOC);
				$result = json_encode($aresult);
			}
			catch(\Exception  $e) {
				$result = $e->getMessage();
			}
			$db->close();
			// $db = null; 
			unset($db);
			
			// $mailHtml = file_get_contents('email2.html'); //https://beefree.io
			$mailHtml = file_get_contents('beefree-ohk1k8pppxe.html'); //https://beefree.io
			$mailHtml = str_replace('@@KOPINLEIDING@@', $result['kopinleiding'], $mailHtml);
			$mailHtml = str_replace('@@INLEIDING@@', nl2br($result['inleiding']), $mailHtml);
			$mailHtml = str_replace('@@KOPINHOUD@@', $result['kopinhoud'], $mailHtml);			
			$mailHtml = str_replace('@@INHOUD@@', nl2br($result['inhoud']), $mailHtml);
			$mailHtml = str_replace('@@KOP1@@', $result['titel1'], $mailHtml);
			$mailHtml = str_replace('@@TEKST1@@', nl2br($result['body1']), $mailHtml);
			$mailHtml = str_replace('@@KOP2@@', $result['titel2'], $mailHtml);
			$mailHtml = str_replace('@@TEKST2@@', nl2br($result['body2']), $mailHtml);
			$mailHtml = str_replace('@@KOP3@@', $result['titel3'], $mailHtml);
			$mailHtml = str_replace('@@TEKST3@@', nl2br($result['body3']), $mailHtml);
			$mailHtml = str_replace('@@KOP4@@', $result['titel4'], $mailHtml);
			$mailHtml = str_replace('@@TEKST4@@', nl2br($result['body4']), $mailHtml);
			$mailHtml = str_replace('@@KOP5@@', $result['titel5'], $mailHtml);
			$mailHtml = str_replace('@@TEKST5@@', nl2br($result['body5']), $mailHtml);
			$mailHtml = str_replace('@@KOP6@@', $result['titel6'], $mailHtml);
			$mailHtml = str_replace('@@TEKST6@@', nl2br($result['body6']), $mailHtml);
			$mailHtml = str_replace('@@KOP7@@', $result['titel7'], $mailHtml);
			$mailHtml = str_replace('@@TEKST7@@', nl2br($result['body7']), $mailHtml);
			$mailHtml = str_replace('@@KOP8@@', $result['titel8'], $mailHtml);
			$mailHtml = str_replace('@@TEKST8@@', nl2br($result['body8']), $mailHtml);
		}
		break;
		
		case 'bewerkNieuwsbrief': {
			echo ('bewerkNieuwsbrief triggerd....');
		}
		break;
	
		default:
			$result = 'NIX';
	}

	//usleep(2000000);
	header('Access-Control-Allow-Origin: *');
	header('Content-type: application/json');
	header('HTTP/1.1 200 OK');
	echo $result;	
}
else {
	
	if (isset($_GET['createNieuwsbrief'])) {
		$page = file_get_contents("create_nieuwsbrief.html");
	}	
	else {
		$page = file_get_contents("nieuwsbrieven.html");
	}
	echo $page;
	
}


function splitPhpInput($vraagVanBrowser) {
	$emailadresses = trim(strtolower($vraagVanBrowser['email']));
	$kopinleiding = $vraagVanBrowser['kopinleiding'];
	$inleiding = $vraagVanBrowser['inleiding'];
	$kopinhoud = $vraagVanBrowser['kopinhoud'];
	$inhoud = $vraagVanBrowser['inhoud'];
	$titel1 = $vraagVanBrowser['titel1'];
	$body1 = $vraagVanBrowser['body1'];
	$titel2 = $vraagVanBrowser['titel2'];
	$body2 = $vraagVanBrowser['body2'];
	$titel3 = $vraagVanBrowser['titel3'];
	$body3 = $vraagVanBrowser['body3'];
	$titel4 = $vraagVanBrowser['titel4'];
	$body4 = $vraagVanBrowser['body4'];
	$titel5 = $vraagVanBrowser['titel5'];
	$body5 = $vraagVanBrowser['body5'];
	$titel6 = $vraagVanBrowser['titel6'];
	$body6 = $vraagVanBrowser['body6'];
	$titel7 = $vraagVanBrowser['titel7'];
	$body7 = $vraagVanBrowser['body7'];
	$titel8 = $vraagVanBrowser['titel8'];
	$body8 = $vraagVanBrowser['body8'];
}
}