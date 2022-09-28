var serviceProviderId;
var hospitalId;
var patientId;
var agentId;
var treatment_plan_id;
var patient_global_id;
var arr = [];
var counte = [];
var colors = [];

var HIDDEN_URL = {
    HOME: '/home'
}

function getPatientId(){
    try {
        $('#dataTableBuilder tbody').on('click', 'td .create-registered-customer-reservation', function(){
            var selectedPatientId = this.id;
            var patientName = $(this).attr("data-name");
            $(".close").trigger("click");
            $(this).text("Selected");
            $(this).addClass("btn-danger");
            $("#next-step").trigger("click");
            $(".patientName").html('<i class="fa fa-user text-primary mr-2"></i>' + patientName);
            patient_global_id = selectedPatientId;
        });
    }
    catch(error){
        console.log(error);
    }
}

function patientStep(){
    try {
        $('#savePatient').on('click', function(){
            var leadSourceId = $("#createPatient").find('#leadSourceId').children("option:selected").val();
            var name = $("#createPatient").find('#name').val();
            var phone = $("#createPatient").find('#phone').val();
            var age = $("#createPatient").find('#age').val();
            var note = $("#createPatient").find('#note').val();

            if (name == "" || leadSourceId == "" || phone == "" || age == ""){
                swal({ icon: 'error', title: 'Please fill in all fields!', text: '' });
            }
            else {
                $("#next-step").trigger("click");
                $(".close").trigger("click");
                $(".patientName").text(name);
            }
        });
    }
    catch (error) {
        console.log(error);
    }
}

function treatmentPlanStep(){
    try {
        var frmInfo = $('#frmInfo');
        var frmInfoValidator = frmInfo.validate();

        var frmLogin = $('#frmLogin');
        var frmLoginValidator = frmLogin.validate();

        var frmMobile = $('#frmMobile');
        var frmMobileValidator = frmMobile.validate();

        $('#demo').steps({
            onChange: function (currentIndex, newIndex, stepDirection) {
                console.log('onChange', currentIndex, newIndex, stepDirection);
                // tab1
                if (currentIndex === 3) {
                    if (stepDirection === 'forward') {
                        var valid = frmLogin.valid();
                        return valid;
                    }
                    if (stepDirection === 'backward') {
                        frmLoginValidator.resetForm();
                    }
                }

                // tab2
                if (currentIndex === 1) {
                    if (stepDirection === 'forward') {
                        var valid = frmInfo.valid();
                        return valid;
                    }
                    if (stepDirection === 'backward') {
                        frmInfoValidator.resetForm();
                    }
                }

                // tab3
                if (currentIndex === 4) {
                    if (stepDirection === 'forward') {
                        var valid = frmMobile.valid();
                        return valid;
                    }
                    if (stepDirection === 'backward') {
                        frmMobileValidator.resetForm();
                    }
                }

                return true;
            },
            onFinish: function () {
                alert('Wizard Completed');
            }
        });

    }
    catch (error) {
        console.log(error);
    }
}

