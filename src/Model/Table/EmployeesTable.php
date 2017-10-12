<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Employees Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\BelongsTo $Stores
 * @property \Cake\ORM\Association\HasMany $TimeCards
 *
 * @method \App\Model\Entity\Employee get($primaryKey, $options = [])
 * @method \App\Model\Entity\Employee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Employee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Employee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Employee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Employee findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmployeesTable extends AppTable
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

        $this->table('employees');
        $this->displayField('id');
        $this->primaryKey('id');

        

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Stores', [
            'foreignKey' => 'store_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('TimeCards', [
            'foreignKey' => 'employee_id'
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
            ->notEmpty('code');

        $validator
            ->requirePresence('name_last', 'create')
            ->notEmpty('name_last');

        $validator
            ->requirePresence('name_first', 'create')
            ->notEmpty('name_first');

        $validator
            ->requirePresence('name_last_kana', 'create')
            ->notEmpty('name_last_kana');

        $validator
            ->requirePresence('name_first_kana', 'create')
            ->notEmpty('name_first_kana');

        $validator
            ->allowEmpty('contact_type');

        $validator
            ->dateTime('joined')
            ->allowEmpty('joined');

        $validator
            ->dateTime('retired')
            ->allowEmpty('retired');

        $validator
            ->allowEmpty('note');

        $validator
            ->boolean('flag')
            ->allowEmpty('flag');

        $validator
            ->integer('regular_amount')
            ->allowEmpty('regular_amount');

        $validator
            ->integer('midnight_amount')
            ->allowEmpty('midnight_amount');

        $validator
            ->integer('other1_amount')
            ->allowEmpty('other1_amount');

        $validator
            ->integer('other2_amount')
            ->allowEmpty('other2_amount');

        $validator
            ->allowEmpty('employee_shift');

        $validator
            ->integer('othershift_start')
            ->allowEmpty('othershift_start');

        $validator
            ->integer('othershift_end')
            ->allowEmpty('othershift_end');

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
        $rules->add($rules->existsIn(['store_id'], 'Stores'));

        return $rules;
    }
}
