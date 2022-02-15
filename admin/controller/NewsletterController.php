<?php 
class NewsletterController {
	function list() {
		$page_title = "Danh sách email";
		$newsletterRepository = new NewsletterRepository();
		$newsletters = $newsletterRepository->getAll();
		include "view/newsletter/list.php";
	}

	function sendEmail() {
		$page_title = "Gởi email";
		$newsletterRepository = new NewsletterRepository();
		$newsletters = $newsletterRepository->getAll();
		include "view/newsletter/sendEmail.php";
	}

	function send() {
		$mailSenderService = new MailSenderService();
		$from_email = SMTP_EMAIL;
		$from_name = SMTP_NAME;
		$subject = $_POST["subject"];
		$content = $_POST["description"];
		$to_name = "";
		foreach ($_POST["emails"] as $to_email) {
			$mailSenderService->send($from_email, $from_name, $to_email, $to_name, $subject, $content);
		}

		$_SESSION["message"] = "Đã gởi mail thành công";
		header("location: index.php?c=newsletter&a=sendEmail");
		exit;
		
	}

	
}