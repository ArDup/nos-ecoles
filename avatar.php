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
    
    
    
    class avatar_utilisateurPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Utilisateur');
            $this->SetMenuLabel('Utilisateur');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`utilisateur`');
            $this->dataset->addFields(
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
            $this->dataset->AddLookupField('domaineofficiel_domaineofficiel_id', 'domaineofficiel', new IntegerField('domaineofficiel_id'), new StringField('domaineofficiel_designation', false, false, false, false, 'domaineofficiel_domaineofficiel_id_domaineofficiel_designation', 'domaineofficiel_domaineofficiel_id_domaineofficiel_designation_domaineofficiel'), 'domaineofficiel_domaineofficiel_id_domaineofficiel_designation_domaineofficiel');
            $this->dataset->AddLookupField('avatar_avatar_id', 'avatar', new IntegerField('avatar_id'), new StringField('avatar_nom', false, false, false, false, 'avatar_avatar_id_avatar_nom', 'avatar_avatar_id_avatar_nom_avatar'), 'avatar_avatar_id_avatar_nom_avatar');
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
                new FilterColumn($this->dataset, 'utilisateur_id', 'utilisateur_id', 'Utilisateur Id'),
                new FilterColumn($this->dataset, 'utilisateur_nom', 'utilisateur_nom', 'Utilisateur Nom'),
                new FilterColumn($this->dataset, 'utilisateur_prenom', 'utilisateur_prenom', 'Utilisateur Prenom'),
                new FilterColumn($this->dataset, 'utilisateur_email', 'utilisateur_email', 'Utilisateur Email'),
                new FilterColumn($this->dataset, 'utilisateur_password', 'utilisateur_password', 'Utilisateur Password'),
                new FilterColumn($this->dataset, 'domaineofficiel_domaineofficiel_id', 'domaineofficiel_domaineofficiel_id_domaineofficiel_designation', 'Domaineofficiel Domaineofficiel Id'),
                new FilterColumn($this->dataset, 'avatar_avatar_id', 'avatar_avatar_id_avatar_nom', 'Avatar Avatar Id')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['utilisateur_id'])
                ->addColumn($columns['utilisateur_nom'])
                ->addColumn($columns['utilisateur_prenom'])
                ->addColumn($columns['utilisateur_email'])
                ->addColumn($columns['utilisateur_password'])
                ->addColumn($columns['domaineofficiel_domaineofficiel_id'])
                ->addColumn($columns['avatar_avatar_id']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('domaineofficiel_domaineofficiel_id')
                ->setOptionsFor('avatar_avatar_id');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('utilisateur_id_edit');
            
            $filterBuilder->addColumn(
                $columns['utilisateur_id'],
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
            
            $main_editor = new TextEdit('utilisateur_nom_edit');
            $main_editor->SetMaxLength(45);
            
            $filterBuilder->addColumn(
                $columns['utilisateur_nom'],
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
            
            $main_editor = new TextEdit('utilisateur_prenom_edit');
            $main_editor->SetMaxLength(45);
            
            $filterBuilder->addColumn(
                $columns['utilisateur_prenom'],
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
            
            $main_editor = new TextEdit('utilisateur_email_edit');
            $main_editor->SetMaxLength(45);
            
            $filterBuilder->addColumn(
                $columns['utilisateur_email'],
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
            
            $main_editor = new TextEdit('utilisateur_password_edit');
            $main_editor->SetMaxLength(45);
            
            $filterBuilder->addColumn(
                $columns['utilisateur_password'],
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
            
            $main_editor = new DynamicCombobox('domaineofficiel_domaineofficiel_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_avatar_utilisateur_domaineofficiel_domaineofficiel_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('domaineofficiel_domaineofficiel_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_avatar_utilisateur_domaineofficiel_domaineofficiel_id_search');
            
            $text_editor = new TextEdit('domaineofficiel_domaineofficiel_id');
            
            $filterBuilder->addColumn(
                $columns['domaineofficiel_domaineofficiel_id'],
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
            
            $main_editor = new DynamicCombobox('avatar_avatar_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_avatar_utilisateur_avatar_avatar_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('avatar_avatar_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_avatar_utilisateur_avatar_avatar_id_search');
            
            $text_editor = new TextEdit('avatar_avatar_id');
            
            $filterBuilder->addColumn(
                $columns['avatar_avatar_id'],
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
            // View column for utilisateur_id field
            //
            $column = new NumberViewColumn('utilisateur_id', 'utilisateur_id', 'Utilisateur Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Id');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for utilisateur_nom field
            //
            $column = new TextViewColumn('utilisateur_nom', 'utilisateur_nom', 'Utilisateur Nom', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Nom');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for utilisateur_prenom field
            //
            $column = new TextViewColumn('utilisateur_prenom', 'utilisateur_prenom', 'Utilisateur Prenom', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('PrÃ©nom');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for utilisateur_email field
            //
            $column = new TextViewColumn('utilisateur_email', 'utilisateur_email', 'Utilisateur Email', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Email');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for utilisateur_password field
            //
            $column = new TextViewColumn('utilisateur_password', 'utilisateur_password', 'Utilisateur Password', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for domaineofficiel_designation field
            //
            $column = new TextViewColumn('domaineofficiel_domaineofficiel_id', 'domaineofficiel_domaineofficiel_id_domaineofficiel_designation', 'Domaineofficiel Domaineofficiel Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for avatar_nom field
            //
            $column = new TextViewColumn('avatar_avatar_id', 'avatar_avatar_id_avatar_nom', 'Avatar Avatar Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for utilisateur_id field
            //
            $column = new NumberViewColumn('utilisateur_id', 'utilisateur_id', 'Utilisateur Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for utilisateur_nom field
            //
            $column = new TextViewColumn('utilisateur_nom', 'utilisateur_nom', 'Utilisateur Nom', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for utilisateur_prenom field
            //
            $column = new TextViewColumn('utilisateur_prenom', 'utilisateur_prenom', 'Utilisateur Prenom', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for utilisateur_email field
            //
            $column = new TextViewColumn('utilisateur_email', 'utilisateur_email', 'Utilisateur Email', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for utilisateur_password field
            //
            $column = new TextViewColumn('utilisateur_password', 'utilisateur_password', 'Utilisateur Password', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for domaineofficiel_designation field
            //
            $column = new TextViewColumn('domaineofficiel_domaineofficiel_id', 'domaineofficiel_domaineofficiel_id_domaineofficiel_designation', 'Domaineofficiel Domaineofficiel Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for avatar_nom field
            //
            $column = new TextViewColumn('avatar_avatar_id', 'avatar_avatar_id_avatar_nom', 'Avatar Avatar Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for utilisateur_id field
            //
            $editor = new TextEdit('utilisateur_id_edit');
            $editColumn = new CustomEditColumn('Utilisateur Id', 'utilisateur_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for utilisateur_nom field
            //
            $editor = new TextEdit('utilisateur_nom_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Utilisateur Nom', 'utilisateur_nom', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for utilisateur_prenom field
            //
            $editor = new TextEdit('utilisateur_prenom_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Utilisateur Prenom', 'utilisateur_prenom', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for utilisateur_email field
            //
            $editor = new TextEdit('utilisateur_email_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Utilisateur Email', 'utilisateur_email', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for utilisateur_password field
            //
            $editor = new TextEdit('utilisateur_password_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Utilisateur Password', 'utilisateur_password', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for domaineofficiel_domaineofficiel_id field
            //
            $editor = new DynamicCombobox('domaineofficiel_domaineofficiel_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`domaineofficiel`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('domaineofficiel_id', true, true),
                    new StringField('domaineofficiel_designation')
                )
            );
            $lookupDataset->setOrderByField('domaineofficiel_designation', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Domaineofficiel Domaineofficiel Id', 'domaineofficiel_domaineofficiel_id', 'domaineofficiel_domaineofficiel_id_domaineofficiel_designation', 'edit_avatar_utilisateur_domaineofficiel_domaineofficiel_id_search', $editor, $this->dataset, $lookupDataset, 'domaineofficiel_id', 'domaineofficiel_designation', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for avatar_avatar_id field
            //
            $editor = new DynamicCombobox('avatar_avatar_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`avatar`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('avatar_id', true, true),
                    new StringField('avatar_nom'),
                    new StringField('avatar_prenom'),
                    new StringField('avatar_dt_naissance')
                )
            );
            $lookupDataset->setOrderByField('avatar_nom', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Avatar Avatar Id', 'avatar_avatar_id', 'avatar_avatar_id_avatar_nom', 'edit_avatar_utilisateur_avatar_avatar_id_search', $editor, $this->dataset, $lookupDataset, 'avatar_id', 'avatar_nom', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for utilisateur_nom field
            //
            $editor = new TextEdit('utilisateur_nom_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Utilisateur Nom', 'utilisateur_nom', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for utilisateur_prenom field
            //
            $editor = new TextEdit('utilisateur_prenom_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Utilisateur Prenom', 'utilisateur_prenom', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for utilisateur_email field
            //
            $editor = new TextEdit('utilisateur_email_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Utilisateur Email', 'utilisateur_email', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for utilisateur_password field
            //
            $editor = new TextEdit('utilisateur_password_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Utilisateur Password', 'utilisateur_password', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for domaineofficiel_domaineofficiel_id field
            //
            $editor = new DynamicCombobox('domaineofficiel_domaineofficiel_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`domaineofficiel`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('domaineofficiel_id', true, true),
                    new StringField('domaineofficiel_designation')
                )
            );
            $lookupDataset->setOrderByField('domaineofficiel_designation', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Domaineofficiel Domaineofficiel Id', 'domaineofficiel_domaineofficiel_id', 'domaineofficiel_domaineofficiel_id_domaineofficiel_designation', 'multi_edit_avatar_utilisateur_domaineofficiel_domaineofficiel_id_search', $editor, $this->dataset, $lookupDataset, 'domaineofficiel_id', 'domaineofficiel_designation', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for avatar_avatar_id field
            //
            $editor = new DynamicCombobox('avatar_avatar_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`avatar`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('avatar_id', true, true),
                    new StringField('avatar_nom'),
                    new StringField('avatar_prenom'),
                    new StringField('avatar_dt_naissance')
                )
            );
            $lookupDataset->setOrderByField('avatar_nom', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Avatar Avatar Id', 'avatar_avatar_id', 'avatar_avatar_id_avatar_nom', 'multi_edit_avatar_utilisateur_avatar_avatar_id_search', $editor, $this->dataset, $lookupDataset, 'avatar_id', 'avatar_nom', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for utilisateur_id field
            //
            $editor = new TextEdit('utilisateur_id_edit');
            $editColumn = new CustomEditColumn('Utilisateur Id', 'utilisateur_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for utilisateur_nom field
            //
            $editor = new TextEdit('utilisateur_nom_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Utilisateur Nom', 'utilisateur_nom', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for utilisateur_prenom field
            //
            $editor = new TextEdit('utilisateur_prenom_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Utilisateur Prenom', 'utilisateur_prenom', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for utilisateur_email field
            //
            $editor = new TextEdit('utilisateur_email_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Utilisateur Email', 'utilisateur_email', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for utilisateur_password field
            //
            $editor = new TextEdit('utilisateur_password_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Utilisateur Password', 'utilisateur_password', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for domaineofficiel_domaineofficiel_id field
            //
            $editor = new DynamicCombobox('domaineofficiel_domaineofficiel_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`domaineofficiel`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('domaineofficiel_id', true, true),
                    new StringField('domaineofficiel_designation')
                )
            );
            $lookupDataset->setOrderByField('domaineofficiel_designation', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Domaineofficiel Domaineofficiel Id', 'domaineofficiel_domaineofficiel_id', 'domaineofficiel_domaineofficiel_id_domaineofficiel_designation', 'insert_avatar_utilisateur_domaineofficiel_domaineofficiel_id_search', $editor, $this->dataset, $lookupDataset, 'domaineofficiel_id', 'domaineofficiel_designation', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for avatar_avatar_id field
            //
            $editor = new DynamicCombobox('avatar_avatar_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`avatar`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('avatar_id', true, true),
                    new StringField('avatar_nom'),
                    new StringField('avatar_prenom'),
                    new StringField('avatar_dt_naissance')
                )
            );
            $lookupDataset->setOrderByField('avatar_nom', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Avatar Avatar Id', 'avatar_avatar_id', 'avatar_avatar_id_avatar_nom', 'insert_avatar_utilisateur_avatar_avatar_id_search', $editor, $this->dataset, $lookupDataset, 'avatar_id', 'avatar_nom', '');
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
            // View column for utilisateur_id field
            //
            $column = new NumberViewColumn('utilisateur_id', 'utilisateur_id', 'Utilisateur Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for utilisateur_nom field
            //
            $column = new TextViewColumn('utilisateur_nom', 'utilisateur_nom', 'Utilisateur Nom', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for utilisateur_prenom field
            //
            $column = new TextViewColumn('utilisateur_prenom', 'utilisateur_prenom', 'Utilisateur Prenom', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for utilisateur_email field
            //
            $column = new TextViewColumn('utilisateur_email', 'utilisateur_email', 'Utilisateur Email', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for utilisateur_password field
            //
            $column = new TextViewColumn('utilisateur_password', 'utilisateur_password', 'Utilisateur Password', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for domaineofficiel_designation field
            //
            $column = new TextViewColumn('domaineofficiel_domaineofficiel_id', 'domaineofficiel_domaineofficiel_id_domaineofficiel_designation', 'Domaineofficiel Domaineofficiel Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for avatar_nom field
            //
            $column = new TextViewColumn('avatar_avatar_id', 'avatar_avatar_id_avatar_nom', 'Avatar Avatar Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for utilisateur_id field
            //
            $column = new NumberViewColumn('utilisateur_id', 'utilisateur_id', 'Utilisateur Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for utilisateur_nom field
            //
            $column = new TextViewColumn('utilisateur_nom', 'utilisateur_nom', 'Utilisateur Nom', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for utilisateur_prenom field
            //
            $column = new TextViewColumn('utilisateur_prenom', 'utilisateur_prenom', 'Utilisateur Prenom', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for utilisateur_email field
            //
            $column = new TextViewColumn('utilisateur_email', 'utilisateur_email', 'Utilisateur Email', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for utilisateur_password field
            //
            $column = new TextViewColumn('utilisateur_password', 'utilisateur_password', 'Utilisateur Password', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for domaineofficiel_designation field
            //
            $column = new TextViewColumn('domaineofficiel_domaineofficiel_id', 'domaineofficiel_domaineofficiel_id_domaineofficiel_designation', 'Domaineofficiel Domaineofficiel Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for avatar_nom field
            //
            $column = new TextViewColumn('avatar_avatar_id', 'avatar_avatar_id_avatar_nom', 'Avatar Avatar Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for utilisateur_id field
            //
            $column = new NumberViewColumn('utilisateur_id', 'utilisateur_id', 'Utilisateur Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for utilisateur_nom field
            //
            $column = new TextViewColumn('utilisateur_nom', 'utilisateur_nom', 'Utilisateur Nom', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for utilisateur_prenom field
            //
            $column = new TextViewColumn('utilisateur_prenom', 'utilisateur_prenom', 'Utilisateur Prenom', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for utilisateur_email field
            //
            $column = new TextViewColumn('utilisateur_email', 'utilisateur_email', 'Utilisateur Email', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for utilisateur_password field
            //
            $column = new TextViewColumn('utilisateur_password', 'utilisateur_password', 'Utilisateur Password', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for domaineofficiel_designation field
            //
            $column = new TextViewColumn('domaineofficiel_domaineofficiel_id', 'domaineofficiel_domaineofficiel_id_domaineofficiel_designation', 'Domaineofficiel Domaineofficiel Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for avatar_nom field
            //
            $column = new TextViewColumn('avatar_avatar_id', 'avatar_avatar_id_avatar_nom', 'Avatar Avatar Id', $this->dataset);
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
                '`domaineofficiel`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('domaineofficiel_id', true, true),
                    new StringField('domaineofficiel_designation')
                )
            );
            $lookupDataset->setOrderByField('domaineofficiel_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_avatar_utilisateur_domaineofficiel_domaineofficiel_id_search', 'domaineofficiel_id', 'domaineofficiel_designation', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`avatar`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('avatar_id', true, true),
                    new StringField('avatar_nom'),
                    new StringField('avatar_prenom'),
                    new StringField('avatar_dt_naissance')
                )
            );
            $lookupDataset->setOrderByField('avatar_nom', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_avatar_utilisateur_avatar_avatar_id_search', 'avatar_id', 'avatar_nom', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`domaineofficiel`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('domaineofficiel_id', true, true),
                    new StringField('domaineofficiel_designation')
                )
            );
            $lookupDataset->setOrderByField('domaineofficiel_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_avatar_utilisateur_domaineofficiel_domaineofficiel_id_search', 'domaineofficiel_id', 'domaineofficiel_designation', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`avatar`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('avatar_id', true, true),
                    new StringField('avatar_nom'),
                    new StringField('avatar_prenom'),
                    new StringField('avatar_dt_naissance')
                )
            );
            $lookupDataset->setOrderByField('avatar_nom', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_avatar_utilisateur_avatar_avatar_id_search', 'avatar_id', 'avatar_nom', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`domaineofficiel`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('domaineofficiel_id', true, true),
                    new StringField('domaineofficiel_designation')
                )
            );
            $lookupDataset->setOrderByField('domaineofficiel_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_avatar_utilisateur_domaineofficiel_domaineofficiel_id_search', 'domaineofficiel_id', 'domaineofficiel_designation', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`avatar`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('avatar_id', true, true),
                    new StringField('avatar_nom'),
                    new StringField('avatar_prenom'),
                    new StringField('avatar_dt_naissance')
                )
            );
            $lookupDataset->setOrderByField('avatar_nom', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_avatar_utilisateur_avatar_avatar_id_search', 'avatar_id', 'avatar_nom', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`domaineofficiel`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('domaineofficiel_id', true, true),
                    new StringField('domaineofficiel_designation')
                )
            );
            $lookupDataset->setOrderByField('domaineofficiel_designation', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_avatar_utilisateur_domaineofficiel_domaineofficiel_id_search', 'domaineofficiel_id', 'domaineofficiel_designation', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`avatar`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('avatar_id', true, true),
                    new StringField('avatar_nom'),
                    new StringField('avatar_prenom'),
                    new StringField('avatar_dt_naissance')
                )
            );
            $lookupDataset->setOrderByField('avatar_nom', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_avatar_utilisateur_avatar_avatar_id_search', 'avatar_id', 'avatar_nom', null, 20);
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
    
    
    
    class avatarPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Avatar');
            $this->SetMenuLabel('Avatar');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`avatar`');
            $this->dataset->addFields(
                array(
                    new IntegerField('avatar_id', true, true),
                    new StringField('avatar_nom'),
                    new StringField('avatar_prenom'),
                    new StringField('avatar_dt_naissance')
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
                new FilterColumn($this->dataset, 'avatar_id', 'avatar_id', 'Avatar Id'),
                new FilterColumn($this->dataset, 'avatar_nom', 'avatar_nom', 'Avatar Nom'),
                new FilterColumn($this->dataset, 'avatar_prenom', 'avatar_prenom', 'Avatar Prenom'),
                new FilterColumn($this->dataset, 'avatar_dt_naissance', 'avatar_dt_naissance', 'Avatar Dt Naissance')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['avatar_id'])
                ->addColumn($columns['avatar_nom'])
                ->addColumn($columns['avatar_prenom'])
                ->addColumn($columns['avatar_dt_naissance']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('avatar_id_edit');
            
            $filterBuilder->addColumn(
                $columns['avatar_id'],
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
            
            $main_editor = new TextEdit('avatar_nom_edit');
            $main_editor->SetMaxLength(45);
            
            $filterBuilder->addColumn(
                $columns['avatar_nom'],
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
            
            $main_editor = new TextEdit('avatar_prenom_edit');
            $main_editor->SetMaxLength(45);
            
            $filterBuilder->addColumn(
                $columns['avatar_prenom'],
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
            
            $main_editor = new TextEdit('avatar_dt_naissance_edit');
            $main_editor->SetMaxLength(45);
            
            $filterBuilder->addColumn(
                $columns['avatar_dt_naissance'],
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
            if (GetCurrentUserPermissionsForPage('avatar.utilisateur')->HasViewGrant() && $withDetails)
            {
            //
            // View column for avatar_utilisateur detail
            //
            $column = new DetailColumn(array('avatar_id'), 'avatar.utilisateur', 'avatar_utilisateur_handler', $this->dataset, 'Utilisateur');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            //
            // View column for avatar_id field
            //
            $column = new NumberViewColumn('avatar_id', 'avatar_id', 'Avatar Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for avatar_nom field
            //
            $column = new TextViewColumn('avatar_nom', 'avatar_nom', 'Avatar Nom', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for avatar_prenom field
            //
            $column = new TextViewColumn('avatar_prenom', 'avatar_prenom', 'Avatar Prenom', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for avatar_dt_naissance field
            //
            $column = new TextViewColumn('avatar_dt_naissance', 'avatar_dt_naissance', 'Avatar Dt Naissance', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for avatar_id field
            //
            $column = new NumberViewColumn('avatar_id', 'avatar_id', 'Avatar Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for avatar_nom field
            //
            $column = new TextViewColumn('avatar_nom', 'avatar_nom', 'Avatar Nom', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for avatar_prenom field
            //
            $column = new TextViewColumn('avatar_prenom', 'avatar_prenom', 'Avatar Prenom', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for avatar_dt_naissance field
            //
            $column = new TextViewColumn('avatar_dt_naissance', 'avatar_dt_naissance', 'Avatar Dt Naissance', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for avatar_id field
            //
            $editor = new TextEdit('avatar_id_edit');
            $editColumn = new CustomEditColumn('Avatar Id', 'avatar_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for avatar_nom field
            //
            $editor = new TextEdit('avatar_nom_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Avatar Nom', 'avatar_nom', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for avatar_prenom field
            //
            $editor = new TextEdit('avatar_prenom_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Avatar Prenom', 'avatar_prenom', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for avatar_dt_naissance field
            //
            $editor = new TextEdit('avatar_dt_naissance_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Avatar Dt Naissance', 'avatar_dt_naissance', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for avatar_nom field
            //
            $editor = new TextEdit('avatar_nom_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Avatar Nom', 'avatar_nom', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for avatar_prenom field
            //
            $editor = new TextEdit('avatar_prenom_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Avatar Prenom', 'avatar_prenom', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for avatar_dt_naissance field
            //
            $editor = new TextEdit('avatar_dt_naissance_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Avatar Dt Naissance', 'avatar_dt_naissance', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for avatar_id field
            //
            $editor = new TextEdit('avatar_id_edit');
            $editColumn = new CustomEditColumn('Avatar Id', 'avatar_id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for avatar_nom field
            //
            $editor = new TextEdit('avatar_nom_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Avatar Nom', 'avatar_nom', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for avatar_prenom field
            //
            $editor = new TextEdit('avatar_prenom_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Avatar Prenom', 'avatar_prenom', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for avatar_dt_naissance field
            //
            $editor = new TextEdit('avatar_dt_naissance_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Avatar Dt Naissance', 'avatar_dt_naissance', $editor, $this->dataset);
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
            // View column for avatar_id field
            //
            $column = new NumberViewColumn('avatar_id', 'avatar_id', 'Avatar Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for avatar_nom field
            //
            $column = new TextViewColumn('avatar_nom', 'avatar_nom', 'Avatar Nom', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for avatar_prenom field
            //
            $column = new TextViewColumn('avatar_prenom', 'avatar_prenom', 'Avatar Prenom', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for avatar_dt_naissance field
            //
            $column = new TextViewColumn('avatar_dt_naissance', 'avatar_dt_naissance', 'Avatar Dt Naissance', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for avatar_id field
            //
            $column = new NumberViewColumn('avatar_id', 'avatar_id', 'Avatar Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for avatar_nom field
            //
            $column = new TextViewColumn('avatar_nom', 'avatar_nom', 'Avatar Nom', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for avatar_prenom field
            //
            $column = new TextViewColumn('avatar_prenom', 'avatar_prenom', 'Avatar Prenom', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for avatar_dt_naissance field
            //
            $column = new TextViewColumn('avatar_dt_naissance', 'avatar_dt_naissance', 'Avatar Dt Naissance', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for avatar_id field
            //
            $column = new NumberViewColumn('avatar_id', 'avatar_id', 'Avatar Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for avatar_nom field
            //
            $column = new TextViewColumn('avatar_nom', 'avatar_nom', 'Avatar Nom', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for avatar_prenom field
            //
            $column = new TextViewColumn('avatar_prenom', 'avatar_prenom', 'Avatar Prenom', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for avatar_dt_naissance field
            //
            $column = new TextViewColumn('avatar_dt_naissance', 'avatar_dt_naissance', 'Avatar Dt Naissance', $this->dataset);
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
            $detailPage = new avatar_utilisateurPage('avatar_utilisateur', $this, array('avatar_avatar_id'), array('avatar_id'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionsForPage('avatar.utilisateur'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('avatar.utilisateur'));
            $detailPage->SetHttpHandlerName('avatar_utilisateur_handler');
            $handler = new PageHTTPHandler('avatar_utilisateur_handler', $detailPage);
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
        $Page = new avatarPage("avatar", "avatar.php", GetCurrentUserPermissionsForPage("avatar"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("avatar"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
