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

namespace local_gradingperiods;

/**
 * @param $periodid
 * @return array
 */
class period {

    protected static $tablename = 'gradingperiods';

    public static function all()
    {
        global $DB;
        $period = $DB->get_records(static::$tablename, [], 'startdate', '*');
        return $period;
    }

    public static function load($periodid)
    {
        global $DB;
        $period = $DB->get_record(static::$tablename, ['id' => $periodid], '*', MUST_EXIST);
        return $period;
    }

    public static function save(\stdClass $data)
    {
        global $DB, $USER;

        $period = property_exists($data, 'id') ? $DB->get_record('gradingperiods', ['id'=>$data->id]) : null;
        if (!is_object($period)) {
            $data->userid = $USER->id;
            $data->timecreated = time();
            $result = $DB->insert_record(static::$tablename, $data);
        } else {
            $data->modified = time();
            $result = $DB->update_record(static::$tablename, $data);
        }
        return $result;
    }

    public static function delete($periodid)
    {
        global $DB;
        $count = $DB->delete_records(static::$tablename, ['id' => $periodid]);
        return $count;
    }


}