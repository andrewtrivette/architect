<?
class Form {

	public $form_result;
	public $template_file;

	function __construct( $template, $file = THEMES.'/form.xml' ) {
		$this->template_file = $file;
		self::form_render($template);
	}
	
	function form_render($template) {
		$s = simplexml_load_file( $this->template_file );
		$info = $s->xpath("form[@name = '".$template."']");
		// Set General form info
		$form = $info[0]->message;
		if ($info[0]->attributes()->process == 'file') {
			$form .= '<form method="post" action="'.$info[0]->attributes()->action.'" name="'.$info[0]->attributes()->name.'" enctype="multipart/form-data">'.PHP_EOL;
		} else {
			$form .= '<form method="post" action="'.$info[0]->attributes()->action.'" name="'.$info[0]->attributes()->name.'">'.PHP_EOL;
		}
		// Iterate through each form node from xml form group
		foreach ($info[0]->children() as $field) {
			$element = $field->getName();
			switch($element) { // Matches node name with one of the following, and prints out the response
				
				case 'text':
				case 'password':
					$form .= '<label for="'.$field->attributes()->name.'">'.ucwords(str_replace('_', ' ', $field->attributes()->name)).':</label><input type="'.$element.'" name="'.$info[0]->attributes()->name.'['.$field->attributes()->name.']" id="'.$field->attributes()->name.'" value="'.$field.'" size="'.$field->attributes()->size.'" /><br />'.PHP_EOL;
					break;
						
				case 'submit':
					$form .= '<input type="'.$element.'" name="'.$field->attributes()->name.'" id="'.$field->attributes()->name.'" value="'.$field.'" /><br />'.PHP_EOL;
					break;
						
				case 'hidden':
					$form .= '<input type="'.$element.'" name="'.$info[0]->attributes()->name.'['.$field->attributes()->name.']" id="'.$field->attributes()->name.'" value="'.$field.'" />'.PHP_EOL;
					break;
						
				case 'textarea':
					$form .= '<label for="'.$field->attributes()->name.'">'.ucwords(str_replace('_', ' ', $field->attributes()->name)).':</label>'.PHP_EOL.'<textarea id="'.$field->attributes()->name.'" name="'.$info[0]->attributes()->name.'['.$field->attributes()->name.']" cols="'.$field->attributes()->cols.'" rows="'.$field->attributes()->rows.'"></textarea><br />'.PHP_EOL;
					break;
						
				case 'radio':
					$form .= '<fieldset><legend>'.$field->attributes()->name.'</legend>'.PHP_EOL;
					foreach($field->children() as $radio) {
						$form .= '<label><input type="radio" name="'.$info[0]->attributes()->name.'['.$field->attributes()->name.']" id="'.$radio->attributes()->id.'" /> '.$radio.'</label> '.PHP_EOL;
					}
					$form .= '</fieldset>'.PHP_EOL;
					break;
						
				case 'select':
					
					break;
						
				case 'checkbox':
					
					break;
						
				case 'image':
					
					break;
						
				case 'button':
					
					break;
						
				case 'file':
					
					break;
			}
		}
		$form .= '</form>'.PHP_EOL;
		$this->form_result = $form;		
	}
	
	public function __toString() {
        return $this->form_result;
    }
}
?>