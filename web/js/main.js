var generators = {
    department: function (e) {
        document.getElementById('appbundle_department_shortcut').value = 'gen';
        document.getElementById('appbundle_department_name').value = 'generated';
        document.getElementById('appbundle_department_telephone').value = '777777777';
    },
    doctor: function () {
        document.getElementById('appbundle_doctor_name').value = 'generatedDoctorName';
        document.getElementById('appbundle_doctor_surname').value = 'generatedDoctorSurname';
        document.getElementById('appbundle_doctor_telephone').value = '777777777';
        document.getElementById('appbundle_doctor_username').value = 'generatedDoctor';
        document.getElementById('appbundle_doctor_email').value = 'doctor@test1.com';
        document.getElementById('appbundle_doctor_plainPassword').value = 'doctor';
    },
    drug: function () {
        document.getElementById('appbundle_drug_name').value = 'Lek';
        document.getElementById('appbundle_drug_mainSubstance').value = 'superlek';
        document.getElementById('appbundle_drug_contraindication').value = 'smrt';
        document.getElementById('appbundle_drug_substanceAmount').value = '400mg';
        document.getElementById('appbundle_drug_recommendedDosage').value = '1xdenně';
    },
    employment: function () {
        document.getElementById('appbundle_employment_type').value = 'Generovane';
        document.getElementById('appbundle_employment_telephone').value = '777777777';
    },
    nurse: function () {
        document.getElementById('appbundle_nurse_name').value = 'generatedNurseName';
        document.getElementById('appbundle_nurse_surname').value = 'generatedNurseSurname';
        document.getElementById('appbundle_nurse_telephone').value = '777777777';
        document.getElementById('appbundle_nurse_username').value = 'generatedNurse';
        document.getElementById('appbundle_nurse_email').value = 'nurse@test1.com';
        document.getElementById('appbundle_nurse_plainPassword').value = 'nurse';
    },
    admin: function () {
        document.getElementById('appbundle_employee_name').value = 'generatedAdminName';
        document.getElementById('appbundle_employee_surname').value = 'generatedAdminSurname';
        document.getElementById('appbundle_employee_telephone').value = '777777777';
        document.getElementById('appbundle_employee_username').value = 'generatedAdmin';
        document.getElementById('appbundle_employee_email').value = 'admin@test1.com';
        document.getElementById('appbundle_employee_plainPassword').value = 'admin';
    },
    patient: function () {
        document.getElementById('appbundle_patient_name').value = 'generatedPatientName';
        document.getElementById('appbundle_patient_surname').value = 'generatedPatientSurname';
        document.getElementById('appbundle_patient_street').value = 'StreetXXX';
        document.getElementById('appbundle_patient_houseNumber').value = '205';
        document.getElementById('appbundle_patient_personalIdentificationNumber').value = '112233/4455';
        document.getElementById('appbundle_patient_city').value = 'City';
        document.getElementById('appbundle_patient_zip').value = '60308';
        document.getElementById('appbundle_patient_medicalIdentificationNumber').value = '112233/4455';
        document.getElementById('appbundle_patient_insuranceCompanyId').value = '147258369';
        document.getElementById('appbundle_patient_gender').value = '1';
    },
    patient: function () {
        document.getElementById('appbundle_patient_name').value = 'generatedPatientName';
        document.getElementById('appbundle_patient_surname').value = 'generatedPatientSurname';
        document.getElementById('appbundle_patient_street').value = 'StreetXXX';
        document.getElementById('appbundle_patient_houseNumber').value = '205';
        document.getElementById('appbundle_patient_personalIdentificationNumber').value = '8921896216';
        document.getElementById('appbundle_patient_city').value = 'City';
        document.getElementById('appbundle_patient_zip').value = '60308';
        document.getElementById('appbundle_patient_medicalIdentificationNumber').value = '741852963';
        document.getElementById('appbundle_patient_insuranceCompanyId').value = '147258369';
        document.getElementById('appbundle_patient_gender').value = '1';
    },
    prescription: function () {
        document.getElementById('appbundle_prescription_amount').value = '1';
        document.getElementById('appbundle_prescription_periodOfApplication').value = '6';
    }
};

var element = document.getElementById('generator');
if(element) {
    element.addEventListener('click', generators[element.getAttribute('data-js')]);
}