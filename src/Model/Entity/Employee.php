<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Employee Entity
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $family_name
 * @property string|null $given_name
 * @property string|null $middle_name
 * @property int|null $college_id
 * @property string|null $gender
 * @property \Cake\I18n\FrozenDate|null $birthdate
 * @property string|null $academic_rank
 * @property int $active
 * @property int $visible
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\College $college
 * @property \App\Model\Entity\Consultation[] $consultations
 * @property \App\Model\Entity\Dental[] $dentals
 * @property \App\Model\Entity\EmployeeUser[] $employee_users
 * @property \App\Model\Entity\FacultyEvaluation[] $faculty_evaluations
 * @property \App\Model\Entity\LearningResourceMember[] $learning_resource_members
 * @property \App\Model\Entity\MedicalCertificate[] $medical_certificates
 * @property \App\Model\Entity\Memo[] $memos
 * @property \App\Model\Entity\ReferralRecommendation[] $referral_recommendations
 * @property \App\Model\Entity\StudentLog[] $student_logs
 */
class Employee extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'code' => true,
        'family_name' => true,
        'given_name' => true,
        'middle_name' => true,
        'college_id' => true,
        'gender' => true,
        'birthdate' => true,
        'academic_rank' => true,
        'active' => true,
        'visible' => true,
        'created' => true,
        'modified' => true,
        'college' => true,
        'consultations' => true,
        'dentals' => true,
        'employee_users' => true,
        'faculty_evaluations' => true,
        'learning_resource_members' => true,
        'medical_certificates' => true,
        'memos' => true,
        'referral_recommendations' => true,
        'student_logs' => true,
    ];
}
