<?php

/**
 * Load tl_content language file
 */
System::loadLanguageFile('tl_content');

/**
 * Table tl_reference
 */
$GLOBALS['TL_DCA']['tl_reference'] = array(

    // Config
    'config' => array(
        'dataContainer' => 'Table',
        'ptable' => 'tl_reference_archive',
        'ctable' => array('tl_content'),
        'switchToEdit' => true,
        'enableVersioning' => true,
        'sql' => array(
            'keys' => array(
                'id' => 'primary',
                'pid' => 'index',
                'sorting' => 'index'
            )
        ),
        'onload_callback' => array(
            array(
                'Reference\Tables\ReferenceTables',
                'onloadCallback'
            )
        )
    ),
    // List
    'list' => array(
        'sorting' => array(
            'mode' => 1,
            'flag' => 1,
            'fields' => array(
                'title'
            ),
            'headerFields' => array(
                'title'
            ),
            'child_record_callback' => array(
                'Reference\Tables\ReferenceTables',
                'listReference'
            ),
            'panelLayout' => 'sort,filter,search,limit'
        ),
        'label' => array(
            'fields' => array(
                'title'
            ),
            'format' => '%s'
        ),
        'global_operations' => array(
            'category' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_reference']['category'],
                'href' => 'table=tl_reference_category',
                'icon' => 'drag.gif'
            ),
            'all' => array(
                'label' => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href' => 'act=select',
                'class' => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset();"'
            )
        ),
        'operations' => array(
            'edit' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_reference']['edit'],
                'href' => 'table=tl_content',
                'icon' => 'edit.gif'
            ),
            'editheader' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_reference']['editmeta'],
                'href' => 'act=edit',
                'icon' => 'header.gif'
            ),
            'copy' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_reference']['copy'],
                'href' => 'act=copy',
                'icon' => 'copy.gif'
            ),
            'delete' => array(
                'label' => &$GLOBALS['TL_LANG']['tl_reference']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            )
        )
    ),
    // Palettes
    'palettes' => array(
        'default' => '{reference_legend},title,teaser,description,image;{category_legend},category;{extend_legend:hide},featured'
    ),
    // Fields
    'fields' => array(
        'id' => array(
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),
        'pid' => array(
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'sorting' => array(
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'tstamp' => array(
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'title' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_reference']['title'],
            'search' => true,
            'inputType' => 'text',
            'eval' => array(
                'mandatory' => true,
                'maxlength' => 255
            ),
            'sql' => "varchar(255) NOT NULL default ''"
        ),
        'teaser' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_reference']['teaser'],
            'search' => true,
            'inputType' => 'text',
            'eval' => array(
                'maxlength' => 255,
                'mandatory' => true,
            ),
            'sql' => "varchar(255) NOT NULL default ''"
        ),
        'description' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_reference']['description'],
            'search' => true,
            'inputType' => 'textarea',
            'eval' => array(
                'rte' => 'tinyMCE'
            ),
            'sql' => "text NULL"
        ),
        'image' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_reference']['image'],
            'search' => false,
            'inputType' => 'fileTree',
            'eval' => array(
                'mandatory' => true,
                'filesOnly' => true,
                'fieldType' => 'radio',
                'tl_class' => 'clr',
                'extensions' => 'jpg, jpeg, png, gif, svg'
            ),
            'sql' => "binary(16) NULL"
        ),
        'category' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_reference']['category'],
            'exclude' => true,
            'inputType' => 'checkbox',
            'filter' => true,
            'foreignKey' => 'tl_reference_category.title',
            'eval' => array(
                'mandatory' => true,
                'multiple' => true
            ),
            'sql' => "blob NULL",
            'relation' => array(
                'type' => 'hasMany',
                'load' => 'eagerly'
            ),
            'options_callback' => array(
                'Reference\Tables\ReferenceTables',
                'optionsCallbackCategory'
            )
        ),
        'featured' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_reference']['featured'],
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('tl_class'=>'w50'),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
    )
);
