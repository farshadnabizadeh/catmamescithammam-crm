var HIDDEN_URL = {
    TEST: '/definitions/test'
}
function changeTreatmentPlanForm() {
    try {
        $("#bariatricPdf").on("click", function() {
            console.log("eee!");
        });
    } catch (error) {
        console.log(error);
    } finally {}
}

function dashboard() {
    new Chart(document.getElementById("pie-chart"), {
        type: 'pie',
        data: {
            labels: ["Doctors", "Sales", "Patients", "Treatments"],
            datasets: [{
                label: "Population (millions)",
                backgroundColor: ["#11cdef", "#8e5ea2", "#11cdef", "#11cdef"],
                data: [2478, 5267, 734, 784]
            }]
        },
        options: {
            title: {
                display: true,
                text: ''
            }
        }
    });
}

function voucherPdf() {
    try {
        var elem = document.getElementById('root');
        let date_ob = new Date();
        let date = ("0" + date_ob.getDate()).slice(-2);
        let month = ("0" + (date_ob.getMonth() + 1)).slice(-2);
        let year = date_ob.getFullYear();
        var now_date = (date + "." + month + "." + year);

        let roomType = $("#roomType").children("option:selected").val();
        if (roomType == "") {
            swal({
                icon: 'error',
                title: 'Please fill in the blanks',
                text: ''
            });
        } else {
            html2pdf().from(elem).set({
                margin: 0,
                filename: 'treatmentplan-' + now_date + '.pdf',
                html2canvas: {
                    scale: 2,
                    y: -2
                },
                jsPDF: {
                    orientation: 'portrait',
                    unit: 'in',
                    format: 'letter',
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
    $('#filterMedicalDepartment').select2({
        dropdownAutoWidth: true,
        allowClear: true,
        placeholder: "Select a Medical Department",
    });
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

    $('#filterMedicalDepartment').change(function() {
        dtSearchAction($(this), 2)
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

    /* $('#searchname').autocomplete({
        source: 'search/autocomplete',
        minlength:1,
        autoFocus:true,
        select:function(e,ui)
        {
            $('#searchname').val(ui.item.value);
            console.log(ui.item.value);
        }
    }); */

    var lightboxVideo = GLightbox({
        selector: '.glightbox'
    });

    $(document).ready(function() {
        select2Init();
        dataTableInit();
        dtSearchInit();
    });

    $("#leadSourceId").on("change", function() {
        let selectedSource = $(this).children("option:selected").val();
        if (selectedSource == 2) {
            $(".general").text("Agency");
            $("#general").attr("name", "agentId");
            $.ajax({
                url: '/getAgents',
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response) {
                        $("#general").empty();
                        $.each(response, function(key, value) {
                            $("#general").append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                },
                error: function() {
                    console.log(DEFINITIONS.LOG_SUCCESS);
                },
            });
        } else if (selectedSource == 4) {
            $(".general").text("Sales Agent");
            $("#general").attr("name", "sales_person_id");
            $.ajax({
                url: '/getsalesAgent',
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response) {
                        $("#general").empty();
                        $.each(response, function(key, value) {
                            $("#general").append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                },
                error: function() {
                    console.log(DEFINITIONS.LOG_SUCCESS);
                },
            });
        }
    });


    $("#colorpicker").spectrum();
    $("#departmentId").select2({ placeholder: "Select Medical Department", dropdownAutoWidth: true, allowClear: true });
    $("#serviceCurrency").select2({ placeholder: "Select Currency", dropdownAutoWidth: true, allowClear: true });
    $("#customerSobId").select2({ placeholder: "Select Source Of Booking", dropdownAutoWidth: true, allowClear: true });
    $("#serviceId").select2({ placeholder: "Select Service", dropdownAutoWidth: true, allowClear: true });
    $("#therapistId").select2({ placeholder: "Select Therapist", dropdownAutoWidth: true, allowClear: true });

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

    if (![HIDDEN_URL.SERVICES, HIDDEN_URL.TREATMENT_PLANS, HIDDEN_URL.TREATMENT_PLAN_CREATE, HIDDEN_URL.TEST].includes(window.location.pathname)) {
        var input_get = document.querySelector("#phone_get");
        var country_get = document.querySelector("#country_get");
        var countryData_get = window.intlTelInputGlobals.getCountryData();
        var iti_get = window.intlTelInput(input_get, {
            autoHideDialCode: false,
            autoPlaceholder: "on",
            geoIpLookup: function(callback) {
                $.get("https://api.ipgeolocation.io/ipgeo?apiKey=6fe879f09f9a4d0e9178277171ba6e46&fields=geo", function() {}, "json").always(function(resp) {
                    var countryCode = (resp && resp.country_code2) ? resp.country_code2 : "";
                    callback(countryCode);
                });
            },
            initialCountry: "auto",
            nationalMode: false,
            preferredCountries: ['tr', 'gb', 'fr', 'sa', 'us', 'de', 'se', 'be', 'kw', 'ae', 'qa', 'nl'],
            separateDialCode: false,
            utilsScript: "https://sales.arpanumedical.com/assets/js/utils.js",
        });

        if (![HIDDEN_URL.HOSPITALS].includes(window.location.pathname)) {
            input_get.addEventListener('countrychange', function(e) {
                var countryname_get = iti_get.getSelectedCountryData().name;
                country_get.value = countryname_get.replace(/.+\((.+)\)/, "$1");
            });
        }
    }

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

    $(document).ready(function() {

        $("#tableCompleted").dataTable({
            paging: true,
            pageLength: 25
        });
        $("#tableData").dataTable({
            paging: true,
            pageLength: 25
        });

        $('label.tree-toggler').click(function() {
            $(this).parent().children('ul.tree').toggle(300);
        });

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

    $("#post-treatment").on("click", function() {
        $("#post-treatment-card").toggle(500);
    });

    $("#testing").on("click", function() {
        var age = $("#patientBirthDate").val();
        var height = document.getElementById("height");
        var weight = document.getElementById("weight");
        var male = document.getElementById("male");
        var female = document.getElementById("female");

        var p = [age.value, height.value, weight.value];
        if (male.checked) {
            var bmi = Number(p[2]) / (Number(p[1]) / 100 * Number(p[1]) / 100);

            var today = new Date();
            var dayDiff = Math.ceil(today - age) / (1000 * 60 * 60 * 24 * 365);
            var newAge = parseInt(dayDiff);
            console.log(newAge + ' years old');
        } else if (female.checked) {
            var bmi = Number(p[2]) / (Number(p[1]) / 100 * Number(p[1]) / 100);
            console.log(bmi);
        }
    });

    $(window).on('load resize', function() {
        if ($('body').height() < 800) {
            $('body').css('min-height', '100vh');
            $('#footer-main').addClass('footer-auto-bottom')
        }
    });
})();

var CopyIcon = (function() {
    var $element = '.btn-icon-clipboard',
        $btn = $($element);

    function init($this) {
        $this.tooltip().on('mouseleave', function() {
            $this.tooltip('hide');
        });

        var clipboard = new ClipboardJS($element);

        clipboard.on('success', function(e) {
            $(e.trigger)
                .attr('title', 'Copied!')
                .tooltip('_fixTitle')
                .tooltip('show')
                .attr('title', 'Copy to clipboard')
                .tooltip('_fixTitle')

            e.clearSelection()
        });
    }

    if ($btn.length) {
        init($btn);
    }

})();

var Navbar = (function() {

    var $nav = $('.navbar-nav, .navbar-nav .nav');
    var $collapse = $('.navbar .collapse');
    var $dropdown = $('.navbar .dropdown');

    function accordion($this) {
        $this.closest($nav).find($collapse).not($this).collapse('hide');
    }

    function closeDropdown($this) {
        var $dropdownMenu = $this.find('.dropdown-menu');

        $dropdownMenu.addClass('close');

        setTimeout(function() {
            $dropdownMenu.removeClass('close');
        }, 200);
    }

    $collapse.on({
        'show.bs.collapse': function() {
            accordion($(this));
        }
    })

    $dropdown.on({
        'hide.bs.dropdown': function() {
            closeDropdown($(this));
        }
    })

})();

var NavbarCollapse = (function() {

    var $nav = $('.navbar-nav'),
        $collapse = $('.navbar .navbar-custom-collapse');

    function hideNavbarCollapse($this) {
        $this.addClass('collapsing-out');
    }

    function hiddenNavbarCollapse($this) {
        $this.removeClass('collapsing-out');
    }

    if ($collapse.length) {
        $collapse.on({
            'hide.bs.collapse': function() {
                hideNavbarCollapse($collapse);
            }
        })

        $collapse.on({
            'hidden.bs.collapse': function() {
                hiddenNavbarCollapse($collapse);
            }
        })
    }

    var navbar_menu_visible = 0;

    $(".sidenav-toggler").click(function() {
        if (navbar_menu_visible == 1) {
            $('body').removeClass('nav-open');
            navbar_menu_visible = 0;
            $('.bodyClick').remove();

        } else {

            var div = '<div class="bodyClick"></div>';
            $(div).appendTo('body').click(function() {
                $('body').removeClass('nav-open');
                navbar_menu_visible = 0;
                $('.bodyClick').remove();

            });

            $('body').addClass('nav-open');
            navbar_menu_visible = 1;
        }
    });
})();

var FormControl = (function() {

    var $input = $('.form-control');

    function init($this) {
        $this.on('focus blur', function(e) {
            $(this).parents('.form-group').toggleClass('focused', (e.type === 'focus'));
        }).trigger('blur');
    }

    if ($input.length) {
        init($input);
    }

})();

var Datepicker = (function() {
    var $datepicker = $('.datepicker');

    function init($this) {
        var options = {
            disableTouchKeyboard: true,
            autoclose: false
        };
        $this.datepicker(options);
    }
    if ($datepicker.length) {
        $datepicker.each(function() {
            init($(this));
        });
    }
})();

function previousPage() {
    history.go(-1);
}

function deleteTableRow(id) {
    try {
        $('table#servicesTable tr#' + id).remove();
        $('#servicesTable').trigger('rowAddOrRemove');

        $('table#treatmentsTable tr#' + id).remove();
        $('#treatmentsTable').trigger('rowAddOrRemove');

        $('table#doctorsTable tr#' + id).remove();
        $('#doctorsTable').trigger('rowAddOrRemove');

        $('table#serviceProviderTable tr#' + id).remove();
        $('#serviceProviderTable').trigger('rowAddOrRemove');

        $('table#requestTreatmentTable tr#' + id).remove();
        $('#requestTreatmentTable').trigger('rowAddOrRemove');

        $('table#medicalHistoryTable tr#' + id).remove();
        $('#medicalHistoryTable').trigger('rowAddOrRemove');
    }
    catch(error){
        console.log(error);
    }
    finally { }
}


//patient operation
function addPatientOperation() {
    try {
        $('#savePatient').on('click', function() {
            var patientName = $('#patientName').val();
            var phone = $('#phone_get').val().length;
            var patientPhone = $('#phone_get').val();
            var patientEmail = $('#patientEmail').val();
            var patientCountry = $('#country_get').val();
            var patientBirthDate = $('#patientBirthdate').val();
            var salesPersonId = $('#salesPersonId').children("option:selected").val();
            var agentId = $('[name="agentId"]').children("option:selected").val();
            var leadSourceId = $('#leadSourceId').children("option:selected").val();
            var gender = $('input[name="gender"]:checked').val();
            var weight = $('#weight').val();
            var height = $('#height').val();
            var bmiValue = $('#bmiValue').val();
            var is_cigarette = $('input[name="is_cigarette"]:checked').val();
            var note = $('#note').val();
            if (patientName == "" || phone <= 5 || patientPhone == "") {
                swal({
                    icon: 'error',
                    title: 'Please fill in all fields!',
                    text: ''
                });
            } else {
                setTimeout(() => {
                    addPatient(patientName, patientPhone, patientEmail, patientCountry, patientBirthDate, salesPersonId, agentId, leadSourceId, gender, weight, height, bmiValue, is_cigarette, note);
                }, 1000);
                setTimeout(() => {
                    $("#medicalHistoryTable").find("tr").each(function() {
                        var $tds = $(this).find('td'),
                            medication = $tds.eq(0).text(),
                            note = $tds.eq(1).text();
                        addPatienttoMedicalHistory(medication, note);
                    });
                }, 2000);
                setTimeout(() => {
                    $("#requestTreatmentTable").find("tr").each(function() {
                        var $tds = $(this).find('td'),
                            treatment_id = $tds.eq(0).attr("id"),
                            note = $tds.eq(1).text();
                        addPatienttoRequestTreatment(treatment_id, note);
                    });
                }, 2000);
            }
        });
    } catch (error) {
        console.log(error);
    }
}

function addPatient(patientName, patientPhone, patientEmail, patientCountry, patientBirthDate, salesPersonId, agentId, leadSourceId, gender, weight, height, bmiValue, is_cigarette, note) {
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/definitions/patients/store',
            type: 'POST',
            data: {
                'patientName': patientName,
                'patientPhone': patientPhone,
                'patientEmail': patientEmail,
                'patientCountry': patientCountry,
                'patientBirthDate': patientBirthDate,
                'salesPersonId': salesPersonId,
                'agentId': agentId,
                'leadSourceId': leadSourceId,
                'gender': gender,
                'weight': weight,
                'height': height,
                'bmiValue': bmiValue,
                'is_cigarette': is_cigarette,
                'note': note
            },
            async: false,
            dataType: 'json',
            success: function(response) {
                if (response) {
                    swal({ icon: 'success', title: 'Success!', text: 'Patient Added Successfully!', timer: 1000 });
                    patient_global_id = response;
                }
            },

            error: function() {},
        });
    } catch (error) {
        console.log(error);
    } finally {}
}

function addPatienttoMedicalHistory(medication, note) {
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/definitions/patients/addPatienttoMedicalHistory',
            type: 'POST',
            data: {
                'medication': medication,
                'patient_id': patient_global_id,
                'note': note
            },
            async: false,
            dataType: 'json',
            success: function(response) {
                if (response) {
                    swal({ icon: 'success', title: 'Success!', text: 'Medical History Added Successfully!', timer: 1000 });
                    location.href = "/definitions/patients/";
                }
            },

            error: function() {},
        });
    } catch (error) {
        console.log(error);
    }
}

function addPatienttoRequestTreatment(treatment_id, note) {
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/definitions/patients/addPatienttoRequestTreatment',
            type: 'POST',
            data: {
                'treatment_id': treatment_id,
                'patient_id': patient_global_id,
                'note': note
            },
            async: false,
            dataType: 'json',
            success: function(response) {
                if (response) {
                    swal({ icon: 'success', title: 'Success!', text: 'Request Treatments Added Successfully!', timer: 1000 });
                }
            },

            error: function() {},
        });
    } catch (error) {
        console.log(error);
    }
}

function addMedicalHistoryPatient(medications, patientId, note) {
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/definitions/patients/addPatienttoMedicalHistory',
            type: 'POST',
            data: {
                'medication': medications,
                'patient_id': patientId,
                'note': note
            },
            async: false,
            dataType: 'json',
            success: function(response) {
                console.log(response);
                if (response) {
                    swal({ icon: 'success', title: 'Success!', text: 'Treatment Added Successfully!', timer: 1000 });
                }
            },

            error: function() {},
        });
    } catch (error) {
        console.log(error);
    } finally {}
}
//patient operation end