function dashboard() {
    try {
        setTimeout(() => {
            new Chart(document.getElementById("pie-chart"), {
                type: 'pie',
                data: {
                    labels: arr,
                    datasets: [{
                        label: "Population (millions)",
                        backgroundColor: colors,
                        data: counte
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: ''
                    }
                }
            });
        }, 1000);

    }
    catch (error) {
        console.log(error);
    }
}

function treatmentPlanPdf() {
    try {
        var elem = document.getElementById('root');
        let date_ob = new Date();
        let date = ("0" + date_ob.getDate()).slice(-2);
        let month = ("0" + (date_ob.getMonth() + 1)).slice(-2);
        let year = date_ob.getFullYear();
        var now_date = (date + "." + month + "." + year);
        var patient_name = $("#patient-name-pdf").text();

        let roomType = $("#roomType").children("option:selected").val();
        if (roomType == "") {
            swal({
                icon: 'error',
                title: 'Please fill in the blanks',
                text: ''
            });
        }
        else {
            html2pdf().from(elem).set({
                margin: 0,
                filename: patient_name+' Treatment Plan.pdf',
                html2canvas: {
                    scale: 2,
                    y: -2
                },
                jsPDF: {
                    orientation: 'portrait',
                    unit: 'in',
                    format: 'A4',
                    compressPDF: true
                }
            }).save();
        }
    } catch (error) {
        console.info(error);
    } finally {}
}

var dataTable;
var select2Init = function() {

    $("#filterTreatment").select2({ placeholder: "Select a Treatment", dropdownAutoWidth: true, allowClear: true });

    //bariatrics
    $("#treatmentId").select2({ placeholder: 'Select an Treatment', dropdownAutoWidth: true, allowClear: true });
    $("#salesPersonId").select2({ placeholder: "Select an Sales Person", dropdownAutoWidth: true, allowClear: true });
    $("#doctorId").select2({ placeholder: "Select an Doctor", dropdownAutoWidth: true, allowClear: true });
    $("#durationOfStay").select2({ placeholder: 'Select an Duration of Stay', dropdownAutoWidth: true, allowClear: true });
    $("#hospitalization").select2({ placeholder: 'Select an Hospitalization', dropdownAutoWidth: true, allowClear: true });
    $("#priceCurrency").select2({ placeholder: 'Select Price Currency', dropdownAutoWidth: true, allowClear: true });
    $("#weightUnit").select2({ placeholder: 'Select an Weight Unit', dropdownAutoWidth: true, allowClear: true });
    $("#heightUnit").select2({ placeholder: 'Select an Height Unit', dropdownAutoWidth: true, allowClear: true });
    //bariatrics

    $("#treatmentPlanStatus").select2({ placeholder: 'Select an option', dropdownAutoWidth: true, allowClear: true });
    $("#treatmentPlanStatusId").select2({ placeholder: 'Select an Treatment Plan Status', dropdownAutoWidth: true, allowClear: true });
    $("#medicalDepartmentId").select2({ placeholder: 'Select an Medical Department', dropdownAutoWidth: true, allowClear: true });
    $("#treatmentId").select2({ placeholder: 'Select an Treatment', dropdownAutoWidth: true, allowClear: true });
    $("#recommendedTreatmentId").select2({ placeholder: 'Önerilen Tedaviyi Seçiniz', dropdownAutoWidth: true, allowClear: true });
    $("#leadSourceId").select2({ placeholder: 'Select an Lead Source', dropdownAutoWidth: true, allowClear: true });
    $("#countryData").select2({ placeholder: 'Select Country', dropdownAutoWidth: true, allowClear: true });
    $("#countryId").select2({ placeholder: 'Select Country', dropdownAutoWidth: true, allowClear: true });
    $("#patientCountry").select2({ placeholder: 'Select Country', dropdownAutoWidth: true, allowClear: true });
};

var dataTableInit = function() {
    dataTable = $('#dataTable').dataTable({
        "columnDefs": [{
                "targets": 1,
                "type": 'num',
            },
            {
                "targets": 2,
                "type": 'num',
            }
        ],
    });
};

var dtSearchInit = function() {

    $('#filterLeadSource').on("change", function(){
        dtSearchAction($(this), 7)
    });
};

dtSearchAction = function(selector, columnId) {
    var fv = selector.val();
    if ((fv == '') || (fv == null)) {
        dataTable.api().column(columnId).search('', true, false).draw();
    } else {
        dataTable.api().column(columnId).search(fv, true, false).draw();
    }
};

var app = (function() {

    if ([HIDDEN_URL.HOME].includes(window.location.pathname)) {
        dashboard();
    }

    $(document).ready(function() {
        select2Init();
        dataTableInit();
        dtSearchInit();

        $.ajax({
            url: '/definitions/reportApi',
            type: 'get',
            dataType: 'json',
            success: function (response) {
                if (response) {
                    $.each(response, function (key, value) {
                        arr.push(value.name);
                        counte.push(value.aCount);
                        colors.push('#'+Math.floor(Math.random()*16777215).toString(16));
                    });
                }
            },

            error: function () { },
        });

        $('[data-toggle="popover"]').ggpopover();

        $('.navbar-nav li a').on('click', function () {
            $(this).parent().toggleClass('active');
        });

        $('.img-gal').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });

        $("#preloader-active").hide(1000);
        $("#mainnav .child-nav > a").on('click', function () {
            $(this).toggleClass("active");
            $(".submenu").toggleClass("in");
            return false;
        });

        $(".cancel-warning").on("click", function(){
            swal({ icon: 'warning', title: 'Warning!', text: 'Please Contact Sales Manager to Cancel!' });
        });

        var pageurl = window.location.href;
        $(".nav-item_sub li a").each(function(){
            if ($(this).attr("href") == pageurl || $(this).attr("href") == '')
            $(this).addClass("active");
        });

        $(".nav-item_sub li a").each(function(){
            if ($(this).attr("href") == pageurl || $(this).attr("href") == '')
            $(this).parents(':eq(2)').addClass("active");
        });

        $('.input-container input').on('change', function() {
            if ($(this).val() == 'yes') {
                var nameInput = $(this).attr("name");
                var inputElement = '<div class="font-weight-700 mt-2 form-note"><label class="form-note-label" for='+nameInput+' >Note</label><textarea class="form-control" name='+nameInput+' placeholder="Enter Note" rows="3" cols="50"></textarea></div>';
                $(this).closest('.input-container').append(inputElement).hide().slideDown(800);
                // $(this).removeAttr("name");
            }
            else {
                $(this).closest('.input-container').find('.form-note').hide('slow', function(){ $(this).remove(); });
            }
        });
    });

    //edit page
    $("#uploadFile").on("click", function () {
        setTimeout(() => {
            // location.reload();
            swal({ icon: 'success', title: 'Success!', text: 'Patient Photos Added Successfully!', timer: 1000 });
        }, 1000);
    });

    $.ajax({
        url: '/getCurrencies',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response) {
                $.each(response, function(key, value) {
                    $("#currenciesSection").append("<span class='currencyText'>" + value[0] + "</span>");
                });
            }
        },
        error: function() {
            console.log();
        },
    });

    editTreatmentPlan();
    postTreatmentPlanOperation();
    changeTreatmentPlanDateOperation();
    treatmentPlanStep();
    treatmentPlanRequestStep();
    patientStep();
    getPatientId();
    completeTreatmentPlan();

    //api's
});

