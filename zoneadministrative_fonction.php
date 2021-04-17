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

    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class zoneadministrative_fonctionPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Zone Administration - Fonction');
            $this->SetMenuLabel('Zoneadministrative Fonction');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`zoneadministrative_fonction`');
            $this->dataset->addFields(
                array(
                    new IntegerField('zoneadministrative_zoneadministrative_id', true, true),
                    new IntegerField('fonction_fonction_id', true, true)
                )
            );
            $this->dataset->AddLookupField('zoneadministrative_zoneadministrative_id', 'zoneadministrative', new IntegerField('zoneadministrative_id'), new StringField('zoneadministrative_designation', false, false, false, false, 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation_zoneadministrative'), 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation_zoneadministrative');
            $this->dataset->AddLookupField('fonction_fonction_id', 'fonction', new IntegerField('fonction_id'), new StringField('fonction_designation', false, false, false, false, 'fonction_fonction_id_fonction_designation', 'fonction_fonction_id_fonction_designation_fonction'), 'fonction_fonction_id_fonction_designation_fonction');
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
                new FilterColumn($this->dataset, 'zoneadministrative_zoneadministrative_id', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'Zone Administrative'),
                new FilterColumn($this->dataset, 'fonction_fonction_id', 'fonction_fonction_id_fonction_designation', 'Fonction')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['zoneadministrative_zoneadministrative_id'])
                ->addColumn($columns['fonction_fonction_id']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('zoneadministrative_zoneadministrative_id')
                ->setOptionsFor('fonction_fonction_id');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new DynamicCombobox('zoneadministrative_zoneadministrative_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_zoneadministrative_fonction_zoneadministrative_zoneadministrative_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('zoneadministrative_zoneadministrative_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_zoneadministrative_fonction_zoneadministrative_zoneadministrative_id_search');
            
            $text_editor = new TextEdit('zoneadministrative_zoneadministrative_id');
            
            $filterBuilder->addColumn(
                $columns['zoneadministrative_zoneadministrative_id'],
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
            
            $main_editor = new DynamicCombobox('fonction_fonction_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_zoneadministrative_fonction_fonction_fonction_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('fonction_fonction_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_zoneadministrative_fonction_fonction_fonction_id_search');
            
            $text_editor = new TextEdit('fonction_fonction_id');
            
            $filterBuilder->addColumn(
                $columns['fonction_fonction_id'],
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
            // View column for zoneadministrative_designation field
            //
            $column = new TextViewColumn('zoneadministrative_zoneadministrative_id', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'Zone Administrative', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for fonction_designation field
            //
            $column = new TextViewColumn('fonction_fonction_id', 'fonction_fonction_id_fonction_designation', 'Fonction', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for zoneadministrative_designation field
            //
            $column = new TextViewColumn('zoneadministrative_zoneadministrative_id', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'Zone Administrative', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for fonction_designation field
            //
            $column = new TextViewColumn('fonction_fonction_id', 'fonction_fonction_id_fonction_designation', 'Fonction', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for zoneadministrative_zoneadministrative_id field
            //
            $editor = new DynamicCombobox('zoneadministrative_zoneadministrative_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`zoneadministrative`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('zoneadministrative_id', true, true, true),
                    new StringField('zoneadministrative_designation'),
                    new StringField('zoneadministrative_ccord'),
                    new StringField('zoneadministrative_ref_iris'),
                    new StringField('zoneadministrative_ref_insee'),
                    new StringField('zoneadministrative_observation'),
                    new StringField('zoneadministrative_lien_url'),
                    new StringField('zoneadministrative_lien_texte'),
                    new IntegerField('zoneadministrative_zoneadministrative_id')
                )
            );
            $lookupDataset->setOrderByField('zoneadministrative_designation', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Zone Administrative', 'zoneadministrative_zoneadministrative_id', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'edit_zoneadministrative_fonction_zoneadministrative_zoneadministrative_id_search', $editor, $this->dataset, $lookupDataset, 'zoneadministrative_id', 'zoneadministrative_designation', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for fonction_fonction_id field
            //
            $editor = new DynamicCombobox('fonction_fonction_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`fonction`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('fonction_id', true, true, true),
                    new StringField('fonction_designation'),
                    new StringField('fonction_commentaire')
                )
            );
            $lookupDataset->setOrderByField('fonction_designation', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Fonction', 'fonction_fonction_id', 'fonction_fonction_id_fonction_designation', 'edit_zoneadministrative_fonction_fonction_fonction_id_search', $editor, $this->dataset, $lookupDataset, 'fonction_id', 'fonction_designation', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
    
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for zoneadministrative_zoneadministrative_id field
            //
            $editor = new DynamicCombobox('zoneadministrative_zoneadministrative_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`zoneadministrative`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('zoneadministrative_id', true, true, true),
                    new StringField('zoneadministrative_designation'),
                    new StringField('zoneadministrative_ccord'),
                    new StringField('zoneadministrative_ref_iris'),
                    new StringField('zoneadministrative_ref_insee'),
                    new StringField('zoneadministrative_observation'),
                    new StringField('zoneadministrative_lien_url'),
                    new StringField('zoneadministrative_lien_texte'),
                    new IntegerField('zoneadministrative_zoneadministrative_id')
                )
            );
            $lookupDataset->setOrderByField('zoneadministrative_designation', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Zone Administrative', 'zoneadministrative_zoneadministrative_id', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'insert_zoneadministrative_fonction_zoneadministrative_zoneadministrative_id_search', $editor, $this->dataset, $lookupDataset, 'zoneadministrative_id', 'zoneadministrative_designation', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for fonction_fonction_id field
            //
            $editor = new DynamicCombobox('fonction_fonction_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`fonction`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('fonction_id', true, true, true),
                    new StringField('fonction_designation'),
                    new StringField('fonction_commentaire')
                )
            );
            $lookupDataset->setOrderByField('fonction_designation', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Fonction', 'fonction_fonction_id', 'fonction_fonction_id_fonction_designation', 'insert_zoneadministrative_fonction_fonction_fonction_id_search', $editor, $this->dataset, $lookupDataset, 'fonction_id', 'fonction_designation', '');
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
            // View column for zoneadministrative_designation field
            //
            $column = new TextViewColumn('zoneadministrative_zoneadministrative_id', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'Zone Administrative', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for fonction_designation field
            //
            $column = new TextViewColumn('fonction_fonction_id', 'fonction_fonction_id_fonction_designation', 'Fonction', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for zoneadministrative_designation field
            //
            $column = new TextViewColumn('zoneadministrative_zoneadministrative_id', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'Zone Administrative', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for fonction_designation field
            //
            $column = new TextViewColumn('fonction_fonction_id', 'fonction_fonction_id_fonction_designation', 'Fonction', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for zoneadministrative_designation field
            //
            $column = new TextViewColumn('zoneadministrative_zoneadministrative_id', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'Zone Administrative', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for fonction_designation field
            //
            $column = new TextViewColumn('fonction_fonction_id', 'fonction_fonction_id_fonction_designation', 'Fonction', $this->dataset);
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
                '`zoneadministrative`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('zoneadministrative_id', true, true, true),
                    new StringField('zoneadministrative_designation'),
                    new StringField('zoneadministrative_ccord'),
                    new StringField('zoneadministrative_ref_iris'),
                    new StringField('zoneadministrative_ref_insee'),
                    new StringField('zoneadministrative_observation'),
                    new StringField('zoneadministrative_lien_url'),
                    new StringField('zoneadministrative_lien_texte'),
                    new IntegerField('zoneadministrative_zoneadministrative_id')
                )
            );
            $lookupDataset->setOrderByField('zoneadministrative_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_zoneadministrative_fonction_zoneadministrative_zoneadministrative_id_search', 'zoneadministrative_id', 'zoneadministrative_designation', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`fonction`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('fonction_id', true, true, true),
                    new StringField('fonction_designation'),
                    new StringField('fonction_commentaire')
                )
            );
            $lookupDataset->setOrderByField('fonction_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_zoneadministrative_fonction_fonction_fonction_id_search', 'fonction_id', 'fonction_designation', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`zoneadministrative`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('zoneadministrative_id', true, true, true),
                    new StringField('zoneadministrative_designation'),
                    new StringField('zoneadministrative_ccord'),
                    new StringField('zoneadministrative_ref_iris'),
                    new StringField('zoneadministrative_ref_insee'),
                    new StringField('zoneadministrative_observation'),
                    new StringField('zoneadministrative_lien_url'),
                    new StringField('zoneadministrative_lien_texte'),
                    new IntegerField('zoneadministrative_zoneadministrative_id')
                )
            );
            $lookupDataset->setOrderByField('zoneadministrative_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_zoneadministrative_fonction_zoneadministrative_zoneadministrative_id_search', 'zoneadministrative_id', 'zoneadministrative_designation', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`fonction`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('fonction_id', true, true, true),
                    new StringField('fonction_designation'),
                    new StringField('fonction_commentaire')
                )
            );
            $lookupDataset->setOrderByField('fonction_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_zoneadministrative_fonction_fonction_fonction_id_search', 'fonction_id', 'fonction_designation', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`zoneadministrative`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('zoneadministrative_id', true, true, true),
                    new StringField('zoneadministrative_designation'),
                    new StringField('zoneadministrative_ccord'),
                    new StringField('zoneadministrative_ref_iris'),
                    new StringField('zoneadministrative_ref_insee'),
                    new StringField('zoneadministrative_observation'),
                    new StringField('zoneadministrative_lien_url'),
                    new StringField('zoneadministrative_lien_texte'),
                    new IntegerField('zoneadministrative_zoneadministrative_id')
                )
            );
            $lookupDataset->setOrderByField('zoneadministrative_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_zoneadministrative_fonction_zoneadministrative_zoneadministrative_id_search', 'zoneadministrative_id', 'zoneadministrative_designation', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`fonction`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('fonction_id', true, true, true),
                    new StringField('fonction_designation'),
                    new StringField('fonction_commentaire')
                )
            );
            $lookupDataset->setOrderByField('fonction_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_zoneadministrative_fonction_fonction_fonction_id_search', 'fonction_id', 'fonction_designation', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
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
        $Page = new zoneadministrative_fonctionPage("zoneadministrative_fonction", "zoneadministrative_fonction.php", GetCurrentUserPermissionsForPage("zoneadministrative_fonction"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("zoneadministrative_fonction"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
