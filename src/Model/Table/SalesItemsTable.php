<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SalesItems Model
 *
 * @property \App\Model\Table\SalesItemAssignHistoriesTable|\Cake\ORM\Association\HasMany $SalesItemAssignHistories
 * @property \App\Model\Table\SalesItemHistoriesTable|\Cake\ORM\Association\HasMany $SalesItemHistories
 * @property \App\Model\Table\SalesItemTransactionsTable|\Cake\ORM\Association\HasMany $SalesItemTransactions
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
class SalesItemsTable extends Table
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

        $this->setTable('sales_items');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Muffin/Footprint.Footprint');

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

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['sales_item_number']));

        return $rules;
    }
}
