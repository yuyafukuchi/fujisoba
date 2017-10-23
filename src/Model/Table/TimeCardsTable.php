<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TimeCards Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Employees
 * @property \Cake\ORM\Association\BelongsTo $Stores
 * @property \Cake\ORM\Association\BelongsTo $AttendanceStores
 *
 * @method \App\Model\Entity\TimeCard get($primaryKey, $options = [])
 * @method \App\Model\Entity\TimeCard newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TimeCard[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TimeCard|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TimeCard patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TimeCard[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TimeCard findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TimeCardsTable extends Table
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

        $this->table('time_cards');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Employees', [
            'foreignKey' => 'employee_id',
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
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmpty('date');

        $validator
            ->dateTime('in_time')
            ->allowEmpty('in_time');

        $validator
            ->dateTime('out_time')
            ->allowEmpty('out_time');

        $validator
            ->dateTime('in_time2')
            ->allowEmpty('in_time2');

        $validator
            ->dateTime('out_time2')
            ->allowEmpty('out_time2');

        $validator
            ->dateTime('schedules_in_time')
            ->allowEmpty('schedules_in_time');

        $validator
            ->dateTime('scheduled_out_time')
            ->allowEmpty('scheduled_out_time');

        $validator
            ->decimal('work_time')
            ->allowEmpty('work_time');

        $validator
            ->decimal('over_time')
            ->allowEmpty('over_time');

        $validator
            ->decimal('paid_vacation')
            ->allowEmpty('paid_vacation');

        $validator
            ->integer('paid_vacation_start_time')
            ->allowEmpty('paid_vacation_start_time');

        $validator
            ->integer('paid_vacation_end_time')
            ->allowEmpty('paid_vacation_end_time');

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
        $rules->add($rules->existsIn(['employee_id'], 'Employees'));
        $rules->add($rules->existsIn(['store_id'], 'Stores'));

        return $rules;
    }
}
