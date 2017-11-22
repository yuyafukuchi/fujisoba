<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SalesTransactions Model
 *
 * @property \App\Model\Table\StoresTable|\Cake\ORM\Association\BelongsTo $Stores
 * @property \App\Model\Table\MenusTable|\Cake\ORM\Association\BelongsTo $Menus
 * @property \App\Model\Table\SalesItemTransactionsTable|\Cake\ORM\Association\HasMany $SalesItemTransactions
 *
 * @method \App\Model\Entity\SalesTransaction get($primaryKey, $options = [])
 * @method \App\Model\Entity\SalesTransaction newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SalesTransaction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SalesTransaction|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SalesTransaction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SalesTransaction[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SalesTransaction findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SalesTransactionsTable extends Table
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

        $this->setTable('sales_transactions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Stores', [
            'foreignKey' => 'store_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Menus', [
            'foreignKey' => 'menu_id'
        ]);
        $this->hasMany('SalesItemTransactions', [
            'foreignKey' => 'sales_transaction_id'
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
            ->requirePresence('transaction_date', 'create')
            ->notEmpty('transaction_date');

        $validator
            ->integer('menu_number')
            ->requirePresence('menu_number', 'create')
            ->notEmpty('menu_number');

        $validator
            ->scalar('menu_name')
            ->allowEmpty('menu_name');

        $validator
            ->integer('qty')
            ->allowEmpty('qty');

        $validator
            ->integer('cash_sales_amount')
            ->allowEmpty('cash_sales_amount');

        $validator
            ->integer('pasmo_sales_amount')
            ->allowEmpty('pasmo_sales_amount');

        $validator
            ->integer('sales_amount')
            ->allowEmpty('sales_amount');

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
        $rules->add($rules->existsIn(['store_id'], 'Stores'));
        $rules->add($rules->existsIn(['menu_id'], 'Menus'));

        return $rules;
    }
}
