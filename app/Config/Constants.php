<?php

/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 | --------------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2592000);
defined('YEAR')   || define('YEAR', 31536000);
defined('DECADE') || define('DECADE', 315360000);

/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
 */
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


/*
 | --------------------------------------------------------------------------
 | API STATUS CODE
 | --------------------------------------------------------------------------
 */

/**
 * ---------------------
 * SUCCESS (2xx)
 * ---------------------
 */

/**
 * For successful GET and PUT requests.
 */
defined('API_OK')           || define('API_OK', 200);

/**
 * For a successful POST request.
 */
defined('API_CREATED')      || define('API_CREATED', 201);

/**
 * For a request that resulted in a scheduled task being created to perform the actual request.
 */
defined('API_ACCEPTED')     || define('API_ACCEPTED', 202);

/**
 * For a successful request that produced no response (such as DELETE requests).
 */
defined('API_NO_RESPONSE')  || define('API_NO_RESPONSE', 204);

/**
 * ---------------------
 * REDIRECTION (3xx)
 * ---------------------
 */

/**
 * The URL of the requested resource has been changed permanently.
 * The new URL is given by the Location header field in the response.
 * This response is cacheable unless indicated otherwise.
 */
defined('API_MOVED_PERMANENTLY')    || define('API_MOVED_PERMANENTLY', 301);

/**
 * Indicates the client that the response has not been modified,
 * so the client can continue to use the same cached version of the response.
 */
defined('API_NOT_MODIFIED')         || define('API_NOT_MODIFIED', 304);

/**
 * ---------------------
 * CLIENT ERROR (4xx)
 * ---------------------
 */

/**
 * The request could not be understood by the server due to incorrect syntax. The client SHOULD NOT repeat the request without modifications.
 */
defined('API_BAD_REQUEST')              || define('API_BAD_REQUEST', 400);

/**
 * Indicates that the request requires user authentication information. The client MAY repeat the request with a suitable Authorization header field.
 */
defined('API_UNAUTHORIZED')             || define('API_UNAUTHORIZED', 401);

/**
 * Unauthorized request. The client does not have access rights to the content.
 */
defined('API_FORBIDDEN')                || define('API_FORBIDDEN', 403);

/**
 * The server can not find the requested resource.
 */
defined('API_NOT_FOUND')                || define('API_NOT_FOUND', 404);

/**
 * The request HTTP method is known by the server but has been disabled and cannot be used for that resource.
 */
defined('API_METHOD_NOT_ALLOWED')       || define('API_METHOD_NOT_ALLOWED', 405);

/**
 * The server doesn’t find any content that conforms to the criteria given by the user agent in the Accept header sent in the request.
 */
defined('API_METHOD_ACCEPTABLE')        || define('API_METHOD_ACCEPTABLE', 406);

/**
 * 	The request could not be completed due to a conflict with the current state of the resource.
 */
defined('API_CONFLICT')                 || define('API_CONFLICT', 409);

/**
 * Request entity is larger than limits defined by server.
 */
defined('API_REQ_ENTITY_TOO_LARGE')     || define('API_REQ_ENTITY_TOO_LARGE', 413);

/**
 * The user has sent too many requests in a given amount of time (“rate limiting”).
 */
defined('API_TOO_MANY_REQ')             || define('API_TOO_MANY_REQ', 429);

/**
 * ---------------------
 * SERVER ERROR (5xx)
 * ---------------------
 */

/**
 * The server encountered an unexpected condition which prevented it from fulfilling the request.
 */
defined('API_INTERNAL_SERVER_ERROR')    || define('API_INTERNAL_SERVER_ERROR', 500);

/**
 * The server got an invalid response while working as a gateway to get a response needed to handle the request.
 */
defined('API_BAD_GATEWAY')              || define('API_BAD_GATEWAY', 502);

/**
 * The server is not ready to handle the request.
 */
defined('API_SERVER_UNAVAILABLE')       || define('API_SERVER_UNAVAILABLE', 503);

/**
 * The server is acting as a gateway and cannot get a response in time for a request.
 */
defined('API_GATEWAY_TIMEOUT')          || define('API_GATEWAY_TIMEOUT', 504);
