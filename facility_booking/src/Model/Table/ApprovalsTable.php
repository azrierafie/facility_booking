<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Approvals Model
 *
 * @property \App\Model\Table\BookingsTable&\Cake\ORM\Association\BelongsTo $Bookings
 *
 * @method \App\Model\Entity\Approval newEmptyEntity()
 * @method \App\Model\Entity\Approval newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Approval> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Approval get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Approval findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Approval patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Approval> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Approval|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Approval saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Approval>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Approval>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Approval>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Approval> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Approval>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Approval>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Approval>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Approval> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ApprovalsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('approvals');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Bookings', [
            'foreignKey' => 'booking_id',
            'joinType' => 'INNER',
        ]);
        
        $this->belongsTo('ApprovedBy', [
            'className' => 'Users',
            'foreignKey' => 'approved_by',
            'joinType' => 'LEFT',
            'propertyName' => 'approver',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('booking_id')
            ->notEmptyString('booking_id')
            ->add('booking_id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->integer('approved_by')
            ->allowEmptyString('approved_by');

        $validator
            ->scalar('person_in_charge')
            ->maxLength('person_in_charge', 255)
            ->requirePresence('person_in_charge', 'create')
            ->notEmptyString('person_in_charge', 'Please enter the name of the person in charge.');

        $validator
            ->scalar('status')
            ->maxLength('status', 20)
            ->requirePresence('status', 'create')
            ->notEmptyString('status', 'Please select a status.');

        $validator
            ->scalar('notes')
            ->requirePresence('notes', 'create')
            ->notEmptyString('notes', 'Please provide some notes for the approval.');

        $validator
            ->dateTime('approved_at')
            ->requirePresence('approved_at', 'create')
            ->notEmptyDateTime('approved_at', 'Please select the approval date and time.');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['booking_id']), ['errorField' => 'booking_id']);
        $rules->add($rules->existsIn(['booking_id'], 'Bookings'), ['errorField' => 'booking_id']);

        return $rules;
    }
}
