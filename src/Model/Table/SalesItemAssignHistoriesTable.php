<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SalesItemAssignHistories Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $MenuItems
 * @property \App\Model\Table\SalesItemsTable|\Cake\ORM\Association\BelongsTo $SalesItems
 *
 * @method \App\Model\Entity\SalesItemAssignHistory get($primaryKey, $options = [])
 * @method \App\Model\Entity\SalesItemAssignHistory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SalesItemAssignHistory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SalesItemAssignHistory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SalesItemAssignHistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SalesItemAssignHistory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SalesItemAssignHistory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SalesItemAssignHistoriesTable extends Table
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

        $this->setTable('sales_item_assign_histories');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Muffin/Footprint.Footprint');

        $this->belongsTo('Menus', [
            'foreignKey' => 'menu_item_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('SalesItems', [
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
            ->dateTime('start')
            ->allowEmpty('start');

        $validator
            ->dateTime('end')
            ->allowEmpty('end');

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
        $rules->add($rules->existsIn(['sales_item_id'], 'SalesItems'));

        return $rules;
    }
}
