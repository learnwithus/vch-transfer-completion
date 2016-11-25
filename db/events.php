<?php

$observers = array(
    array(
        'eventname'   => '\core\event\course_completed',
        'callback'    => 'TrackCompletion::TrackCourseCompletion',
        'includefile' => '/local/completiontracking/classes/TrackCompletion.php'
    ),
);

?>