//agent operation
function addAgentOperation() {
    try {
        var treatmentId, pPrice, pCurrency, sPrice, sCurrency, note;
        $('#saveAgentBtn').on('click', function() {
            var agentName = $('#agentName').val();
            var agentCountry = $('#countryId').children("option:selected").val();
            var agentCity = $('#stateId').children("option:selected").val();
            var agentAddress = $('#agentAddress').val();
            var agentEmail = $('#agentEmail').val();
            if (agentName == "") {
                swal({ icon: 'error', title: 'Please fill in all fields!', text: '' });
            }
            else {
                $("#treatmentsTable").find("tr").each(function(i) {
                    var $tds = $(this).find('td'),
                        treatmentId = $tds.eq(0).attr("id"),
                        pPrice = $tds.eq(1).text(),
                        pCurrency = $tds.eq(2).text(),
                        sPrice = $tds.eq(3).text(),
                        sCurrency = $tds.eq(4).text(),
                        note = $tds.eq(5).text();
                    setTimeout(() => {
                        addTreatmenttoAgent(treatmentId, agentId, pPrice, pCurrency, sPrice, sCurrency, note);
                    }, 500);
                });
                setTimeout(() => {
                    addAgent(agentName, agentCountry, agentCity, agentAddress, agentEmail);
                }, 100);
            }
        });
    } catch (error) {
        console.log(error);
    }
}

