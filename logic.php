<?php 
session_start();

require 'PHPMailer/PHPMailerAutoload.php';
require_once 'db.php';


$name_error = $email_error = $email_confirm_error = $phone_error = $msg_error = "";
$name = $email_set = $email_confirm = $phone = $msg = $success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (empty($_POST["name"])) {
		$name_error = "Поле name не может быть пустым!";
	} else {
		$name = check_data($_POST["name"]);
	if (!preg_match("^[а-яА-Яё]+\s+[а-яА-Яё]+^" , $name)) {
			$name_error = "Поле имя должно состоять из двух слов русского алфавита!";
		} 
	}

	if (empty($_POST["email_set"])) {
		$email_error = "Поле email не может быть пустым!";
	} else {
		$email_set = check_data($_POST["email_set"]);
		if (!filter_var($email_set, FILTER_VALIDATE_EMAIL)) {
			$email_error = "Неправильно введен email!";
		}
	}

	if (empty($_POST["email_confirm"])) {
		$email_confirm_error = "Поле для повтора email не может быть пустым!";
	} else {
		$email_confirm = check_data($_POST["email_confirm"]);
		if ($email_set != $email_confirm) {
			$email_confirm_error = "Ваш email не совпадает!";
		}
	}

	 if (empty($_POST["phone"])) {
	 	$phone_error = "Вы не ввели Ваш номер телефона!";
	 }
	 	$phone = check_data($_POST["phone"]);
	 if (empty($_POST["msg"])) {
		$msg_error = "Поле с сообщение не может быть пустым!";
	} else {
		$msg = check_data($_POST["msg"]);
	}
}

if ($name_error == '' && $email_error == '' && $email_confirm_error == '' && $phone_error == '' && $msg_error == '') {
	$message_body = '';
	foreach ($_POST as $key => $value) {
	$message_body .= "$key: $value <br>";

	}
}

if (isset($_POST['submit'])) {

	$mail = new PHPMailer;
	$mail->isSMTP();                                   // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                            // Enable SMTP authentication
	$mail->Username = 'kharinserhiy@gmail.com';          // SMTP username
	$mail->Password = 'gjl1yt,2tcmt3'; // SMTP password
	$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                 // TCP port to connect to
	$mail->setFrom('kharinserhiy@gmail.com', 'CodexWorld');
	$mail->addReplyTo('kharinserhiy@gmail.com', 'CodexWorld');
	$mail->addAddress(!empty($email_set)? $email_set : 'default@def.gaf');   // Add a recipient
	//$mail->addCC($email_set);
	//$mail->addBCC('bcc@example.com');
	
	$mail->isHTML(true);  // Set email format to HTML
	$bodyContent = isset($message_body) ? $message_body : null;
	$mail->Subject = 'Email from Localhost by Myself';
	$mail->Body = $bodyContent;
	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
	    $_SESSION['success'] =  'Message has been sent. Maybe we will check it, maybe not...hmm whatever!';
	    header('Location: /');
		}
	}


	//Some helpers and functions :)

	function check_data($data) {
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
	}

	function post($key, $default = null)
    {
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }

    function sessionDie() {
	if (empty($_POST)) {
		unset($_SESSION['success']);
		}

    }

    function WeGucciDb() {
    	return post('name') != NULL && post('email_set') != NULL && post('email_confirm') != NULL && post('phone') != NULL && post('msg') != NULL && post('email_set') == post('email_confirm');
    }

 ?>