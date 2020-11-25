<?php
class Employees extends Controller {
    public function __construct() {
        isAdminLoggedIn();
        //$this->stationModel = $this->model('Station');
    }

    public function index() {
       //$data = $this->employeesModel->findAllEmployees();

     /*   $data = [
            'employees' => $employees
        ];*/
//var_dump($stations);
       // $this->view('employees/index', $data);
        $this->view('employees/index');
    }

    public function add_employee() {

        $this->view('employees/add_employee');
    }
    public function update_employee() {

        $this->view('employees/update_employee');
    }

}