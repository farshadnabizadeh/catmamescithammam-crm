var api_version = "1.0.0";
var args = [
    '%c %c %c Arpanu Medical REST-TR v' + api_version + ' %c %c %c ',
    'background: #0cf300',
    'background: #00bc17',
    'color: #ffffff; background: #00711f;',
    'background: #00bc17',
    'background: #0cf300',
    'background: #00bc17'
];
console.log.apply(console, args);

function getMedicalDepartments(){
    try {
        $.ajax({
            url: '/getMedicalDepartment',
            type: 'get',
            dataType: 'json',
            success: function (response) {
                if (response) {
                    $.each(response, function (key, value) {
                        $("#mDepartment").append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            },

            error: function () {
                console.log(DEFINITIONS.LOG_SUCCESS);
            },
        });
    } catch (error) {
        console.info(error);
    } finally { }
}

function getSubDepartments(medicalDepartment, e){
    try {
        var selectedMedicalDepartment = medicalDepartment.value;

        $.ajax({
            url: '/getMedicalSubDepartment/' + selectedMedicalDepartment,
            type: 'get',
            dataType: 'json',
            success: function (response) {
                if (response) {
                    $(e).empty();
                    $(e).append('<option selected="true" disabled="disabled">Select a Medical Sub Department</option>');
                    $.each(response, function (key, value) {
                        $(e).append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            },

            error: function () {
                console.log(DEFINITIONS.LOG_SUCCESS);
            },
        });
    } catch (error) {
        console.info(error);
    } finally { }
}