var Layout = (function() {

    function pinSidenav() {
        $('.sidenav-toggler').addClass('active');
        $('.sidenav-toggler').data('action', 'sidenav-unpin');
        $('body').removeClass('g-sidenav-hidden').addClass('g-sidenav-show g-sidenav-pinned');
        $('body').append('<div class="backdrop d-xl-none" data-action="sidenav-unpin" data-target=' + $('#sidenav-main').data('target') + ' />');
        Cookies.set('sidenav-state', 'pinned');
    }

    function unpinSidenav() {
        $('.sidenav-toggler').removeClass('active');
        $('.sidenav-toggler').data('action', 'sidenav-pin');
        $('body').removeClass('g-sidenav-pinned').addClass('g-sidenav-hidden');
        $('body').find('.backdrop').remove();
        Cookies.set('sidenav-state', 'unpinned');
    }

    var $sidenavState = Cookies.get('sidenav-state') ? Cookies.get('sidenav-state') : 'pinned';

    if ($(window).width() > 1200) {
        if ($sidenavState == 'pinned') {
            pinSidenav()
        }

        if (Cookies.get('sidenav-state') == 'unpinned') {
            unpinSidenav()
        }

        $(window).resize(function() {
            if ($('body').hasClass('g-sidenav-show') && !$('body').hasClass('g-sidenav-pinned')) {
                $('body').removeClass('g-sidenav-show').addClass('g-sidenav-hidden');
            }
        });
    }

    $(document).ready(function(){
        $("#tableCompleted").dataTable({ paging: true, pageLength: 25 });
        $("#tableData").dataTable({ paging: true, pageLength: 25 });
        $("#tablePatients").dataTable({ paging: true, pageLength: 15 });
        $("#tableReconsult").dataTable({ paging: true, pageLength: 25 });
    });

    if ($(window).width() < 1200) {
        $('body').removeClass('g-sidenav-hide').addClass('g-sidenav-hidden');
        $('body').removeClass('g-sidenav-show');
        $(window).resize(function() {
            if ($('body').hasClass('g-sidenav-show') && !$('body').hasClass('g-sidenav-pinned')) {
                $('body').removeClass('g-sidenav-show').addClass('g-sidenav-hidden');
            }
        });
    }

    $("body").on("click", "[data-action]", function(e) {

        e.preventDefault();

        var $this = $(this);
        var action = $this.data('action');
        var target = $this.data('target');

        switch (action) {
            case 'sidenav-pin':
                pinSidenav();
                break;

            case 'sidenav-unpin':
                unpinSidenav();
                break;

            case 'search-show':
                target = $this.data('target');
                $('body').removeClass('g-navbar-search-show').addClass('g-navbar-search-showing');

                setTimeout(function() {
                    $('body').removeClass('g-navbar-search-showing').addClass('g-navbar-search-show');
                }, 150);

                setTimeout(function() {
                    $('body').addClass('g-navbar-search-shown');
                }, 300)
                break;

            case 'search-close':
                target = $this.data('target');
                $('body').removeClass('g-navbar-search-shown');

                setTimeout(function() {
                    $('body').removeClass('g-navbar-search-show').addClass('g-navbar-search-hiding');
                }, 150);

                setTimeout(function() {
                    $('body').removeClass('g-navbar-search-hiding').addClass('g-navbar-search-hidden');
                }, 300);

                setTimeout(function() {
                    $('body').removeClass('g-navbar-search-hidden');
                }, 500);
                break;
        }
    });

    $('.sidenav').on('mouseenter', function() {
        if (!$('body').hasClass('g-sidenav-pinned')) {
            $('body').removeClass('g-sidenav-hide').removeClass('g-sidenav-hidden').addClass('g-sidenav-show');
        }
    });

    $('.sidenav').on('mouseleave', function() {
        if (!$('body').hasClass('g-sidenav-pinned')) {
            $('body').removeClass('g-sidenav-show').addClass('g-sidenav-hide');

            setTimeout(function() {
                $('body').removeClass('g-sidenav-hide').addClass('g-sidenav-hidden');
            }, 300);
        }
    });

    var userFormat = "YYYY-MM-DD";

    $('#arrivalDate').daterangepicker({
        "autoApply": true,
        "singleDatePicker": true,
        "showDropdowns": true,
        "autoUpdateInput": true,
        locale: {
            firstDay: 1,
            format: userFormat
        },
        minDate: moment().add(1, 'days'),
        maxDate: moment().add(359, 'days'),
    });

    $('#operationDate').daterangepicker({
        "autoApply": true,
        "singleDatePicker": true,
        "showDropdowns": true,
        "autoUpdateInput": true,
        locale: {
            firstDay: 1,
            format: userFormat
        },
        minDate: moment().add(1, 'days'),
        maxDate: moment().add(359, 'days'),
    });

    $('#departureDate').daterangepicker({
        "autoApply": true,
        "singleDatePicker": true,
        "showDropdowns": true,
        "autoUpdateInput": true,
        locale: {
            firstDay: 1,
            format: userFormat
        },
        minDate: moment().add(1, 'days'),
        maxDate: moment().add(359, 'days'),
    });

    $('[data-toggle="popover"]').ggpopover();

    $(window).on('load resize', function() {
        if ($('body').height() < 800) {
            $('body').css('min-height', '100vh');
            $('#footer-main').addClass('footer-auto-bottom')
        }
    });
})();

