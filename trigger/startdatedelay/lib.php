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
 * Interface for the subplugintype trigger
 * It has to be implemented by all subplugins.
 *
 * @package local_course_deprovision_trigger
 * @subpackage startdatedelay
 * @copyright  2017 Tobias Reischmann WWU
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace local_course_deprovision\trigger;

use local_course_deprovision\TriggerResponse;

defined('MOODLE_INTERNAL') || die();
require_once(__DIR__.'/../lib.php');
require_once(__DIR__.'/../../classes/triggerresponse.php');

/**
 * Class which implements the basic methods necessary for a course deprovision trigger subplugin
 * @package local_course_deprovision\trigger
 */
class startdatedelay_trigger implements base {


    /**
     * Checks the course and returns a repsonse, which tells if the course should be further processed.
     * @param $course object to be processed.
     * @return TriggerResponse
     */
    public function check_course($course) {
        global $CFG;
        $delay = $CFG->coursedeprovisiontrigger_startdatedelay_delay;
        $now = time();
        if ($course->startdate + $delay < $now) {
            return TriggerResponse::trigger();
        }
        return TriggerResponse::next();
    }

}