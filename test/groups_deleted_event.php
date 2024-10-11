<?php

/**
 * Example URL : /local/obu_metalinking_events/test/groups_created_event.php?courseid=3
 */
require('../../../config.php');

global $CFG;

if(!is_siteadmin()) {
    return;
}

$courseid = required_param('courseid', PARAM_INT);

$event = \obu_metalinking_events\event\metalinking_groups_deleted::create(
    array(
        'context' => $context,
        'objectid' => YYY,
        'other' => ZZZ));

$event->trigger();