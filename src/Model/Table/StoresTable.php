<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Stores Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\HasMany $CashAccountTrans
 * @property \Cake\ORM\Association\HasMany $Employees
 * @property \Cake\ORM\Association\HasMany $InventoryPurchaseTransactions
 * @property \Cake\ORM\Association\HasMany $SalesTransactions
 * @property \Cake\ORM\Association\HasMany $StoreAccountInfos
 * @property \Cake\ORM\Association\HasMany $StoreInventoryItemHistories
 * @property \Cake\ORM\Association\HasMany $StoreMenuHistories
 * @property \Cake\ORM\Association\HasMany $TimeCards
 * @property \Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\Store get($primaryKey, $options = [])
 * @method \App\Model\Entity\Store newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Store[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Store|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Store patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Store[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Store findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StoresTable extends Table
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

        $this->table('stores');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('CashAccountTrans', [
            'foreignKey' => 'store_id'
        ]);
        $this->hasMany('Employees', [
            'foreignKey' => 'store_id'
        ]);
        $this->hasMany('InventoryPurchaseTransactions', [
            'foreignKey' => 'store_id'
        ]);
        $this->hasMany('SalesTransactions', [
            'foreignKey' => 'store_id'
        ]);
        $this->hasMany('StoreAccountInfos', [
            'foreignKey' => 'store_id'
        ]);
        $this->hasMany('StoreInventoryItemHistories', [
            'foreignKey' => 'store_id'
        ]);
        $this->hasMany('StoreMenuHistories', [
            'foreignKey' => 'store_id'
        ]);
        $this->hasMany('TimeCards', [
            'foreignKey' => 'store_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'store_id'
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
            ->requirePresence('code', 'create')
            ->notEmpty('code')
            ->add('code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->allowEmpty('pay_department_code');

        $validator
            ->allowEmpty('fin_department_code');

        $validator
            ->dateTime('start_date')
            ->allowEmpty('start_date');

        $validator
            ->dateTime('end_date')
            ->allowEmpty('end_date');

        $validator
            ->integer('regular_start_time')
            ->allowEmpty('regular_start_time');

        $validator
            ->integer('regular_end_time')
            ->allowEmpty('regular_end_time');

        $validator
            ->integer('midnight_start_time')
            ->allowEmpty('midnight_start_time');

        $validator
            ->integer('midnight_end_time')
            ->allowEmpty('midnight_end_time');

        $validator
            ->integer('other1_start_time')
            ->allowEmpty('other1_start_time');

        $validator
            ->integer('other1_end_time')
            ->allowEmpty('other1_end_time');

        $validator
            ->integer('other2_start_time')
            ->allowEmpty('other2_start_time');

        $validator
            ->integer('other2_end_time')
            ->allowEmpty('other2_end_time');

        $validator
            ->integer('early_start_time')
            ->allowEmpty('early_start_time');

        $validator
            ->integer('early_end_time')
            ->allowEmpty('early_end_time');

        $validator
            ->integer('middle_start_time')
            ->allowEmpty('middle_start_time');

        $validator
            ->integer('middle_end_time')
            ->allowEmpty('middle_end_time');

        $validator
            ->integer('late_start_time')
            ->allowEmpty('late_start_time');

        $validator
            ->integer('late_end_time')
            ->allowEmpty('late_end_time');

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
        $rules->add($rules->existsIn(['company_id'], 'Companies'));

        return $rules;
    }
}
