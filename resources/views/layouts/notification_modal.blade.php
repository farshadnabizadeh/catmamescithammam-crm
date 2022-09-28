<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Send Notification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('definitions/treatmentplans/sendNotification') }}" method="POST">
                    @csrf
                    <input type="hidden" name="treatment_plan_id" value="{{ $treatment_plan->id }}">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea type="text" class="form-control" id="message" name="message" placeholder="Enter Message" required></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Send <i class="fa fa-arrow-right"></i></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>