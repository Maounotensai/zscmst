<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;



class ReportsTable extends Table
{


    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('employees'); // Adjust the table name if needed
    }


    // learning resource

    public function getAllCheckout($conditions, $limit, $page)
    {

      $search = strtolower(@$conditions['search']);

      $date = @$conditions['date'];

      $borrower_id = @$conditions['borrower_id'];

      $offset = ($page - 1) * $limit;

      $sql = "

        SELECT 

          CheckOut.*,

          LearningResourceMember.code

        FROM 

          check_outs as CheckOut LEFT JOIN

          learning_resource_members as LearningResourceMember ON CheckOut.learning_resource_member_id = LearningResourceMember.id

        WHERE 

          CheckOut.visible = true $date AND 

          (

            CheckOut.library_id_number LIKE '%$search%' OR 

            CheckOut.member_name LIKE '%$search%' OR 

            CheckOut.email LIKE '%$search%'      

          )

        ORDER BY 

          CheckOut.id DESC

        LIMIT

          $limit OFFSET $offset

      ";

      $query = $this->getConnection()->prepare($sql);

      $query->execute();

      return $query;
      
    }

    public function getAllCheckoutPrint($conditions)
    {

       $search = strtolower(@$conditions['search']);

      $date = @$conditions['date'];

      $borrower_id = @$conditions['borrower_id'];

      $sql = "

        SELECT 

          CheckOut.*,

          LearningResourceMember.code

        FROM 

          check_outs as CheckOut LEFT JOIN

          learning_resource_members as LearningResourceMember ON CheckOut.learning_resource_member_id = LearningResourceMember.id

        WHERE 

          CheckOut.visible = true $date AND 

          (

            CheckOut.library_id_number LIKE '%$search%' OR 

            CheckOut.member_name LIKE '%$search%' OR 

            CheckOut.email LIKE '%$search%'      

          )

        ORDER BY 

          CheckOut.id DESC

      ";

      $query = $this->getConnection()->prepare($sql);

      $query->execute();

      return $query;
    }

    public function countAllCheckout($conditions = []): string
    {

      $search = strtolower(@$conditions['search']);

      $date = @$conditions['date'];

      $borrower_id = @$conditions['borrower_id'];

      $sql = "

        SELECT 

          count(*) as count

        FROM 

          check_outs as CheckOut 

        WHERE 

          CheckOut.visible = true $date AND 

          (

            CheckOut.library_id_number LIKE '%$search%' OR 

            CheckOut.member_name LIKE '%$search%' OR 

            CheckOut.email LIKE '%$search%'      

          )

      ";

      $query = $this->getConnection()->execute($sql)->fetch('assoc');

      return $query['count'];

    }


    // Registrar
    public function getAllEnrollmentProfile($conditions, $limit, $page)
    {

      $search = strtolower(@$conditions['search']);

      $date = @$conditions['date'];

      $college_id = @$conditions['college_id'];

      $program_id = @$conditions['program_id'];

      $year_term_id = @$conditions['year_term_id'];

      $section_id = @$conditions['section_id'];

        $offset = ($page - 1) * $limit;

        // Your SQL query here, make sure to adjust table names and columns
        $sql =  "

        SELECT 

          Student.*,

          CONCAT(Student.first_name, ', ', IFNULL(Student.last_name,''),'', IFNULL(CONCAT(' ',Student.middle_name), '')) as full_name,

          StudentEnrolledCourse.course,StudentEnrolledCourse.section, 

          CollegeProgram.name

        FROM 

          students as Student LEFT JOIN

          student_enrolled_courses as StudentEnrolledCourse ON StudentEnrolledCourse.student_id = Student.id LEFT JOIN

          college_programs as CollegeProgram ON CollegeProgram.id = Student.program_id 

        WHERE 

          Student.visible = true $program_id  $section_id $year_term_id $college_id   AND

          Student.active = true AND

        ( 

          Student.last_name              LIKE  '%$search%' OR

          Student.first_name             LIKE  '%$search%' OR

          Student.middle_name            LIKE  '%$search%' OR

          StudentEnrolledCourse.course   LIKE  '%search%' 
        )

        GROUP BY

          Student.id

        ORDER BY 

          full_name ASC

      LIMIT

      $limit OFFSET $offset ";

        $query = $this->getConnection()->prepare($sql);

        $query->execute();

        return $query;
    }

    public function getAllEnrollmentProfilePrint($conditions)
    {

      $search = strtolower(@$conditions['search']);

      $date = @$conditions['date'];

      $college_id = @$conditions['college_id'];

      $program_id = @$conditions['program_id'];

      $year_term_id = @$conditions['year_term_id'];

      $section_id = @$conditions['section_id'];

        // Your SQL query here, make sure to adjust table names and columns
        $sql =  "

        SELECT 

          Student.*,

          CONCAT(Student.first_name, ', ', IFNULL(Student.last_name,''),'', IFNULL(CONCAT(' ',Student.middle_name), '')) as full_name,

          StudentEnrolledCourse.course,StudentEnrolledCourse.section, 

          CollegeProgram.name

        FROM 

          students as Student LEFT JOIN

          student_enrolled_courses as StudentEnrolledCourse ON StudentEnrolledCourse.student_id = Student.id LEFT JOIN

          college_programs as CollegeProgram ON CollegeProgram.id = Student.program_id 

        WHERE 

          Student.visible = true $program_id  $section_id $year_term_id $college_id   AND

          Student.active = true AND

        ( 

          Student.last_name              LIKE  '%$search%' OR

          Student.first_name             LIKE  '%$search%' OR

          Student.middle_name            LIKE  '%$search%' OR

          StudentEnrolledCourse.course   LIKE  '%search%' 
        )

        GROUP BY

          Student.id

        ORDER BY 

          full_name ASC ";

        $query = $this->getConnection()->prepare($sql);

        $query->execute();

        return $query;
    }

    public function countAllEnrollmentProfile($conditions = []): string
    {

      $search = strtolower(@$conditions['search']);

      $date = @$conditions['date'];

      $term_id = @$conditions['term_id'];

      $program_id = @$conditions['program_id'];

      $college_id = @$conditions['college_id'];

      $section_id = @$conditions['section_id'];

      $year_term_id = @$conditions['year_term_id'];

        
        $sql = "SELECT count(*) as count FROM (

            SELECT 

          Student.*,

          CONCAT(Student.first_name, ', ', IFNULL(Student.last_name,''),'', IFNULL(CONCAT(' ',Student.middle_name), '')) as full_name,

          StudentEnrolledCourse.course,

          CollegeProgram.name


        FROM 

          students as Student LEFT JOIN

          student_enrolled_courses as StudentEnrolledCourse ON StudentEnrolledCourse.student_id = Student.id LEFT JOIN

          college_programs as CollegeProgram ON CollegeProgram.id = Student.program_id

        WHERE 

          Student.visible = true $program_id  $section_id  $year_term_id  $college_id AND

          Student.active = true AND

        ( 

          Student.last_name              LIKE  '%$search%' OR

          Student.first_name             LIKE  '%$search%' OR

          Student.middle_name            LIKE  '%$search%' OR

          StudentEnrolledCourse.course   LIKE  '%search%' 

        )

        GROUP BY

          Student.id

        ORDER BY 

         full_name ASC

       ) as Report

        ";

        $query = $this->getConnection()->execute($sql)->fetch('assoc');

        return $query['count'];

    }

    public function getAllEnrollmentList($conditions, $limit, $page)
    {

      $search = strtolower(@$conditions['search']);

      $date = @$conditions['date'];

      $year_term_id = @$conditions['year_term_id'];

      $year_term_id_enrollment = @$conditions['year_term_id_enrollment'];

        $offset = ($page - 1) * $limit;

        // Your SQL query here, make sure to adjust table names and columns
        $sql =  "

        SELECT

          Student.*,

          CONCAT(IFNULL(Student.last_name,''),', ',IFNULL(Student.first_name,''),' ',IFNULL(Student.middle_name,'')) as full_name,

          StudentEnrollment.date,

          College.name as college,

          CollegeProgram.name as program

        FROM

          students as Student  LEFT JOIN

          colleges as College ON College.id = Student.college_id LEFT JOIN 

          college_programs as CollegeProgram ON CollegeProgram.id = Student.program_id LEFT JOIN 

          (

            SELECT 

              StudentEnrollment.*

            FROM

              student_enrollments as StudentEnrollment

            WHERE 

              StudentEnrollment.visible = true $year_term_id_enrollment

          ) as StudentEnrollment ON StudentEnrollment.student_id = Student.id
 
        WHERE

          Student.visible = true $date $year_term_id AND

          StudentEnrollment.visible = true AND 

          (

            Student.last_name LIKE '%$search%' OR 

            Student.first_name LIKE '%$search%' OR 

            Student.middle_name LIKE '%$search%' OR 

            Student.student_no LIKE '%$search%' OR  

            College.name LIKE '%$search%' OR 

            CollegeProgram.name LIKE '%$search%'

          )

        GROUP BY

          Student.id

        ORDER BY

          full_name ASC
      LIMIT

      $limit OFFSET $offset ";

        $query = $this->getConnection()->prepare($sql);

        $query->execute();

        return $query;
    }

    public function getAllEnrollmentListPrint($conditions)
    {

      $search = strtolower(@$conditions['search']);

      $date = @$conditions['date'];

      $year_term_id = @$conditions['year_term_id'];

      $year_term_id_enrollment = @$conditions['year_term_id_enrollment'];

        // Your SQL query here, make sure to adjust table names and columns
        $sql =  "

        SELECT

          Student.*,

          CONCAT(IFNULL(Student.last_name,''),', ',IFNULL(Student.first_name,''),' ',IFNULL(Student.middle_name,'')) as full_name,

          StudentEnrollment.date,

          College.name as college,

          CollegeProgram.name as program

        FROM

          students as Student  LEFT JOIN

          colleges as College ON College.id = Student.college_id LEFT JOIN 

          college_programs as CollegeProgram ON CollegeProgram.id = Student.program_id LEFT JOIN 

          (

            SELECT 

              StudentEnrollment.*

            FROM

              student_enrollments as StudentEnrollment

            WHERE 

              StudentEnrollment.visible = true $year_term_id_enrollment

          ) as StudentEnrollment ON StudentEnrollment.student_id = Student.id
 
        WHERE

          Student.visible = true $date $year_term_id AND

          StudentEnrollment.visible = true AND 

          (

            Student.last_name LIKE '%$search%' OR 

            Student.first_name LIKE '%$search%' OR 

            Student.middle_name LIKE '%$search%' OR 

            Student.student_no LIKE '%$search%' OR  

            College.name LIKE '%$search%' OR 

            CollegeProgram.name LIKE '%$search%'

          )

        GROUP BY

          Student.id

        ORDER BY

          full_name ASC ";

        $query = $this->getConnection()->prepare($sql);

        $query->execute();

        return $query;
    }

    public function countAllEnrollmentList($conditions = []): string
    {

      $search = strtolower(@$conditions['search']);

      $date = @$conditions['date'];

      $year_term_id = @$conditions['year_term_id'];

      $year_term_id_enrollment = @$conditions['year_term_id_enrollment'];

        
        $sql = "SELECT count(*) as count FROM (

        SELECT

          Student.id

        FROM

          students as Student  LEFT JOIN

          colleges as College ON College.id = Student.college_id LEFT JOIN 

          college_programs as CollegeProgram ON CollegeProgram.id = Student.program_id LEFT JOIN 

          (

            SELECT 

              StudentEnrollment.*

            FROM

              student_enrollments as StudentEnrollment

            WHERE 

              StudentEnrollment.visible = true $year_term_id_enrollment

          ) as StudentEnrollment ON StudentEnrollment.student_id = Student.id

        WHERE

          Student.visible = true $date $year_term_id AND

          StudentEnrollment.visible = true AND 

          (

            Student.last_name LIKE '%$search%' OR 

            Student.first_name LIKE '%$search%' OR 

            Student.middle_name LIKE '%$search%' OR 

            Student.student_no LIKE '%$search%' OR  

            College.name LIKE '%$search%' OR 

            CollegeProgram.name LIKE '%$search%'

          )

      ) as Report ";

        $query = $this->getConnection()->execute($sql)->fetch('assoc');

        return $query['count'];

    }

    public function getAllFailedStudent($conditions, $limit, $page)
    {

      $search = strtolower(@$conditions['search']);

      $date = @$conditions['date'];

      $college_id = @$conditions['college_id'];

      $college_program_id = @$conditions['college_program_id'];

      $program_course_id = @$conditions['program_course_id'];

      $term = @$conditions['term'];

        $offset = ($page - 1) * $limit;

        // Your SQL query here, make sure to adjust table names and columns
        $sql =  "

        SELECT 

            Student.student_no,

            StudentEnrolledCourse.*,

            Course.code,

            Course.title,

            YearLevelTerm.year,

            YearLevelTerm.semester,

            IFNULL(CONCAT(Student.last_name,', ',Student.first_name,' ',IFNULL(Student.middle_name,' ')),' ') AS full_name

          FROM 

            students as Student LEFT JOIN

           student_enrolled_courses as StudentEnrolledCourse ON StudentEnrolledCourse.student_id = Student.id LEFT JOIN 

           colleges as College ON College.id = Student.college_id LEFT JOIN 

           college_programs as CollegeProgram ON CollegeProgram.id = Student.program_id LEFT JOIN

           year_level_terms as YearLevelTerm ON StudentEnrolledCourse.year_term_id = YearLevelTerm.id LEFT join

           courses as Course ON StudentEnrolledCourse.course_id = Course.id 

          WHERE 

           Student.visible = true $date $college_id $college_program_id $program_course_id $term AND

           StudentEnrolledCourse.visible = true AND 

           
           (
   
             Student.first_name LIKE  '%$search%' OR

             Student.middle_name LIKE  '%$search%' OR

             Student.last_name LIKE  '%$search%' OR

             Student.student_no LIKE  '%$search%' 

           )

         ORDER BY 

           full_name ASC
      LIMIT

      $limit OFFSET $offset ";

        $query = $this->getConnection()->prepare($sql);

        $query->execute();

        return $query;
    }

    public function getAllFailedStudentPrint($conditions)
    {

      $search = strtolower(@$conditions['search']);

      $date = @$conditions['date'];

      $college_id = @$conditions['college_id'];

      $college_program_id = @$conditions['college_program_id'];

      $program_course_id = @$conditions['program_course_id'];

      $term = @$conditions['term'];

        // Your SQL query here, make sure to adjust table names and columns
        $sql =  "

         SELECT 

            Student.student_no,

            StudentEnrolledCourse.*,

            Course.code,

            Course.title,

            YearLevelTerm.year,

            YearLevelTerm.semester,

            IFNULL(CONCAT(Student.last_name,', ',Student.first_name,' ',IFNULL(Student.middle_name,' ')),' ') AS full_name

          FROM 

            students as Student LEFT JOIN

           student_enrolled_courses as StudentEnrolledCourse ON StudentEnrolledCourse.student_id = Student.id LEFT JOIN 

           colleges as College ON College.id = Student.college_id LEFT JOIN 

           college_programs as CollegeProgram ON CollegeProgram.id = Student.program_id LEFT JOIN

           year_level_terms as YearLevelTerm ON StudentEnrolledCourse.year_term_id = YearLevelTerm.id LEFT join

           courses as Course ON StudentEnrolledCourse.course_id = Course.id 

          WHERE 

           Student.visible = true $date $college_id $college_program_id $program_course_id $term AND

           StudentEnrolledCourse.visible = true AND 

           
           (
   
             Student.first_name LIKE  '%$search%' OR

             Student.middle_name LIKE  '%$search%' OR

             Student.last_name LIKE  '%$search%' OR

             Student.student_no LIKE  '%$search%' 

           )

         ORDER BY 

           full_name ASC ";

        $query = $this->getConnection()->prepare($sql);

        $query->execute();

        return $query;
    }

    public function countAllFailedStudent($conditions = []): string
    {

      $search = strtolower(@$conditions['search']);

      $date = @$conditions['date'];

      $college_id = @$conditions['college_id'];

      $college_program_id = @$conditions['college_program_id'];

      $program_course_id = @$conditions['program_course_id'];

      $term = @$conditions['term'];

        
        $sql = "SELECT count(*) as count FROM (

         SELECT 

            Student.student_no,

            StudentEnrolledCourse.*,

            YearLevelTerm.year,

            YearLevelTerm.semester,

            IFNULL(CONCAT(Student.last_name,', ',Student.first_name,' ',IFNULL(Student.middle_name,' ')),' ') AS full_name

          FROM 

           students as Student LEFT JOIN

           student_enrolled_courses as StudentEnrolledCourse ON StudentEnrolledCourse.student_id = Student.id LEFT JOIN 

           colleges as College ON College.id = Student.college_id LEFT JOIN 

           college_programs as CollegeProgram ON CollegeProgram.id = Student.program_id LEFT JOIN

           year_level_terms as YearLevelTerm ON StudentEnrolledCourse.year_term_id = YearLevelTerm.id 

          WHERE 

           Student.visible = true $date $college_id $college_program_id $program_course_id $term AND

           StudentEnrolledCourse.visible = true
     

         ORDER BY 

           full_name ASC

        ) as Report ";

        $query = $this->getConnection()->execute($sql)->fetch('assoc');

        return $query['count'];

    }

    public function getAllStudentBehavior($conditions, $limit, $page)
    {

      $search = strtolower(@$conditions['search']);

      $year = @$conditions['year'];

      $program_id = @$conditions['program_id'];

      $year_term_id_enrollment = @$conditions['year_term_id_enrollment'];

        $offset = ($page - 1) * $limit;

        // Your SQL query here, make sure to adjust table names and columns
        $sql =  "

        SELECT

          StudentBehavior.*,

          CollegeProgram.name as program

        FROM

          student_behaviors as StudentBehavior LEFT JOIN

          college_programs as CollegeProgram ON StudentBehavior.course_id = CollegeProgram.id 

 
        WHERE

          StudentBehavior.visible = true $program_id $year AND

          (

            StudentBehavior.student_name LIKE '%$search%' OR 


            CollegeProgram.name LIKE '%$search%'

          )
      LIMIT

      $limit OFFSET $offset ";

        $query = $this->getConnection()->prepare($sql);

        $query->execute();

        return $query;
    }

    public function getAllStudentBehaviorPrint($conditions)
    {

      $search = strtolower(@$conditions['search']);


      $year = @$conditions['year'];
      $program_id = @$conditions['program_id'];

      $year_term_id_enrollment = @$conditions['year_term_id_enrollment'];

        // Your SQL query here, make sure to adjust table names and columns
        $sql =  "

         SELECT

          StudentBehavior.*,

          CollegeProgram.name as program

        FROM

          student_behaviors as StudentBehavior LEFT JOIN

          college_programs as CollegeProgram ON StudentBehavior.course_id = CollegeProgram.id 

 
        WHERE

          StudentBehavior.visible = true $program_id $year AND

          (

            StudentBehavior.student_name LIKE '%$search%' OR 


            CollegeProgram.name LIKE '%$search%'

          ) ";

        $query = $this->getConnection()->prepare($sql);

        $query->execute();

        return $query;
    }

    public function countAllStudentBehavior($conditions = []): string
    {

      $search = strtolower(@$conditions['search']);


      $year = @$conditions['year'];
      $program_id = @$conditions['program_id'];

      $year_term_id_enrollment = @$conditions['year_term_id_enrollment'];

        
        $sql = "SELECT count(*) as count FROM (

        
        SELECT

          StudentBehavior.*,

          CollegeProgram.name as program

        FROM

          student_behaviors as StudentBehavior LEFT JOIN

          college_programs as CollegeProgram ON StudentBehavior.course_id = CollegeProgram.id 

 
        WHERE

          StudentBehavior.visible = true $program_id $year AND

          (

            StudentBehavior.student_name LIKE '%$search%' OR 


            CollegeProgram.name LIKE '%$search%'

          )


      ) as Report ";

        $query = $this->getConnection()->execute($sql)->fetch('assoc');

        return $query['count'];

    }

    public function getAllFacultyMasterlist($conditions, $limit, $page)
    {

      $search = strtolower(@$conditions['search']);

      $date = @$conditions['date'];

      $term_id = @$conditions['term_id'];

      $college_id = @$conditions['college_id'];

      $department_id = @$conditions['department_id'];

      $program_id = @$conditions['program_id'];

        $offset = ($page - 1) * $limit;

        // Your SQL query here, make sure to adjust table names and columns
        $sql =  " SELECT *  FROM 
        (

          SELECT 

          Employee.*,

         CONCAT(Employee.family_name, ', ', IFNULL(Employee.given_name,''),'', IFNULL(CONCAT(' ',Employee.middle_name), '')) as full_name,

         CONCAT(College.code,' - ',College.name) as college

        FROM 

          employees as Employee LEFT JOIN

          colleges as College ON College.id = Employee.college_id


        WHERE 

          Employee.visible = true $college_id AND

          Employee.active = true AND

          College.visible = true AND

        ( 

          Employee.code     LIKE  '%$search%' OR

          Employee.family_name     LIKE  '%$search%' OR

          Employee.given_name     LIKE  '%$search%' OR

          Employee.middle_name     LIKE  '%$search%' OR

          College.code     LIKE  '%$search%' OR

          College.name     LIKE  '%$search%'

        )

      GROUP BY

        Employee.id

      ORDER BY 

        full_name ASC

      

        ) as Report 


      LIMIT

      $limit OFFSET $offset ";

        $query = $this->getConnection()->prepare($sql);

        $query->execute();

        return $query;
    }

    public function countAllFacultyMasterlist($conditions = []): string
    {

        $search = strtolower(@$conditions['search']);

        $date = @$conditions['date'];

        $college_id = @$conditions['college_id'];

        
        $sql = "SELECT count(*) as count FROM (
            
          SELECT 

          Employee.id

        FROM 

          employees as Employee LEFT JOIN

          colleges as College ON College.id = Employee.college_id

        WHERE 

         Employee.visible = true $college_id AND

          Employee.active = true AND

          College.visible = true AND

         ( 

          Employee.code     LIKE  '%$search%' OR

          Employee.family_name     LIKE  '%$search%' OR

          Employee.given_name     LIKE  '%$search%' OR

          Employee.middle_name     LIKE  '%$search%' OR

          College.code     LIKE  '%$search%' OR

          College.name     LIKE  '%$search%'

        )

        ) as Report

      LIMIT

      $limit OFFSET $offset

        ";

        $query = $this->getConnection()->execute($sql)->fetch('assoc');

        return $query['count'];

    }

    // end registrar


    //admission

    public function getAllListApplicant($conditions, $limit, $page)
    {

      $search = strtolower(@$conditions['search']);

      $date = @$conditions['date'];

      $status = @$conditions['status'];

      $studentId = @$conditions['studentId'];

      $offset = ($page - 1) * $limit;

      $sql = "SELECT 

          ScholarshipApplication.*,

          CollegeProgram.name,

          ScholarshipName.scholarship_name

        FROM

          scholarship_applications as ScholarshipApplication LEFT JOIN

          scholarship_names as ScholarshipName ON ScholarshipName.id = ScholarshipApplication.scholarship_name_id LEFT JOIN

          students as Student ON ScholarshipApplication.student_id = Student.id LEFT JOIN

          college_programs as CollegeProgram ON CollegeProgram.id = Student.program_id

        WHERE

          ScholarshipApplication.visible = true $date $status $studentId AND

          (
   
            ScholarshipApplication.code LIKE  '%$search%' OR

            ScholarshipApplication.student_no LIKE  '%$search%' OR

            ScholarshipApplication.student_name LIKE  '%$search%' OR

            ScholarshipApplication.year_term_id LIKE  '%$search%' OR

            ScholarshipApplication.reason LIKE  '%$search%' OR 

            CollegeProgram.name LIKE  '%$search%'

          )

        ORDER BY 

        ScholarshipApplication.student_name ASC
          
      LIMIT

        $limit OFFSET $offset ";

        $query = $this->getConnection()->prepare($sql);

        $query->execute();

        return $query;
    }

    public function getAllListApplicantPrint($conditions)
    {

      $search = strtolower(@$conditions['search']);

      $date = @$conditions['date'];

      $status = @$conditions['status'];

      $studentId = @$conditions['studentId'];

      $sql = "SELECT 

          ScholarshipApplication.*,

          CollegeProgram.name,

          ScholarshipName.scholarship_name

        FROM

          scholarship_applications as ScholarshipApplication LEFT JOIN

          scholarship_names as ScholarshipName ON ScholarshipName.id = ScholarshipApplication.scholarship_name_id LEFT JOIN

          students as Student ON ScholarshipApplication.student_id = Student.id LEFT JOIN

          college_programs as CollegeProgram ON CollegeProgram.id = Student.program_id

        WHERE

          ScholarshipApplication.visible = true $date $status $studentId AND

          (
   
            ScholarshipApplication.code LIKE  '%$search%' OR

            ScholarshipApplication.student_no LIKE  '%$search%' OR

            ScholarshipApplication.student_name LIKE  '%$search%' OR

            ScholarshipApplication.year_term_id LIKE  '%$search%' OR

            ScholarshipApplication.reason LIKE  '%$search%' OR 

            CollegeProgram.name LIKE  '%$search%'

          )

        ORDER BY 

        ScholarshipApplication.student_name ASC ";

        $query = $this->getConnection()->prepare($sql);

        $query->execute();

        return $query;
    }

    public function countAllListApplicant($conditions = []): string
    {

      $search = strtolower(@$conditions['search']);

      $date = @$conditions['date'];

      $status = @$conditions['status'];

      $studentId = @$conditions['studentId'];
        
        $sql = "SELECT

          count(*) as count

       FROM

        scholarship_applications as ScholarshipApplication LEFT JOIN

        students as Student ON ScholarshipApplication.student_id = Student.id LEFT JOIN

        college_programs as CollegeProgram ON CollegeProgram.id = Student.program_id

      WHERE

        ScholarshipApplication.visible = true $date $status $studentId AND

        (
 
          ScholarshipApplication.code LIKE  '%$search%' OR

          ScholarshipApplication.student_no LIKE  '%$search%' OR

          ScholarshipApplication.student_name LIKE  '%$search%' OR

          ScholarshipApplication.year_term_id LIKE  '%$search%' OR

          ScholarshipApplication.reason LIKE  '%$search%' OR 

          CollegeProgram.name LIKE  '%$search%'

        ) ";

        $query = $this->getConnection()->execute($sql)->fetch('assoc');

        return $query['count'];

    }

    //end admission


    //Medical Services Reports

    public function getAllMedicalMonthlyAccomplishment($conditions, $limit, $page)
    {

      $search = strtolower(@$conditions['search']);

      $date = @$conditions['date'];

        $offset = ($page - 1) * $limit;

        // Your SQL query here, make sure to adjust table names and columns
        $sql =  " SELECT * FROM (

        SELECT

          IllnessRecommendation.ailment,

          IFNULL(StudentTreated.count,0) as studentTreated,

          IFNULL(EmployeeTreated.count,0) as employeeTreated,

          IFNULL(StudentTreated.count,0) + IFNULL(EmployeeTreated.count,0) as totalTreated,

          IFNULL(StudentRerred.count,0) as studentReferred,

          IFNULL(EmployeeRerred.count,0) as employeeReferred,

          IFNULL(StudentRerred.count,0) + IFNULL(EmployeeRerred.count,0) as totalReferred,

          IFNULL(StudentTreated.count,0) + IFNULL(EmployeeTreated.count,0) + IFNULL(StudentRerred.count,0) + IFNULL(EmployeeRerred.count,0) as remarks

        FROM 

          illness_recommendations as IllnessRecommendation LEFT JOIN

          (

            SELECT 

              ConsultationSub.chief_complaint_id,

              COUNT(*) as count

            FROM 

              consultation_subs as ConsultationSub LEFT JOIN 

              consultations as Consultation ON ConsultationSub.consultation_id = Consultation.id

            WHERE 

              Consultation.visible = true $date AND

              Consultation.status = 1 AND

              Consultation.student_id IS NOT NULL AND 

              ConsultationSub.visible = true 

          ) AS StudentTreated ON StudentTreated.chief_complaint_id = IllnessRecommendation.id LEFT JOIN

          (

            SELECT 

              ConsultationSub.chief_complaint_id,

              COUNT(*) as count

            FROM 

              consultation_subs as ConsultationSub LEFT JOIN 

              consultations as Consultation ON ConsultationSub.consultation_id = Consultation.id

            WHERE 

              Consultation.visible = true $date AND

              Consultation.status = 1 AND

              Consultation.employee_id IS NOT NULL AND 

              ConsultationSub.visible = true 

          ) AS EmployeeTreated ON EmployeeTreated.chief_complaint_id = IllnessRecommendation.id LEFT JOIN

          (

            SELECT 

              ConsultationSub.chief_complaint_id,

              COUNT(*) as count

            FROM 

              consultation_subs as ConsultationSub LEFT JOIN 

              consultations as Consultation ON ConsultationSub.consultation_id = Consultation.id

            WHERE 

              Consultation.visible = true $date AND

              Consultation.status = 2 AND

              Consultation.student_id IS NOT NULL AND 

              ConsultationSub.visible = true 

          ) AS StudentRerred ON StudentRerred.chief_complaint_id = IllnessRecommendation.id LEFT JOIN

          (

            SELECT 

              ConsultationSub.chief_complaint_id,

              COUNT(*) as count

            FROM 

              consultation_subs as ConsultationSub LEFT JOIN 

              consultations as Consultation ON ConsultationSub.consultation_id = Consultation.id

            WHERE 

              Consultation.visible = true $date AND

              Consultation.status = 2 AND

              Consultation.employee_id IS NOT NULL AND 

              ConsultationSub.visible = true 

          ) AS EmployeeRerred ON EmployeeRerred.chief_complaint_id = IllnessRecommendation.id

        WHERE

          IllnessRecommendation.visible = true AND 

          (

            IllnessRecommendation.ailment LIKE '%$search%'

          )

        GROUP BY

          IllnessRecommendation.id

        LIMIT

        $limit OFFSET $offset

      ) as Report ";

        $query = $this->getConnection()->prepare($sql);

        $query->execute();

        return $query;
    }

    public function countAllMedicalMonthlyAccomplishment($conditions = []): string
    {

        $search = strtolower(@$conditions['search']);

        $date = @$conditions['date'];

        
        $sql = "SELECT count(*) as total FROM (

        SELECT

          IllnessRecommendation.id

        FROM 

          illness_recommendations as IllnessRecommendation LEFT JOIN

          (

            SELECT 

              ConsultationSub.chief_complaint_id,

              COUNT(*) as count

            FROM 

              consultation_subs as ConsultationSub LEFT JOIN 

              consultations as Consultation ON ConsultationSub.consultation_id = Consultation.id

            WHERE 

              Consultation.visible = true $date AND

              Consultation.status = 1 AND

              Consultation.student_id IS NOT NULL AND 

              ConsultationSub.visible = true 

          ) AS StudentTreated ON StudentTreated.chief_complaint_id = IllnessRecommendation.id LEFT JOIN

          (

            SELECT 

              ConsultationSub.chief_complaint_id,

              COUNT(*) as count

            FROM 

              consultation_subs as ConsultationSub LEFT JOIN 

              consultations as Consultation ON ConsultationSub.consultation_id = Consultation.id

            WHERE 

              Consultation.visible = true $date AND

              Consultation.status = 1 AND

              Consultation.employee_id IS NOT NULL AND 

              ConsultationSub.visible = true 

          ) AS EmployeeTreated ON EmployeeTreated.chief_complaint_id = IllnessRecommendation.id LEFT JOIN

          (

            SELECT 

              ConsultationSub.chief_complaint_id,

              COUNT(*) as count

            FROM 

              consultation_subs as ConsultationSub LEFT JOIN 

              consultations as Consultation ON ConsultationSub.consultation_id = Consultation.id

            WHERE 

              Consultation.visible = true $date AND

              Consultation.status = 2 AND

              Consultation.student_id IS NOT NULL AND 

              ConsultationSub.visible = true 

          ) AS StudentRerred ON StudentRerred.chief_complaint_id = IllnessRecommendation.id LEFT JOIN

          (

            SELECT 

              ConsultationSub.chief_complaint_id,

              COUNT(*) as count

            FROM 

              consultation_subs as ConsultationSub LEFT JOIN 

              consultations as Consultation ON ConsultationSub.consultation_id = Consultation.id

            WHERE 

              Consultation.visible = true $date AND

              Consultation.status = 2 AND

              Consultation.employee_id IS NOT NULL AND 

              ConsultationSub.visible = true 

          ) AS EmployeeRerred ON EmployeeRerred.chief_complaint_id = IllnessRecommendation.id

        WHERE

          IllnessRecommendation.visible = true AND 

          (

            IllnessRecommendation.ailment LIKE '%$search%'

          )

      ) as Report ";

        $query = $this->getConnection()->execute($sql)->fetch('assoc');

        return $query['total'];

    }

    public function getAllMedicalPropertyEquipment($conditions, $limit, $page)
    {

        $search = strtolower(@$conditions['search']);

        $date = @$conditions['date'];

        $offset = ($page - 1) * $limit;

        // Your SQL query here, make sure to adjust table names and columns
        $sql =  " SELECT * FROM (

        SELECT

          PropertyLog.*

        FROM

          property_logs as PropertyLog

        WHERE

          PropertyLog.visible = true $date AND

          (

            PropertyLog.property_name LIKE '%$search%' OR 

            PropertyLog.type LIKE '%$search%' 

          )

        GROUP BY

          PropertyLog.id

        ORDER BY

          PropertyLog.property_name ASC

      ) as Report ";

        $query = $this->getConnection()->prepare($sql);

        $query->execute();

        return $query;
    }

    public function countAllMedicalPropertyEquipment($conditions = []): string
    {

        $search = strtolower(@$conditions['search']);

        $date = @$conditions['date'];
        
        $sql = "SELECT count(*) as count FROM (

        SELECT

          PropertyLog.id

        FROM

          property_logs as PropertyLog

        WHERE

          PropertyLog.visible = true $date AND

          (

            PropertyLog.property_name LIKE '%$search%' OR 

            PropertyLog.type LIKE '%$search%' 

        )

      ) as Report ";

        $query = $this->getConnection()->execute($sql)->fetch('assoc');

        return $query['count'];

    }

    public function getAllMedicalMonthlyConsumption($conditions, $limit, $page)
    {

        $search = strtolower(@$conditions['search']);

        $date = @$conditions['date'];

        $offset = ($page - 1) * $limit;

        // Your SQL query here, make sure to adjust table names and columns
        $sql =  " SELECT * FROM (

        SELECT

          PropertyLog.*

        FROM 

          property_logs as PropertyLog 

        WHERE

          PropertyLog.visible = true AND 

          (

            PropertyLog.property_name LIKE '%$search%'

          )

        GROUP BY

          PropertyLog.id

        ORDER BY 

          PropertyLog.property_name

      ) as Report ";

        $query = $this->getConnection()->prepare($sql);

        $query->execute();

        return $query;
    }

    public function countAllMedicalMonthlyConsumption($conditions = []): string
    {

        $search = strtolower(@$conditions['search']);

        $date = @$conditions['date'];
        
        $sql = "SELECT count(*) as count FROM (

        SELECT

          PropertyLog.id

        FROM 

          property_logs as PropertyLog 

        WHERE

          PropertyLog.visible = true AND 

          (

            PropertyLog.property_name LIKE '%$search%'

          )

      ) as Report ";

        $query = $this->getConnection()->execute($sql)->fetch('assoc');

        return $query['count'];

    }




  public function paginate($query, array $options = []){

    $extra = isset($options['extra']) ? $options['extra'] : [];

    $conditions = isset($extra['conditions']) ? $extra['conditions'] : [];

    $page = $options['page'];

    $limit = $options['limit'];


    if($extra['type'] == 'faculty-masterlist'){

      $result = $this->getAllFacultyMasterlist($conditions, $limit, $page)->fetchAll('assoc');

      $paginateCount = $this->countAllFacultyMasterlist($conditions);

    }else if($extra['type'] == 'medical-monthly-accomplishment'){

      $result = $this->getAllMedicalMonthlyAccomplishment($conditions, $limit, $page)->fetchAll('assoc');

      $paginateCount = $this->countAllMedicalMonthlyAccomplishment($conditions);

    }else if($extra['type'] == 'medical-property-equipment'){

      $result = $this->getAllMedicalPropertyEquipment($conditions, $limit, $page)->fetchAll('assoc');

      $paginateCount = $this->countAllMedicalPropertyEquipment($conditions);

    }else if($extra['type'] == 'medical-monthly-consumption'){

      $result = $this->getAllMedicalMonthlyConsumption($conditions, $limit, $page)->fetchAll('assoc');

      $paginateCount = $this->countAllMedicalMonthlyConsumption($conditions);

    }else if($extra['type'] == 'enrollment-profile'){

      $result = $this->getAllEnrollmentProfile($conditions, $limit, $page)->fetchAll('assoc');

      $paginateCount = $this->countAllEnrollmentProfile($conditions);

    }else if($extra['type'] == 'enrollment-list'){

      $result = $this->getAllEnrollmentList($conditions, $limit, $page)->fetchAll('assoc');

      $paginateCount = $this->countAllEnrollmentList($conditions);

    }else if($extra['type'] == 'academic-failures-list'){

      $result = $this->getAllFailedStudent($conditions, $limit, $page)->fetchAll('assoc');

      $paginateCount = $this->countAllFailedStudent($conditions);

    }else if($extra['type'] == 'student-behavior'){

      $result = $this->getAllStudentBehavior($conditions, $limit, $page)->fetchAll('assoc');

      $paginateCount = $this->countAllStudentBehavior($conditions);

    }else if($extra['type'] == 'list-applicant'){

      $result = $this->getAllListApplicant($conditions, $limit, $page)->fetchAll('assoc');

      $paginateCount = $this->countAllListApplicant($conditions);

    }else if($extra['type'] == 'check-out'){

      $result = $this->getAllCheckout($conditions, $limit, $page)->fetchAll('assoc');

      $paginateCount = $this->countAllCheckout($conditions);

    }



    $paginator = [

      'page' => $page,

      'limit' => $limit,

      'count' => $paginateCount,

      'perPage' => $limit,

      'pageCount' => ceil($paginateCount / $limit),

    ];

    return [

      'data' => $result,

      'pagination' => $paginator,

    ];

  }

  // public function paginateCount($conditions = null){ 

  //   $search = @$conditions['search'];

  //   $date = @$conditions['date'];

  //   $sql = "

  //     SELECT

  //       count(*) as count

      
  //     FROM

  //       referral_slips as ReferralSlip LEFT JOIN

  //       college_programs as CollegeProgram ON ReferralSlip.course_id = CollegeProgram.id LEFT JOIN

  //       students as Student ON ReferralSlip.student_id = Student.id


  //     WHERE

  //       ReferralSlip.visible = true $date AND

  //       (
 

  //         ReferralSlip.code              LIKE  '%$search%' OR

  //         ReferralSlip.remarks             LIKE  '%$search%' OR

  //         ReferralSlip.reason              LIKE  '%$search%' OR

  //         ReferralSlip.student_name             LIKE  '%$search%' 


  //       )

  //   ";

  //   $query = $this->getConnection()->execute($sql)->fetch('assoc');

  //   return $query['count'];

  // }


}
