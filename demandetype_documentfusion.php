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
    
    
    
    class demandetype_documentfusion_demandetype_documentfusion_demandetypePage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Demandetype Documentfusion Demandetype');
            $this->SetMenuLabel('Demandetype Documentfusion Demandetype');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demandetype_documentfusion_demandetype`');
            $this->dataset->addFields(
                array(
                    new IntegerField('demandetype_documentfusion_demandetype_documentfusion_id', true, true),
                    new IntegerField('demandetype_demandetype_id', true, true)
                )
            );
            $this->dataset->AddLookupField('demandetype_documentfusion_demandetype_documentfusion_id', 'demandetype_documentfusion', new IntegerField('demandetype_documentfusion_id'), new StringField('demandetype_documentfusion_designation', false, false, false, false, 'demandetype_documentfusion_demandetype_documentfusion_id_demandetype_documentfusion_designation', 'demandetype_documentfusion_demandetype_documentfusion_id_demandetype_documentfusion_designation_demandetype_documentfusion'), 'demandetype_documentfusion_demandetype_documentfusion_id_demandetype_documentfusion_designation_demandetype_documentfusion');
            $this->dataset->AddLookupField('demandetype_demandetype_id', 'demandetype', new IntegerField('demandetype_id'), new StringField('demandetype_designation', false, false, false, false, 'demandetype_demandetype_id_demandetype_designation', 'demandetype_demandetype_id_demandetype_designation_demandetype'), 'demandetype_demandetype_id_demandetype_designation_demandetype');
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
                new FilterColumn($this->dataset, 'demandetype_documentfusion_demandetype_documentfusion_id', 'demandetype_documentfusion_demandetype_documentfusion_id_demandetype_documentfusion_designation', 'Demandetype Documentfusion Demandetype Documentfusion Id'),
                new FilterColumn($this->dataset, 'demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'Demandetype Demandetype Id')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['demandetype_documentfusion_demandetype_documentfusion_id'])
                ->addColumn($columns['demandetype_demandetype_id']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('demandetype_documentfusion_demandetype_documentfusion_id')
                ->setOptionsFor('demandetype_demandetype_id');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new DynamicCombobox('demandetype_documentfusion_demandetype_documentfusion_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_demandetype_documentfusion_demandetype_documentfusion_demandetype_demandetype_documentfusion_demandetype_documentfusion_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('demandetype_documentfusion_demandetype_documentfusion_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_demandetype_documentfusion_demandetype_documentfusion_demandetype_demandetype_documentfusion_demandetype_documentfusion_id_search');
            
            $text_editor = new TextEdit('demandetype_documentfusion_demandetype_documentfusion_id');
            
            $filterBuilder->addColumn(
                $columns['demandetype_documentfusion_demandetype_documentfusion_id'],
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
            
            $main_editor = new DynamicCombobox('demandetype_demandetype_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_demandetype_documentfusion_demandetype_documentfusion_demandetype_demandetype_demandetype_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('demandetype_demandetype_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_demandetype_documentfusion_demandetype_documentfusion_demandetype_demandetype_demandetype_id_search');
            
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
            // View column for demandetype_documentfusion_designation field
            //
            $column = new TextViewColumn('demandetype_documentfusion_demandetype_documentfusion_id', 'demandetype_documentfusion_demandetype_documentfusion_id_demandetype_documentfusion_designation', 'Demandetype Documentfusion Demandetype Documentfusion Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for demandetype_designation field
            //
            $column = new TextViewColumn('demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'Demandetype Demandetype Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for demandetype_documentfusion_designation field
            //
            $column = new TextViewColumn('demandetype_documentfusion_demandetype_documentfusion_id', 'demandetype_documentfusion_demandetype_documentfusion_id_demandetype_documentfusion_designation', 'Demandetype Documentfusion Demandetype Documentfusion Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for demandetype_designation field
            //
            $column = new TextViewColumn('demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'Demandetype Demandetype Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for demandetype_documentfusion_demandetype_documentfusion_id field
            //
            $editor = new DynamicCombobox('demandetype_documentfusion_demandetype_documentfusion_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demandetype_documentfusion`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('demandetype_documentfusion_id', true, true),
                    new StringField('demandetype_documentfusion_designation'),
                    new StringField('demandetype_documentfusion_aide'),
                    new StringField('demandetype_documentfusion_emplacement')
                )
            );
            $lookupDataset->setOrderByField('demandetype_documentfusion_designation', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Demandetype Documentfusion Demandetype Documentfusion Id', 'demandetype_documentfusion_demandetype_documentfusion_id', 'demandetype_documentfusion_demandetype_documentfusion_id_demandetype_documentfusion_designation', 'edit_demandetype_documentfusion_demandetype_documentfusion_demandetype_demandetype_documentfusion_demandetype_documentfusion_id_search', $editor, $this->dataset, $lookupDataset, 'demandetype_documentfusion_id', 'demandetype_documentfusion_designation', '');
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
            $editColumn = new DynamicLookupEditColumn('Demandetype Demandetype Id', 'demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'edit_demandetype_documentfusion_demandetype_documentfusion_demandetype_demandetype_demandetype_id_search', $editor, $this->dataset, $lookupDataset, 'demandetype_id', 'demandetype_designation', '');
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
            // Edit column for demandetype_documentfusion_demandetype_documentfusion_id field
            //
            $editor = new DynamicCombobox('demandetype_documentfusion_demandetype_documentfusion_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demandetype_documentfusion`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('demandetype_documentfusion_id', true, true),
                    new StringField('demandetype_documentfusion_designation'),
                    new StringField('demandetype_documentfusion_aide'),
                    new StringField('demandetype_documentfusion_emplacement')
                )
            );
            $lookupDataset->setOrderByField('demandetype_documentfusion_designation', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Demandetype Documentfusion Demandetype Documentfusion Id', 'demandetype_documentfusion_demandetype_documentfusion_id', 'demandetype_documentfusion_demandetype_documentfusion_id_demandetype_documentfusion_designation', 'insert_demandetype_documentfusion_demandetype_documentfusion_demandetype_demandetype_documentfusion_demandetype_documentfusion_id_search', $editor, $this->dataset, $lookupDataset, 'demandetype_documentfusion_id', 'demandetype_documentfusion_designation', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
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
            $editColumn = new DynamicLookupEditColumn('Demandetype Demandetype Id', 'demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'insert_demandetype_documentfusion_demandetype_documentfusion_demandetype_demandetype_demandetype_id_search', $editor, $this->dataset, $lookupDataset, 'demandetype_id', 'demandetype_designation', '');
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
            // View column for demandetype_documentfusion_designation field
            //
            $column = new TextViewColumn('demandetype_documentfusion_demandetype_documentfusion_id', 'demandetype_documentfusion_demandetype_documentfusion_id_demandetype_documentfusion_designation', 'Demandetype Documentfusion Demandetype Documentfusion Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for demandetype_designation field
            //
            $column = new TextViewColumn('demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'Demandetype Demandetype Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for demandetype_documentfusion_designation field
            //
            $column = new TextViewColumn('demandetype_documentfusion_demandetype_documentfusion_id', 'demandetype_documentfusion_demandetype_documentfusion_id_demandetype_documentfusion_designation', 'Demandetype Documentfusion Demandetype Documentfusion Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for demandetype_designation field
            //
            $column = new TextViewColumn('demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'Demandetype Demandetype Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for demandetype_documentfusion_designation field
            //
            $column = new TextViewColumn('demandetype_documentfusion_demandetype_documentfusion_id', 'demandetype_documentfusion_demandetype_documentfusion_id_demandetype_documentfusion_designation', 'Demandetype Documentfusion Demandetype Documentfusion Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for demandetype_designation field
            //
            $column = new TextViewColumn('demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'Demandetype Demandetype Id', $this->dataset);
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
                '`demandetype_documentfusion`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('demandetype_documentfusion_id', true, true),
                    new StringField('demandetype_documentfusion_designation'),
                    new StringField('demandetype_documentfusion_aide'),
                    new StringField('demandetype_documentfusion_emplacement')
                )
            );
            $lookupDataset->setOrderByField('demandetype_documentfusion_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_demandetype_documentfusion_demandetype_documentfusion_demandetype_demandetype_documentfusion_demandetype_documentfusion_id_search', 'demandetype_documentfusion_id', 'demandetype_documentfusion_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_demandetype_documentfusion_demandetype_documentfusion_demandetype_demandetype_demandetype_id_search', 'demandetype_id', 'demandetype_designation', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demandetype_documentfusion`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('demandetype_documentfusion_id', true, true),
                    new StringField('demandetype_documentfusion_designation'),
                    new StringField('demandetype_documentfusion_aide'),
                    new StringField('demandetype_documentfusion_emplacement')
                )
            );
            $lookupDataset->setOrderByField('demandetype_documentfusion_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_demandetype_documentfusion_demandetype_documentfusion_demandetype_demandetype_documentfusion_demandetype_documentfusion_id_search', 'demandetype_documentfusion_id', 'demandetype_documentfusion_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_demandetype_documentfusion_demandetype_documentfusion_demandetype_demandetype_demandetype_id_search', 'demandetype_id', 'demandetype_designation', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demandetype_documentfusion`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('demandetype_documentfusion_id', true, true),
                    new StringField('demandetype_documentfusion_designation'),
                    new StringField('demandetype_documentfusion_aide'),
                    new StringField('demandetype_documentfusion_emplacement')
                )
            );
            $lookupDataset->setOrderByField('demandetype_documentfusion_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_demandetype_documentfusion_demandetype_documentfusion_demandetype_demandetype_documentfusion_demandetype_documentfusion_id_search', 'demandetype_documentfusion_id', 'demandetype_documentfusion_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_demandetype_documentfusion_demandetype_documentfusion_demandetype_demandetype_demandetype_id_search', 'demandetype_id', 'demandetype_designation', null, 20);
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
    
    // OnBeforePageExecute event handler
    
    
    
    class demandetype_documentfusionPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Demandetype Documentfusion');
            $this->SetMenuLabel('Demandetype Documentfusion');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demandetype_documentfusion`');
            $this->dataset->addFields(
                array(
                    new IntegerField('demandetype_documentfusion_id', true, true),
                    new StringField('demandetype_documentfusion_designation'),
                    new StringField('demandetype_documentfusion_aide'),
                    new StringField('demandetype_documentfusion_emplacement')
                )
            );
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
                new FilterColumn($this->dataset, 'demandetype_documentfusion_id', 'demandetype_documentfusion_id', 'Demandetype Documentfusion Id'),
                new FilterColumn($this->dataset, 'demandetype_documentfusion_designation', 'demandetype_documentfusion_designation', 'Demandetype Documentfusion Designation'),
                new FilterColumn($this->dataset, 'demandetype_documentfusion_aide', 'demandetype_documentfusion_aide', 'Demandetype Documentfusion Aide'),
                new FilterColumn($this->dataset, 'demandetype_documentfusion_emplacement', 'demandetype_documentfusion_emplacement', 'Demandetype Documentfusion Emplacement')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['demandetype_documentfusion_id'])
                ->addColumn($columns['demandetype_documentfusion_designation'])
                ->addColumn($columns['demandetype_documentfusion_aide'])
                ->addColumn($columns['demandetype_documentfusion_emplacement']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('demandetype_documentfusion_id_edit');
            
            $filterBuilder->addColumn(
                $columns['demandetype_documentfusion_id'],
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
            
            $main_editor = new TextEdit('demandetype_documentfusion_designation_edit');
            $main_editor->SetMaxLength(45);
            
            $filterBuilder->addColumn(
                $columns['demandetype_documentfusion_designation'],
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
            
            $main_editor = new TextEdit('demandetype_documentfusion_aide');
            
            $filterBuilder->addColumn(
                $columns['demandetype_documentfusion_aide'],
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
            
            $main_editor = new TextEdit('demandetype_documentfusion_emplacement_edit');
            $main_editor->SetMaxLength(45);
            
            $filterBuilder->addColumn(
                $columns['demandetype_documentfusion_emplacement'],
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
            if (GetCurrentUserPermissionsForPage('demandetype_documentfusion.demandetype_documentfusion_demandetype')->HasViewGrant() && $withDetails)
            {
            //
            // View column for demandetype_documentfusion_demandetype_documentfusion_demandetype detail
            //
            $column = new DetailColumn(array('demandetype_documentfusion_id'), 'demandetype_documentfusion.demandetype_documentfusion_demandetype', 'demandetype_documentfusion_demandetype_documentfusion_demandetype_handler', $this->dataset, 'Demandetype Documentfusion Demandetype');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            //
            // View column for demandetype_documentfusion_id field
            //
            $column = new NumberViewColumn('demandetype_documentfusion_id', 'demandetype_documentfusion_id', 'Demandetype Documentfusion Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for demandetype_documentfusion_designation field
            //
            $column = new TextViewColumn('demandetype_documentfusion_designation', 'demandetype_documentfusion_designation', 'Demandetype Documentfusion Designation', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for demandetype_documentfusion_aide field
            //
            $column = new TextViewColumn('demandetype_documentfusion_aide', 'demandetype_documentfusion_aide', 'Demandetype Documentfusion Aide', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for demandetype_documentfusion_emplacement field
            //
            $column = new TextViewColumn('demandetype_documentfusion_emplacement', 'demandetype_documentfusion_emplacement', 'Demandetype Documentfusion Emplacement', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for demandetype_documentfusion_id field
            //
            $column = new NumberViewColumn('demandetype_documentfusion_id', 'demandetype_documentfusion_id', 'Demandetype Documentfusion Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for demandetype_documentfusion_designation field
            //
            $column = new TextViewColumn('demandetype_documentfusion_designation', 'demandetype_documentfusion_designation', 'Demandetype Documentfusion Designation', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for demandetype_documentfusion_aide field
            //
            $column = new TextViewColumn('demandetype_documentfusion_aide', 'demandetype_documentfusion_aide', 'Demandetype Documentfusion Aide', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for demandetype_documentfusion_emplacement field
            //
            $column = new TextViewColumn('demandetype_documentfusion_emplacement', 'demandetype_documentfusion_emplacement', 'Demandetype Documentfusion Emplacement', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for demandetype_documentfusion_id field
            //
            $editor = new TextEdit('demandetype_documentfusion_id_edit');
            $editColumn = new CustomEditColumn('Demandetype Documentfusion Id', 'demandetype_documentfusion_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for demandetype_documentfusion_designation field
            //
            $editor = new TextEdit('demandetype_documentfusion_designation_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Demandetype Documentfusion Designation', 'demandetype_documentfusion_designation', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for demandetype_documentfusion_aide field
            //
            $editor = new TextAreaEdit('demandetype_documentfusion_aide_edit', 50, 8);
            $editColumn = new CustomEditColumn('Demandetype Documentfusion Aide', 'demandetype_documentfusion_aide', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for demandetype_documentfusion_emplacement field
            //
            $editor = new TextEdit('demandetype_documentfusion_emplacement_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Demandetype Documentfusion Emplacement', 'demandetype_documentfusion_emplacement', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for demandetype_documentfusion_designation field
            //
            $editor = new TextEdit('demandetype_documentfusion_designation_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Demandetype Documentfusion Designation', 'demandetype_documentfusion_designation', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for demandetype_documentfusion_aide field
            //
            $editor = new TextAreaEdit('demandetype_documentfusion_aide_edit', 50, 8);
            $editColumn = new CustomEditColumn('Demandetype Documentfusion Aide', 'demandetype_documentfusion_aide', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for demandetype_documentfusion_emplacement field
            //
            $editor = new TextEdit('demandetype_documentfusion_emplacement_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Demandetype Documentfusion Emplacement', 'demandetype_documentfusion_emplacement', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for demandetype_documentfusion_id field
            //
            $editor = new TextEdit('demandetype_documentfusion_id_edit');
            $editColumn = new CustomEditColumn('Demandetype Documentfusion Id', 'demandetype_documentfusion_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for demandetype_documentfusion_designation field
            //
            $editor = new TextEdit('demandetype_documentfusion_designation_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Demandetype Documentfusion Designation', 'demandetype_documentfusion_designation', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for demandetype_documentfusion_aide field
            //
            $editor = new TextAreaEdit('demandetype_documentfusion_aide_edit', 50, 8);
            $editColumn = new CustomEditColumn('Demandetype Documentfusion Aide', 'demandetype_documentfusion_aide', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for demandetype_documentfusion_emplacement field
            //
            $editor = new TextEdit('demandetype_documentfusion_emplacement_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Demandetype Documentfusion Emplacement', 'demandetype_documentfusion_emplacement', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
            // View column for demandetype_documentfusion_id field
            //
            $column = new NumberViewColumn('demandetype_documentfusion_id', 'demandetype_documentfusion_id', 'Demandetype Documentfusion Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for demandetype_documentfusion_designation field
            //
            $column = new TextViewColumn('demandetype_documentfusion_designation', 'demandetype_documentfusion_designation', 'Demandetype Documentfusion Designation', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for demandetype_documentfusion_aide field
            //
            $column = new TextViewColumn('demandetype_documentfusion_aide', 'demandetype_documentfusion_aide', 'Demandetype Documentfusion Aide', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for demandetype_documentfusion_emplacement field
            //
            $column = new TextViewColumn('demandetype_documentfusion_emplacement', 'demandetype_documentfusion_emplacement', 'Demandetype Documentfusion Emplacement', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for demandetype_documentfusion_id field
            //
            $column = new NumberViewColumn('demandetype_documentfusion_id', 'demandetype_documentfusion_id', 'Demandetype Documentfusion Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for demandetype_documentfusion_designation field
            //
            $column = new TextViewColumn('demandetype_documentfusion_designation', 'demandetype_documentfusion_designation', 'Demandetype Documentfusion Designation', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for demandetype_documentfusion_aide field
            //
            $column = new TextViewColumn('demandetype_documentfusion_aide', 'demandetype_documentfusion_aide', 'Demandetype Documentfusion Aide', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for demandetype_documentfusion_emplacement field
            //
            $column = new TextViewColumn('demandetype_documentfusion_emplacement', 'demandetype_documentfusion_emplacement', 'Demandetype Documentfusion Emplacement', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for demandetype_documentfusion_id field
            //
            $column = new NumberViewColumn('demandetype_documentfusion_id', 'demandetype_documentfusion_id', 'Demandetype Documentfusion Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for demandetype_documentfusion_designation field
            //
            $column = new TextViewColumn('demandetype_documentfusion_designation', 'demandetype_documentfusion_designation', 'Demandetype Documentfusion Designation', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for demandetype_documentfusion_aide field
            //
            $column = new TextViewColumn('demandetype_documentfusion_aide', 'demandetype_documentfusion_aide', 'Demandetype Documentfusion Aide', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for demandetype_documentfusion_emplacement field
            //
            $column = new TextViewColumn('demandetype_documentfusion_emplacement', 'demandetype_documentfusion_emplacement', 'Demandetype Documentfusion Emplacement', $this->dataset);
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
    
        function CreateMasterDetailRecordGrid()
        {
            $result = new Grid($this, $this->dataset);
            
            $this->AddFieldColumns($result, false);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            
            $result->SetAllowDeleteSelected(false);
            $result->SetShowUpdateLink(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(false);
            $result->setTableBordered(true);
            $result->setTableCondensed(true);
            
            $this->setupGridColumnGroup($result);
            $this->attachGridEventHandlers($result);
            
            return $result;
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
            $detailPage = new demandetype_documentfusion_demandetype_documentfusion_demandetypePage('demandetype_documentfusion_demandetype_documentfusion_demandetype', $this, array('demandetype_documentfusion_demandetype_documentfusion_id'), array('demandetype_documentfusion_id'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionsForPage('demandetype_documentfusion.demandetype_documentfusion_demandetype'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('demandetype_documentfusion.demandetype_documentfusion_demandetype'));
            $detailPage->SetHttpHandlerName('demandetype_documentfusion_demandetype_documentfusion_demandetype_handler');
            $handler = new PageHTTPHandler('demandetype_documentfusion_demandetype_documentfusion_demandetype_handler', $detailPage);
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
        $Page = new demandetype_documentfusionPage("demandetype_documentfusion", "demandetype_documentfusion.php", GetCurrentUserPermissionsForPage("demandetype_documentfusion"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("demandetype_documentfusion"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
