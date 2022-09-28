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
                        $("#bariatricRequestResult").find("#bariatricMDepartment").append('<option value="' + key + '">' + value + '</option>');
                        $("#plasticRequestResult").find("#plasticMDepartment").append('<option value="' + key + '">' + value + '</option>');
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

function getSubDepartments(){
    try {
        $("#bariatricMDepartment").on("change", function(){
            var selectedMedicalDepartment = $(this).children("option:selected").val();
            $.ajax({
                url: '/getMedicalSubDepartment/' + selectedMedicalDepartment,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    if (response) {
                        $("#bariatricMSubDepartment").empty();
                        $("#bariatricMSubDepartment").append('<option selected="true" disabled="disabled">Select a Medical Sub Department</option>');
                        $.each(response, function (key, value) {
                            $("#bariatricMSubDepartment").append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                },

                error: function () {
                    console.log(DEFINITIONS.LOG_SUCCESS);
                },
            });

            $.ajax({
                url: '/getTreatments/' + selectedMedicalDepartment,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    if (response) {
                        $("#bariatricTreatmentId").empty();
                        $("#bariatricTreatmentId").append('<option selected="true" disabled="disabled">Select a Treatment</option>');
                        $.each(response, function (key, value) {
                            $("#bariatricTreatmentId").append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                },

                error: function () {
                    console.log(DEFINITIONS.LOG_SUCCESS);
                },
            });
        });

        $("#plasticMDepartment").on("change", function () {
            var selectedMedicalDepartment = $(this).children("option:selected").val();
            $.ajax({
                url: '/getMedicalSubDepartment/' + selectedMedicalDepartment,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    if (response) {
                        $("#plasticMSubDepartment").empty();
                        $("#plasticMSubDepartment").append('<option selected="true" disabled="disabled">Select a Medical Sub Department</option>');
                        $.each(response, function (key, value) {
                            $("#plasticMSubDepartment").append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                },

                error: function () {
                    console.log(DEFINITIONS.LOG_SUCCESS);
                },
            });

            $.ajax({
                url: '/getTreatments/' + selectedMedicalDepartment,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    if (response) {
                        $("#plasticTreatmentId").empty();
                        $("#plasticTreatmentId").append('<option selected="true" disabled="disabled">Select a Treatment</option>');
                        $.each(response, function (key, value) {
                            $("#plasticTreatmentId").append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                },

                error: function () {
                    console.log(DEFINITIONS.LOG_SUCCESS);
                },
            });
        });
    }
    catch (error) {
        console.info(error);
    }
    finally { }
}

function getTreatments(medicalDepartment, e) {
    try {
        var selectedMedicalDepartment = medicalDepartment.value;

        $.ajax({
            url: '/getTreatments/' + selectedMedicalDepartment,
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
