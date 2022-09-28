<div class="modal fade" id="themeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select Theme</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs d-flex" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link @if($theme == 1) active @endif" id="theme1-tab" data-toggle="tab" href="#theme1" role="tab" aria-controls="theme1" aria-selected="true">Theme 1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if($theme == 2) active @endif" id="theme2-tab" data-toggle="tab" href="#theme2" role="tab" aria-controls="theme2" aria-selected="false">Theme 2</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade @if($theme == 1) show active @endif" id="theme1" role="tabpanel" aria-labelledby="theme1-tab">
                                <div class="card h-100 mt-3">
                                    <div class="card-body">
                                        <h4 class="d-flex align-items-center mb-3">Theme 1</h4>
                                        <img src="{{ asset('assets/img/theme1.png') }}" style="width: 550px">
                                        <a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang='.$lang.'&theme=1')  }}" class="btn btn-primary float-right mt-5 add-new-btn"><i class="fa fa-check"></i> Use Theme</a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade @if($theme == 2) show active @endif" id="theme2" role="tabpanel" aria-labelledby="theme2-tab">
                                <div class="card h-100 mt-3">
                                    <div class="card-body">
                                        <h4 class="d-flex align-items-center mb-3">Theme 2</h4>
                                        <img src="{{ asset('assets/img/theme2.png') }}" style="width: 550px">
                                        <a href="{{ url('/definitions/treatmentplans/download/'.$treatment_plan->id.'?lang='.$lang.'&theme=2')  }}" class="btn btn-primary float-right mt-5 add-new-btn"><i class="fa fa-check"></i> Use Theme</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>