function previousPage() {
    history.go(-1);
}

function deleteTableRow(id) {
    try {
        $('table#treatmentsTable tr#' + id).remove();
        $('#treatmentsTable').trigger('rowAddOrRemove');
    }
    catch(error){
        console.log(error);
    }
    finally { }
}

function editTreatmentPlan(){

    $("#item1").val($('[data-attr="item-1"]').text());
    $("#item1").on("input", function(){
        $('[data-attr="item-1"]').text($(this).val());
    });

    $("#item2").val($('[data-attr="item-2"]').text());
    $("#item2").on("input", function(){
        $('[data-attr="item-2"]').text($(this).val());
    });

    $("#item3").val($('[data-attr="item-3"]').text());
    $("#item3").on("input", function(){
        $('[data-attr="item-3"]').text($(this).val());
    });

    $("#item4").val($('[data-attr="item-4"]').text());
    $("#item4").on("input", function(){
        $('[data-attr="item-4"]').text($(this).val());
    });

    $("#item5").val($('[data-attr="item-5"]').text());
    $("#item5").on("input", function(){
        $('[data-attr="item-5"]').text($(this).val());
    });

    $("#item6").val($('[data-attr="item-6"]').text());
    $("#item6").on("input", function(){
        $('[data-attr="item-6"]').text($(this).val());
    });

    $("#item7").val($('[data-attr="item-7"]').text());
    $("#item7").on("input", function(){
        $('[data-attr="item-7"]').text($(this).val());
    });

    $("#item8").val($('[data-attr="item-8"]').text());
    $("#item8").on("input", function(){
        $('[data-attr="item-8"]').text($(this).val());
    });

    $("#item9").val($('[data-attr="item-9"]').text());
    $("#item9").on("input", function(){
        $('[data-attr="item-9"]').text($(this).val());
    });

    $("#item10").val($('[data-attr="item-10"]').text());
    $("#item10").on("input", function(){
        $('[data-attr="item-10"]').text($(this).val());
    });
}

