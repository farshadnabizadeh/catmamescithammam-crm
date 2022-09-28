@extends('layouts.app')

@section('content')

@include('layouts.navbar')

   <div class="container-fluid">
      <div class="row">
         <button onclick="previousPage();" class="btn btn-primary float-left mt-3"><i class="fa fa-angle-left" aria-hidden="true"></i> Previous Page</button>
         <div class="col-md-12 table-responsive">
            <div class="card p-4 mt-3">
               <div class="card-title d-flex">
                  <h2>Create New Treatment Plan Request</h2>
                  <p class="patientName"></p>
                  <hr>
               </div>
               <div id="demo">
                  <div class="step-app">
                     <ul class="step-steps">
                        <li>
                           <a href="#tab1"><span class="number">1</span> Create Patient</a>
                        </li>
                        <li>
                           <a href="#tab2"><span class="number">2</span> Create Request</a>
                        </li>
                        <li>
                           <a href="#tab3"><span class="number">3</span> Medical History</a>
                        </li>
                        <li>
                           <a href="#tab4"><span class="number">4</span> Request Summary</a>
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
                                    <button class="btn btn-warning" id="createNewPatient" data-toggle="modal" data-target="#createPatientModal">Create New Patient <i class="fa fa-plus" aria-hidden="true"></i></button>
                                 </div>
                              </div>
                              <div class="col-lg-6 col-sm-6 col-xs-6">
                                 <div class="card p-3 mt-3">
                                    <button class="btn btn-warning" id="choosePatient" data-toggle="modal" data-target="#choosePatientModal">Choose Patient From the list <i class="fa fa-user"></i></button>
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
                              <div class="col-lg-12">
                                 <div class="row mt-3">
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                          <label for="treatmentId">Treatments</label>
                                          <select class="form-control" id="treatmentId">
                                             <option></option>
                                             @foreach ($treatments as $treatment)
                                             <option value="{{ $treatment->id }}">{{ $treatment->name_en }}</option>
                                             @endforeach
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                          <label for="salesPersonId">Sales Person</label>
                                          <select class="form-control" id="salesPersonId">
                                             @foreach ($sales_persons as $sales_person)
                                             @if($sales_person->email_address == auth()->user()->email)
                                             <option value="{{ $sales_person->id }}" selected>{{ $sales_person->name_surname }}</option>
                                             @else
                                             <option></option>
                                             <option value="{{ $sales_person->id }}">{{ $sales_person->name_surname }}</option>
                                             @endif
                                             @endforeach
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                          <label for="doctorId">Doctors</label>
                                          <select class="form-control" id="doctorId">
                                             <option></option>
                                                @foreach ($doctors as $doctor)
                                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                                @endforeach
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                          <label for="durationOfStay">Duration Of Stay</label>
                                          <select class="form-control" id="durationOfStay">
                                             <option></option>
                                             <option value="0 Night">0 Night</option>
                                             <option value="1 Night">1 Night</option>
                                             <option value="2 Nights">2 Nights</option>
                                             <option value="3 Nights">3 Nights</option>
                                             <option value="4 Nights">4 Nights</option>
                                             <option value="5 Nights">5 Nights</option>
                                             <option value="6 Nights">6 Nights</option>
                                             <option value="7 Nights">7 Nights</option>
                                             <option value="8 Nights">8 Nights</option>
                                             <option value="9 Nights">9 Nights</option>
                                             <option value="10 Nights">10 Nights</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                          <label for="hospitalization">Hospitalization</label>
                                          <select class="form-control" id="hospitalization">
                                             <option></option>
                                             <option value="0 Night">0 Night</option>
                                             <option value="1 Night">1 Night</option>
                                             <option value="2 Nights">2 Nights</option>
                                             <option value="3 Nights">3 Nights</option>
                                             <option value="4 Nights">4 Nights</option>
                                             <option value="5 Nights">5 Nights</option>
                                             <option value="6 Nights">6 Nights</option>
                                             <option value="7 Nights">7 Nights</option>
                                             <option value="8 Nights">8 Nights</option>
                                             <option value="9 Nights">9 Nights</option>
                                             <option value="10 Nights">10 Nights</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-lg-4">
                                       <div class="form-group">
                                          <label for="total_price">Estimated Price</label>
                                          <input type="text" class="form-control" id="total_price" placeholder="Enter Estimated Price">
                                       </div>
                                    </div>
                                    <div class="col-lg-2">
                                       <div class="form-group">
                                          <label for="bariatricPriceCurrency">Currency</label>
                                          <select class="form-control" id="priceCurrency">
                                             <option></option>
                                             <option value="€">Euro</option>
                                             <option value="$">Dolar</option>
                                             <option value="£">Pound</option>
                                             <option value="₺">Lira</option>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-lg-12">
                                       <button type="button" class="btn btn-primary float-right mb-5 save-fix-btn" id="saveTreatmentPlanBtn">Next <i class="fa fa-arrow-right"></i></button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <form name="frmInfo" class="d-none" id="frmInfo">
                              <input type="text" name="txtFirstName" required>
                              <input type="text" name="txtLastName" required>
                           </form>
                        </div>
                        <div class="step-tab-panel" id="tab3">
                           <div class="progress mt-3">
                              <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="75" style="width: 75%">
                              </div>
                           </div>
                           <button class="btn btn-primary d-none" id="uploadFile"></button>
                           <div class="row pt-3">
                              <div class="col-lg-12 col-md-12 col-xs-12">
                                 <div class="card p-3">
                                    <div class="card-title">
                                       <h2>Medical History</h2>
                                    </div>
                                    <div class="card-body" style="padding: 0">
                                       <div class="row">
                                          <div class="col-lg-3">
                                             <div class="card">
                                                <div class="card-body">
                                                   <div class="form-group">
                                                      <label><b>Asthma ?</b></label>
                                                       <div class="input-container row">
                                                           <div class="form-check col-6">
                                                               <input class="form-check-input" type="radio" value="yes" name="is_asthma" id="is_asthma_yes">
                                                               <label class="form-check-label" for="is_asthma_yes">Yes</label>
                                                           </div>
                                                           <div class="form-check col-6">
                                                               <input class="form-check-input" type="radio" value="no" name="is_asthma" id="is_asthma_no">
                                                               <label class="form-check-label" for="is_asthma_no">No</label>
                                                           </div>
                                                       </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-lg-3">
                                             <div class="card">
                                                <div class="card-body">
                                                   <div class="form-group">
                                                      <label><b>Diabetes ?</b></label>
                                                       <div class="input-container row">
                                                           <div class="form-check col-6">
                                                               <input class="form-check-input" type="radio" value="yes" name="is_diabetes" id="is_diabetes_yes">
                                                               <label class="form-check-label" for="is_diabetes_yes">Yes</label>
                                                           </div>
                                                           <div class="form-check col-6">
                                                               <input class="form-check-input" type="radio" value="no" name="is_diabetes" id="is_diabetes_no">
                                                               <label class="form-check-label" for="is_diabetes_no">No</label>
                                                           </div>
                                                       </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-lg-3">
                                             <div class="card">
                                                <div class="card-body">
                                                   <div class="form-group">
                                                      <label><b>Hyper Tension ?</b></label>
                                                       <div class="input-container row">
                                                           <div class="form-check col-6">
                                                               <input class="form-check-input" type="radio" value="yes" name="is_hyper_tension" id="is_hyper_tension_yes">
                                                               <label class="form-check-label" for="is_hyper_tension_yes">Yes</label>
                                                           </div>
                                                           <div class="form-check col-6">
                                                               <input class="form-check-input" type="radio" value="no" name="is_hyper_tension" id="is_hyper_tension_no">
                                                               <label class="form-check-label" for="is_hyper_tension_no">No</label>
                                                           </div>
                                                       </div>

                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-lg-3">
                                             <div class="card">
                                                <div class="card-body">
                                                   <div class="form-group">
                                                      <label><b> Breathing Problems ?</b></label>
                                                       <div class="input-container row">
                                                           <div class="form-check col-6 ">
                                                               <input class="form-check-input" type="radio" value="yes" name="is_breathing_problem" id="is_breathing_problems_yes">
                                                               <label class="form-check-label" for="is_breathing_problems_yes">Yes</label>
                                                           </div>
                                                           <div class="form-check col-6">
                                                               <input class="form-check-input" type="radio" value="no" name="is_breathing_problem" id="is_breathing_problems_no">
                                                               <label class="form-check-label" for="is_breathing_problems_no">No</label>
                                                           </div>
                                                       </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-lg-3">
                                             <div class="card">
                                                <div class="card-body">
                                                   <div class="form-group">
                                                      <label><b>Chronic Heart Ilness ?</b></label>
                                                       <div class="input-container row">
                                                           <div class="form-check col-6">
                                                               <input class="form-check-input" type="radio" value="yes" name="is_chronic_illness" id="is_chronic_illness_yes">
                                                               <label class="form-check-label" for="is_chronic_illness_yes">Yes</label>
                                                           </div>
                                                           <div class="form-check col-6">
                                                               <input class="form-check-input" type="radio" value="no" name="is_chronic_illness" id="is_chronic_illness_no">
                                                               <label class="form-check-label" for="is_chronic_illness_no">No</label>
                                                           </div>
                                                       </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-lg-3">
                                             <div class="card">
                                                <div class="card-body">
                                                   <div class="form-group">
                                                      <label><b>HIV ?</b></label>
                                                       <div class="input-container row">
                                                           <div class="form-check col-6">
                                                               <input class="form-check-input" type="radio" value="yes" name="is_hiv" id="is_hiv_yes">
                                                               <label class="form-check-label" for="is_hiv_yes">Yes</label>
                                                           </div>
                                                           <div class="form-check col-6">
                                                               <input class="form-check-input" type="radio" value="no" name="is_hiv" id="is_hiv_no">
                                                               <label class="form-check-label" for="is_hiv_no">No</label>
                                                           </div>
                                                       </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-lg-3">
                                             <div class="card">
                                                <div class="card-body">
                                                   <div class="form-group">
                                                      <label><b>Stroke ?</b></label>
                                                       <div class="input-container row">
                                                           <div class="form-check col-6">
                                                               <input class="form-check-input" type="radio" value="yes" name="is_stroke" id="is_stroke_yes">
                                                               <label class="form-check-label" for="is_stroke_yes">Yes</label>
                                                           </div>
                                                           <div class="form-check col-6">
                                                               <input class="form-check-input" type="radio" value="no" name="is_stroke" id="is_stroke_no">
                                                               <label class="form-check-label" for="is_stroke_no">No</label>
                                                           </div>
                                                       </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-lg-3">
                                             <div class="card">
                                                <div class="card-body">
                                                   <div class="form-group">
                                                      <label><b>Hepatitis ?</b></label>
                                                       <div class="input-container row">
                                                           <div class="form-check col-6">
                                                               <input class="form-check-input" type="radio" value="yes" name="is_hepatitis" id="is_hepatitis_yes">
                                                               <label class="form-check-label" for="is_hepatitis_yes">Yes</label>
                                                           </div>
                                                           <div class="form-check col-6">
                                                               <input class="form-check-input" type="radio" value="no" name="is_hepatitis" id="is_hepatitis_no">
                                                               <label class="form-check-label" for="is_hepatitis_no">No</label>
                                                           </div>
                                                       </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-lg-3">
                                             <div class="card">
                                                <div class="card-body">
                                                   <div class="form-group">
                                                      <label><b>Cancer ?</b></label>
                                                       <div class="input-container row">
                                                           <div class="form-check col-6">
                                                               <input class="form-check-input" type="radio" value="yes" name="is_cancer" id="is_cancer_yes">
                                                               <label class="form-check-label" for="is_cancer_yes">Yes</label>
                                                           </div>
                                                           <div class="form-check col-6">
                                                               <input class="form-check-input" type="radio" value="no" name="is_cancer" id="is_cancer_no">
                                                               <label class="form-check-label" for="is_cancer_no">No</label>
                                                           </div>
                                                       </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-lg-3">
                                             <div class="card">
                                                <div class="card-body">
                                                   <div class="form-group">
                                                      <label><b>Sickle Cell/ Trait ?</b></label>
                                                       <div class="input-container row">
                                                           <div class="form-check col-6">
                                                               <input class="form-check-input" type="radio" value="yes" name="is_sickle" id="is_sickle_yes">
                                                               <label class="form-check-label" for="is_sickle_yes">Yes</label>
                                                           </div>
                                                           <div class="form-check col-6">
                                                               <input class="form-check-input" type="radio" value="no" name="is_sickle" id="is_sickle_no">
                                                               <label class="form-check-label" for="is_sickle_no">No</label>
                                                           </div>
                                                       </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-lg-3">
                                             <div class="card">
                                                <div class="card-body">
                                                   <div class="form-group">
                                                      <label><b>Anaemia ?</b></label>
                                                       <div class="input-container row">
                                                           <div class="form-check col-6">
                                                               <input class="form-check-input" type="radio" value="yes" name="is_anaemia" id="is_anaemia_yes">
                                                               <label class="form-check-label" for="is_anaemia_yes">Yes</label>
                                                           </div>
                                                           <div class="form-check ml-3">
                                                               <input class="form-check-input" type="radio" value="no" name="is_anaemia" id="is_anaemia_no">
                                                               <label class="form-check-label" for="is_anaemia_no">No</label>
                                                           </div>
                                                       </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-lg-3">
                                             <div class="card">
                                                <div class="card-body">
                                                   <div class="form-group">
                                                      <label><b>Kidney Problems ?</b></label>
                                                       <div class="input-container row">
                                                           <div class="form-check col-6">
                                                               <input class="form-check-input" type="radio" value="yes" name="is_kidney_problem" id="is_kidney_problem_yes">
                                                               <label class="form-check-label" for="is_kidney_problem_yes">Yes</label>
                                                           </div>
                                                           <div class="form-check ml-3">
                                                               <input class="form-check-input" type="radio" value="no" name="is_kidney_problem" id="is_kidney_problem_no">
                                                               <label class="form-check-label" for="is_kidney_problem_no">No</label>
                                                           </div>
                                                       </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-lg-3">
                                             <div class="card">
                                                <div class="card-body">
                                                   <div class="row">
                                                      <div class="col-lg-12 mb-3">
                                                         <label><b>Smoke ?</b></label>
                                                          <div class="input-container row">
                                                          <div class="input-container row">
                                                              <div class="form-check col-6">
                                                                  <input class="form-check-input" type="radio" value="yes" name="is_smoking" id="is_smoking_yes">
                                                                  <label class="form-check-label" for="is_smoking_yes">Yes</label>
                                                              </div>
                                                              <div class="form-check ml-3">
                                                                  <input class="form-check-input" type="radio" value="no" name="is_smoking" id="is_smoking_no">
                                                                  <label class="form-check-label" for="is_smoking_no">No</label>
                                                              </div>
                                                          </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          </div>
                                          <div class="col-lg-3">
                                             <div class="card">
                                                <div class="card-body">
                                                   <div class="row">
                                                      <div class="col-lg-12 mb-3">
                                                         <label><b>Alcohol ?</b></label>
                                                          <div class="input-container row">
                                                          <div class="input-container row">
                                                              <div class="form-check col-6">
                                                                  <input class="form-check-input" type="radio" value="yes" name="is_alcohol" id="is_alcohol_yes">
                                                                  <label class="form-check-label" for="is_alcohol_yes">Yes</label>
                                                              </div>
                                                              <div class="form-check ml-3">
                                                                  <input class="form-check-input" type="radio" value="no" name="is_alcohol" id="is_alcohol_no">
                                                                  <label class="form-check-label" for="is_alcohol_no">No</label>
                                                              </div>
                                                          </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          </div>
                                          <div class="col-lg-3">
                                             <div class="card">
                                                <div class="card-body">
                                                   <div class="row">
                                                      <div class="col-lg-12 mb-3">
                                                         <label><b>Allergies ?</b></label>
                                                          <div class="input-container row">
                                                          <div class="input-container row">
                                                              <div class="form-check col-6">
                                                                  <input class="form-check-input" type="radio" value="yes" name="is_allergie" id="is_allergie_yes">
                                                                  <label class="form-check-label" for="is_allergie_yes">Yes</label>
                                                              </div>
                                                              <div class="form-check ml-3">
                                                                  <input class="form-check-input" type="radio" value="no" name="is_allergie" id="is_allergie_no">
                                                                  <label class="form-check-label" for="is_allergie_no">No</label>
                                                              </div>
                                                          </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          </div>
                                          <div class="col-lg-3">
                                             <div class="card">
                                                <div class="card-body">
                                                   <div class="row">
                                                      <div class="col-lg-12 mb-3">
                                                         <label><b>Surgery History ?</b></label>
                                                          <div class="input-container row">
                                                              <div class="form-check col-6">
                                                                  <input class="form-check-input" type="radio" value="yes" name="is_surgery_history" id="is_surgery_history_yes">
                                                                  <label class="form-check-label" for="is_surgery_history_yes">Yes</label>
                                                              </div>
                                                              <div class="form-check ml-3">
                                                                  <input class="form-check-input" type="radio" value="no" name="is_surgery_history" id="is_surgery_history_no">
                                                                  <label class="form-check-label" for="is_surgery_history_no">No</label>
                                                              </div>
                                                          </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-lg-6">
                                             <div class="card">
                                                <div class="card-body">
                                                   <div class="row">
                                                      <div class="col-lg-12 mb-3">
                                                         <label><b>When was the last Covid Vaccine ?</b></label>
                                                          <div class="input-container row">
                                                          <div class="input-container row">
                                                              <div class="form-check col-6">
                                                                  <input class="form-check-input" type="radio" value="yes" name="is_covid_vaccine" id="is_covid_vaccine_yes">
                                                                  <label class="form-check-label" for="is_covid_vaccine_yes">Yes</label>
                                                              </div>
                                                              <div class="form-check ml-3">
                                                                  <input class="form-check-input" type="radio" value="no" name="is_covid_vaccine" id="is_covid_vaccine_no">
                                                                  <label class="form-check-label" for="is_covid_vaccine_no">No</label>
                                                              </div>
                                                          </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          </div>
                                          <div class="col-lg-6">
                                             <div class="card">
                                                <div class="card-body">
                                                   <div class="row">
                                                      <div class="col-lg-12">
                                                         <div class="form-group">
                                                            <label for="note"><b>Note</b></label>
                                                            <textarea class="form-control" id="note" placeholder="Enter Note" rows="3" cols="50"></textarea>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-lg-6">
                                             <div class="card">
                                                <div class="card-body">
                                                   <div class="row">
                                                      <div class="col-lg-6">
                                                         <div class="form-group">
                                                            <label for="weight"><b>Weight</b></label>
                                                            <input type="text" class="form-control" id="weight" maxlength="3" placeholder="Enter Weight">
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-6">
                                                         <div class="form-group">
                                                            <label for="weightUnit"><b>Unit</b></label>
                                                            <select class="form-control" id="weightUnit">
                                                               <option></option>
                                                               <option value="Kg">Kg</option>
                                                               <option value="St">St</option>
                                                               <option value="lbs">lbs</option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-lg-6">
                                             <div class="card">
                                                <div class="card-body">
                                                   <div class="row">
                                                      <div class="col-lg-6">
                                                         <div class="form-group">
                                                            <label for="height"><b>Height</b></label>
                                                            <input type="text" class="form-control" id="height" placeholder="Enter Height">
                                                         </div>
                                                      </div>
                                                      <div class="col-lg-6">
                                                         <div class="form-group">
                                                            <label for="heightUnit"><b>Unit</b></label>
                                                            <select class="form-control" id="heightUnit">
                                                               <option></option>
                                                               <option value="Cm">Cm</option>
                                                               <option value="Inch">Inch</option>
                                                               <option value="Ft">Ft</option>
                                                            </select>
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
                              <div class="col-sm-12">
                                 <button type="button" class="btn btn-primary float-right mb-5 save-fix-btn" id="saveOtherTreatmentPlanBtn">Next <i class="fa fa-arrow-right"></i></button>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-lg-12 col-md-12 col-xs-12">
                                 <div class="card p-3">
                                    <div class="card-body">
                                       <div class="card-title">
                                          <h2>Patient Photos</h2>
                                       </div>
                                       <form method="post" action="{{ route('file.store') }}" enctype="multipart/form-data" class="dropzone" id="dropzone">
                                          @csrf
                                          <input type="hidden" name="treatmentPlanId" id="tpId">
                                          <div class="dz-message needsclick">
                                             <h3>Drag and Drop files here or click to upload.</h3>
                                             <i class="fas fa-box-open fa-5x pull-r"></i>
                                             <br>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <form name="frmInfo" class="d-none" id="frmInfo">
                              <input type="text" name="txtFirstName" required>
                              <input type="text" name="txtLastName" required>
                           </form>
                        </div>
                        <div class="step-tab-panel" id="tab4">
                           <div class="progress mt-3">
                              <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-12">
                                 <h4 class="mt-3">Treatment Plan Request Summary: </h4>
                                 <hr>
                                 <div style="clear:both;"></div>
                                 <div class="table-responsive resultTable mt-4">
                                    <div class="row">
                                       <div class="col-lg-3">
                                          <p>Treatment:</p>
                                       </div>
                                       <div class="col-lg-3">
                                          <p class="treatment-plan-treatment"></p>
                                       </div>
                                       <div class="col-lg-3">
                                          <p>Sales Person:</p>
                                       </div>
                                       <div class="col-lg-3">
                                          <p class="sales-person"></p>
                                       </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                       <div class="col-lg-3">
                                          <p>Weight:</p>
                                       </div>
                                       <div class="col-lg-3">
                                          <p class="treatment-plan-weight"></p>
                                       </div>
                                       <div class="col-lg-3">
                                          <p>Height:</p>
                                       </div>
                                       <div class="col-lg-3">
                                          <p class="treatment-plan-height"></p>
                                       </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                       <div class="col-lg-3">
                                          <p>BMI Value:</p>
                                       </div>
                                       <div class="col-lg-3">
                                          <p class="treatment-plan-bmi"></p>
                                       </div>
                                       <div class="col-lg-3">
                                          <p>Estimated Price:</p>
                                       </div>
                                       <div class="col-lg-3">
                                          <p class="treatment-plan-estimated-price"></p>
                                       </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                       <div class="col-lg-3">
                                          <p>Duration Of Stay:</p>
                                       </div>
                                       <div class="col-lg-3">
                                          <p class="treatment-plan-duration-of-stay"></p>
                                       </div>
                                       <div class="col-lg-3">
                                          <p>Hospitalization:</p>
                                       </div>
                                       <div class="col-lg-3">
                                          <p class="treatment-plan-hospitalization"></p>
                                       </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                       <div class="col-lg-3">
                                          <p>Is Alcohol:</p>
                                       </div>
                                       <div class="col-lg-3">
                                          <p class="treatment-plan-alcohol"></p>
                                       </div>
                                       <div class="col-lg-3">
                                          <p>Is Smoke:</p>
                                       </div>
                                       <div class="col-lg-3">
                                          <p class="treatment-plan-smoke"></p>
                                       </div>
                                    </div>
                                    <hr>
                                    <button class="btn btn-primary mt-3 float-right" id="completeTreatmentPlan">Complete Treatment Plan Request <i class="fa fa-check"></i></button>
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
                        <button data-direction="prev" class="step-btn"><i class="fa fa-arrow-left"></i> Previous</button>
                        <button data-direction="next" class="step-btn btn btn-primary float-right d-none" id="next-step">Next <i class="fa fa-arrow-right"></i></button>
                        <button data-direction="next" class="step-btn btn btn-primary float-right d-none" id="saveTreatmentPlan">Save and Next <i class="fa fa-arrow-right"></i></button>
                        <button data-direction="finish" class="step-btn d-none">Finish</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="modal fade" id="createPatientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Create New Patient</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form method="POST">
                     <div class="row">
                           <div class="col-lg-12">
                              <div class="card p-4" id="createPatient">
                                 <form method="POST">
                                       @csrf
                                       <div class="row">
                                          <div class="col-lg-6">
                                             <div class="form-group">
                                                <label for="leadSourceId">Lead Source</label>
                                                <select class="form-control" id="leadSourceId">
                                                   <option></option>
                                                   @foreach ($lead_sources as $lead_source)
                                                   <option value="{{ $lead_source->id }}">{{ $lead_source->name }}</option>
                                                   @endforeach
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-lg-6">
                                             <div class="form-group">
                                                <label for="name">Patient Name Surname</label>
                                                <input type="text" class="form-control" id="name" placeholder="Enter Patient Name">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-lg-6">
                                             <div class="form-group">
                                                <label for="phone">Patient Phone Number</label>
                                                <input type="text" class="form-control" id="phone" placeholder="Enter Patient Phone">
                                             </div>
                                          </div>
                                          <div class="col-lg-6">
                                             <div class="form-group">
                                                <label for="age">Patient Age</label>
                                                <input type="text" class="form-control" id="age" maxlength="2" placeholder="Enter Patient Age">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-lg-6">
                                             <div class="form-group">
                                                <label for="email">Patient Email</label>
                                                <input type="email" class="form-control" id="email" placeholder="Enter Patient Email">
                                             </div>
                                          </div>
                                          <div class="col-lg-6">
                                             <div class="form-group">
                                                <label for="countryId">Patient Country</label>
                                                <select class="form-control" name="" id="countryId">
                                                   <option></option>
                                                   @foreach($countries as $country)
                                                      <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                   @endforeach
                                                </select>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-lg-6 mb-3">
                                             <label>Gender</label>
                                             <div class="form-check ml-3">
                                                <input class="form-check-input" type="radio" value="Male" name="gender" id="male">
                                                <label class="form-check-label" for="male">Male</label>
                                             </div>
                                             <div class="form-check ml-3">
                                                <input class="form-check-input" type="radio" value="Female" name="gender" id="female">
                                                <label class="form-check-label" for="female">Female</label>
                                             </div>
                                          </div>
                                          <div class="col-lg-6">
                                             <div class="form-group">
                                                <label for="note">Note</label>
                                                <input type="text" class="form-control" id="note" name="note" placeholder="Enter Note">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-lg-12">
                                             <button type="button" class="btn btn-primary float-right" id="savePatient">Save <i class="fa fa-check" aria-hidden="true"></i></button>
                                          </div>
                                       </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
               </div>
            </div>
         </div>

         <div class="modal fade" id="choosePatientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Choose Patient From the list</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <form method="POST">
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="card p-4">
                                 <div class="dt-responsive table-responsive">
                                   {!! $html->table() !!}
                                 </div>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
               </div>
            </div>
         </div>

@endsection
@section('footer')
{!! $html->scripts() !!}

@endsection
