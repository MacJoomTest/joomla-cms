<?php

/**
 * Joomla! Content Management System
 *
 * @copyright  (C) 2016 Open Source Matters, Inc. <https://www.joomla.org>
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\CMS\Event\Table;

use Joomla\Database\DatabaseQuery;

// phpcs:disable PSR1.Files.SideEffects
\defined('JPATH_PLATFORM') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Event class for JTable's onBeforeMove event
 *
 * @since  4.0.0
 */
class BeforeMoveEvent extends AbstractEvent
{
    /**
     * Constructor.
     *
     * Mandatory arguments:
     * subject      JTableInterface The table we are operating on
     * query        DatabaseQuery   The query to get the primary keys and ordering values for the selection.
     * delta        int             The direction and magnitude to move the row in the ordering sequence.
     * where        string          WHERE clause to use for limiting the selection of rows to compact the ordering values.
     *
     * @param   string  $name       The event name.
     * @param   array   $arguments  The event arguments.
     *
     * @throws  \BadMethodCallException
     */
    public function __construct($name, array $arguments = [])
    {
        if (!\array_key_exists('query', $arguments)) {
            throw new \BadMethodCallException("Argument 'query' is required for event $name");
        }

        if (!\array_key_exists('delta', $arguments)) {
            throw new \BadMethodCallException("Argument 'delta' is required for event $name");
        }

        if (!\array_key_exists('where', $arguments)) {
            throw new \BadMethodCallException("Argument 'where' is required for event $name");
        }

        parent::__construct($name, $arguments);
    }

    /**
     * Setter for the query argument
     *
     * @param   DatabaseQuery  $value  The value to set
     *
     * @return  mixed
     *
     * @throws  \BadMethodCallException  if the argument is not of the expected type
     */
    protected function setQuery($value)
    {
        if (!($value instanceof DatabaseQuery)) {
            throw new \BadMethodCallException("Argument 'query' of event {$this->name} must be of DatabaseQuery type");
        }

        return $value;
    }

    /**
     * Setter for the delta argument
     *
     * @param   int  $value  The value to set
     *
     * @return  integer
     *
     * @throws  \BadMethodCallException  if the argument is not of the expected type
     */
    protected function setDelta($value)
    {
        if (!is_numeric($value)) {
            throw new \BadMethodCallException("Argument 'delta' of event {$this->name} must be an integer");
        }

        return (int) $value;
    }

    /**
     * Setter for the where argument
     *
     * @param   string|null  $value  The value to set
     *
     * @return  mixed
     *
     * @throws  \BadMethodCallException  if the argument is not of the expected type
     */
    protected function setWhere($value)
    {
        if (!empty($value) && !\is_string($value)) {
            throw new \BadMethodCallException("Argument 'where' of event {$this->name} must be empty or string");
        }

        return $value;
    }
}
