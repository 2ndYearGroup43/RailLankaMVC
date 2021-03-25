<?php
class Admindashboard {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }




    public function getCancelCount($date=0){
        if($date==0){
            $date=date("Y-m-d");
        }
        $this->db->query('SELECT COUNT(*) AS count FROM cancelled_alerts c 
    INNER JOIN alerts a ON a.alertId=c.alertId
    WHERE c.cancellation_date=:date');
        $this->db->bind(':date', $date);
        $row=$this->db->single();
        return $row->count;
    }

    public function getDelayCount($date=0){
        if($date==0){
            $date=date("Y-m-d");
        }
        $this->db->query('SELECT COUNT(*) AS count FROM delayed_alerts d 
    INNER JOIN alerts a ON a.alertId=d.alertId
    WHERE d.delaydate=:date');
        $this->db->bind(':date', $date);
        $row=$this->db->single();
        return $row->count;
    }

    public function getReschCount($date=0){
        if($date==0){
            $date=date("Y-m-d");
        }
        $this->db->query('SELECT COUNT(*) AS count FROM rescheduled_alerts r
    INNER JOIN alerts a ON a.alertId=r.alertId
    WHERE r.olddate=:date');
        $this->db->bind(':date', $date);
        $row=$this->db->single();
        return $row->count;
    }

    public function getIssueCounts($date=0){
        if($date==0){
            $date=date("Y-m-d");
        }
        $issueCounts=[
            'environmental'=>'',
            'technical'=>'',
            'railroad'=>'',
            'unspecified'=>'',
            'other'=>''
        ];
        $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN cancelled_alerts c ON a.alertId=c.alertId 
            WHERE a.issuetype='Environmental' AND c.cancellation_date=:date");
        $this->db->bind(':date', $date);
        $cEnv=$this->db->single()->count;
        $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN delayed_alerts d ON a.alertId=d.alertId 
            WHERE a.issuetype='Environmental' AND d.delaydate=:date");
        $this->db->bind(':date', $date);
        $dEnv=$this->db->single()->count;
        $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN rescheduled_alerts r ON a.alertId=r.alertId 
            WHERE a.issuetype='Environmental' AND r.olddate=:date");
        $this->db->bind(':date', $date);
        $rEnv=$this->db->single()->count;
        $issueCounts['environmental']=$cEnv+$dEnv+$rEnv;


        $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN cancelled_alerts c ON a.alertId=c.alertId
            WHERE a.issuetype='Technical' AND c.cancellation_date=:date");
        $this->db->bind(':date', $date);
        $cTech=$this->db->single()->count;
        $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN delayed_alerts d ON a.alertId=d.alertId
            WHERE a.issuetype='Technical' AND d.delaydate=:date");
        $this->db->bind(':date', $date);
        $dTech=$this->db->single()->count;
        $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN rescheduled_alerts r ON a.alertId=r.alertId
            WHERE a.issuetype='Technical' AND r.olddate=:date");
        $this->db->bind(':date', $date);
        $rTech=$this->db->single()->count;
        $issueCounts['technical']=$cTech+$dTech+$rTech;

        $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN cancelled_alerts c ON a.alertId=c.alertId
            WHERE a.issuetype='Rail Road' AND c.cancellation_date=:date");
        $this->db->bind(':date', $date);
        $cRRoad=$this->db->single()->count;
        $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN delayed_alerts d ON a.alertId=d.alertId
            WHERE a.issuetype='Rail Road' AND d.delaydate=:date");
        $this->db->bind(':date', $date);
        $dRRoad=$this->db->single()->count;
        $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN rescheduled_alerts r ON a.alertId=r.alertId
            WHERE a.issuetype='Rail Road' AND r.olddate=:date");
        $this->db->bind(':date', $date);
        $rRRoad=$this->db->single()->count;
        $issueCounts['railroad']=$cRRoad+$dRRoad+$rRRoad;

        $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN cancelled_alerts c ON a.alertId=c.alertId
            WHERE a.issuetype='Unspecified' AND c.cancellation_date=:date");
        $this->db->bind(':date', $date);
        $cUnspec=$this->db->single()->count;
        $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN delayed_alerts d ON a.alertId=d.alertId
            WHERE a.issuetype='Unspecified' AND d.delaydate=:date");
        $this->db->bind(':date', $date);
        $dUnspec=$this->db->single()->count;
        $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN rescheduled_alerts r ON a.alertId=r.alertId
            WHERE a.issuetype='Unspecified' AND r.olddate=:date");
        $this->db->bind(':date', $date);
        $rUnspec=$this->db->single()->count;
        $issueCounts['unspecified']=$cUnspec+$dUnspec+$rUnspec;


        $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN cancelled_alerts c ON a.alertId=c.alertId
            WHERE a.issuetype='Other' AND c.cancellation_date=:date");
        $this->db->bind(':date', $date);
        $cOther=$this->db->single()->count;
        $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN delayed_alerts d ON a.alertId=d.alertId
            WHERE a.issuetype='Other' AND d.delaydate=:date");
        $this->db->bind(':date', $date);
        $dOther=$this->db->single()->count;
        $this->db->query("SELECT COUNT(*) AS count FROM alerts a INNER JOIN rescheduled_alerts r ON a.alertId=r.alertId
            WHERE a.issuetype='Other' AND r.olddate=:date");
        $this->db->bind(':date', $date);
        $rOther=$this->db->single()->count;
        $issueCounts['other']=$cOther+$rOther+$dOther;

        return $issueCounts;

    }




    }