function changeTreatmentPlanDates(treatmentPlanId, arrivalDate, departureDate, operationDate){
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/changeTreatmentPlanDates/' + treatmentPlanId + '',
            type: 'POST',
            data: {
                'arrival_date': arrivalDate,
                'departure_date': departureDate,
                'operation_date': operationDate
            },
            async: false,
            dataType: 'json',
            success: function (response) {
                if(response){
                    swal({ icon: 'success', title: 'Ticket Updated Successfully!', text: '', timer: 2000 });
                    // location.reload();
                }
            },

            error: function () { },
        });
    } catch (error) {
        console.log(error);
    } finally { }
}
//patient operation end

//treatment plans
function treatmentPlanRequestStep(){
    try {
        $('#saveTreatmentPlanBtn').on('click', function () {
            var mainStep = $("#tab2");
            var treatmentName = mainStep.find('#treatmentId').children("option:selected").val(),
                salesPerson = mainStep.find('#salesPersonId').children("option:selected").val(),
                duration_of_stay = mainStep.find('#durationOfStay').children("option:selected").val(),
                hospitalization = mainStep.find('#hospitalization').children("option:selected").val();

            if (treatmentName == "" || salesPerson == "" || duration_of_stay == "" || hospitalization == "") {
                swal({ icon: 'error', title: 'Please fill in all fields!', text: '' });
            }
            else {
                $("#next-step").trigger("click");
            }
        });

        $("#saveOtherTreatmentPlanBtn").on("click", function () {
            var mainStep = $("#tab3");
            var is_asthma = mainStep.find('input[name="is_asthma"]:checked').val(),
                is_diabetes = mainStep.find('input[name="is_diabetes"]:checked').val(),
                is_hyper_tension = mainStep.find('input[name="is_hyper_tension"]:checked').val(),
                is_breathing_problem = mainStep.find('input[name="is_breathing_problem"]:checked').val(),
                is_chronic_illness = mainStep.find('input[name="is_chronic_illness"]:checked').val(),
                is_hiv = mainStep.find('input[name="is_hiv"]:checked').val(),
                is_stroke = mainStep.find('input[name="is_stroke"]:checked').val(),
                is_hepatitis = mainStep.find('input[name="is_hepatitis"]:checked').val(),
                is_cancer = mainStep.find('input[name="is_cancer"]:checked').val(),
                is_sickle = mainStep.find('input[name="is_sickle"]:checked').val(),
                is_anaemia = mainStep.find('input[name="is_anaemia"]:checked').val(),
                is_kidney_problem = mainStep.find('input[name="is_kidney_problem"]:checked').val(),
                is_smoking = mainStep.find('input[name="is_smoking"]:checked').val(),
                is_alcohol = mainStep.find('input[name="is_alcohol"]:checked').val(),
                is_allergie = mainStep.find('input[name="is_allergie"]:checked').val(),
                is_surgery_history = mainStep.find('input[name="is_surgery_history"]:checked').val(),
                is_covid_vaccine = mainStep.find('input[name="is_covid_vaccine"]:checked').val();

                if(is_asthma == undefined || is_diabetes == undefined || is_hyper_tension == undefined || is_breathing_problem == undefined || is_chronic_illness == undefined || is_hiv == undefined || is_stroke == undefined || is_hepatitis == undefined || is_cancer == undefined || is_sickle == undefined || is_anaemia == undefined || is_kidney_problem == undefined || is_smoking == undefined || is_alcohol == undefined || is_allergie == undefined || is_surgery_history == undefined || is_covid_vaccine == undefined){
                    swal({ icon: 'error', title: 'Please fill in all fields!', text: '' });
                }

                else {
                    $("#next-step").trigger("click");

                    var leadSourceId = $("#createPatient").find('#leadSourceId').children("option:selected").val(),
                    name = $("#createPatient").find('#name').val(),
                    phone = $("#createPatient").find('#phone').val(),
                    email = $("#createPatient").find('#email').val(),
                    countryId = $("#createPatient").find('#countryId').children("option:selected").val(),
                    age = $("#createPatient").find('#age').val(),
                    gender = $("#createPatient").find('[name="gender"]:checked').val(),
                    note = $("#createPatient").find('#note').val();
                    setTimeout(() => {
                        addPatient(leadSourceId, name, phone, email, countryId, age, gender, note);
                    }, 500);
                }
        });
    } catch (error) {
        console.log(error);
    }
}

