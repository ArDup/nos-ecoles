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
    
    
    
    class v_ecolesPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Nos écoles');
            $this->SetMenuLabel('Nos écoles');
    
            $this->dataset = new TableDataset(
                MySqlIConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_ecoles`');
            $this->dataset->addFields(
                array(
                    new IntegerField('ecole_id', true, true),
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
                    new IntegerField('doccsi_id'),
                    new StringField('nom'),
                    new StringField('type'),
                    new StringField('public_prive'),
                    new StringField('adr1'),
                    new StringField('adr2'),
                    new StringField('adr3'),
                    new StringField('cp'),
                    new StringField('code_commune'),
                    new StringField('commune'),
                    new StringField('departement'),
                    new StringField('academie'),
                    new StringField('region'),
                    new IntegerField('_maternelle'),
                    new IntegerField('elementaire'),
                    new StringField('voie_generale'),
                    new StringField('voie_technologique'),
                    new StringField('voie_professionnelle'),
                    new StringField('telephone'),
                    new StringField('fax'),
                    new StringField('web'),
                    new StringField('mail'),
                    new IntegerField('restauration'),
                    new IntegerField('hebergement'),
                    new IntegerField('ulis'),
                    new StringField('apprentissage'),
                    new StringField('segpa'),
                    new StringField('arts'),
                    new StringField('cinema'),
                    new StringField('theatre'),
                    new StringField('sport'),
                    new StringField('internationale'),
                    new StringField('europeenne'),
                    new StringField('lycee_agricole'),
                    new StringField('lycee_militaire'),
                    new StringField('lycee_des_metiers'),
                    new StringField('post_bac'),
                    new StringField('ep'),
                    new StringField('greta'),
                    new StringField('siren_siret'),
                    new StringField('nombre_d_eleves'),
                    new StringField('fiche_onisep'),
                    new StringField('position'),
                    new StringField('type_contrat_prive'),
                    new StringField('libelle_departement'),
                    new StringField('libelle_academie'),
                    new StringField('libelle_region'),
                    new IntegerField('coordx_origine'),
                    new IntegerField('coordy_origine'),
                    new StringField('epsg_origine'),
                    new StringField('nom_circonscription'),
                    new IntegerField('latitude'),
                    new IntegerField('longitude'),
                    new StringField('precision_localisation'),
                    new DateField('date_ouverture'),
                    new DateField('date_maj_ligne'),
                    new StringField('etat'),
                    new StringField('ministere_tutelle'),
                    new IntegerField('multi_uai'),
                    new IntegerField('rpi_concentre'),
                    new StringField('rpi_disperse'),
                    new IntegerField('code_nature'),
                    new StringField('libelle_nature'),
                    new IntegerField('code_type_contrat_prive'),
                    new StringField('pial'),
                    new StringField('etablissement_mere'),
                    new StringField('type_re_mere'),
                    new StringField('code_zap'),
                    new StringField('libelle_zap'),
                    new StringField('TYPE_CONCTRUCTIF'),
                    new StringField('TOTAL_CLASSES'),
                    new StringField('TOTAL_EFFECTIF'),
                    new StringField('NB_ELEVE_CLASSE'),
                    new StringField('CLASSE_THEORIQUE'),
                    new StringField('TYPE_TAILLE'),
                    new StringField('doccsi_fichier'),
                    new DateField('doccsi_datetime'),
                    new StringField('doccsi_categorie'),
                    new StringField('doccsi_avis'),
                    new IntegerField('doccsi_public'),
                    new IntegerField('doccsi_personnel'),
                    new StringField('doccsi_notes'),
                    new StringField('doccsi_notes_collectivite'),
                    new StringField('doccsi_notes_directeur'),
                    new StringField('EFFECTIF'),
                    new StringField('CONTACTS'),
                    new StringField('CSI')
                )
            );
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new CustomPageNavigator('partition', $this, $this->dataset, 'Code Postal', $result);
            $partitionNavigator->OnGetPartitionCondition->AddListener('partition' . '_GetPartitionConditionHandler', $this);
            $partitionNavigator->OnGetPartitions->AddListener('partition' . '_GetPartitionsHandler', $this);
            $partitionNavigator->SetAllowViewAllRecords(true);
            $partitionNavigator->SetNavigationStyle(NS_COMBOBOX);
            $result->AddPageNavigator($partitionNavigator);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(500);
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
                new FilterColumn($this->dataset, 'ecole_RNE', 'ecole_RNE', 'Code RNE'),
                new FilterColumn($this->dataset, 'ecole_lat', 'ecole_lat', 'Ecole Lat'),
                new FilterColumn($this->dataset, 'ecole_long', 'ecole_long', 'Ecole Long'),
                new FilterColumn($this->dataset, 'ecole_latlong', 'ecole_latlong', 'Ecole Latlong'),
                new FilterColumn($this->dataset, 'ecole_coord', 'ecole_coord', 'Ecole Coord'),
                new FilterColumn($this->dataset, 'ecole_appellation', 'ecole_appellation', 'Appellation'),
                new FilterColumn($this->dataset, 'ecole_denominationprincipale', 'ecole_denominationprincipale', 'Ecole Denominationprincipale'),
                new FilterColumn($this->dataset, 'ecole_patronymeuai', 'ecole_patronymeuai', 'Ecole Patronymeuai'),
                new FilterColumn($this->dataset, 'ecole_secteur', 'ecole_secteur', 'Secteur'),
                new FilterColumn($this->dataset, 'ecole_adresse', 'ecole_adresse', 'Ecole Adresse'),
                new FilterColumn($this->dataset, 'ecole_lieudit', 'ecole_lieudit', 'Ecole Lieudit'),
                new FilterColumn($this->dataset, 'ecole_boitepostale', 'ecole_boitepostale', 'Ecole Boitepostale'),
                new FilterColumn($this->dataset, 'ecole_codepostal', 'ecole_codepostal', 'Code Postal'),
                new FilterColumn($this->dataset, 'ecole_localiteacheminement', 'ecole_localiteacheminement', 'Ecole Localiteacheminement'),
                new FilterColumn($this->dataset, 'ecole_commune', 'ecole_commune', 'Ecole Commune'),
                new FilterColumn($this->dataset, 'ecole_coordonneex', 'ecole_coordonneex', 'Ecole Coordonneex'),
                new FilterColumn($this->dataset, 'ecole_coordonneey', 'ecole_coordonneey', 'Ecole Coordonneey'),
                new FilterColumn($this->dataset, 'ecole_epasg', 'ecole_epasg', 'Ecole Epasg'),
                new FilterColumn($this->dataset, 'ecole_qualite', 'ecole_qualite', 'Ecole Qualite'),
                new FilterColumn($this->dataset, 'ecole_localisation', 'ecole_localisation', 'Ecole Localisation'),
                new FilterColumn($this->dataset, 'ecole_codenature', 'ecole_codenature', 'Ecole Codenature'),
                new FilterColumn($this->dataset, 'ecole_dateouverture', 'ecole_dateouverture', 'Ecole Dateouverture'),
                new FilterColumn($this->dataset, 'doccsi_id', 'doccsi_id', 'Doccsi Id'),
                new FilterColumn($this->dataset, 'nom', 'nom', 'Nom'),
                new FilterColumn($this->dataset, 'type', 'type', 'Type'),
                new FilterColumn($this->dataset, 'public_prive', 'public_prive', 'Public Prive'),
                new FilterColumn($this->dataset, 'adr1', 'adr1', 'Adr1'),
                new FilterColumn($this->dataset, 'adr2', 'adr2', 'Adr2'),
                new FilterColumn($this->dataset, 'adr3', 'adr3', 'Adr3'),
                new FilterColumn($this->dataset, 'cp', 'cp', 'Cp'),
                new FilterColumn($this->dataset, 'code_commune', 'code_commune', 'Code Commune'),
                new FilterColumn($this->dataset, 'commune', 'commune', 'Commune'),
                new FilterColumn($this->dataset, 'departement', 'departement', 'Departement'),
                new FilterColumn($this->dataset, 'academie', 'academie', 'Academie'),
                new FilterColumn($this->dataset, 'region', 'region', 'Region'),
                new FilterColumn($this->dataset, '_maternelle', '_maternelle', ' Maternelle'),
                new FilterColumn($this->dataset, 'elementaire', 'elementaire', 'Elementaire'),
                new FilterColumn($this->dataset, 'voie_generale', 'voie_generale', 'Voie Generale'),
                new FilterColumn($this->dataset, 'voie_technologique', 'voie_technologique', 'Voie Technologique'),
                new FilterColumn($this->dataset, 'voie_professionnelle', 'voie_professionnelle', 'Voie Professionnelle'),
                new FilterColumn($this->dataset, 'telephone', 'telephone', 'Telephone'),
                new FilterColumn($this->dataset, 'fax', 'fax', 'Fax'),
                new FilterColumn($this->dataset, 'web', 'web', 'Web'),
                new FilterColumn($this->dataset, 'mail', 'mail', 'Mail'),
                new FilterColumn($this->dataset, 'restauration', 'restauration', 'Restauration'),
                new FilterColumn($this->dataset, 'hebergement', 'hebergement', 'Hebergement'),
                new FilterColumn($this->dataset, 'ulis', 'ulis', 'Ulis'),
                new FilterColumn($this->dataset, 'apprentissage', 'apprentissage', 'Apprentissage'),
                new FilterColumn($this->dataset, 'segpa', 'segpa', 'Segpa'),
                new FilterColumn($this->dataset, 'arts', 'arts', 'Arts'),
                new FilterColumn($this->dataset, 'cinema', 'cinema', 'Cinema'),
                new FilterColumn($this->dataset, 'theatre', 'theatre', 'Theatre'),
                new FilterColumn($this->dataset, 'sport', 'sport', 'Sport'),
                new FilterColumn($this->dataset, 'internationale', 'internationale', 'Internationale'),
                new FilterColumn($this->dataset, 'europeenne', 'europeenne', 'Europeenne'),
                new FilterColumn($this->dataset, 'lycee_agricole', 'lycee_agricole', 'Lycee Agricole'),
                new FilterColumn($this->dataset, 'lycee_militaire', 'lycee_militaire', 'Lycee Militaire'),
                new FilterColumn($this->dataset, 'lycee_des_metiers', 'lycee_des_metiers', 'Lycee Des Metiers'),
                new FilterColumn($this->dataset, 'post_bac', 'post_bac', 'Post Bac'),
                new FilterColumn($this->dataset, 'ep', 'ep', 'Ep'),
                new FilterColumn($this->dataset, 'greta', 'greta', 'Greta'),
                new FilterColumn($this->dataset, 'siren_siret', 'siren_siret', 'Siren Siret'),
                new FilterColumn($this->dataset, 'nombre_d_eleves', 'nombre_d_eleves', 'Nombre d\'élèves'),
                new FilterColumn($this->dataset, 'fiche_onisep', 'fiche_onisep', 'Fiche Onisep'),
                new FilterColumn($this->dataset, 'position', 'position', 'Position'),
                new FilterColumn($this->dataset, 'type_contrat_prive', 'type_contrat_prive', 'Type Contrat Prive'),
                new FilterColumn($this->dataset, 'libelle_departement', 'libelle_departement', 'Libelle Departement'),
                new FilterColumn($this->dataset, 'libelle_academie', 'libelle_academie', 'Libelle Academie'),
                new FilterColumn($this->dataset, 'libelle_region', 'libelle_region', 'Libelle Region'),
                new FilterColumn($this->dataset, 'coordx_origine', 'coordx_origine', 'Coordx Origine'),
                new FilterColumn($this->dataset, 'coordy_origine', 'coordy_origine', 'Coordy Origine'),
                new FilterColumn($this->dataset, 'epsg_origine', 'epsg_origine', 'Epsg Origine'),
                new FilterColumn($this->dataset, 'nom_circonscription', 'nom_circonscription', 'Nom Circonscription'),
                new FilterColumn($this->dataset, 'latitude', 'latitude', 'Latitude'),
                new FilterColumn($this->dataset, 'longitude', 'longitude', 'Longitude'),
                new FilterColumn($this->dataset, 'precision_localisation', 'precision_localisation', 'Precision Localisation'),
                new FilterColumn($this->dataset, 'date_ouverture', 'date_ouverture', 'Date Ouverture'),
                new FilterColumn($this->dataset, 'date_maj_ligne', 'date_maj_ligne', 'Date Maj Ligne'),
                new FilterColumn($this->dataset, 'etat', 'etat', 'Etat'),
                new FilterColumn($this->dataset, 'ministere_tutelle', 'ministere_tutelle', 'Ministere Tutelle'),
                new FilterColumn($this->dataset, 'multi_uai', 'multi_uai', 'Multi Uai'),
                new FilterColumn($this->dataset, 'rpi_concentre', 'rpi_concentre', 'Rpi Concentre'),
                new FilterColumn($this->dataset, 'rpi_disperse', 'rpi_disperse', 'Rpi Disperse'),
                new FilterColumn($this->dataset, 'code_nature', 'code_nature', 'Code Nature'),
                new FilterColumn($this->dataset, 'libelle_nature', 'libelle_nature', 'Libelle Nature'),
                new FilterColumn($this->dataset, 'code_type_contrat_prive', 'code_type_contrat_prive', 'Code Type Contrat Prive'),
                new FilterColumn($this->dataset, 'pial', 'pial', 'Pial'),
                new FilterColumn($this->dataset, 'etablissement_mere', 'etablissement_mere', 'Etablissement Mere'),
                new FilterColumn($this->dataset, 'type_re_mere', 'type_re_mere', 'Type Re Mere'),
                new FilterColumn($this->dataset, 'code_zap', 'code_zap', 'Code Zap'),
                new FilterColumn($this->dataset, 'libelle_zap', 'libelle_zap', 'Libelle Zap'),
                new FilterColumn($this->dataset, 'TYPE_CONCTRUCTIF', 'TYPE_CONCTRUCTIF', 'Mode Constructif'),
                new FilterColumn($this->dataset, 'TOTAL_CLASSES', 'TOTAL_CLASSES', 'TOTAL CLASSES'),
                new FilterColumn($this->dataset, 'TOTAL_EFFECTIF', 'TOTAL_EFFECTIF', 'TOTAL EFFECTIF'),
                new FilterColumn($this->dataset, 'NB_ELEVE_CLASSE', 'NB_ELEVE_CLASSE', 'Nb élèves par classe'),
                new FilterColumn($this->dataset, 'CLASSE_THEORIQUE', 'CLASSE_THEORIQUE', 'CLASSE THEORIQUE'),
                new FilterColumn($this->dataset, 'TYPE_TAILLE', 'TYPE_TAILLE', 'TYPE TAILLE'),
                new FilterColumn($this->dataset, 'doccsi_fichier', 'doccsi_fichier', 'Rapport'),
                new FilterColumn($this->dataset, 'doccsi_datetime', 'doccsi_datetime', 'Date de passage'),
                new FilterColumn($this->dataset, 'doccsi_categorie', 'doccsi_categorie', 'Categorie ERP'),
                new FilterColumn($this->dataset, 'doccsi_avis', 'doccsi_avis', 'Avis de la commission'),
                new FilterColumn($this->dataset, 'doccsi_public', 'doccsi_public', 'Effectif Public (CSI)'),
                new FilterColumn($this->dataset, 'doccsi_personnel', 'doccsi_personnel', 'Effectif Personnel (CSI)'),
                new FilterColumn($this->dataset, 'doccsi_notes', 'doccsi_notes', 'Notes du Préventionniste'),
                new FilterColumn($this->dataset, 'doccsi_notes_collectivite', 'doccsi_notes_collectivite', 'Notes de la Collectivité'),
                new FilterColumn($this->dataset, 'doccsi_notes_directeur', 'doccsi_notes_directeur', 'Notes du Directeur'),
                new FilterColumn($this->dataset, 'EFFECTIF', 'EFFECTIF', 'Effectif (Historique)'),
                new FilterColumn($this->dataset, 'CONTACTS', 'CONTACTS', 'Contacts'),
                new FilterColumn($this->dataset, 'CSI', 'CSI', 'Réserves et recommandations')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['ecole_RNE'])
                ->addColumn($columns['ecole_appellation'])
                ->addColumn($columns['ecole_secteur'])
                ->addColumn($columns['ecole_codepostal'])
                ->addColumn($columns['_maternelle'])
                ->addColumn($columns['elementaire'])
                ->addColumn($columns['telephone'])
                ->addColumn($columns['web'])
                ->addColumn($columns['mail'])
                ->addColumn($columns['nombre_d_eleves'])
                ->addColumn($columns['TYPE_CONCTRUCTIF'])
                ->addColumn($columns['NB_ELEVE_CLASSE'])
                ->addColumn($columns['doccsi_datetime'])
                ->addColumn($columns['doccsi_categorie'])
                ->addColumn($columns['doccsi_avis'])
                ->addColumn($columns['doccsi_public'])
                ->addColumn($columns['doccsi_personnel']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('ecole_codepostal')
                ->setOptionsFor('_maternelle')
                ->setOptionsFor('elementaire')
                ->setOptionsFor('TYPE_CONCTRUCTIF')
                ->setOptionsFor('doccsi_categorie')
                ->setOptionsFor('doccsi_avis');
            
            $columnFilter
                ->setOrderFor('ecole_codepostal', 'DESC');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
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
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_RNE', 'ecole_RNE', 'Code RNE', $this->dataset);
            $column->setNullLabel('');
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ecole_appellation field
            //
            $column = new TextViewColumn('ecole_appellation', 'ecole_appellation', 'Appellation', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ecole_secteur field
            //
            $column = new TextViewColumn('ecole_secteur', 'ecole_secteur', 'Secteur', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ecole_codepostal field
            //
            $column = new TextViewColumn('ecole_codepostal', 'ecole_codepostal', 'Code Postal', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for _maternelle field
            //
            $column = new CheckboxViewColumn('_maternelle', '_maternelle', ' Maternelle', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for elementaire field
            //
            $column = new CheckboxViewColumn('elementaire', 'elementaire', 'Elementaire', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for telephone field
            //
            $column = new TextViewColumn('telephone', 'telephone', 'Telephone', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for web field
            //
            $column = new TextViewColumn('web', 'web', 'Web', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for mail field
            //
            $column = new TextViewColumn('mail', 'mail', 'Mail', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for nombre_d_eleves field
            //
            $column = new TextViewColumn('nombre_d_eleves', 'nombre_d_eleves', 'Nombre d\'élèves', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for TYPE_CONCTRUCTIF field
            //
            $column = new TextViewColumn('TYPE_CONCTRUCTIF', 'TYPE_CONCTRUCTIF', 'Mode Constructif', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for NB_ELEVE_CLASSE field
            //
            $column = new TextViewColumn('NB_ELEVE_CLASSE', 'NB_ELEVE_CLASSE', 'Nb élèves par classe', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Attention, donnée indicative fournie dans CCTP de la ville, Audit des écoles, basée sur effectif 2019/2020');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for doccsi_categorie field
            //
            $column = new TextViewColumn('doccsi_categorie', 'doccsi_categorie', 'Categorie ERP', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for doccsi_avis field
            //
            $column = new TextViewColumn('doccsi_avis', 'doccsi_avis', 'Avis de la commission', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for doccsi_public field
            //
            $column = new NumberViewColumn('doccsi_public', 'doccsi_public', 'Effectif Public (CSI)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for doccsi_personnel field
            //
            $column = new NumberViewColumn('doccsi_personnel', 'doccsi_personnel', 'Effectif Personnel (CSI)', $this->dataset);
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
            // View column for ecole_RNE field
            //
            $column = new TextViewColumn('ecole_RNE', 'ecole_RNE', 'Code RNE', $this->dataset);
            $column->setNullLabel('');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_appellation field
            //
            $column = new TextViewColumn('ecole_appellation', 'ecole_appellation', 'Appellation', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_secteur field
            //
            $column = new TextViewColumn('ecole_secteur', 'ecole_secteur', 'Secteur', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ecole_codepostal field
            //
            $column = new TextViewColumn('ecole_codepostal', 'ecole_codepostal', 'Code Postal', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for _maternelle field
            //
            $column = new CheckboxViewColumn('_maternelle', '_maternelle', ' Maternelle', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for elementaire field
            //
            $column = new CheckboxViewColumn('elementaire', 'elementaire', 'Elementaire', $this->dataset);
            $column->SetOrderable(true);
            $column->setDisplayValues('<span class="pg-row-checkbox checked"></span>', '<span class="pg-row-checkbox"></span>');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for telephone field
            //
            $column = new TextViewColumn('telephone', 'telephone', 'Telephone', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for web field
            //
            $column = new TextViewColumn('web', 'web', 'Web', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for mail field
            //
            $column = new TextViewColumn('mail', 'mail', 'Mail', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for nombre_d_eleves field
            //
            $column = new TextViewColumn('nombre_d_eleves', 'nombre_d_eleves', 'Nombre d\'élèves', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for TYPE_CONCTRUCTIF field
            //
            $column = new TextViewColumn('TYPE_CONCTRUCTIF', 'TYPE_CONCTRUCTIF', 'Mode Constructif', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for NB_ELEVE_CLASSE field
            //
            $column = new TextViewColumn('NB_ELEVE_CLASSE', 'NB_ELEVE_CLASSE', 'Nb élèves par classe', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for doccsi_fichier field
            //
            $column = new TextViewColumn('doccsi_fichier', 'doccsi_fichier', 'Rapport', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('/documents/doccsi/%doccsi_fichier%');
            $column->setTarget('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for doccsi_datetime field
            //
            $column = new DateTimeViewColumn('doccsi_datetime', 'doccsi_datetime', 'Date de passage', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('Y-m-d');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for doccsi_categorie field
            //
            $column = new TextViewColumn('doccsi_categorie', 'doccsi_categorie', 'Categorie ERP', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for doccsi_avis field
            //
            $column = new TextViewColumn('doccsi_avis', 'doccsi_avis', 'Avis de la commission', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for doccsi_public field
            //
            $column = new NumberViewColumn('doccsi_public', 'doccsi_public', 'Effectif Public (CSI)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for doccsi_personnel field
            //
            $column = new NumberViewColumn('doccsi_personnel', 'doccsi_personnel', 'Effectif Personnel (CSI)', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for doccsi_notes field
            //
            $column = new TextViewColumn('doccsi_notes', 'doccsi_notes', 'Notes du Préventionniste', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for doccsi_notes_collectivite field
            //
            $column = new TextViewColumn('doccsi_notes_collectivite', 'doccsi_notes_collectivite', 'Notes de la Collectivité', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for doccsi_notes_directeur field
            //
            $column = new TextViewColumn('doccsi_notes_directeur', 'doccsi_notes_directeur', 'Notes du Directeur', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for EFFECTIF field
            //
            $column = new TextViewColumn('EFFECTIF', 'EFFECTIF', 'Effectif (Historique)', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for CONTACTS field
            //
            $column = new TextViewColumn('CONTACTS', 'CONTACTS', 'Contacts', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for CSI field
            //
            $column = new TextViewColumn('CSI', 'CSI', 'Réserves et recommandations', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
    
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
    
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
    
            $grid->SetShowAddButton(false && $this->GetSecurityInfo()->HasAddGrant());
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
        private $partitions = array(1 => array(null, '\'13001\''), 2 => array('\'13001\'', '\'13002\''), 3 => array('\'13002\'', '\'13003\''), 4 => array('\'13003\'', '\'13004\''), 5 => array('\'13004\'', '\'13005\''), 6 => array('\'13005\'', '\'13006\''), 7 => array('\'13006\'', '\'13007\''), 8 => array('\'13007\'', '\'13008\''), 9 => array('\'13008\'', '\'13009\''), 10 => array('\'13009\'', '\'13010\''), 11 => array('\'13010\'', '\'13011\''), 12 => array('\'13011\'', '\'13012\''), 13 => array('\'13012\'', '\'13013\''), 14 => array('\'13013\'', '\'13014\''), 15 => array('\'13014\'', '\'13015\''), 16 => array('\'13015\'', '\'13016\''), 17 => array('\'13016\'', null));
        
        function partition_GetPartitionsHandler(&$partitions)
        {
            $partitions[1] = '13001';
            $partitions[2] = '13002';
            $partitions[3] = '13003';
            $partitions[4] = '13004';
            $partitions[5] = '13005';
            $partitions[6] = '13006';
            $partitions[7] = '13007';
            $partitions[8] = '13008';
            $partitions[9] = '13009';
            $partitions[10] = '13010';
            $partitions[11] = '13011';
            $partitions[12] = '13012';
            $partitions[13] = '13013';
            $partitions[14] = '13014';
            $partitions[15] = '13015';
            $partitions[16] = '13016';
            $partitions[17] = 'Next used';
        }
        
        function partition_GetPartitionConditionHandler($partitionName, &$condition)
        {
            $condition = '';
            if (isset($partitionName) && isset($this->partitions[$partitionName]))
            {
                if (isset($this->partitions[$partitionName][0]))
                    AddStr($condition, sprintf('(ecole_codepostal > %s)', $this->partitions[$partitionName][0]), ' AND ');
                if (isset($this->partitions[$partitionName][1]))
                    AddStr($condition, sprintf('(ecole_codepostal <= %s)', $this->partitions[$partitionName][1]), ' AND ');
            }
        }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(false);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(true);
            $result->SetShowLineNumbers(true);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setAllowCompare(true);
            $this->AddCompareHeaderColumns($result);
            $this->AddCompareColumns($result);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && false);
            $result->setTableBordered(true);
            $result->setTableCondensed(true);
            $result->SetTotal('nombre_d_eleves', PredefinedAggregate::$Sum);
            
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
    
    
            $this->SetViewFormTitle('%ecole_appellation%');
            $this->SetEditFormTitle('%ecole_appellation%');
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(false);
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(true);
            $this->setAllowPrintSelectedRecords(true);
            $this->setExportListAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportSelectedRecordsAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setDescription('Les sources utilisées :<br>
            <ul>
            <li>https://data.education.gouv.fr/explore/dataset/fr-en-effectifs-premier-degre</li>
            <li>Issu du CCTP 2019_50001_0031 - Diagnostic technique des équipements scolaires de la Ville de Marseille</li>
            <li>Rapports de commission de sécurité incendie (analyse par le CeM)</li>
            </ul>');
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
            if ($fieldName == 'doccsi_avis')
            
            {
            
              if ($fieldData == 'DEFAVORABLE')
            
              {
            
              $customText = 
            
                '<div style="background-color: red;">' .
            
                 $fieldData .
            
                '</div>';  
            
              $handled = true; 
            
              }
            
            }
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
                
                $descriptionGroup = $identiteTab->addGroup('Description OPENDATA');                
            	$descriptionGroup->addRow()->addCol($columns['ecole_appellation'], 4, 2) ->addCol($columns['ecole_codepostal'], 4, 2) ;
                $descriptionGroup->addRow()->addCol($columns['ecole_RNE'], 4, 2) ->addCol($columns['TYPE_CONCTRUCTIF'], 4, 2) ;                       
                $descriptionGroup->addRow()->addCol($columns['ecole_secteur'], 4, 2) ->addCol($columns['nombre_d_eleves'], 4, 2) ;
                $descriptionGroup->addRow()->addCol($columns['telephone'], 4, 2) ->addCol($columns['NB_ELEVE_CLASSE'], 4, 2) ;
                $descriptionGroup->addRow()->addCol($columns['mail'], 4, 2) ->addCol($columns['web'], 4, 2) ;
                $descriptionGroup->addRow()->addCol($columns['EFFECTIF'], 4, 2) ;
                
                $responsablesTab = $layout->addTab('Contacts');
                $descriptionGroup1 = $responsablesTab->addGroup('Liste des contacts');                
                $descriptionGroup1->addRow()->addCol($columns['CONTACTS']) ;                       
                
                $csiTab = $layout->addTab('CSI');
                $descriptionGroup2 = $csiTab->addGroup('Liste des réserves dans le Rapport de commission de sécurité incendie');                
                $descriptionGroup2->addRow()->addCol($columns['CSI']) ;                       
                $descriptionGroup2->addRow()->addCol($columns['doccsi_fichier']) ;  
            	
                $amianteTab = $layout->addTab('Amiante');
                $descriptionGroup3 = $amianteTab->addGroup('Liste des points');                
                $descriptionGroup3->addRow()->addCol($columns['doccsi_datetime']) ;                       
                
                $audit2019Tab = $layout->addTab('Audit 2019');
                $descriptionGroup4 = $audit2019Tab->addGroup('Description');                
                $descriptionGroup4->addRow()->addCol($columns['doccsi_avis']) ;                       
                
                $interpellerTab = $layout->addTab('Interpeller');
                $descriptionGroup5 = $interpellerTab->addGroup('Description');                
                $descriptionGroup5->addRow()->addCol($columns['doccsi_public']) ;                       
                
                                                                
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
        $Page = new v_ecolesPage("v_ecoles", "nos_ecoles.php", GetCurrentUserPermissionsForPage("v_ecoles"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("v_ecoles"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
