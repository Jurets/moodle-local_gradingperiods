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

class local_gradingperiods_renderer extends plugin_renderer_base
{
    /**
     * Output News index (table)
     *
     * @param $periods
     * @return mixed
     */
    public function output_index($periods)
    {
        $output = '';

        $table = new html_table();
        $table->id = 'period-index';
        //$table->attributes['class'] = 'admintable generaltable';
        $table->head = [
            get_string('periodname', 'local_gradingperiods'),
            get_string('startdate', 'local_gradingperiods'),
            get_string('enddate', 'local_gradingperiods'),
        ];
        $table->head[] = get_string('action');

        foreach($periods as $period) {
            $update_url = new moodle_url('edit.php', ['periodid'=>$period->id]);
            $delete_url = new moodle_url('edit.php', ['periodid'=>$period->id, 'action'=>'delete']);
            $line = [
                $period->name,
                userdate($period->startdate),
                userdate($period->enddate),
            ];
            $line[] =
                html_writer::link($update_url, self::icon('pencil', ['title'=>get_string('edit')])) . '&nbsp' .
                html_writer::link($delete_url, self::icon('remove', ['title'=>get_string('remove')]));

            $table->data[] = new html_table_row($line);
        }
        $output .= html_writer::table($table);

        return $output;
    }

    public static function icon($name, $attributes = [])
    {
        $attributes = array_merge([
            'class' => 'icon fa fa-fw fa-' . $name,
            'aria-hidden' => 'true',
        ], $attributes);
        return html_writer::tag('i', null, $attributes);
    }

    public function output_btnadd() {
        $label = get_string('addperiod', 'local_gradingperiods');
        $url = new moodle_url('edit.php');
        return html_writer::div(
            html_writer::link($url, $label, ['class'=>'btn btn-primary'])
        , 'pull-right');
    }
}