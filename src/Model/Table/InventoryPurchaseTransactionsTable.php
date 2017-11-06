<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * InventoryPurchaseTransactions Model
 *
 * @property \App\Model\Table\InventoryItemsTable|\Cake\ORM\Association\BelongsTo $InventoryItems
 * @property \App\Model\Table\StoresTable|\Cake\ORM\Association\BelongsTo $Stores
 *
 * @method \App\Model\Entity\InventoryPurchaseTransaction get($primaryKey, $options = [])
 * @method \App\Model\Entity\InventoryPurchaseTransaction newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\InventoryPurchaseTransaction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\InventoryPurchaseTransaction|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\InventoryPurchaseTransaction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\InventoryPurchaseTransaction[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\InventoryPurchaseTransaction findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InventoryPurchaseTransactionsTable extends Table
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

        $this->setTable('inventory_purchase_transactions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('InventoryItems', [
            'foreignKey' => 'inventory_item_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Stores', [
            'foreignKey' => 'store_id',
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
            ->dateTime('transaction_date')
            ->allowEmpty('transaction_date');

        $validator
            ->integer('purchase_qty')
            ->allowEmpty('purchase_qty');

        $validator
            ->integer('loss_qty')
            ->allowEmpty('loss_qty');

        $validator
            ->integer('count_qty')
            ->allowEmpty('count_qty');

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
        $rules->add($rules->existsIn(['inventory_item_id'], 'InventoryItems'));
        $rules->add($rules->existsIn(['store_id'], 'Stores'));

        return $rules;
    }
}
