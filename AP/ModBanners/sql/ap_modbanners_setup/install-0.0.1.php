<?php
$this->startSetup();

 
$table = new Varien_Db_Ddl_Table();

 
$table->setName($this->getTable('ap_modbanners/banner'));

 
$table->addColumn(
    'entity_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    10,
    array(
        'auto_increment' => true,
        'unsigned' => true,
        'nullable'=> false,
        'primary' => true
    )
);
$table->addColumn(
    'title',
    Varien_Db_Ddl_Table::TYPE_VARCHAR,
    null,
    array(
        'nullable' => false,
    )
);
$table->addColumn(
    'image_path',
    Varien_Db_Ddl_Table::TYPE_TEXT,
    null,
    array(
        'nullable' => false,
    )
);

$table->addColumn(
    'description',
    Varien_Db_Ddl_Table::TYPE_TEXT,
    null,
    array(
        'nullable' => false,
    )
);
$table->addColumn(
    'start_date',
    Varien_Db_Ddl_Table::TYPE_DATETIME,
    null,
    array(
        'nullable' => false,
    )
);

$table->addColumn(
    'end_date',
    Varien_Db_Ddl_Table::TYPE_DATETIME,
    null,
    array(
        'nullable' => false,
    )
);



 
$table->setOption('type', 'InnoDB');
$table->setOption('charset', 'utf8');

/**
 * Create the table!
 */
$this->getConnection()->createTable($table);

$this->endSetup();