function addAgent(agentName, agentCountry, agentCity, agentAddress, agentEmail) {
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/definitions/agents/store',
            type: 'POST',
            data: {
                'agentName': agentName,
                'agentCountry': agentCountry,
                'agentCity': agentCity,
                'agentAddress': agentAddress,
                'agentEmail': agentEmail
            },
            async: false,
            dataType: 'json',
            success: function(response) {
                var treatmentData = $("#treatmentSelect").children("option:selected").val();
                if (response) {
                    swal({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Agent Added Successfully!',
                        timer: 1000
                    });
                    agentId = response;
                    if (treatmentData == "") {
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                }
            },

            error: function() {},
        });
    } catch (error) {
        console.log(error);
    } finally {}
}

function addTreatmenttoAgent(treatmentId, agentId, pPrice, pCurrency, sPrice, sCurrency, note) {
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/definitions/agents/addTreatmenttoAgent',
            type: 'POST',
            data: {
                'treatment_id': treatmentId,
                'agent_id': agentId,
                'pPrice': pPrice,
                'pCurrency': pCurrency,
                'sPrice': sPrice,
                'sCurrency': sCurrency,
                'note': note
            },
            async: false,
            dataType: 'json',
            success: function(response) {
                if (response) {
                    swal({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Treatment Added Successfully!',
                        timer: 1000
                    });
                    location.reload();
                }
            },

            error: function() {},
        });
    } catch (error) {
        console.log(error);
    }
}
//agent operation end