function changeTreatmentPlanDateOperation(){
    try {
        $(".received-btn").on("click", function(){
            var tpId = this.id;
            $("#ticketReceived").find("#treatmentPlanId").val(tpId);
        });

        $("#updateTicket").on("click", function () {
            var treatmentPlanId = $("#ticketReceived").find("#treatmentPlanId").val(),
            arrivalDate = $("#ticketReceived").find("#arrivalDate").val();
            departureDate = $("#ticketReceived").find("#departureDate").val();
            operationDate = $("#ticketReceived").find("#operationDate").val();
            if(arrivalDate == ""){
                swal({ icon: 'error', title: 'Please fill in arrival date!', text: '' });
            }
            changeTreatmentPlanDates(treatmentPlanId, arrivalDate, departureDate, operationDate);
        });
    } catch (error) {
        console.log(error);
    }
}

function postTreatmentPlanOperation(){
    try {

        $("#treatmentPlanStatusId").on("change", function(){
            var selectedId = $(this).children("option:selected").val();
            if(selectedId == 3){
                $(".suitableSection").hide(300);
                $(".recommendedTreatmentSection").hide(300);
            }
            else {
                $(".suitableSection").show(300);
                $(".recommendedTreatmentSection").show(300);
            }
        });

        $("#postTreatmentPlanBtn").on("click", function(){
            var treatmentPlanId = $("#postModal").find(".treatment_plan_id").val();
            var treatmentPlanStatusId = $("#postModal").find("#treatmentPlanStatusId").children("option:selected").val();
            var doctorExplanation = $("#postModal").find("#doctorExplanation").val();
            var recommendedTreatmentId = $("#postModal").find("#recommendedTreatmentId").children("option:selected").val();
            var isSuitable = $("#postModal").find('input[name="is_suitable"]:checked').val();
            setTimeout(() => {
                postTreatmentPlan(treatmentPlanId, treatmentPlanStatusId, doctorExplanation, recommendedTreatmentId, isSuitable);
            }, 100);
        });
    }
    catch (error) { }
}

