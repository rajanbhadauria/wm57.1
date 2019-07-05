<?php

namespace App\Model;
use DateTime;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $table = 'work';
    public static function dateDiffrence($date1,$date2){


        $date1 = new DateTime($date1);
        $date2 = new DateTime($date2);
        $interval = $date2->diff($date1);
        $date = "";
        if($interval->format('%y')>1)
            $date .= $interval->format('%y years');
        else
            $date .= $interval->format('%y year');

        if($interval->format('%m')>1)
            $date .= $interval->format(', %m months');
        else
            $date .= $interval->format(', %m month');

        return $date;
    }

    public static function  getUserWorkExp($user_id) {
        $data['workInfo']  = self::where("user_id","=", $user_id)->where("private", '0')->orderBy('workStartDate', 'desc')->orderBy('employementType', 'asc')->get();
        if(count($data['workInfo'])>0) {
            if($data['workInfo'][0]->workEndDate!='0000-00-00 00:00:00'){
                $data['workEnding'] = $data['workInfo'][0]->workEndDate;
            }else{
                $data['workEnding'] = date('Y-m-d H:i:s');
            }
            $ending = array();
            $current = 0;
            $start = array();
            foreach ($data['workInfo'] as $key => $work) {
                if($work->workEndDate!='0000-00-00 00:00:00'){
                    $data['workInfo'][$key]['duration'] = self::dateDiffrence($work->workStartDate,$work->workEndDate);
                }else{
                    $data['workInfo'][$key]['duration'] = self::dateDiffrence($work->workStartDate,date('Y-m-d H:i:s'));
                }
                $data['workStarting'] = $work->workStartDate;
                $start[$key] = $work->workStartDate;
                $ending[$key] = $work->workEndDate;
                if($work->employementStatus == "1") {
                    $current++;
                }

            }

            usort($start, 'dateSort');
            usort($ending, 'dateSort');
            $data['workStarting']  = $start[0];
            if($current) {
                $data['workEnding'] = date('Y-m-d H:i:s');
            } else {
                $data['workEnding'] =  $ending[count($ending)-1];
            }
            return  self::dateDiffrence($data['workStarting'],$data['workEnding']);
        } else {
            return 'Fresher';
        }
    }
}