function addTreatmenttoHospital(treatmentId, hospitalId, pPrice, pCurrency, sPrice, sCurrency, note) {
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/definitions/hospitals/addTreatmenttoHospital',
            type: 'POST',
            data: { 'treatment_id': treatmentId, 'hospital_id': hospitalId, 'pPrice': pPrice, 'pCurrency': pCurrency, 'sPrice': sPrice, 'sCurrency': sCurrency, 'note': note },
            async: false,
            dataType: 'json',
            success: function(response) {
                if (response) {
                    swal({ icon: 'success', title: 'Success!', text: 'Treatment Added Successfully!', timer: 1000 });
                    location.reload();
                }
            },

            error: function() {},
        });
    } catch (error) {
        console.log(error);
    }
}

//hospital operation
function addHospitalOperation() {
    try {
        var treatmentId, pPrice, pCurrency, sPrice, sCurrency, note;
        $('#saveHospitalBtn').on('click', function() {
            var hospitalName = $('#hospitalName').val();
            var phone = $('#phone_get').val().length;
            var hospitalPhone = $('#phone_get').val();
            var hospitalAddress = $('#hospitalAddress').val();
            var hospitalEmail = $('#hospitalEmail').val();
            var hospitalZone = $('#hospitalZone').val();
            var hospitalCity = $('#hospitalCity').val();
            var hospitalMap = $('#hospitalMap').val();
            var description = $('#description').val();
            if (hospitalName == "" || phone <= 7 || hospitalEmail == "") {
                swal({ icon: 'error', title: 'Please fill in all fields!', text: '' });
            }
            else {
                $("#treatmentsTable").find("tr").each(function(i) {
                    var $tds = $(this).find('td'),
                        treatmentId = $tds.eq(0).attr("id"),
                        pPrice = $tds.eq(1).text(),
                        pCurrency = $tds.eq(2).text(),
                        sPrice = $tds.eq(3).text(),
                        sCurrency = $tds.eq(4).text(),
                        note = $tds.eq(5).text();
                    setTimeout(() => {
                        addTreatmenttoHospital(treatmentId, hospitalId, pPrice, pCurrency, sPrice, sCurrency, note);
                    }, 100);
                });
                addHospital(hospitalName, hospitalPhone, hospitalAddress, hospitalEmail, hospitalZone, hospitalCity, hospitalMap, description);
            }
        });
    } catch (error) {
        console.log(error);
    }
}

