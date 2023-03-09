@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
   <div class="row">
      <button onclick="previousPage();" class="btn btn-primary float-left mt-3"><i class="fa fa-angle-left"></i> Önceki Sayfa</button>
      <div class="col-md-12 table-responsive">
         <div class="card p-4 mt-3">
            <div class="card-title">
               <h2>Yeni Rezervasyon Oluştur</h2>
               <p class="patientName"></p>
               <hr>
            </div>
            <div id="demo">
                <div class="step-app">
                    <ul class="step-steps">
                        <li>
                            <a href="#tab1"><span class="number">1</span> Müşteri Oluştur</a>
                        </li>
                        <li>
                            <a href="#tab2"><span class="number">2</span> Rezervasyon Detayları</a>
                        </li>
                        <li>
                            <a href="#tab3"><span class="number">3</span> Rezervasyon Özeti</a>
                        </li>
                    </ul>
                    <div class="step-content">
                        <div class="step-tab-panel" id="tab1">
                            <div class="progress mt-3">
                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="25" style="width: 25%">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                    <div class="card p-3 mt-3">
                                        <button class="btn btn-primary" id="createNewPatient" data-toggle="modal" data-target="#addCustomerModal">Yeni Müşteri Oluştur <i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-6">
                                    <div class="card p-3 mt-3">
                                        <button class="btn btn-primary" id="choosePatient" data-toggle="modal" data-target="#chooseCustomerModal">Kayıtlı Müşterilerden Seç <i class="fa fa-user"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="step-tab-panel" id="tab2">
                            <div class="progress mt-3">
                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="50" style="width: 50%">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mt-3">
                                    <form method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="arrivalDate">Rezervasyon Tarihi</label>
                                                    <input type="text" class="form-control datepicker" id="arrivalDate" name="arrivalDate" placeholder="Rezervasyon Tarihi" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="arrivalTime">Rezervasyon Saati</label>
                                                    <input type="text" class="form-control" id="arrivalTime" name="arrivalTime" placeholder="Rezervasyon Saati" maxlength="5" onkeypress="timeFormat(this)" autocomplete="off" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="pickupTime">Alınış Saati</label>
                                                    <input type="text" class="form-control" id="pickupTime" name="pickupTime" placeholder="Alınış Saati" maxlength="5" onkeypress="timeFormat(this)" autocomplete="off" >
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="roomNumber">Oda Numarası</label>
                                                    <input type="text" class="form-control" id="roomNumber" name="roomNumber" placeholder="Oda Numarası" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="totalCustomer">Toplam Müşteri</label>
                                                    <input type="number" class="form-control" maxlength="2" id="totalCustomer" name="totalCustomer" placeholder="Toplam Müşteri" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="sobId">Rezervasyon Kaynağı</label>
                                                    <select id="sobId" name="sobId" class="form-control">
                                                        <option></option>
                                                        @foreach ($sources as $source)
                                                        <option value="{{ $source->id }}">{{ $source->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 hide-section">
                                                <div class="form-group">
                                                    <label class="changeName"></label>
                                                    <select id="general" class="form-control">
                                                        <option></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="note">Rezervasyon Notu</label>
                                                    <textarea class="form-control" id="note" placeholder="Rezervasyon Notu"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addService">Bakım Ekle</button>
                                                    <table class="table table-bordered mt-3" id="serviceTable">
                                                        <tr>
                                                            <th>Bakım</th>
                                                            <th>Adeti</th>
                                                            <th></th>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTherapist">Terapist Ekle</button>
                                                    <table class="table table-bordered mt-3" id="therapistTable">
                                                        <tr>
                                                            <th>Terapist</th>
                                                            <th>İş</th>
                                                            <th></th>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary float-right" id="reservationSave">İleri <i class="fa fa-arrow-right"></i></button>
                                    </form>
                                </div>
                            </div>
                            <form name="frmInfo" class="d-none" id="frmInfo">
                            <input type="text" name="txtFirstName" required>
                            <input type="text" name="txtLastName" required>
                            </form>
                        </div>

                        <div class="step-tab-panel" id="tab3">
                            <div class="progress mt-3">
                                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="mt-3">Rezervasyon Detayları: </h4>
                                    <hr>
                                    <div style="clear:both;"></div>
                                    <div class="table-responsive resultTable mt-4">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <p>Rezervasyon Tarihi: <span class="reservation-date"></span></p>
                                            </div>
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-3">
                                                <p>Rezervasyon Saati: <span class="reservation-time"></span></p>
                                            </div>
                                            <div class="col-lg-3"></div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <p>Alınış Saati: <span class="pickup-time"></span></p>
                                            </div>
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-3">
                                                <p>Oda Numarası: <span class="room-number"></span></p>
                                            </div>
                                            <div class="col-lg-3"></div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <p>Toplam Müşteri: <span class="total-customer"></span></p>
                                            </div>
                                            <div class="col-lg-3">
                                                <p ></p>
                                            </div>
                                            <div class="col-lg-3">
                                                <p>Terapist: <span class="therapist-name"></span></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <p>Hizmet: <span class="service-name"></span></p>
                                            </div>
                                            <div class="col-lg-3"></div>
                                            <div class="col-lg-3">
                                                <p>Rezervasyon Kaynağı: <span class="sob-name"></span></p>
                                            </div>
                                            <div class="col-lg-3"></div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <p>Ödeme Türü: <span class="payment-type"></span></p>
                                            </div>
                                            <div class="col-lg-3"></div>
                                        </div>
                                        <hr>
                                        <button class="btn btn-primary mt-3 float-right" id="completeReservation">Rezervasyonu Tamamla <i class="fa fa-check"></i></button>
                                    </div>
                                </div>
                            </div>
                            <form name="frmLogin" class="d-none" id="frmLogin">
                                Email address:<br>
                                <input type="text" name="txtEmail" required>
                                <br> Password:<br>
                                <input type="text" name="txtPassword" required>
                            </form>
                        </div>
                    </div>
                    <div class="step-footer">
                        <button data-direction="prev" class="step-btn"><i class="fa fa-arrow-left"></i> Geri</button>
                        <button data-direction="next" class="step-btn btn btn-primary float-right d-none" id="next-step">İleri <i class="fa fa-arrow-right"></i></button>
                        <button data-direction="next" class="step-btn btn btn-primary float-right d-none" id="saveTreatmentPlan">Kaydet ve İlerle <i class="fa fa-arrow-right"></i></button>
                        <button data-direction="finish" class="step-btn d-none">Tamamla</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
   </div>
</div>

<div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Reservation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="customerTableReservation">
                    <tr>
                        <th>Customer Name</th>
                        <th></th>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addService" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bakım Ekle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8">
                        <label for="serviceId">Bakım</label>
                        <select id="serviceId" class="form-control">
                            <option></option>
                            @foreach ($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label for="customerNumber">Kaç Kişi</label>
                        <input type="number" class="form-control" id="customerNumber">
                    </div>
                </div>
                <button type="button" class="btn btn-primary float-right mt-3" id="createService">Kaydet <i class="fa fa-check" aria-hidden="true"></i></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addTherapist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Terapist Ekle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8">
                        <label for="therapistId">Terapist</label>
                        <select id="therapistId" name="therapistId" class="form-control">
                            <option></option>
                            @foreach ($therapists as $therapist)
                            <option value="{{ $therapist->id }}">{{ $therapist->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label for="is">Kaç İş</label>
                        <input type="number" class="form-control" name="is" id="is">
                    </div>
                </div>
                <button type="button" class="btn btn-primary float-right mt-3" id="createTherapist">Kaydet <i class="fa fa-check" aria-hidden="true"></i></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addPaymentType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ödeme Türü Ekle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="paymentType">Ödeme Türü</label>
                            <select id="paymentType" class="form-control">
                                <option></option>
                                @foreach ($payment_types as $payment_type)
                                <option value="{{ $payment_type->id }}">{{ $payment_type->payment_type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="paymentPrice">Alınan Ücret</label>
                        <input type="number" class="form-control" id="paymentPrice" placeholder="Alınan Ücret">
                    </div>
                </div>
                <button type="button" class="btn btn-primary float-right mt-3" id="createPaymentType">Kaydet <i class="fa fa-check" aria-hidden="true"></i></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addCustomerModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Customer</h4>
                <button type="button" class="close add-reservation-close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="name_surname">Müşteri Adı Soyadı</label>
                                <input type="text" class="form-control" id="name_surname" name="name_surname" placeholder="Müşteri Adı Soyadı" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="phone">Müşteri Telefon Numarası</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Müşteri Telefon Numarası">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="customerCountry">Ülke</label>
                                <select class="form-control" name="customerCountry" id="country">
                                    <option></option>
                                    <option value="Türkiye">Türkiye</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="Germany">Germany</option>
                                    <option value="France">France</option>
                                    <option value="Spain">Spain</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Afganistan">Afghanistan</option>
                                    <option value="Albania">Albania</option>
                                    <option value="Algeria">Algeria</option>
                                    <option value="American Samoa">American Samoa</option>
                                    <option value="Andorra">Andorra</option>
                                    <option value="Angola">Angola</option>
                                    <option value="Anguilla">Anguilla</option>
                                    <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Armenia">Armenia</option>
                                    <option value="Aruba">Aruba</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Austria">Austria</option>
                                    <option value="Azerbaijan">Azerbaijan</option>
                                    <option value="Bahamas">Bahamas</option>
                                    <option value="Bahrain">Bahrain</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Barbados">Barbados</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Belize">Belize</option>
                                    <option value="Benin">Benin</option>
                                    <option value="Bermuda">Bermuda</option>
                                    <option value="Bhutan">Bhutan</option>
                                    <option value="Bolivia">Bolivia</option>
                                    <option value="Bonaire">Bonaire</option>
                                    <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                                    <option value="Botswana">Botswana</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                                    <option value="Brunei">Brunei</option>
                                    <option value="Bulgaria">Bulgaria</option>
                                    <option value="Burkina Faso">Burkina Faso</option>
                                    <option value="Burundi">Burundi</option>
                                    <option value="Cambodia">Cambodia</option>
                                    <option value="Cameroon">Cameroon</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Canary Islands">Canary Islands</option>
                                    <option value="Cape Verde">Cape Verde</option>
                                    <option value="Cayman Islands">Cayman Islands</option>
                                    <option value="Central African Republic">Central African Republic</option>
                                    <option value="Chad">Chad</option>
                                    <option value="Channel Islands">Channel Islands</option>
                                    <option value="Chile">Chile</option>
                                    <option value="China">China</option>
                                    <option value="Christmas Island">Christmas Island</option>
                                    <option value="Cocos Island">Cocos Island</option>
                                    <option value="Colombia">Colombia</option>
                                    <option value="Comoros">Comoros</option>
                                    <option value="Congo">Congo</option>
                                    <option value="Cook Islands">Cook Islands</option>
                                    <option value="Costa Rica">Costa Rica</option>
                                    <option value="Cote DIvoire">Cote DIvoire</option>
                                    <option value="Croatia">Croatia</option>
                                    <option value="Cuba">Cuba</option>
                                    <option value="Curaco">Curacao</option>
                                    <option value="Cyprus">Cyprus</option>
                                    <option value="Czech Republic">Czech Republic</option>
                                    <option value="Denmark">Denmark</option>
                                    <option value="Djibouti">Djibouti</option>
                                    <option value="Dominica">Dominica</option>
                                    <option value="Dominican Republic">Dominican Republic</option>
                                    <option value="East Timor">East Timor</option>
                                    <option value="Ecuador">Ecuador</option>
                                    <option value="Egypt">Egypt</option>
                                    <option value="El Salvador">El Salvador</option>
                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                    <option value="Eritrea">Eritrea</option>
                                    <option value="Estonia">Estonia</option>
                                    <option value="Ethiopia">Ethiopia</option>
                                    <option value="Falkland Islands">Falkland Islands</option>
                                    <option value="Faroe Islands">Faroe Islands</option>
                                    <option value="Fiji">Fiji</option>
                                    <option value="Finland">Finland</option>
                                    <option value="French Guiana">French Guiana</option>
                                    <option value="French Polynesia">French Polynesia</option>
                                    <option value="French Southern Ter">French Southern Ter</option>
                                    <option value="Gabon">Gabon</option>
                                    <option value="Gambia">Gambia</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Ghana">Ghana</option>
                                    <option value="Gibraltar">Gibraltar</option>
                                    <option value="Great Britain">Great Britain</option>
                                    <option value="Greece">Greece</option>
                                    <option value="Greenland">Greenland</option>
                                    <option value="Grenada">Grenada</option>
                                    <option value="Guadeloupe">Guadeloupe</option>
                                    <option value="Guam">Guam</option>
                                    <option value="Guatemala">Guatemala</option>
                                    <option value="Guinea">Guinea</option>
                                    <option value="Guyana">Guyana</option>
                                    <option value="Haiti">Haiti</option>
                                    <option value="Hawaii">Hawaii</option>
                                    <option value="Honduras">Honduras</option>
                                    <option value="Hong Kong">Hong Kong</option>
                                    <option value="Hungary">Hungary</option>
                                    <option value="Iceland">Iceland</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="India">India</option>
                                    <option value="Iran">Iran</option>
                                    <option value="Iraq">Iraq</option>
                                    <option value="Ireland">Ireland</option>
                                    <option value="Isle of Man">Isle of Man</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Jamaica">Jamaica</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Jordan">Jordan</option>
                                    <option value="Kazakhstan">Kazakhstan</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Kiribati">Kiribati</option>
                                    <option value="Korea North">Korea North</option>
                                    <option value="Korea Sout">Korea South</option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                    <option value="Laos">Laos</option>
                                    <option value="Latvia">Latvia</option>
                                    <option value="Lebanon">Lebanon</option>
                                    <option value="Lesotho">Lesotho</option>
                                    <option value="Liberia">Liberia</option>
                                    <option value="Libya">Libya</option>
                                    <option value="Liechtenstein">Liechtenstein</option>
                                    <option value="Lithuania">Lithuania</option>
                                    <option value="Luxembourg">Luxembourg</option>
                                    <option value="Macau">Macau</option>
                                    <option value="Macedonia">Macedonia</option>
                                    <option value="Madagascar">Madagascar</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Malawi">Malawi</option>
                                    <option value="Maldives">Maldives</option>
                                    <option value="Mali">Mali</option>
                                    <option value="Malta">Malta</option>
                                    <option value="Marshall Islands">Marshall Islands</option>
                                    <option value="Martinique">Martinique</option>
                                    <option value="Mauritania">Mauritania</option>
                                    <option value="Mauritius">Mauritius</option>
                                    <option value="Mayotte">Mayotte</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Midway Islands">Midway Islands</option>
                                    <option value="Moldova">Moldova</option>
                                    <option value="Monaco">Monaco</option>
                                    <option value="Mongolia">Mongolia</option>
                                    <option value="Montserrat">Montserrat</option>
                                    <option value="Morocco">Morocco</option>
                                    <option value="Mozambique">Mozambique</option>
                                    <option value="Myanmar">Myanmar</option>
                                    <option value="Nambia">Nambia</option>
                                    <option value="Nauru">Nauru</option>
                                    <option value="Nepal">Nepal</option>
                                    <option value="Netherland Antilles">Netherland Antilles</option>
                                    <option value="Netherlands">Netherlands (Holland, Europe)</option>
                                    <option value="Nevis">Nevis</option>
                                    <option value="New Caledonia">New Caledonia</option>
                                    <option value="New Zealand">New Zealand</option>
                                    <option value="Nicaragua">Nicaragua</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="Niue">Niue</option>
                                    <option value="Norfolk Island">Norfolk Island</option>
                                    <option value="Norway">Norway</option>
                                    <option value="Oman">Oman</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Palau Island">Palau Island</option>
                                    <option value="Palestine">Palestine</option>
                                    <option value="Panama">Panama</option>
                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                    <option value="Paraguay">Paraguay</option>
                                    <option value="Peru">Peru</option>
                                    <option value="Phillipines">Philippines</option>
                                    <option value="Pitcairn Island">Pitcairn Island</option>
                                    <option value="Poland">Poland</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="Puerto Rico">Puerto Rico</option>
                                    <option value="Qatar">Qatar</option>
                                    <option value="Republic of Montenegro">Republic of Montenegro</option>
                                    <option value="Republic of Serbia">Republic of Serbia</option>
                                    <option value="Reunion">Reunion</option>
                                    <option value="Romania">Romania</option>
                                    <option value="Russia">Russia</option>
                                    <option value="Rwanda">Rwanda</option>
                                    <option value="St Barthelemy">St Barthelemy</option>
                                    <option value="St Eustatius">St Eustatius</option>
                                    <option value="St Helena">St Helena</option>
                                    <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                                    <option value="St Lucia">St Lucia</option>
                                    <option value="St Maarten">St Maarten</option>
                                    <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                                    <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                                    <option value="Saipan">Saipan</option>
                                    <option value="Samoa">Samoa</option>
                                    <option value="Samoa American">Samoa American</option>
                                    <option value="San Marino">San Marino</option>
                                    <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                    <option value="Senegal">Senegal</option>
                                    <option value="Seychelles">Seychelles</option>
                                    <option value="Sierra Leone">Sierra Leone</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Slovakia">Slovakia</option>
                                    <option value="Slovenia">Slovenia</option>
                                    <option value="Solomon Islands">Solomon Islands</option>
                                    <option value="Somalia">Somalia</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="Sri Lanka">Sri Lanka</option>
                                    <option value="Sudan">Sudan</option>
                                    <option value="Suriname">Suriname</option>
                                    <option value="Swaziland">Swaziland</option>
                                    <option value="Sweden">Sweden</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="Syria">Syria</option>
                                    <option value="Tahiti">Tahiti</option>
                                    <option value="Taiwan">Taiwan</option>
                                    <option value="Tajikistan">Tajikistan</option>
                                    <option value="Tanzania">Tanzania</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Togo">Togo</option>
                                    <option value="Tokelau">Tokelau</option>
                                    <option value="Tonga">Tonga</option>
                                    <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                                    <option value="Tunisia">Tunisia</option>
                                    <option value="Turkmenistan">Turkmenistan</option>
                                    <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                                    <option value="Tuvalu">Tuvalu</option>
                                    <option value="Uganda">Uganda</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Erimates">United Arab Emirates</option>
                                    <option value="United States of America">United States of America</option>
                                    <option value="Uraguay">Uruguay</option>
                                    <option value="Uzbekistan">Uzbekistan</option>
                                    <option value="Vanuatu">Vanuatu</option>
                                    <option value="Vatican City State">Vatican City State</option>
                                    <option value="Venezuela">Venezuela</option>
                                    <option value="Vietnam">Vietnam</option>
                                    <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                                    <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                                    <option value="Wake Island">Wake Island</option>
                                    <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                                    <option value="Yemen">Yemen</option>
                                    <option value="Zaire">Zaire</option>
                                    <option value="Zambia">Zambia</option>
                                    <option value="Zimbabwe">Zimbabwe</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="email">Email Adresi</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email Adresi">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="button" class="btn btn-success float-right" id="addCustomertoReservationSave">Kaydet <i class="fa fa-check"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="chooseCustomerModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Kayıtlı Müşteriler</h4>
                <button type="button" class="close add-reservation-close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card p-3">
                            <div class="dt-responsive table-responsive">
                                <table class="table table-striped table-bordered nowrap dataTable" id="tableData">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Operation</th>
                                            <th scope="col">Adı Soyadı</th>
                                            <th scope="col">Telefon</th>
                                            <th scope="col">Ülke</th>
                                            <th scope="col">Email</th>
                                        </tr>
                                    </thead>
                                    @foreach ($customers as $customer)
                                    <tr>
                                        <td>
                                            <button type="button" class="btn btn-success action-btn create-registered-customer-reservation" id="{{ $customer->id }}" data-name="{{ $customer->customer_name_surname }}"><i class="fa fa-check"></i> Seç</button>
                                        </td>
                                        <td>{{ $customer->name_surname }}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ $customer->country }}</td>
                                        <td>{{ $customer->email }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>

@endsection
