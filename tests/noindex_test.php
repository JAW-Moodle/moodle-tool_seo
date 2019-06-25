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
 * Test case for the noindex tool.
 *
 * @package    tool_seo
 * @author     Andrew Madden <andrewmadden@catalyst-au.net>
 * @copyright  2019 Catalyst IT
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/../locallib.php');

/**
 * Test case class for the noindex tool.
 *
 * @package    tool_seo
 * @author     Andrew Madden <andrewmadden@catalyst-au.net>
 * @copyright  2019 Catalyst IT
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tool_seo_noindex_testcase extends advanced_testcase {

    protected function setUp() {
        parent::setUp();
        // Set up non-indexable array in config.
        global $CFG;
        $CFG->forced_plugin_settings['tool_seo']['nonindexable'] = "
                /login/index.php,
                /course/view.php,
                user,
                test.php,
                ";
    }

    /**
     * Test non-indexable URLs have been added to the admin tool setting.
     *
     * @dataProvider get_noindex_url_testcases
     * @param string A URL path representing a moodle page url.
     * @param bool True if the URL should be indexable.
     */
    public function test_nonindexable_url_is_configured($url, $expected) {
        $this->resetAfterTest(true);

        $result = tool_seo_is_url_indexable($url);

        $this->assertEquals($expected, $result);
    }

    /**
     * Provider for Moodle page URL paths. Expected true if the URL should be indexable.
     *
     * @return array
     */
    public function get_noindex_url_testcases() {
        return [
            // Exact matches.
            'Login URL' => ['/login/index.php', false],
            'Course URL' => ['/course/view.php', false],
            'Fake URL' => ['/fake/view.php', true],
            'Test URL' => ['/test/view.php', true],
            'Root URL' => ['/', true],

            // Partial matches.
            'User URL' => ['/user/view.php', false],
            'A PHP page type' => ['/login/test.php', false],
        ];
    }
}