function addHospital(hospitalName, hospitalPhone, hospitalAddress, hospitalEmail, hospitalZone, hospitalCity, hospitalMap, description) {
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/definitions/hospitals/store',
            type: 'POST',
            data: { 'hospitalName': hospitalName, 'hospitalPhone': hospitalPhone, 'hospitalAddress': hospitalAddress, 'hospitalEmail': hospitalEmail, 'hospitalZone': hospitalZone, 'hospitalCity': hospitalCity, 'hospitalMap': hospitalMap, 'description': description },
            async: false,
            dataType: 'json',
            success: function(response) {
                if (response) {
                    swal({ icon: 'success', title: 'Success!', text: 'Hospital Added Successfully!', timer: 1000 });
                    hospitalId = response;
                }
            },

            error: function() {},
        });
    }
    catch (error) {
        console.log(error);
    }
    finally { }
}

function addTreatmenttoHospital(treatmentId, hospitalId, pPrice, pCurrency, sPrice, sCurrency, note) {
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/definitions/hospitals/addTreatmenttoHospital',
            type: 'POST',
            data: { 'treatment_id': treatmentId, 'hospital_id': hospitalId, 'pPrice': pPrice, 'pCurrency': pCurrency, 'sPrice': sPrice, 'sCurrency': sCurrency, 'note': note },
            async: false,
            dataType: 'json',
            success: function(response) {
                if (response) {
                    swal({ icon: 'success', title: 'Success!', text: 'Treatment Added Successfully!', timer: 1000 });
                    location.reload();
                }
            },

            error: function() {},
        });
    } catch (error) {
        console.log(error);
    }
}
//hospital operation end

