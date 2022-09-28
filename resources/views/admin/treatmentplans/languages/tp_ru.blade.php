@extends('layouts.app')
@section('content')
@include('layouts.navbar')
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 table-responsive">
         <button class="btn btn-primary mt-3" onclick="previousPage();"><i class="fa fa-chevron-left"></i> Previous Page</button>
         <div class="card p-4 mt-3">
            <div class="card-title">
               <h2>Download Treatment Plan</h2>
               <a href="{{ url('/definitions/treatmentplans/create') }}" class="btn btn-primary float-right new-btn">New Treatment Plan <i class="fa fa-arrow-right"></i></a>
            </div>
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-header">
                     <div class="row align-items-center">
                        <div class="col-6">
                           <div class="dropdown">
                              <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown"><img class="flag-img" src="{{ asset('assets/img/ru.png') }}"> Russian <span class="caret"></span></button>
                              <ul class="dropdown-menu">
                                 <li><a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang=en&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/en.png') }}"> English</a></li>
                                 <li><a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang=de&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/de.png') }}"> Deutsch</a></li>
                                 <li><a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang=it&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/it.png') }}"> Italian</a></li>
                                 <li><a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang=fr&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/fr.png') }}"> French</a></li>
                                 <li><a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang=es&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/es.png') }}"> Spanish</a></li>
                                 <li><a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang=pl&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/pl.png') }}"> Polish</a></li>
                                 <li><a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang=pt&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/pt.png') }}"> Portuguese</a></li>
                                 <li><a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang=tr&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/tr.png') }}"> Turkish </a></li>
                                 <li><a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang=ar&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/ar.png') }}"> Arabic</a></li>
                              </ul>
                           </div>
                        </div>
                        <div class="col-6">
                           <button class="btn btn-primary float-right" onclick="treatmentPlanPdf();"><i class="fa fa-download"></i> Download PDF</button>
                        </div>
                     </div>
                  </div>
                  <div class="card-body" style="padding-top: 0">
                     <div id="root">
                        <div class="treatmentPlanCard">
                           <div class="card-body">
                              <div class="container page2">
                                 <div class="row pageRow2">
                                    <div class="newBorder2">
                                       <div class="row">
                                          <div class="col-lg-12">
                                             <img class="logo_page2" src="{{ asset('assets/img/ceyhun-logo.png') }}">
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-4 patientInfo">
                                             <h2 class="patient-information-title">ИНФОРМАЦИЯ О ПАЦИЕНТЕ</h2>
                                             <br>
                                             <p><span>Имя, Фамилия:</span> <b id="patient-name-pdf">{{ $treatment_plan->patient->name_surname }}</b></p>
                                             <p><span>Возраст:</span> <b> {{ $treatment_plan->patient->age }}</b></p>
                                             <p><span>ИМТ:</span> <b>{{ $treatment_plan->bmiValue }}</b></p>
                                             <p><span>Хронические Заболевания:</span> @foreach($treatment_plan->chronicIllnesses as $item) <b> {{ $item->chronic_illnesses }},  </b> @endforeach</p>
                                             <p><span>История Операций:</span> @foreach($treatment_plan->surgicalHistory as $item) <b> {{ $item->surgical_history }}, </b> @endforeach</p>
                                             <p><span>Аллергия:</span> @foreach($treatment_plan->allergies as $item) <b> {{ $item->allergie }}, </b> @endforeach</p>
                                             <p><span>Лекарства:</span> @foreach($treatment_plan->medications as $item) <b> {{ $item->medication }}, </b> @endforeach</p>
                                             <p><span>Алкоголь:</span> <b> @if($treatment_plan->is_alcohol == "yes") Да @elseif($treatment_plan->is_alcohol == "no") Нет @else - @endif</b></p>
                                             <p><span>Курение:</span> <b> @if($treatment_plan->is_smoke == "yes") Да @elseif($treatment_plan->is_smoke == "no") Нет @else - @endif</b></p>
                                             {{-- 
                                             <p>Gender: <b>{{ $treatment_plan->patient->gender }}</b></p>
                                             --}}
                                             <br>
                                             <br>
                                             <h2 class="doctor-notes-title"><img src="{{ asset('assets/img/wp-doctor.png') }}" alt=""> ЗАМЕТКИ ВРАЧА</h2>
                                             <br>
                                             <p><span>Имя Врача:</span> <b>{{ __('Ceyhun Aydogan') }}</b>
                                             </p>
                                             <p><span>Рекомендация Хирурга:</span> <b>{{ $treatment_plan->recommendedTreatment->treatment_name_ru }}</b></p>
                                             <br>
                                             <br>
                                             <h2 class="contact-title">КОНТАКТ</h2>
                                             <br>
                                             <p><span>Medical Consultant:</span> <b>{{ $treatment_plan->salesPerson->name_surname }}</b></p>
                                             <p><span>Phone:</span> <b>{{ $treatment_plan->salesPerson->phone_number }}</b></p>
                                             <p><span>Электронная почта:</span> <b>info@arpanumedical.com</b></p>
                                          </div>
                                          <div class="col-8 bg-white">
                                             <h1 class="treatment-plan-title">ПЛАН ЛЕЧЕНИЯ</h1>
                                             <table class="table table-bordered treatmentplan-table">
                                                <thead>
                                                   <tr>
                                                      <th>ЛЕЧЕНИЯ</th>
                                                      <th>Price:</th>
                                                      <th>Duration of Stay</th>
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                   <tr>
                                                      <td class="text-center">
                                                         {{ $treatment_plan->recommendedTreatment->treatment_name_ru }}
                                                      </td>
                                                      <td class="text-center">
                                                         {{ $treatment_plan->price_currency }} {{ $treatment_plan->total_price }}
                                                      </td>
                                                      <td class="text-center">
                                                         {{ substr($treatment_plan->duration_of_stay, 0, 1) }} <span class="night-text">ночей с</span>
                                                      </td>
                                                   </tr>
                                                </tbody>
                                             </table>
                                             <div class="row">
                                                <div class="col text-center changes text-white">
                                                   <p class="thicker"></p>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col divPrice">
                                                   <h3 class="titlePrice">Включено в стоимость</h3>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col includeText">
                                                   {{-- @if($treatment_plan->treatment_id == 92 || $treatment_plan->treatment_id == 93 || $treatment_plan->treatment_id == 94) --}}
                                                   <p><i class="fa fa-caret-right iconsFa"></i> {{ $treatment_plan->treatment->treatment_name }} <span>Procedure</span></p>
                                                   <p style="line-height: 15px"><i class="fa fa-caret-right iconsFa"></i> <span>Все стандартные предоперационные обследования в больнице перед операцией (УЗИ, Рентген, Анализы крови, Консультация врача по внутренним болезням, Консультация анестезиолога, Эндоскопия)</span></p>
                                                   <p><i class="fa fa-caret-right iconsFa"></i> {{ $treatment_plan->hospitalization }} stay in hospital after operation</p>
                                                   <p><i class="fa fa-caret-right iconsFa"></i> <span>Программа наблюдения у диетолога в течение одного года в качестве последующего ухода</span></p>
                                                   <p><i class="fa fa-caret-right iconsFa"></i> <span>Лекарства, которые хирург назначит после операции</span></p>
                                                   <p><i class="fa fa-caret-right iconsFa"></i>
                                                      Проживание в отеле на {{ substr($treatment_plan->duration_of_stay, 0, 1) }} ночей с сопровождающим 
                                                   </p>
                                                   <p><i class="fa fa-caret-right iconsFa"></i> <span>VIP-транспорт между отелем, больницей и аэропортом,</span></p>
                                                   <p style="line-height: 15px"><i class="fa fa-caret-right iconsFa"></i> <span>Медицинский переводчик, говорящий на вашем языке, который будет поддерживать и помогать вам с вашими потребностями во время вашего пребывания (английский, испанский, итальянский, немецкий, арабский, польский, албанский, румынский),</span></p>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col divPrice">
                                                   <h3 class="titlePrice">Не входит в стоимость</h3>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col includeText2">
                                                   <p><i class="fa fa-caret-right iconsFa"></i> <span>Плата за длительное пребывание в больнице:м:</span></p>
                                                   {{-- 
                                                   <p><i class="fa fa-caret-right iconsFa"></i> <span>The protein shake and large spectrum vitamin supplements</span></p>
                                                   --}}
                                                   <p><i class="fa fa-caret-right iconsFa"></i> <span>Ваши рейсы прилета и вылета</span></p>
                                                   <p><i class="fa fa-caret-right iconsFa"></i> <span>Ваши личные расходы</span></p>
                                                </div>
                                             </div>
                                             <div class="row" style="margin-top: 10px;">
                                                <div class="col-12">
                                                   <h3 class="titleBeforeAfter">ДО - ПОСЛЕ</h3>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-6" style="padding-right: 0">
                                                   <div class="img-cover">
                                                      <img src="{{ asset('assets/img/gallery-1.jpg') }}">
                                                   </div>
                                                </div>
                                                <div class="col-6" style="padding-left: 0">
                                                   <div class="img-cover">
                                                      <img src="{{ asset('assets/img/gallery-2.jpg') }}">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="container page3">
                                 <div class="row">
                                    <div class="newBorder3">
                                       <div class="row">
                                          <div class="col-lg-6">
                                             <img class="logo_page3_1" src="{{ asset('assets/img/ceyhun-logo.png') }}">
                                          </div>
                                          <div class="col-lg-6">
                                             <img class="logo_page3_2" src="{{ asset('assets/img/arpanu-logo.png') }}">
                                          </div>
                                       </div>
                                       <div class="row section-service-photos" style="margin-top: 30px;">
                                          <div class="col-12" style="margin-bottom: 20px;">
                                             <div class="subTitle">Ваш Отел</div>
                                          </div>
                                          <div class="col-6">
                                             <div class="img-cover">
                                                <img src="{{ asset('assets/img/hotel-service-1.jpg') }}">
                                             </div>
                                          </div>
                                          <div class="col-6" style="padding-left: 0">
                                             <div class="img-cover">
                                                <img src="{{ asset('assets/img/hotel-service-2.jpg') }}">
                                             </div>
                                          </div>
                                          <div class="col-6 mt-3">
                                             <div class="img-cover">
                                                <img src="{{ asset('assets/img/hotel-service-3.jpg') }}">
                                             </div>
                                          </div>
                                          <div class="col-6 mt-3" style="padding-left: 0">
                                             <div class="img-cover">
                                                <img src="{{ asset('assets/img/hotel-service-4.jpg') }}">
                                             </div>
                                          </div>
                                          <div class="col-12" style="margin-bottom: 20px; margin-top: 20px;">
                                             <div class="subTitle">Ваш Транспорт</div>
                                          </div>
                                          <div class="col-4">
                                             <div class="img-cover">
                                                <img src="{{ asset('assets/img/vip-service-1.jpg') }}">
                                             </div>
                                          </div>
                                          <div class="col-4">
                                             <div class="img-cover">
                                                <img src="{{ asset('assets/img/vip-service-2.jpg') }}">
                                             </div>
                                          </div>
                                          <div class="col-4">
                                             <div class="img-cover">
                                                <img src="{{ asset('assets/img/vip-service-3.jpg') }}">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-lg-12 text-center importantText">
                                             <p>ВАЖНО</p>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-lg-12 text-center infoText">
                                             <p>Если ваши планы поездки изменятся, пожалуйста, сообщите нам об этом за 48 часов до даты вашего прибытия.</p>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-lg-12 text-center infoText">
                                             <p style="margin-bottom: 20px">Мы здесь 24/7, чтобы сделать все возможное, чтобы помочь вам</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@include('layouts.theme_modal')

@endsection