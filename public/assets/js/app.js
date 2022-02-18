var reservationID;

var HIDDEN_URL = {
    RESERVATION: '/definitions/reservations',
    THERAPIST: '/definitions/therapists',
    SERVICES: '/definitions/services',
    SOURCES: '/definitions/sources',
    USER: '/definitions/users',
    HOME: '/home',
    FORM: '/definitions/forms'
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

function timeFormat(timeInput) {
    try {
        validTime = timeInput.value;
        if (validTime < 24 && validTime.length == 2) {
            timeInput.value = timeInput.value + ":";
            return false;
        }
        if (validTime == 24 && validTime.length == 2) {
            timeInput.value = timeInput.value.length - 2 + "0:";
            return false;
        }
        if (validTime > 24 && validTime.length == 2) {
            timeInput.value = "";
            return false;
        }
        if (validTime.length == 5 && validTime.slice(-2) < 60) {
            timeInput.value = timeInput.value + "";
            return false;
        }
        if (validTime.length == 5 && validTime.slice(-2) > 60) {
            timeInput.value = timeInput.value.slice(0, 2) + "";
            return false;
        }
        if (validTime.length == 5 && validTime.slice(-2) == 60) {
            timeInput.value = timeInput.value.slice(0, 2) + ":00";
            return false;
        }
    } catch (error) {
        console.info(error);
    } finally {
    }
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
    $(document).ready(function() {
        select2Init();
        dataTableInit();
        dtSearchInit();
    });

    getServiceDetail();
    getDiscountDetail();
    clockPicker();
    addCustomertoReservationModal();
    addReservationOperation();
    addcustomerReservation();

    $("#colorpicker").spectrum();
    $("#departmentId").select2({ placeholder: "Select Medical Department", dropdownAutoWidth: true, allowClear: true });
    $("#serviceCurrency").select2({ placeholder: "Select Currency", dropdownAutoWidth: true, allowClear: true });
    $("#customerSobId").select2({ placeholder: "Select Source Of Booking", dropdownAutoWidth: true, allowClear: true });
    $("#serviceId").select2({ placeholder: "Select Service", dropdownAutoWidth: true, allowClear: true });
    $("#therapistId").select2({ placeholder: "Select Therapist", dropdownAutoWidth: true, allowClear: true });
    $("#customerId").select2({ placeholder: "Select Customer", dropdownAutoWidth: true, allowClear: true });
    $("#discountId").select2({ placeholder: "Select Discount", dropdownAutoWidth: true, allowClear: true });

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

    if (![HIDDEN_URL.RESERVATION, HIDDEN_URL.HOME, HIDDEN_URL.THERAPIST, HIDDEN_URL.SERVICES, HIDDEN_URL.SOURCES, HIDDEN_URL.USER, HIDDEN_URL.FORM].includes(window.location.pathname)) {
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

        $("#tableCompleted").dataTable({ paging: true, pageLength: 25 });
        $("#tableData").dataTable({ paging: true, pageLength: 25 });

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
            autoclose: true,
            dateFormat: 'yy-mm-dd'
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
        $('table#customerTableReservation tr#' + id).remove();
        $('#customerTableReservation').trigger('rowAddOrRemove');
    }
    catch(error){
        console.log(error);
    }
    finally { }
}

function clockPicker(){
    try {
        $('#arrivalTime').clockpicker({ autoclose: true, donetext: 'Done', placement: 'left', align: 'top' });
    }
    catch(error){
        console.log(error);
    }
    finally { }
}

function getServiceDetail() {
    try {
        $("#serviceId").on("change", function () {
            var selectedId = $(this).children("option:selected").val();
            $.ajax({
                url: '/getService/' + selectedId,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    if (response) {
                        $.each(response, function (key, value) {
                            var data = value;
                            if (data == null) {
                                swal({ icon: 'info', title: 'This patient does not have an arrival reservation!', text: '' });
                            }
                            else if (!data.isNull) {
                                let serviceCost = data.service_cost;
                                let serviceCurrency = data.service_currency;
                                $("#serviceCost").val(serviceCost);
                                $("#serviceCurrency > option").each(function () {
                                    if (this.value == serviceCurrency) $(this).attr("selected", true); $(this).trigger("change");
                                });
                            }
                        });
                    }
                },

                error: function () { },
            });
        });
    }
    catch (error) {
        console.log(error);
    }
    finally { }
}