function changeStatus() {}

function addMedicalHistoryOperation() {
    try {
        $('#addMedicalHistory').on('click', function() {
            var medications = $("#newMedicalHistoryModal").find('#medications').val();
            var patientId = $("#newMedicalHistoryModal").find('.patient_id').val();
            var note = $("#newMedicalHistoryModal").find('#note').val();
            if (medications == "") {
                swal({ icon: 'error', title: 'Please fill in all fields!', text: '' });
            }
            else {
                addMedicalHistoryPatient(medications, patientId, note);
                swal({ icon: 'success', title: 'Success!', text: 'Medical History Added Successfully!', timer: 1000 });
                location.reload();
            }
        });
    } catch (error) {
        console.log(error);
    }
}

//new patient page
function createMedicalHistoryOperation() {
    try {
        $('#createMedicalHistory').on('click', function() {
            var medications = $("#newMedicalHistoryModal").find('#medications').val();
            var note = $("#newMedicalHistoryModal").find('#note').val();

            if (medications == "") {
                swal({
                    icon: 'error',
                    title: 'Please fill in all fields!',
                    text: ''
                });
            } else {
                var rowId = "1";
                var markup = "<tr class='doctor' id='" + rowId + "'>" +
                    "<td id='" + rowId + "'>" + medications + "</td>" +
                    "<td>" + note + "</td>" +
                    "<td><button onclick='deleteTableRow(" + rowId + ")' class='btn btn-danger delete-btn'><i class='fa fa-window-close'></i> Remove</button></td>" +
                    "</tr>";

                $('#medicalHistoryTable tbody').append(markup);
                $('#medicalHistoryTable').trigger('rowAddOrRemove');

                $('.close').trigger('click');
            }
        });
    } catch (error) {
        console.log(error);
    }
}

//new patient page
function createRequestTreatmentOperation() {
    try {
        $('#createRequestTreatment').on('click', function() {
            var treatmentId = $("#newRequestTreatmentModal").find('#treatmentId').children("option:selected").val();
            var treatmentText = $("#newRequestTreatmentModal").find('#treatmentId').children("option:selected").text();
            var note = $("#newRequestTreatmentModal").find('#note').val();

            if (treatmentId == "") {
                swal({
                    icon: 'error',
                    title: 'Please fill in all fields!',
                    text: ''
                });
            } else {
                var rowId = treatmentId;
                var markup = "<tr class='doctor' id='" + rowId + "'>" +
                    "<td id='" + rowId + "'>" + treatmentText + "</td>" +
                    "<td>" + note + "</td>" +
                    "<td><button onclick='deleteTableRow(" + rowId + ")' class='btn btn-danger delete-btn'><i class='fa fa-window-close'></i> Remove</button></td>" +
                    "</tr>";

                $('#requestTreatmentTable tbody').append(markup);
                $('#requestTreatmentTable').trigger('rowAddOrRemove');

                $('.close').trigger('click');
            }
        });
    } catch (error) {
        console.log(error);
    }
}

function addRequestTreatmentOperationUpdate() {
    try {
        $('#addRequestTreatment').on('click', function() {
            var patientId = $("#newRequestTreatmentModal").find('.patient_id').val();
            var treatmentId = $("#newRequestTreatmentModal").find('#treatmentId').children("option:selected").val();
            var note = $("#newRequestTreatmentModal").find('#note').val();
            if (treatmentId == "") {
                swal({ icon: 'error', title: 'Please fill in all fields!', text: '' });
            }
            else {
                addRequestTreatmentPatient(patientId, treatmentId, note);
                swal({ icon: 'success', title: 'Success!', text: 'Treatment Added Successfully!', timer: 1000 });
                location.reload();
            }
        });
    } catch (error) {
        console.log(error);
    }
}

