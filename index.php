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
require('locallib.php');

require_login();

$str_title = get_string('pluginname', 'local_gradingperiods');
$context = context_system::instance();

$url = new moodle_url($CFG->wwwroot . '/local/gradingperiods/index.php');

$PAGE->set_context($context);
$PAGE->set_url($url);
$PAGE->set_pagelayout('frontpage');
$PAGE->set_title($str_title);
$PAGE->navbar->add($str_title);

echo $OUTPUT->header();
echo $OUTPUT->heading($PAGE->title, 2);

global $DB;

$periods = \local_gradingperiods\period::all();

$renderer = $PAGE->get_renderer('local_gradingperiods');
echo $renderer->output_btnadd();
echo $renderer->output_index($periods);

echo $OUTPUT->footer();

