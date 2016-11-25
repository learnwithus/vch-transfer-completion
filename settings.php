<?php
defined('MOODLE_INTERNAL') || die();
if ($hassiteconfig) {
    $settings = new admin_settingpage('local_completiontracking', 'Learninghub Completion Tracking');     
    $ADMIN->add('localplugins', $settings);
    $settings->add(new admin_setting_configtext('local_completiontracking/hash',
        'Hash', '', '', PARAM_TEXT));
}
