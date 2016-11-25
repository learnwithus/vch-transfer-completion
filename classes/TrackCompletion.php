<?php

defined('MOODLE_INTERNAL') || die();

class TrackCompletion {
    public static function TrackCourseCompletion($event) {
        global $DB;
        $hash = get_config('local_completiontracking', 'hash');

        $eventdata = $event->get_data();
        $user = $DB->get_record('user', array('id'=>$eventdata['other']['relateduserid']))->idnumber;
        $course = $DB->get_record('course', array('id'=>$eventdata['contextinstanceid']))->idnumber;

        $data = $user . "," . $course;
        $encrypted_data = openssl_encrypt($data, 'aes-256-ctr', $hash);
        
        $data = array('data' => $encrypted_data);
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents('https://vchlearn.ca/learninghub/course_completion.php', false, $context);
        if ($result === false) {
            echo var_dump($result);
        }

    }
}

