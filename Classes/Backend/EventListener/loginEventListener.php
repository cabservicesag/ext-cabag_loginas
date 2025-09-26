<?php

declare(strict_types=1);

namespace Cabag\CabagLoginas\Backend\EventListener;

use Psr\Log\LoggerInterface;
use TYPO3\CMS\Backend\RecordList\Event\ModifyRecordListHeaderColumnsEvent;
use TYPO3\CMS\Backend\RecordList\Event\ModifyRecordListRecordActionsEvent;
use TYPO3\CMS\Backend\RecordList\Event\ModifyRecordListTableActionsEvent;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Cabag\CabagLoginas\Hook\ToolbarItemHook;


final class loginEventListener
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    /**
     * @var $loginAsObj ToolbarItemHook
     */
    public $loginAsObj = NULL;

    public function getLoginAsObject()
    {
        if ($this->loginAsObj === null) {
            $this->loginAsObj = GeneralUtility::makeInstance(ToolbarItemHook::class);
        }
        return $this->loginAsObj;
    }
    public function modifyRecordActions(ModifyRecordListRecordActionsEvent $event): void
    {

        $table=$event->getTable();
        if ($table === 'fe_users') {
            $row=$event->getRecord();
            // view is not used for fe_users, therefore we use it here
            $newAction= $this->getLoginAsObject()->getLoginAsIconInTable($row);
            $event->setAction($newAction);
        }

    }

}