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
	public $login = [
		'email' => [
			'rules' => 'required|valid_email',
			'errors' => [
				'required' => 'Email wajib diisi.',
				'valid_email' => 'Harap masukkan email dengan benar.',
			],
		],
		'password' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'Kata sandi wajib diisi.',
			],
		],
	];


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
				'required' => 'Nama wajib diisi.',
				'max_length' => 'Nama tidak boleh lebih dari {param} karakter.',
			],
		],
		'password' => [
			'rules' => 'required',
			'errors' => [
				'required' => 'Kata sandi wajib diisi.',
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

	public $address = [
		'label' => [
			'rules' => 'required|string|max_length[25]',
			'errors' => [
				'required' => 'Label wajib diisi.',
				'string' => 'Label hanya boleh diisi menggunakan huruf, angka, dan spasi.',
				'max_length' => 'Label tidak boleh lebih dari {param} karakter.',
			]
		],
		'province' => [
			'rules' => 'required|string|min_length[3]|max_length[255]',
			'errors' => [
				'required' => 'Provinsi wajib diisi.',
				'min_length' => 'Provinsi harus lebih dari {param} karakter.',
				'max_length' => 'Provinsi tidak boleh lebih dari {param} karakter.',
			]
		],
		'regency' => [
			'rules' => 'required_without[province]|required|string|min_length[3]|max_length[255]',
			'errors' => [
				'required_without' => 'Harap isi kolom Provinsi terlebih dahulu.',
				'required' => 'Kabupaten/Kota wajib diisi.',
				'min_length' => 'Kabupaten/Kota harus lebih dari {param} karakter.',
				'max_length' => 'Kabupaten/Kota tidak boleh lebih dari {param} karakter.',
			]
		],
		'district' => [
			'rules' => 'required_without[province,regency]|required|string|min_length[3]|max_length[255]',
			'errors' => [
				'required_without' => 'Harap isi kolom Provinsi dan Kabupaten/Kota terlebih dahulu.',
				'required' => 'Kecamatan wajib diisi.',
				'min_length' => 'Kecamatan harus lebih dari {param} karakter.',
				'max_length' => 'Kecamatan tidak boleh lebih dari {param} karakter.',
			]
		],
		'village' => [
			'rules' => 'required_without[province,regency,district]|required|string|min_length[3]|max_length[255]',
			'errors' => [
				'required_without' => 'Harap isi kolom Provinsi, Kabupaten/Kota, dan Kecamatan terlebih dahulu.',
				'required' => 'Desa/Kelurahan wajib diisi.',
				'min_length' => 'Desa/Kelurahan harus lebih dari {param} karakter.',
				'max_length' => 'Desa/Kelurahan tidak boleh lebih dari {param} karakter.',
			]
		],
		'postal_code' => [
			'rules' => 'required|exact_length[5]|integer',
			'errors' => [
				'required' => 'Kode Pos wajib diisi.',
				'exact_length' => 'Harap isi Kode Pos dengan {param} digit angka.',
				'integer' => 'Kode Pos hanya boleh diisi dengan angka.',
			]
		],
		'street' => [
			'rules' => 'required|string|min_length[20]|max_length[255]',
			'errors' => [
				'required' => 'Jalan wajib diisi.',
				'min_length' => 'Isian Jalan kurang lengkap. Minimal {param} karakter.',
				'max_length' => 'Jalan tidak boleh lebih dari {param} karakter.',
			]
		],
	];
}
