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
 * Upgrade script for the SEO admin tool.
 *
 * @package    tool_seo
 * @author     Andrew Madden <andrewmadden@catalyst-au.net>
 * @copyright  2019 Catalyst IT
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Upgrade
 *
 * @param int $oldversion old version
 */
function xmldb_tool_seo_upgrade($oldversion) {

    if ($oldversion < 2019071000) {
        // Replace comma separated nonindexable setting value with trimmed newline separated values.
        $nonindexableurlstring = get_config('tool_seo', 'nonindexable');
        $updatedstring = implode(PHP_EOL, array_map('trim', explode(',', $nonindexableurlstring)));
        set_config('nonindexable', $updatedstring, 'tool_seo');

        // SEO savepoint reached.
        upgrade_plugin_savepoint(true, 2019071000, 'tool', 'seo');
    }

    return true;
}
