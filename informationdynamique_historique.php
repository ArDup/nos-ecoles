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
    
    
    
    class informationdynamique_historiquePage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Informationdynamique Historique');
            $this->SetMenuLabel('Informationdynamique Historique');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`informationdynamique_historique`');
            $this->dataset->addFields(
                array(
                    new IntegerField('informationdynamique_id', true, true),
                    new IntegerField('informationdynamique_classe_qte'),
                    new IntegerField('millesime_millesime_id', true, true),
                    new IntegerField('utilisateur_utilisateur_id', true, true),
                    new IntegerField('utilisateur_utilisateur_id1', true, true)
                )
            );
            $this->dataset->AddLookupField('millesime_millesime_id', 'millesime', new IntegerField('millesime_id'), new StringField('millesime_designation', false, false, false, false, 'millesime_millesime_id_millesime_designation', 'millesime_millesime_id_millesime_designation_millesime'), 'millesime_millesime_id_millesime_designation_millesime');
            $this->dataset->AddLookupField('utilisateur_utilisateur_id', 'utilisateur', new IntegerField('utilisateur_id'), new StringField('utilisateur_nom', false, false, false, false, 'utilisateur_utilisateur_id_utilisateur_nom', 'utilisateur_utilisateur_id_utilisateur_nom_utilisateur'), 'utilisateur_utilisateur_id_utilisateur_nom_utilisateur');
            $this->dataset->AddLookupField('utilisateur_utilisateur_id1', 'utilisateur', new IntegerField('utilisateur_id'), new StringField('utilisateur_nom', false, false, false, false, 'utilisateur_utilisateur_id1_utilisateur_nom', 'utilisateur_utilisateur_id1_utilisateur_nom_utilisateur'), 'utilisateur_utilisateur_id1_utilisateur_nom_utilisateur');
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
                new FilterColumn($this->dataset, 'utilisateur_utilisateur_id', 'utilisateur_utilisateur_id_utilisateur_nom', 'Utilisateur Utilisateur Id'),
                new FilterColumn($this->dataset, 'utilisateur_utilisateur_id1', 'utilisateur_utilisateur_id1_utilisateur_nom', 'Utilisateur Utilisateur Id1')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['informationdynamique_id'])
                ->addColumn($columns['informationdynamique_classe_qte'])
                ->addColumn($columns['millesime_millesime_id'])
                ->addColumn($columns['utilisateur_utilisateur_id'])
                ->addColumn($columns['utilisateur_utilisateur_id1']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('millesime_millesime_id')
                ->setOptionsFor('utilisateur_utilisateur_id')
                ->setOptionsFor('utilisateur_utilisateur_id1');
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
            $main_editor->SetHandlerName('filter_builder_informationdynamique_historique_millesime_millesime_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('millesime_millesime_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_informationdynamique_historique_millesime_millesime_id_search');
            
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
            
            $main_editor = new DynamicCombobox('utilisateur_utilisateur_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_informationdynamique_historique_utilisateur_utilisateur_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('utilisateur_utilisateur_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_informationdynamique_historique_utilisateur_utilisateur_id_search');
            
            $text_editor = new TextEdit('utilisateur_utilisateur_id');
            
            $filterBuilder->addColumn(
                $columns['utilisateur_utilisateur_id'],
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
            
            $main_editor = new DynamicCombobox('utilisateur_utilisateur_id1_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_informationdynamique_historique_utilisateur_utilisateur_id1_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('utilisateur_utilisateur_id1', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_informationdynamique_historique_utilisateur_utilisateur_id1_search');
            
            $text_editor = new TextEdit('utilisateur_utilisateur_id1');
            
            $filterBuilder->addColumn(
                $columns['utilisateur_utilisateur_id1'],
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
            // View column for utilisateur_nom field
            //
            $column = new TextViewColumn('utilisateur_utilisateur_id', 'utilisateur_utilisateur_id_utilisateur_nom', 'Utilisateur Utilisateur Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for utilisateur_nom field
            //
            $column = new TextViewColumn('utilisateur_utilisateur_id1', 'utilisateur_utilisateur_id1_utilisateur_nom', 'Utilisateur Utilisateur Id1', $this->dataset);
            $column->SetOrderable(true);
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
            // View column for utilisateur_nom field
            //
            $column = new TextViewColumn('utilisateur_utilisateur_id', 'utilisateur_utilisateur_id_utilisateur_nom', 'Utilisateur Utilisateur Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for utilisateur_nom field
            //
            $column = new TextViewColumn('utilisateur_utilisateur_id1', 'utilisateur_utilisateur_id1_utilisateur_nom', 'Utilisateur Utilisateur Id1', $this->dataset);
            $column->SetOrderable(true);
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
            $editColumn = new DynamicLookupEditColumn('Millesime Millesime Id', 'millesime_millesime_id', 'millesime_millesime_id_millesime_designation', 'edit_informationdynamique_historique_millesime_millesime_id_search', $editor, $this->dataset, $lookupDataset, 'millesime_id', 'millesime_designation', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for utilisateur_utilisateur_id field
            //
            $editor = new DynamicCombobox('utilisateur_utilisateur_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`utilisateur`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('utilisateur_id', true, true, true),
                    new StringField('utilisateur_nom', true),
                    new StringField('utilisateur_prenom', true),
                    new StringField('utilisateur_email', true),
                    new StringField('utilisateur_password', true),
                    new IntegerField('domaineofficiel_domaineofficiel_id'),
                    new IntegerField('avatar_avatar_id')
                )
            );
            $lookupDataset->setOrderByField('utilisateur_nom', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Utilisateur Utilisateur Id', 'utilisateur_utilisateur_id', 'utilisateur_utilisateur_id_utilisateur_nom', 'edit_informationdynamique_historique_utilisateur_utilisateur_id_search', $editor, $this->dataset, $lookupDataset, 'utilisateur_id', 'utilisateur_nom', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for utilisateur_utilisateur_id1 field
            //
            $editor = new DynamicCombobox('utilisateur_utilisateur_id1_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`utilisateur`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('utilisateur_id', true, true, true),
                    new StringField('utilisateur_nom', true),
                    new StringField('utilisateur_prenom', true),
                    new StringField('utilisateur_email', true),
                    new StringField('utilisateur_password', true),
                    new IntegerField('domaineofficiel_domaineofficiel_id'),
                    new IntegerField('avatar_avatar_id')
                )
            );
            $lookupDataset->setOrderByField('utilisateur_nom', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Utilisateur Utilisateur Id1', 'utilisateur_utilisateur_id1', 'utilisateur_utilisateur_id1_utilisateur_nom', 'edit_informationdynamique_historique_utilisateur_utilisateur_id1_search', $editor, $this->dataset, $lookupDataset, 'utilisateur_id', 'utilisateur_nom', '');
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
            $editColumn = new DynamicLookupEditColumn('Millesime Millesime Id', 'millesime_millesime_id', 'millesime_millesime_id_millesime_designation', 'insert_informationdynamique_historique_millesime_millesime_id_search', $editor, $this->dataset, $lookupDataset, 'millesime_id', 'millesime_designation', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for utilisateur_utilisateur_id field
            //
            $editor = new DynamicCombobox('utilisateur_utilisateur_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`utilisateur`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('utilisateur_id', true, true, true),
                    new StringField('utilisateur_nom', true),
                    new StringField('utilisateur_prenom', true),
                    new StringField('utilisateur_email', true),
                    new StringField('utilisateur_password', true),
                    new IntegerField('domaineofficiel_domaineofficiel_id'),
                    new IntegerField('avatar_avatar_id')
                )
            );
            $lookupDataset->setOrderByField('utilisateur_nom', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Utilisateur Utilisateur Id', 'utilisateur_utilisateur_id', 'utilisateur_utilisateur_id_utilisateur_nom', 'insert_informationdynamique_historique_utilisateur_utilisateur_id_search', $editor, $this->dataset, $lookupDataset, 'utilisateur_id', 'utilisateur_nom', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for utilisateur_utilisateur_id1 field
            //
            $editor = new DynamicCombobox('utilisateur_utilisateur_id1_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`utilisateur`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('utilisateur_id', true, true, true),
                    new StringField('utilisateur_nom', true),
                    new StringField('utilisateur_prenom', true),
                    new StringField('utilisateur_email', true),
                    new StringField('utilisateur_password', true),
                    new IntegerField('domaineofficiel_domaineofficiel_id'),
                    new IntegerField('avatar_avatar_id')
                )
            );
            $lookupDataset->setOrderByField('utilisateur_nom', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Utilisateur Utilisateur Id1', 'utilisateur_utilisateur_id1', 'utilisateur_utilisateur_id1_utilisateur_nom', 'insert_informationdynamique_historique_utilisateur_utilisateur_id1_search', $editor, $this->dataset, $lookupDataset, 'utilisateur_id', 'utilisateur_nom', '');
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
            // View column for utilisateur_nom field
            //
            $column = new TextViewColumn('utilisateur_utilisateur_id', 'utilisateur_utilisateur_id_utilisateur_nom', 'Utilisateur Utilisateur Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for utilisateur_nom field
            //
            $column = new TextViewColumn('utilisateur_utilisateur_id1', 'utilisateur_utilisateur_id1_utilisateur_nom', 'Utilisateur Utilisateur Id1', $this->dataset);
            $column->SetOrderable(true);
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
            // View column for utilisateur_nom field
            //
            $column = new TextViewColumn('utilisateur_utilisateur_id', 'utilisateur_utilisateur_id_utilisateur_nom', 'Utilisateur Utilisateur Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for utilisateur_nom field
            //
            $column = new TextViewColumn('utilisateur_utilisateur_id1', 'utilisateur_utilisateur_id1_utilisateur_nom', 'Utilisateur Utilisateur Id1', $this->dataset);
            $column->SetOrderable(true);
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
            // View column for utilisateur_nom field
            //
            $column = new TextViewColumn('utilisateur_utilisateur_id', 'utilisateur_utilisateur_id_utilisateur_nom', 'Utilisateur Utilisateur Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for utilisateur_nom field
            //
            $column = new TextViewColumn('utilisateur_utilisateur_id1', 'utilisateur_utilisateur_id1_utilisateur_nom', 'Utilisateur Utilisateur Id1', $this->dataset);
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
                '`millesime`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('millesime_id', true, true),
                    new StringField('millesime_designation')
                )
            );
            $lookupDataset->setOrderByField('millesime_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_informationdynamique_historique_millesime_millesime_id_search', 'millesime_id', 'millesime_designation', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`utilisateur`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('utilisateur_id', true, true, true),
                    new StringField('utilisateur_nom', true),
                    new StringField('utilisateur_prenom', true),
                    new StringField('utilisateur_email', true),
                    new StringField('utilisateur_password', true),
                    new IntegerField('domaineofficiel_domaineofficiel_id'),
                    new IntegerField('avatar_avatar_id')
                )
            );
            $lookupDataset->setOrderByField('utilisateur_nom', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_informationdynamique_historique_utilisateur_utilisateur_id_search', 'utilisateur_id', 'utilisateur_nom', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`utilisateur`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('utilisateur_id', true, true, true),
                    new StringField('utilisateur_nom', true),
                    new StringField('utilisateur_prenom', true),
                    new StringField('utilisateur_email', true),
                    new StringField('utilisateur_password', true),
                    new IntegerField('domaineofficiel_domaineofficiel_id'),
                    new IntegerField('avatar_avatar_id')
                )
            );
            $lookupDataset->setOrderByField('utilisateur_nom', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_informationdynamique_historique_utilisateur_utilisateur_id1_search', 'utilisateur_id', 'utilisateur_nom', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_informationdynamique_historique_millesime_millesime_id_search', 'millesime_id', 'millesime_designation', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`utilisateur`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('utilisateur_id', true, true, true),
                    new StringField('utilisateur_nom', true),
                    new StringField('utilisateur_prenom', true),
                    new StringField('utilisateur_email', true),
                    new StringField('utilisateur_password', true),
                    new IntegerField('domaineofficiel_domaineofficiel_id'),
                    new IntegerField('avatar_avatar_id')
                )
            );
            $lookupDataset->setOrderByField('utilisateur_nom', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_informationdynamique_historique_utilisateur_utilisateur_id_search', 'utilisateur_id', 'utilisateur_nom', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`utilisateur`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('utilisateur_id', true, true, true),
                    new StringField('utilisateur_nom', true),
                    new StringField('utilisateur_prenom', true),
                    new StringField('utilisateur_email', true),
                    new StringField('utilisateur_password', true),
                    new IntegerField('domaineofficiel_domaineofficiel_id'),
                    new IntegerField('avatar_avatar_id')
                )
            );
            $lookupDataset->setOrderByField('utilisateur_nom', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_informationdynamique_historique_utilisateur_utilisateur_id1_search', 'utilisateur_id', 'utilisateur_nom', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_informationdynamique_historique_millesime_millesime_id_search', 'millesime_id', 'millesime_designation', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`utilisateur`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('utilisateur_id', true, true, true),
                    new StringField('utilisateur_nom', true),
                    new StringField('utilisateur_prenom', true),
                    new StringField('utilisateur_email', true),
                    new StringField('utilisateur_password', true),
                    new IntegerField('domaineofficiel_domaineofficiel_id'),
                    new IntegerField('avatar_avatar_id')
                )
            );
            $lookupDataset->setOrderByField('utilisateur_nom', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_informationdynamique_historique_utilisateur_utilisateur_id_search', 'utilisateur_id', 'utilisateur_nom', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`utilisateur`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('utilisateur_id', true, true, true),
                    new StringField('utilisateur_nom', true),
                    new StringField('utilisateur_prenom', true),
                    new StringField('utilisateur_email', true),
                    new StringField('utilisateur_password', true),
                    new IntegerField('domaineofficiel_domaineofficiel_id'),
                    new IntegerField('avatar_avatar_id')
                )
            );
            $lookupDataset->setOrderByField('utilisateur_nom', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_informationdynamique_historique_utilisateur_utilisateur_id1_search', 'utilisateur_id', 'utilisateur_nom', null, 20);
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
        $Page = new informationdynamique_historiquePage("informationdynamique_historique", "informationdynamique_historique.php", GetCurrentUserPermissionsForPage("informationdynamique_historique"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("informationdynamique_historique"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
