<?php

class Projects extends Controller {
    public function __construct() {
        $this->projectModel = $this->model('Project');
        $this->organizationModel = $this->model('Organization');
    }

    public function createProject() {
        error_reporting(E_ALL ^ E_WARNING);
        error_reporting(E_ALL ^ E_NOTICE);
        $data = [
            'cause' => '',
            'otherCause' => '',
            'title' => '',
            'initDate' => '',
            'prjDescription' => '',
            'volunteering' => '',       //Yes or No
            'volReason' => '',
            'volDescription' => '',
            'district' => '',
            'area' => '',
            'workFrom' => '',
            'workTo' => '',
            'volRequirements' => '',
            'workStart' => '',
            'workEnd' => '',
            'days' => '',
            'appOpen' => '',
            'appClose' => '',
            'addNotes' => '',
            'funding' => '',           //Yes or No
            'prjFundsFor' => '',
            'targetAmount' => '',
            'fundStart' => '',
            'fundEnd' => '',
            'bankInfo' => '',         //newAccount or savedAccount
            'accountHolder' => '',
            'bank' => '',
            'branch' => '',
            'branchCode' => '',
            'accountNo' => '',
            'saveAccount' => '',
            'selectedAccount' => '',
            'causeError' => '',
            'titleError' => '',
            'initDateError' => '',
            'prjDescriptionError' => '',
            'prjImageError' => '',
            'volReasonError' => '',
            'volDescriptionError' => '',
            'districtError' => '',
            'areaError' => '',
            'workFromError' => '',
            'workToError' => '',
            'workStartError' => '',
            'workEndError' => '',
            'daysError' => '',
            'appOpenError' => '',
            'appCloseError' => '',
            'prjFundsForError' => '',
            'targetAmountError' => '',
            'fundStartError' => '',
            'fundEndError' => '',
            'accountHolderError' => '',
            'bankError' => '',
            'branchError' => '',
            'branchCodeError' => '',
            'accountNoError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //File Upload
            $output_dir = "uploads/projects";//Path for file upload
            $RandomNum = time();

            if(!empty($_FILES['prj-image']['name'])) {
                $file_name = str_replace(' ','-',strtolower($_FILES['prj-image']['name']));
                // $ImageType = $_FILES['prj-image']['type']; //"image/png", image/jpeg etc.
                $ImageExt = substr($file_name, strrpos($file_name, '.'));
                $ImageExt = str_replace('.','',$ImageExt);
                $file_name = preg_replace("/\.[^.\s]{3,4}$/", "", $file_name);
                $Newfile_name = $file_name.'-'.$RandomNum.'.'.$ImageExt;
                $ret[$Newfile_name]= $output_dir.$Newfile_name;
                move_uploaded_file($_FILES["prj-image"]["tmp_name"], $output_dir."/".$Newfile_name );
                $prj_img = $output_dir."/".$Newfile_name;
            }

            if(!empty($_FILES['vol-image']['name'])) {
                $file_name = str_replace(' ','-',strtolower($_FILES['vol-image']['name']));
                // $ImageType = $_FILES['vol-image']['type']; //"image/png", image/jpeg etc.
                $ImageExt = substr($file_name, strrpos($file_name, '.'));
                $ImageExt = str_replace('.','',$ImageExt);
                $file_name = preg_replace("/\.[^.\s]{3,4}$/", "", $file_name);
                $Newfile_name = $file_name.'-'.$RandomNum.'.'.$ImageExt;
                $ret[$Newfile_name]= $output_dir.$Newfile_name;
                move_uploaded_file($_FILES["vol-image"]["tmp_name"], $output_dir."/".$Newfile_name );
                $vol_img = $output_dir."/".$Newfile_name;
            }

            if(!empty($_FILES['fund-image']['name'])) {
                $file_name = str_replace(' ','-',strtolower($_FILES['fund-image']['name']));
                // $ImageType = $_FILES['fund-image']['type']; //"image/png", image/jpeg etc.
                $ImageExt = substr($file_name, strrpos($file_name, '.'));
                $ImageExt = str_replace('.','',$ImageExt);
                $file_name = preg_replace("/\.[^.\s]{3,4}$/", "", $file_name);
                $Newfile_name = $file_name.'-'.$RandomNum.'.'.$ImageExt;
                $ret[$Newfile_name]= $output_dir.$Newfile_name;
                move_uploaded_file($_FILES["fund-image"]["tmp_name"], $output_dir."/".$Newfile_name );
                $fund_img = $output_dir."/".$Newfile_name;
            }
            
            $data = [
                'create-date' => date("Y-m-d"),
                'cause' => trim($_POST['cause']),
                'otherCause' => trim($_POST['otherCause']),
                'title' => trim($_POST['title']),
                'initDate' => trim($_POST['initDate']),
                'prjDescription' => trim($_POST['prjDescription']),
                'prj-image' => $prj_img,
                'volunteering' => trim($_POST['volunteering']),
                'volReason' => trim($_POST['volReason']),
                'volDescription' => trim($_POST['volDescription']),
                'district' => trim($_POST['district']),
                'area' => trim($_POST['area']),
                'workFrom' => trim($_POST['workFrom']),
                'workTo' => trim($_POST['workTo']),
                'volRequirements' => trim($_POST['volRequirements']),
                'workStart' => trim($_POST['workStart']),
                'workEnd' => trim($_POST['workEnd']),
                'days' => trim($_POST['days']),
                'appOpen' => trim($_POST['appOpen']),
                'appClose' => trim($_POST['appClose']),
                'addNotes' => trim($_POST['addNotes']),
                'vol-image' => $vol_img,
                'funding' => trim($_POST['funding']),
                'prjFundsFor' => trim($_POST['prjFundsFor']),
                'targetAmount' => trim($_POST['targetAmount']),
                'fundStart' => trim($_POST['fundStart']),
                'fundEnd' => trim($_POST['fundEnd']),
                'fund-image' => $fund_img,
                'bankInfo' => trim($_POST['bankInfo']),
                'accountHolder' => trim($_POST['accountHolder']),
                'bank' => trim($_POST['bank']),
                'branch' => trim($_POST['branch']),
                'branchCode' => trim($_POST['branchCode']),
                'accountNo' => trim($_POST['accountNo']),
                'saveAccount' => trim($_POST['saveAccount']),       // if selected -> True
                'selectedAccount' => trim($_POST['selectedAccount']),
                'causeError' => '',
                'titleError' => '',
                'initDateError' => '',
                'prjDescriptionError' => '',
                'prjImageError' => '',
                'volReasonError' => '',
                'volDescriptionError' => '',
                'districtError' => '',
                'areaError' => '',
                'workFromError' => '',
                'workStartError' => '',
                'workEndError' => '',
                'daysError' => '',
                'appOpenError' => '',
                'appCloseError' => '',
                'prjFundsForError' => '',
                'targetAmountError' => '',
                'fundStartError' => '',
                'fundEndError' => '',
                'accountHolderError' => '',
                'bankError' => '',
                'branchError' => '',
                'branchCodeError' => '',
                'accountNoError' => ''
            ];

            $vol = 'False';
            $fund = 'False';

            // Input Validation

            if(empty($data['cause'])) {
                $data['causeError'] = 'Please specify the cause of the project';
            }
            if(empty($data['title'])) {
                $data['titleError'] = 'Please provide a title for the project';
            }
            if(empty($data['initDate'])) {
                $data['initDateError'] = 'Please mention when the project is to be implemented';
            }else{
                $initDate = strtotime($data['initDate']);
                $date_now = time();
                
                // Check if it's a future date
                if($date_now > $initDate) {
                    $data['initDateError'] = 'Please select an upcoming day';
                }
            }
            if(empty($data['prjDescription'])) {
                $data['prjDescriptionError'] = 'Please provide a brief description of the project';
            }

            if(strcmp($data['volunteering'], 'Yes') == 0){
                $vol = 'True';
                if(empty($data['volReason'])) {
                    $data['volReasonError'] = 'Please describe why the project requires volunteers';
                }
                if(empty($data['volDescription'])) {
                    $data['volDescriptionError'] = 'Please describe the job of a volunteer in this project';
                }
                if(empty($data['district'])) {
                    $data['districtError'] = 'Please specify the location of the job';
                }
                if(empty($data['area'])) {
                    $data['areaError'] = 'Please specify the location of the job';
                }
                if(empty($data['workFrom'])) {
                    $data['workFromError'] = 'Mention when the work starts';
                }
                if(empty($data['workStart'])) {
                    $data['workStartError'] = 'Mention the start date for volunteers';
                }else {
                    $workStart = strtotime($data['workStart']);
                    $date_now = time();
                    
                    // Check if it's a future date
                    if($date_now > $workStart) {
                        $data['workStartError'] = 'Please select an upcoming day';
                    }
                }
                if(!empty($data['workEnd'])) {
                    $workEnd = strtotime($data['workEnd']);
                    $date_now = time();
                    
                    // Check if it's a future date
                    if($date_now > $workEnd) {
                        $data['workEndError'] = 'Please select an upcoming day';
                    } elseif($workEnd < strtotime($data['workStart'])) {
                        $data['workEndError'] = 'Please make sure the date is set after start date';
                    }
                }
                if(empty($data['days'])) {
                    $data['daysError'] = 'Please specify the workdays';
                }
                if(empty($data['appOpen'])) {
                    $data['appOpenError'] = 'Specify opening date for applications';
                }else {
                    $appOpen = strtotime($data['appOpen']);
                    $date_now = time();
                    
                    // Check if it's a future date
                    if($date_now > $appOpen) {
                        $data['appOpenError'] = 'Please select an upcoming day';
                    } elseif($appOpen > strtotime($data['workStart'])) {
                        $data['appOpenError'] = 'Please make sure the date is set to before work starts';
                    }
                }
                if(!empty($data['appClose'])) {
                    $appClose = strtotime($data['appClose']);
                    $date_now = time();
                    
                    // Check if it's a future date
                    if($date_now > $appClose) {
                        $data['appCloseError'] = 'Please select an upcoming day';
                    } elseif($appClose < strtotime($data['appOpen'])) {
                        $data['appCloseError'] = 'Please make sure the date is set to after open date';
                    }
                }
            }

            if(strcmp($data['funding'], 'Yes') == 0) {
                $fund = 'True';
                if(empty($data['prjFundsFor'])) {
                    $data['prjFundsForError'] = 'Please describe what the funds will be used for';
                }
                if(empty($data['targetAmount'])) {
                    $data['targetAmountError'] = 'Please specify the amount to be raised';
                } elseif((int)$data['targetAmount'] > 200000) {
                    $data['targetAmountError'] = 'Maximum amount that can be raised is LKR 200,000';
                }
                if(empty($data['fundStart'])) {
                    $data['fundStartError'] = 'Specify the date to start raising funds';
                }else {
                    $fundStart = strtotime($data['fundStart']);
                    $date_now = time();
                    
                    // Check if it's a future date
                    if($date_now > $fundStart) {
                        $data['fundStartError'] = 'Please select an upcoming day';
                    }
                }
                if(empty($data['fundEnd'])) {
                    $data['fundEndError'] = 'Specify the date to close the fundaraiser';
                }else {
                    $fundEnd = strtotime($data['fundEnd']);
                    $date_now = time();
                    
                    // Check if it's a future date
                    if($date_now > $fundEnd) {
                        $data['fundEndError'] = 'Please select an upcoming day';
                    }elseif($fundEnd < strtotime($data['fundStart'])) {
                        $data['fundEndError'] = 'Please make sure the date is set to after start date';
                    }
                }

                if(strcmp($data['bankInfo'], 'newAccount') == 0) {
                    if(empty($data['accountHolder'])) {
                        $data['accountHolderError'] = 'Please provide the name of the account holder';
                    }
                    if(empty($data['bank'])) {
                        $data['bankError'] = 'Please provide the bank name';
                    }
                    if(empty($data['branch'])) {
                        $data['branchError'] = 'Please provide the branch name';
                    }
                    if(empty($data['accountNo'])) {
                        $data['accountNoError'] = 'Please provide the account number';
                    }
                }    
            }

            if(empty($data['causeError']) && empty($data['titleError']) && empty($data['initDateError']) 
            && empty($data['prjDescriptionError']) && empty($data['volReasonError'])
            && empty($data['volDescriptionError']) && empty($data['districtError'])
            && empty($data['areaError']) && empty($data['workFromError'])
            && empty($data['workStartError']) && empty($data['daysError'])
            && empty($data['appOpenError']) && empty($data['prjFundsForError'])
            && empty($data['targetAmountError']) && empty($data['fundStartError'])
            && empty($data['fundEndError']) && empty($data['accountHolderError'])
            && empty($data['bankError']) && empty($data['branchError'])
            && empty($data['branchCodeError']) && empty($data['accountNoError'])) {
                
                $prjID = $this->projectModel->saveProject($data, $vol, $fund);

                if($prjID != -1) {
                    if(strcmp($data['volunteering'], 'Yes') == 0) {
                        if($this->projectModel->saveVolunteeringOpportunity($data, $prjID)) {
                            echo 'Volunteering opportunity saved';
                        } else {
                            die('Could not save volunteering opportunity.');
                        }
                    }
                    if(strcmp($data['funding'], 'Yes') == 0) {
                        if(strcmp($data['bankInfo'], 'savedAccount') == 0) {
                            $bankID = $data['selectedAccount'];
                        } elseif(strcmp($data['bankInfo'], 'newAccount') == 0) {
                            $bankID = $this->organizationModel->saveBankAccount($data);
                        }

                        if($bankID != -1) {
                            if($this->projectModel->saveFundraiser($data, $prjID, $bankID)) {
                                echo 'Fundraising details saved';
                            } else {
                                die('Could not save fundraiser details.');
                            }
                        } else {
                            die('Could not get Bank ID');
                        }                    
                    }

                    header('location:' . URL_ROOT . '/pages/index');
                } else {
                    die('Something went wrong.');
                }
            }
        }

        $accounts = $this->organizationModel->getBankAccounts();
        $results = array($accounts, $data);

        $this->view('projects/createProject', $results);
    }
  
