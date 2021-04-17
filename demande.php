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

    
    
    class demande_ecole_ecole_idModalViewPage extends ViewBasedPage
    {
        protected function DoBeforeCreate()
        {
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
                    new StringField('eole_boitepostale'),
                    new StringField('ecole_codepostal'),
                    new StringField('ecole_localiteacheminement'),
                    new StringField('ecole_commune'),
                    new StringField('ecole_coordonneex'),
                    new StringField('ecole_coordonneey'),
                    new StringField('ecole_epasg'),
                    new StringField('ecole_qualite'),
                    new StringField('ecole_localisation'),
                    new StringField('ecole_codenature'),
                    new StringField('ecole_dateouverture')
                )
            );
        }
    
        protected function DoPrepare() {
    
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
            // View column for ecole_codepostal field
            //
            $column = new TextViewColumn('ecole_codepostal', 'ecole_codepostal', 'Ecole Codepostal', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
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
    
        protected function doRegisterHandlers() {
            
            
        }
    
        static public function getHandlerName() {
            return get_class() . '_modal_view';
        }
    
        public function GetModalGridViewHandler() {
            return self::getHandlerName();
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    }
    
    // OnBeforePageExecute event handler
    
    
    
    class demandePage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Demande');
            $this->SetMenuLabel('Demande');
            $this->SetHeader(GetPagesHeader());
            $this->SetFooter(GetPagesFooter());
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demande`');
            $this->dataset->addFields(
                array(
                    new IntegerField('demande_id', true, true, true),
                    new StringField('demande_objet'),
                    new StringField('demande_description'),
                    new IntegerField('demandetype_demandetype_id', true, true),
                    new IntegerField('demandestatut_demandestatut_id', true, true),
                    new IntegerField('demandegravite_demandegravite_id', true, true),
                    new IntegerField('ecole_ecole_id', true, true)
                )
            );
            $this->dataset->AddLookupField('demandetype_demandetype_id', 'demandetype', new IntegerField('demandetype_id'), new StringField('demandetype_designation', false, false, false, false, 'demandetype_demandetype_id_demandetype_designation', 'demandetype_demandetype_id_demandetype_designation_demandetype'), 'demandetype_demandetype_id_demandetype_designation_demandetype');
            $this->dataset->AddLookupField('ecole_ecole_id', 'ecole', new IntegerField('ecole_id'), new StringField('ecole_appellation', false, false, false, false, 'ecole_ecole_id_ecole_appellation', 'ecole_ecole_id_ecole_appellation_ecole'), 'ecole_ecole_id_ecole_appellation_ecole');
            $this->dataset->AddLookupField('demandestatut_demandestatut_id', 'demandestatut', new IntegerField('demandestatut_id'), new StringField('demandestatut_designation', false, false, false, false, 'demandestatut_demandestatut_id_demandestatut_designation', 'demandestatut_demandestatut_id_demandestatut_designation_demandestatut'), 'demandestatut_demandestatut_id_demandestatut_designation_demandestatut');
            $this->dataset->AddLookupField('demandegravite_demandegravite_id', 'demandegravite', new IntegerField('demandegravite_id'), new StringField('demandegravite_designation', false, false, false, false, 'demandegravite_demandegravite_id_demandegravite_designation', 'demandegravite_demandegravite_id_demandegravite_designation_demandegravite'), 'demandegravite_demandegravite_id_demandegravite_designation_demandegravite');
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
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
                new FilterColumn($this->dataset, 'demande_id', 'demande_id', 'N° demande'),
                new FilterColumn($this->dataset, 'demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'Type de demande'),
                new FilterColumn($this->dataset, 'ecole_ecole_id', 'ecole_ecole_id_ecole_appellation', 'Ecole concernée'),
                new FilterColumn($this->dataset, 'demande_objet', 'demande_objet', 'Objet'),
                new FilterColumn($this->dataset, 'demande_description', 'demande_description', 'Description'),
                new FilterColumn($this->dataset, 'demandestatut_demandestatut_id', 'demandestatut_demandestatut_id_demandestatut_designation', 'Statut'),
                new FilterColumn($this->dataset, 'demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Gravité')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['demande_id'])
                ->addColumn($columns['demandetype_demandetype_id'])
                ->addColumn($columns['ecole_ecole_id'])
                ->addColumn($columns['demande_objet'])
                ->addColumn($columns['demande_description'])
                ->addColumn($columns['demandestatut_demandestatut_id'])
                ->addColumn($columns['demandegravite_demandegravite_id']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('demande_id')
                ->setOptionsFor('demandetype_demandetype_id')
                ->setOptionsFor('ecole_ecole_id')
                ->setOptionsFor('demandestatut_demandestatut_id')
                ->setOptionsFor('demandegravite_demandegravite_id');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('demande_id_edit');
            
            $filterBuilder->addColumn(
                $columns['demande_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('demandetype_demandetype_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_demande_demandetype_demandetype_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('demandetype_demandetype_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_demande_demandetype_demandetype_id_search');
            
            $text_editor = new TextEdit('demandetype_demandetype_id');
            
            $filterBuilder->addColumn(
                $columns['demandetype_demandetype_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('ecole_ecole_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->setFormatSelection('return item.formatted_value;');
            $main_editor->setFormatResult('return item.formatted_value;');
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_demande_ecole_ecole_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('ecole_ecole_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_demande_ecole_ecole_id_search');
            
            $text_editor = new TextEdit('ecole_ecole_id');
            
            $filterBuilder->addColumn(
                $columns['ecole_ecole_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('demande_objet_edit');
            $main_editor->SetMaxLength(45);
            
            $filterBuilder->addColumn(
                $columns['demande_objet'],
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
            
            $main_editor = new TextEdit('demande_description');
            
            $filterBuilder->addColumn(
                $columns['demande_description'],
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
            
            $main_editor = new DynamicCombobox('demandestatut_demandestatut_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_demande_demandestatut_demandestatut_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('demandestatut_demandestatut_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_demande_demandestatut_demandestatut_id_search');
            
            $text_editor = new TextEdit('demandestatut_demandestatut_id');
            
            $filterBuilder->addColumn(
                $columns['demandestatut_demandestatut_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('demandegravite_demandegravite_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_demande_demandegravite_demandegravite_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('demandegravite_demandegravite_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_demande_demandegravite_demandegravite_id_search');
            
            $text_editor = new TextEdit('demandegravite_demandegravite_id');
            
            $filterBuilder->addColumn(
                $columns['demandegravite_demandegravite_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
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
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset, $grid);
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
            // View column for demande_id field
            //
            $column = new NumberViewColumn('demande_id', 'demande_id', 'N° demande', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for demandetype_designation field
            //
            $column = new TextViewColumn('demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'Type de demande', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ecole_appellation field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_appellation', 'Ecole concernée', $this->dataset);
            $column->SetOrderable(true);
            $column->setLookupRecordModalViewHandlerName(demande_ecole_ecole_idModalViewPage::getHandlerName());
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for demande_objet field
            //
            $column = new TextViewColumn('demande_objet', 'demande_objet', 'Objet', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for demande_description field
            //
            $column = new TextViewColumn('demande_description', 'demande_description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for demandestatut_designation field
            //
            $column = new TextViewColumn('demandestatut_demandestatut_id', 'demandestatut_demandestatut_id_demandestatut_designation', 'Statut', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for demandegravite_designation field
            //
            $column = new TextViewColumn('demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Gravité', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for demande_id field
            //
            $column = new NumberViewColumn('demande_id', 'demande_id', 'N° demande', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for demandetype_designation field
            //
            $column = new TextViewColumn('demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'Type de demande', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_appellation field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_appellation', 'Ecole concernée', $this->dataset);
            $column->SetOrderable(true);
            $column->setLookupRecordModalViewHandlerName(demande_ecole_ecole_idModalViewPage::getHandlerName());
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for demande_objet field
            //
            $column = new TextViewColumn('demande_objet', 'demande_objet', 'Objet', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for demande_description field
            //
            $column = new TextViewColumn('demande_description', 'demande_description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for demandestatut_designation field
            //
            $column = new TextViewColumn('demandestatut_demandestatut_id', 'demandestatut_demandestatut_id_demandestatut_designation', 'Statut', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for demandegravite_designation field
            //
            $column = new TextViewColumn('demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Gravité', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for demande_id field
            //
            $editor = new TextEdit('demande_id_edit');
            $editColumn = new CustomEditColumn('N° demande', 'demande_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for demandetype_demandetype_id field
            //
            $editor = new DynamicCombobox('demandetype_demandetype_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demandetype`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('demandetype_id', true, true),
                    new StringField('demandetype_designation')
                )
            );
            $lookupDataset->setOrderByField('demandetype_designation', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Type de demande', 'demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'edit_demande_demandetype_demandetype_id_search', $editor, $this->dataset, $lookupDataset, 'demandetype_id', 'demandetype_designation', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_ecole_id field
            //
            $editor = new ComboBox('ecole_ecole_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ecole`');
            $lookupDataset->addFields(
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
                    new StringField('eole_boitepostale'),
                    new StringField('ecole_codepostal'),
                    new StringField('ecole_localiteacheminement'),
                    new StringField('ecole_commune'),
                    new StringField('ecole_coordonneex'),
                    new StringField('ecole_coordonneey'),
                    new StringField('ecole_epasg'),
                    new StringField('ecole_qualite'),
                    new StringField('ecole_localisation'),
                    new StringField('ecole_codenature'),
                    new StringField('ecole_dateouverture')
                )
            );
            $lookupDataset->setOrderByField('ecole_appellation', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Ecole concernée', 
                'ecole_ecole_id', 
                $editor, 
                $this->dataset, 'ecole_id', 'ecole_appellation', $lookupDataset);
            $editColumn->SetCaptionTemplate('%ecole_codepostal% %ecole_appellation%');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for demande_objet field
            //
            $editor = new TextEdit('demande_objet_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Objet', 'demande_objet', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for demande_description field
            //
            $editor = new TextAreaEdit('demande_description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Description', 'demande_description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for demandestatut_demandestatut_id field
            //
            $editor = new DynamicCombobox('demandestatut_demandestatut_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demandestatut`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('demandestatut_id', true, true),
                    new StringField('demandestatut_designation'),
                    new StringField('demandestatut_aide')
                )
            );
            $lookupDataset->setOrderByField('demandestatut_designation', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Statut', 'demandestatut_demandestatut_id', 'demandestatut_demandestatut_id_demandestatut_designation', 'edit_demande_demandestatut_demandestatut_id_search', $editor, $this->dataset, $lookupDataset, 'demandestatut_id', 'demandestatut_designation', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for demandegravite_demandegravite_id field
            //
            $editor = new DynamicCombobox('demandegravite_demandegravite_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demandegravite`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('demandegravite_id', true, true),
                    new StringField('demandegravite_designation'),
                    new StringField('demandegravite_aide')
                )
            );
            $lookupDataset->setOrderByField('demandegravite_designation', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Gravité', 'demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'edit_demande_demandegravite_demandegravite_id_search', $editor, $this->dataset, $lookupDataset, 'demandegravite_id', 'demandegravite_designation', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for demande_objet field
            //
            $editor = new TextEdit('demande_objet_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Objet', 'demande_objet', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for demande_description field
            //
            $editor = new TextAreaEdit('demande_description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Description', 'demande_description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for demandetype_demandetype_id field
            //
            $editor = new DynamicCombobox('demandetype_demandetype_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demandetype`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('demandetype_id', true, true),
                    new StringField('demandetype_designation')
                )
            );
            $lookupDataset->setOrderByField('demandetype_designation', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Type de demande', 'demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'insert_demande_demandetype_demandetype_id_search', $editor, $this->dataset, $lookupDataset, 'demandetype_id', 'demandetype_designation', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_ecole_id field
            //
            $editor = new ComboBox('ecole_ecole_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ecole`');
            $lookupDataset->addFields(
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
                    new StringField('eole_boitepostale'),
                    new StringField('ecole_codepostal'),
                    new StringField('ecole_localiteacheminement'),
                    new StringField('ecole_commune'),
                    new StringField('ecole_coordonneex'),
                    new StringField('ecole_coordonneey'),
                    new StringField('ecole_epasg'),
                    new StringField('ecole_qualite'),
                    new StringField('ecole_localisation'),
                    new StringField('ecole_codenature'),
                    new StringField('ecole_dateouverture')
                )
            );
            $lookupDataset->setOrderByField('ecole_appellation', 'ASC');
            $editColumn = new LookUpEditColumn(
                'Ecole concernée', 
                'ecole_ecole_id', 
                $editor, 
                $this->dataset, 'ecole_id', 'ecole_appellation', $lookupDataset);
            $editColumn->SetCaptionTemplate('%ecole_codepostal% %ecole_appellation%');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for demande_objet field
            //
            $editor = new TextEdit('demande_objet_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Objet', 'demande_objet', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for demande_description field
            //
            $editor = new TextAreaEdit('demande_description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Description', 'demande_description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for demandestatut_demandestatut_id field
            //
            $editor = new DynamicCombobox('demandestatut_demandestatut_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demandestatut`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('demandestatut_id', true, true),
                    new StringField('demandestatut_designation'),
                    new StringField('demandestatut_aide')
                )
            );
            $lookupDataset->setOrderByField('demandestatut_designation', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Statut', 'demandestatut_demandestatut_id', 'demandestatut_demandestatut_id_demandestatut_designation', 'insert_demande_demandestatut_demandestatut_id_search', $editor, $this->dataset, $lookupDataset, 'demandestatut_id', 'demandestatut_designation', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for demandegravite_demandegravite_id field
            //
            $editor = new DynamicCombobox('demandegravite_demandegravite_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demandegravite`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('demandegravite_id', true, true),
                    new StringField('demandegravite_designation'),
                    new StringField('demandegravite_aide')
                )
            );
            $lookupDataset->setOrderByField('demandegravite_designation', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Gravité', 'demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'insert_demande_demandegravite_demandegravite_id_search', $editor, $this->dataset, $lookupDataset, 'demandegravite_id', 'demandegravite_designation', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(true && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for demande_id field
            //
            $column = new NumberViewColumn('demande_id', 'demande_id', 'N° demande', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for demandetype_designation field
            //
            $column = new TextViewColumn('demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'Type de demande', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_appellation field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_appellation', 'Ecole concernée', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for demande_objet field
            //
            $column = new TextViewColumn('demande_objet', 'demande_objet', 'Objet', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for demande_description field
            //
            $column = new TextViewColumn('demande_description', 'demande_description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for demandestatut_designation field
            //
            $column = new TextViewColumn('demandestatut_demandestatut_id', 'demandestatut_demandestatut_id_demandestatut_designation', 'Statut', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for demandegravite_designation field
            //
            $column = new TextViewColumn('demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Gravité', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for demande_id field
            //
            $column = new NumberViewColumn('demande_id', 'demande_id', 'N° demande', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for demandetype_designation field
            //
            $column = new TextViewColumn('demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'Type de demande', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_appellation field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_appellation', 'Ecole concernée', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for demande_objet field
            //
            $column = new TextViewColumn('demande_objet', 'demande_objet', 'Objet', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for demande_description field
            //
            $column = new TextViewColumn('demande_description', 'demande_description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for demandestatut_designation field
            //
            $column = new TextViewColumn('demandestatut_demandestatut_id', 'demandestatut_demandestatut_id_demandestatut_designation', 'Statut', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for demandegravite_designation field
            //
            $column = new TextViewColumn('demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Gravité', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for demande_id field
            //
            $column = new NumberViewColumn('demande_id', 'demande_id', 'N° demande', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for demandetype_designation field
            //
            $column = new TextViewColumn('demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'Type de demande', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_appellation field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_appellation', 'Ecole concernée', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for demande_objet field
            //
            $column = new TextViewColumn('demande_objet', 'demande_objet', 'Objet', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for demande_description field
            //
            $column = new TextViewColumn('demande_description', 'demande_description', 'Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for demandestatut_designation field
            //
            $column = new TextViewColumn('demandestatut_demandestatut_id', 'demandestatut_demandestatut_id_demandestatut_designation', 'Statut', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for demandegravite_designation field
            //
            $column = new TextViewColumn('demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Gravité', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
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
    
    
            $this->SetViewFormTitle('Demande n°%demande_id%');
            $this->SetEditFormTitle('Demande n°%demande_id%');
            $this->SetInsertFormTitle('Nouvelle demande');
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
                '`demandetype`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('demandetype_id', true, true),
                    new StringField('demandetype_designation')
                )
            );
            $lookupDataset->setOrderByField('demandetype_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_demande_demandetype_demandetype_id_search', 'demandetype_id', 'demandetype_designation', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demandestatut`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('demandestatut_id', true, true),
                    new StringField('demandestatut_designation'),
                    new StringField('demandestatut_aide')
                )
            );
            $lookupDataset->setOrderByField('demandestatut_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_demande_demandestatut_demandestatut_id_search', 'demandestatut_id', 'demandestatut_designation', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demandegravite`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('demandegravite_id', true, true),
                    new StringField('demandegravite_designation'),
                    new StringField('demandegravite_aide')
                )
            );
            $lookupDataset->setOrderByField('demandegravite_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_demande_demandegravite_demandegravite_id_search', 'demandegravite_id', 'demandegravite_designation', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demandetype`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('demandetype_id', true, true),
                    new StringField('demandetype_designation')
                )
            );
            $lookupDataset->setOrderByField('demandetype_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_demande_demandetype_demandetype_id_search', 'demandetype_id', 'demandetype_designation', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`ecole`');
            $lookupDataset->addFields(
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
                    new StringField('eole_boitepostale'),
                    new StringField('ecole_codepostal'),
                    new StringField('ecole_localiteacheminement'),
                    new StringField('ecole_commune'),
                    new StringField('ecole_coordonneex'),
                    new StringField('ecole_coordonneey'),
                    new StringField('ecole_epasg'),
                    new StringField('ecole_qualite'),
                    new StringField('ecole_localisation'),
                    new StringField('ecole_codenature'),
                    new StringField('ecole_dateouverture')
                )
            );
            $lookupDataset->setOrderByField('ecole_appellation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_demande_ecole_ecole_id_search', 'ecole_id', 'ecole_appellation', '%ecole_codepostal% %ecole_appellation%', 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demandestatut`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('demandestatut_id', true, true),
                    new StringField('demandestatut_designation'),
                    new StringField('demandestatut_aide')
                )
            );
            $lookupDataset->setOrderByField('demandestatut_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_demande_demandestatut_demandestatut_id_search', 'demandestatut_id', 'demandestatut_designation', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demandegravite`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('demandegravite_id', true, true),
                    new StringField('demandegravite_designation'),
                    new StringField('demandegravite_aide')
                )
            );
            $lookupDataset->setOrderByField('demandegravite_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_demande_demandegravite_demandegravite_id_search', 'demandegravite_id', 'demandegravite_designation', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demandetype`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('demandetype_id', true, true),
                    new StringField('demandetype_designation')
                )
            );
            $lookupDataset->setOrderByField('demandetype_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_demande_demandetype_demandetype_id_search', 'demandetype_id', 'demandetype_designation', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demandestatut`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('demandestatut_id', true, true),
                    new StringField('demandestatut_designation'),
                    new StringField('demandestatut_aide')
                )
            );
            $lookupDataset->setOrderByField('demandestatut_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_demande_demandestatut_demandestatut_id_search', 'demandestatut_id', 'demandestatut_designation', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demandegravite`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('demandegravite_id', true, true),
                    new StringField('demandegravite_designation'),
                    new StringField('demandegravite_aide')
                )
            );
            $lookupDataset->setOrderByField('demandegravite_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_demande_demandegravite_demandegravite_id_search', 'demandegravite_id', 'demandegravite_designation', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            new demande_ecole_ecole_idModalViewPage($this, GetCurrentUserPermissionsForPage('demande.ecole_ecole_id'));
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
        $Page = new demandePage("demande", "demande.php", GetCurrentUserPermissionsForPage("demande"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("demande"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