function getDiscountDetail() {
    try {
        $("#discountId").on("change", function () {
            var serviceCost = $("#serviceCost").val();
            var selectedId = $(this).children("option:selected").val();
            $.ajax({
                url: '/getDiscount/' + selectedId,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    if (response) {
                        $.each(response, function (key, value) {
                            var data = value;
                            if (data == null) {
                                swal({ icon: 'info', title: 'Percentage not defined!', text: '' });
                            }
                            else if(serviceCost == ""){
                                swal({ icon: 'error', title: 'Please enter the price of the service!', text: '' });
                            }
                            else if (!data.isNull) {
                                let discountPercentage = data.discount_percentage;
                                var result = (serviceCost / 100) * discountPercentage;
                                result = serviceCost - result;
                                result = result.toFixed(2);
                                console.log(result);
                                $("#serviceCost").val(result);
                                swal({ icon: 'success', title: 'Discount applied successfully!', text: '' });
                            }
                        });
                    }
                },

                error: function () { },
            });
        });
    }
    catch (error) {
        console.log(error);
    }
    finally { }
}

function addCustomertoReservationModal() {
    try {
        $('#addCustomertoReservationSave').on('click', function(){
            var customerId = $('#customerId').children("option:selected").val();
            var customerName = $('#customerId').children("option:selected").text();
            if (customerId == ""){
                swal({ icon: 'error', title: 'Please fill in all fields!', text: '' });
            }
            else {
                var rowId = customerId;
                var markup = "<tr class='reservation' id='" + customerId + "'>" +
                    "<td id=" + customerId + ">" + customerName + "</td>" +
                    "<td><button onclick='deleteTableRow(" + rowId + ")' class='btn btn-danger delete-btn float-right'><i class='fa fa-window-close'></i> Remove</button></td>" +
                "</tr>";

                $('#customerTableReservation tbody').append(markup);
                $('#customerTableReservation').trigger('rowAddOrRemove');
                $('.add-reservation-close').trigger('click');
            }
        });
    } catch (error) {
        console.log(error);
    }
}

function addReservationOperation() {
    try {
        var serviceId, pPrice, sPrice, note;
        $('#reservationSave').on('click', function(){
            var arrivalDate = $('#arrivalDate').val();
            var arrivalTime = $('#arrivalTime').val();
            var totalCustomer = $('#totalCustomer').val();
            var serviceId = $('#serviceId').children("option:selected").val();
            var serviceCurrency = $('#serviceCurrency').children("option:selected").val();
            var serviceCost = $('#serviceCost').val();
            var serviceComission = $('#serviceComission').val();
            var therapistId = $('#therapistId').children("option:selected").val();
            if (arrivalDate == "" || arrivalTime == ""){
                swal({ icon: 'error', title: 'Please fill in all fields!', text: '' });
            }
            else {
                $("#customerTableReservation").find("tr").each(function (i) {
                    var $tds = $(this).find('td'),
                        customersId = $tds.eq(0).attr("id");
                    setTimeout(() => {
                        addCustomertoReservation(reservationID, customersId);
                    }, 100);
                });
                addReservation(arrivalDate, arrivalTime, totalCustomer, serviceId, serviceCurrency, serviceCost, serviceComission, therapistId);
            }
        });
    } catch (error) {
        console.log(error);
    }
}

function addReservation(arrivalDate, arrivalTime, totalCustomer, serviceId, serviceCurrency, serviceCost, serviceComission, therapistId){
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/definitions/reservations/store',
            type: 'POST',
            data: {
                'arrivalDate': arrivalDate,
                'arrivalTime': arrivalTime,
                'totalCustomer': totalCustomer,
                'serviceId': serviceId,
                'serviceCurrency': serviceCurrency,
                'serviceCost': serviceCost,
                'serviceComission': serviceComission,
                'therapistId': therapistId
            },
            async: false,
            dataType: 'json',
            success: function (response) {
                if (response) {
                    swal({ icon: 'success', title: 'Success!', text: 'Reservation Added Successfully!', timer: 1000 });
                    reservationID = response;
                }
            },

            error: function () { },
        });
    } catch (error) {
        console.log(error);
    }
}

function addcustomerReservation() {
    try {
        $('#saveCustomerReservation').on('click', function () {
            var reservationID = $('#reservation_id').val();
            var customersId = $("#addCustomer").find('#customerId').children("option:selected").val();
            setTimeout(() => {
                addCustomertoReservation(reservationID, customersId);
            }, 200);
        });
    } catch (error) {
        console.log(error);
    }
}

function addCustomertoReservation(reservationID, customersId){
    try {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/definitions/reservations/addCustomertoReservation',
            type: 'POST',
            data: { 'reservation_id': reservationID, 'customer_id': customersId },
            async: false,
            dataType: 'json',
            success: function (response) {
                if (response) {
                    swal({ icon: 'success', title: 'Customer Added Successfully!', text: '', timer: 1000 });
                    location.reload();
                }
            },

            error: function () { },
        });
    } catch (error) {
        console.log(error);
    }
}