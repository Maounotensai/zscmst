<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;



class StudentClearancesTable extends Table
{
   public function initialize(array $config): void{

    $this->addBehavior('Timestamp');

    $this->belongsTo('Students', [

      'foreignKey' => 'student_id',

      'propertyName' => 'Student'

    ]);

    $this->belongsTo('CollegePrograms', [

      'foreignKey' => 'course_id',

      'propertyName' => 'CollegeProgram'

    ]);

  }

  public function getAllStudentClearancePrint($conditions){

    $search = @$conditions['search'];

    // $date = @$conditions['date'];

    $sql = "

      SELECT

        StudentClearance.*,

        CollegeProgram.name

      FROM

        student_clearances as StudentClearance LEFT JOIN

        college_programs as CollegeProgram ON StudentClearance.course_id = CollegeProgram.id LEFT JOIN

        students as Student ON StudentClearance.student_id = Student.id

      WHERE

      StudentClearance.visible = true AND

        (
 
          StudentClearance.code LIKE  '%$search%' OR

          StudentClearance.student_no LIKE  '%$search%' OR

          StudentClearance.student_name LIKE  '%$search%' OR

          StudentClearance.year LIKE  '%$search%' OR

          StudentClearance.major LIKE  '%$search%'

        )

      ORDER BY 

      StudentClearance.code DESC

    ";

    $query = $this->getConnection()->prepare($sql);

    $query->execute();

    return $query;

  }

  public function getAllStudentClearance($conditions, $limit, $page){

    $search = @$conditions['search'];

    $date = @$conditions['date'];

    $offset = ($page - 1) * $limit;

    $sql = "

      SELECT

        StudentClearance.*,

        CollegeProgram.name

      FROM

        student_clearances as StudentClearance LEFT JOIN

        college_programs as CollegeProgram ON StudentClearance.course_id = CollegeProgram.id LEFT JOIN

        students as Student ON StudentClearance.student_id = Student.id

      WHERE

        StudentClearance.visible = true AND 

        (
 
          StudentClearance.code LIKE  '%$search%' OR

          StudentClearance.student_no LIKE  '%$search%' OR

          StudentClearance.student_name LIKE  '%$search%' OR

          StudentClearance.year LIKE  '%$search%' OR

          StudentClearance.major LIKE  '%$search%'

        )

      GROUP BY

        StudentClearance.id

      ORDER BY 

        StudentClearance.code DESC

      LIMIT

        $limit OFFSET $offset

    ";

    $query = $this->getConnection()->prepare($sql);

    $query->execute();

    return $query;

  }

  public function paginate($query, array $options = []){

    $extra = isset($options['extra']) ? $options['extra'] : [];

    $conditions = isset($extra['conditions']) ? $extra['conditions'] : [];

    $page = $options['page'];

    $limit = $options['limit'];

    $result = $this->getAllStudentClearance($conditions, $limit, $page)->fetchAll('assoc');

    $paginator = [

      'page' => $page,

      'limit' => $limit,

      'count' => $this->paginateCount($conditions),

      'perPage' => $limit,

      'pageCount' => ceil($this->paginateCount($conditions) / $limit),

    ];

    return [

      'data' => $result,

      'pagination' => $paginator,

    ];

  }

  public function paginateCount($conditions = null){ 

    $search = @$conditions['search'];

    // $date = @$conditions['date'];

    $sql = "

      SELECT

        count(*) as count

       FROM

        student_clearances as StudentClearance 

      WHERE

        StudentClearance.visible = true AND 

        (
 
          StudentClearance.code LIKE  '%$search%' OR

          StudentClearance.student_no LIKE  '%$search%' OR

          StudentClearance.student_name LIKE  '%$search%' OR

          StudentClearance.year LIKE  '%$search%' OR

          StudentClearance.major LIKE  '%$search%'

        )

    ";

    $query = $this->getConnection()->execute($sql)->fetch('assoc');

    return $query['count'];

  }



}
