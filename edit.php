<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Plugin version and other meta-data are defined here.
 *
 * @package     local_gradingperiods
 * @copyright   2017 Smart Academy <smart@example.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../config.php');

require_once($CFG->dirroot . '/local/gradingperiods/locallib.php');
require_once($CFG->dirroot . '/local/gradingperiods/forms.php');

require_login();

$periodid = optional_param('periodid', false, PARAM_INT);
$action = optional_param('action', false, PARAM_ALPHA);

$context = context_system::instance();
$str_title = get_string('addperiod', 'local_gradingperiods');
$url = new moodle_url($CFG->wwwroot . '/local/gradingperiods/edit.php');
$return_url = new moodle_url($CFG->wwwroot . '/local/gradingperiods/index.php');

$PAGE->set_context($context);
$PAGE->set_heading($SITE->fullname);
$PAGE->set_pagelayout('frontpage');
$PAGE->set_title($str_title);
$PAGE->navbar->add($str_title);

$PAGE->set_url($url);

if ($periodid) {
    $period = \local_gradingperiods\period::load($periodid);
    if ($action == 'delete') {
        \local_gradingperiods\period::delete($period->id);
        redirect($return_url, get_string('successdeleted', 'local_gradingperiods'));
    }
} else {
    $period = new \stdClass();
    $period->id = '';
    $period->periodid = '';
    $period->name = '';
    $period->startdate = '';
    $period->enddate = '';
}

$formdata = (array)$period;
$mform = new gradingperiods_form('', $formdata);
if ($data = $mform->get_data()) {
    $result = \local_gradingperiods\period::save($data);
    if ($result) {
        redirect($return_url, get_string('successcreated', 'local_gradingperiods'));
    } else {
        $notificationerror = 'Error during period creation';
    }
}

echo $OUTPUT->header();
echo $OUTPUT->heading($PAGE->title, 2);

if (!empty($notificationerror)) {
    echo $OUTPUT->notification($notificationerror);
} else {
    $mform->display();
}

echo $OUTPUT->footer();