function postTreatmentPlan(treatmentPlanId, treatmentPlanStatusId, doctorExplanation, recommendedTreatmentId, isSuitable){
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/treatmentplans/post/' + treatmentPlanId +'',
            type: 'POST',
            data: {
                'tratment_plan_status_id': treatmentPlanStatusId,
                'doctor_explanation': doctorExplanation,
                'recommended_treatment_id': recommendedTreatmentId,
                'is_suitable': isSuitable
            },
            async: false,
            dataType: 'json',
            success: function (response) {
                if (response) {
                    swal({ icon: 'success', title: 'Başarılı!', text: 'Tedavi Planı Başarıyla Cevaplandı!' });
                    setTimeout(() => {
                        window.location.href = "/home";
                    }, 1000);
                }
            },

            error: function () { },
        });
    }
    catch (error) {
        console.log(error);
    }
    finally { }
}

//patient operation
function addPatient(leadSourceId, name, phone, email, countryId, age, gender, note){
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/patients/store',
            type: 'POST',
            data: {
                'leadSourceId': leadSourceId,
                'name': name,
                'phone': phone,
                'email': email,
                'countryId': countryId,
                'age': age,
                'gender': gender,
                'note': note
            },
            async: false,
            dataType: 'json',
            success: function (response) {
                if (response) {
                    patient_global_id = response;
                }
            },

            error: function () { },
        });
    }
    catch (error) {
        console.log(error);
    }
    finally { }
}

function completeTreatmentPlan(){
    try {
        $("#completeTreatmentPlan").on("click", function(){
            if (patient_global_id != undefined){
                setTimeout(() => {
                    //treatment plan
                    var mainStep = $("#tab2");
                    var stepMedicalHistory = $("#tab3");
                    var treatment_id = mainStep.find('#treatmentId').children("option:selected").val(),
                        doctor_id = mainStep.find('#doctorId').children("option:selected").val(),
                        sales_person_id = mainStep.find('#salesPersonId').children("option:selected").val(),
                        duration_of_stay = mainStep.find('#durationOfStay').children("option:selected").val(),
                        hospitalization = mainStep.find('#hospitalization').children("option:selected").val(),
                        total_price = mainStep.find('#total_price').val(),
                        price_currency = mainStep.find('#priceCurrency').children("option:selected").val(),

                        weight = stepMedicalHistory.find('#weight').val(),
                        weight_unit = stepMedicalHistory.find('#weightUnit').val(),
                        height = stepMedicalHistory.find('#height').val(),
                        height_unit = stepMedicalHistory.find('#heightUnit').val(),
                        is_asthma = stepMedicalHistory.find('input[name="is_asthma"]:checked').val(),
                        is_diabetes = stepMedicalHistory.find('input[name="is_diabetes"]:checked').val(),
                        is_hyper_tension = stepMedicalHistory.find('input[name="is_hyper_tension"]:checked').val(),
                        is_breathing_problem = stepMedicalHistory.find('input[name="is_breathing_problem"]:checked').val(),
                        is_chronic_illness = stepMedicalHistory.find('input[name="is_chronic_illness"]:checked').val(),
                        is_hiv = stepMedicalHistory.find('input[name="is_hiv"]:checked').val(),
                        is_stroke = stepMedicalHistory.find('input[name="is_stroke"]:checked').val(),
                        is_hepatitis = stepMedicalHistory.find('input[name="is_hepatitis"]:checked').val(),
                        is_cancer = stepMedicalHistory.find('input[name="is_cancer"]:checked').val(),
                        is_sickle = stepMedicalHistory.find('input[name="is_sickle"]:checked').val(),
                        is_anaemia = stepMedicalHistory.find('input[name="is_anaemia"]:checked').val(),
                        is_kidney_problem = stepMedicalHistory.find('input[name="is_kidney_problem"]:checked').val(),
                        is_smoking = stepMedicalHistory.find('input[name="is_smoking"]:checked').val(),
                        is_alcohol = stepMedicalHistory.find('input[name="is_alcohol"]:checked').val(),
                        is_allergie = stepMedicalHistory.find('input[name="is_allergie"]:checked').val(),
                        is_surgery_history = stepMedicalHistory.find('input[name="is_surgery_history"]:checked').val(),
                        is_covid_vaccine = stepMedicalHistory.find('input[name="is_covid_vaccine"]:checked').val(),
                        note = stepMedicalHistory.find('#note').val();

                        addTreatmentPlan(patient_global_id, treatment_id, doctor_id, sales_person_id, duration_of_stay, hospitalization, total_price, price_currency, weight, weight_unit, height, height_unit, is_asthma, is_diabetes, is_hyper_tension, is_breathing_problem, is_chronic_illness, is_hiv, is_stroke, is_hepatitis, is_cancer, is_sickle, is_anaemia, is_kidney_problem, is_smoking, is_alcohol, is_allergie, is_surgery_history, is_covid_vaccine, is_stroke, note);

                        $("#dropzone").find("#tpId").val(treatment_plan_id);
                        setTimeout(() => {
                            $("#uploadFile").trigger("click");
                        }, 100);
                }, 500);
            }
        });
    }
    catch(error){ }
}

