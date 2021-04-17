<?php

//  define('SHOW_VARIABLES', 1);
//  define('DEBUG_LEVEL', 1);

//  error_reporting(E_ALL ^ E_NOTICE);
//  ini_set('display_errors', 'On');

set_include_path('.' . PATH_SEPARATOR . get_include_path());


include_once dirname(__FILE__) . '/' . 'components/utils/system_utils.php';
include_once dirname(__FILE__) . '/' . 'components/mail/mailer.php';
include_once dirname(__FILE__) . '/' . 'components/mail/phpmailer_based_mailer.php';
require_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';

//  SystemUtils::DisableMagicQuotesRuntime();

SystemUtils::SetTimeZoneIfNeed('Europe/Belgrade');

function GetGlobalConnectionOptions()
{
    return
        array(
          'server' => 'gm633363-001.dbaas.ovh.net',
          'port' => '35528',
          'username' => 'fixmyschool',
          'password' => 'Micka2019',
          'database' => 'fixmyschool',
          'client_encoding' => 'utf8'
        );
}

function HasAdminPage()
{
    return false;
}

function HasHomePage()
{
    return true;
}

function GetHomeURL()
{
    return 'index.php';
}

function GetHomePageBanner()
{
    return '';
}

function GetPageGroups()
{
    $result = array();
    $result[] = array('caption' => 'Demandes', 'description' => '');
    $result[] = array('caption' => 'Ecoles', 'description' => '');
    $result[] = array('caption' => 'Param Général', 'description' => '');
    $result[] = array('caption' => 'Param Notifications', 'description' => '');
    $result[] = array('caption' => 'Param Types Demande', 'description' => '');
    $result[] = array('caption' => 'Param Zones', 'description' => '');
    $result[] = array('caption' => 'Utilisateurs', 'description' => '');
    $result[] = array('caption' => 'Default', 'description' => '');
    return $result;
}

