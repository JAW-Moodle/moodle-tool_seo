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
 * Main library file for interfaces.
 *
 * @package    tool_seo
 * @copyright  2019 Andrew Madden <andrewmadden@catalyst-au.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_seo;

use core\hook\after_config;

/**
 * Hook callbacks
 *
 * @package    tool_seo
 * @author     Jakob Heinemann <jakob@jakobheinemann.de>
 */
class hook_callbacks {
    /**
     * Listener for the after_config hook.
     *
     * overwrites page object!
     * @param after_config $hook
     */
    public static function after_config(\core\hook\after_config $hook): void {
        \tool_seo\robots::serve();
    }
}