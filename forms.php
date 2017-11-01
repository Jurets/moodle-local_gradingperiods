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

require_once($CFG->libdir . '/formslib.php');
//require_once($CFG->dirroot . '/course/publish/lib.php');
//require_once($CFG->dirroot . '/' . $CFG->admin . '/registration/lib.php');

class gradingperiods_form extends moodleform
{
    public function definition()
    {
        $mform = $this->_form;

        $mform->addElement('header', 'newscontent', get_string('updateperiod', 'local_gradingperiods'));

        $mform->addElement('hidden', 'id', $this->_customdata['id']);
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden', 'periodid', $this->_customdata['id']);
        $mform->setType('periodid', PARAM_INT);

        //$mform->addElement('hidden', 'cohort', $this->_customdata['name']);
        //$mform->setType('cohort', PARAM_INT);

        //$mform->addElement('static', 'cohortname', get_string('cohortname', 'block_cohortnews'), $this->_customdata['cohortname']);

        $mform->addElement('text', 'name', get_string('periodname', 'local_gradingperiods'), ['size'=>255]);
        $mform->setType('name', PARAM_TEXT);
        $mform->setDefault('name', $this->_customdata['name']);

        $mform->addElement('date_selector', 'startdate', get_string('startdate', 'local_gradingperiods'));
        $mform->setDefault('startdate', $this->_customdata['startdate']);

        $mform->addElement('date_selector', 'enddate', get_string('enddate', 'local_gradingperiods'));
        $mform->setDefault('enddate', $this->_customdata['enddate']);


        //$editor = $mform->addElement('editor', 'newstext', get_string('newstext', 'block_cohortnews'));
        //$mform->setType('newstext', PARAM_RAW);
        //$editor->setValue(['text'=>$this->_customdata['newstext']]);

        $this->add_action_buttons();
    }
}