function GetPageInfos()
{
    $result = array();
    $result[] = array('caption' => 'Zoneadministrative', 'short_caption' => 'Zoneadministrative', 'filename' => 'zoneadministrative.php', 'name' => 'zoneadministrative', 'group_name' => 'Param Zones', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Zoneadministrative Fonction', 'short_caption' => 'Zone Administration - Fonction', 'filename' => 'zoneadministrative_fonction.php', 'name' => 'zoneadministrative_fonction', 'group_name' => 'Param Zones', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Utilisateur', 'short_caption' => 'Utilisateur', 'filename' => 'utilisateur.php', 'name' => 'utilisateur', 'group_name' => 'Utilisateurs', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Utilisateur Zoneadministrative Fonction', 'short_caption' => 'Utilisateur Zoneadministrative Fonction', 'filename' => 'utilisateur_zoneadministrative_fonction.php', 'name' => 'utilisateur_zoneadministrative_fonction', 'group_name' => 'Utilisateurs', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Utilisateur Badge', 'short_caption' => 'Utilisateur Badge', 'filename' => 'utilisateur_badge.php', 'name' => 'utilisateur_badge', 'group_name' => 'Utilisateurs', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Ecole', 'short_caption' => 'Ecole', 'filename' => 'ecole.php', 'name' => 'ecole', 'group_name' => 'Ecoles', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Ecoles <-> Rapports de commission de sécurité', 'short_caption' => 'Ecoles <-> Rapports de commission de sécurité', 'filename' => 'ecole01.php', 'name' => 'ecole01', 'group_name' => 'Ecoles', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Ecole Utilisateur', 'short_caption' => 'Ecole Utilisateur', 'filename' => 'ecole_utilisateur.php', 'name' => 'ecole_utilisateur', 'group_name' => 'Utilisateurs', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Fonction', 'short_caption' => 'Fonction', 'filename' => 'fonction.php', 'name' => 'fonction', 'group_name' => 'Param Général', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Avatar', 'short_caption' => 'Avatar', 'filename' => 'avatar.php', 'name' => 'avatar', 'group_name' => 'Utilisateurs', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Document', 'short_caption' => 'Document', 'filename' => 'Document.php', 'name' => 'Document', 'group_name' => 'Param Général', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Has Keyword', 'short_caption' => 'Has Keyword', 'filename' => 'HasKeyword.php', 'name' => 'HasKeyword', 'group_name' => 'Param Général', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Keyword', 'short_caption' => 'Keyword', 'filename' => 'Keyword.php', 'name' => 'Keyword', 'group_name' => 'Param Général', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Badge', 'short_caption' => 'Badge', 'filename' => 'badge.php', 'name' => 'badge', 'group_name' => 'Param Général', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Demande Historique', 'short_caption' => 'Demande Historique', 'filename' => 'demande_historique.php', 'name' => 'demande_historique', 'group_name' => 'Demandes', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Demandedocument', 'short_caption' => 'Demandedocument', 'filename' => 'demandedocument.php', 'name' => 'demandedocument', 'group_name' => 'Demandes', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Demandetype', 'short_caption' => 'Demandetype', 'filename' => 'demandetype.php', 'name' => 'demandetype', 'group_name' => 'Param Types Demande', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Demandegravite', 'short_caption' => 'Demandegravite', 'filename' => 'demandegravite.php', 'name' => 'demandegravite', 'group_name' => 'Param Types Demande', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Demandestatut', 'short_caption' => 'Demandestatut', 'filename' => 'demandestatut.php', 'name' => 'demandestatut', 'group_name' => 'Param Types Demande', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Demandetype Documentfusion', 'short_caption' => 'Demandetype Documentfusion', 'filename' => 'demandetype_documentfusion.php', 'name' => 'demandetype_documentfusion', 'group_name' => 'Param Types Demande', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Demandetype Demandegravite', 'short_caption' => 'Demandetype Demandegravite', 'filename' => 'demandetype_demandegravite.php', 'name' => 'demandetype_demandegravite', 'group_name' => 'Param Types Demande', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Demandetype Demandestatut', 'short_caption' => 'Demandetype Demandestatut', 'filename' => 'demandetype_demandestatut.php', 'name' => 'demandetype_demandestatut', 'group_name' => 'Param Types Demande', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Demandetype Documentfusion Demandetype', 'short_caption' => 'Demandetype Documentfusion Demandetype', 'filename' => 'demandetype_documentfusion_demandetype.php', 'name' => 'demandetype_documentfusion_demandetype', 'group_name' => 'Param Types Demande', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Demandetype Notification Auto Configuration', 'short_caption' => 'Demandetype Notification Auto Configuration', 'filename' => 'demandetype_notification_auto_configuration.php', 'name' => 'demandetype_notification_auto_configuration', 'group_name' => 'Param Notifications', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Demandetype Notification Auto', 'short_caption' => 'Demandetype Notification Auto', 'filename' => 'demandetype_notification_auto.php', 'name' => 'demandetype_notification_auto', 'group_name' => 'Param Types Demande', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Demandetype Notification Manuelle', 'short_caption' => 'Demandetype Notification Manuelle', 'filename' => 'demandetype_notification_manuelle.php', 'name' => 'demandetype_notification_manuelle', 'group_name' => 'Param Types Demande', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Demandetype Notification Manuelle Configuration', 'short_caption' => 'Demandetype Notification Manuelle Configuration', 'filename' => 'demandetype_notification_manuelle_configuration.php', 'name' => 'demandetype_notification_manuelle_configuration', 'group_name' => 'Param Notifications', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Domaineofficiel', 'short_caption' => 'Domaineofficiel', 'filename' => 'domaineofficiel.php', 'name' => 'domaineofficiel', 'group_name' => 'Utilisateurs', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Informationdynamique', 'short_caption' => 'Informationdynamique', 'filename' => 'informationdynamique.php', 'name' => 'informationdynamique', 'group_name' => 'Ecoles', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Informationdynamique Historique', 'short_caption' => 'Informationdynamique Historique', 'filename' => 'informationdynamique_historique.php', 'name' => 'informationdynamique_historique', 'group_name' => 'Ecoles', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Log', 'short_caption' => 'Log', 'filename' => 'log.php', 'name' => 'log', 'group_name' => 'Param Général', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Millesime', 'short_caption' => 'Millesime', 'filename' => 'millesime.php', 'name' => 'millesime', 'group_name' => 'Param Général', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Demande Amelioration', 'short_caption' => 'Demande Amelioration', 'filename' => 'demande_amelioration.php', 'name' => 'demande_amelioration', 'group_name' => 'Demandes', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Demande Intervention', 'short_caption' => 'Demande Intervention', 'filename' => 'demande_intervention.php', 'name' => 'demande_intervention', 'group_name' => 'Demandes', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Demande Sst', 'short_caption' => 'Demande Sst', 'filename' => 'demande_sst.php', 'name' => 'demande_sst', 'group_name' => 'Demandes', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Zoneadministrative Has Ecole', 'short_caption' => 'Zoneadministrative Has Ecole', 'filename' => 'zoneadministrative_has_ecole.php', 'name' => 'zoneadministrative_has_ecole', 'group_name' => 'Param Zones', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Opendata Annuaire Education', 'short_caption' => 'Opendata Annuaire Education', 'filename' => 'opendata_annuaire_education.php', 'name' => 'opendata_annuaire_education', 'group_name' => 'Default', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Demande Amelioration Photo', 'short_caption' => 'Demande Amelioration Photo', 'filename' => 'demande_amelioration_photo.php', 'name' => 'demande_amelioration_photo', 'group_name' => 'Default', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Demande Amelioration Document', 'short_caption' => 'Demande Amelioration Document', 'filename' => 'demande_amelioration_document.php', 'name' => 'demande_amelioration_document', 'group_name' => 'Default', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Rapports des commissions de sécurité incendie', 'short_caption' => 'Rapports des commissions de sécurité incendie', 'filename' => 'doccsi.php', 'name' => 'doccsi', 'group_name' => 'Ecoles', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Liste des travaux', 'short_caption' => 'Liste des travaux', 'filename' => 'doccsi_travaux.php', 'name' => 'doccsi_travaux', 'group_name' => 'Default', 'add_separator' => false, 'description' => '');
    $result[] = array('caption' => 'Nos écoles', 'short_caption' => 'Nos écoles', 'filename' => 'nos_ecoles.php', 'name' => 'v_ecoles', 'group_name' => 'Ecoles', 'add_separator' => false, 'description' => '');
    return $result;
}

