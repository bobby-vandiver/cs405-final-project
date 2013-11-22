/*
    This contains custom validation methods that are added
    to the jQuery validator class and other common tasks required
    to perform form validation.
*/

// The max legth strings (VARCHAR) can be.
// This is consistent through the database.
var MAX_STRING_LENGTH = 50;

// Custom rule to validate field against a regex
// Source: http://stackoverflow.com/questions/280759/jquery-validate-how-to-add-a-rule-for-regular-expression-validation
$.validator.addMethod(
     "regex",
     function(value, element, regexp) {
         var re = new RegExp(regexp);
         return this.optional(element) || re.test(value);
     },
     "Please check your input."
);
