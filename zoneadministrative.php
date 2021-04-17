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
    
    
    
    class zoneadministrativePage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Zoneadministrative');
            $this->SetMenuLabel('Zoneadministrative');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`zoneadministrative`');
            $this->dataset->addFields(
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
            $this->dataset->AddLookupField('zoneadministrative_zoneadministrative_id', 'zoneadministrative', new IntegerField('zoneadministrative_id'), new StringField('zoneadministrative_designation', false, false, false, false, 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation_zoneadministrative'), 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation_zoneadministrative');
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
                new FilterColumn($this->dataset, 'zoneadministrative_id', 'zoneadministrative_id', 'N° Interne de la Zone'),
                new FilterColumn($this->dataset, 'zoneadministrative_designation', 'zoneadministrative_designation', 'Désignation'),
                new FilterColumn($this->dataset, 'zoneadministrative_ccord', 'zoneadministrative_ccord', 'Corrdonnées'),
                new FilterColumn($this->dataset, 'zoneadministrative_zoneadministrative_id', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'Zone Administrative Parente'),
                new FilterColumn($this->dataset, 'zoneadministrative_ref_iris', 'zoneadministrative_ref_iris', 'Zoneadministrative Ref Iris'),
                new FilterColumn($this->dataset, 'zoneadministrative_ref_insee', 'zoneadministrative_ref_insee', 'Zoneadministrative Ref Insee'),
                new FilterColumn($this->dataset, 'zoneadministrative_observation', 'zoneadministrative_observation', 'Zoneadministrative Observation'),
                new FilterColumn($this->dataset, 'zoneadministrative_lien_url', 'zoneadministrative_lien_url', 'Zoneadministrative Lien Url'),
                new FilterColumn($this->dataset, 'zoneadministrative_lien_texte', 'zoneadministrative_lien_texte', 'Zoneadministrative Lien Texte')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['zoneadministrative_designation'])
                ->addColumn($columns['zoneadministrative_ccord'])
                ->addColumn($columns['zoneadministrative_zoneadministrative_id'])
                ->addColumn($columns['zoneadministrative_ref_iris'])
                ->addColumn($columns['zoneadministrative_ref_insee'])
                ->addColumn($columns['zoneadministrative_observation'])
                ->addColumn($columns['zoneadministrative_lien_url'])
                ->addColumn($columns['zoneadministrative_lien_texte']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('zoneadministrative_zoneadministrative_id');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('zoneadministrative_designation_edit');
            $main_editor->SetMaxLength(45);
            
            $filterBuilder->addColumn(
                $columns['zoneadministrative_designation'],
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
            
            $main_editor = new TextEdit('zoneadministrative_ccord_edit');
            
            $filterBuilder->addColumn(
                $columns['zoneadministrative_ccord'],
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
            
            $main_editor = new DynamicCombobox('zoneadministrative_zoneadministrative_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_zoneadministrative_zoneadministrative_zoneadministrative_id_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('zoneadministrative_zoneadministrative_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_zoneadministrative_zoneadministrative_zoneadministrative_id_search');
            
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
            
            $main_editor = new TextEdit('zoneadministrative_ref_iris_edit');
            $main_editor->SetMaxLength(50);
            
            $filterBuilder->addColumn(
                $columns['zoneadministrative_ref_iris'],
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
            
            $main_editor = new TextEdit('zoneadministrative_ref_insee_edit');
            $main_editor->SetMaxLength(50);
            
            $filterBuilder->addColumn(
                $columns['zoneadministrative_ref_insee'],
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
            
            $main_editor = new TextEdit('zoneadministrative_observation');
            
            $filterBuilder->addColumn(
                $columns['zoneadministrative_observation'],
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
            
            $main_editor = new TextEdit('zoneadministrative_lien_url');
            
            $filterBuilder->addColumn(
                $columns['zoneadministrative_lien_url'],
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
            
            $main_editor = new TextEdit('zoneadministrative_lien_texte');
            
            $filterBuilder->addColumn(
                $columns['zoneadministrative_lien_texte'],
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
            //
            // View column for zoneadministrative_designation field
            //
            $column = new TextViewColumn('zoneadministrative_designation', 'zoneadministrative_designation', 'Désignation', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for zoneadministrative_ccord field
            //
            $column = new TextViewColumn('zoneadministrative_ccord', 'zoneadministrative_ccord', 'Corrdonnées', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for zoneadministrative_designation field
            //
            $column = new TextViewColumn('zoneadministrative_zoneadministrative_id', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'Zone Administrative Parente', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for zoneadministrative_ref_iris field
            //
            $column = new TextViewColumn('zoneadministrative_ref_iris', 'zoneadministrative_ref_iris', 'Zoneadministrative Ref Iris', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for zoneadministrative_ref_insee field
            //
            $column = new TextViewColumn('zoneadministrative_ref_insee', 'zoneadministrative_ref_insee', 'Zoneadministrative Ref Insee', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for zoneadministrative_observation field
            //
            $column = new TextViewColumn('zoneadministrative_observation', 'zoneadministrative_observation', 'Zoneadministrative Observation', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for zoneadministrative_lien_url field
            //
            $column = new TextViewColumn('zoneadministrative_lien_url', 'zoneadministrative_lien_url', 'Zoneadministrative Lien Url', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for zoneadministrative_lien_texte field
            //
            $column = new TextViewColumn('zoneadministrative_lien_texte', 'zoneadministrative_lien_texte', 'Zoneadministrative Lien Texte', $this->dataset);
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
            // View column for zoneadministrative_designation field
            //
            $column = new TextViewColumn('zoneadministrative_designation', 'zoneadministrative_designation', 'Désignation', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zoneadministrative_ccord field
            //
            $column = new TextViewColumn('zoneadministrative_ccord', 'zoneadministrative_ccord', 'Corrdonnées', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zoneadministrative_designation field
            //
            $column = new TextViewColumn('zoneadministrative_zoneadministrative_id', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'Zone Administrative Parente', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zoneadministrative_ref_iris field
            //
            $column = new TextViewColumn('zoneadministrative_ref_iris', 'zoneadministrative_ref_iris', 'Zoneadministrative Ref Iris', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zoneadministrative_ref_insee field
            //
            $column = new TextViewColumn('zoneadministrative_ref_insee', 'zoneadministrative_ref_insee', 'Zoneadministrative Ref Insee', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zoneadministrative_observation field
            //
            $column = new TextViewColumn('zoneadministrative_observation', 'zoneadministrative_observation', 'Zoneadministrative Observation', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zoneadministrative_lien_url field
            //
            $column = new TextViewColumn('zoneadministrative_lien_url', 'zoneadministrative_lien_url', 'Zoneadministrative Lien Url', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for zoneadministrative_lien_texte field
            //
            $column = new TextViewColumn('zoneadministrative_lien_texte', 'zoneadministrative_lien_texte', 'Zoneadministrative Lien Texte', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for zoneadministrative_designation field
            //
            $editor = new TextEdit('zoneadministrative_designation_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Désignation', 'zoneadministrative_designation', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zoneadministrative_ccord field
            //
            $editor = new TextEdit('zoneadministrative_ccord_edit');
            $editColumn = new CustomEditColumn('Corrdonnées', 'zoneadministrative_ccord', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
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
            $editColumn = new DynamicLookupEditColumn('Zone Administrative Parente', 'zoneadministrative_zoneadministrative_id', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'edit_zoneadministrative_zoneadministrative_zoneadministrative_id_search', $editor, $this->dataset, $lookupDataset, 'zoneadministrative_id', 'zoneadministrative_designation', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zoneadministrative_ref_iris field
            //
            $editor = new TextEdit('zoneadministrative_ref_iris_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Zoneadministrative Ref Iris', 'zoneadministrative_ref_iris', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zoneadministrative_ref_insee field
            //
            $editor = new TextEdit('zoneadministrative_ref_insee_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Zoneadministrative Ref Insee', 'zoneadministrative_ref_insee', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zoneadministrative_observation field
            //
            $editor = new TextAreaEdit('zoneadministrative_observation_edit', 50, 8);
            $editColumn = new CustomEditColumn('Zoneadministrative Observation', 'zoneadministrative_observation', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zoneadministrative_lien_url field
            //
            $editor = new TextAreaEdit('zoneadministrative_lien_url_edit', 50, 8);
            $editColumn = new CustomEditColumn('Zoneadministrative Lien Url', 'zoneadministrative_lien_url', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for zoneadministrative_lien_texte field
            //
            $editor = new TextAreaEdit('zoneadministrative_lien_texte_edit', 50, 8);
            $editColumn = new CustomEditColumn('Zoneadministrative Lien Texte', 'zoneadministrative_lien_texte', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for zoneadministrative_designation field
            //
            $editor = new TextEdit('zoneadministrative_designation_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Désignation', 'zoneadministrative_designation', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zoneadministrative_ccord field
            //
            $editor = new TextEdit('zoneadministrative_ccord_edit');
            $editColumn = new CustomEditColumn('Corrdonnées', 'zoneadministrative_ccord', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
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
            $editColumn = new DynamicLookupEditColumn('Zone Administrative Parente', 'zoneadministrative_zoneadministrative_id', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'multi_edit_zoneadministrative_zoneadministrative_zoneadministrative_id_search', $editor, $this->dataset, $lookupDataset, 'zoneadministrative_id', 'zoneadministrative_designation', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zoneadministrative_ref_iris field
            //
            $editor = new TextEdit('zoneadministrative_ref_iris_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Zoneadministrative Ref Iris', 'zoneadministrative_ref_iris', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zoneadministrative_ref_insee field
            //
            $editor = new TextEdit('zoneadministrative_ref_insee_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Zoneadministrative Ref Insee', 'zoneadministrative_ref_insee', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zoneadministrative_observation field
            //
            $editor = new TextAreaEdit('zoneadministrative_observation_edit', 50, 8);
            $editColumn = new CustomEditColumn('Zoneadministrative Observation', 'zoneadministrative_observation', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zoneadministrative_lien_url field
            //
            $editor = new TextAreaEdit('zoneadministrative_lien_url_edit', 50, 8);
            $editColumn = new CustomEditColumn('Zoneadministrative Lien Url', 'zoneadministrative_lien_url', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for zoneadministrative_lien_texte field
            //
            $editor = new TextAreaEdit('zoneadministrative_lien_texte_edit', 50, 8);
            $editColumn = new CustomEditColumn('Zoneadministrative Lien Texte', 'zoneadministrative_lien_texte', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for zoneadministrative_designation field
            //
            $editor = new TextEdit('zoneadministrative_designation_edit');
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Désignation', 'zoneadministrative_designation', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zoneadministrative_ccord field
            //
            $editor = new TextEdit('zoneadministrative_ccord_edit');
            $editColumn = new CustomEditColumn('Corrdonnées', 'zoneadministrative_ccord', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
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
            $editColumn = new DynamicLookupEditColumn('Zone Administrative Parente', 'zoneadministrative_zoneadministrative_id', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'insert_zoneadministrative_zoneadministrative_zoneadministrative_id_search', $editor, $this->dataset, $lookupDataset, 'zoneadministrative_id', 'zoneadministrative_designation', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zoneadministrative_ref_iris field
            //
            $editor = new TextEdit('zoneadministrative_ref_iris_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Zoneadministrative Ref Iris', 'zoneadministrative_ref_iris', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zoneadministrative_ref_insee field
            //
            $editor = new TextEdit('zoneadministrative_ref_insee_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Zoneadministrative Ref Insee', 'zoneadministrative_ref_insee', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zoneadministrative_observation field
            //
            $editor = new TextAreaEdit('zoneadministrative_observation_edit', 50, 8);
            $editColumn = new CustomEditColumn('Zoneadministrative Observation', 'zoneadministrative_observation', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zoneadministrative_lien_url field
            //
            $editor = new TextAreaEdit('zoneadministrative_lien_url_edit', 50, 8);
            $editColumn = new CustomEditColumn('Zoneadministrative Lien Url', 'zoneadministrative_lien_url', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for zoneadministrative_lien_texte field
            //
            $editor = new TextAreaEdit('zoneadministrative_lien_texte_edit', 50, 8);
            $editColumn = new CustomEditColumn('Zoneadministrative Lien Texte', 'zoneadministrative_lien_texte', $editor, $this->dataset);
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
            // View column for zoneadministrative_designation field
            //
            $column = new TextViewColumn('zoneadministrative_designation', 'zoneadministrative_designation', 'Désignation', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for zoneadministrative_ccord field
            //
            $column = new TextViewColumn('zoneadministrative_ccord', 'zoneadministrative_ccord', 'Corrdonnées', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for zoneadministrative_designation field
            //
            $column = new TextViewColumn('zoneadministrative_zoneadministrative_id', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'Zone Administrative Parente', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for zoneadministrative_ref_iris field
            //
            $column = new TextViewColumn('zoneadministrative_ref_iris', 'zoneadministrative_ref_iris', 'Zoneadministrative Ref Iris', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for zoneadministrative_ref_insee field
            //
            $column = new TextViewColumn('zoneadministrative_ref_insee', 'zoneadministrative_ref_insee', 'Zoneadministrative Ref Insee', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for zoneadministrative_observation field
            //
            $column = new TextViewColumn('zoneadministrative_observation', 'zoneadministrative_observation', 'Zoneadministrative Observation', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for zoneadministrative_lien_url field
            //
            $column = new TextViewColumn('zoneadministrative_lien_url', 'zoneadministrative_lien_url', 'Zoneadministrative Lien Url', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
            
            //
            // View column for zoneadministrative_lien_texte field
            //
            $column = new TextViewColumn('zoneadministrative_lien_texte', 'zoneadministrative_lien_texte', 'Zoneadministrative Lien Texte', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for zoneadministrative_designation field
            //
            $column = new TextViewColumn('zoneadministrative_designation', 'zoneadministrative_designation', 'Désignation', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for zoneadministrative_ccord field
            //
            $column = new TextViewColumn('zoneadministrative_ccord', 'zoneadministrative_ccord', 'Corrdonnées', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for zoneadministrative_designation field
            //
            $column = new TextViewColumn('zoneadministrative_zoneadministrative_id', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'Zone Administrative Parente', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for zoneadministrative_ref_iris field
            //
            $column = new TextViewColumn('zoneadministrative_ref_iris', 'zoneadministrative_ref_iris', 'Zoneadministrative Ref Iris', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for zoneadministrative_ref_insee field
            //
            $column = new TextViewColumn('zoneadministrative_ref_insee', 'zoneadministrative_ref_insee', 'Zoneadministrative Ref Insee', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for zoneadministrative_observation field
            //
            $column = new TextViewColumn('zoneadministrative_observation', 'zoneadministrative_observation', 'Zoneadministrative Observation', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for zoneadministrative_lien_url field
            //
            $column = new TextViewColumn('zoneadministrative_lien_url', 'zoneadministrative_lien_url', 'Zoneadministrative Lien Url', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
            
            //
            // View column for zoneadministrative_lien_texte field
            //
            $column = new TextViewColumn('zoneadministrative_lien_texte', 'zoneadministrative_lien_texte', 'Zoneadministrative Lien Texte', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for zoneadministrative_designation field
            //
            $column = new TextViewColumn('zoneadministrative_designation', 'zoneadministrative_designation', 'Désignation', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for zoneadministrative_ccord field
            //
            $column = new TextViewColumn('zoneadministrative_ccord', 'zoneadministrative_ccord', 'Corrdonnées', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for zoneadministrative_designation field
            //
            $column = new TextViewColumn('zoneadministrative_zoneadministrative_id', 'zoneadministrative_zoneadministrative_id_zoneadministrative_designation', 'Zone Administrative Parente', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for zoneadministrative_ref_iris field
            //
            $column = new TextViewColumn('zoneadministrative_ref_iris', 'zoneadministrative_ref_iris', 'Zoneadministrative Ref Iris', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for zoneadministrative_ref_insee field
            //
            $column = new TextViewColumn('zoneadministrative_ref_insee', 'zoneadministrative_ref_insee', 'Zoneadministrative Ref Insee', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for zoneadministrative_observation field
            //
            $column = new TextViewColumn('zoneadministrative_observation', 'zoneadministrative_observation', 'Zoneadministrative Observation', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for zoneadministrative_lien_url field
            //
            $column = new TextViewColumn('zoneadministrative_lien_url', 'zoneadministrative_lien_url', 'Zoneadministrative Lien Url', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddCompareColumn($column);
            
            //
            // View column for zoneadministrative_lien_texte field
            //
            $column = new TextViewColumn('zoneadministrative_lien_texte', 'zoneadministrative_lien_texte', 'Zoneadministrative Lien Texte', $this->dataset);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_zoneadministrative_zoneadministrative_zoneadministrative_id_search', 'zoneadministrative_id', 'zoneadministrative_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_zoneadministrative_zoneadministrative_zoneadministrative_id_search', 'zoneadministrative_id', 'zoneadministrative_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_zoneadministrative_zoneadministrative_zoneadministrative_id_search', 'zoneadministrative_id', 'zoneadministrative_designation', null, 20);
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
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_zoneadministrative_zoneadministrative_zoneadministrative_id_search', 'zoneadministrative_id', 'zoneadministrative_designation', null, 20);
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
        $Page = new zoneadministrativePage("zoneadministrative", "zoneadministrative.php", GetCurrentUserPermissionsForPage("zoneadministrative"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("zoneadministrative"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
