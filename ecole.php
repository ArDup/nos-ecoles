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
    
    
    
    class ecole_demande_ameliorationPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Demande Amelioration');
            $this->SetMenuLabel('Demande Amelioration');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demande_amelioration`');
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
            $this->dataset->AddLookupField('demandestatut_demandestatut_id', 'demandestatut', new IntegerField('demandestatut_id'), new StringField('demandestatut_designation', false, false, false, false, 'demandestatut_demandestatut_id_demandestatut_designation', 'demandestatut_demandestatut_id_demandestatut_designation_demandestatut'), 'demandestatut_demandestatut_id_demandestatut_designation_demandestatut');
            $this->dataset->AddLookupField('demandegravite_demandegravite_id', 'demandegravite', new IntegerField('demandegravite_id'), new StringField('demandegravite_designation', false, false, false, false, 'demandegravite_demandegravite_id_demandegravite_designation', 'demandegravite_demandegravite_id_demandegravite_designation_demandegravite'), 'demandegravite_demandegravite_id_demandegravite_designation_demandegravite');
            $this->dataset->AddLookupField('ecole_ecole_id', 'ecole', new IntegerField('ecole_id'), new StringField('ecole_RNE', false, false, false, false, 'ecole_ecole_id_ecole_RNE', 'ecole_ecole_id_ecole_RNE_ecole'), 'ecole_ecole_id_ecole_RNE_ecole');
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
                new FilterColumn($this->dataset, 'demande_id', 'demande_id', 'Demande Id'),
                new FilterColumn($this->dataset, 'demande_objet', 'demande_objet', 'Demande Objet'),
                new FilterColumn($this->dataset, 'demande_description', 'demande_description', 'Demande Description'),
                new FilterColumn($this->dataset, 'demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'Demandetype Demandetype Id'),
                new FilterColumn($this->dataset, 'demandestatut_demandestatut_id', 'demandestatut_demandestatut_id_demandestatut_designation', 'Demandestatut Demandestatut Id'),
                new FilterColumn($this->dataset, 'demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Demandegravite Demandegravite Id'),
                new FilterColumn($this->dataset, 'ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['demande_id'])
                ->addColumn($columns['demande_objet'])
                ->addColumn($columns['demande_description'])
                ->addColumn($columns['demandetype_demandetype_id'])
                ->addColumn($columns['demandestatut_demandestatut_id'])
                ->addColumn($columns['demandegravite_demandegravite_id'])
                ->addColumn($columns['ecole_ecole_id']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('demandetype_demandetype_id')
                ->setOptionsFor('demandestatut_demandestatut_id')
                ->setOptionsFor('demandegravite_demandegravite_id')
                ->setOptionsFor('ecole_ecole_id');
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
            
            $main_editor = new DynamicCombobox('demandetype_demandetype_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_ecole_demande_amelioration_demandetype_demandetype_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('demandetype_demandetype_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_ecole_demande_amelioration_demandetype_demandetype_id_search');
            
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
            $main_editor->SetHandlerName('filter_builder_ecole_demande_amelioration_demandestatut_demandestatut_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('demandestatut_demandestatut_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_ecole_demande_amelioration_demandestatut_demandestatut_id_search');
            
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
            $main_editor->SetHandlerName('filter_builder_ecole_demande_amelioration_demandegravite_demandegravite_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('demandegravite_demandegravite_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_ecole_demande_amelioration_demandegravite_demandegravite_id_search');
            
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
            
            $main_editor = new DynamicCombobox('ecole_ecole_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_ecole_demande_amelioration_ecole_ecole_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('ecole_ecole_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_ecole_demande_amelioration_ecole_ecole_id_search');
            
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
            $column = new NumberViewColumn('demande_id', 'demande_id', 'Demande Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for demande_objet field
            //
            $column = new TextViewColumn('demande_objet', 'demande_objet', 'Demande Objet', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for demande_description field
            //
            $column = new TextViewColumn('demande_description', 'demande_description', 'Demande Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
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
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id', $this->dataset);
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
            $column = new NumberViewColumn('demande_id', 'demande_id', 'Demande Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for demande_objet field
            //
            $column = new TextViewColumn('demande_objet', 'demande_objet', 'Demande Objet', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for demande_description field
            //
            $column = new TextViewColumn('demande_description', 'demande_description', 'Demande Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
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
            
            //
            // View column for demandegravite_designation field
            //
            $column = new TextViewColumn('demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Demandegravite Demandegravite Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for demande_objet field
            //
            $editor = new TextEdit('demande_objet_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Demande Objet', 'demande_objet', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for demande_description field
            //
            $editor = new TextAreaEdit('demande_description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Demande Description', 'demande_description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
            $editColumn = new DynamicLookupEditColumn('Demandetype Demandetype Id', 'demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'edit_ecole_demande_amelioration_demandetype_demandetype_id_search', $editor, $this->dataset, $lookupDataset, 'demandetype_id', 'demandetype_designation', '');
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
            $editColumn = new DynamicLookupEditColumn('Demandestatut Demandestatut Id', 'demandestatut_demandestatut_id', 'demandestatut_demandestatut_id_demandestatut_designation', 'edit_ecole_demande_amelioration_demandestatut_demandestatut_id_search', $editor, $this->dataset, $lookupDataset, 'demandestatut_id', 'demandestatut_designation', '');
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
            $editColumn = new DynamicLookupEditColumn('Demandegravite Demandegravite Id', 'demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'edit_ecole_demande_amelioration_demandegravite_demandegravite_id_search', $editor, $this->dataset, $lookupDataset, 'demandegravite_id', 'demandegravite_designation', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_ecole_id field
            //
            $editor = new DynamicCombobox('ecole_ecole_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
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
            $lookupDataset->setOrderByField('ecole_RNE', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Ecole Ecole Id', 'ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'edit_ecole_demande_amelioration_ecole_ecole_id_search', $editor, $this->dataset, $lookupDataset, 'ecole_id', 'ecole_RNE', '');
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
            $editColumn = new CustomEditColumn('Demande Objet', 'demande_objet', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for demande_description field
            //
            $editor = new TextAreaEdit('demande_description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Demande Description', 'demande_description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for demande_objet field
            //
            $editor = new TextEdit('demande_objet_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Demande Objet', 'demande_objet', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for demande_description field
            //
            $editor = new TextAreaEdit('demande_description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Demande Description', 'demande_description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
            $editColumn = new DynamicLookupEditColumn('Demandetype Demandetype Id', 'demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'insert_ecole_demande_amelioration_demandetype_demandetype_id_search', $editor, $this->dataset, $lookupDataset, 'demandetype_id', 'demandetype_designation', '');
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
            $editColumn = new DynamicLookupEditColumn('Demandestatut Demandestatut Id', 'demandestatut_demandestatut_id', 'demandestatut_demandestatut_id_demandestatut_designation', 'insert_ecole_demande_amelioration_demandestatut_demandestatut_id_search', $editor, $this->dataset, $lookupDataset, 'demandestatut_id', 'demandestatut_designation', '');
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
            $editColumn = new DynamicLookupEditColumn('Demandegravite Demandegravite Id', 'demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'insert_ecole_demande_amelioration_demandegravite_demandegravite_id_search', $editor, $this->dataset, $lookupDataset, 'demandegravite_id', 'demandegravite_designation', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_ecole_id field
            //
            $editor = new DynamicCombobox('ecole_ecole_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
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
            $lookupDataset->setOrderByField('ecole_RNE', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Ecole Ecole Id', 'ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'insert_ecole_demande_amelioration_ecole_ecole_id_search', $editor, $this->dataset, $lookupDataset, 'ecole_id', 'ecole_RNE', '');
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
            $column = new NumberViewColumn('demande_id', 'demande_id', 'Demande Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for demande_objet field
            //
            $column = new TextViewColumn('demande_objet', 'demande_objet', 'Demande Objet', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for demande_description field
            //
            $column = new TextViewColumn('demande_description', 'demande_description', 'Demande Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
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
            
            //
            // View column for demandegravite_designation field
            //
            $column = new TextViewColumn('demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Demandegravite Demandegravite Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for demande_id field
            //
            $column = new NumberViewColumn('demande_id', 'demande_id', 'Demande Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for demande_objet field
            //
            $column = new TextViewColumn('demande_objet', 'demande_objet', 'Demande Objet', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for demande_description field
            //
            $column = new TextViewColumn('demande_description', 'demande_description', 'Demande Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
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
            
            //
            // View column for demandegravite_designation field
            //
            $column = new TextViewColumn('demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Demandegravite Demandegravite Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for demande_objet field
            //
            $column = new TextViewColumn('demande_objet', 'demande_objet', 'Demande Objet', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for demande_description field
            //
            $column = new TextViewColumn('demande_description', 'demande_description', 'Demande Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
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
            
            //
            // View column for demandegravite_designation field
            //
            $column = new TextViewColumn('demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Demandegravite Demandegravite Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id', $this->dataset);
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
                '`demandetype`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('demandetype_id', true, true),
                    new StringField('demandetype_designation')
                )
            );
            $lookupDataset->setOrderByField('demandetype_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_ecole_demande_amelioration_demandetype_demandetype_id_search', 'demandetype_id', 'demandetype_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_ecole_demande_amelioration_demandestatut_demandestatut_id_search', 'demandestatut_id', 'demandestatut_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_ecole_demande_amelioration_demandegravite_demandegravite_id_search', 'demandegravite_id', 'demandegravite_designation', null, 20);
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
            $lookupDataset->setOrderByField('ecole_RNE', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_ecole_demande_amelioration_ecole_ecole_id_search', 'ecole_id', 'ecole_RNE', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_ecole_demande_amelioration_demandetype_demandetype_id_search', 'demandetype_id', 'demandetype_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_ecole_demande_amelioration_demandestatut_demandestatut_id_search', 'demandestatut_id', 'demandestatut_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_ecole_demande_amelioration_demandegravite_demandegravite_id_search', 'demandegravite_id', 'demandegravite_designation', null, 20);
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
            $lookupDataset->setOrderByField('ecole_RNE', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_ecole_demande_amelioration_ecole_ecole_id_search', 'ecole_id', 'ecole_RNE', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_ecole_demande_amelioration_demandetype_demandetype_id_search', 'demandetype_id', 'demandetype_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_ecole_demande_amelioration_demandestatut_demandestatut_id_search', 'demandestatut_id', 'demandestatut_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_ecole_demande_amelioration_demandegravite_demandegravite_id_search', 'demandegravite_id', 'demandegravite_designation', null, 20);
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
            $lookupDataset->setOrderByField('ecole_RNE', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_ecole_demande_amelioration_ecole_ecole_id_search', 'ecole_id', 'ecole_RNE', null, 20);
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
    
    
    
    class ecole_demande_interventionPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Demande Intervention');
            $this->SetMenuLabel('Demande Intervention');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demande_intervention`');
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
            $this->dataset->AddLookupField('demandestatut_demandestatut_id', 'demandestatut', new IntegerField('demandestatut_id'), new StringField('demandestatut_designation', false, false, false, false, 'demandestatut_demandestatut_id_demandestatut_designation', 'demandestatut_demandestatut_id_demandestatut_designation_demandestatut'), 'demandestatut_demandestatut_id_demandestatut_designation_demandestatut');
            $this->dataset->AddLookupField('demandegravite_demandegravite_id', 'demandegravite', new IntegerField('demandegravite_id'), new StringField('demandegravite_designation', false, false, false, false, 'demandegravite_demandegravite_id_demandegravite_designation', 'demandegravite_demandegravite_id_demandegravite_designation_demandegravite'), 'demandegravite_demandegravite_id_demandegravite_designation_demandegravite');
            $this->dataset->AddLookupField('ecole_ecole_id', 'ecole', new IntegerField('ecole_id'), new StringField('ecole_RNE', false, false, false, false, 'ecole_ecole_id_ecole_RNE', 'ecole_ecole_id_ecole_RNE_ecole'), 'ecole_ecole_id_ecole_RNE_ecole');
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
                new FilterColumn($this->dataset, 'demande_id', 'demande_id', 'Demande Id'),
                new FilterColumn($this->dataset, 'demande_objet', 'demande_objet', 'Demande Objet'),
                new FilterColumn($this->dataset, 'demande_description', 'demande_description', 'Demande Description'),
                new FilterColumn($this->dataset, 'demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'Demandetype Demandetype Id'),
                new FilterColumn($this->dataset, 'demandestatut_demandestatut_id', 'demandestatut_demandestatut_id_demandestatut_designation', 'Demandestatut Demandestatut Id'),
                new FilterColumn($this->dataset, 'demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Demandegravite Demandegravite Id'),
                new FilterColumn($this->dataset, 'ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['demande_id'])
                ->addColumn($columns['demande_objet'])
                ->addColumn($columns['demande_description'])
                ->addColumn($columns['demandetype_demandetype_id'])
                ->addColumn($columns['demandestatut_demandestatut_id'])
                ->addColumn($columns['demandegravite_demandegravite_id'])
                ->addColumn($columns['ecole_ecole_id']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('demandetype_demandetype_id')
                ->setOptionsFor('demandestatut_demandestatut_id')
                ->setOptionsFor('demandegravite_demandegravite_id')
                ->setOptionsFor('ecole_ecole_id');
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
            
            $main_editor = new DynamicCombobox('demandetype_demandetype_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_ecole_demande_intervention_demandetype_demandetype_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('demandetype_demandetype_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_ecole_demande_intervention_demandetype_demandetype_id_search');
            
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
            $main_editor->SetHandlerName('filter_builder_ecole_demande_intervention_demandestatut_demandestatut_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('demandestatut_demandestatut_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_ecole_demande_intervention_demandestatut_demandestatut_id_search');
            
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
            $main_editor->SetHandlerName('filter_builder_ecole_demande_intervention_demandegravite_demandegravite_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('demandegravite_demandegravite_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_ecole_demande_intervention_demandegravite_demandegravite_id_search');
            
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
            
            $main_editor = new DynamicCombobox('ecole_ecole_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_ecole_demande_intervention_ecole_ecole_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('ecole_ecole_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_ecole_demande_intervention_ecole_ecole_id_search');
            
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
            $column = new NumberViewColumn('demande_id', 'demande_id', 'Demande Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for demande_objet field
            //
            $column = new TextViewColumn('demande_objet', 'demande_objet', 'Demande Objet', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for demande_description field
            //
            $column = new TextViewColumn('demande_description', 'demande_description', 'Demande Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
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
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id', $this->dataset);
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
            $column = new NumberViewColumn('demande_id', 'demande_id', 'Demande Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for demande_objet field
            //
            $column = new TextViewColumn('demande_objet', 'demande_objet', 'Demande Objet', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for demande_description field
            //
            $column = new TextViewColumn('demande_description', 'demande_description', 'Demande Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
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
            
            //
            // View column for demandegravite_designation field
            //
            $column = new TextViewColumn('demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Demandegravite Demandegravite Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for demande_objet field
            //
            $editor = new TextEdit('demande_objet_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Demande Objet', 'demande_objet', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for demande_description field
            //
            $editor = new TextAreaEdit('demande_description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Demande Description', 'demande_description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
            $editColumn = new DynamicLookupEditColumn('Demandetype Demandetype Id', 'demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'edit_ecole_demande_intervention_demandetype_demandetype_id_search', $editor, $this->dataset, $lookupDataset, 'demandetype_id', 'demandetype_designation', '');
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
            $editColumn = new DynamicLookupEditColumn('Demandestatut Demandestatut Id', 'demandestatut_demandestatut_id', 'demandestatut_demandestatut_id_demandestatut_designation', 'edit_ecole_demande_intervention_demandestatut_demandestatut_id_search', $editor, $this->dataset, $lookupDataset, 'demandestatut_id', 'demandestatut_designation', '');
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
            $editColumn = new DynamicLookupEditColumn('Demandegravite Demandegravite Id', 'demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'edit_ecole_demande_intervention_demandegravite_demandegravite_id_search', $editor, $this->dataset, $lookupDataset, 'demandegravite_id', 'demandegravite_designation', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_ecole_id field
            //
            $editor = new DynamicCombobox('ecole_ecole_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
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
            $lookupDataset->setOrderByField('ecole_RNE', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Ecole Ecole Id', 'ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'edit_ecole_demande_intervention_ecole_ecole_id_search', $editor, $this->dataset, $lookupDataset, 'ecole_id', 'ecole_RNE', '');
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
            $editColumn = new CustomEditColumn('Demande Objet', 'demande_objet', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for demande_description field
            //
            $editor = new TextAreaEdit('demande_description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Demande Description', 'demande_description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for demande_objet field
            //
            $editor = new TextEdit('demande_objet_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Demande Objet', 'demande_objet', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for demande_description field
            //
            $editor = new TextAreaEdit('demande_description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Demande Description', 'demande_description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
            $editColumn = new DynamicLookupEditColumn('Demandetype Demandetype Id', 'demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'insert_ecole_demande_intervention_demandetype_demandetype_id_search', $editor, $this->dataset, $lookupDataset, 'demandetype_id', 'demandetype_designation', '');
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
            $editColumn = new DynamicLookupEditColumn('Demandestatut Demandestatut Id', 'demandestatut_demandestatut_id', 'demandestatut_demandestatut_id_demandestatut_designation', 'insert_ecole_demande_intervention_demandestatut_demandestatut_id_search', $editor, $this->dataset, $lookupDataset, 'demandestatut_id', 'demandestatut_designation', '');
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
            $editColumn = new DynamicLookupEditColumn('Demandegravite Demandegravite Id', 'demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'insert_ecole_demande_intervention_demandegravite_demandegravite_id_search', $editor, $this->dataset, $lookupDataset, 'demandegravite_id', 'demandegravite_designation', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_ecole_id field
            //
            $editor = new DynamicCombobox('ecole_ecole_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
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
            $lookupDataset->setOrderByField('ecole_RNE', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Ecole Ecole Id', 'ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'insert_ecole_demande_intervention_ecole_ecole_id_search', $editor, $this->dataset, $lookupDataset, 'ecole_id', 'ecole_RNE', '');
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
            $column = new NumberViewColumn('demande_id', 'demande_id', 'Demande Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for demande_objet field
            //
            $column = new TextViewColumn('demande_objet', 'demande_objet', 'Demande Objet', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for demande_description field
            //
            $column = new TextViewColumn('demande_description', 'demande_description', 'Demande Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
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
            
            //
            // View column for demandegravite_designation field
            //
            $column = new TextViewColumn('demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Demandegravite Demandegravite Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for demande_id field
            //
            $column = new NumberViewColumn('demande_id', 'demande_id', 'Demande Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for demande_objet field
            //
            $column = new TextViewColumn('demande_objet', 'demande_objet', 'Demande Objet', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for demande_description field
            //
            $column = new TextViewColumn('demande_description', 'demande_description', 'Demande Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
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
            
            //
            // View column for demandegravite_designation field
            //
            $column = new TextViewColumn('demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Demandegravite Demandegravite Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for demande_objet field
            //
            $column = new TextViewColumn('demande_objet', 'demande_objet', 'Demande Objet', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for demande_description field
            //
            $column = new TextViewColumn('demande_description', 'demande_description', 'Demande Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
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
            
            //
            // View column for demandegravite_designation field
            //
            $column = new TextViewColumn('demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Demandegravite Demandegravite Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id', $this->dataset);
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
                '`demandetype`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('demandetype_id', true, true),
                    new StringField('demandetype_designation')
                )
            );
            $lookupDataset->setOrderByField('demandetype_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_ecole_demande_intervention_demandetype_demandetype_id_search', 'demandetype_id', 'demandetype_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_ecole_demande_intervention_demandestatut_demandestatut_id_search', 'demandestatut_id', 'demandestatut_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_ecole_demande_intervention_demandegravite_demandegravite_id_search', 'demandegravite_id', 'demandegravite_designation', null, 20);
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
            $lookupDataset->setOrderByField('ecole_RNE', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_ecole_demande_intervention_ecole_ecole_id_search', 'ecole_id', 'ecole_RNE', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_ecole_demande_intervention_demandetype_demandetype_id_search', 'demandetype_id', 'demandetype_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_ecole_demande_intervention_demandestatut_demandestatut_id_search', 'demandestatut_id', 'demandestatut_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_ecole_demande_intervention_demandegravite_demandegravite_id_search', 'demandegravite_id', 'demandegravite_designation', null, 20);
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
            $lookupDataset->setOrderByField('ecole_RNE', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_ecole_demande_intervention_ecole_ecole_id_search', 'ecole_id', 'ecole_RNE', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_ecole_demande_intervention_demandetype_demandetype_id_search', 'demandetype_id', 'demandetype_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_ecole_demande_intervention_demandestatut_demandestatut_id_search', 'demandestatut_id', 'demandestatut_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_ecole_demande_intervention_demandegravite_demandegravite_id_search', 'demandegravite_id', 'demandegravite_designation', null, 20);
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
            $lookupDataset->setOrderByField('ecole_RNE', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_ecole_demande_intervention_ecole_ecole_id_search', 'ecole_id', 'ecole_RNE', null, 20);
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
    
    
    
    class ecole_demande_sstPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Demande Sst');
            $this->SetMenuLabel('Demande Sst');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`demande_sst`');
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
            $this->dataset->AddLookupField('demandestatut_demandestatut_id', 'demandestatut', new IntegerField('demandestatut_id'), new StringField('demandestatut_designation', false, false, false, false, 'demandestatut_demandestatut_id_demandestatut_designation', 'demandestatut_demandestatut_id_demandestatut_designation_demandestatut'), 'demandestatut_demandestatut_id_demandestatut_designation_demandestatut');
            $this->dataset->AddLookupField('demandegravite_demandegravite_id', 'demandegravite', new IntegerField('demandegravite_id'), new StringField('demandegravite_designation', false, false, false, false, 'demandegravite_demandegravite_id_demandegravite_designation', 'demandegravite_demandegravite_id_demandegravite_designation_demandegravite'), 'demandegravite_demandegravite_id_demandegravite_designation_demandegravite');
            $this->dataset->AddLookupField('ecole_ecole_id', 'ecole', new IntegerField('ecole_id'), new StringField('ecole_RNE', false, false, false, false, 'ecole_ecole_id_ecole_RNE', 'ecole_ecole_id_ecole_RNE_ecole'), 'ecole_ecole_id_ecole_RNE_ecole');
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
                new FilterColumn($this->dataset, 'demande_id', 'demande_id', 'Demande Id'),
                new FilterColumn($this->dataset, 'demande_objet', 'demande_objet', 'Demande Objet'),
                new FilterColumn($this->dataset, 'demande_description', 'demande_description', 'Demande Description'),
                new FilterColumn($this->dataset, 'demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'Demandetype Demandetype Id'),
                new FilterColumn($this->dataset, 'demandestatut_demandestatut_id', 'demandestatut_demandestatut_id_demandestatut_designation', 'Demandestatut Demandestatut Id'),
                new FilterColumn($this->dataset, 'demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Demandegravite Demandegravite Id'),
                new FilterColumn($this->dataset, 'ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['demande_id'])
                ->addColumn($columns['demande_objet'])
                ->addColumn($columns['demande_description'])
                ->addColumn($columns['demandetype_demandetype_id'])
                ->addColumn($columns['demandestatut_demandestatut_id'])
                ->addColumn($columns['demandegravite_demandegravite_id'])
                ->addColumn($columns['ecole_ecole_id']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('demandetype_demandetype_id')
                ->setOptionsFor('demandestatut_demandestatut_id')
                ->setOptionsFor('demandegravite_demandegravite_id')
                ->setOptionsFor('ecole_ecole_id');
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
            
            $main_editor = new DynamicCombobox('demandetype_demandetype_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_ecole_demande_sst_demandetype_demandetype_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('demandetype_demandetype_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_ecole_demande_sst_demandetype_demandetype_id_search');
            
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
            $main_editor->SetHandlerName('filter_builder_ecole_demande_sst_demandestatut_demandestatut_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('demandestatut_demandestatut_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_ecole_demande_sst_demandestatut_demandestatut_id_search');
            
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
            $main_editor->SetHandlerName('filter_builder_ecole_demande_sst_demandegravite_demandegravite_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('demandegravite_demandegravite_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_ecole_demande_sst_demandegravite_demandegravite_id_search');
            
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
            
            $main_editor = new DynamicCombobox('ecole_ecole_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_ecole_demande_sst_ecole_ecole_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('ecole_ecole_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_ecole_demande_sst_ecole_ecole_id_search');
            
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
            $column = new NumberViewColumn('demande_id', 'demande_id', 'Demande Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for demande_objet field
            //
            $column = new TextViewColumn('demande_objet', 'demande_objet', 'Demande Objet', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for demande_description field
            //
            $column = new TextViewColumn('demande_description', 'demande_description', 'Demande Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
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
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id', $this->dataset);
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
            $column = new NumberViewColumn('demande_id', 'demande_id', 'Demande Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for demande_objet field
            //
            $column = new TextViewColumn('demande_objet', 'demande_objet', 'Demande Objet', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for demande_description field
            //
            $column = new TextViewColumn('demande_description', 'demande_description', 'Demande Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
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
            
            //
            // View column for demandegravite_designation field
            //
            $column = new TextViewColumn('demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Demandegravite Demandegravite Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for demande_objet field
            //
            $editor = new TextEdit('demande_objet_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Demande Objet', 'demande_objet', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for demande_description field
            //
            $editor = new TextAreaEdit('demande_description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Demande Description', 'demande_description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
            $editColumn = new DynamicLookupEditColumn('Demandetype Demandetype Id', 'demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'edit_ecole_demande_sst_demandetype_demandetype_id_search', $editor, $this->dataset, $lookupDataset, 'demandetype_id', 'demandetype_designation', '');
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
            $editColumn = new DynamicLookupEditColumn('Demandestatut Demandestatut Id', 'demandestatut_demandestatut_id', 'demandestatut_demandestatut_id_demandestatut_designation', 'edit_ecole_demande_sst_demandestatut_demandestatut_id_search', $editor, $this->dataset, $lookupDataset, 'demandestatut_id', 'demandestatut_designation', '');
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
            $editColumn = new DynamicLookupEditColumn('Demandegravite Demandegravite Id', 'demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'edit_ecole_demande_sst_demandegravite_demandegravite_id_search', $editor, $this->dataset, $lookupDataset, 'demandegravite_id', 'demandegravite_designation', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_ecole_id field
            //
            $editor = new DynamicCombobox('ecole_ecole_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
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
            $lookupDataset->setOrderByField('ecole_RNE', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Ecole Ecole Id', 'ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'edit_ecole_demande_sst_ecole_ecole_id_search', $editor, $this->dataset, $lookupDataset, 'ecole_id', 'ecole_RNE', '');
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
            $editColumn = new CustomEditColumn('Demande Objet', 'demande_objet', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for demande_description field
            //
            $editor = new TextAreaEdit('demande_description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Demande Description', 'demande_description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for demande_objet field
            //
            $editor = new TextEdit('demande_objet_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Demande Objet', 'demande_objet', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for demande_description field
            //
            $editor = new TextAreaEdit('demande_description_edit', 50, 8);
            $editColumn = new CustomEditColumn('Demande Description', 'demande_description', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
            $editColumn = new DynamicLookupEditColumn('Demandetype Demandetype Id', 'demandetype_demandetype_id', 'demandetype_demandetype_id_demandetype_designation', 'insert_ecole_demande_sst_demandetype_demandetype_id_search', $editor, $this->dataset, $lookupDataset, 'demandetype_id', 'demandetype_designation', '');
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
            $editColumn = new DynamicLookupEditColumn('Demandestatut Demandestatut Id', 'demandestatut_demandestatut_id', 'demandestatut_demandestatut_id_demandestatut_designation', 'insert_ecole_demande_sst_demandestatut_demandestatut_id_search', $editor, $this->dataset, $lookupDataset, 'demandestatut_id', 'demandestatut_designation', '');
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
            $editColumn = new DynamicLookupEditColumn('Demandegravite Demandegravite Id', 'demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'insert_ecole_demande_sst_demandegravite_demandegravite_id_search', $editor, $this->dataset, $lookupDataset, 'demandegravite_id', 'demandegravite_designation', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_ecole_id field
            //
            $editor = new DynamicCombobox('ecole_ecole_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
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
            $lookupDataset->setOrderByField('ecole_RNE', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Ecole Ecole Id', 'ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'insert_ecole_demande_sst_ecole_ecole_id_search', $editor, $this->dataset, $lookupDataset, 'ecole_id', 'ecole_RNE', '');
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
            $column = new NumberViewColumn('demande_id', 'demande_id', 'Demande Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for demande_objet field
            //
            $column = new TextViewColumn('demande_objet', 'demande_objet', 'Demande Objet', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for demande_description field
            //
            $column = new TextViewColumn('demande_description', 'demande_description', 'Demande Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
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
            
            //
            // View column for demandegravite_designation field
            //
            $column = new TextViewColumn('demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Demandegravite Demandegravite Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for demande_id field
            //
            $column = new NumberViewColumn('demande_id', 'demande_id', 'Demande Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for demande_objet field
            //
            $column = new TextViewColumn('demande_objet', 'demande_objet', 'Demande Objet', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for demande_description field
            //
            $column = new TextViewColumn('demande_description', 'demande_description', 'Demande Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
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
            
            //
            // View column for demandegravite_designation field
            //
            $column = new TextViewColumn('demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Demandegravite Demandegravite Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for demande_objet field
            //
            $column = new TextViewColumn('demande_objet', 'demande_objet', 'Demande Objet', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for demande_description field
            //
            $column = new TextViewColumn('demande_description', 'demande_description', 'Demande Description', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
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
            
            //
            // View column for demandegravite_designation field
            //
            $column = new TextViewColumn('demandegravite_demandegravite_id', 'demandegravite_demandegravite_id_demandegravite_designation', 'Demandegravite Demandegravite Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id', $this->dataset);
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
                '`demandetype`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('demandetype_id', true, true),
                    new StringField('demandetype_designation')
                )
            );
            $lookupDataset->setOrderByField('demandetype_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_ecole_demande_sst_demandetype_demandetype_id_search', 'demandetype_id', 'demandetype_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_ecole_demande_sst_demandestatut_demandestatut_id_search', 'demandestatut_id', 'demandestatut_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_ecole_demande_sst_demandegravite_demandegravite_id_search', 'demandegravite_id', 'demandegravite_designation', null, 20);
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
            $lookupDataset->setOrderByField('ecole_RNE', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_ecole_demande_sst_ecole_ecole_id_search', 'ecole_id', 'ecole_RNE', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_ecole_demande_sst_demandetype_demandetype_id_search', 'demandetype_id', 'demandetype_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_ecole_demande_sst_demandestatut_demandestatut_id_search', 'demandestatut_id', 'demandestatut_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_ecole_demande_sst_demandegravite_demandegravite_id_search', 'demandegravite_id', 'demandegravite_designation', null, 20);
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
            $lookupDataset->setOrderByField('ecole_RNE', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_ecole_demande_sst_ecole_ecole_id_search', 'ecole_id', 'ecole_RNE', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_ecole_demande_sst_demandetype_demandetype_id_search', 'demandetype_id', 'demandetype_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_ecole_demande_sst_demandestatut_demandestatut_id_search', 'demandestatut_id', 'demandestatut_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_ecole_demande_sst_demandegravite_demandegravite_id_search', 'demandegravite_id', 'demandegravite_designation', null, 20);
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
            $lookupDataset->setOrderByField('ecole_RNE', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_ecole_demande_sst_ecole_ecole_id_search', 'ecole_id', 'ecole_RNE', null, 20);
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
    
    
    
    class ecole_informationdynamiquePage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Informationdynamique');
            $this->SetMenuLabel('Informationdynamique');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`informationdynamique`');
            $this->dataset->addFields(
                array(
                    new IntegerField('informationdynamique_id', true, true),
                    new IntegerField('informationdynamique_classe_qte'),
                    new IntegerField('millesime_millesime_id', true, true),
                    new IntegerField('ecole_ecole_id', true, true),
                    new IntegerField('ecole_zoneadministrative_zoneadministrative_id', true, true)
                )
            );
            $this->dataset->AddLookupField('millesime_millesime_id', 'millesime', new IntegerField('millesime_id'), new StringField('millesime_designation', false, false, false, false, 'millesime_millesime_id_millesime_designation', 'millesime_millesime_id_millesime_designation_millesime'), 'millesime_millesime_id_millesime_designation_millesime');
            $this->dataset->AddLookupField('ecole_ecole_id', 'ecole', new IntegerField('ecole_id'), new StringField('ecole_RNE', false, false, false, false, 'ecole_ecole_id_ecole_RNE', 'ecole_ecole_id_ecole_RNE_ecole'), 'ecole_ecole_id_ecole_RNE_ecole');
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
                new FilterColumn($this->dataset, 'informationdynamique_id', 'informationdynamique_id', 'Informationdynamique Id'),
                new FilterColumn($this->dataset, 'informationdynamique_classe_qte', 'informationdynamique_classe_qte', 'Informationdynamique Classe Qte'),
                new FilterColumn($this->dataset, 'millesime_millesime_id', 'millesime_millesime_id_millesime_designation', 'Millesime Millesime Id'),
                new FilterColumn($this->dataset, 'ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id'),
                new FilterColumn($this->dataset, 'ecole_zoneadministrative_zoneadministrative_id', 'ecole_zoneadministrative_zoneadministrative_id', 'Ecole Zoneadministrative Zoneadministrative Id')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['informationdynamique_id'])
                ->addColumn($columns['informationdynamique_classe_qte'])
                ->addColumn($columns['millesime_millesime_id'])
                ->addColumn($columns['ecole_ecole_id'])
                ->addColumn($columns['ecole_zoneadministrative_zoneadministrative_id']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('millesime_millesime_id')
                ->setOptionsFor('ecole_ecole_id');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('informationdynamique_id_edit');
            
            $filterBuilder->addColumn(
                $columns['informationdynamique_id'],
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
            
            $main_editor = new TextEdit('informationdynamique_classe_qte_edit');
            
            $filterBuilder->addColumn(
                $columns['informationdynamique_classe_qte'],
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
            
            $main_editor = new DynamicCombobox('millesime_millesime_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_ecole_informationdynamique_millesime_millesime_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('millesime_millesime_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_ecole_informationdynamique_millesime_millesime_id_search');
            
            $text_editor = new TextEdit('millesime_millesime_id');
            
            $filterBuilder->addColumn(
                $columns['millesime_millesime_id'],
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
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_ecole_informationdynamique_ecole_ecole_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('ecole_ecole_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_ecole_informationdynamique_ecole_ecole_id_search');
            
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
            
            $main_editor = new TextEdit('ecole_zoneadministrative_zoneadministrative_id_edit');
            
            $filterBuilder->addColumn(
                $columns['ecole_zoneadministrative_zoneadministrative_id'],
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
            // View column for informationdynamique_id field
            //
            $column = new NumberViewColumn('informationdynamique_id', 'informationdynamique_id', 'Informationdynamique Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for informationdynamique_classe_qte field
            //
            $column = new NumberViewColumn('informationdynamique_classe_qte', 'informationdynamique_classe_qte', 'Informationdynamique Classe Qte', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for millesime_designation field
            //
            $column = new TextViewColumn('millesime_millesime_id', 'millesime_millesime_id_millesime_designation', 'Millesime Millesime Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ecole_zoneadministrative_zoneadministrative_id field
            //
            $column = new NumberViewColumn('ecole_zoneadministrative_zoneadministrative_id', 'ecole_zoneadministrative_zoneadministrative_id', 'Ecole Zoneadministrative Zoneadministrative Id', $this->dataset);
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
            // View column for informationdynamique_id field
            //
            $column = new NumberViewColumn('informationdynamique_id', 'informationdynamique_id', 'Informationdynamique Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for informationdynamique_classe_qte field
            //
            $column = new NumberViewColumn('informationdynamique_classe_qte', 'informationdynamique_classe_qte', 'Informationdynamique Classe Qte', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for millesime_designation field
            //
            $column = new TextViewColumn('millesime_millesime_id', 'millesime_millesime_id_millesime_designation', 'Millesime Millesime Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_zoneadministrative_zoneadministrative_id field
            //
            $column = new NumberViewColumn('ecole_zoneadministrative_zoneadministrative_id', 'ecole_zoneadministrative_zoneadministrative_id', 'Ecole Zoneadministrative Zoneadministrative Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for informationdynamique_id field
            //
            $editor = new TextEdit('informationdynamique_id_edit');
            $editColumn = new CustomEditColumn('Informationdynamique Id', 'informationdynamique_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for informationdynamique_classe_qte field
            //
            $editor = new TextEdit('informationdynamique_classe_qte_edit');
            $editColumn = new CustomEditColumn('Informationdynamique Classe Qte', 'informationdynamique_classe_qte', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for millesime_millesime_id field
            //
            $editor = new DynamicCombobox('millesime_millesime_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`millesime`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('millesime_id', true, true),
                    new StringField('millesime_designation')
                )
            );
            $lookupDataset->setOrderByField('millesime_designation', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Millesime Millesime Id', 'millesime_millesime_id', 'millesime_millesime_id_millesime_designation', 'edit_ecole_informationdynamique_millesime_millesime_id_search', $editor, $this->dataset, $lookupDataset, 'millesime_id', 'millesime_designation', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_ecole_id field
            //
            $editor = new DynamicCombobox('ecole_ecole_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
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
            $lookupDataset->setOrderByField('ecole_RNE', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Ecole Ecole Id', 'ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'edit_ecole_informationdynamique_ecole_ecole_id_search', $editor, $this->dataset, $lookupDataset, 'ecole_id', 'ecole_RNE', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_zoneadministrative_zoneadministrative_id field
            //
            $editor = new TextEdit('ecole_zoneadministrative_zoneadministrative_id_edit');
            $editColumn = new CustomEditColumn('Ecole Zoneadministrative Zoneadministrative Id', 'ecole_zoneadministrative_zoneadministrative_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for informationdynamique_classe_qte field
            //
            $editor = new TextEdit('informationdynamique_classe_qte_edit');
            $editColumn = new CustomEditColumn('Informationdynamique Classe Qte', 'informationdynamique_classe_qte', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for informationdynamique_id field
            //
            $editor = new TextEdit('informationdynamique_id_edit');
            $editColumn = new CustomEditColumn('Informationdynamique Id', 'informationdynamique_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for informationdynamique_classe_qte field
            //
            $editor = new TextEdit('informationdynamique_classe_qte_edit');
            $editColumn = new CustomEditColumn('Informationdynamique Classe Qte', 'informationdynamique_classe_qte', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for millesime_millesime_id field
            //
            $editor = new DynamicCombobox('millesime_millesime_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`millesime`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('millesime_id', true, true),
                    new StringField('millesime_designation')
                )
            );
            $lookupDataset->setOrderByField('millesime_designation', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Millesime Millesime Id', 'millesime_millesime_id', 'millesime_millesime_id_millesime_designation', 'insert_ecole_informationdynamique_millesime_millesime_id_search', $editor, $this->dataset, $lookupDataset, 'millesime_id', 'millesime_designation', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_ecole_id field
            //
            $editor = new DynamicCombobox('ecole_ecole_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
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
            $lookupDataset->setOrderByField('ecole_RNE', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Ecole Ecole Id', 'ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'insert_ecole_informationdynamique_ecole_ecole_id_search', $editor, $this->dataset, $lookupDataset, 'ecole_id', 'ecole_RNE', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_zoneadministrative_zoneadministrative_id field
            //
            $editor = new TextEdit('ecole_zoneadministrative_zoneadministrative_id_edit');
            $editColumn = new CustomEditColumn('Ecole Zoneadministrative Zoneadministrative Id', 'ecole_zoneadministrative_zoneadministrative_id', $editor, $this->dataset);
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
            // View column for informationdynamique_id field
            //
            $column = new NumberViewColumn('informationdynamique_id', 'informationdynamique_id', 'Informationdynamique Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for informationdynamique_classe_qte field
            //
            $column = new NumberViewColumn('informationdynamique_classe_qte', 'informationdynamique_classe_qte', 'Informationdynamique Classe Qte', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for millesime_designation field
            //
            $column = new TextViewColumn('millesime_millesime_id', 'millesime_millesime_id_millesime_designation', 'Millesime Millesime Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_zoneadministrative_zoneadministrative_id field
            //
            $column = new NumberViewColumn('ecole_zoneadministrative_zoneadministrative_id', 'ecole_zoneadministrative_zoneadministrative_id', 'Ecole Zoneadministrative Zoneadministrative Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for informationdynamique_id field
            //
            $column = new NumberViewColumn('informationdynamique_id', 'informationdynamique_id', 'Informationdynamique Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for informationdynamique_classe_qte field
            //
            $column = new NumberViewColumn('informationdynamique_classe_qte', 'informationdynamique_classe_qte', 'Informationdynamique Classe Qte', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for millesime_designation field
            //
            $column = new TextViewColumn('millesime_millesime_id', 'millesime_millesime_id_millesime_designation', 'Millesime Millesime Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_zoneadministrative_zoneadministrative_id field
            //
            $column = new NumberViewColumn('ecole_zoneadministrative_zoneadministrative_id', 'ecole_zoneadministrative_zoneadministrative_id', 'Ecole Zoneadministrative Zoneadministrative Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for informationdynamique_id field
            //
            $column = new NumberViewColumn('informationdynamique_id', 'informationdynamique_id', 'Informationdynamique Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for informationdynamique_classe_qte field
            //
            $column = new NumberViewColumn('informationdynamique_classe_qte', 'informationdynamique_classe_qte', 'Informationdynamique Classe Qte', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for millesime_designation field
            //
            $column = new TextViewColumn('millesime_millesime_id', 'millesime_millesime_id_millesime_designation', 'Millesime Millesime Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_zoneadministrative_zoneadministrative_id field
            //
            $column = new NumberViewColumn('ecole_zoneadministrative_zoneadministrative_id', 'ecole_zoneadministrative_zoneadministrative_id', 'Ecole Zoneadministrative Zoneadministrative Id', $this->dataset);
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
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`millesime`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('millesime_id', true, true),
                    new StringField('millesime_designation')
                )
            );
            $lookupDataset->setOrderByField('millesime_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_ecole_informationdynamique_millesime_millesime_id_search', 'millesime_id', 'millesime_designation', null, 20);
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
            $lookupDataset->setOrderByField('ecole_RNE', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_ecole_informationdynamique_ecole_ecole_id_search', 'ecole_id', 'ecole_RNE', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`millesime`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('millesime_id', true, true),
                    new StringField('millesime_designation')
                )
            );
            $lookupDataset->setOrderByField('millesime_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_ecole_informationdynamique_millesime_millesime_id_search', 'millesime_id', 'millesime_designation', null, 20);
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
            $lookupDataset->setOrderByField('ecole_RNE', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_ecole_informationdynamique_ecole_ecole_id_search', 'ecole_id', 'ecole_RNE', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`millesime`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('millesime_id', true, true),
                    new StringField('millesime_designation')
                )
            );
            $lookupDataset->setOrderByField('millesime_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_ecole_informationdynamique_millesime_millesime_id_search', 'millesime_id', 'millesime_designation', null, 20);
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
            $lookupDataset->setOrderByField('ecole_RNE', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_ecole_informationdynamique_ecole_ecole_id_search', 'ecole_id', 'ecole_RNE', null, 20);
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
    
    
    
    class ecole_zoneadministrative_has_ecolePage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Zoneadministrative Has Ecole');
            $this->SetMenuLabel('Zoneadministrative Has Ecole');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`zoneadministrative_has_ecole`');
            $this->dataset->addFields(
                array(
                    new IntegerField('zoneadministrative_zoneadministrative_id', true, true),
                    new IntegerField('ecole_ecole_id', true, true)
                )
            );
            $this->dataset->AddLookupField('zoneadministrative_zoneadministrative_id', 'zoneadministrative', new IntegerField('zoneadministrative_id'), new StringField('zoneadministrative_designation', false, false, false, false, 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation_zoneadministrative'), 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation_zoneadministrative');
            $this->dataset->AddLookupField('ecole_ecole_id', 'ecole', new IntegerField('ecole_id'), new StringField('ecole_RNE', false, false, false, false, 'ecole_ecole_id_ecole_RNE', 'ecole_ecole_id_ecole_RNE_ecole'), 'ecole_ecole_id_ecole_RNE_ecole');
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
                new FilterColumn($this->dataset, 'zoneadministrative_zoneadministrative_id', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'Zoneadministrative Zoneadministrative Id'),
                new FilterColumn($this->dataset, 'ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['zoneadministrative_zoneadministrative_id'])
                ->addColumn($columns['ecole_ecole_id']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('zoneadministrative_zoneadministrative_id')
                ->setOptionsFor('ecole_ecole_id');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new DynamicCombobox('zoneadministrative_zoneadministrative_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_ecole_zoneadministrative_has_ecole_zoneadministrative_zoneadministrative_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('zoneadministrative_zoneadministrative_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_ecole_zoneadministrative_has_ecole_zoneadministrative_zoneadministrative_id_search');
            
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
            
            $main_editor = new DynamicCombobox('ecole_ecole_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_ecole_zoneadministrative_has_ecole_ecole_ecole_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('ecole_ecole_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_ecole_zoneadministrative_has_ecole_ecole_ecole_id_search');
            
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
            $column = new TextViewColumn('zoneadministrative_zoneadministrative_id', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'Zoneadministrative Zoneadministrative Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id', $this->dataset);
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
            $column = new TextViewColumn('zoneadministrative_zoneadministrative_id', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'Zoneadministrative Zoneadministrative Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id', $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Zoneadministrative Zoneadministrative Id', 'zoneadministrative_zoneadministrative_id', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'edit_ecole_zoneadministrative_has_ecole_zoneadministrative_zoneadministrative_id_search', $editor, $this->dataset, $lookupDataset, 'zoneadministrative_id', 'zoneadministrative_designation', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_ecole_id field
            //
            $editor = new DynamicCombobox('ecole_ecole_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
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
            $lookupDataset->setOrderByField('ecole_RNE', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Ecole Ecole Id', 'ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'edit_ecole_zoneadministrative_has_ecole_ecole_ecole_id_search', $editor, $this->dataset, $lookupDataset, 'ecole_id', 'ecole_RNE', '');
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
            $editColumn = new DynamicLookupEditColumn('Zoneadministrative Zoneadministrative Id', 'zoneadministrative_zoneadministrative_id', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'insert_ecole_zoneadministrative_has_ecole_zoneadministrative_zoneadministrative_id_search', $editor, $this->dataset, $lookupDataset, 'zoneadministrative_id', 'zoneadministrative_designation', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_ecole_id field
            //
            $editor = new DynamicCombobox('ecole_ecole_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
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
            $lookupDataset->setOrderByField('ecole_RNE', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Ecole Ecole Id', 'ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'insert_ecole_zoneadministrative_has_ecole_ecole_ecole_id_search', $editor, $this->dataset, $lookupDataset, 'ecole_id', 'ecole_RNE', '');
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
            $column = new TextViewColumn('zoneadministrative_zoneadministrative_id', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'Zoneadministrative Zoneadministrative Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for zoneadministrative_designation field
            //
            $column = new TextViewColumn('zoneadministrative_zoneadministrative_id', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'Zoneadministrative Zoneadministrative Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for zoneadministrative_designation field
            //
            $column = new TextViewColumn('zoneadministrative_zoneadministrative_id', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'Zoneadministrative Zoneadministrative Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_ecole_id', 'ecole_ecole_id_ecole_RNE', 'Ecole Ecole Id', $this->dataset);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_ecole_zoneadministrative_has_ecole_zoneadministrative_zoneadministrative_id_search', 'zoneadministrative_id', 'zoneadministrative_designation', null, 20);
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
            $lookupDataset->setOrderByField('ecole_RNE', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_ecole_zoneadministrative_has_ecole_ecole_ecole_id_search', 'ecole_id', 'ecole_RNE', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_ecole_zoneadministrative_has_ecole_zoneadministrative_zoneadministrative_id_search', 'zoneadministrative_id', 'zoneadministrative_designation', null, 20);
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
            $lookupDataset->setOrderByField('ecole_RNE', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_ecole_zoneadministrative_has_ecole_ecole_ecole_id_search', 'ecole_id', 'ecole_RNE', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_ecole_zoneadministrative_has_ecole_zoneadministrative_zoneadministrative_id_search', 'zoneadministrative_id', 'zoneadministrative_designation', null, 20);
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
            $lookupDataset->setOrderByField('ecole_RNE', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_ecole_zoneadministrative_has_ecole_ecole_ecole_id_search', 'ecole_id', 'ecole_RNE', null, 20);
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
    
    class ecole_doccsi_idNestedPage extends NestedFormPage
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
    
    
    
    class ecolePage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Ecole');
            $this->SetMenuLabel('Ecole');
    
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
                ->addColumn($columns['ecole_id'])
                ->addColumn($columns['ecole_RNE'])
                ->addColumn($columns['ecole_lat'])
                ->addColumn($columns['ecole_long'])
                ->addColumn($columns['ecole_latlong'])
                ->addColumn($columns['ecole_coord'])
                ->addColumn($columns['ecole_appellation'])
                ->addColumn($columns['ecole_denominationprincipale'])
                ->addColumn($columns['ecole_patronymeuai'])
                ->addColumn($columns['ecole_secteur'])
                ->addColumn($columns['ecole_adresse'])
                ->addColumn($columns['ecole_lieudit'])
                ->addColumn($columns['ecole_boitepostale'])
                ->addColumn($columns['ecole_codepostal'])
                ->addColumn($columns['ecole_localiteacheminement'])
                ->addColumn($columns['ecole_commune'])
                ->addColumn($columns['ecole_coordonneex'])
                ->addColumn($columns['ecole_coordonneey'])
                ->addColumn($columns['ecole_epasg'])
                ->addColumn($columns['ecole_qualite'])
                ->addColumn($columns['ecole_localisation'])
                ->addColumn($columns['ecole_codenature'])
                ->addColumn($columns['ecole_dateouverture'])
                ->addColumn($columns['doccsi_id']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('doccsi_id');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('ecole_id_edit');
            
            $filterBuilder->addColumn(
                $columns['ecole_id'],
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
            
            $main_editor = new TextEdit('ecole_rne_edit');
            $main_editor->SetMaxLength(45);
            
            $filterBuilder->addColumn(
                $columns['ecole_RNE'],
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
            
            $main_editor = new TextEdit('ecole_lat_edit');
            $main_editor->SetMaxLength(45);
            
            $filterBuilder->addColumn(
                $columns['ecole_lat'],
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
            
            $main_editor = new TextEdit('ecole_long_edit');
            $main_editor->SetMaxLength(45);
            
            $filterBuilder->addColumn(
                $columns['ecole_long'],
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
            
            $main_editor = new TextEdit('ecole_latlong_edit');
            $main_editor->SetMaxLength(45);
            
            $filterBuilder->addColumn(
                $columns['ecole_latlong'],
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
            
            $main_editor = new TextEdit('ecole_coord_edit');
            
            $filterBuilder->addColumn(
                $columns['ecole_coord'],
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
            
            $main_editor = new TextEdit('ecole_appellation_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['ecole_appellation'],
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
            
            $main_editor = new TextEdit('ecole_adresse_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['ecole_adresse'],
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
            
            $main_editor = new TextEdit('ecole_lieudit_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['ecole_lieudit'],
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
            
            $main_editor = new TextEdit('ecole_boitepostale_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['ecole_boitepostale'],
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
            
            $main_editor = new TextEdit('ecole_codepostal_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['ecole_codepostal'],
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
            
            $main_editor = new TextEdit('ecole_localiteacheminement_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['ecole_localiteacheminement'],
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
            
            $main_editor = new TextEdit('ecole_commune_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['ecole_commune'],
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
            
            $main_editor = new TextEdit('ecole_coordonneex_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['ecole_coordonneex'],
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
            
            $main_editor = new TextEdit('ecole_coordonneey_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['ecole_coordonneey'],
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
            
            $main_editor = new TextEdit('ecole_epasg_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['ecole_epasg'],
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
            
            $main_editor = new TextEdit('ecole_qualite_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['ecole_qualite'],
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
            
            $main_editor = new TextEdit('ecole_localisation_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['ecole_localisation'],
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
            
            $main_editor = new TextEdit('ecole_codenature_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['ecole_codenature'],
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
            
            $main_editor = new TextEdit('ecole_dateouverture_edit');
            $main_editor->SetMaxLength(100);
            
            $filterBuilder->addColumn(
                $columns['ecole_dateouverture'],
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
            
            $main_editor = new DynamicCombobox('doccsi_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_ecole_doccsi_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('doccsi_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_ecole_doccsi_id_search');
            
            $text_editor = new TextEdit('doccsi_id');
            
            $filterBuilder->addColumn(
                $columns['doccsi_id'],
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
            if (GetCurrentUserPermissionsForPage('ecole.demande_amelioration')->HasViewGrant() && $withDetails)
            {
            //
            // View column for ecole_demande_amelioration detail
            //
            $column = new DetailColumn(array('ecole_id'), 'ecole.demande_amelioration', 'ecole_demande_amelioration_handler', $this->dataset, 'Demande Amelioration');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            if (GetCurrentUserPermissionsForPage('ecole.demande_intervention')->HasViewGrant() && $withDetails)
            {
            //
            // View column for ecole_demande_intervention detail
            //
            $column = new DetailColumn(array('ecole_id'), 'ecole.demande_intervention', 'ecole_demande_intervention_handler', $this->dataset, 'Demande Intervention');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            if (GetCurrentUserPermissionsForPage('ecole.demande_sst')->HasViewGrant() && $withDetails)
            {
            //
            // View column for ecole_demande_sst detail
            //
            $column = new DetailColumn(array('ecole_id'), 'ecole.demande_sst', 'ecole_demande_sst_handler', $this->dataset, 'Demande Sst');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            if (GetCurrentUserPermissionsForPage('ecole.informationdynamique')->HasViewGrant() && $withDetails)
            {
            //
            // View column for ecole_informationdynamique detail
            //
            $column = new DetailColumn(array('ecole_id'), 'ecole.informationdynamique', 'ecole_informationdynamique_handler', $this->dataset, 'Informationdynamique');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            if (GetCurrentUserPermissionsForPage('ecole.zoneadministrative_has_ecole')->HasViewGrant() && $withDetails)
            {
            //
            // View column for ecole_zoneadministrative_has_ecole detail
            //
            $column = new DetailColumn(array('ecole_id'), 'ecole.zoneadministrative_has_ecole', 'ecole_zoneadministrative_has_ecole_handler', $this->dataset, 'Zoneadministrative Has Ecole');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            //
            // View column for ecole_id field
            //
            $column = new NumberViewColumn('ecole_id', 'ecole_id', 'Ecole Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
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
            // View column for ecole_lat field
            //
            $column = new TextViewColumn('ecole_lat', 'ecole_lat', 'Ecole Lat', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ecole_long field
            //
            $column = new TextViewColumn('ecole_long', 'ecole_long', 'Ecole Long', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ecole_latlong field
            //
            $column = new TextViewColumn('ecole_latlong', 'ecole_latlong', 'Ecole Latlong', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ecole_coord field
            //
            $column = new TextViewColumn('ecole_coord', 'ecole_coord', 'Ecole Coord', $this->dataset);
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
            // View column for ecole_lieudit field
            //
            $column = new TextViewColumn('ecole_lieudit', 'ecole_lieudit', 'Ecole Lieudit', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ecole_boitepostale field
            //
            $column = new TextViewColumn('ecole_boitepostale', 'ecole_boitepostale', 'Ecole Boitepostale', $this->dataset);
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
            // View column for ecole_localiteacheminement field
            //
            $column = new TextViewColumn('ecole_localiteacheminement', 'ecole_localiteacheminement', 'Ecole Localiteacheminement', $this->dataset);
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
            // View column for ecole_coordonneex field
            //
            $column = new TextViewColumn('ecole_coordonneex', 'ecole_coordonneex', 'Ecole Coordonneex', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ecole_coordonneey field
            //
            $column = new TextViewColumn('ecole_coordonneey', 'ecole_coordonneey', 'Ecole Coordonneey', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ecole_epasg field
            //
            $column = new TextViewColumn('ecole_epasg', 'ecole_epasg', 'Ecole Epasg', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ecole_qualite field
            //
            $column = new TextViewColumn('ecole_qualite', 'ecole_qualite', 'Ecole Qualite', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ecole_localisation field
            //
            $column = new TextViewColumn('ecole_localisation', 'ecole_localisation', 'Ecole Localisation', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ecole_codenature field
            //
            $column = new TextViewColumn('ecole_codenature', 'ecole_codenature', 'Ecole Codenature', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ecole_dateouverture field
            //
            $column = new TextViewColumn('ecole_dateouverture', 'ecole_dateouverture', 'Ecole Dateouverture', $this->dataset);
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
            // View column for ecole_id field
            //
            $column = new NumberViewColumn('ecole_id', 'ecole_id', 'Ecole Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_RNE', 'ecole_RNE', 'Ecole RNE', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_lat field
            //
            $column = new TextViewColumn('ecole_lat', 'ecole_lat', 'Ecole Lat', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_long field
            //
            $column = new TextViewColumn('ecole_long', 'ecole_long', 'Ecole Long', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_latlong field
            //
            $column = new TextViewColumn('ecole_latlong', 'ecole_latlong', 'Ecole Latlong', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_coord field
            //
            $column = new TextViewColumn('ecole_coord', 'ecole_coord', 'Ecole Coord', $this->dataset);
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
            // View column for ecole_lieudit field
            //
            $column = new TextViewColumn('ecole_lieudit', 'ecole_lieudit', 'Ecole Lieudit', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_boitepostale field
            //
            $column = new TextViewColumn('ecole_boitepostale', 'ecole_boitepostale', 'Ecole Boitepostale', $this->dataset);
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
            // View column for ecole_localiteacheminement field
            //
            $column = new TextViewColumn('ecole_localiteacheminement', 'ecole_localiteacheminement', 'Ecole Localiteacheminement', $this->dataset);
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
            // View column for ecole_coordonneex field
            //
            $column = new TextViewColumn('ecole_coordonneex', 'ecole_coordonneex', 'Ecole Coordonneex', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_coordonneey field
            //
            $column = new TextViewColumn('ecole_coordonneey', 'ecole_coordonneey', 'Ecole Coordonneey', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_epasg field
            //
            $column = new TextViewColumn('ecole_epasg', 'ecole_epasg', 'Ecole Epasg', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_qualite field
            //
            $column = new TextViewColumn('ecole_qualite', 'ecole_qualite', 'Ecole Qualite', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_localisation field
            //
            $column = new TextViewColumn('ecole_localisation', 'ecole_localisation', 'Ecole Localisation', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_codenature field
            //
            $column = new TextViewColumn('ecole_codenature', 'ecole_codenature', 'Ecole Codenature', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_dateouverture field
            //
            $column = new TextViewColumn('ecole_dateouverture', 'ecole_dateouverture', 'Ecole Dateouverture', $this->dataset);
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
            // Edit column for ecole_lat field
            //
            $editor = new TextEdit('ecole_lat_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Ecole Lat', 'ecole_lat', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_long field
            //
            $editor = new TextEdit('ecole_long_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Ecole Long', 'ecole_long', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_latlong field
            //
            $editor = new TextEdit('ecole_latlong_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Ecole Latlong', 'ecole_latlong', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_coord field
            //
            $editor = new TextEdit('ecole_coord_edit');
            $editColumn = new CustomEditColumn('Ecole Coord', 'ecole_coord', $editor, $this->dataset);
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
            // Edit column for ecole_denominationprincipale field
            //
            $editor = new TextEdit('ecole_denominationprincipale_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Denominationprincipale', 'ecole_denominationprincipale', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_patronymeuai field
            //
            $editor = new TextEdit('ecole_patronymeuai_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Patronymeuai', 'ecole_patronymeuai', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_secteur field
            //
            $editor = new TextEdit('ecole_secteur_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Secteur', 'ecole_secteur', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_adresse field
            //
            $editor = new TextEdit('ecole_adresse_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Adresse', 'ecole_adresse', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_lieudit field
            //
            $editor = new TextEdit('ecole_lieudit_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Lieudit', 'ecole_lieudit', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_boitepostale field
            //
            $editor = new TextEdit('ecole_boitepostale_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Boitepostale', 'ecole_boitepostale', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_codepostal field
            //
            $editor = new TextEdit('ecole_codepostal_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Codepostal', 'ecole_codepostal', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_localiteacheminement field
            //
            $editor = new TextEdit('ecole_localiteacheminement_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Localiteacheminement', 'ecole_localiteacheminement', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_commune field
            //
            $editor = new TextEdit('ecole_commune_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Commune', 'ecole_commune', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_coordonneex field
            //
            $editor = new TextEdit('ecole_coordonneex_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Coordonneex', 'ecole_coordonneex', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_coordonneey field
            //
            $editor = new TextEdit('ecole_coordonneey_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Coordonneey', 'ecole_coordonneey', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_epasg field
            //
            $editor = new TextEdit('ecole_epasg_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Epasg', 'ecole_epasg', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_qualite field
            //
            $editor = new TextEdit('ecole_qualite_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Qualite', 'ecole_qualite', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_localisation field
            //
            $editor = new TextEdit('ecole_localisation_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Localisation', 'ecole_localisation', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_codenature field
            //
            $editor = new TextEdit('ecole_codenature_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Codenature', 'ecole_codenature', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ecole_dateouverture field
            //
            $editor = new TextEdit('ecole_dateouverture_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Dateouverture', 'ecole_dateouverture', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Doccsi Id', 'doccsi_id', 'doccsi_id_doccsi_fichier', 'edit_ecole_doccsi_id_search', $editor, $this->dataset, $lookupDataset, 'doccsi_id', 'doccsi_fichier', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(ecole_doccsi_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for ecole_RNE field
            //
            $editor = new TextEdit('ecole_rne_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Ecole RNE', 'ecole_RNE', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ecole_lat field
            //
            $editor = new TextEdit('ecole_lat_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Ecole Lat', 'ecole_lat', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ecole_long field
            //
            $editor = new TextEdit('ecole_long_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Ecole Long', 'ecole_long', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ecole_latlong field
            //
            $editor = new TextEdit('ecole_latlong_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Ecole Latlong', 'ecole_latlong', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ecole_coord field
            //
            $editor = new TextEdit('ecole_coord_edit');
            $editColumn = new CustomEditColumn('Ecole Coord', 'ecole_coord', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ecole_appellation field
            //
            $editor = new TextEdit('ecole_appellation_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Appellation', 'ecole_appellation', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ecole_denominationprincipale field
            //
            $editor = new TextEdit('ecole_denominationprincipale_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Denominationprincipale', 'ecole_denominationprincipale', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ecole_patronymeuai field
            //
            $editor = new TextEdit('ecole_patronymeuai_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Patronymeuai', 'ecole_patronymeuai', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ecole_secteur field
            //
            $editor = new TextEdit('ecole_secteur_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Secteur', 'ecole_secteur', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ecole_adresse field
            //
            $editor = new TextEdit('ecole_adresse_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Adresse', 'ecole_adresse', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ecole_lieudit field
            //
            $editor = new TextEdit('ecole_lieudit_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Lieudit', 'ecole_lieudit', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ecole_boitepostale field
            //
            $editor = new TextEdit('ecole_boitepostale_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Boitepostale', 'ecole_boitepostale', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ecole_codepostal field
            //
            $editor = new TextEdit('ecole_codepostal_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Codepostal', 'ecole_codepostal', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ecole_localiteacheminement field
            //
            $editor = new TextEdit('ecole_localiteacheminement_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Localiteacheminement', 'ecole_localiteacheminement', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ecole_commune field
            //
            $editor = new TextEdit('ecole_commune_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Commune', 'ecole_commune', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ecole_coordonneex field
            //
            $editor = new TextEdit('ecole_coordonneex_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Coordonneex', 'ecole_coordonneex', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ecole_coordonneey field
            //
            $editor = new TextEdit('ecole_coordonneey_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Coordonneey', 'ecole_coordonneey', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ecole_epasg field
            //
            $editor = new TextEdit('ecole_epasg_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Epasg', 'ecole_epasg', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ecole_qualite field
            //
            $editor = new TextEdit('ecole_qualite_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Qualite', 'ecole_qualite', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ecole_localisation field
            //
            $editor = new TextEdit('ecole_localisation_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Localisation', 'ecole_localisation', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ecole_codenature field
            //
            $editor = new TextEdit('ecole_codenature_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Codenature', 'ecole_codenature', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ecole_dateouverture field
            //
            $editor = new TextEdit('ecole_dateouverture_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Dateouverture', 'ecole_dateouverture', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
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
            $editColumn = new DynamicLookupEditColumn('Doccsi Id', 'doccsi_id', 'doccsi_id_doccsi_fichier', 'multi_edit_ecole_doccsi_id_search', $editor, $this->dataset, $lookupDataset, 'doccsi_id', 'doccsi_fichier', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(ecole_doccsi_idNestedPage::getNestedInsertHandlerName())
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for ecole_RNE field
            //
            $editor = new TextEdit('ecole_rne_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Ecole RNE', 'ecole_RNE', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_lat field
            //
            $editor = new TextEdit('ecole_lat_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Ecole Lat', 'ecole_lat', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_long field
            //
            $editor = new TextEdit('ecole_long_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Ecole Long', 'ecole_long', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_latlong field
            //
            $editor = new TextEdit('ecole_latlong_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Ecole Latlong', 'ecole_latlong', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_coord field
            //
            $editor = new TextEdit('ecole_coord_edit');
            $editColumn = new CustomEditColumn('Ecole Coord', 'ecole_coord', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_appellation field
            //
            $editor = new TextEdit('ecole_appellation_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Appellation', 'ecole_appellation', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_denominationprincipale field
            //
            $editor = new TextEdit('ecole_denominationprincipale_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Denominationprincipale', 'ecole_denominationprincipale', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_patronymeuai field
            //
            $editor = new TextEdit('ecole_patronymeuai_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Patronymeuai', 'ecole_patronymeuai', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_secteur field
            //
            $editor = new TextEdit('ecole_secteur_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Secteur', 'ecole_secteur', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_adresse field
            //
            $editor = new TextEdit('ecole_adresse_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Adresse', 'ecole_adresse', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_lieudit field
            //
            $editor = new TextEdit('ecole_lieudit_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Lieudit', 'ecole_lieudit', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_boitepostale field
            //
            $editor = new TextEdit('ecole_boitepostale_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Boitepostale', 'ecole_boitepostale', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_codepostal field
            //
            $editor = new TextEdit('ecole_codepostal_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Codepostal', 'ecole_codepostal', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_localiteacheminement field
            //
            $editor = new TextEdit('ecole_localiteacheminement_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Localiteacheminement', 'ecole_localiteacheminement', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_commune field
            //
            $editor = new TextEdit('ecole_commune_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Commune', 'ecole_commune', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_coordonneex field
            //
            $editor = new TextEdit('ecole_coordonneex_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Coordonneex', 'ecole_coordonneex', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_coordonneey field
            //
            $editor = new TextEdit('ecole_coordonneey_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Coordonneey', 'ecole_coordonneey', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_epasg field
            //
            $editor = new TextEdit('ecole_epasg_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Epasg', 'ecole_epasg', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_qualite field
            //
            $editor = new TextEdit('ecole_qualite_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Qualite', 'ecole_qualite', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_localisation field
            //
            $editor = new TextEdit('ecole_localisation_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Localisation', 'ecole_localisation', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_codenature field
            //
            $editor = new TextEdit('ecole_codenature_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Codenature', 'ecole_codenature', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ecole_dateouverture field
            //
            $editor = new TextEdit('ecole_dateouverture_edit');
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Ecole Dateouverture', 'ecole_dateouverture', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
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
            $editColumn = new DynamicLookupEditColumn('Doccsi Id', 'doccsi_id', 'doccsi_id_doccsi_fichier', 'insert_ecole_doccsi_id_search', $editor, $this->dataset, $lookupDataset, 'doccsi_id', 'doccsi_fichier', '');
            $editColumn->setNestedInsertFormLink(
                $this->GetHandlerLink(ecole_doccsi_idNestedPage::getNestedInsertHandlerName())
            );
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
            // View column for ecole_id field
            //
            $column = new NumberViewColumn('ecole_id', 'ecole_id', 'Ecole Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_RNE', 'ecole_RNE', 'Ecole RNE', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_lat field
            //
            $column = new TextViewColumn('ecole_lat', 'ecole_lat', 'Ecole Lat', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_long field
            //
            $column = new TextViewColumn('ecole_long', 'ecole_long', 'Ecole Long', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_latlong field
            //
            $column = new TextViewColumn('ecole_latlong', 'ecole_latlong', 'Ecole Latlong', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_coord field
            //
            $column = new TextViewColumn('ecole_coord', 'ecole_coord', 'Ecole Coord', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_appellation field
            //
            $column = new TextViewColumn('ecole_appellation', 'ecole_appellation', 'Ecole Appellation', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_denominationprincipale field
            //
            $column = new TextViewColumn('ecole_denominationprincipale', 'ecole_denominationprincipale', 'Ecole Denominationprincipale', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_patronymeuai field
            //
            $column = new TextViewColumn('ecole_patronymeuai', 'ecole_patronymeuai', 'Ecole Patronymeuai', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_secteur field
            //
            $column = new TextViewColumn('ecole_secteur', 'ecole_secteur', 'Ecole Secteur', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_adresse field
            //
            $column = new TextViewColumn('ecole_adresse', 'ecole_adresse', 'Ecole Adresse', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_lieudit field
            //
            $column = new TextViewColumn('ecole_lieudit', 'ecole_lieudit', 'Ecole Lieudit', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_boitepostale field
            //
            $column = new TextViewColumn('ecole_boitepostale', 'ecole_boitepostale', 'Ecole Boitepostale', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_codepostal field
            //
            $column = new TextViewColumn('ecole_codepostal', 'ecole_codepostal', 'Ecole Codepostal', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_localiteacheminement field
            //
            $column = new TextViewColumn('ecole_localiteacheminement', 'ecole_localiteacheminement', 'Ecole Localiteacheminement', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_commune field
            //
            $column = new TextViewColumn('ecole_commune', 'ecole_commune', 'Ecole Commune', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_coordonneex field
            //
            $column = new TextViewColumn('ecole_coordonneex', 'ecole_coordonneex', 'Ecole Coordonneex', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_coordonneey field
            //
            $column = new TextViewColumn('ecole_coordonneey', 'ecole_coordonneey', 'Ecole Coordonneey', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_epasg field
            //
            $column = new TextViewColumn('ecole_epasg', 'ecole_epasg', 'Ecole Epasg', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_qualite field
            //
            $column = new TextViewColumn('ecole_qualite', 'ecole_qualite', 'Ecole Qualite', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_localisation field
            //
            $column = new TextViewColumn('ecole_localisation', 'ecole_localisation', 'Ecole Localisation', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_codenature field
            //
            $column = new TextViewColumn('ecole_codenature', 'ecole_codenature', 'Ecole Codenature', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ecole_dateouverture field
            //
            $column = new TextViewColumn('ecole_dateouverture', 'ecole_dateouverture', 'Ecole Dateouverture', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for doccsi_fichier field
            //
            $column = new TextViewColumn('doccsi_id', 'doccsi_id_doccsi_fichier', 'Doccsi Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for ecole_id field
            //
            $column = new NumberViewColumn('ecole_id', 'ecole_id', 'Ecole Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_RNE', 'ecole_RNE', 'Ecole RNE', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_lat field
            //
            $column = new TextViewColumn('ecole_lat', 'ecole_lat', 'Ecole Lat', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_long field
            //
            $column = new TextViewColumn('ecole_long', 'ecole_long', 'Ecole Long', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_latlong field
            //
            $column = new TextViewColumn('ecole_latlong', 'ecole_latlong', 'Ecole Latlong', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_coord field
            //
            $column = new TextViewColumn('ecole_coord', 'ecole_coord', 'Ecole Coord', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_appellation field
            //
            $column = new TextViewColumn('ecole_appellation', 'ecole_appellation', 'Ecole Appellation', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_denominationprincipale field
            //
            $column = new TextViewColumn('ecole_denominationprincipale', 'ecole_denominationprincipale', 'Ecole Denominationprincipale', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_patronymeuai field
            //
            $column = new TextViewColumn('ecole_patronymeuai', 'ecole_patronymeuai', 'Ecole Patronymeuai', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_secteur field
            //
            $column = new TextViewColumn('ecole_secteur', 'ecole_secteur', 'Ecole Secteur', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_adresse field
            //
            $column = new TextViewColumn('ecole_adresse', 'ecole_adresse', 'Ecole Adresse', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_lieudit field
            //
            $column = new TextViewColumn('ecole_lieudit', 'ecole_lieudit', 'Ecole Lieudit', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_boitepostale field
            //
            $column = new TextViewColumn('ecole_boitepostale', 'ecole_boitepostale', 'Ecole Boitepostale', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_codepostal field
            //
            $column = new TextViewColumn('ecole_codepostal', 'ecole_codepostal', 'Ecole Codepostal', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_localiteacheminement field
            //
            $column = new TextViewColumn('ecole_localiteacheminement', 'ecole_localiteacheminement', 'Ecole Localiteacheminement', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_commune field
            //
            $column = new TextViewColumn('ecole_commune', 'ecole_commune', 'Ecole Commune', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_coordonneex field
            //
            $column = new TextViewColumn('ecole_coordonneex', 'ecole_coordonneex', 'Ecole Coordonneex', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_coordonneey field
            //
            $column = new TextViewColumn('ecole_coordonneey', 'ecole_coordonneey', 'Ecole Coordonneey', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_epasg field
            //
            $column = new TextViewColumn('ecole_epasg', 'ecole_epasg', 'Ecole Epasg', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_qualite field
            //
            $column = new TextViewColumn('ecole_qualite', 'ecole_qualite', 'Ecole Qualite', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_localisation field
            //
            $column = new TextViewColumn('ecole_localisation', 'ecole_localisation', 'Ecole Localisation', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_codenature field
            //
            $column = new TextViewColumn('ecole_codenature', 'ecole_codenature', 'Ecole Codenature', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for ecole_dateouverture field
            //
            $column = new TextViewColumn('ecole_dateouverture', 'ecole_dateouverture', 'Ecole Dateouverture', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for doccsi_fichier field
            //
            $column = new TextViewColumn('doccsi_id', 'doccsi_id_doccsi_fichier', 'Doccsi Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_RNE', 'ecole_RNE', 'Ecole RNE', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_lat field
            //
            $column = new TextViewColumn('ecole_lat', 'ecole_lat', 'Ecole Lat', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_long field
            //
            $column = new TextViewColumn('ecole_long', 'ecole_long', 'Ecole Long', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_latlong field
            //
            $column = new TextViewColumn('ecole_latlong', 'ecole_latlong', 'Ecole Latlong', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_coord field
            //
            $column = new TextViewColumn('ecole_coord', 'ecole_coord', 'Ecole Coord', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_appellation field
            //
            $column = new TextViewColumn('ecole_appellation', 'ecole_appellation', 'Ecole Appellation', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_denominationprincipale field
            //
            $column = new TextViewColumn('ecole_denominationprincipale', 'ecole_denominationprincipale', 'Ecole Denominationprincipale', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_patronymeuai field
            //
            $column = new TextViewColumn('ecole_patronymeuai', 'ecole_patronymeuai', 'Ecole Patronymeuai', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_secteur field
            //
            $column = new TextViewColumn('ecole_secteur', 'ecole_secteur', 'Ecole Secteur', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_adresse field
            //
            $column = new TextViewColumn('ecole_adresse', 'ecole_adresse', 'Ecole Adresse', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_lieudit field
            //
            $column = new TextViewColumn('ecole_lieudit', 'ecole_lieudit', 'Ecole Lieudit', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_boitepostale field
            //
            $column = new TextViewColumn('ecole_boitepostale', 'ecole_boitepostale', 'Ecole Boitepostale', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_codepostal field
            //
            $column = new TextViewColumn('ecole_codepostal', 'ecole_codepostal', 'Ecole Codepostal', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_localiteacheminement field
            //
            $column = new TextViewColumn('ecole_localiteacheminement', 'ecole_localiteacheminement', 'Ecole Localiteacheminement', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_commune field
            //
            $column = new TextViewColumn('ecole_commune', 'ecole_commune', 'Ecole Commune', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_coordonneex field
            //
            $column = new TextViewColumn('ecole_coordonneex', 'ecole_coordonneex', 'Ecole Coordonneex', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_coordonneey field
            //
            $column = new TextViewColumn('ecole_coordonneey', 'ecole_coordonneey', 'Ecole Coordonneey', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_epasg field
            //
            $column = new TextViewColumn('ecole_epasg', 'ecole_epasg', 'Ecole Epasg', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_qualite field
            //
            $column = new TextViewColumn('ecole_qualite', 'ecole_qualite', 'Ecole Qualite', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_localisation field
            //
            $column = new TextViewColumn('ecole_localisation', 'ecole_localisation', 'Ecole Localisation', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_codenature field
            //
            $column = new TextViewColumn('ecole_codenature', 'ecole_codenature', 'Ecole Codenature', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for ecole_dateouverture field
            //
            $column = new TextViewColumn('ecole_dateouverture', 'ecole_dateouverture', 'Ecole Dateouverture', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for doccsi_fichier field
            //
            $column = new TextViewColumn('doccsi_id', 'doccsi_id_doccsi_fichier', 'Doccsi Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
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
            $detailPage = new ecole_demande_ameliorationPage('ecole_demande_amelioration', $this, array('ecole_ecole_id'), array('ecole_id'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionsForPage('ecole.demande_amelioration'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('ecole.demande_amelioration'));
            $detailPage->SetHttpHandlerName('ecole_demande_amelioration_handler');
            $handler = new PageHTTPHandler('ecole_demande_amelioration_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $detailPage = new ecole_demande_interventionPage('ecole_demande_intervention', $this, array('ecole_ecole_id'), array('ecole_id'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionsForPage('ecole.demande_intervention'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('ecole.demande_intervention'));
            $detailPage->SetHttpHandlerName('ecole_demande_intervention_handler');
            $handler = new PageHTTPHandler('ecole_demande_intervention_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $detailPage = new ecole_demande_sstPage('ecole_demande_sst', $this, array('ecole_ecole_id'), array('ecole_id'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionsForPage('ecole.demande_sst'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('ecole.demande_sst'));
            $detailPage->SetHttpHandlerName('ecole_demande_sst_handler');
            $handler = new PageHTTPHandler('ecole_demande_sst_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $detailPage = new ecole_informationdynamiquePage('ecole_informationdynamique', $this, array('ecole_ecole_id'), array('ecole_id'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionsForPage('ecole.informationdynamique'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('ecole.informationdynamique'));
            $detailPage->SetHttpHandlerName('ecole_informationdynamique_handler');
            $handler = new PageHTTPHandler('ecole_informationdynamique_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $detailPage = new ecole_zoneadministrative_has_ecolePage('ecole_zoneadministrative_has_ecole', $this, array('ecole_ecole_id'), array('ecole_id'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionsForPage('ecole.zoneadministrative_has_ecole'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('ecole.zoneadministrative_has_ecole'));
            $detailPage->SetHttpHandlerName('ecole_zoneadministrative_has_ecole_handler');
            $handler = new PageHTTPHandler('ecole_zoneadministrative_has_ecole_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_ecole_doccsi_id_search', 'doccsi_id', 'doccsi_fichier', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_ecole_doccsi_id_search', 'doccsi_id', 'doccsi_fichier', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_ecole_doccsi_id_search', 'doccsi_id', 'doccsi_fichier', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_ecole_doccsi_id_search', 'doccsi_id', 'doccsi_fichier', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            
            
            new ecole_doccsi_idNestedPage($this, GetCurrentUserPermissionsForPage('ecole.doccsi_id'));
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
            if ($mode=='insert' or $mode=='edit' or $mode=='view') {                     
              
              $layout->setMode(FormLayoutMode::VERTICAL);          
              $layout->enableTabs(FormTabsStyle::TABS);                
              
                $identiteTab = $layout->addTab('Identité');
                $identiteTab->setMode(FormLayoutMode::HORIZONTAL);
                
                $descriptionGroup = $identiteTab->addGroup('Description');                
                $descriptionGroup->addRow()->addCol($columns['ecole_RNE'], 4, 2) ;                       
                
                $responsablesTab = $layout->addTab('Responsables');
                $descriptionGroup1 = $responsablesTab->addGroup('Description');                
                $descriptionGroup1->addRow()->addCol($columns['ecole_lat'], 4, 2) ;                       
                
                $csiTab = $layout->addTab('CSI');
                $descriptionGroup2 = $csiTab->addGroup('Description');                
                $descriptionGroup2->addRow()->addCol($columns['ecole_long'], 4, 2) ;                       
                
                $amianteTab = $layout->addTab('Amiante');
                $descriptionGroup3 = $amianteTab->addGroup('Description');                
                $descriptionGroup3->addRow()->addCol($columns['ecole_latlong'], 4, 2) ;                       
                
                $audit2019Tab = $layout->addTab('Audit 2019');
                $descriptionGroup4 = $audit2019Tab->addGroup('Description');                
                $descriptionGroup4->addRow()->addCol($columns['ecole_denominationprincipale'], 4, 2) ;                       
                
                $interpellerTab = $layout->addTab('Interpeller');
                $descriptionGroup5 = $interpellerTab->addGroup('Description');                
                $descriptionGroup5->addRow()->addCol($columns['ecole_patronymeuai'], 4, 2) ;                       
                
                                                                
            }
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
        $Page = new ecolePage("ecole", "ecole.php", GetCurrentUserPermissionsForPage("ecole"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("ecole"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
