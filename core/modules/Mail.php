<?
class Mail extends Form {
	
	function __construct($template, $email) {
		if (isset($_REQUEST['submit'])) {
			self::form_process($template, $email); // Process the submitted form information
		} else {
			parent::__construct($template);// Echo the form html code
		}
	}

	function form_process($template, $email) {
		$s = simplexml_load_file(dirname(__FILE__).'/form.xml');
		$info = $s->xpath("form[@name = '".$template."']");
		// Get the array with the form information
		$array = $_REQUEST[(string) $info[0]->attributes()->name];
		// Removes empty array nodes
		$contact_form = array_filter($array);
		// Create the Body of the email 
		foreach ($contact_form as $key => $value) {$body .= ucwords(str_replace('_', ' ', $key)) . ': '.$value.PHP_EOL;}
		// Find the Subject
		$subject = $contact_form['Subject'].' from '. $contact_form['Name'];
		// Set the Email headers
		$headers = 'From: ' . $contact_form['Email'] . " \r\n" . 'Reply-To: ' . $contact_form['Email'];
		// Set the Success/Failure messages 
		$success = '<h1>Form Sent Successfully!</h1><p><br /><a href="/page/home">Back to Home Page</a></p>';
		$error = '<h1>An Error Was Encountered.</h1><p>What would you like to do?<ul><li><a href="#" onClick="history.go(-1)">Try Again</a></li><li>Send email directly to: <b>'.str_replace('@', ' at ', EMAIL).'</b></li><li><a href="/page/home">Go to Home Page</a></li></ul></p>';
		// Send Email, and return the appropriate message
		$result = (mail($email, $subject, $body, $headers)) ? $success:$error;
		$this->form_result = $result;
	}
	
	public function __toString() {
        return $this->form_result;
    }
}
?>