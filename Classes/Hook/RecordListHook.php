<?php

namespace Cabag\CabagLoginas\Hook;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Recordlist\RecordList\RecordListHookInterface;
use Cabag\CabagLoginas\Hook\ToolbarItemHook;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
class RecordListHook implements RecordListHookInterface
{

    /**
     * @var $loginAsObj ToolbarItemHook
     */
    public $loginAsObj = NULL;

    public function getLoginasObject()
    {
        if ($this->loginAsObj === null) {
            $this->loginAsObj = GeneralUtility::makeInstance(ToolbarItemHook::class);
        }
        return $this->loginAsObj;
    }

    public function makeClip($table, $row, $cells, &$parentObject)
    {
        return $cells;
    }

    public function makeControl($table, $row, $cells, &$parentObject)
    {
        if ($table === 'fe_users') {
            $cells['moveRight'] = $this->getLoginAsObject()->getLoginAsIconInTable($row);
            // moveRight is only used for pages, therefore we use it here
        }

        return $cells;
    }

    public function renderListHeader($table, $currentIdList, $headerColumns, &$parentObject)
    {
        return $headerColumns;
    }

    public function renderListHeaderActions($table, $currentIdList, $cells, &$parentObject)
    {
        return $cells;
    }
}

