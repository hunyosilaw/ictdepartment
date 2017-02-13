<?php 

    function _ec ($var) {
        echo ($var != null) ? $var : '';
    }

    function _ar ($army_time) {
        $regular_time = date( 'g:i A', strtotime( $army_time ) );
        return ($army_time == '') ? '':$regular_time;
    }

    function _print_optgrp ($arr) {
    	foreach ($arr as $key => $value) {
    		echo '<optgroup label="'.$key.'">';
			foreach ($value as $key => $value) {
	    		echo '<option value="'.base64_encode($key).'">'.$value.'</option>';
	    	}
    		echo '</optgroup>';
    	}
    }

    function _print_opt ($arr) {
    	foreach ($arr as $key => $value) {
    		echo '<option value="'.base64_encode($key).'">'.$value.'</option>';
    	}
    }

    function _format_time ($time, $format = 'h:i A') {
        $t = new DateTime($time);
        return $t->format($format);
    }

    function _format_task_done ($task) {
        $acc_assisted = array ('Others');
        for ($i=0;$i<count($task);$i++) {
            if (!in_array($task[$i]['accName'], $acc_assisted)) {
                if ($task[$i]['accName'] != '')
                    array_push($acc_assisted, $task[$i]['accName']);
            }
        }
        $eod_task_done = array ();
        foreach ($acc_assisted as $akey => $aval) {
            $eod_task_done[$aval] = array ();
        }
        foreach ($task as $tkey => $tval) {
            if (in_array($tval['accName'], $acc_assisted) || $tval['accName'] == '') {
                $key = ($tval['accName'] == '') ? 'Others' : $tval['accName'];
                array_push($eod_task_done[$key], $tval);
            } 
        }
        return $eod_task_done;
    }