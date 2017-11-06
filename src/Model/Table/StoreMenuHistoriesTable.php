<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StoreMenuHistories Model
 *
 * @property \App\Model\Table\MenuItemsTable|\Cake\ORM\Association\BelongsTo $MenuItems
 * @property \App\Model\Table\StoresTable|\Cake\ORM\Association\BelongsTo $Stores
 *
 * @method \App\Model\Entity\StoreMenuHistory get($primaryKey, $options = [])
 * @method \App\Model\Entity\StoreMenuHistory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StoreMenuHistory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StoreMenuHistory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StoreMenuHistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StoreMenuHistory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StoreMenuHistory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StoreMenuHistoriesTable extends Table
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

        $this->setTable('store_menu_histories');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Menus', [
            'foreignKey' => 'menu_item_id',
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
            ->integer('store_menu_number')
            ->requirePresence('store_menu_number', 'create')
            ->notEmpty('store_menu_number');

        $validator
            ->integer('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->boolean('vending_mashine1')
            ->requirePresence('vending_mashine1', 'create')
            ->notEmpty('vending_mashine1');

        $validator
            ->boolean('vending_mashine2')
            ->requirePresence('vending_mashine2', 'create')
            ->notEmpty('vending_mashine2');

        $validator
            ->allowEmpty('sales_item_price');

        $validator
            ->decimal('sales_item_cost')
            ->allowEmpty('sales_item_cost');

        $validator
            ->dateTime('start_date')
            ->allowEmpty('start_date');

        $validator
            ->dateTime('end_date')
            ->allowEmpty('end_date');

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
        $rules->add($rules->existsIn(['menu_item_id'], 'Menus'));
        $rules->add($rules->existsIn(['store_id'], 'Stores'));

        return $rules;
    }
}
