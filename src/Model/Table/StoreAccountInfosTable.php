<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StoreAccountInfos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Accounts
 * @property \Cake\ORM\Association\BelongsTo $Stores
 * @property \Cake\ORM\Association\BelongsTo $DebitCategories
 * @property \Cake\ORM\Association\BelongsTo $CreditCategories
 *
 * @method \App\Model\Entity\StoreAccountInfo get($primaryKey, $options = [])
 * @method \App\Model\Entity\StoreAccountInfo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StoreAccountInfo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StoreAccountInfo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StoreAccountInfo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StoreAccountInfo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StoreAccountInfo findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StoreAccountInfosTable extends AppTable
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

        $this->table('store_account_infos');
        $this->displayField('id');
        $this->primaryKey('id');

        

        $this->belongsTo('Accounts', [
            'foreignKey' => 'account_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Stores', [
            'foreignKey' => 'store_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('DebitCategories', [
            'foreignKey' => 'debit_category_id'
        ]);
        $this->belongsTo('CreditCategories', [
            'foreignKey' => 'credit_category_id'
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
            ->boolean('need_debit_department_code')
            ->requirePresence('need_debit_department_code', 'create')
            ->notEmpty('need_debit_department_code');

        $validator
            ->boolean('need_credit_department_code')
            ->requirePresence('need_credit_department_code', 'create')
            ->notEmpty('need_credit_department_code');

        $validator
            ->allowEmpty('note');

        $validator
            ->allowEmpty('note_monthly');

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
        $rules->add($rules->existsIn(['account_id'], 'Accounts'));
        $rules->add($rules->existsIn(['store_id'], 'Stores'));
        $rules->add($rules->existsIn(['debit_category_id'], 'DebitCategories'));
        $rules->add($rules->existsIn(['credit_category_id'], 'CreditCategories'));

        return $rules;
    }
}
