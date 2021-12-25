<?php

    class Project {
        private $db;

        public function __construct()
        {
            $this->db = new Database;
        }
       
        // public function createOpportunity($data) {
        //     $this->db->query('INSERT INTO `petso`.`Volunteer_Opportunity` 
        //     (`reason`, `description`, `district`, `area`, `work_start`, `work_end`, `work_from`, `work_to`, `days`, `requirements`, `app_open`, `app_close`, `create_date`) 
        //     VALUES (:reason, :description, :district, :area, :workstart, :workend, :workfrom, :workto, :days, :requirements, :appopen, :appclose, :createdate)');
            
        //     $this->db->bind(':reason', $data['reason']);
        //     $this->db->bind(':description', $data['description']);
        //     $this->db->bind(':district', $data['district']);
        //     $this->db->bind(':area', $data['area']);
        //     $this->db->bind(':workstart', $data['work-start']);
        //     $this->db->bind(':workend', $data['work-end']);
        //     $this->db->bind(':workfrom', $data['work-from']);
        //     $this->db->bind(':workto', $data['work-to']);
        //     $this->db->bind(':days', $data['days']);
        //     $this->db->bind(':requirements', $data['requirements']);
        //     $this->db->bind(':appopen', $data['app-open']);
        //     $this->db->bind(':appclose', $data['app-close']);
        //     $this->db->bind(':createdate', $data['create-date']);

        //     if($this->db->execute()) {
        //         return true;
        //     } else {
        //         return false;
        //     }
        // }

        public function saveProject($data) {
            $this->db->query('INSERT INTO `petso`.`Project` 
            (`title`, `org_id`, `cause`, `create_date`, `initiation_date`, `description`, `status`) 
            VALUES (:title, :org_id, :cause, :create_date, :initiation_date, :description, :status)');
            
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':org_id', $_SESSION['user_id']);
            $this->db->bind(':cause', $data['cause']);
            $this->db->bind(':create_date', $data['create-date']);
            $this->db->bind(':initiation_date', $data['initDate']);
            $this->db->bind(':description', $data['prjDescription']);
            $this->db->bind(':status', 'Pending');

            if($this->db->execute()) {
                return $this->db->getLastInsertedId();
            } else {
                return -1;
            }
        }

        public function saveVolunteeringOpportunity($data, $prjID) {
            $this->db->query('INSERT INTO `petso`.`Volunteer_Opportunity` 
            (`prj_id`, `reason`, `description`, `district`, `area`, `work_start`, `work_end`, `work_from`, `work_to`, `days`, `requirements`, `app_open`, `app_close`, `add_note`) 
            VALUES (:prj_id, :reason, :description, :district, :area, :work_start, :work_end, :work_from, :work_to, :days, :requirements, :app_open, :app_close, :add_note)');
            
            $this->db->bind(':prj_id', $prjID);
            $this->db->bind(':reason', $data['volReason']);
            $this->db->bind(':description', $data['volDescription']);
            $this->db->bind(':district', $data['district']);
            $this->db->bind(':area', $data['area']);
            $this->db->bind(':work_start', $data['workStart']);
            $this->db->bind(':work_end', $data['workEnd']);
            $this->db->bind(':work_from', $data['workFrom']);
            $this->db->bind(':work_to', $data['workTo']);
            $this->db->bind(':days', $data['days']);
            $this->db->bind(':requirements', $data['volRequirements']);
            $this->db->bind(':app_open', $data['appOpen']);
            $this->db->bind(':app_close', $data['appClose']);;
            $this->db->bind(':add_note', $data['addNotes']);

            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function saveFundraiser($data, $prjID, $bankID) {
            $this->db->query('INSERT INTO `petso`.`Fundraiser` 
            (`prj_id`, `funds_for`, `target_amount`, `funding_start`, `funding_end`, `bank_acnt_id`) 
            VALUES (:prj_id, :funds_for, :target_amount, :funding_start, :funding_end, :bank_acnt_id)');
            
            $this->db->bind(':prj_id', $prjID);
            $this->db->bind(':funds_for', $data['prjFundsFor']);
            $this->db->bind(':target_amount', $data['targetAmount']);
            $this->db->bind(':funding_start', $data['fundStart']);
            $this->db->bind(':funding_end', $data['fundEnd']);
            $this->db->bind(':bank_acnt_id', $bankID);
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function getOpportunities() {
            $this->db->query('SELECT * FROM `petso`.`Volunteer_Opportunity`');

            // $this->db->bind();

            $result = $this->db->resultSet();

            return $result;
        }
    }