    public function projectView($id) {
    
        $data = [
            'project'=>$this->projectModel->getprojectView($id),
            'volunteer_opportunity'=> $this->projectModel->getVolunteerOpportunity($id),
            'fundraiser'=> $this->projectModel->getFundraiser($id),
        ];
        $this->view('projects/viewSingleProject', $data);
    }

    public function createVolunteerOpportunity() {
        $data = [
            'volunteers' => '',
            'reason' => '',
            'description' => '',
            'district' => '',
            'area' => '',
            'work-start' => '',
            'work-end' => '',
            'work-from' => '',
            'work-to' => '',
            'days' => '',
            'requirements' => '',
            'app-open' => '',
            'app-close' => '',
            'create-date' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'volunteers' => '',
                'reason' => trim($_POST['reason']),
                'description' => trim($_POST['description']),
                'district' => trim($_POST['district']),
                'area' => trim($_POST['area']),
                'work-start' => trim($_POST['work-start']),
                'work-end' => trim($_POST['work-end']),
                'work-from' => trim($_POST['work-from']),
                'work-to' => trim($_POST['work-to']),
                'days' => trim($_POST['days']),
                'requirements' => trim($_POST['requirements']),
                'app-open' => trim($_POST['app-open']),
                'app-close' => trim($_POST['app-close']),
                'create-date' => date("Y-m-d")
            ];

            if($this->projectModel->createOpportunity($data)) {
                header('location:' . URL_ROOT . '/pages/index');
            } else {
                die('Something went wrong.');
            }
        }

