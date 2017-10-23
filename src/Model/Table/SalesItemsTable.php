<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SalesItems Model
 *
 * @property \Cake\ORM\Association\HasMany $SalesItemAssignHistories
 * @property \Cake\ORM\Association\HasMany $SalesItemHistories
 * @property \Cake\ORM\Association\HasMany $SalesItemTransactions
 *
 * @method \App\Model\Entity\SalesItem get($primaryKey, $options = [])
 * @method \App\Model\Entity\SalesItem newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SalesItem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SalesItem|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SalesItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SalesItem[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SalesItem findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SalesItemsTable extends AppTable
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

        $this->table('sales_items');
        $this->displayField('id');
        $this->primaryKey('id');

        

        $this->hasMany('SalesItemAssignHistories', [
            'foreignKey' => 'sales_item_id'
        ]);
        $this->hasMany('SalesItemHistories', [
            'foreignKey' => 'sales_item_id'
        ]);
        $this->hasMany('SalesItemTransactions', [
            'foreignKey' => 'sales_item_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('sales_item_number')
            ->requirePresence('sales_item_number', 'create')
            ->notEmpty('sales_item_number')
            ->add('sales_item_number', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->integer('modified_by')
            ->allowEmpty('modified_by');

        return $validator;
    }
}
