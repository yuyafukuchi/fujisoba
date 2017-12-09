<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StoreInventoryItemHistories Model
 *
 * @property \App\Model\Table\InventoryItemsTable|\Cake\ORM\Association\BelongsTo $InventoryItems
 * @property \App\Model\Table\StoresTable|\Cake\ORM\Association\BelongsTo $Stores
 *
 * @method \App\Model\Entity\StoreInventoryItemHistory get($primaryKey, $options = [])
 * @method \App\Model\Entity\StoreInventoryItemHistory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StoreInventoryItemHistory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StoreInventoryItemHistory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StoreInventoryItemHistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StoreInventoryItemHistory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StoreInventoryItemHistory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StoreInventoryItemHistoriesTable extends Table
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

        $this->setTable('store_inventory_item_histories');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Muffin/Footprint.Footprint');

        $this->belongsTo('InventoryItems', [
            'foreignKey' => 'inventory_item_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('InventoryItemHistories', [
            'foreignKey' => 'inventory_item_id',
            'bindingKey' => 'inventory_item_id',
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
            ->integer('price')
            ->allowEmpty('price');

        $validator
            ->decimal('cost')
            ->allowEmpty('cost');

        $validator
            ->dateTime('start')
            ->allowEmpty('start');

        $validator
            ->dateTime('end')
            ->allowEmpty('end');

        $validator
            ->boolean('deleted')
            ->requirePresence('deleted', 'create')
            ->notEmpty('deleted');

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
