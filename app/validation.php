<?
    const MAX_LENGTH = 50;

    const STATE_REGEX = '/^[a-zA-Z]{2}$/';

    const ZIP_CODE_REGEX = '/^\d{5}$/';
   
    // All varchar fields have the same max length and not null constraint 
    function valid_string($str) {
        return (strlen($str) < MAX_LENGTH) && !empty($username);
    }

    function valid_username($username) {
        $valid_email = (filter_var($username, FILTER_VALIDATE_EMAIL) === FALSE);
        return $valid_email && valid_string($username);
    }

    function valid_password($password) {
        return valid_string($password);
    }

    function valid_street($street) {
        return valid_string($street);
    }
    
    function valid_city($city) {
        return valid_string($city);
    }

    function valid_state($state) {
        return preg_match(STATE_REGEX, $state);
    }

    function valid_zip($zip) {
        return preg_match(ZIP_CODE_REGEX, $zip);
    }
?>
