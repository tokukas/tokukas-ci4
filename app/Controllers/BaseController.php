<?php

namespace App\Controllers;

use App\Models\MyModel;
use CodeIgniter\Config\Services;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * Instance of the main Request object.
	 *
	 * @var IncomingRequest|CLIRequest
	 */
	protected $request;

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['custom'];

	//--------------------------------------------------------------------
	// Custom Properties
	//--------------------------------------------------------------------
	/**
	 * The sender name.
	 * @var string
	 */
	protected $senderName;

	/**
	 * The sender email address.
	 *
	 * Need outlook email, or change email configuration file if not using outlook email.
	 * @var string
	 */
	protected $senderEmailAddress;

	/**
	 * The sender email password.
	 * @var string
	 */
	protected $senderPassword;

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();

		/**
		 * -------------------------------------
		 * Session library
		 * -------------------------------------
		 */
		session();

		/**
		 * -------------------------------------
		 * Validation library
		 * -------------------------------------
		 */
		$this->validation = Services::validation();

		/**
		 * -------------------------------------
		 * Load variable library to access variable from database
		 * -------------------------------------
		 */
		$this->variable = MyModel::variable();

		/**
		 * -------------------------------------
		 * Email library
		 * -------------------------------------
		 */
		$this->email = Services::email();

		// set email properties
		$this->senderName = $this->variable->getVar('comp_name');
		$this->senderEmailAddress = $this->variable->getVar('comp_email_address');
		$this->senderPassword = $this->variable->getVar('comp_password_email');

		// set email config
		$config['SMTPUser'] = $this->senderEmailAddress;
		$config['SMTPPass'] = $this->senderPassword;
		$this->email->initialize($config);
	}
}
