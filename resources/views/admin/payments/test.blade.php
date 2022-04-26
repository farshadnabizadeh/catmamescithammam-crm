{{-- <div class="col-lg-6">
                     <div class="form-group">
                        <label for="discountId">Discount</label>
                        <select id="discountId" name="discountId" onchange="getDiscountDetail(this)" class="form-control">
                           <option></option>
                           @foreach ($discounts as $discount)
                           <option value="{{ $discount->id }}">{{ $discount->discount_name }} | %{{ $discount->discount_percentage }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div> --}}