<?php
namespace App\Model\Table;
/*
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;*/

use Cake\ORM\Table;

//use /* CakeSoftDelete */ SoftDelete\Model\Table\SoftDeleteTrait;

/**
 * Common model class all models extend
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AppTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        // Timestamp
        $this->addBehavior('Timestamp');

        // Footprint
        $this->addBehavior('Muffin/Footprint.Footprint');

    }

    /**
     * beforeFind method
     *
     * @param mixed $event Event.
     * @param mixed $query Query.
     * @param mixed $options Options.
     * @param mixed $primary Primary.
     * @return void
     */
    public function beforeFind($event, $query, $options, $primary)
    {
    }

}
