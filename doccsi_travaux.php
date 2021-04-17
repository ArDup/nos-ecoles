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
    
    
    
    class doccsi_travauxPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Liste des travaux');
            $this->SetMenuLabel('Liste des travaux');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`doccsi_travaux`');
            $this->dataset->addFields(
                array(
                    new IntegerField('doccsi_travaux_id', true, true, true),
                    new StringField('doccsi_objet'),
                    new StringField('doccsi_notes_preventioniste'),
                    new StringField('doccsi_notes_collectivite'),
                    new StringField('doccsi_notes_directeur'),
                    new StringField('doccsi_avis_collectivite'),
                    new StringField('doccsi_avis_directeur'),
                    new DateField('doccsi_datetime_collectivite'),
                    new DateField('doccsi_datetime_directeur'),
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
                new FilterColumn($this->dataset, 'doccsi_travaux_id', 'doccsi_travaux_id', 'Doccsi Travaux Id'),
                new FilterColumn($this->dataset, 'doccsi_objet', 'doccsi_objet', 'Doccsi Objet'),
                new FilterColumn($this->dataset, 'doccsi_notes_preventioniste', 'doccsi_notes_preventioniste', 'Doccsi Notes Preventioniste'),
                new FilterColumn($this->dataset, 'doccsi_notes_collectivite', 'doccsi_notes_collectivite', 'Doccsi Notes Collectivite'),
                new FilterColumn($this->dataset, 'doccsi_notes_directeur', 'doccsi_notes_directeur', 'Doccsi Notes Directeur'),
                new FilterColumn($this->dataset, 'doccsi_avis_collectivite', 'doccsi_avis_collectivite', 'Doccsi Avis Collectivite'),
                new FilterColumn($this->dataset, 'doccsi_avis_directeur', 'doccsi_avis_directeur', 'Doccsi Avis Directeur'),
                new FilterColumn($this->dataset, 'doccsi_datetime_collectivite', 'doccsi_datetime_collectivite', 'Doccsi Datetime Collectivite'),
                new FilterColumn($this->dataset, 'doccsi_datetime_directeur', 'doccsi_datetime_directeur', 'Doccsi Datetime Directeur'),
                new FilterColumn($this->dataset, 'doccsi_id', 'doccsi_id_doccsi_fichier', 'Doccsi Id')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['doccsi_travaux_id'])
                ->addColumn($columns['doccsi_objet'])
                ->addColumn($columns['doccsi_notes_preventioniste'])
                ->addColumn($columns['doccsi_notes_collectivite'])
                ->addColumn($columns['doccsi_notes_directeur'])
                ->addColumn($columns['doccsi_avis_collectivite'])
                ->addColumn($columns['doccsi_avis_directeur'])
                ->addColumn($columns['doccsi_datetime_collectivite'])
                ->addColumn($columns['doccsi_datetime_directeur'])
                ->addColumn($columns['doccsi_id']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('doccsi_avis_collectivite')
                ->setOptionsFor('doccsi_avis_directeur')
                ->setOptionsFor('doccsi_datetime_collectivite')
                ->setOptionsFor('doccsi_datetime_directeur')
                ->setOptionsFor('doccsi_id');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('doccsi_travaux_id_edit');
            
            $filterBuilder->addColumn(
                $columns['doccsi_travaux_id'],
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
            
            $main_editor = new TextEdit('doccsi_objet');
            
            $filterBuilder->addColumn(
                $columns['doccsi_objet'],
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
            
            $main_editor = new TextEdit('doccsi_notes_preventioniste');
            
            $filterBuilder->addColumn(
                $columns['doccsi_notes_preventioniste'],
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
            
            $main_editor = new TextEdit('doccsi_notes_collectivite');
            
            $filterBuilder->addColumn(
                $columns['doccsi_notes_collectivite'],
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
            
            $main_editor = new TextEdit('doccsi_notes_directeur');
            
            $filterBuilder->addColumn(
                $columns['doccsi_notes_directeur'],
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
            
            $main_editor = new ComboBox('doccsi_avis_collectivite_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $main_editor->addChoice('ATTENTE DE REPONSE', 'ATTENTE DE REPONSE');
            $main_editor->addChoice('RESOLU', 'RESOLU');
            $main_editor->addChoice('EN COURS', 'EN COURS');
            $main_editor->SetAllowNullValue(false);
            
            $multi_value_select_editor = new MultiValueSelect('doccsi_avis_collectivite');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
            $text_editor = new TextEdit('doccsi_avis_collectivite');
            
            $filterBuilder->addColumn(
                $columns['doccsi_avis_collectivite'],
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
            
            $main_editor = new ComboBox('doccsi_avis_directeur_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $main_editor->addChoice('ATTENTE DE REPONSE', 'ATTENTE DE REPONSE');
            $main_editor->addChoice('NE SAIS PAS', 'NE SAIS PAS');
            $main_editor->addChoice('RESOLU', 'RESOLU');
            $main_editor->SetAllowNullValue(false);
            
            $multi_value_select_editor = new MultiValueSelect('doccsi_avis_directeur');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
            $text_editor = new TextEdit('doccsi_avis_directeur');
            
            $filterBuilder->addColumn(
                $columns['doccsi_avis_directeur'],
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
            
            $main_editor = new DateTimeEdit('doccsi_datetime_collectivite_edit', false, 'Y-m-d');
            
            $filterBuilder->addColumn(
                $columns['doccsi_datetime_collectivite'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('doccsi_datetime_directeur_edit', false, 'Y-m-d');
            
            $filterBuilder->addColumn(
                $columns['doccsi_datetime_directeur'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('doccsi_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_doccsi_travaux_doccsi_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('doccsi_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_doccsi_travaux_doccsi_id_search');
            
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
            //
            // View column for doccsi_travaux_id field
            //
            $column = new NumberViewColumn('doccsi_travaux_id', 'doccsi_travaux_id', 'Doccsi Travaux Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for doccsi_objet field
            //
            $column = new TextViewColumn('doccsi_objet', 'doccsi_objet', 'Doccsi Objet', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for doccsi_notes_preventioniste field
            //
            $column = new TextViewColumn('doccsi_notes_preventioniste', 'doccsi_notes_preventioniste', 'Doccsi Notes Preventioniste', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for doccsi_notes_collectivite field
            //
            $column = new TextViewColumn('doccsi_notes_collectivite', 'doccsi_notes_collectivite', 'Doccsi Notes Collectivite', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for doccsi_notes_directeur field
            //
            $column = new TextViewColumn('doccsi_notes_directeur', 'doccsi_notes_directeur', 'Doccsi Notes Directeur', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for doccsi_avis_collectivite field
            //
            $column = new TextViewColumn('doccsi_avis_collectivite', 'doccsi_avis_collectivite', 'Doccsi Avis Collectivite', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for doccsi_avis_directeur field
            //
            $column = new TextViewColumn('doccsi_avis_directeur', 'doccsi_avis_directeur', 'Doccsi Avis Directeur', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for doccsi_datetime_collectivite field
            //
            $column = new DateTimeViewColumn('doccsi_datetime_collectivite', 'doccsi_datetime_collectivite', 'Doccsi Datetime Collectivite', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for doccsi_datetime_directeur field
            //
            $column = new DateTimeViewColumn('doccsi_datetime_directeur', 'doccsi_datetime_directeur', 'Doccsi Datetime Directeur', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
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
            // View column for doccsi_travaux_id field
            //
            $column = new NumberViewColumn('doccsi_travaux_id', 'doccsi_travaux_id', 'Doccsi Travaux Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for doccsi_objet field
            //
            $column = new TextViewColumn('doccsi_objet', 'doccsi_objet', 'Doccsi Objet', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for doccsi_notes_preventioniste field
            //
            $column = new TextViewColumn('doccsi_notes_preventioniste', 'doccsi_notes_preventioniste', 'Doccsi Notes Preventioniste', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for doccsi_notes_collectivite field
            //
            $column = new TextViewColumn('doccsi_notes_collectivite', 'doccsi_notes_collectivite', 'Doccsi Notes Collectivite', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for doccsi_notes_directeur field
            //
            $column = new TextViewColumn('doccsi_notes_directeur', 'doccsi_notes_directeur', 'Doccsi Notes Directeur', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for doccsi_avis_collectivite field
            //
            $column = new TextViewColumn('doccsi_avis_collectivite', 'doccsi_avis_collectivite', 'Doccsi Avis Collectivite', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for doccsi_avis_directeur field
            //
            $column = new TextViewColumn('doccsi_avis_directeur', 'doccsi_avis_directeur', 'Doccsi Avis Directeur', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for doccsi_datetime_collectivite field
            //
            $column = new DateTimeViewColumn('doccsi_datetime_collectivite', 'doccsi_datetime_collectivite', 'Doccsi Datetime Collectivite', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for doccsi_datetime_directeur field
            //
            $column = new DateTimeViewColumn('doccsi_datetime_directeur', 'doccsi_datetime_directeur', 'Doccsi Datetime Directeur', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
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
            // Edit column for doccsi_objet field
            //
            $editor = new TextAreaEdit('doccsi_objet_edit', 50, 8);
            $editColumn = new CustomEditColumn('Doccsi Objet', 'doccsi_objet', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for doccsi_notes_preventioniste field
            //
            $editor = new TextAreaEdit('doccsi_notes_preventioniste_edit', 50, 8);
            $editColumn = new CustomEditColumn('Doccsi Notes Preventioniste', 'doccsi_notes_preventioniste', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for doccsi_notes_collectivite field
            //
            $editor = new TextAreaEdit('doccsi_notes_collectivite_edit', 50, 8);
            $editColumn = new CustomEditColumn('Doccsi Notes Collectivite', 'doccsi_notes_collectivite', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for doccsi_notes_directeur field
            //
            $editor = new TextAreaEdit('doccsi_notes_directeur_edit', 50, 8);
            $editColumn = new CustomEditColumn('Doccsi Notes Directeur', 'doccsi_notes_directeur', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for doccsi_avis_collectivite field
            //
            $editor = new ComboBox('doccsi_avis_collectivite_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('ATTENTE DE REPONSE', 'ATTENTE DE REPONSE');
            $editor->addChoice('RESOLU', 'RESOLU');
            $editor->addChoice('EN COURS', 'EN COURS');
            $editColumn = new CustomEditColumn('Doccsi Avis Collectivite', 'doccsi_avis_collectivite', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for doccsi_avis_directeur field
            //
            $editor = new ComboBox('doccsi_avis_directeur_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('ATTENTE DE REPONSE', 'ATTENTE DE REPONSE');
            $editor->addChoice('NE SAIS PAS', 'NE SAIS PAS');
            $editor->addChoice('RESOLU', 'RESOLU');
            $editColumn = new CustomEditColumn('Doccsi Avis Directeur', 'doccsi_avis_directeur', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for doccsi_datetime_collectivite field
            //
            $editor = new DateTimeEdit('doccsi_datetime_collectivite_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Doccsi Datetime Collectivite', 'doccsi_datetime_collectivite', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for doccsi_datetime_directeur field
            //
            $editor = new DateTimeEdit('doccsi_datetime_directeur_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Doccsi Datetime Directeur', 'doccsi_datetime_directeur', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Doccsi Id', 'doccsi_id', 'doccsi_id_doccsi_fichier', 'edit_doccsi_travaux_doccsi_id_search', $editor, $this->dataset, $lookupDataset, 'doccsi_id', 'doccsi_fichier', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for doccsi_objet field
            //
            $editor = new TextAreaEdit('doccsi_objet_edit', 50, 8);
            $editColumn = new CustomEditColumn('Doccsi Objet', 'doccsi_objet', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for doccsi_notes_preventioniste field
            //
            $editor = new TextAreaEdit('doccsi_notes_preventioniste_edit', 50, 8);
            $editColumn = new CustomEditColumn('Doccsi Notes Preventioniste', 'doccsi_notes_preventioniste', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for doccsi_notes_collectivite field
            //
            $editor = new TextAreaEdit('doccsi_notes_collectivite_edit', 50, 8);
            $editColumn = new CustomEditColumn('Doccsi Notes Collectivite', 'doccsi_notes_collectivite', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for doccsi_notes_directeur field
            //
            $editor = new TextAreaEdit('doccsi_notes_directeur_edit', 50, 8);
            $editColumn = new CustomEditColumn('Doccsi Notes Directeur', 'doccsi_notes_directeur', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for doccsi_avis_collectivite field
            //
            $editor = new ComboBox('doccsi_avis_collectivite_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('ATTENTE DE REPONSE', 'ATTENTE DE REPONSE');
            $editor->addChoice('RESOLU', 'RESOLU');
            $editor->addChoice('EN COURS', 'EN COURS');
            $editColumn = new CustomEditColumn('Doccsi Avis Collectivite', 'doccsi_avis_collectivite', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for doccsi_avis_directeur field
            //
            $editor = new ComboBox('doccsi_avis_directeur_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('ATTENTE DE REPONSE', 'ATTENTE DE REPONSE');
            $editor->addChoice('NE SAIS PAS', 'NE SAIS PAS');
            $editor->addChoice('RESOLU', 'RESOLU');
            $editColumn = new CustomEditColumn('Doccsi Avis Directeur', 'doccsi_avis_directeur', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for doccsi_datetime_collectivite field
            //
            $editor = new DateTimeEdit('doccsi_datetime_collectivite_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Doccsi Datetime Collectivite', 'doccsi_datetime_collectivite', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for doccsi_datetime_directeur field
            //
            $editor = new DateTimeEdit('doccsi_datetime_directeur_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Doccsi Datetime Directeur', 'doccsi_datetime_directeur', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Doccsi Id', 'doccsi_id', 'doccsi_id_doccsi_fichier', 'multi_edit_doccsi_travaux_doccsi_id_search', $editor, $this->dataset, $lookupDataset, 'doccsi_id', 'doccsi_fichier', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for doccsi_objet field
            //
            $editor = new TextAreaEdit('doccsi_objet_edit', 50, 8);
            $editColumn = new CustomEditColumn('Doccsi Objet', 'doccsi_objet', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for doccsi_notes_preventioniste field
            //
            $editor = new TextAreaEdit('doccsi_notes_preventioniste_edit', 50, 8);
            $editColumn = new CustomEditColumn('Doccsi Notes Preventioniste', 'doccsi_notes_preventioniste', $editor, $this->dataset);
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
            // Edit column for doccsi_avis_collectivite field
            //
            $editor = new ComboBox('doccsi_avis_collectivite_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('ATTENTE DE REPONSE', 'ATTENTE DE REPONSE');
            $editor->addChoice('RESOLU', 'RESOLU');
            $editor->addChoice('EN COURS', 'EN COURS');
            $editColumn = new CustomEditColumn('Doccsi Avis Collectivite', 'doccsi_avis_collectivite', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for doccsi_avis_directeur field
            //
            $editor = new ComboBox('doccsi_avis_directeur_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('ATTENTE DE REPONSE', 'ATTENTE DE REPONSE');
            $editor->addChoice('NE SAIS PAS', 'NE SAIS PAS');
            $editor->addChoice('RESOLU', 'RESOLU');
            $editColumn = new CustomEditColumn('Doccsi Avis Directeur', 'doccsi_avis_directeur', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for doccsi_datetime_collectivite field
            //
            $editor = new DateTimeEdit('doccsi_datetime_collectivite_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Doccsi Datetime Collectivite', 'doccsi_datetime_collectivite', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for doccsi_datetime_directeur field
            //
            $editor = new DateTimeEdit('doccsi_datetime_directeur_edit', false, 'Y-m-d');
            $editColumn = new CustomEditColumn('Doccsi Datetime Directeur', 'doccsi_datetime_directeur', $editor, $this->dataset);
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
            $editColumn = new DynamicLookupEditColumn('Doccsi Id', 'doccsi_id', 'doccsi_id_doccsi_fichier', 'insert_doccsi_travaux_doccsi_id_search', $editor, $this->dataset, $lookupDataset, 'doccsi_id', 'doccsi_fichier', '');
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
            // View column for doccsi_travaux_id field
            //
            $column = new NumberViewColumn('doccsi_travaux_id', 'doccsi_travaux_id', 'Doccsi Travaux Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for doccsi_objet field
            //
            $column = new TextViewColumn('doccsi_objet', 'doccsi_objet', 'Doccsi Objet', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for doccsi_notes_preventioniste field
            //
            $column = new TextViewColumn('doccsi_notes_preventioniste', 'doccsi_notes_preventioniste', 'Doccsi Notes Preventioniste', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for doccsi_notes_collectivite field
            //
            $column = new TextViewColumn('doccsi_notes_collectivite', 'doccsi_notes_collectivite', 'Doccsi Notes Collectivite', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for doccsi_notes_directeur field
            //
            $column = new TextViewColumn('doccsi_notes_directeur', 'doccsi_notes_directeur', 'Doccsi Notes Directeur', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for doccsi_avis_collectivite field
            //
            $column = new TextViewColumn('doccsi_avis_collectivite', 'doccsi_avis_collectivite', 'Doccsi Avis Collectivite', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for doccsi_avis_directeur field
            //
            $column = new TextViewColumn('doccsi_avis_directeur', 'doccsi_avis_directeur', 'Doccsi Avis Directeur', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for doccsi_datetime_collectivite field
            //
            $column = new DateTimeViewColumn('doccsi_datetime_collectivite', 'doccsi_datetime_collectivite', 'Doccsi Datetime Collectivite', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddPrintColumn($column);
            
            //
            // View column for doccsi_datetime_directeur field
            //
            $column = new DateTimeViewColumn('doccsi_datetime_directeur', 'doccsi_datetime_directeur', 'Doccsi Datetime Directeur', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
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
            // View column for doccsi_travaux_id field
            //
            $column = new NumberViewColumn('doccsi_travaux_id', 'doccsi_travaux_id', 'Doccsi Travaux Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for doccsi_objet field
            //
            $column = new TextViewColumn('doccsi_objet', 'doccsi_objet', 'Doccsi Objet', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for doccsi_notes_preventioniste field
            //
            $column = new TextViewColumn('doccsi_notes_preventioniste', 'doccsi_notes_preventioniste', 'Doccsi Notes Preventioniste', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for doccsi_notes_collectivite field
            //
            $column = new TextViewColumn('doccsi_notes_collectivite', 'doccsi_notes_collectivite', 'Doccsi Notes Collectivite', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for doccsi_notes_directeur field
            //
            $column = new TextViewColumn('doccsi_notes_directeur', 'doccsi_notes_directeur', 'Doccsi Notes Directeur', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for doccsi_avis_collectivite field
            //
            $column = new TextViewColumn('doccsi_avis_collectivite', 'doccsi_avis_collectivite', 'Doccsi Avis Collectivite', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for doccsi_avis_directeur field
            //
            $column = new TextViewColumn('doccsi_avis_directeur', 'doccsi_avis_directeur', 'Doccsi Avis Directeur', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for doccsi_datetime_collectivite field
            //
            $column = new DateTimeViewColumn('doccsi_datetime_collectivite', 'doccsi_datetime_collectivite', 'Doccsi Datetime Collectivite', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddExportColumn($column);
            
            //
            // View column for doccsi_datetime_directeur field
            //
            $column = new DateTimeViewColumn('doccsi_datetime_directeur', 'doccsi_datetime_directeur', 'Doccsi Datetime Directeur', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
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
            // View column for doccsi_objet field
            //
            $column = new TextViewColumn('doccsi_objet', 'doccsi_objet', 'Doccsi Objet', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for doccsi_notes_preventioniste field
            //
            $column = new TextViewColumn('doccsi_notes_preventioniste', 'doccsi_notes_preventioniste', 'Doccsi Notes Preventioniste', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for doccsi_notes_collectivite field
            //
            $column = new TextViewColumn('doccsi_notes_collectivite', 'doccsi_notes_collectivite', 'Doccsi Notes Collectivite', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for doccsi_notes_directeur field
            //
            $column = new TextViewColumn('doccsi_notes_directeur', 'doccsi_notes_directeur', 'Doccsi Notes Directeur', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for doccsi_avis_collectivite field
            //
            $column = new TextViewColumn('doccsi_avis_collectivite', 'doccsi_avis_collectivite', 'Doccsi Avis Collectivite', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for doccsi_avis_directeur field
            //
            $column = new TextViewColumn('doccsi_avis_directeur', 'doccsi_avis_directeur', 'Doccsi Avis Directeur', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for doccsi_datetime_collectivite field
            //
            $column = new DateTimeViewColumn('doccsi_datetime_collectivite', 'doccsi_datetime_collectivite', 'Doccsi Datetime Collectivite', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddCompareColumn($column);
            
            //
            // View column for doccsi_datetime_directeur field
            //
            $column = new DateTimeViewColumn('doccsi_datetime_directeur', 'doccsi_datetime_directeur', 'Doccsi Datetime Directeur', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_doccsi_travaux_doccsi_id_search', 'doccsi_id', 'doccsi_fichier', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_doccsi_travaux_doccsi_id_search', 'doccsi_id', 'doccsi_fichier', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_doccsi_travaux_doccsi_id_search', 'doccsi_id', 'doccsi_fichier', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_doccsi_travaux_doccsi_id_search', 'doccsi_id', 'doccsi_fichier', null, 20);
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
        $Page = new doccsi_travauxPage("doccsi_travaux", "doccsi_travaux.php", GetCurrentUserPermissionsForPage("doccsi_travaux"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("doccsi_travaux"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
