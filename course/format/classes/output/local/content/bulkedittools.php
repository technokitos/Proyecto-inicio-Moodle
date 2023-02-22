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

namespace core_courseformat\output\local\content;

use core\output\named_templatable;
use core_courseformat\base as course_format;
use core_courseformat\output\local\courseformat_named_templatable;
use renderable;
use stdClass;

/**
 * Contains the bulk editor tools bar.
 *
 * @package   core_courseformat
 * @copyright 2023 Ferran Recio <ferran@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class bulkedittools implements named_templatable, renderable {
    use courseformat_named_templatable;

    /** @var core_courseformat\base the course format class */
    protected $format;

    /**
     * Constructor.
     *
     * @param course_format $format the course format
     */
    public function __construct(course_format $format) {
        $this->format = $format;
    }

    /**
     * Export this data so it can be used as the context for a mustache template (core/inplace_editable).
     *
     * @param renderer_base $output typically, the renderer that's calling this function
     * @return stdClass data context for a mustache template
     */
    public function export_for_template(\renderer_base $output): stdClass {
        $format = $this->format;
        $course = $format->get_course();

        $data = (object)[
            'id' => $course->id,
            'actions' => $this->get_toolbar_actions(),
        ];
        $data->hasactions = !empty($data->actions);
        return $data;
    }

    /**
     * Get the toolbar actions.
     * @return array the array of buttons
     */
    protected function get_toolbar_actions(): array {
        return array_merge(
            array_values($this->section_control_items()),
            array_values($this->cm_control_items()),
        );
    }

    /**
     * Generate the bulk edit control items of a course module.
     *
     * Format plugins can override the method to add or remove elements
     * from the toolbar.
     *
     * @return array of edit control items
     */
    protected function cm_control_items(): array {
        $controls = [];
        return $controls;
    }

    /**
     * Generate the bulk edit control items of a section.
     *
     * Format plugins can override the method to add or remove elements
     * from the toolbar.
     *
     * @return array of edit control items
     */
    protected function section_control_items(): array {
        $controls = [];
        return $controls;
    }
}
