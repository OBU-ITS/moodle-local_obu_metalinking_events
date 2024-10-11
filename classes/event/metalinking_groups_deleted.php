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

namespace local_obu_metalinking_events\event;

defined('MOODLE_INTERNAL') || die();

/**
 * metalinking_groups_deleted file description here.
 *
 * @package    local_obu_metalinking_events
 * @copyright  2024 Joe Souch
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class metalinking_groups_deleted extends \core\event\base
{
    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'd';
        $this->data['edulevel'] = self::LEVEL_TEACHING;
        $this->data['objecttable'] = 'groups';
    }

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "System groups from course with id '{$this->other['childid']}' have been deleted in course with id '{$this->other['parentid']}'";
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventmetalinkinggroupsdeleted', 'local_obu_metalinking_events');
    }

    /**
     * Get URL related to the action
     *
     * @return \moodle_url
     */
    public function get_url() {
        return new \moodle_url('/course/view.php', array('id' => $this->courseid));
    }

    /**
     * Create instance of event.
     *
     * @return metalinking_groups_deleted
     */
    public static function create_from_metalinked_courses($childid, $parentid) {
        $data = array(
            'courseid' => $parentid,
            'context' => \context_course::instance($parentid),
            'other' => array(
                'childid' => $childid,
                'parentid' => $parentid)
        );

        $event = self::create($data);

        return $event;
    }

    public static function get_other_mapping() {
        // Nothing to map.
        return false;
    }
}