        $this->view('users/organization/createVolunteerOpportunity', $data);
    }

    public function donate($id) {

        //Retrieve donation messages from DB

        $results = '';

        $this->view('projects/donationForm', $results);
    }

    public function saveTransaction() {

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'merchant_id' => trim($_POST['merchant_id']),
                'fundraiser_id' => trim($_POST['order_id']),
                'amount' => trim($_POST['payhere_amount']),
                'currency' => trim($_POST['payhere_currency']),
                'status_code' => trim($_POST['status_code']),
                'card_holder_name' => trim($_POST['card_holder_name']),
                'method' => trim($_POST['method']),
                'name' => trim($_POST['custom_1']),
                'message' => trim($_POST['custom_2']),
                'date' => date("d M Y")
            ];

            // $md5sig                = $_POST['md5sig'];

            // $merchant_secret = '8RiHfcJMTcB4krnVrzkOFk4EtK4shHNcx4OXHTtUtVNR';

            // $local_md5sig = strtoupper (md5 ( $merchant_id . $fundraiser_id . $payhere_amount . $payhere_currency . $status_code . strtoupper(md5($merchant_secret)) ) );

            if($data['status_code'] == 2){
                if($this->projectModel->saveTransaction($data)) {

                    die('Transaction completed successfully!');
                } else {
                    die('Something went wrong.');
                }
            } else {
                // Payment Error
                die('Something went wrong.');
            }

        }
    }

    public function approveProject($id) {
        // $data = [
        //     'title' => ''
        // ];

        if($_SERVER['REQUEST_METHOD'] == 'GET') {

            $data = [
                'title' => ''
            ];

            if($this->projectModel->approveProject($id)) {
                header('location:' . URL_ROOT . '/pages/index');
            } else {
                die('Something went wrong.');
            }
        }

        $this->view('pages/index');
    }

    public function rejectProject($id) {
        // $data = [
        //     'title' => ''
        // ];

        if($_SERVER['REQUEST_METHOD'] == 'GET') {

            $data = [
                'title' => ''
            ];

            if($this->projectModel->rejectProject($id)) {
                header('location:' . URL_ROOT . '/pages/index');
            } else {
                die('Something went wrong.');
            }
        }

        $this->view('pages/index');
    }

    public function viewAllProjects() {

        $data = [
            'projects' => $this->projectModel->getAllProjects(),
            'on_going_projects' => $this->projectModel->getProjectByStatus('ongoing'),
            'completed_projects' => $this->projectModel->getProjectByStatus('completed'),
            'upcoming_projects' => $this->projectModel->getProjectByStatus('ongoing'),

            'on_going_projects_count' => $this->projectModel->getCountByStatus('ongoing'),
            'upcoming_projects_count' => $this->projectModel->getCountByStatus('completed'),
            'completed_projects_count' => $this->projectModel->getCountByStatus('Completed'),
            'total_projects_count' => $this->projectModel->getProjectCount(),

            'organizations_count' => $this->organizationModel->getOrganizationsCount()
        ];

        $this->view('projects/viewAllProjects', $data);
    }
}