function GetPagesHeader()
{
    return
        'Une inititiative DataForGood, Le Donut et CeM';
}

function GetPagesFooter()
{
    return
        '';
}

function ApplyCommonPageSettings(Page $page, Grid $grid)
{
    $page->SetShowUserAuthBar(true);
    $page->setShowNavigation(true);
    $page->OnGetCustomExportOptions->AddListener('Global_OnGetCustomExportOptions');
    $page->getDataset()->OnGetFieldValue->AddListener('Global_OnGetFieldValue');
    $page->getDataset()->OnGetFieldValue->AddListener('OnGetFieldValue', $page);
    $grid->BeforeUpdateRecord->AddListener('Global_BeforeUpdateHandler');
    $grid->BeforeDeleteRecord->AddListener('Global_BeforeDeleteHandler');
    $grid->BeforeInsertRecord->AddListener('Global_BeforeInsertHandler');
    $grid->AfterUpdateRecord->AddListener('Global_AfterUpdateHandler');
    $grid->AfterDeleteRecord->AddListener('Global_AfterDeleteHandler');
    $grid->AfterInsertRecord->AddListener('Global_AfterInsertHandler');
}

function GetAnsiEncoding() { return 'windows-1252'; }

function Global_AddEnvironmentVariablesHandler(&$variables)
{

}

function Global_CustomHTMLHeaderHandler($page, &$customHtmlHeaderText)
{

}

function Global_GetCustomTemplateHandler($type, $part, $mode, &$result, &$params, CommonPage $page = null)
{

}

function Global_OnGetCustomExportOptions($page, $exportType, $rowData, &$options)
{

}

function Global_OnGetFieldValue($fieldName, &$value, $tableName)
{

}

function Global_GetCustomPageList(CommonPage $page, PageList $pageList)
{

}

function Global_BeforeInsertHandler($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
{

}

function Global_BeforeUpdateHandler($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
{

}

function Global_BeforeDeleteHandler($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
{

}

function Global_AfterInsertHandler($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
{

}

function Global_AfterUpdateHandler($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
{

}

function Global_AfterDeleteHandler($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
{

}

function GetDefaultDateFormat()
{
    return 'Y-m-d';
}

function GetFirstDayOfWeek()
{
    return 0;
}

function GetPageListType()
{
    return PageList::TYPE_SIDEBAR;
}

function GetNullLabel()
{
    return null;
}

function UseMinifiedJS()
{
    return true;
}

function GetOfflineMode()
{
    return false;
}

function GetInactivityTimeout()
{
    return 0;
}

function GetMailer()
{
    $mailerOptions = new MailerOptions(MailerType::Sendmail, '', '');
    
    return PHPMailerBasedMailer::getInstance($mailerOptions);
}

function sendMailMessage($recipients, $messageSubject, $messageBody, $attachments = '', $cc = '', $bcc = '')
{
    GetMailer()->send($recipients, $messageSubject, $messageBody, $attachments, $cc, $bcc);
}

function createConnection()
{
    $connectionOptions = GetGlobalConnectionOptions();
    $connectionOptions['client_encoding'] = 'utf8';

    $connectionFactory = MySqlIConnectionFactory::getInstance();
    return $connectionFactory->CreateConnection($connectionOptions);
}

/**
 * @param string $pageName
 * @return IPermissionSet
 */
function GetCurrentUserPermissionsForPage($pageName) 
{
    return GetApplication()->GetCurrentUserPermissionSet($pageName);
}
