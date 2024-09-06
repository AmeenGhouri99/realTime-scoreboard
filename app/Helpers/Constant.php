<?php

namespace App\Helpers;

class Constant
{
    const APPROVED = 1;
    const NOT_APPROVED = 0;
    const USER_ROLE_ID = 0;
    const ADMIN_ROLE_ID = 1;
    const PASSWORD_QUESTION_ID = 3;
    const LEGAL_DOCUMENTS = 'LEGAL DOCUMENTS';
    const FINANCIAL_INFORMATION = 'FINANCIAL INFORMATION';
    const TRUSTEE_ON_TRUST_QUESTION_ID = 84;
    const PERSONAL_PHONE_NO_QUESTION_ID = 5;
    const USER_SIGNUP_PERSONAL_QUESTIONS = [1, 2, 3];
    const USER_SIGNUP_EMERGENCY_QUESTION = [6];
    const MEDICINES_QUESTION_ID = [25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50];
    const EMERGENCY_CONTACT_QUESTION_ID = [1, 2, 6, 70];
    const ALLERGIES_QUESTION_ID = [75, 76, 77, 78, 79];
    const LIFE_STYLE_AND_HABITS_QUESTION_ID = [14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24];
    const PATIENT_MEDICAL_HISTORY_QUESTION_ID = [58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74];
    const REPRODUCTIVE_AND_SEXUAL_HEALTH_QUESTION_ID = [51, 52, 53, 54, 55, 56, 57];
    const INFECTIOUS_DISEASE_QUESTION_ID = [80, 81, 82];
    const FAMILY_MEDICAL_HISTORY_QUESTION_ID = [83, 84, 85, 86, 87, 88];
    const REVIEW_OF_SYSTEM_PAST_ISSUES_QUESTION_ID = [89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99];
    const REVIEW_OF_SYSTEM_POTENTIAL_ISSUES_QUESTION_ID = [100, 101, 102, 103, 104, 105, 106];
    const ADVANCE_HEALTH_DIRECTIVES_QUESTION_ID = [107, 108, 109, 110];
    const DOB_QUESTION_ID = 2;
    const BLOOD_QUESTION_ID = 44;
    const EMERGENCY_CONTACT_DETAIL_QUESTION_ID = 6;
    const FULL_NAME_QUESTION_ID = 1;
    const FINANCIAL_CONTACT_QUESTION_ID = "NOT DEFINED YET";
    const DOC_TYPE_POA = 'POWER OF ATTORNEY';
    const DOC_TYPE_TRUST = 'TRUST';
    const DOC_TYPE_LIVING_WILL = 'LIVING WILL';
    const DOC_TYPE_HEALTH_CARE_DIRECTIVES = 'HEALTH CARE DIRECTIVES';
    const DOC_TYPE_LIFE_INSURANCE = 'LIFE INSURANCE';
    const DOC_TYPE_BANK_ACCOUNT = 'BANK ACCOUNT';

    const TYPE_FINANCIAL = 'FINANCIAL INFORMATION';
    const TYPE_LEGAL = 'LEGAL DOCUMENTS';
    const PERSONAL_DETAIL_QUESTION_IDS = [1, 2, 44];
    const LIFESTYLE_AND_HABITS_SECTION_ID = 2;
    const ALLERGIES_SECTION_ID = 6;
    const INFECTIOUS_DISEASE_SECTION_ID = 7;
    const APPOINTMENT_TYPE_MEDICAL = "medical";
    const APPOINTMENT_TYPE_DOCTOR = "doctor";
}
