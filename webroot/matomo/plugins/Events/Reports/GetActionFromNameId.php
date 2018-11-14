<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\Events\Reports;

use Piwik\Piwik;
use Piwik\Plugins\Events\Columns\EventAction;

/**
 * Report metadata class for the Events.getActionFromNameId class.
 */
class GetActionFromNameId extends Base
{
    protected function init()
    {
        parent::init();

        $this->dimension     = new EventAction();
        $this->name          = Piwik::translate('Events_EventActions');
        $this->isSubtableReport = true;
    }
}