function addRequestTreatmentPatient(patientId, treatmentId, note) {
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/definitions/requestTreatments/store',
            type: 'POST',
            data: { 'patientId': patientId, 'treatmentId': treatmentId, 'note': note },
            async: false,
            dataType: 'json',
            success: function(response) {
                console.log(response);
                if (response) {
                    swal({ icon: 'success', title: 'Success!', text: 'Treatment Added Successfully!', timer: 1000 });
                    window.location.href = "/definitions/treatmentplans/";
                }
            },

            error: function() {},
        });
    } catch (error) {
        console.log(error);
    } finally {}
}
//hospital end

//treatment plans
function addTreatmentPlanOperation() {
    try {
        var doctor_id, service_provider_id, service_id, note;
        $('#saveTreatmentPlanBtn').on('click', function() {
            var request_title = $('#request_title').val();
            var request_description = $('#request_description').val();
            var medical_department_id = $('#mDepartment').children("option:selected").val();
            var medical_sub_department_id = $('#msubDepartment').children("option:selected").val();
            var sales_person_id = $('#salesPersonId').children("option:selected").val();
            var patient_id = $('#patients').children("option:selected").val();
            var treatment_plan_status_id = $('#treatmentPlanStatusId').children("option:selected").val();
            if (request_title == "" && request_description == "" && medical_department_id == "" && medical_sub_department_id == "" && sales_person_id == "" && patient_id == "" && treatment_plan_status_id == "") {
                swal({
                    icon: 'error',
                    title: 'Please fill in all fields!',
                    text: ''
                });
            }
            else {
                addTreatmentPlan(request_title, request_description, medical_department_id, medical_sub_department_id, sales_person_id, patient_id, treatment_plan_status_id);
                $("#doctorsTable").find("tbody tr").each(function(i) {
                    var $tds = $(this).find('td'),
                        doctor_id = $tds.eq(0).attr("id");
                    setTimeout(() => {
                        addTreatmenttoTreatmentplans(treatment_plan_id, doctor_id);
                    }, 1000);
                });
                $("#serviceProviderTable").find("tbody tr").each(function(i) {
                    var $tds = $(this).find('td'),
                        service_provider_id = $tds.eq(0).attr("id"),
                        service_id = $tds.eq(1).attr("id"),
                        note = $tds.eq(2).text();
                    setTimeout(() => {
                        addServiceProvidertoTreatmentplans(treatment_plan_id, service_provider_id, service_id, note);
                    }, 1500);
                });
            }
        });
    } catch (error) {
        console.log(error);
    }
}

function addTreatmentPlan(request_title, request_description, medical_department_id, medical_sub_department_id, sales_person_id, patient_id, treatment_plan_status_id) {
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/definitions/treatmentplans/store',
            type: 'POST',
            data: { 'request_title': request_title, 'request_description': request_description, 'medical_department_id': medical_department_id, 'medical_sub_department_id': medical_sub_department_id, 'sales_person_id': sales_person_id, 'patient_id': patient_id, 'treatment_plan_status_id': treatment_plan_status_id },
            async: false,
            dataType: 'json',
            success: function(response) {
                if (response) {
                    swal({ icon: 'success', title: 'Treatment Plan Added Successfully!', text: '', timer: 1000 });
                    treatment_plan_id = response;
                }
            },

            error: function() {},
        });
    } catch (error) {
        console.log(error);
    } finally {}
}

function addTreatmenttoTreatmentplans(treatment_plan_id, doctor_id) {
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/definitions/treatmentplans/addTreatmenttoTreatmentplans',
            type: 'POST',
            data: { 'treatment_plan_id': treatment_plan_id, 'doctor_id': doctor_id },
            async: false,
            dataType: 'json',
            success: function(response) {
                if (response) {
                    swal({ icon: 'success', title: 'Request Added Successfully!', text: '', timer: 1000 });
                    location.reload();
                }
            },

            error: function() {},
        });
    } catch (error) {
        console.log(error);
    }
}

