<?php

use App\Libraries\CodeGenerator;

/**
 * Generates a code consisting of several digits of a random number, plus a specified prefix or suffix.
 * @param int $numLen [optional] The number of digits of random number. If $hex is true, $numLen must be an even number. The default is 5.
 * @param boolean $hex [optional] Generate code in hexadecimal number. The default is false.
 * @param string $prefix [optional] Specific prefix to be assigned to the code.
 * @param string $suffix [optional] Specific suffix to be assigned to the code.
 * @return string The generated code.
 * @throws InvalidArgumentException If there is an invalid argument value.
 */
function code_generator($numLen = 5, $hex = false, $prefix = '', $suffix = '')
{
    $codeGenerator = new CodeGenerator($numLen, $prefix, $suffix);

    return ($hex) ? $codeGenerator->getHexadecimalCode() : $codeGenerator->getDecimalCode();
}


/**
 * Prints and displays a message in the browser-console.
 * @param string $message The message to be printed.
 * @param boolean $error [optional] Is this message an error message? The default is false.
 */
function print_console($message, $error = false)
{
    $message = base64_encode($message);
    $script = ($error) ? "console.error(atob('$message'))" : "console.log(atob('$message'))";
    echo "<script>$script</script>";
}


/**
 * Get url of current page.
 * @return string The url address of the current page.
 */
function get_url_of_this_page()
{
    return ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}


/**
 * Formatting a number according to the common number writing in Indonesia.
 * @param float $num The number being formatted.
 * @param int $decimals [optional] Sets the number of decimal points.
 * @param string $prefix [optional] Specific prefix to be assigned to the number. This is very useful for adding currency units like 'Rp'.
 * @return string The formatted number.
 */
function idn_format_number($num, $decimals = 0, $prefix = '')
{
    return $prefix . number_format($num, $decimals, ',', '.');
}
