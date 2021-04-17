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
    
    
    
    class demandetype_notification_auto_demandetype_notification_auto_configurationPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Demandetype Notification Auto Configuration');
            $this->SetMenuLabel('Demandetype Notification Auto Configuration');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demandetype_notification_auto_configuration`');
            $this->dataset->addFields(
                array(
                    new IntegerField('zoneadministrative_id', true, true),
                    new IntegerField('fonction_id', true, true),
                    new IntegerField('demandegravite_id', true, true),
                    new IntegerField('demandetype_id', true, true),
                    new IntegerField('demandestatut_id', true, true)
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
                new FilterColumn($this->dataset, 'zoneadministrative_id', 'zoneadministrative_id', 'Zoneadministrative Id'),
                new FilterColumn($this->dataset, 'fonction_id', 'fonction_id', 'Fonction Id'),
                new FilterColumn($this->dataset, 'demandegravite_id', 'demandegravite_id', 'Demandegravite Id'),
                new FilterColumn($this->dataset, 'demandetype_id', 'demandetype_id', 'Demandetype Id'),
                new FilterColumn($this->dataset, 'demandestatut_id', 'demandestatut_id', 'Demandestatut Id')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['zoneadministrative_id'])
                ->addColumn($columns['fonction_id'])
                ->addColumn($columns['demandegravite_id'])
                ->addColumn($columns['demandetype_id'])
                ->addColumn($columns['demandestatut_id']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('zoneadministrative_id_edit');
            
            $filterBuilder->addColumn(
                $columns['zoneadministrative_id'],
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
            
            $main_editor = new TextEdit('fonction_id_edit');
            
            $filterBuilder->addColumn(
                $columns['fonction_id'],
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
            
            $main_editor = new TextEdit('demandegravite_id_edit');
            
            $filterBuilder->addColumn(
                $columns['demandegravite_id'],
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
            
            $main_editor = new TextEdit('demandetype_id_edit');
            
            $filterBuilder->addColumn(
                $columns['demandetype_id'],
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
            
            $main_editor = new TextEdit('demandestatut_id_edit');
            
            $filterBuilder->addColumn(
                $columns['demandestatut_id'],
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
            // View column for zoneadministrative_id field
            //
            $column = new NumberViewColumn('zoneadministrative_id', 'zoneadministrative_id', 'Zoneadministrative Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for fonction_id field
            //
            $column = new NumberViewColumn('fonction_id', 'fonction_id', 'Fonction Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for demandegravite_id field
            //
            $column = new NumberViewColumn('demandegravite_id', 'demandegravite_id', 'Demandegravite Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for demandetype_id field
            //
            $column = new NumberViewColumn('demandetype_id', 'demandetype_id', 'Demandetype Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for demandestatut_id field
            //
            $column = new NumberViewColumn('demandestatut_id', 'demandestatut_id', 'Demandestatut Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for zoneadministrative_id field
            //
            $column = new NumberViewColumn('zoneadministrative_id', 'zoneadministrative_id', 'Zoneadministrative Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for fonction_id field
            //
            $column = new NumberViewColumn('fonction_id', 'fonction_id', 'Fonction Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for demandegravite_id field
            //
            $column = new NumberViewColumn('demandegravite_id', 'demandegravite_id', 'Demandegravite Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for demandetype_id field
            //
            $column = new NumberViewColumn('demandetype_id', 'demandetype_id', 'Demandetype Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for demandestatut_id field
            //
            $column = new NumberViewColumn('demandestatut_id', 'demandestatut_id', 'Demandestatut Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for zoneadministrative_id field
            //
            $editor = new TextEdit('zoneadministrative_id_edit');
            $editColumn = new CustomEditColumn('Zoneadministrative Id', 'zoneadministrative_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for fonction_id field
            //
            $editor = new TextEdit('fonction_id_edit');
            $editColumn = new CustomEditColumn('Fonction Id', 'fonction_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for demandegravite_id field
            //
            $editor = new TextEdit('demandegravite_id_edit');
            $editColumn = new CustomEditColumn('Demandegravite Id', 'demandegravite_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for demandetype_id field
            //
            $editor = new TextEdit('demandetype_id_edit');
            $editColumn = new CustomEditColumn('Demandetype Id', 'demandetype_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for demandestatut_id field
            //
            $editor = new TextEdit('demandestatut_id_edit');
            $editColumn = new CustomEditColumn('Demandestatut Id', 'demandestatut_id', $editor, $this->dataset);
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
            // Edit column for zoneadministrative_id field
            //
            $editor = new TextEdit('zoneadministrative_id_edit');
            $editColumn = new CustomEditColumn('Zoneadministrative Id', 'zoneadministrative_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for fonction_id field
            //
            $editor = new TextEdit('fonction_id_edit');
            $editColumn = new CustomEditColumn('Fonction Id', 'fonction_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for demandegravite_id field
            //
            $editor = new TextEdit('demandegravite_id_edit');
            $editColumn = new CustomEditColumn('Demandegravite Id', 'demandegravite_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for demandetype_id field
            //
            $editor = new TextEdit('demandetype_id_edit');
            $editColumn = new CustomEditColumn('Demandetype Id', 'demandetype_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for demandestatut_id field
            //
            $editor = new TextEdit('demandestatut_id_edit');
            $editColumn = new CustomEditColumn('Demandestatut Id', 'demandestatut_id', $editor, $this->dataset);
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
            // View column for zoneadministrative_id field
            //
            $column = new NumberViewColumn('zoneadministrative_id', 'zoneadministrative_id', 'Zoneadministrative Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for fonction_id field
            //
            $column = new NumberViewColumn('fonction_id', 'fonction_id', 'Fonction Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for demandegravite_id field
            //
            $column = new NumberViewColumn('demandegravite_id', 'demandegravite_id', 'Demandegravite Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for demandetype_id field
            //
            $column = new NumberViewColumn('demandetype_id', 'demandetype_id', 'Demandetype Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for demandestatut_id field
            //
            $column = new NumberViewColumn('demandestatut_id', 'demandestatut_id', 'Demandestatut Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for zoneadministrative_id field
            //
            $column = new NumberViewColumn('zoneadministrative_id', 'zoneadministrative_id', 'Zoneadministrative Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for fonction_id field
            //
            $column = new NumberViewColumn('fonction_id', 'fonction_id', 'Fonction Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for demandegravite_id field
            //
            $column = new NumberViewColumn('demandegravite_id', 'demandegravite_id', 'Demandegravite Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for demandetype_id field
            //
            $column = new NumberViewColumn('demandetype_id', 'demandetype_id', 'Demandetype Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for demandestatut_id field
            //
            $column = new NumberViewColumn('demandestatut_id', 'demandestatut_id', 'Demandestatut Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for zoneadministrative_id field
            //
            $column = new NumberViewColumn('zoneadministrative_id', 'zoneadministrative_id', 'Zoneadministrative Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for fonction_id field
            //
            $column = new NumberViewColumn('fonction_id', 'fonction_id', 'Fonction Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for demandegravite_id field
            //
            $column = new NumberViewColumn('demandegravite_id', 'demandegravite_id', 'Demandegravite Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for demandetype_id field
            //
            $column = new NumberViewColumn('demandetype_id', 'demandetype_id', 'Demandetype Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for demandestatut_id field
            //
            $column = new NumberViewColumn('demandestatut_id', 'demandestatut_id', 'Demandestatut Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
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
    
    
    
    class demandetype_notification_autoPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Demandetype Notification Auto');
            $this->SetMenuLabel('Demandetype Notification Auto');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demandetype_notification_auto`');
            $this->dataset->addFields(
                array(
                    new IntegerField('demandegravite_demandegravite_id', true, true),
                    new IntegerField('demandetype_demandetype_id', true, true),
                    new IntegerField('demandestatut_demandestatut_id', true, true)
                )
            );
            $this->dataset->AddLookupField('demandegravite_demandegravite_id', 'demandegravite', new IntegerField('demandegravite_id'), new StringField('demandegravite_designation', false, false, false, false, 'demandegravite_demandegravite_id_demandegravite_designation', 'demandegravite_demandegravite_id_demandegravite_designation_demandegravite'), 'demandegravite_demandegravite_id_demandegravite_designation_demandegravite');
            $this->dataset->AddLookupField('demandetype_demandetype_id', 'demandetype', new IntegerField('demandetype_id'), new StringField('demandetype_designation', false, false, false, false, 'demandetype_demandetype_id_demandetype_designation', 'demandetype_demandetype_id_demandetype_designation_demandetype'), 'demandetype_demandetype_id_demandetype_designation_demandetype');
            $this->dataset->AddLookupField('demandestatut_demandestatut_id', 'demandestatut', new IntegerField('demandestatut_id'), new StringField('demandestatut_designation', false, false, false, false, 'demandestatut_demandestatut_id_demandestatut_designation', 'demandestatut_demandestatut_id_demandestatut_designation_demandestatut'), 'demandestatut_demandestatut_id_demandestatut_designation_demandestatut');
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
                new FilterColumn($this->dataset, 'demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Demandegravite Demandegravite Id'),
                new FilterColumn($this->dataset, 'demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'Demandetype Demandetype Id'),
                new FilterColumn($this->dataset, 'demandestatut_demandestatut_id', 'demandestatut_demandestatut_id_demandestatut_designation', 'Demandestatut Demandestatut Id')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['demandegravite_demandegravite_id'])
                ->addColumn($columns['demandetype_demandetype_id'])
                ->addColumn($columns['demandestatut_demandestatut_id']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('demandegravite_demandegravite_id')
                ->setOptionsFor('demandetype_demandetype_id')
                ->setOptionsFor('demandestatut_demandestatut_id');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new DynamicCombobox('demandegravite_demandegravite_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_demandetype_notification_auto_demandegravite_demandegravite_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('demandegravite_demandegravite_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_demandetype_notification_auto_demandegravite_demandegravite_id_search');
            
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
            
            $main_editor = new DynamicCombobox('demandetype_demandetype_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_demandetype_notification_auto_demandetype_demandetype_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('demandetype_demandetype_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_demandetype_notification_auto_demandetype_demandetype_id_search');
            
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
            
            $main_editor = new DynamicCombobox('demandestatut_demandestatut_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_demandetype_notification_auto_demandestatut_demandestatut_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('demandestatut_demandestatut_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_demandetype_notification_auto_demandestatut_demandestatut_id_search');
            
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
            if (GetCurrentUserPermissionsForPage('demandetype_notification_auto.demandetype_notification_auto_configuration')->HasViewGrant() && $withDetails)
            {
            //
            // View column for demandetype_notification_auto_demandetype_notification_auto_configuration detail
            //
            $column = new DetailColumn(array('demandegravite_demandegravite_id', 'demandestatut_demandestatut_id', 'demandetype_demandetype_id'), 'demandetype_notification_auto.demandetype_notification_auto_configuration', 'demandetype_notification_auto_demandetype_notification_auto_configuration_handler', $this->dataset, 'Demandetype Notification Auto Configuration');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            //
            // View column for demandegravite_designation field
            //
            $column = new TextViewColumn('demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Demandegravite Demandegravite Id', $this->dataset);
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
            
            //
            // View column for demandestatut_designation field
            //
            $column = new TextViewColumn('demandestatut_demandestatut_id', 'demandestatut_demandestatut_id_demandestatut_designation', 'Demandestatut Demandestatut Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for demandegravite_designation field
            //
            $column = new TextViewColumn('demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Demandegravite Demandegravite Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for demandetype_designation field
            //
            $column = new TextViewColumn('demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'Demandetype Demandetype Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for demandestatut_designation field
            //
            $column = new TextViewColumn('demandestatut_demandestatut_id', 'demandestatut_demandestatut_id_demandestatut_designation', 'Demandestatut Demandestatut Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
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
            $editColumn = new DynamicLookupEditColumn('Demandegravite Demandegravite Id', 'demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'edit_demandetype_notification_auto_demandegravite_demandegravite_id_search', $editor, $this->dataset, $lookupDataset, 'demandegravite_id', 'demandegravite_designation', '');
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
            $editColumn = new DynamicLookupEditColumn('Demandetype Demandetype Id', 'demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'edit_demandetype_notification_auto_demandetype_demandetype_id_search', $editor, $this->dataset, $lookupDataset, 'demandetype_id', 'demandetype_designation', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            $editColumn = new DynamicLookupEditColumn('Demandestatut Demandestatut Id', 'demandestatut_demandestatut_id', 'demandestatut_demandestatut_id_demandestatut_designation', 'edit_demandetype_notification_auto_demandestatut_demandestatut_id_search', $editor, $this->dataset, $lookupDataset, 'demandestatut_id', 'demandestatut_designation', '');
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
            $editColumn = new DynamicLookupEditColumn('Demandegravite Demandegravite Id', 'demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'insert_demandetype_notification_auto_demandegravite_demandegravite_id_search', $editor, $this->dataset, $lookupDataset, 'demandegravite_id', 'demandegravite_designation', '');
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
            $editColumn = new DynamicLookupEditColumn('Demandetype Demandetype Id', 'demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'insert_demandetype_notification_auto_demandetype_demandetype_id_search', $editor, $this->dataset, $lookupDataset, 'demandetype_id', 'demandetype_designation', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            $editColumn = new DynamicLookupEditColumn('Demandestatut Demandestatut Id', 'demandestatut_demandestatut_id', 'demandestatut_demandestatut_id_demandestatut_designation', 'insert_demandetype_notification_auto_demandestatut_demandestatut_id_search', $editor, $this->dataset, $lookupDataset, 'demandestatut_id', 'demandestatut_designation', '');
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
            // View column for demandegravite_designation field
            //
            $column = new TextViewColumn('demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Demandegravite Demandegravite Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for demandetype_designation field
            //
            $column = new TextViewColumn('demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'Demandetype Demandetype Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for demandestatut_designation field
            //
            $column = new TextViewColumn('demandestatut_demandestatut_id', 'demandestatut_demandestatut_id_demandestatut_designation', 'Demandestatut Demandestatut Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for demandegravite_designation field
            //
            $column = new TextViewColumn('demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Demandegravite Demandegravite Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for demandetype_designation field
            //
            $column = new TextViewColumn('demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'Demandetype Demandetype Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for demandestatut_designation field
            //
            $column = new TextViewColumn('demandestatut_demandestatut_id', 'demandestatut_demandestatut_id_demandestatut_designation', 'Demandestatut Demandestatut Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for demandegravite_designation field
            //
            $column = new TextViewColumn('demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Demandegravite Demandegravite Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for demandetype_designation field
            //
            $column = new TextViewColumn('demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'Demandetype Demandetype Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for demandestatut_designation field
            //
            $column = new TextViewColumn('demandestatut_demandestatut_id', 'demandestatut_demandestatut_id_demandestatut_designation', 'Demandestatut Demandestatut Id', $this->dataset);
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
            $detailPage = new demandetype_notification_auto_demandetype_notification_auto_configurationPage('demandetype_notification_auto_demandetype_notification_auto_configuration', $this, array('demandegravite_id', 'demandestatut_id', 'demandetype_id'), array('demandegravite_demandegravite_id', 'demandestatut_demandestatut_id', 'demandetype_demandetype_id'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionsForPage('demandetype_notification_auto.demandetype_notification_auto_configuration'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('demandetype_notification_auto.demandetype_notification_auto_configuration'));
            $detailPage->SetHttpHandlerName('demandetype_notification_auto_demandetype_notification_auto_configuration_handler');
            $handler = new PageHTTPHandler('demandetype_notification_auto_demandetype_notification_auto_configuration_handler', $detailPage);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_demandetype_notification_auto_demandegravite_demandegravite_id_search', 'demandegravite_id', 'demandegravite_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_demandetype_notification_auto_demandetype_demandetype_id_search', 'demandetype_id', 'demandetype_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_demandetype_notification_auto_demandestatut_demandestatut_id_search', 'demandestatut_id', 'demandestatut_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_demandetype_notification_auto_demandegravite_demandegravite_id_search', 'demandegravite_id', 'demandegravite_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_demandetype_notification_auto_demandetype_demandetype_id_search', 'demandetype_id', 'demandetype_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_demandetype_notification_auto_demandestatut_demandestatut_id_search', 'demandestatut_id', 'demandestatut_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_demandetype_notification_auto_demandegravite_demandegravite_id_search', 'demandegravite_id', 'demandegravite_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_demandetype_notification_auto_demandetype_demandetype_id_search', 'demandetype_id', 'demandetype_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_demandetype_notification_auto_demandestatut_demandestatut_id_search', 'demandestatut_id', 'demandestatut_designation', null, 20);
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
        $Page = new demandetype_notification_autoPage("demandetype_notification_auto", "demandetype_notification_auto.php", GetCurrentUserPermissionsForPage("demandetype_notification_auto"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("demandetype_notification_auto"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
