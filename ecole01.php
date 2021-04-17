<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php 
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */

    include_once dirname(__FILE__) . '/components/startup.php';
    include_once dirname(__FILE__) . '/components/application.php';
    include_once dirname(__FILE__) . '/' . 'authorization.php';


    include_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page/page_includes.php';

    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'utf8';
        GetApplication()->GetUserAuthentication()->applyIdentityToConnectionOptions($result);
        return $result;
    }

    
    
    class ecole01_doccsi_idNestedPage extends NestedFormPage
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`doccsi`');
            $this->dataset->addFields(
                array(
                    new IntegerField('doccsi_id', true, true, true),
                    new StringField('doccsi_fichier'),
                    new DateField('doccsi_datetime'),
                    new StringField('doccsi_categorie'),
                    new StringField('doccsi_avis'),
                    new IntegerField('doccsi_public'),
                    new IntegerField('doccsi_personnel'),
                    new StringField('doccsi_notes'),
                    new StringField('doccsi_notes_collectivite'),
                    new StringField('doccsi_notes_directeur')
                )
            );
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for doccsi_fichier field
            //
            $editor = new TextAreaEdit('doccsi_fichier_edit', 50, 8);
            $editColumn = new CustomEditColumn('Doccsi Fichier', 'doccsi_fichier', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for doccsi_datetime field
            //
            $editor = new DateTimeEdit('doccsi_datetime_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Doccsi Datetime', 'doccsi_datetime', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for doccsi_categorie field
            //
            $editor = new ComboBox('doccsi_categorie_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('1', '1');
            $editor->addChoice('2', '2');
            $editor->addChoice('3', '3');
            $editor->addChoice('4', '4');
            $editor->addChoice('5', '5');
            $editColumn = new CustomEditColumn('Doccsi Categorie', 'doccsi_categorie', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for doccsi_avis field
            //
            $editor = new ComboBox('doccsi_avis_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('FAVORABLE', 'FAVORABLE');
            $editor->addChoice('DEFAVORABLE', 'DEFAVORABLE');
            $editColumn = new CustomEditColumn('Doccsi Avis', 'doccsi_avis', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for doccsi_notes field
            //
            $editor = new TextAreaEdit('doccsi_notes_edit', 50, 8);
            $editColumn = new CustomEditColumn('Doccsi Notes', 'doccsi_notes', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for doccsi_notes_collectivite field
            //
            $editor = new TextAreaEdit('doccsi_notes_collectivite_edit', 50, 8);
            $editColumn = new CustomEditColumn('Doccsi Notes Collectivite', 'doccsi_notes_collectivite', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for doccsi_notes_directeur field
            //
            $editor = new TextAreaEdit('doccsi_notes_directeur_edit', 50, 8);
            $editColumn = new CustomEditColumn('Doccsi Notes Directeur', 'doccsi_notes_directeur', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for doccsi_public field
            //
            $editor = new TextEdit('doccsi_public_edit');
            $editColumn = new CustomEditColumn('Doccsi Public', 'doccsi_public', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for doccsi_personnel field
            //
            $editor = new TextEdit('doccsi_personnel_edit');
            $editColumn = new CustomEditColumn('Doccsi Personnel', 'doccsi_personnel', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
    
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
            $column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
       static public function getNestedInsertHandlerName()
        {
            return get_class() . '_form_insert';
        }
    
        public function GetGridInsertHandler()
        {
            return self::getNestedInsertHandlerName();
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        public function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
    }
    
    // OnBeforePageExecute event handler
    
    
    
    class ecole01Page extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Ecoles <-> Rapports de commission de sécurité');
            $this->SetMenuLabel('Ecoles <-> Rapports de commission de sécurité');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ecole`');
            $this->dataset->addFields(
                array(
                    new IntegerField('ecole_id', true, true, true),
                    new StringField('ecole_RNE'),
                    new StringField('ecole_lat'),
                    new StringField('ecole_long'),
                    new StringField('ecole_latlong'),
                    new StringField('ecole_coord'),
                    new StringField('ecole_appellation'),
                    new StringField('ecole_denominationprincipale'),
                    new StringField('ecole_patronymeuai'),
                    new StringField('ecole_secteur'),
                    new StringField('ecole_adresse'),
                    new StringField('ecole_lieudit'),
                    new StringField('ecole_boitepostale'),
                    new StringField('ecole_codepostal'),
                    new StringField('ecole_localiteacheminement'),
                    new StringField('ecole_commune'),
                    new StringField('ecole_coordonneex'),
                    new StringField('ecole_coordonneey'),
                    new StringField('ecole_epasg'),
                    new StringField('ecole_qualite'),
                    new StringField('ecole_localisation'),
                    new StringField('ecole_codenature'),
                    new StringField('ecole_dateouverture'),
                    new IntegerField('doccsi_id')
                )
            );
            $this->dataset->AddLookupField('doccsi_id', 'doccsi', new IntegerField('doccsi_id'), new StringField('doccsi_fichier', false, false, false, false, 'doccsi_id_doccsi_fichier', 'doccsi_id_doccsi_fichier_doccsi'), 'doccsi_id_doccsi_fichier_doccsi');
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new CustomPageNavigator('partition', $this, $this->dataset, '', $result);
            $partitionNavigator->OnGetPartitionCondition->AddListener('partition' . '_GetPartitionConditionHandler', $this);
            $partitionNavigator->OnGetPartitions->AddListener('partition' . '_GetPartitionsHandler', $this);
            $partitionNavigator->SetAllowViewAllRecords(true);
            $partitionNavigator->SetNavigationStyle(NS_LIST);
            $result->AddPageNavigator($partitionNavigator);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'ecole_id', 'ecole_id', 'Ecole Id'),
                new FilterColumn($this->dataset, 'ecole_RNE', 'ecole_RNE', 'Ecole RNE'),
                new FilterColumn($this->dataset, 'ecole_lat', 'ecole_lat', 'Ecole Lat'),
                new FilterColumn($this->dataset, 'ecole_long', 'ecole_long', 'Ecole Long'),
                new FilterColumn($this->dataset, 'ecole_latlong', 'ecole_latlong', 'Ecole Latlong'),
                new FilterColumn($this->dataset, 'ecole_coord', 'ecole_coord', 'Ecole Coord'),
                new FilterColumn($this->dataset, 'ecole_appellation', 'ecole_appellation', 'Ecole Appellation'),
                new FilterColumn($this->dataset, 'ecole_denominationprincipale', 'ecole_denominationprincipale', 'Ecole Denominationprincipale'),
                new FilterColumn($this->dataset, 'ecole_patronymeuai', 'ecole_patronymeuai', 'Ecole Patronymeuai'),
                new FilterColumn($this->dataset, 'ecole_secteur', 'ecole_secteur', 'Ecole Secteur'),
                new FilterColumn($this->dataset, 'ecole_adresse', 'ecole_adresse', 'Ecole Adresse'),
                new FilterColumn($this->dataset, 'ecole_lieudit', 'ecole_lieudit', 'Ecole Lieudit'),
                new FilterColumn($this->dataset, 'ecole_boitepostale', 'ecole_boitepostale', 'Ecole Boitepostale'),
                new FilterColumn($this->dataset, 'ecole_codepostal', 'ecole_codepostal', 'Ecole Codepostal'),
                new FilterColumn($this->dataset, 'ecole_localiteacheminement', 'ecole_localiteacheminement', 'Ecole Localiteacheminement'),
                new FilterColumn($this->dataset, 'ecole_commune', 'ecole_commune', 'Ecole Commune'),
                new FilterColumn($this->dataset, 'ecole_coordonneex', 'ecole_coordonneex', 'Ecole Coordonneex'),
                new FilterColumn($this->dataset, 'ecole_coordonneey', 'ecole_coordonneey', 'Ecole Coordonneey'),
                new FilterColumn($this->dataset, 'ecole_epasg', 'ecole_epasg', 'Ecole Epasg'),
                new FilterColumn($this->dataset, 'ecole_qualite', 'ecole_qualite', 'Ecole Qualite'),
                new FilterColumn($this->dataset, 'ecole_localisation', 'ecole_localisation', 'Ecole Localisation'),
                new FilterColumn($this->dataset, 'ecole_codenature', 'ecole_codenature', 'Ecole Codenature'),
                new FilterColumn($this->dataset, 'ecole_dateouverture', 'ecole_dateouverture', 'Ecole Dateouverture'),
                new FilterColumn($this->dataset, 'doccsi_id', 'doccsi_id_doccsi_fichier', 'Doccsi Id')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['ecole_denominationprincipale'])
                ->addColumn($columns['ecole_patronymeuai'])
                ->addColumn($columns['ecole_secteur']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('doccsi_id');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('ecole_denominationprincipale_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['ecole_denominationprincipale'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('ecole_patronymeuai_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['ecole_patronymeuai'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('ecole_secteur_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['ecole_secteur'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actions = $grid->getActions();
            $actions->setCaption($this->GetLocalizerCaptions()->GetMessageString('Actions'));
            $actions->setPosition(ActionList::POSITION_LEFT);
            
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
            
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $operation = new AjaxOperation(OPERATION_EDIT,
                    $this->GetLocalizerCaptions()->GetMessageString('Edit'),
                    $this->GetLocalizerCaptions()->GetMessageString('Edit'), $this->dataset,
                    $this->GetGridEditHandler(), $grid, AjaxOperation::INLINE);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $operation->SetAdditionalAttribute('data-modal-operation', 'delete');
                $operation->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
            
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_RNE', 'ecole_RNE', 'Ecole RNE', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ecole_appellation field
            //
            $column = new TextViewColumn('ecole_appellation', 'ecole_appellation', 'Ecole Appellation', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ecole_denominationprincipale field
            //
            $column = new TextViewColumn('ecole_denominationprincipale', 'ecole_denominationprincipale', 'Ecole Denominationprincipale', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ecole_patronymeuai field
            //
            $column = new TextViewColumn('ecole_patronymeuai', 'ecole_patronymeuai', 'Ecole Patronymeuai', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ecole_secteur field
            //
            $column = new TextViewColumn('ecole_secteur', 'ecole_secteur', 'Ecole Secteur', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ecole_adresse field
            //
            $column = new TextViewColumn('ecole_adresse', 'ecole_adresse', 'Ecole Adresse', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ecole_codepostal field
            //
            $column = new TextViewColumn('ecole_codepostal', 'ecole_codepostal', 'Ecole Codepostal', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ecole_commune field
            //
            $column = new TextViewColumn('ecole_commune', 'ecole_commune', 'Ecole Commune', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for doccsi_fichier field
            //
            $column = new TextViewColumn('doccsi_id', 'doccsi_id_doccsi_fichier', 'Doccsi Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_RNE', 'ecole_RNE', 'Ecole RNE', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_appellation field
            //
            $column = new TextViewColumn('ecole_appellation', 'ecole_appellation', 'Ecole Appellation', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_denominationprincipale field
            //
            $column = new TextViewColumn('ecole_denominationprincipale', 'ecole_denominationprincipale', 'Ecole Denominationprincipale', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_patronymeuai field
            //
            $column = new TextViewColumn('ecole_patronymeuai', 'ecole_patronymeuai', 'Ecole Patronymeuai', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_secteur field
            //
            $column = new TextViewColumn('ecole_secteur', 'ecole_secteur', 'Ecole Secteur', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_adresse field
            //
            $column = new TextViewColumn('ecole_adresse', 'ecole_adresse', 'Ecole Adresse', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_codepostal field
            //
            $column = new TextViewColumn('ecole_codepostal', 'ecole_codepostal', 'Ecole Codepostal', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_commune field
            //
            $column = new TextViewColumn('ecole_commune', 'ecole_commune', 'Ecole Commune', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for doccsi_fichier field
            //
            $column = new TextViewColumn('doccsi_id', 'doccsi_id_doccsi_fichier', 'Doccsi Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for ecole_RNE field
            //
            $editor = new TextEdit('ecole_rne_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Ecole RNE', 'ecole_RNE', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_appellation field
            //
            $editor = new TextEdit('ecole_appellation_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Appellation', 'ecole_appellation', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for doccsi_id field
            //
            $editor = new DynamicCombobox('doccsi_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`doccsi`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('doccsi_id', true, true, true),
                    new StringField('doccsi_fichier'),
                    new DateField('doccsi_datetime'),
                    new StringField('doccsi_categorie'),
                    new StringField('doccsi_avis'),
                    new IntegerField('doccsi_public'),
                    new IntegerField('doccsi_personnel'),
                    new StringField('doccsi_notes'),
                    new StringField('doccsi_notes_collectivite'),
                    new StringField('doccsi_notes_directeur')
                )
            );
            $lookupDataset->setOrderByField('doccsi_fichier', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Doccsi Id', 'doccsi_id', 'doccsi_id_doccsi_fichier', 'edit_ecole01_doccsi_id_search', $editor, $this->dataset, $lookupDataset, 'doccsi_id', 'doccsi_fichier', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(ecole01_doccsi_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
    
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
    
            $grid->SetShowAddButton(true && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
    
        }
    
        protected function AddExportColumns(Grid $grid)
        {
    
        }
    
        private function AddCompareColumns(Grid $grid)
        {
    
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        protected function GetEnableModalGridDelete() { return true; }
        
        private $partitions = array(1 => array('\'\''), 2 => array('\'13002\''), 3 => array('\'13003\''), 4 => array('\'13007\''), 5 => array('\'13013\''), 6 => array('\'13015\''), 7 => array('\'13011\''), 8 => array('\'13010\''), 9 => array('\'13004\''), 10 => array('\'13012\''), 11 => array('\'13014\''), 12 => array('\'13009\''), 13 => array('\'13006\''), 14 => array('\'13016\''), 15 => array('\'13008\''), 16 => array('\'13001\''), 17 => array('\'13005\''), 18 => array('\'13361\''));
        
        function partition_GetPartitionsHandler(&$partitions)
        {
            $partitions[1] = '';
            $partitions[2] = '13002';
            $partitions[3] = '13003';
            $partitions[4] = '13007';
            $partitions[5] = '13013';
            $partitions[6] = '13015';
            $partitions[7] = '13011';
            $partitions[8] = '13010';
            $partitions[9] = '13004';
            $partitions[10] = '13012';
            $partitions[11] = '13014';
            $partitions[12] = '13009';
            $partitions[13] = '13006';
            $partitions[14] = '13016';
            $partitions[15] = '13008';
            $partitions[16] = '13001';
            $partitions[17] = '13005';
            $partitions[18] = '13361';
        }
        
        function partition_GetPartitionConditionHandler($partitionName, &$condition)
        {
            $condition = '';
            if (isset($partitionName) && isset($this->partitions[$partitionName]))
                foreach ($this->partitions[$partitionName] as $value)
                    AddStr($condition, sprintf('(ecole_codepostal = %s)', $value), ' OR ');
        }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(true);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(true);
            $result->SetShowLineNumbers(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setAllowCompare(true);
            $this->AddCompareHeaderColumns($result);
            $this->AddCompareColumns($result);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && true);
            $result->setTableBordered(true);
            $result->setTableCondensed(true);
            
            $result->SetHighlightRowAtHover(true);
            $result->SetWidth('');
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddMultiEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddMultiUploadColumn($result);
    
    
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(true);
            $this->setAllowPrintSelectedRecords(true);
            $this->setExportListAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportSelectedRecordsAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setModalViewSize(Modal::SIZE_LG);
            $this->setModalFormSize(Modal::SIZE_LG);
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`doccsi`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('doccsi_id', true, true, true),
                    new StringField('doccsi_fichier'),
                    new DateField('doccsi_datetime'),
                    new StringField('doccsi_categorie'),
                    new StringField('doccsi_avis'),
                    new IntegerField('doccsi_public'),
                    new IntegerField('doccsi_personnel'),
                    new StringField('doccsi_notes'),
                    new StringField('doccsi_notes_collectivite'),
                    new StringField('doccsi_notes_directeur')
                )
            );
            $lookupDataset->setOrderByField('doccsi_fichier', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_ecole01_doccsi_id_search', 'doccsi_id', 'doccsi_fichier', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            
            
            new ecole01_doccsi_idNestedPage($this, GetCurrentUserPermissionsForPage('ecole01.doccsi_id'));
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
    
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        protected function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeUpdateRecord($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPrepareColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function doPrepareFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function doGetSelectionFilters(FixedKeysArray $columns, &$result)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomColumnGroup(FixedKeysArray $columns, ViewColumnGroup $columnGroup)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
    
        }
    
        protected function doAddEnvironmentVariables(Page $page, &$variables)
        {
    
        }
    
    }

    SetUpUserAuthorization();

    try
    {
        $Page = new ecole01Page("ecole01", "ecole01.php", GetCurrentUserPermissionsForPage("ecole01"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("ecole01"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
