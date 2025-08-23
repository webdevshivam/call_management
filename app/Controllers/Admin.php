
<?php

namespace App\Controllers;

use App\Models\TelecallerModel;
use App\Models\CompanyModel;
use App\Models\NumberModel;
use App\Models\AdminModel;

class Admin extends BaseController
{
    protected $telecallerModel;
    protected $companyModel;
    protected $numberModel;
    protected $adminModel;
    protected $session;

    public function __construct()
    {
        $this->telecallerModel = new TelecallerModel();
        $this->companyModel = new CompanyModel();
        $this->numberModel = new NumberModel();
        $this->adminModel = new AdminModel();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'title' => 'Admin Dashboard',
            'total_telecallers' => $this->telecallerModel->countAll(),
            'total_companies' => $this->companyModel->countAll(),
            'total_numbers' => $this->numberModel->countAll(),
            'assigned_numbers' => $this->numberModel->where('status', 'assigned')->countAllResults(),
        ];

        return view('admin/dashboard', $data);
    }

    public function login()
    {
        if ($this->isLoggedIn()) {
            return redirect()->to('/admin');
        }

        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $admin = $this->adminModel->where('username', $username)->first();

            if ($admin && password_verify($password, $admin['password'])) {
                $this->session->set('admin_logged_in', true);
                $this->session->set('admin_id', $admin['id']);
                $this->session->set('admin_username', $admin['username']);
                return redirect()->to('/admin');
            } else {
                $this->session->setFlashdata('error', 'Invalid username or password');
            }
        }

        return view('admin/login');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/admin/login');
    }

    public function telecallers()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'title' => 'Manage Telecallers',
            'telecallers' => $this->telecallerModel->orderBy('created_at', 'DESC')->findAll()
        ];

        return view('admin/telecallers', $data);
    }

    public function addTelecaller()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to('/admin/login');
        }

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'name' => 'required|min_length[3]|max_length[100]',
                'email' => 'required|valid_email|is_unique[telecaller.email]',
                'phone' => 'required|min_length[10]|max_length[15]',
                'username' => 'required|min_length[3]|max_length[50]|is_unique[telecaller.username]',
                'password' => 'required|min_length[6]',
                'address' => 'required'
            ];

            if ($this->validate($rules)) {
                $data = [
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email'),
                    'phone' => $this->request->getPost('phone'),
                    'username' => $this->request->getPost('username'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'address' => $this->request->getPost('address'),
                    'status' => $this->request->getPost('status') ?? 'active'
                ];

                if ($this->telecallerModel->insert($data)) {
                    $this->session->setFlashdata('success', 'Telecaller added successfully');
                    return redirect()->to('/admin/telecallers');
                } else {
                    $this->session->setFlashdata('error', 'Failed to add telecaller');
                }
            } else {
                $this->session->setFlashdata('validation', $this->validator);
            }
        }

        $data = ['title' => 'Add Telecaller'];
        return view('admin/add_telecaller', $data);
    }

    public function companies()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'title' => 'Manage Companies',
            'companies' => $this->companyModel->orderBy('created_at', 'DESC')->findAll()
        ];

        return view('admin/companies', $data);
    }

    public function addCompany()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to('/admin/login');
        }

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'name' => 'required|min_length[3]|max_length[100]',
                'description' => 'required'
            ];

            if ($this->validate($rules)) {
                $data = [
                    'name' => $this->request->getPost('name'),
                    'description' => $this->request->getPost('description'),
                    'status' => $this->request->getPost('status') ?? 'active'
                ];

                if ($this->companyModel->insert($data)) {
                    $this->session->setFlashdata('success', 'Company added successfully');
                    return redirect()->to('/admin/companies');
                } else {
                    $this->session->setFlashdata('error', 'Failed to add company');
                }
            } else {
                $this->session->setFlashdata('validation', $this->validator);
            }
        }

        $data = ['title' => 'Add Company'];
        return view('admin/add_company', $data);
    }

    public function uploadNumbers()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to('/admin/login');
        }

        if ($this->request->getMethod() === 'post') {
            $file = $this->request->getFile('csv_file');
            $company_id = $this->request->getPost('company_id');

            if ($file->isValid() && !$file->hasMoved()) {
                $csvData = array_map('str_getcsv', file($file->getTempName()));
                $header = array_shift($csvData);

                $inserted = 0;
                foreach ($csvData as $row) {
                    if (count($row) >= 2) {
                        $data = [
                            'name' => trim($row[0]),
                            'phone' => trim($row[1]),
                            'company_id' => $company_id,
                            'status' => 'unassigned'
                        ];
                        
                        if ($this->numberModel->insert($data)) {
                            $inserted++;
                        }
                    }
                }

                $this->session->setFlashdata('success', "$inserted numbers uploaded successfully");
                return redirect()->to('/admin/numbers');
            } else {
                $this->session->setFlashdata('error', 'Please select a valid CSV file');
            }
        }

        $data = [
            'title' => 'Upload Numbers',
            'companies' => $this->companyModel->where('status', 'active')->findAll()
        ];
        return view('admin/upload_numbers', $data);
    }

    public function numbers()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'title' => 'Manage Numbers',
            'numbers' => $this->numberModel->select('numbers.*, companies.name as company_name, telecaller.name as telecaller_name')
                                          ->join('companies', 'companies.id = numbers.company_id', 'left')
                                          ->join('telecaller', 'telecaller.id = numbers.telecaller_id', 'left')
                                          ->orderBy('numbers.created_at', 'DESC')
                                          ->findAll()
        ];

        return view('admin/numbers', $data);
    }

    public function assignNumbers()
    {
        if (!$this->isLoggedIn()) {
            return redirect()->to('/admin/login');
        }

        if ($this->request->getMethod() === 'post') {
            $telecaller_id = $this->request->getPost('telecaller_id');
            $company_id = $this->request->getPost('company_id');
            $number_ids = $this->request->getPost('number_ids');

            if ($telecaller_id && $company_id && !empty($number_ids)) {
                $assigned = 0;
                foreach ($number_ids as $number_id) {
                    // Update number status and assign telecaller
                    if ($this->numberModel->update($number_id, [
                        'telecaller_id' => $telecaller_id,
                        'status' => 'assigned'
                    ])) {
                        // Insert assignment record
                        $assignmentData = [
                            'telecaller_id' => $telecaller_id,
                            'number_id' => $number_id,
                            'company_id' => $company_id,
                            'assigned_by' => $this->session->get('admin_id')
                        ];
                        
                        $db = \Config\Database::connect();
                        $db->table('number_assignments')->insert($assignmentData);
                        $assigned++;
                    }
                }

                $this->session->setFlashdata('success', "$assigned numbers assigned successfully");
                return redirect()->to('/admin/numbers');
            } else {
                $this->session->setFlashdata('error', 'Please fill all required fields');
            }
        }

        $data = [
            'title' => 'Assign Numbers',
            'telecallers' => $this->telecallerModel->where('status', 'active')->findAll(),
            'companies' => $this->companyModel->where('status', 'active')->findAll(),
            'unassigned_numbers' => $this->numberModel->select('numbers.*, companies.name as company_name')
                                                     ->join('companies', 'companies.id = numbers.company_id', 'left')
                                                     ->where('numbers.status', 'unassigned')
                                                     ->findAll()
        ];

        return view('admin/assign_numbers', $data);
    }

    private function isLoggedIn()
    {
        return $this->session->get('admin_logged_in') === true;
    }
}
