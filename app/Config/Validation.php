<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	public $registerEmail = [
		'email' => [
			'rules' => 'required|valid_email|is_unique[Account.email]|max_length[100]',
			'errors' => [
				'required' => 'Email wajib diisi.',
				'valid_email' => 'Harap masukkan email dengan benar.',
				'is_unique' => 'Email \'{value}\' sudah digunakan. Harap gunakan email lain.',
				'max_length' => 'Email tidak boleh lebih dari {param} karakter.',
			],
		]
	];

	public $registerAccount = [
		'fullname' => [
			'rules' => 'required|max_length[255]',
			'errors' => [
				'required' => 'Nama wajib diisi',
				'max_length' => 'Nama tidak boleh lebih dari {param} karakter.',
			],
		],
		'password' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'Kata sandi wajib diisi',
			],
		],
		'cpassword' => [
			'rules' => 'required|matches[password]',
			'errors' => [
				'required' => 'Konfirmasi kata sandi wajib diisi',
				'matches' => 'Konfirmasi kata sandi tidak cocok',
			],
		],
	];
}
