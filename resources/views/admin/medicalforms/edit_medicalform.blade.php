@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 table-responsive">
            <button class="btn btn-primary mt-3" onclick="previousPage();"><i class="fa fa-chevron-left"></i> Önceki Sayfa</button>
        <div class="card p-4 mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <button class="btn btn-primary float-right" onclick="printDiv('root');"><i class="fa fa-print"></i> Formu Yazdır</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="treatmentPlanCard">
                                <div id="root">
                                    <div class="page page-1">
                                        <div class="print-header">
                                            <div class="row">
                                                <div class="col-4" style="background-image: url({{asset('assets/img/logo-byz.png')}});  background-repeat: no-repeat, repeat;">
                                                </div>
                                                <div class="col-8 medical-form-title">
                                                    <h1 class="white">MEDICAL INFORMATION FORM</h1>
                                                    <h2 class="white">MEDİKAL BİLGİ FORMU</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-content">
                                            <div class="col-6">
                                                <div>
                                                    <p class="font-h5"><b>THERAPIST PREFERENCE /</b> TERAPİST TERCİHİ</p>
                                                </div>
                                            </div>
                                            <div  class="col-6">
                                                <div>
                                                    <label class="checkform">
                                                        <p class="font-h5"><b>FEMALE THERAPIST /</b> BAYAN TERAPİST</p>
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->therapist_gender == "female")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>
                                                      <label class="checkform">
                                                        <p class="font-h5"><b>MALE THERAPIST /</b> BAY TERAPİST</p>
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->therapist_gender == "male")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div>
                                                    <p class="font-h5"><b>NAME - SURNAME/</b> AD - SOYAD</p>
                                                </div>
                                            </div>
                                            <div  class="col-7">
                                                <div>
                                                    <p class="font-h5"><b>: {{$medical_form->name_surname}}</b></p>
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div>
                                                    <p class="font-h5"><b>GENDER /</b> CİNSİYET</p>
                                                </div>
                                            </div>
                                            <div  class="col-7">
                                                <div>
                                                    <label class="checkform-2" style="">
                                                        <p class="font-h5"><b>FEMALE /</b> BAYAN </p>
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->gender == "female")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>&nbsp;&nbsp;
                                                      <label class="checkform-2">
                                                        <p class="font-h5"><b>MALE /</b> BAY </p>
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->gender == "male")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div>
                                                    <p class="font-h5"><b>DATE OF BIRTH /</b> DOĞUM TARİHİ</p>
                                                </div>
                                            </div>
                                            <div  class="col-7">
                                                <div>
                                                    <p class="font-h5"><b>: {{$medical_form->birthday}}</b></p>
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div>
                                                    <p class="font-h5"><b>COUNTRY /</b> ÜLKE</p>
                                                </div>
                                            </div>
                                            <div  class="col-7">
                                                <div>
                                                    <p class="font-h5"><b>: {{$medical_form->country}}</b></p>
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div>
                                                    <p class="font-h5"><b>CONTACT NUMBER /</b> TELEFON NUMARASI </p>
                                                </div>
                                            </div>
                                            <div  class="col-7">
                                                <div>
                                                    <p class="font-h5"><b>: {{$medical_form->phone}}</b></p>
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div>
                                                    <p class="font-h5"><b>E-MAIL ADDRESS /</b> E-POSTA</p>
                                                </div>
                                            </div>
                                            <div  class="col-7">
                                                <div>
                                                    <p class="font-h5"><b>: {{$medical_form->email}}</b></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-content" style="border-bottom: 1px solid black; text-align:center">
                                            <div class="col-12">
                                                <div>
                                                    <p class="font-h5 float-right" style="margin-left: 10px;margin-bottom:0"><b>No</b><br> Hayır</p>
                                                </div>
                                                <div>
                                                    <p class="font-h5 float-right" style="margin-bottom:0"><b>Yes</b><br> Evet</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-content" style="margin-top:5px">
                                            <div class="col-10">
                                                <div>
                                                    <p class="font-h5"><b>Heart Problems /</b> Kalp Problemleri</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div>
                                                    <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->heart_problems == "no")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>&nbsp;&nbsp;
                                                      <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->heart_problems == "yes")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <div>
                                                    <p class="font-h5"><b>High - Low Blood Pressure /</b> Yüksek - Düşük Tansiyon Varicose</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div>
                                                    <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->blood_pressure == "no")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>&nbsp;&nbsp;
                                                      <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->blood_pressure == "yes")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <div>
                                                    <p class="font-h5"><b>Veins  /</b> Varis</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div>
                                                    <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->varicose_veins == "no")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>&nbsp;&nbsp;
                                                      <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->varicose_veins == "yes")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <div>
                                                    <p class="font-h5"><b>Asthma  /</b> Astım</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div>
                                                    <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->asthma == "no")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>&nbsp;&nbsp;
                                                      <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->asthma == "yes")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <div>
                                                    <p class="font-h5"><b>Vertebral Problems /</b> Omurilik Problemleri</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div>
                                                    <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->vertebral_problem == "no")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>&nbsp;&nbsp;
                                                      <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->vertebral_problem == "yes")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <div>
                                                    <p class="font-h5"><b>Other Joint Problems /</b> Diğer Eklem Problemleri</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div>
                                                    <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->joint_problems == "no")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>&nbsp;&nbsp;
                                                      <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->joint_problems == "yes")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <div>
                                                    <p class="font-h5"><b>Fractures /</b> Kırıklar</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div>
                                                    <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->fractures == "no")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>&nbsp;&nbsp;
                                                      <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->fractures == "yes")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <div>
                                                    <p class="font-h5"><b>Skin Allergies /</b> Cilt Alerjisi</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div>
                                                    <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->skin_allergies == "no")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>&nbsp;&nbsp;
                                                      <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->skin_allergies == "yes")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <div>
                                                    <p class="font-h5"><b>Lodine Allergy /</b> İyot Alerjisi</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div>
                                                    <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->lodine_allergies == "no")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>&nbsp;&nbsp;
                                                      <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->lodine_allergies == "yes")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <div>
                                                    <p class="font-h5"><b>Hyperthyroidism /</b> Hipertroidi (Guatr)</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div>
                                                    <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->hyperthyroidism == "no")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>&nbsp;&nbsp;
                                                      <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->hyperthyroidism == "yes")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <div>
                                                    <p class="font-h5"><b>Diabetes /</b> Diyabet</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div>
                                                    <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->diabetes == "no")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>&nbsp;&nbsp;
                                                      <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->diabetes == "yes")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <div>
                                                    <p class="font-h5"><b>Epilepsy /</b> Epilepsi</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div>
                                                    <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->epilepsy == "no")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>&nbsp;&nbsp;
                                                      <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->epilepsy == "yes")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <div>
                                                    <p class="font-h5"><b>Are you pregnant? /</b> Hamile misiniz‘?</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div>
                                                    <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->pregnant == "no")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>&nbsp;&nbsp;
                                                      <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->pregnant == "yes")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <div>
                                                    <p class="font-h5"><b>Do you have back problems? /</b> Sırt probleminiz var mı?</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div>
                                                    <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->back_problems == "no")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>&nbsp;&nbsp;
                                                      <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->back_problems == "yes")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <div>
                                                    <p class="font-h5"><b>Have you ever tested positive for covid-19 ? /</b> Hiç covid-19 testiniz pozitif çıktı mı?</p>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div>
                                                    <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->covid == "no")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>&nbsp;&nbsp;
                                                      <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->covid == "yes")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>
                                                </div>
                                            </div>
                                            <div class="col-12" style="border-top: 1px solid black;border-bottom: 1px solid black;">
                                                <p class="font-h5" style="margin-bottom:0"><b>If yes, please provide the date.</b><br>Evet ise ne zaman?</p>
                                                <p class="font-h5" style="margin-bottom:0"><b>{{ ($medical_form->covid == "yes")? $medical_form->covid_note : "....................................................................................................................................................................................................................." }}</b></p>
                                            </div>
                                            <div class="col-10">
                                                <div>
                                                    <p class="font-h5" style="margin-bottom:0"><b>Have you been surgically operated on ? /</b> Ameliyat oldunuz mu?</p>
                                                </div>
                                            </div>
                                            <div class="col-2" style=" margin: 3px 0; ">
                                                <div>
                                                    <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->surgery == "no")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>&nbsp;&nbsp;
                                                      <label class="checkform-2 float-right">
                                                        <input type="checkbox" onclick="return false;" {{ ($medical_form->surgery == "yes")? "checked" : "" }}>
                                                        <span class="checkmark"></span>
                                                      </label>
                                                </div>
                                            </div>
                                            <div class="col-12" style="border-top: 1px solid black;border-bottom: 1px solid black">
                                                <p class="font-h5" style="margin-bottom:0"><b>If yes, please explain the type of surgery and the date.</b><br>Evet ise hangisi ve ne zaman?</p>
                                                <p class="font-h5" style="margin-bottom:0"><b>{{ ($medical_form->surgery == "yes")? $medical_form->surgery_note : "....................................................................................................................................................................................................................." }}</b></p>
                                            </div>
                                            <div class="col-12" style="border-top: 1px solid black;border-bottom: 1px solid black">
                                                <p class="font-h5" style="margin-bottom:0">I confirm that this form is completed to the best of my knowledge and the information above is correct. I accept to use the massage, spa and hammam facilities at my own will, and will not hold the management responsible for any health problem or accident that may occur during the therapy session.</p>
                                                <p class="font-h5" style="margin-bottom:0"><b>İşbu formun bilgim dahilinde doldurulduğunu ve yukarıda verilen bilgilerin doğru olduğunu onaylarım. Masaj, hamam veya cilt bakımı tesislerini kendi isteğimle kullanacağımı ve bakım esnasında oluşacak herhangi bir sağlık problemi veya kazadan yönetimi sorumlu tutmayacağımı kabul ederim.</b></p>
                                            </div>
                                            <div class="col-12">
                                                <p class="font-h5" style="margin-bottom:0">*In order to maximize the efficiency of your therapy session, please remove your accessories such as rings, necklaces, bracelets and valuables before the session and lock them in the safebox in the reception area. We inform you that we have provided a safe box for your valuables.</p>
                                                <p class="font-h5" style="margin-bottom:0"><b>*Bakımlardan maksimum verimi sağlamak için yüzük, kolye, bilezik gibi aksesuarlarınızı ve değerli eşyalarınızı bakım öncesinde Iütfen çıkarınız ve resepsiyon alanındaki kasalara kilitleyiniz. Değerli eşyalarınızın güvenliği için sizlere kasa temin ettiğimizi bildiririz.</b></p>
                                            </div>
                                            <div class="col-7" style="margin-top: 30px">
                                                <p class="font-h5" style="margin-bottom:0"><b>Date / Tarih: </b>  {{date('d-m-Y', strtotime( $medical_form->created_at ))}} </p>
                                                <p class="font-h5" style="margin-bottom:0"><b>Time / Saat: </b> {{date('H:i', strtotime( $medical_form->created_at ))}} </p>
                                            </div>
                                            <div class="col-5" style="margin-top: 30px">
                                                <p class="font-h5" style="text-align:center"><b>GUEST SIGNATURE/</b> MİSAFİR İMZA</p>
                                                <img src="{{$medical_form->signature}}" width="350" class="float-right" alt="">
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


@section('footer')
    <script>

        function printDiv(divName) {
            var printContents = document.getElementById(divName).outerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
