<?php
class AdminNotices extends Controller {
    public function __construct() {
        isAdminLoggedIn();
        $this->adminnoticeModel = $this->model('AdminNotice');
    }

    public function index() {
        
        $notices = $this->adminnoticeModel->findAllNotices();
        $fields=$this->adminnoticeModel->getNoticesFields();
            $data=[
                'notices'=>$notices,
                'fields'=>$fields
            ];
        $this->view('admins/notices/index', $data);
    }

     public function addNotice() {
        /*
        if(!isLoggedIn()) {
            header("Location: " . URLROOT . "/posts");
        }*/

        $data = [
            'type' => '',
            'title'=>'',
            'description' => '',
            'entered_date' => '',
            'entered_time' => '',       
            'adminId' => '',
            'typeError' => '',
            'titleError' => '',
            'descriptionError' => '',
            'entered_dateError' => '',
            'entered_timeError' => ''       
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [

                    'adminId'=>'',
                    'type'=>trim($_POST['type']),
                    'title'=>trim($_POST['title']),
                    'description'=>trim($_POST['description']),
                    'entered_date'=>date("Y-m-d"),
                    'entered_time'=>date("H:i:s"),                                                   //'adminId'=>trim($_POST['admin_id']),
                    'typeError' => '',
                    'descriptionError' => '',
                    'titleError' => '',
                    'entered_dateError' => '',
                    'entered_timeError' => '',
                    'adminIdError' => ''
            ];

            if($_SESSION['role']==6){
                $data['adminId'] = $_SESSION['superadmin_id'];
            }elseif($_SESSION['role']==2){
                $data['adminId']=$_SESSION['admin_id'];
            }


//var_dump($data);
            if(empty($data['title'])) {
                $data['titleError'] = 'The title of a notice cannot be empty';
            }
            if(empty($data['description'])) {
                $data['descriptionError'] = 'The description of a notice cannot be empty';
            }
            if(empty($data['type'])) {
                $data['typeError'] = 'The type of a notice cannot be empty';
            }
            

            if (empty($data['titleError']) && empty($data['typeError']) && empty($data['descriptionError'])) {
                if ($this->adminnoticeModel->addNotice($data)) {
                    header("Location: " . URLROOT . "/adminNotices");
                } else {
                    die("Something went wrong, please try again!");
                }
            } else {
                $this->view('admins/notices/add_notice', $data);
            }
        }

        $this->view('admins/notices/add_notice', $data);
     

     }

     public function updateNotice($noticeId) { 

       $notice = $this->adminnoticeModel->findNoticeById($noticeId);

        $data = [  
            'notice' => $notice,
            'title'=>'',
            'description' => '',
            'type' => '',
            'descriptionError' => '',
            'typeError' => ''

            ];
//var_dump($data);
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                    'noticeId'=>$noticeId,
                    'notice' => $notice,
                    //'adminId'=>$_SESSION['admin_id'],
                    'title'=>trim($_POST['title']),
                    'description'=>trim($_POST['description']),
                    'type'=>trim($_POST['type']),
                    'descriptionError' => '',
                    'typeError' => ''
            ];

            if($_SESSION['role']==6){
                $data['adminId'] = $_SESSION['superadmin_id'];
            }elseif($_SESSION['role']==2){
                $data['adminId']=$_SESSION['admin_id'];
            }

            
            if(empty($data['description'])) {
                $data['descriptionError'] = 'The description of a station cannot be empty';
            }


            if(empty($data['type'])) {
                $data['typeError'] = 'The type of a station cannot be empty';
            }
            if(empty($data['title'])) {
                $data['titleError'] = 'The title of a notice cannot be empty';
            }


            if($data['description'] == $this->adminnoticeModel->findNoticeById($noticeId)->description) {
                $data['descriptionError'] = 'At least change one field!';
            }
            if($data['type'] == $this->adminnoticeModel->findNoticeById($noticeId)->type) {
                $data['typeError'] = 'At least change one field!';
            }
            if($data['title'] == $this->adminnoticeModel->findNoticeById($noticeId)->title) {
                $data['titleError'] = 'At least change one field!';
            }

            if (empty($data['descriptionError']) && empty($data['typeError']) && empty($data['titleError'])) {
                if ($this->adminnoticeModel->updateNotice($data)) {
                    header("Location: " . URLROOT . "/adminNotices");
                } else {
                    die("Something went wrong, please try again!");
                }
            } else {
                $this->view('admins/notices/update_notice', $data);
            }
        }

        $this->view('admins/notices/update_notice', $data);
     }


    public function delete($noticeId)
        {
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                if ($this->adminnoticeModel->delete($noticeId)) {
                    header("Location: ".URLROOT."/adminNotices/index");
                } else {
                    die("Something went wrong");
                }
                
            }
            
        }

    public function noticeSearchBy()
        {
           
            $data=[
                'notices'=>'',
                'fields'=>'',
                'searchBar'=>'',
                'searchSelect'=>''
            ];
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=[
                    'notices'=>'',
                    'fields'=>'',
                    'searchBar'=>trim($_POST['searchbar']),
                    'searchSelect'=>trim($_POST['searchselect'])
                ];

                $notices=$this->adminnoticeModel->searchnotices($data['searchBar'],$data['searchSelect']);
                $fields=$this->adminnoticeModel->getNoticesFields();
                $data=[
                    'notices'=>$notices,
                    'fields'=>$fields,
                    'searchBar'=>trim($_POST['searchbar']),
                    'searchSelect'=>trim($_POST['searchselect'])
                ];
                
            }  
            $this->view('admins/notices/index', $data);

        }

}