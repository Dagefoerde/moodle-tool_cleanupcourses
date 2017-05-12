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

namespace tool_cleanupcourses\trigger;

use tool_cleanupcourses\trigger_respone;

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/../lib.php');

/**
 * Trigger test for course site trigger.
 *
 * @package    tool_cleanupcourses_trigger
 * @category   startdatedelay
 * @group tool_cleanupcourses_trigger
 * @copyright  2017 Tobias Reischmann WWU
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tool_cleanupcourses_trigger_sitecourse_testcase extends \advanced_testcase {

    /**
     * Tests if the site course is excluded by this plugin.
     */
    public function test_sitecourse_course() {

        $this->resetAfterTest();
        $this->setAdminUser();

        $course = get_site();

        $trigger = new sitecourse();
        $response = $trigger->check_course($course);
        $this->assertEquals($response, trigger_respone::exclude());

    }

    /**
     * Tests if courses, which are older than the default of 190 days are triggered by this plugin.
     */
    public function test_normal_course() {

        $this->resetAfterTest();
        $this->setAdminUser();

        $course = $this->getDataGenerator()->create_course();

        $trigger = new sitecourse();
        $response = $trigger->check_course($course);
        $this->assertEquals($response, trigger_respone::next());

    }
}