function addServiceProvidertoTreatmentplans(treatment_plan_id, service_provider_id, service_id, note) {
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/definitions/treatmentplans/addServiceProvidertoTreatmentplans',
            type: 'POST',
            data: { 'treatment_plan_id': treatment_plan_id, 'service_provider_id': service_provider_id, 'service_id': service_id, 'note': note },
            async: false,
            dataType: 'json',
            success: function(response) {
                if (response) {
                    swal({ icon: 'success', title: 'Added Successfully!', text: '', timer: 1000 });
                    location.reload();
                }
            },

            error: function() {},
        });
    } catch (error) {
        console.log(error);
    }
}

function saveServiceProvider() {
    try {
        $('#saveServiceProvider').on('click', function() {
            var serviceProviderId = $('#service_providerId').val();
            var serviceId = $('#service_id').children("option:selected").val();
            var pPrice = $('#pPrice').val();
            var pCurrency = $('#pCurrency').children("option:selected").val();
            var sPrice = $('#sPrice').val();
            var sCurrency = $('#sCurrency').children("option:selected").val();
            var note = $('#note').val();

            if (serviceProviderId == "" || pPrice == "" || sPrice == "") {
                swal({ icon: 'error', title: 'Please fill in all fields!', text: '' });
            }
            else {
                addServicetoServiceProvider(serviceProviderId, serviceId, pPrice, pCurrency, sPrice, sCurrency, note);
                swal({ icon: 'success', title: 'Treatment Added Successfully!', text: '', timer: 2000 });
            }
        });
    } catch (error) {
        console.log(error);
    }
}

//service providers
function addserviceProviderOperation() {
    try {
        var serviceId, pPrice, sPrice, note;
        $('#saveServiceProviderBtn').on('click', function() {
            var provider_name = $('#provider_name').val();
            var phone = $('#phone_get').val().length;
            var phone_get = $('#phone_get').val();
            var provider_city = $('#provider_city').val();
            var provider_address = $('#provider_address').val();
            var provider_photo = $('#provider_photo').val();
            var country_get = $('#country_get').val();
            var provider_email = $('#provider_email').val();
            if (provider_name == "" || phone_get <= 7 || phone_get == "" || provider_email == "") {
                swal({ icon: 'error', title: 'Please fill in all fields!', text: '' });
            }
            else {
                $("#servicesTable").find("tr").each(function(i) {
                    var $tds = $(this).find('td'),
                        serviceId = $tds.eq(0).attr("id"),
                        pPrice = $tds.eq(1).text(),
                        pCurrency = $tds.eq(2).text(),
                        sPrice = $tds.eq(3).text(),
                        sCurrency = $tds.eq(4).text(),
                        note = $tds.eq(5).text();
                    setTimeout(() => {
                        addServicetoServiceProvider(serviceProviderId, serviceId, pPrice, pCurrency, sPrice, sCurrency, note);
                    }, 100);
                });
                addServiceProvider(provider_name, country_get, provider_city, provider_address, provider_photo, phone_get, provider_email);
            }
        });
    } catch (error) {
        console.log(error);
    }
}

function addServiceProvider(provider_name, country_get, provider_city, provider_address, provider_photo, phone_get, provider_email) {
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/definitions/serviceProviders/store',
            type: 'POST',
            data: { 'provider_name': provider_name, 'provider_country': country_get, 'provider_city': provider_city, 'provider_address': provider_address, 'provider_photo': provider_photo, 'provider_phone': phone_get, 'provider_email': provider_email },
            async: false,
            dataType: 'json',
            success: function(response) {
                if (response) {
                    swal({ icon: 'success', title: 'Service Provider Added Successfully!', text: '', timer: 1000 });
                    serviceProviderId = response;
                }
            },

            error: function() {},
        });
    } catch (error) {
        console.log(error);
    } finally {}
}

function addServicetoServiceProvider(serviceProviderId, serviceId, pPrice, pCurrency, sPrice, sCurrency, note) {
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/definitions/serviceProviders/addServicetoServiceProvider',
            type: 'POST',
            data: { 'service_provider_id': serviceProviderId, 'serviceId': serviceId, 'pPrice': pPrice, 'pCurrency': pCurrency, 'sPrice': sPrice, 'sCurrency': sCurrency, 'note': note },
            async: false,
            dataType: 'json',
            success: function(response) {
                if (response) {
                    swal({ icon: 'success', title: 'Service Provider Added Successfully!', text: '', timer: 1000 });
                    location.reload();
                }
            },

            error: function() {},
        });
    } catch (error) {
        console.log(error);
    }
}
//service providers end
