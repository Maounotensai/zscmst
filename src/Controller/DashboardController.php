<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\StudentLogsTable;
use App\Model\Table\ConsultationsTable;
use App\Model\Table\PrescriptionsTable;
use App\Model\Table\DentalsTable;
use App\Model\Table\MedicalCertififcatesTable;
use App\Model\Table\ReferralRecommendationsTable;
use App\Model\Table\PropertyLogsTable;
use App\Model\Table\IllnessRecommendationsTable;
use App\Model\Table\ReferralSlipsTable;
use App\Model\Table\CounselingAppointmentsTable;
use App\Model\Table\AttendanceCounselingsTable;
use App\Model\Table\AffidavitsTable;
use App\Model\Table\PromissoryNotesTable;
use App\Model\Table\GoodMoralsTable;
use App\Model\Table\GcoEvaluationsTable;
use App\Model\Table\CalendarActivitiesTable;
use App\Model\Table\CounselingTypesTable;
use App\Model\Table\CounselingIntakesTable;
use App\Model\Table\ParticipantEvaluationActivitiesTable;
use App\Model\Table\StudentExitsTable;

class DashboardController extends AppController {

  public function initialize(): void {

    parent::initialize();
   
    $this->loadModel("StudentLogs");

    $this->loadModel("Consultations");

    $this->loadModel("Prescriptions");

    $this->loadModel("Dentals");

    $this->loadModel("MedicalCertificates");

    $this->loadModel("ReferralRecommendations");

    $this->loadModel("PropertyLogs");

    $this->loadModel("IllnessRecommendations");

    $this->loadModel("ReferralSlips");

    $this->loadModel("CounselingAppointments");

    $this->loadModel("AttendanceCounselings");

    $this->loadModel("Affidavits");

    $this->loadModel("PromissoryNotes");

    $this->loadModel("GoodMorals");

    $this->loadModel("GcoEvaluations");

    $this->loadModel("CalendarActivities");

    $this->loadModel("CounselingTypes");

    $this->loadModel("CounselingIntakes");

    $this->loadModel("ParticipantEvaluationActivities");

    $this->loadModel("StudentExits");

  }

  // public $components = array("Global");

  // public $layout = null;

  public function index(){

    $user = $this->Auth->user();

    if($user["roleId"] == 1){ //ADMIN DASHBOARD

      $student_logs_count = $this->StudentLogs->find()->where([

        "visible" => 1

      ])->count();

      $consultaions_count = $this->Consultations->find()->where([

        "visible" => 1

      ])->count();

      $prescriptions_count = $this->Prescriptions->find()->where([

        "visible" => 1

      ])->count();

      $dentals_count = $this->Dentals->find()->where([

        "visible" => 1

      ])->count();

      $medical_certificate_request_count = $this->MedicalCertificates->find()->where([

        "visible" => 1

      ])->count();

      $referral_recommendation_count = $this->ReferralRecommendations->find()->where([

        "visible" => 1

      ])->count();

      $property_log_count = $this->PropertyLogs->find()->where([

        "visible" => 1

      ])->count();

      $illness_recommendation_count = $this->IllnessRecommendations->find()->where([

        "visible" => 1

      ])->count();

      $referral_slip_count = $this->ReferralSlips->find()->where([

        "visible" => 1

      ])->count();

      $counseling_apppointment_pending_count = $this->CounselingAppointments->find()->where([

        "visible" => 1,

        "approve" => 0,

      ])->count();

      $counseling_apppointment_approved_count = $this->CounselingAppointments->find()->where([

        "visible" => 1,

        "approve" => 1,

      ])->count();

      $counseling_apppointment_confirmed_count = $this->CounselingAppointments->find()->where([

        "visible" => 1,

        "approve" => 4,

      ])->count();

      $counseling_apppointment_disapproved_count = $this->CounselingAppointments->find()->where([

        "visible" => 1,

        "approve" => 2,

      ])->count();

      $counseling_apppointment_cancelled_count = $this->CounselingAppointments->find()->where([

        "visible" => 1,

        "approve" => 3,

      ])->count();

      $counseling_apppointment_total_count = $this->CounselingAppointments->find()->where([

        "visible" => 1,

      ])->count();

      $attendance_counseling_count = $this->AttendanceCounselings->find()->where([

        "visible" => 1,

      ])->count();

      $affidavit_count = $this->Affidavits->find()->where([

        "visible" => 1,

      ])->count();

      $promissory_note_count = $this->PromissoryNotes->find()->where([

        "visible" => 1,

      ])->count();

      $good_moral_count = $this->GoodMorals->find()->where([

        "visible" => 1,

      ])->count();

      $gco_evaluation_count = $this->GcoEvaluations->find()->where([

        "visible" => 1,

      ])->count();

      $calendar_activity_count = $this->CalendarActivities->find()->where([

        "visible" => 1,

      ])->count();

      $counseling_type_count = $this->CounselingTypes->find()->where([

        "visible" => 1,

      ])->count();

      $counseling_intake_count = $this->CounselingIntakes->find()->where([

        "visible" => 1,

      ])->count();

      $participant_evaluation_activity_count = $this->ParticipantEvaluationActivities->find()->where([

        "visible" => 1,

      ])->count();

      $student_exit_count = $this->StudentExits->find()->where([

        "visible" => 1,

      ])->count();

      $datas = array(

        "student_logs_count" => $student_logs_count,

        "consultaions_count" => $consultaions_count,

        "prescriptions_count" => $prescriptions_count,

        "dentals_count" => $dentals_count,

        "medical_certificate_request_count" => $medical_certificate_request_count,

        "referral_recommendation_count" => $referral_recommendation_count,

        "property_log_count" => $property_log_count,

        "illness_recommendation_count" => $illness_recommendation_count,

        "referral_slip_count" => $referral_slip_count,

        "counseling_apppointment_pending_count" => $counseling_apppointment_pending_count,

        "counseling_apppointment_approved_count" => $counseling_apppointment_approved_count,

        "counseling_apppointment_confirmed_count" => $counseling_apppointment_confirmed_count,

        "counseling_apppointment_disapproved_count" => $counseling_apppointment_disapproved_count,

        "counseling_apppointment_cancelled_count" => $counseling_apppointment_cancelled_count,

        "counseling_apppointment_total_count" => $counseling_apppointment_total_count,

        "counseling_apppointment_pending_percentage" => ($counseling_apppointment_pending_count / $counseling_apppointment_total_count) * 100,

        "counseling_apppointment_approved_percentage" => ($counseling_apppointment_approved_count / $counseling_apppointment_total_count) * 100,

        "counseling_apppointment_confirmed_percentage" => ($counseling_apppointment_confirmed_count / $counseling_apppointment_total_count) * 100,

        "counseling_apppointment_disapproved_percentage" => ($counseling_apppointment_disapproved_count / $counseling_apppointment_total_count) * 100,

        "counseling_apppointment_cancelled_percentage" => ($counseling_apppointment_cancelled_count / $counseling_apppointment_total_count) * 100,

        "attendance_counseling_count" => $attendance_counseling_count,

        "affidavit_count" => $affidavit_count,

        "promissory_note_count" => $promissory_note_count,

        "good_moral_count" => $good_moral_count,

        "gco_evaluation_count" => $gco_evaluation_count,

        "calendar_activity_count" => $calendar_activity_count,

        "counseling_type_count" => $counseling_type_count,

        "counseling_intake_count" => $counseling_intake_count,

        "participant_evaluation_activity_count" => $participant_evaluation_activity_count,

        "student_exit_count" => $student_exit_count,

      );

      $this->set(compact("datas"));

    }

  }

}

