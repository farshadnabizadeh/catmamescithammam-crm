<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4 mt-3">
                <div class="card-title">
                    <h2>Edit Treatment</h2>
                    <p class="float-right last-user">Last Operation User: <i class="fa fa-user text-dark"></i> {{ $treatment->user->name }}</p>
                </div>
                <form action="{{ route('treatment.update', ['id' => $treatment->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nameEn">Treatment Name</label>
                                <input type="text" class="form-control" id="nameEn" name="nameEn" placeholder="Enter Treatment Name" value="{{ $treatment->name_en }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nameDe">Treatment Name (German)</label>
                                <input type="text" class="form-control" id="nameDe" name="nameDe" placeholder="Enter Treatment Name" value="{{ $treatment->name_de }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nameFr">Treatment Name (French)</label>
                                <input type="text" class="form-control" id="nameFr" name="nameFr" placeholder="Enter Treatment Name" value="{{ $treatment->name_fr }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nameIt">Treatment Name (İtalian)</label>
                                <input type="text" class="form-control" id="nameIt" name="nameIt" placeholder="Enter Treatment Name" value="{{ $treatment->name_it }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nameEs">Treatment Name (Spanish)</label>
                                <input type="text" class="form-control" id="nameEs" name="nameEs" placeholder="Enter Treatment Name" value="{{ $treatment->name_es }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="namePt">Treatment Name (Portuguese)</label>
                                <input type="text" class="form-control" id="namePt" name="namePt" placeholder="Enter Treatment Name" value="{{ $treatment->name_pt }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="namePl">Treatment Name (Polish)</label>
                                <input type="text" class="form-control" id="namePl" name="namePl" placeholder="Enter Treatment Name" value="{{ $treatment->name_pl }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nameRu">Treatment Name (Russian)</label>
                                <input type="text" class="form-control" id="nameRu" name="nameRu" placeholder="Enter Treatment Name" value="{{ $treatment->name_ru }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nameTr">Treatment Name (Turkish)</label>
                                <input type="text" class="form-control" id="nameTr" name="nameTr" placeholder="Enter Treatment Name" value="{{ $treatment->name_tr }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nameAr">Treatment Name (Arabic)</label>
                                <input type="text" class="form-control" id="nameAr" name="nameAr" placeholder="Enter Treatment Name" value="{{ $treatment->name_ar }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="desc">Note</label>
                                <textarea class="form-control" name="desc" placeholder="Note">{{ $treatment->desc }}</textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-5 float-right">Update <i class="fa fa-check" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
