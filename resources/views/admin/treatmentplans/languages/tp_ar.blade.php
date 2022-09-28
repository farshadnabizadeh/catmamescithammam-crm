@extends('layouts.app')
@section('content')
@include('layouts.navbar')
<div class="container-fluid">
   <div class="row">
      <div class="col-md-12 table-responsive">
         <button class="btn btn-primary mt-3" onclick="previousPage();"><i class="fa fa-chevron-left"></i> Previous Page</button>
         <div class="card p-5 mt-3">
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
                              <button class="btn btn-primary dropdown-toggle action-btn" type="button" data-toggle="dropdown"><img class="flag-img" src="{{ asset('assets/img/ar.png') }}"> Arabic <span class="caret"></span></button>
                              <ul class="dropdown-menu">
                                 <li><a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang=en&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/en.png') }}"> English</a></li>
                                 <li><a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang=de&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/de.png') }}"> Deutsch</a></li>
                                 <li><a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang=it&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/it.png') }}"> Italian</a></li>
                                 <li><a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang=es&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/es.png') }}"> Spanish</a></li>
                                 <li><a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang=fr&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/fr.png') }}"> French</a></li>
                                 <li><a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang=pt&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/pt.png') }}"> Portuguese</a></li>
                                 <li><a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang=ru&theme='.$theme.'') }}" class="btn btn-primary"><img class="flag-img" src="{{ asset('assets/img/ru.png') }}"> Russian</a></li>
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
                        <div class="treatmentPlanCard arabicTreatmentPlanCard">
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
                                             <h2 class="patient-information-title"> معلومات المريض  </h2>
                                             <br>
                                             <p><span>الاسم واللقب:</span> <b id="patient-name-pdf">{{ $treatment_plan->patient->name_surname }}</b></p>
                                             <p><span>العمر :</span> <b> {{ $treatment_plan->patient->age }}</b></p>
                                             <p><span>مؤشر كتلة الجسم:</span> <b>{{ $treatment_plan->bmiValue }}</b></p>
                                             <p><span>الأمراض المزمنة:</span> @foreach($treatment_plan->chronicIllnesses as $item) <b> {{ $item->chronic_illnesses }},  </b> @endforeach</p>
                                             <p><span>العمليات  السابقة:</span> @foreach($treatment_plan->surgicalHistory as $item) <b> {{ $item->surgical_history }}, </b> @endforeach</p>
                                             <p><span>الحساسية:</span> @foreach($treatment_plan->allergies as $item) <b> {{ $item->allergie }}, </b> @endforeach</p>
                                             <p><span>الأدوية التي تستخدم :</span> @foreach($treatment_plan->medications as $item) <b> {{ $item->medication }}, </b> @endforeach</p>
                                             <p><span>الكحول :</span> <b> @if($treatment_plan->is_alcohol == "yes") نعم @elseif($treatment_plan->is_alcohol == "no") لا @else - @endif</b></p>
                                             <p><span>التدخين :</span> <b> @if($treatment_plan->is_smoke == "yes") نعم @elseif($treatment_plan->is_smoke == "no") لا @else - @endif</b></p>
                                             {{-- 
                                             <p>Gender: <b>{{ $treatment_plan->patient->gender }}</b></p>
                                             --}}
                                             <br>
                                             <br>
                                             <h2 class="doctor-notes-title">ملاحظات الطبيب  <img src="{{ asset('assets/img/wp-doctor.png') }}" alt=""> </h2>
                                             <br>
                                             <p><span>اسم الطبيب:</span> @foreach($treatment_plan->treatments as $data) <b>{{ $data->doctor->name_surname }}</b> @endforeach
                                             </p>
                                             <p><span>توصيات الجراح</span> <b> {{ $treatment_plan->recommendedTreatment->treatment_name_ar }}</b></p>
                                             <br>
                                             <br>
                                             <h2 class="contact-title">التواصل</h2>
                                             <br>
                                             <p><span>مدير المتابعة مع المريض:</span> <b>{{ $treatment_plan->salesPerson->name_surname }}</b></p>
                                             <p><span>رقم الهاتف </span> <b>{{ $treatment_plan->salesPerson->phone_number }}</b></p>
                                          </div>
                                          <div class="col-8 bg-white">
                                             <h1 class="treatment-plan-title">الخطة العلاجية</h1>
                                             <p class="treatment-name">
                                                {{ $treatment_plan->recommendedTreatment->treatment_name_ar }}
                                             </p>
                                             <table class="table table-bordered treatmentplan-table">
                                                <thead>
                                                   <tr>
                                                      <th>السعر</th>
                                                      <th>مدة الإقامة في تركيا خلال العملية</th>
                                                      <th>مدة الإقامة في المستشفى </th>
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                   <tr>
                                                      <td class="text-center">
                                                         {{ $treatment_plan->price_currency }} {{ $treatment_plan->total_price }}
                                                      </td>
                                                      <td class="text-center">
                                                         {{ substr($treatment_plan->duration_of_stay, 0, 1) }} <span class="nights-text">ليالي</span>
                                                      </td>
                                                      <td class="text-center">
                                                         @if($treatment_plan->treatment_id == 92 || $treatment_plan->treatment_id == 93 || $treatment_plan->treatment_id == 94)
                                                         0 <span class="night-text">ليلة</span>
                                                         @else
                                                         {{ substr($treatment_plan->hospitalization, 0, 1) }} <span class="nights-text">ليالي</span>
                                                         @endif
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
                                                   <h3 class="titlePrice">ما يشمله سعر العملية</h3>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col includeText">
                                                   {{-- @if($treatment_plan->treatment_id == 92 || $treatment_plan->treatment_id == 93 || $treatment_plan->treatment_id == 94) --}}
                                                   <p><i class="fa fa-caret-left iconsFa"></i><span>مراحل</span>  {{ $treatment_plan->recommendedTreatment->treatment_name_ar }} </p>
                                                   <p style="line-height: 15px"><i class="fa fa-caret-left iconsFa"></i> <span>  إجراء كافة التحاليل والفحصوصات الأولية للعملية (الموجات فوق الصوتية، الأشعة السينية، تحليل الدم،
                                                      استشارة طبيب الباطنة، استشارة طبيب التخدير، المنظار)</span>
                                                   </p>
                                                   <p><i class="fa fa-caret-left iconsFa"></i> بعد العملية {{ substr($treatment_plan->hospitalization, 0, 1) }} الإقامة في المستشفى </p>
                                                   <p><i class="fa fa-caret-left iconsFa"></i> <span>المتابعة معنا  لمدة سنة من قبل طبيب التغذية</span></p>
                                                   <p><i class="fa fa-caret-left iconsFa"></i> <span>الأدوية التي سيكتبها الطبيب بعد العملية</span></p>
                                                   <p><i class="fa fa-caret-left iconsFa"></i>
                                                      <span>{{ $treatment_plan->duration_of_stay }}</span> Nights hotel accommodation including a companion
                                                   </p>
                                                   <p><i class="fa fa-caret-left iconsFa"></i> <span>التوصيل والتنقل بسيارات ممتازة بين المطار والفندق والمستشفى</span></p>
                                                   <p style="line-height: 15px"><i class="fa fa-caret-left iconsFa"></i> <span>طوال تواجدك في إسطنبول لأجل العملية، فإن هناك مترجم سيكون بجانبك لكي يسهل لك كل شيئ بأي لغة أردت. (العربية، الإنجليزية، الفرنسية، الإيطالية، الإسبانية، الألبانية، الرومانية، البولندية)</span></p>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col divPrice">
                                                   <h3 class="titlePrice">ما لا يشمله السعر </h3>
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col includeText2">
                                                   <p><i class="fa fa-caret-left iconsFa"></i> <span>مصاريف البقاء في المستشفى لفترة طويلة:</span></p>
                                                   {{-- 
                                                   <p><i class="fa fa-caret-left iconsFa"></i> <span>مخفوقات البروتين ومكملات الفيتامينات واسعة النطاق</span></p>
                                                   --}}
                                                   <p><i class="fa fa-caret-left iconsFa"></i> <span>تذكرة الطائرة ذهابًا وعودة</span></p>
                                                   <p><i class="fa fa-caret-left iconsFa"></i> <span>مصاريفك الشخصية </span></p>
                                                </div>
                                             </div>
                                             <div class="row" style="margin-top: 10px;">
                                                <div class="col-12">
                                                   <h3 class="titleBeforeAfter">قبل - وبعد</h3>
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
                                             <h2 class="titlePhotos">الصور </h2>
                                             <div class="subTitle">الفندق </div>
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
                                             <div class="subTitle">الوصول </div>
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
                                             <p>هام </p>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-lg-12 text-center infoText">
                                             <p style="margin-bottom: 20px">إذا حدث أ ي تغير في رحلتك العلاجية، نتمنى منك أن تخبرنا بذلك قبل موعد وصولك بثماني وأربعين ساعة، ونحن طوال أيام الأسبوع خلال أربع وعشرين ساعة في خدمتك دائمًا؛ لتيسير كافة الإجراءات الخاصة بك.</p>
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
@endsection