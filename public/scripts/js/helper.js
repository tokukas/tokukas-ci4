/**
 * Format a string to capitalize the first character for each word.
 * @param {string} str The string.
 * @returns string
 */
function ucwords(str) {
    return (str.toLowerCase()).replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
}
