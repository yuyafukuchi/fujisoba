<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SalesItemTransactions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $SalesTransactions
 * @property \Cake\ORM\Association\BelongsTo $SalesItems
 *
 * @method \App\Model\Entity\SalesItemTransaction get($primaryKey, $options = [])
 * @method \App\Model\Entity\SalesItemTransaction newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SalesItemTransaction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SalesItemTransaction|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SalesItemTransaction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SalesItemTransaction[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SalesItemTransaction findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SalesItemTransactionsTable extends AppTable
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

        $this->table('sales_item_transactions');
        $this->displayField('id');
        $this->primaryKey('id');

        

        $this->belongsTo('SalesTransactions', [
            'foreignKey' => 'sales_transaction_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('SalesItems', [
            'foreignKey' => 'sales_item_id',
            'joinType' => 'INNER'
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
            ->integer('qty')
            ->allowEmpty('qty');

        $validator
            ->integer('sales_item_price')
            ->allowEmpty('sales_item_price');

        $validator
            ->integer('sales_item_cost')
            ->allowEmpty('sales_item_cost');

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
        $rules->add($rules->existsIn(['sales_transaction_id'], 'SalesTransactions'));
        $rules->add($rules->existsIn(['sales_item_id'], 'SalesItems'));

        return $rules;
    }
}
