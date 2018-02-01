<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SalesItemDaliySummaries Model
 *
 * @property \App\Model\Table\StoresTable|\Cake\ORM\Association\BelongsTo $Stores
 * @property \App\Model\Table\SalesItemsTable|\Cake\ORM\Association\BelongsTo $SalesItems
 *
 * @method \App\Model\Entity\SalesItemDaliySummary get($primaryKey, $options = [])
 * @method \App\Model\Entity\SalesItemDaliySummary newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SalesItemDaliySummary[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SalesItemDaliySummary|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SalesItemDaliySummary patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SalesItemDaliySummary[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SalesItemDaliySummary findOrCreate($search, callable $callback = null, $options = [])
 */
class SalesItemDaliySummariesTable extends Table
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

        $this->setTable('sales_item_daliy_summaries');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Stores', [
            'foreignKey' => 'store_id'
        ]);
        $this->belongsTo('SalesItems', [
            'foreignKey' => 'sales_item_id'
        ]);

        $this->hasOne('SalesItemHistories', [
            'foreignKey' => 'sales_item_id',
            'bindingKey' => 'sales_item_id'
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
            ->date('transaction_date')
            ->allowEmpty('transaction_date');

        $validator
            ->integer('qty')
            ->allowEmpty('qty');

        $validator
            ->integer('sales_item_price_sum')
            ->allowEmpty('sales_item_price_sum');

        $validator
            ->integer('sales_item_cost_sum')
            ->allowEmpty('sales_item_cost_sum');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->dateTime('created_date')
            ->allowEmpty('created_date');

        $validator
            ->integer('updated_by')
            ->allowEmpty('updated_by');

        $validator
            ->dateTime('updated_date')
            ->allowEmpty('updated_date');

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
        $rules->add($rules->existsIn(['store_id'], 'Stores'));
        $rules->add($rules->existsIn(['sales_item_id'], 'SalesItems'));

        return $rules;
    }
}