//send treatment plan
function addTreatmentPlan(patient_global_id, treatment_id, doctor_id, sales_person_id, duration_of_stay, hospitalization, total_price, price_currency, weight, weight_unit, height, height_unit, is_asthma, is_diabetes, is_hyper_tension, is_breathing_problem, is_chronic_illness, is_hiv, is_stroke, is_hepatitis, is_cancer, is_sickle, is_anaemia, is_kidney_problem, is_smoking, is_alcohol, is_allergie, is_surgery_history, is_covid_vaccine, is_stroke, note){
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/treatmentplans/store',
            type: 'POST',
            data: {
                'patient_id': patient_global_id,
                'treatment_id': treatment_id,
                'doctor_id': doctor_id,
                'sales_person_id': sales_person_id,
                'duration_of_stay': duration_of_stay,
                'hospitalization': hospitalization,
                'total_price': total_price,
                'price_currency': price_currency,
                'weight': weight,
                'weight_unit': weight_unit,
                'height': height,
                'height_unit': height_unit,
                'is_asthma': is_asthma,
                'is_diabetes': is_diabetes,
                'is_hyper_tension': is_hyper_tension,
                'is_breathing_problem': is_breathing_problem,
                'is_chronic_illness': is_chronic_illness,
                'is_hiv': is_hiv,
                'is_stroke': is_stroke,
                'is_hepatitis': is_hepatitis,
                'is_cancer': is_cancer,
                'is_sickle': is_sickle,
                'is_anaemia': is_anaemia,
                'is_kidney_problem': is_kidney_problem,
                'is_smoking': is_smoking,
                'is_alcohol': is_alcohol,
                'note': note
            },
            async: false,
            dataType: 'json',
            success: function (response) {
                if (response) {
                    swal({ icon: 'success', title: 'Success', text: 'Treatment Plan Added Successfully!', timer: 1000 });
                    treatment_plan_id = response;
                    // setTimeout(() => {
                    //     location.reload();
                    // }, 2000);
                }
            },

            error: function () { },
        });
    } catch (error) {
        console.log(error);
    } finally { }
}
