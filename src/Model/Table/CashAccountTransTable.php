<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CashAccountTrans Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Stores
 * @property \Cake\ORM\Association\BelongsTo $CashAccounts
 *
 * @method \App\Model\Entity\CashAccountTran get($primaryKey, $options = [])
 * @method \App\Model\Entity\CashAccountTran newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CashAccountTran[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CashAccountTran|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CashAccountTran patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CashAccountTran[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CashAccountTran findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CashAccountTransTable extends AppTable
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

        $this->table('cash_account_trans');
        $this->displayField('id');
        $this->primaryKey('id');

        

        $this->belongsTo('Stores', [
            'foreignKey' => 'store_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CashAccounts', [
            'foreignKey' => 'cash_account_id',
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
            ->integer('amount')
            ->allowEmpty('amount');

        $validator
            ->allowEmpty('note');

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
        $rules->add($rules->existsIn(['cash_account_id'], 'CashAccounts'));

        return $rules;
    }
}
